<?php
/*
Summary:

NOTE:
IT TAKES THE BROWSER ANOTHER PAGE TO MOVE TO WHEN DEALING WITH COOKIES TO RESPOND TO THE COOKIES COMMANDS 

Check real cookie can not be done now at all
We don't have plans yet for activity, device

1)Set
function setFastCookie($fastId);
function setQuickFastCookie($fastId);
function setRealCookie($userId);
function setQuickRealCookie($userId);

2)Get
function getFastCookie();
function getRealCookie();


3)Refresh
function refreshFastCookie();
function refreshRealCookie();
function refreshCookies()



4)Delete
function deleteFastCookie();
deleteQuickFastCookie()
function deleteRealCookie();
deleteQuickRealCookie();


5)others
function cookieRespond();
function cookieCount();
function dumpCookie();


6)check help
function checkCookieValue1($cookieValue,$newId);
function checkCookieValue2($activity,$rightDevice);


7)Check
function checkFastCookie();
function checkRealCookie();






*/





//1)Set

function setFastCookie($fastId)
{
	
	if(!isset($_COOKIE["kanteene-fast"]))
	{
		setQuickFastCookie($fastId);
		cookieRespond();
	}

}

function setQuickFastCookie($fastId)
{
	
	if(!isset($_COOKIE["kanteene-fast"]))
	{
		setcookie("kanteene-fast",$fastId,
		time()+86400*30*12,"/"/*,"www.kanteene.com"*/);
	}

}




function setRealCookie($userId)
{
	if(!isset($_COOKIE["kanteene-real"]))
	{
		setQuickRealCookie($userId);
		cookieRespond();
	}
}


function setQuickRealCookie($userId)
{
	if(!isset($_COOKIE["kanteene-real"]))
	{
	setcookie("kanteene-real",$userId,
		time()+86400*30*12,"/"/*,"www.kanteene.com"*/);
	}
}









//2)Get

function getFastCookie()
{
	$cookie_name="kanteene-fast";
	if(!isset($_COOKIE[$cookie_name])) 
	{return false;} 
	else 
	{return $_COOKIE[$cookie_name];}
}


function getRealCookie()
{
	$cookie_name="kanteene-real";
	if(!isset($_COOKIE[$cookie_name])) 
	{return false;} 
	else 
	{return $_COOKIE[$cookie_name];}
}





//3)Refresh

function refreshFastCookie()
{

	if(isset($_COOKIE["kanteene-fast"]))
	{
		$fastId=getFastCookie();
		setcookie("kanteene-fast",$fastId,
		time()+86400*30*12,"/"/*,"www.kanteene.com"*/);
	}
}




function refreshRealCookie()
{
	if(isset($_COOKIE["kanteene-real"]))
	{
		$userId=getRealCookie();
		setcookie("kanteene-real",$userId,
		time()+86400*30*12,"/"/*,"www.kanteene.com"*/);
	}
}



function refreshCookies()
{
	refreshFastCookie();
	refreshRealCookie();
}






//4)Delete

function deleteFastCookie()
{
	$cookie_name="kanteene-fast";
	if(isset($_COOKIE[$cookie_name]))
	{
		deleteQuickFastCookie();
		cookieRespond();
	}
}


function deleteQuickFastCookie()
{
	$cookie_name="kanteene-fast";
	if(isset($_COOKIE[$cookie_name]))
	{
		$fastId=$_COOKIE[$cookie_name];
		setcookie($cookie_name,$fastId,
		time()-86400*30*12,"/"/*,"www.kanteene.com"*/);
	}
}





function deleteRealCookie()
{
	$cookie_name="kanteene-real";
	if(isset($_COOKIE[$cookie_name]))
	{
		deleteQuickRealCookie();
		cookieRespond();
	}
}

function deleteQuickRealCookie()
{
	$cookie_name="kanteene-real";
	if(isset($_COOKIE[$cookie_name]))
	{
		$realId=$_COOKIE[$cookie_name];
		setcookie($cookie_name,$realId,
		time()-86400*30*12,"/"/*,"www.kanteene.com"*/);
	}
}






//5)Others
function cookieRespond()
{
	$currentPage=htmlspecialchars($_SERVER["PHP_SELF"]);
	$s="Location: ".$currentPage;
	header($s);
}


function cookieCount()
{
	print("<hr>");
	$s="the number of cookies is ".count($_COOKIE);
	print($s);
}


function dumpCookie()
{
	var_dump($_COOKIE);
}





