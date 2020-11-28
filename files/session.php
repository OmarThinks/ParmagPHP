<?php
/*
I don't know how it works exactly
How session works?
How tohack session?
How to protect against session hijacking?
Where are the session variables stored?

I will not approach sessions soon
It's over

It needs more cumputaion to verify each cookie on each page
But we still don't have that too much traffic




Summary:

session names:
fastId
realId

1)Summary
function summaryOfSessions();

2)Establish
function establishSessions();

3)Set
function setFastSession();
function setLogInSession();

4)Get:
function getFastSession();
function getLogInSession();

5)Delete:
function deleteFastSession();
function deleteLogInSession();

6)Check
function checkSessions();
function checkFastSession();
function checkLoginSession();


*/


//1)

function summaryOfSessions()
{

	$fastCookie=getFastCookie();
	$fastSession=getFastSession();
	establishSessions();
	checkFastSession();



	$_SESSION['finalDestination']=null;
	$_SESSION['job']=null;
	$_SESSION['VALUE1']=null;
	$_SESSION['VALUE2']=null;
	$_SESSION['VALUE3']=null;
	$_SESSION['VALUE4']=null;
	$_SESSION['VALUE5']=null;

}



//2)Establish
function establishSessions()
{
	if(isset($_SESSION['fastId']))
		{
			setFastSession();
			checkFastSession();
		}
	else
	{
		if(checkFastCookie())
		{
			setFastSession();
			updateSqlFastLastSession
					(getFastSession());
		}
	}

//the same for login session
}













//3)Set
function setFastSession()
{
	$fastCookieValue=getFastCookie();
	if($fastCookieValue)
	{
		$toSet=getFastCookie();
		$_SESSION['fastId']=$toSet;
		return;
	}
	deleteFastSession();
}


function setLogInSession()
{
	$toSet=getLogInCookie();
	$_SESSION['userId']=$toSet;
}


//4)Get:
function getFastSession()
{
	if(isset($_SESSION['fastId']))
	{
	return($_SESSION['fastId']);
	}
	else{return false;}
}
function getLogInSession()
{
	if(isset($_SESSION['userId']))
	{
	return($_SESSION['userId']);
	}
	else{return false;}
}


//5)Delete:
function deleteFastSession()
{
	if(isset($_SESSION['fastId']))
	{
		$_SESSION['fastId']=null;
	}
}
function deleteRealSession()
{	
	if(isset($_SESSION['fastId']))
	{
		$_SESSION['userId']=null;
	}
}





//6) Check


function checkSessions()
{

}



function checkFastSession()
{
	$newId=getNewId("fastaccount");
	$value=getFastSession();
	//var_dump($value);
	if($value==false)
		{
			if(isset($_SESSION['fastId']))
			{
				recordHack(15);deleteFastSession();
				return false;
			}
			else{deleteFastSession();return false;}
		}
	//var_dump($stringProblem1);
	$stringProblem1=checkCookieValue1($value,$newId);
	//var_dump($stringProblem1);
	if($stringProblem1==1)
	{recordHack(11);deleteFastCookie();deleteFastSession();return false;
	}
	if($stringProblem1==3)
	{recordHack(13);deleteFastCookie();deleteFastSession();return false;
	}
	if($stringProblem1==5)
	{recordHack(15);deleteFastCookie();deleteFastSession();return false;
	}

	$activity=getFastAccountActivity($value);
	$rightDevice=
	getSqlFastAccountDevice($value);
	$stringProblem2=checkCookieValue2
	($activity,$rightDevice);

	//var_dump($activity);
	//var_dump($stringProblem2);

	if($stringProblem2==7)
	{recordHack(17);deleteFastCookie();deleteFastSession();return false;
	}
	if($stringProblem2==9)
	{recordHack(19);deleteFastCookie();deleteFastSession();return false;
	}

return true;
}



function checkLoginSession()
{return true;}