//6)check help
function checkCookieValue1
($cookieValue,$newId)
{
	$length=strlen($cookieValue);
	if($length>50){return 1;}
	$passIt=expectedChars($cookieValue,100,
		array("0","1","2","3","4","5","6","7"
			,"8","9"));
	if($passIt==false)
	{return 3;}
	if($cookieValue>=$newId){return 5;}
	if($cookieValue==0){return 5;}
	
	return 0;
}




function
checkCookieValue2
($activity,$rightDevice)
{
	if($activity=="f"){return 7;}
	if($activity==false){return 7;}
	if(isNewDevice($rightDevice,getUserDevice())){return 9;}
	return 0;
}






//7)Ckeck
function checkFastCookie()
{
	$cookieName="kanteene-fast";

	$newId=getNewId("fastaccount");
	$value=getFastCookie();
	//var_dump($value);
	if($value==false)
		{
			if(isset($_COOKIE['kanteene-fast']))
			{
				recordHack(5);deleteQuickFastCookie();
				deleteFastSession();
				return false;
			}
			else{deleteQuickFastCookie();return false;}
		}
	//var_dump($stringProblem1);
	

	$stringProblem1=checkCookieValue1($value,$newId);

	//var_dump($stringProblem1);
	if($stringProblem1==1)
	{recordHack(1);
	deleteQuickFastCookie();
	deleteFastSession();
	return false;
	}

	if($stringProblem1==3)
	{recordHack(3);deleteQuickFastCookie();
		deleteFastSession();return false;
	}

	if($stringProblem1==5)
	{recordHack(5);deleteQuickFastCookie();
		deleteFastSession();return false;
	}

	$activity=getFastAccountActivity($value);
	$rightDevice=
	getSqlFastAccountDevice($value);
	$stringProblem2=checkCookieValue2
	($activity,$rightDevice);

	//var_dump($activity);
	//var_dump($stringProblem2);

	if($stringProblem2==7)
	{recordHack(7);deleteQuickFastCookie();
		deleteFastSession();return false;
	}
	if($stringProblem2==9)
	{recordHack(9);deleteQuickFastCookie();
		deleteFastSession();return false;
	}

return true;

}


function checkRealCookie()
{
	$cookieName="kanteene-real";

	$newId=getNewId("realaccount");
	$value=getRealCookie();
	//var_dump($value);
	if($value==false)
		{
			if(isset($_COOKIE['kanteene-real']))
			{
				recordHack(6);deleteQuickRealCookie();
				deleteRealSession();
				return false;
			}
			else{deleteRealCookie();return false;}
		}
	//var_dump($stringProblem1);
	

	$stringProblem1=checkCookieValue1($value,$newId);

	//var_dump($stringProblem1);
	if($stringProblem1==1)
	{recordHack(2);
	deleteQuickRealCookie();
	deleteRealSession();
	return false;
	}

	if($stringProblem1==3)
	{recordHack(4);deleteQuickRealCookie();
		deleteRealSession();return false;
	}

	if($stringProblem1==5)
	{recordHack(6);deleteQuickRealCookie();
		deleteRealSession();return false;
	}

	$activity=getSqlRealAccountActivity($value);
	$rightDevice=
	getRealAccountDevice($value);
	$stringProblem2=checkCookieValue2
	($activity,$rightDevice);

	//var_dump($activity);
	//var_dump($stringProblem2);

	if($stringProblem2==7)
	{recordHack(8);deleteQuickRealCookie();
		deleteRealSession();return false;
	}
	if($stringProblem2==9)
	{	//var_dump("Here Mate");
		recordHack(10);deleteQuickRealCookie();
		deleteRealSession();return false;
	}

return true;
}







/*



Description:



1)Set

function setFastCookie($fastId);
This function sets a fast cookie 
The value of the cookie is the given id
And it applies the cookie respond

function setQuickFastCookie($fastId);
The same as the previous without the cookie respond

function setRealCookie($userId);
This function sets a real account cookie
The value of the cookie is the given id

function setQuickRealCookie($userId);
The same as the previous without the cookie respond



2)Get
function getFastCookie();
The function returns the value of the fast cookie
If it exists
else it will return boolean false

function getRealCookie();
The function returns the value of the real cookie
If it exists
else it will return boolean false







3)Refresh
function refreshFastCookie();
//deleteFastCookie();
refreshFastCookie(10);
var_dump(getFastCookie());
cookieCount();


function refreshRealCookie();
refreshRealCookie(10);
//deleteRealCookie();
var_dump(getRealCookie());
cookieCount();

function refreshCookies();


4)Delete
function deleteFastCookie();
This function deletes the fast cookie and responds

function deleteQuickFastCookie();
This function deletes the fast cooke without responding

function deleteRealCookie();
This function deletes a user cookie and responds

function deleteQuickRealCookie();
This cunction deletes a user cookie without respond





5)Others

function cookieRespond();
This function is used to make sure that any updates
 to the cookie is fully operational at real time
 I takes the user to anew page 
 and then takes him back to the same old page





function dumpCookie();
This function display all the cookies that are set up





//6)check help
function checkCookieValue1($cookieValue,$newId);
returns an integer 0,1,3
0)This is good value
1)It has more than 50 char
(record hack001 or hack002, delete cookie)
3)Not only numbers
(record hack003 or hack004, delete cookie)


6)check help
function checkCookieValue1($cookieValue,$newId);
function checkCookieValue2($activity,$rightDevice);








7)Check
function checkFastCookie()
This function returns true of false
True: you can establish a session
False:
the function will delete the cookie if it exists and will record a hack if nessecary
You can not establish a session in this case







NOTE
THERE COULD BE MORE THAN A SINGLE COOKIE AT THE SAME TIME
//deleteRealCookie();
//deleteFastCookie();
setFastCookie(10);
setRealCookie(10);
var_dump(getFastCookie());
var_dump(getRealCookie());
cookieCount();








NOTE:
1)CHECK COOKIE
2)SETCOOKIE
3)DELETECOOKIE
4)REFRESH
ANY 2 OF THEM CAN'T EXIST AT THE SAME PAGE
THIS WILL CAUSE REDIRECT PROBLEM


*/





?>