/*
Description:




2)Establish
function establishSessions();
This function does what is nessecary
It will check the cookies
if it passes we will establish sessions
if the session was new it will record
in the last session in the table

Test: new account
works(when pressing remember me)
var_dump(getFastCookie());
var_dump(getFastSession());
C:\wamp\www\kant\index.php:67:string '25' (length=2)
C:\wamp\www\kant\index.php:68:string '25' (length=2)
//last session was not updated


TEST: delete sql data, press remember me
var_dump(getFastCookie());
var_dump(getFastSession());
C:\wamp\www\kant\index.php:67:string '1' (length=1)
C:\wamp\www\kant\index.php:68:string '1' (length=1)


TEST: delete session the refresh the same page
//deleteFastSession();
var_dump(getFastCookie());
var_dump(getFastSession());
C:\wamp\www\kant\index.php:65:string '1' (length=1)
C:\wamp\www\kant\index.php:66:string '1' (length=1)
//Last session was updated


TEST: delete cookie, refresh the same page
//deleteFastCookie();
var_dump(getFastCookie());
var_dump(getFastSession());
C:\wamp\www\kant\index.php:65:boolean false
C:\wamp\www\kant\index.php:66:boolean false
//no hacksattempts were recorded



TEST: Hack
Steps
1)comment sessionSummary
2)comment setCookieValue
3)apply delete cookie
4)comment deleteCookie
5)apply setCookieValue("a1")
6)cooment setCookieValue
7)apply sessionSummary

//deleteFastCookie();
//setFastCookie("a1");
var_dump(getFastCookie());
var_dump(getFastSession());
C:\wamp\www\kant\index.php:68:boolean false
C:\wamp\www\kant\index.php:69:boolean false
//fast session values doesn't contain only numbers...










3)Set
function setFastSession();
from the cookie value we set the fast session 

function setLogInSession();
from the cookie value we set the log in value


4)Get:
function getFastSession();
retruns the fast session variable

function getLogInSession();
returns the Log In session variable


5)Delete:
function deleteFastSession();
sets the fast session variable as null

function deleteLogInSession();
sets the log in session variable as null






//6) Check
function checkSessions();
function checkFastSession();
This function returns true of false
True: you can establish a session
False:
the function will delete the session if it exists and will record a hack if nessecary
You can not establish coomunication with the user in this case 


Test: Type 11 hack

$_SESSION['fastId']="123456789112345678921234567893123456789412345678951";
//51 chars
var_dump(getFastSession());
var_dump(checkFastSession());
var_dump(getFastSession());
//C:\wamp\www\kant\index.php:73:string '123456789112345678921234567893123456789412345678951' (length=51)
//C:\wamp\www\kant\index.php:73:boolean false
//C:\wamp\www\kant\index.php:74:boolean false
//Length of fast session value= 51;The value is:12...





Test: type 13 hack

$_SESSION['fastId']="1a";
//contains "a" as invalid char
var_dump(getFastSession());
var_dump(checkFastSession());
var_dump(getFastSession());
//C:\wamp\www\kant\index.php:73:string '1a' (length=2)
//C:\wamp\www\kant\index.php:74:boolean false
//C:\wamp\www\kant\index.php:75:boolean false
//fast session values doesn't contain only numbers...



Test: Type 15 hack

$_SESSION['fastId']="0";
//0 is not in the table
var_dump(getFastSession());
var_dump(checkFastSession());
var_dump(getFastSession());
//C:\wamp\www\kant\index.php:73:string '0' (length=1)
//C:\wamp\www\kant\index.php:74:boolean false
//C:\wamp\www\kant\index.php:75:boolean false
//fast session values doesn't exist in the table;I...




$_SESSION['fastId']="5";
//max 4
var_dump(getFastSession());
var_dump(checkFastSession());
var_dump(getFastSession());
//C:\wamp\www\kant\index.php:73:string '5' (length=1)
//C:\wamp\www\kant\index.php:74:boolean false
//C:\wamp\www\kant\index.php:75:boolean false
//fast session values doesn't exist in the table;I...

//id=4 works well



Test: Type 17 hack


deleteSqlFastAccount(1);
$_SESSION['fastId']="1";
//deleted account
var_dump(getFastSession());
var_dump(checkFastSession());
var_dump(getFastSession());
//C:\wamp\www\kant\index.php:73:string '1' (length=1)
//C:\wamp\www\kant\index.php:74:boolean false
//C:\wamp\www\kant\index.php:75:boolean false
//fast session value contains the value of a delet...


Test: type 19 hack


setSqlFastAccountDevice(2,"va");
$_SESSION['fastId']="2";
//wrong device
var_dump(getFastSession());
var_dump(checkFastSession());
var_dump(getFastSession());
//C:\wamp\www\kant\index.php:73:string '2' (length=1)
//C:\wamp\www\kant\index.php:74:boolean false
//C:\wamp\www\kant\index.php:75:boolean false
//session: wrong fast account device;the right dev...



Test: Safe session

$_SESSION['fastId']="3";
//safe
var_dump(getFastSession());
var_dump(checkFastSession());
var_dump(getFastSession());
//C:\wamp\www\kant\index.php:72:string '3' (length=1)
//C:\wamp\www\kant\index.php:73:boolean true
//C:\wamp\www\kant\index.php:74:string '3' (length=1)
//No hacking new records


Test: No session

deleteFastSession();
//safe, no session
var_dump(getFastSession());
var_dump(checkFastSession());
var_dump(getFastSession());
//C:\wamp\www\kant\index.php:72:boolean false
//C:\wamp\www\kant\index.php:73:boolean false
//C:\wamp\www\kant\index.php:74:boolean false
//No hacking new records







function checkLoginSession();





*/
















/*
NOTES:



steps
1)check if the user got a right session or a hacker
2) if the check passed we establish the session
3)No more dealing with the cookie
4)Check the session
5)now on we only deal with the session


Establishing a session means that the user is 
recognized with no doubt
The cookie has been checked
No more dealing with the cookie
Now on we deal only with session








When ordering commands
cookies then sessions



*/
?>