<?php
/*
TESTING


1)Set
function setFastCookie($fastId);
Test:
setFastCookie(10);
//deleteFastCookie();
var_dump(getFastCookie());
cookieCount();


function setRealCookie($userId);
Test:
setRealCookie(10);
//deleteRealCookie();
dumpCookie();
C:\wamp\www\kant\php\cookies.php:214:
array (size=2)
  'PHPSESSID' => string '38jmq63nlapbhoquf0bjs7umb1' (length=26)
  'kanteene-real' => string '10' (length=2)






2)Get
function getFastCookie();
setFastCookie(10);
//deleteFastCookie();
var_dump(getFastCookie());
cookieCount();

function getRealCookie();

Test: when the cookie exists
setRealCookie(10);
//deleteRealCookie();
//dumpCookie();
var_dump(getRealCookie());
C:\wamp\www\kant\index.php:76:string '10' (length=2)


Test: when the cookie is deleted
//setRealCookie(10);
deleteRealCookie();
//dumpCookie();
var_dump(getRealCookie());
C:\wamp\www\kant\index.php:76:boolean false




3)Refresh

function refreshFastCookie();
//deleteFastCookie();
refreshFastCookie(10);
var_dump(getFastCookie());
cookieCount();


function refreshRealCookie();
refreshRealCookie(10);
//deleteRealCookie();
var_dump(getRealCookie());
cookieCount();

function refreshCookies();

function refreshFastCookie();
function refreshRealCookie();
function refreshCookies()



4)Delete
function deleteFastCookie();
//setFastCookie(10);
deleteFastCookie();
var_dump(getFastCookie());
cookieCount();





function deleteRealCookie();
//setRealCookie(10);
deleteRealCookie();
dumpCookie();
C:\wamp\www\kant\index.php:76:boolean false



5)others
function cookieRespond();
setFastCookie(10);
//deleteFastCookie();
var_dump(getFastCookie());
cookieCount();




function cookieCount();
function dumpCookie();

Test:
dumpCookie();
C:\wamp\www\kant\php\cookies.php:214:
array (size=1)
  'PHPSESSID' => string '38jmq63nlapbhoquf0bjs7umb1' (length=26)





6)check help
function checkCookieValue1($cookieValue,$newId);
function checkCookieValue2($activity,$rightDevice);





7)Check
function checkFastCookie()

Test: Type 1 Hack
//deleteFastCookie();
//setFastCookie("123456789112345678921234567893123456789412345678951");
//51 chars
dumpCookie();
var_dump(checkFastCookie());
Fast cookie deleted
C:\wamp\www\kant\index.php:46:boolean false
Length of Fast cookie value= 51;The value is:123...


Test: Type 3 Hack 

//deleteFastCookie();
//setFastCookie("1a");
dumpCookie();
var_dump(checkFastCookie());
shdow Cookie deleted
C:\wamp\www\kant\index.php:46:boolean false
fast cookie values doesn't contain only numbers;...



Test Type 5 hack:

//deleteFastCookie();
//setFastCookie("0");
dumpCookie();
var_dump(checkFastCookie());
Fast cookie is not there
the number of cookies is 0
C:\wamp\www\kant\index.php:77:boolean false
Fast cookie values doesn't exist in the table;It...
It will be recoder also if cookie value is
"false" as a not letters only (3)


//max =2
//deleteFastCookie();
//setFastCookie("8");
dumpCookie();
var_dump(checkFastCookie());
the number of cookies is 0
C:\wamp\www\kant\index.php:77:boolean false
Fast cookie values doesn't exist in the table;It...

//id=1 works well
C:\wamp\www\kant\index.php:77:boolean true
No hack records


Test type 7 Hack:
sqlSafeUpdateInhanced
("fastaccount",1,array("activity"=>"f"));
//deleteFastCookie();
//setFastCookie("1");
//deleteSqlFastAccount(1);
dumpCookie();
var_dump(checkFastCookie());
the number of cookies is 0
C:\wamp\www\kant\index.php:75:boolean false
fast cookie value contains the value of a delete...



Test type 9 Hack:
//deleteFastCookie();
//setFastCookie("1");
//setSqlFastAccountDevice(1,"va");
dumpCookie();
var_dump(checkFastCookie());
Fast cookie is not here
C:\wamp\www\kant\index.php:74:boolean false
cookie:wrong fast account device;the right devic...



Test working fast account:

//deleteFastCookie();
//setFastCookie("1");
//setSqlFastAccountDevice(1,"va");
dumpCookie();
var_dump(checkFastCookie());
the number of cookies is 1
C:\wamp\www\kant\index.php:46:boolean true
//no new records in hackattempts




TestWith no fast account cookie:

//deleteFastCookie();
dumpCookie();
var_dump(checkFastCookie());
the number of cookies is 0
C:\wamp\www\kant\index.php:35:boolean false
//no new hacking records

















function checkRealCookie();



Test: Type 2 Hack
//deleteRealCookie();
//setRealCookie("123456789112345678921234567893123456789412345678951");
//51 chars
dumpCookie();
var_dump(checkRealCookie());
Real cookie deleted
C:\wamp\www\kant\index.php:80:boolean false
Length of real cookie value= 51;The value is:12345...


Test: Type 4 Hack 

//deleteRealCookie();
//setRealCookie("1a");
dumpCookie();
var_dump(checkRealCookie());
Real Cookie deleted
C:\wamp\www\kant\index.php:78:boolean false
real cookie values doesn't contain only numbers;It...



Test Type 6 hack:

//deleteRealCookie();
//setRealCookie("0");
dumpCookie();
var_dump(checkRealCookie());
Real cookie is not there
the number of cookies is 0
C:\wamp\www\kant\index.php:78:boolean false
real cookie values doesn't exist in the table;It's...
It will be recoder also if cookie value is
"false" as a not letters only (4)


//max =3
//deleteRealCookie();
//setRealCookie("4");
dumpCookie();
var_dump(checkRealCookie());
the number of cookies is 0
C:\wamp\www\kant\index.php:77:boolean false
real cookie values doesn't exist in the table;It's...

//id=1 works well
C:\wamp\www\kant\index.php:77:boolean true
No hack records


Test type 8 Hack:
sqlSafeUpdateInhanced
("realaccount",1,array("activity"=>"f"));
//deleteRealCookie();
//setRealCookie("1");
//deleteSqlRealAccount(1);
dumpCookie();
var_dump(checkRealCookie());
the number of cookies is 0
C:\wamp\www\kant\index.php:75:boolean false
real cookie value contains the value of a deleted ...



Test with a deactivated account
sqlSafeUpdateInhanced
("realaccount",1,array("activity"=>"d"));
//deleteRealCookie();
//setRealCookie("1");
//deleteSqlRealAccount(1);
dumpCookie();
var_dump(checkRealCookie());
C:\wamp\www\kant\index.php:81:boolean true



Test type 10 Hack:
//deleteRealCookie();
//setRealCookie("2");
//setRealAccountDevice(2,"va");
dumpCookie();
var_dump(checkRealCookie());
Real cookie is not here
C:\wamp\www\kant\index.php:79:boolean false
cookie:wrong real account device;the right devices...


Test working Real account:

//deleteRealCookie();
//setRealCookie("3");
dumpCookie();
var_dump(checkRealCookie());
the number of cookies is 1
C:\wamp\www\kant\index.php:79:boolean true
//no new records in hackattempts




Test With no real account cookie:

//deleteRealCookie();
dumpCookie();
var_dump(checkRealCookie());
the number of cookies is 0
C:\wamp\www\kant\index.php:79:boolean false
//no new hacking records









*/
?>