<?php
/*
*DESCRIPTION:
*
*This is the file that contains all the functions
*This is the file that should be included
*This is the summary file
* Or you can include each file separately from the files directory
* Note, some files depend on each other



* Each file in files contains the data about how to use it
*/

?>








<?php
/*

cookies.php

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




?>

















<?php
/*
date.php
*/
function now()
{
	date_default_timezone_set ("Africa/Cairo");
	return date("Y-m-d h:i:s:a");
}


/*
DESCRIPTION:

function now();
This function return the value of the current time

*/
?>















<?php
/*
file.php

Summary:


function getFileLinesToArray($fileDirectory);

function printFile($fileDirectory);
function printDieFile($fileDirectory);


function printFileCode($fileDirectory);
function printDieFileCode($fileDirectory);





function getAllSubDrectories($path)
function getAllSubFiles($path)



*/




function getFileLinesToArray($fileDirectory)
{
	$fileLines= array() ; 
	if(file_exists($fileDirectory))
	{$myfile = fopen($fileDirectory, "r") 
		or die("Unable to open file!");}
	else
	{return array();}



	// Output one line until end-of-file
	while(!feof($myfile)) 
	{
        $newLine = count ($fileLines);
  	    $fileLines[$newLine] = "" . fgets($myfile);
	}
	fclose($myfile);
	return $fileLines;
}


function printFile($fileDirectory)
{
	$myfile = fopen($fileDirectory, "r") or die("Unable to open file!");
	// Output one line until end-of-file
	while(!feof($myfile)) 
	{
  	echo htmlspecialchars(fgets($myfile)) . "<br>";
	}
	fclose($myfile);
}


function printDieFile($fileDirectory)
{
	$counter=0;
	$myfile = fopen($fileDirectory, "r") or die("Unable to open file!");
	// Output one line until end-of-file
	while(!feof($myfile)) 
	{
	$line=fgets($myfile);
	if($counter==0){$counter++; continue;}
  	echo htmlspecialchars($line) . "<br>";
	}
	fclose($myfile);
}









function printFileCode($fileDirectory)
{
	print('<div class="code" >');

	printFile($fileDirectory);
	
	print('</div>');
}


function printDieFileCode($fileDirectory)
{
	print('<div class="code" >');

	printDieFile($fileDirectory);
	
	print('</div>');
}




















function getAllSubDrectories($path)
{
$dir = new DirectoryIterator($path);

$toReturn = array ( ) ;

foreach ($dir as $fileinfo)
{
if ($fileinfo->isDir() && !$fileinfo->isDot())
{
array_push ( $toReturn , $fileinfo->getFilename ( ) );
}
}

return $toReturn ;
}















function getAllSubFiles($path)
{
$dir = new DirectoryIterator($path);

$toReturn = array ( ) ;

foreach ($dir as $fileinfo)
{
if (!$fileinfo->isDir() && !$fileinfo->isDot())
{
array_push ( $toReturn , $fileinfo->getFilename ( ) );
}
}

return $toReturn ;
}



?>

































































<?php

/*
form.php

*/

/*
Summary:
function checkValidString($stringIn,$charArray);
function explainInvalidString($stringIn,$charArray);
function expectedChars($inString,$maxSize,$inArray);
function explainExpectedChars($inString,$maxSize,$inArray);
function simpleClean($input,$allowed,$maxSize)

*/








function
checkValidString
($stringIn,$maxSize,$charArray)
{
	$chars=count($charArray);
		$s=explainInvalidString
		($stringIn,$maxSize,$charArray);
	$n=strlen($s);
	if($n==0){return true;}
	else{return false;}
}


function
explainInvalidString($stringIn,$maxSize,$charArray)
{
	/*if(checkValidString($stringIn,$charArray))
		{return "vaild values";}*/
	if(strlen($stringIn)>$maxSize)
		{return 
			"Maximum allowed number of letters is $maxSize";
		}


	$invalidArray=array();
	$invalidN=0;
	$chars=count($charArray);
	$letters=strlen($stringIn);
	$currentIn="";
	$currentChar="";
	for($i1=0;$i1<$chars;$i1++)
	{$currentIn=$charArray[$i1];
		for($i2=0;$i2<$letters;$i2++)
		{$currentChar=charAt($stringIn,$i2);
			if($currentIn==$currentChar)
			{$invalidArray[$invalidN++]=$currentIn;}
		}
	}

	if(count($invalidArray)==0){return "";}



	$toReturn="These characters( ";
	for($i=0;$i<(count($invalidArray));$i++)
	{
		$toReturn=$toReturn.$invalidArray[$i];
	}

	$toReturn=$toReturn." )are invalid";
	return $toReturn;
}







function
expectedChars ($inString,$maxSize,$inArray)
{
	$s=explainExpectedChars($inString,$maxSize,$inArray);
	$n=strlen($s);
	if($n==0){return true;}
	else{return false;}
}








function explainExpectedChars($inString,$maxSize,$inArray)
{
	$len1=strlen($inString);
	$len2=count($inArray);
	if($len1>$maxSize)
		{return "Maximum allowed number of letters is $maxSize";}


	$notAllowed=false;

	$toReturn="These characters are not allowed(";
	//echo($toReturn."<br>");
	$equalz=false;
	for($i1=0;$i1<$len1;$i1++)
	{$equalz=false;
		$c1=charAt($inString,$i1);
		for($i2=0;$i2<$len2;$i2++)
		{
			$c2=$inArray[$i2];
			//echo("$c1,$c2<br>");
			if($c1===$c2)
			{
				//echo("I got It<br>");
				$equalz=true;break;
			}
		}
		if($equalz){continue;}
		$toReturn=$toReturn.$c1;
		//echo($toReturn."<br>");
		$notAllowed=true;
	}
	$toReturn=$toReturn.")";
	if($notAllowed){return $toReturn;}
	return "";

}


function simpleClean($input,$allowed,$maxSize)
{

	$input=$input."";
	$maxSize=$maxSize+0;


	$toReturn="";
	$length=strlen($input);
	for($i=0;$i<$length;$i++)
	{
		$c=charAt($input,$i);
		foreach ($allowed as $key => $value) 
		{
			if($value===$c)	
			{$toReturn=$toReturn.$c;break;}
		}
	}
	$finalLength=strlen($toReturn);
	if($finalLength<=$maxSize)
		{return $toReturn;}
	return cutString($toReturn,0,$maxSize);

}








/*
DESCRIPTION:




function checkValidString($stringIn,$charArray);
true:valid;false:invalid
This function checks if this string is valid or invalid
Inputs: 
-$stringIn: String to be checked
-$charArray: array of characters to be checked
if the string contains any of these characters it will return false
else: it will return true



function explainInvalidString($stringIn,$maxSize,$charArray);






function expectedChars ($inString,$maxSize,$inArray);
When inputing a form some character can only be expected
Because we are afraid this user might be a hacker.
We are very concerned.
$inString=The string to be checked
$inArray=an array of char to chek weather they are the only chars that exist in this tring or not.
$maxSize= int of the maximum characters - It's important,1000000 characters used by a hacker can stop the website for ever causing consumption of resources
Return true:all chars are expected
return false: there is an unexpected char
NOTE:CHARACTERS IN THE $inArray MUST BE STRINGS. THEY MUST MATCH IN VALUE AND TYPE



function explainExpectedChars($inString,$maxSize,$inArray);
This funtion is used to print the error if there is one
If there is no error it will return string with zero length


function simpleClean($input,$allowed,$maxSize);
	-Inputs: 
	$input: a string to be cleaned
	$allowed: an array of allowed letters
	$maxSize:  max size to return
	-Function: remove all the letters in the input that
	are not in the allowed array
	then if it was less than the max size, return
	the clean letters
	else: get the first max size letters 
	-Return: clean string


*/


?>

























<?php
/*




get.php


Summary:
This file is about handling and transfering non sensetive
data via the get method
This files contains only functions

Example: sending message to the confirm page
sending links to redirect to the confirm page



function myGetRedirect($link,$array);
function generateGet($link,$array);
function genereteHRefString($buttonText,$herf);
function sendConfirmPhp
($confirmLocation,$redirect,
	$message="",$name1="",$link1="",$name2="",$link2="",
	$name3="",$link3="",$name4="",$link4="",$name5="",$link5="");
function getHiddenButtonPost
($nameValueAssocArray,$buttonName,$to);
function getHiddenTextInputOfForm($name,$value);
*/

function myGetRedirect($link,$array=array())
{
	header("Location: ".generateGet($link,$array));
	die();
}





function generateGet($link,$array)
{
	$string=$link."?";
	foreach ($array as $key => $value) 
	{
		$keyModified=htmlspecialchars($key);
		$valueModified=htmlspecialchars($value);
		$string=$string.$keyModified."=".$valueModified."&";
	}
	$string=removeLastChar($string);
	return $string;
}



function genereteHRefString($buttonText,$href,$classes="")
{
	$s="<a href='".htmlspecialchars($href)."'>".
	htmlspecialchars($buttonText)."</a>";
	return $s;
}




function sendConfirmPhp
($confirmLocation,$redirect,
	$message="",$name1="",$link1="",$name2="",$link2="",
$name3="",$link3="",$name4="",$link4="",$name5="",$link5="")
{
	$link=$confirmLocation;
	$array=array();
	$array["redirect"]=$redirect;
	if(strlen($message)>0)
	{$array["message"]=$message;}

	if(strlen($name1)>0)
	{$array["name1"]=$name1;$array["link1"]=$link1;}
	if(strlen($name2)>0)
	{$array["name2"]=$name2;$array["link2"]=$link2;}
	if(strlen($name3)>0)
	{$array["name3"]=$name3;$array["link3"]=$link3;}
	if(strlen($name4)>0)
	{$array["name4"]=$name4;$array["link4"]=$link4;}
	if(strlen($name5)>0)
	{$array["name5"]=$name5;$array["link5"]=$link5;}

	//var_dump($array);
	//print(generateGet($link,$array));

	myGetRedirect($link,$array);
	die();
}



function getHiddenButtonPost
($nameValueAssocArray,$buttonName,$to)
{
	if(count($nameValueAssocArray)==0){return "";}
	$toReturn='<form method="post" action="'.
		htmlspecialchars($to).'">';

	foreach ($nameValueAssocArray as $key => $value) 
	{
		$toReturn=$toReturn.
		getHiddenTextInputOfForm($key,$value);
	}

	$toReturn=$toReturn.'<input type="submit" value="'.
		htmlspecialchars($buttonName).
		'" ></form>';

	return $toReturn;
/*<form method="post" action="mob_add_fast.php">
	<input type="text" name="mobileToAdd" value="a" hidden>
	<input type="submit" value="Add" >
</form>*/
}


function getHiddenTextInputOfForm($name,$value)
{
	if(strlen($name)==0){return "";}
	$toReturn='<input type="text" name="'.
	htmlspecialchars($name).
	'" value="'.htmlspecialchars($value).
	'" hidden>';
//<input type="text" name="mobileToAdd" value="a" hidden>
	return $toReturn;
}


/*
DESCRIPTION:

function myGetRedirect($link,$array);
This function redirects to the link page and passes the values
of the assoc array as get variables
This can be used or non sensitive information only


function generateGet($link,$array);
This function generates the url for the link with the values to 
pass in the get method
$link: url to be passed
$array: accos array name=>value
This function generates only the text, and doesn't redirect.



function genereteHRefString($buttonText,$herf);
This function generates the text of the <a herf="">test</a>
We want to print it on the website sometimes



function sendConfirmPhp
($confirmLocation,$redirect,
$message="",$name1="",$link1="",$name2="",$link2="",
$name3="",$link3="",$name4="",$link4="",$name5="",$link5="");
This function is used on any page to send data to confirm.php
The only must is sending a redirect
The others are optional
Of course all these data will be using the get method

$confirmLocation(must): location of the confirm.php file
(The file that sends the data could be inside a file or outside of it)
Examples: confirm.php , ../confirm.php

$redirect(must): is the redirect location (in the confirm it known)

$message(optional): Revise the confirm.php file
$Name1,$link1(optional): things in the confirm.php file
Read them if you want to
Note: if you write name1 you must write link 1
No error will happen if you don't
Just don't do it



function getHiddenButtonPost
($nameValueAssocArray,$buttonName,$to);
This function creats a form, returns the text of the form
all the data in this form are not displayed to the user
The data is hidden
the is only thing the user can see is the button with the
$button name value written on it
When pressing the button the user will be redirected
To the page($to) and data is passed

$nameValueAssocArray:
is an associative array of the names and values
array(name1=>value1,name2=>value2);
$_POST["name1"]=value1;$_POST["name2"]=value2;

$buttonName: 
the text written on the button that the user will
press on
Example: for the mobles of the account
for each mobile: "verify" button and "DeleteButton"

$to: the page that the user will be redirected to 
when pressing this form



function getHiddenTextInputOfForm($name,$value);
This function returns the string of hidden text input
It can be used inside getHiddenButtonPost function
for each element in the array

*/


?>








































<?php


/*head.php*/
function setHeadOfPage($input)
{
	$title="";
	$description="";
	$keyWords="";
	if($input=="index.php")
	{
		$title="Kanteene";
		$description="Shop online from the nearest Super-Market, Pharmacy, or Grocery.";
		$keyWords="Kanteene,Shop,Online,Pharmacy,Super-Market, Grocer";
	}

	elseif($input=="signup.php")
	{
		$title="Sign Up - Kanteene";
		$description="Sign up for Kanteene.com";
		$keyWords="Sign Up,Kanteene,Shop,Online,Pharmacy,Super-Market, Grocer";
	}
	elseif ($input=="login.php")
	 {
		$title="Login - Kanteene";
		$description="Login Kanteene.com";
		$keyWords="Login,Kanteene,Shop,Online,Pharmacy,Super-Market, Grocer";
	}
	elseif($input=="rememberme.php")
	{
		$title="Remember Me - Kanteene";
		$description="Quick account for Kanteene.com";
		$keyWords="Remember Me, Quick Account, Login,Kanteene,Shop,Online,Pharmacy,Super-Market, Grocer";
	}

	echo(fillHeadOfPage
	($title,$description,$keyWords));
}





function fillHeadOfPage
($title,$description,$keyWords)
{

	$toReturn1=
	'<title>';
	$toReturn2=
	$title;
	$toReturn3=
	'</title>

	<meta charset="UTF-8">
<meta name="description"
content="';
	$toReturn4=$description;
	$toReturn5=
	'">
<meta name="keywords"
content="';
	$toReturn6=$keyWords;
	$toReturn7=
	'">
<meta name="author"
content="Omar Magdy">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">



<!--
<link rel="alternate" hreflang="x-default" href="http://www.kanteene.com/" />
-->
'. getStyleSheet().'
<link rel="shortcut icon" href="images/favicon.png">';



$toReturn=$toReturn1.$toReturn2.$toReturn3.$toReturn4.$toReturn5.$toReturn6.$toReturn7;
return $toReturn;

}





function getStyleSheet()
{return '<link rel="stylesheet" type="text/css" href="css/default.css">';}




?>

































<?php
/*

includes.php


Summary:


function inclu($level);



*/







function inclu($level)
{
	$deep="";
	for($i=1;$i<$level;$i++)
	{
		$deep=$deep."../";
	}


	require_once($deep."php/cookies.php");
	require_once($deep."php/date.php");
	require_once($deep."php/file.php");
	require_once($deep."php/form.php");
	require_once($deep."php/get.php");
	require_once($deep."php/hackattempt.php");
	require_once($deep."php/head.php");
	require_once($deep."php/lines.php");
	require_once($deep."php/session.php");
	require_once($deep."php/sql.php");
	require_once($deep."php/string.php");
	require_once($deep."php/table.php");
	require_once($deep."php/validation.php");
	
	require_once($deep."php/must.php");



	require_once($deep."php_special/responsive.php");
}



/*




function inclu($level);
This function is used to include things for
 any page on the website
$level=1:for pages like index.php
level=2:for pages inside a single file
level=3:pages inside a file inside a file
.
.
.

*/



?>





























<?php
/*

/*sql.php*/

Summary:

function connectSQL();
function getNewId($inputTableName);

1) Select
function sqlSelect($fields,$tName,$condition);
function sqlSelectField($tName,$field);


2) Insert
function sqlSafeInsert($tableName,$fieldNamesArray,$values);
function sqlSafeInsertInhanced($tableName,$assocNamesValues);

3) Update
function safeSqlUpdate
($tableName,$id,$fieldNamesArray,$values);
function sqlSafeUpdateInhanced
($tableName,$id,$assocNamesValues);



4) Search
function safeSqlFastSearch($tableName,$field,$query);


5) table
function sqlCreateTable($tableName,$fieldsString);
function sqlDropTable($tableName);
function sqlDeleteTableContent($tableName);


6) delete
function sqlDelete($tableName,$condition);


*/






//$handler=connectSQL();



function connectSQL()
{
	
	

$hostData="mysql:host=localhost;dbname=test";
$username="root";
$password="";

try{
$handler=new PDO($hostData,$username,$password);
$handler->setAttribute
(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $e)
{
	echo $e->getMessage();
	die();
}
return $handler;
	
	
}











function getNewId($inputTableName)
{
	global $handler;
	$sql=
	"SELECT * FROM $inputTableName";
	try 
	{
		$query=$handler->query($sql);
		$newId=0;
		while($r=$query->fetch())
		{
			//var_dump(($r['id']+0));
			if($r['id']>$newId)
			{$newId=$r['id'];}
		}
		$newId++;
		return $newId;
	} 
	catch (Exception $e) 
	{
		return false;
	}

	
}



//1) Select

function sqlSelect($fields,$tName,$condition)
{
	global $handler;
	$sql="";
	if(strlen($condition)==0)
	{
		$sql="SELECT $fields FROM $tName";
	}
	else
	{
		$sql=
		"SELECT $fields FROM $tName WHERE $condition";
	}

	$query=$handler->query($sql);
	$results=$query->fetchAll(PDO::FETCH_ASSOC);
	return $results;

}



function sqlSelectField($tName,$field)
{
	$data=sqlSelect("id,".$field,$tName,"");
	//var_dump($data);
	$max=count($data);
	$toReturn=array();
	for($i=0;$i<$max;$i++)
	{
		$toReturn["".$data[$i]["id"].""]=
		$data[$i][$field];
	}
	//var_dump($toReturn);
	//$toReturn["80"]="here";
	return $toReturn;
}





//2) Insert



function sqlSafeInsert
($tableName,$fieldNamesArray,$values)
{

	$nFields=count($fieldNamesArray);
	$nValues=count($values);
	if($nFields!=$nValues)
	{
		echo("<br>data->sql.php->safeSqlInsert->nFields!=nValues<br> I will generate an error so that you can know what up!");
		if($errorValue<$error2Value){echo("error");}

	}

	$sqlVariables=array();
	for($i=0;$i<$nValues;$i++)
	{
		$sqlVariables[$i]=":id$i";

	}

	$sqlVariablesString=
	arrayToString($fieldNamesArray,",");
	$sqlValuesString=
	arrayToString($sqlVariables,",");

	//var_dump($sqlVariablesString);

	global $handler;
	$sql=
	"INSERT INTO $tableName ($sqlVariablesString) VALUES 
	($sqlValuesString)";
	//echo("<br>");echo($sql);

	$query=$handler->prepare($sql);

	$toBeExecuted=array();
	for($i=0;$i<$nValues;$i++)
	{
		$toBeExecuted[$sqlVariables[$i]]=$values[$i];
	}

	//var_dump($toBeExecuted);

	$query->execute($toBeExecuted);
	//echo("<br>");
	//var_dump($toBeExecuted);
	//echo("<hr>");


	//var_dump(array("1"=>1,"2"=>2));
}








function sqlSafeInsertInhanced($tableName,$assocNamesValues)
{
	$fields=array();
	$values=array();
	$counter=0;
foreach($assocNamesValues as $field => $value) {
    $fields[$counter]=$field;
    $values[$counter]=$value;
    $counter++;
}

//var_dump($fields);
//var_dump($values);

sqlSafeInsert($tableName,$fields,$values);

}



//3) Update

function safeSqlUpdate
($tableName,$id,$fieldNamesArray,$values)
{
	$nFields=count($fieldNamesArray);
	$nValues=count($values);
	if($nFields!=$nValues)
	{
		echo("<br>data->sql.php->safesql update->nFields!=nValues<br> I will generate an error so that you can know what up!");
		if($errorValue<$error2Value){echo("error");}

	}

	$sqlSetArray=array();
	for($i=0;$i<$nValues;$i++)
	{
		$sqlSetArray[$i]=
		$fieldNamesArray[$i]."=:id$i";
	}

	$sqlSetString=
	arrayToString($sqlSetArray,",");

	//echo($sqlSetString);

	global $handler;
	$sql=
	"UPDATE $tableName SET $sqlSetString 
	WHERE id=$id";
	//echo("<br>");echo($sql);

	$query=$handler->prepare($sql);

	$toBeExecuted=array();
	for($i=0;$i<$nValues;$i++)
	{
		$toBeExecuted[":id$i"]=$values[$i];
	}
//var_dump($toBeExecuted);

	$query->execute($toBeExecuted);
//echo("<br>");
//echo("<hr>");

}









function sqlSafeUpdateInhanced
($tableName,$id,$assocNamesValues)
{
	$fields=array();
	$values=array();
	$counter=0;
foreach($assocNamesValues as $field => $value) {
    $fields[$counter]=$field;
    $values[$counter]=$value;
    $counter++;
}
//echo("fields<br>");
//var_dump($fields);
//echo("values");

//var_dump($values);

safeSqlUpdate($tableName,$id,$fields,$values);

}


//4) Search
function safeSqlFastSearch($tableName,$field,$query)
{
	$tableName=$tableName."";
	$field=$field."";
	$query=$query."";

	$data=sqlSelectField($tableName,$field);
	$toReturn=array();
	foreach ($data as $id=>$value) 
	{
		if(!simpleStringSearch($value,$query))
			{continue;}
		$toReturn=
		addArray(array($toReturn,array($id)));
	}
	return $toReturn;
}



//5) table
function sqlCreateTable($tableName,$fieldsString)
{
	/*
	The sql text looks like this
	CREATE TABLE Persons 
	(PersonID int,LastName varchar(255),
	FirstName varchar(255),Address varchar(255),
	City varchar(255))
	*/

	$sql="CREATE TABLE ".$tableName." (".$fieldsString.")";
	global $handler;
	
	try 
	{$query=$handler->query($sql);}

	catch (Exception $e) 
	{return false;}
	return true;
}


function sqlDropTable($tableName)
{
	/*This is the sql command
	"DROP TABLE table_name"*/
	$sql="DROP TABLE ".$tableName;
	global $handler;
	try 
	{$query=$handler->query($sql);}
	catch (Exception $e) 
	{return false;}
	return true;
}

function sqlDeleteTableContent($tableName)
{
	/*the sql command looks like this
	"TRUNCATE TABLE table_name"*/
	$sql="TRUNCATE TABLE ".$tableName;
	global $handler;
	try 
	{$query=$handler->query($sql);}
	catch (Exception $e) 
	{return false;}
	return true;
}





//6) delete
function sqlDelete($tableName,$condition)
{
	$tableName=$tableName."";
	$condition=$condition."";
	if(strlen($condition)!==0)
		{$condition="WHERE ".$condition;}
	//"DELETE FROM table_name WHERE condition;"
	$sql="DELETE FROM ".$tableName." ".$condition;
	global $handler;
	try 
	{$query=$handler->query($sql);}
	catch (Exception $e) 
	{return false;}
	return true;
}




/*
Description:






function connectSQL();
This connects to the database where everything exists
There is also teh ahndeler as a gobal variable
specailly that this handler is connected to the database
and it should be used later



function getNewId($inputTableName);
This function creats a loop insde the (id) parameter of all records of the given table name
and gets the maximum
Then adds 1 to this value
this is the new id to be used when you want to insert a new thing to the table


1) Select
function sqlSelect($fields,$tName,$condition);
instead of writing the select staff every time, think lazy

function sqlSelectField($tName,$field)
	-Function: get the full field inside a table
	-Return: associative array
	id=>field
	-Note: in the table there must be an "id" field
	If there was no table, there is no id field in the
	table, or the field doesn't exist
	An unhandled sql will happen


2) Insert
function
sqlSafeInsert($tableName,$fieldNamesArray,$values);
This function inserts into sql tables the required data
$tablename: string
$fieldNamesArray: array of strings of the values
$values: array of the values to be inserted



function sqlSafeInsertInhanced($tableName,$assocNamesValues);
$tableName=the name of the table
$assocNamesValues=
an associative array field=>value






3) Update

function safeSqlUpdate
($tableName,$id,$fieldNamesArray,$values);
To update things safely using sql and PDO










function
sqlSafeUpdateInhanced
($tableName,$id,$assocNamesValues);
Update using associative arrays instead of using normal arrays to make it easier and more readable
$tableName: name of the table
$id: id in the table for the date to be inserted
$assocNamesValues: associative array
array("fieldName"=>"value");




4) Search
function safeSqlFastSearch($tableName,$field,$query);
	-Inputs:of this functions are The table name 
	The field to be searched and the query to be
	Looked 
	(Note: in the table there must be a "id" field)
	-Function: return the ids of the records that 
	has this exact query in the text
	Return: an array of the "id"s of the records
	-Note: if the table name or the field doesn't exist
	an unhandeled sql will occur




5) table
function sqlCreateTable($tableName,$fieldsString);
	-The sql to be excuted looks like this
	CREATE TABLE Persons 
	(PersonID int,LastName varchar(255),
	FirstName varchar(255),Address varchar(255),
	City varchar(255))
	-Inputs:Table name, the name of the table to be created
	Field string: is "PersonID int,LastName varchar(255),..."
	-Function: create a table in the kanteene database
	with the given table name and the given details
	-Return: true: able to perform, false: unable

function sqlDropTable($tableName);
	-The sql command looks like this
	"DROP TABLE table_name"
	-Function: drop the table in the kanteene database
	with the given name
	-Return: true: able to perform, false: unable


function sqlDeleteTableContent($tableName);
	-The sql command looks like this
	"TRUNCATE TABLE table_name"
	-Function: delete the content of the table with given
	name, but leave the table itself
	-Return: true: able to perform, false: unable



6) delete
function sqlDelete($tableName,$condition);
	-The sql command looks like this
	"DELETE FROM table_name WHERE condition;"
	-Function: delete the a specific record or records
	-Return: true: able to perform, false: unable




*/




?>


































<?php



/*string.php*/




/*SummaryFunctions*/
/*
//High Level
function splitString($stringIn,$chara);

function stringToAssocArray($stringIn,$seperator1,$seperator2);
function assocArrayToString ($arrayIn,$seperator1,$seperator2);
function 
stringToArrayOfArrays($string,$seperator1,$seperator2);
function arrayOfArraysToString($array,$seperator1,$seperator2);
function addAssocArray($arrayOfArrays);
function addArray($arrayOfArrays);
function isNewString($string1,$string2,$seperator);


//Low Level
function arrayToString($inputArray,$seperator);
function charAt($stringIn,$number);
function cutString($stringIn,$from,$to);
function findInString($stringIn, $chara);
function removeLastChar($stringIn);
function removeFirstChar($stringIn);
function simpleStringSearch($stringIn,$query);

*/

/*test*/






/*High Level*/





function
splitString
($stringIn,$chara)
{
	$toReturn=array();
	$n=0;
	$locations=findInString($stringIn,$chara);
	//var_dump($locations);
	$nMax=count($locations);
	if($nMax==0)
		{
			$toReturn[0]=$stringIn;
			return $toReturn;
		}

	$toReturn[$n++]=cutString($stringIn,0,($locations[0]));
	for($i=0;$i<($nMax-1);$i++)
	{
		$toReturn[$n++]=
		cutString
		($stringIn,($locations[$i]+1),($locations[$i+1]));
	}
	$toReturn[$n++]=
	cutString
	($stringIn,$locations[$nMax-1]+1,
		(strlen($stringIn)));
	return $toReturn;

}









function
stringToAssocArray($stringIn,$seperator1,$seperator2)
{
	$lvl1Array=splitString($stringIn,$seperator1);
	$toReturn=array();
	$n=count($lvl1Array);

	$index="";
	$value="";
	$subString="";
	for($i=0;$i<$n;$i++)
	{
		$subString=$lvl1Array[$i];

		$subArray=splitString($subString,$seperator2);
		//var_dump($subArray);
		$index=$subArray[0];
		if(isset($subArray[1]))
		{$value=$subArray[1];}
		else{$value="";}
		if(strlen($index)==0)
			{if(strlen($value==0)){continue;}}
		
		$toReturn[$index]=$value;
	}
return $toReturn;


}





function assocArrayToString
($arrayIn,$seperator1,$seperator2)
{
	$toReturn="";
	foreach($arrayIn as $index=>$value)
	{
		if($index=="")
			{if($value==""){continue;}}
		$toReturn=
		$toReturn.$index.$seperator2.$value.$seperator1;
	}
	$toReturn=removeLastChar($toReturn);
	return $toReturn;
}





function 
stringToArrayOfArrays($string,$seperator1,$seperator2)
{
	$string=$string."";
	if(strlen($string)===0){return array();}
	$arraysLvl1=splitString($string,$seperator1);
	$arraysLvl2=array();
	$subArray=array();
	foreach ($arraysLvl1 as $key => $value) 
	{
		$subArray=splitString($arraysLvl1[$key],$seperator2);
		$arraysLvl2=addArray
		(array($arraysLvl2,array($subArray)));
	}
	return $arraysLvl2;
}


function arrayOfArraysToString($array,$seperator1,$seperator2)
{
	if(count($array)===0){return "";}
	$arrayOfStrings=array();
	foreach ($array as $key => $value) 
	{
		$arrayOfStrings=addArray
		(array($arrayOfStrings,array(
			arrayToString($value,$seperator2))));
	}
	return arrayToString($arrayOfStrings,$seperator1);
}







function addAssocArray($arrayOfArrays)
{
	$theArray=array();
	$n=count($arrayOfArrays);
	for($i=0;$i<$n;$i++)
	{
		foreach ($arrayOfArrays[$i] as $key => $value) 
		{
			$theArray[$key]=$value;
		}
	}
return $theArray;
}






function addArray($arrayOfArrays)
{
	$theArray=array();
	$n=count($arrayOfArrays);
	//var_dump($n);
	for($i=0;$i<$n;$i++)
	{
		//var_dump($arrayOfArrays[$i]);
		foreach ($arrayOfArrays[$i] as $value) 
		{
			//var_dump($value);
			array_push($theArray, $value);
			//print("Pushin<br>");
		}
	}
	return $theArray;
}





function isNewString($string1,$string2,$seperator)
{
	if(strlen($string2)==0){return false;}
	if(strlen($string1)==0){return true;}
	$array=splitString($string1,$seperator);
	foreach($array as $value)
		{if($value==$string2){return false;}}
	return true;
}




/*Low Level*/






function arrayToString
($inputArray,$seperator)
{
	$n=count($inputArray);
	if($n==0){return "";}
	$toReturn="";
	for($i=0;$i<($n-1);$i++)
	{$toReturn=$toReturn.($inputArray[$i].$seperator);}
$toReturn=$toReturn.$inputArray[$n-1];
return $toReturn;
}








function
charAt($stringIn,$number)
{
	$toReturn=$stringIn[$number];
	return $toReturn;
}





function
cutString($stringIn,$from,$to)
{
	$lenght=$to-$from;
	return substr
	($stringIn, 
		$from,
		 $lenght);
}





function
findInString
($stringIn, $chara)
{
	$current=0;
	$locations=array();
	//var_dump($stringIn);
	$max=strlen($stringIn);
	//var_dump($max);
	for($i=0;$i<$max;$i++)
		{
			$s=charAt($stringIn,$i);
			//var_dump($s);
			if($s==$chara)
			{
				$locations[$current]=$i;
				$current++;
			}
		}

	return $locations;
}


function removeLastChar($stringIn)
{
	return cutString
($stringIn,0,(strlen($stringIn)-1));
}

function removeFirstChar($stringIn)
{
	return cutString
($stringIn,1,(strlen($stringIn)));
}


function simpleStringSearch($stringIn,$query)
{
	$stringIn=$stringIn."";
	$query=$query."";
	$length=strlen($stringIn);
	$l=strlen($query);
	if($l>$length){return false;}
	$max=$length-$l;
	//print("<br> ");
	for ($i=0; $i <=$max; $i++) 
	{ 
		$s=substr($stringIn,$i,$l);
		//print($s." ");
		if($s===$query){return true;}
	}
	return false;
}




/*
Description:



//High Level




splitString($stringIn,$chara);
return value: array of strings
there is a splitter chara
NOTE: THE SPLITTER CAN NOT BE AT THE BEGINNING OF THE STRING NOR AT THE END OF IT
test
$s="111,222,333,444";
print_r(splitString($s,","));
//Array ( [0] => 111 [1] => 222 [2] => 333 [3] => 444 ) 
$s="111,222";
print_r(splitString($s,","));
//Array ( [0] => 111 [1] => 222 )
$s="111";
print_r(splitString($s,","));
Array ( [0] => 111 )







function
stringToAssocArray($stringIn,$seperator1,$seperator2);
splits string to associative array

Test: more than one value
var_dump(stringToAssocArray("abcd,dcba;xyz,zyx",";",","));
C:\wamp\www\kant\index.php:78:
array (size=2)
  'abcd' => string 'dcba' (length=4)
  'xyz' => string 'zyx' (length=3)

Test: only one value
var_dump(stringToAssocArray("abcd,dcba",";",","));
C:\wamp\www\kant\index.php:76:
array (size=1)
  'abcd' => string 'dcba' (length=4)

Test: no values
var_dump(stringToAssocArray("",";",","));
C:\wamp\www\kant\index.php:76:
array (size=0)
  empty



function assocArrayToString
($arrayIn,$seperator1,$seperator2);
$s="01234567890,v;01234567891,u;01234567892,v";
$array=sqlGetMobileArray($s);
var_dump(assocArrayToString($array,";",","));
//'01234567890,v;01234567891,u;01234567892,v'



function 
stringToArrayOfArrays($string,$seperator1,$seperator2);
	-Function: thing1,holder1,owner1;thing2,holder2,owner2
	Sometimes such strings exist, we need to handle them
	in the form of an array
	-Return: array of arrays: able to perform,
	empty array: empty string
	The array of arrays we seek looke like this
	[0]{[0]=thing1,[1]=holder1,[2]=owner1}
	[1]{[0]=thing2,[1]=holder2,[2]=owner2}


function arrayOfArraysToString($array,$seperator1,$seperator2);
	-Function: 
	[0]{[0]=thing1,[1]=holder1,[2]=owner1}
	[1]{[0]=thing2,[1]=holder2,[2]=owner2}
	Sometimes such array of arrays exist, we need to handle 
	them in the form of an string
	Return: string: able to perform,
	empty string: empty array







function addAssocArray($arrayOfArrays);
The input is an array of  assoctaive arrays



function addArray($arrayOfArrays);
This function merges arrays in a single array



function isNewString($string1,$string2,$seperator);
This function checks whether or not this is a new string
$string1: the source
$string2: to be checked
$seperator: what sesperates
return true: new string
return false: old string



//Low Level


//strlen(); returns String length
substr(string, start, length(optional));
echo substr("Hello world",1)."<br>"; ello world
echo substr("Hello world",-10)."<br>"; ello world
print_r(substr("HiThere", 1,3)); iTh



arrayToString($inputArray,$seperator);
It's obvious, see this example
$strings=array();
$strings[0]=0;$strings[1]=1;$strings[2]=2;
$strings[3]=3;$strings[4]=4;$strings[5]=5;
$seperator=";";
echo("<br>".ArrayToString($strings,$seperator)."<br>");
//0;1;2;3;4;5

if only string[0]=0;
//0



cutString($stringIn,$from,$to);
returns a string
equivalent to substr();
standard function in php
The difference is the input



findInString($stringIn, $chara);
return an array of numbers
they are the locations of this caharacter
in this string
example:
$test=",111,222,333,";
print_r(findInString($test,","));
//Array ( [0] => 0 [1] => 4 [2] => 8 [3] => 12 ) 



function removeLastChar($stringIn);
function removeFirstChar($stringIn);
$s="abcde";
var_dump(removeLastChar($s));//'abcd'
var_dump(removeFirstChar($s));//'bcde'


function simpleStringSearch($stringIn,$query);
	-Inputs: the inpts here are the the string to
	be searched, and the query to search
	-Function: We need to know whether the same exact
	query exists or not, so we will walk through 
	each ammount of charachters looking for equality
	-Return: true: exist, false: not matching






*/

?>





































<?php

/*
/*table.php*/

Summary:

function getTableOfArray_arrayNotSpecial
($headingString, $string, $headingSeperator, $rowSep, $colSep);

function getTableOfArray_arraySpecial
($headingString, $string, $headingSeperator, $rowSep, $colSep);

function printTableToCopy
($headingString, $string, $headingSeperator, $rowSep, $colSep);

*/

function getTableOfArray_arrayNotSpecial
($headingString, $string , $headingSeperator, $rowSep, $colSep)
{
	$toReturn='<table ><tr>';
	$headingArray = 
	splitString($headingString,$headingSeperator);
	
	foreach ($headingArray as $key => $value) 
	{
		$toReturn=$toReturn."<th>".$value."</th>";
	}	
	$toReturn = $toReturn . "</tr>";
	$rows = splitString($string,$rowSep);

	//var_dump($rows);

	foreach ($rows as $keys1 => $row) 
	{
		if ($string==="") 
		{
			break;
		}
		$toReturn = $toReturn . "<tr>";

		$elements= 
		splitString($row,$colSep);

		foreach ($elements as $keys2 => $element) 
		{
			$toReturn =$toReturn . "<td>$element</td>";
		}
		$toReturn = $toReturn . "</tr>";
	}

	$toReturn=$toReturn."</table>";
	return $toReturn;
}

function getTableOfArray_arraySpecial
($headingString, $string, $headingSeperator, $rowSep, $colSep)
{
	$toReturn='<table ><tr>';
	$headingArray = 
	splitString($headingString,$headingSeperator);
	
	foreach ($headingArray as $key => $value) 
	{
		$toReturn=$toReturn."<th>".
		htmlspecialchars($value)."</th>";
	}	

	$toReturn = $toReturn . "</tr>";
	$rows = splitString($string,$rowSep);

	//var_dump($rows);

	foreach ($rows as $keys1 => $row) 
	{
		if ($string==="") 
		{
			break;
		}
		$toReturn = $toReturn . "<tr>";

		$elements= 
		splitString($row,$colSep);

		foreach ($elements as $keys2 => $element) 
		{
			$toReturn =$toReturn . "<td>".
			htmlspecialchars($element)."</td>";
		}
		$toReturn = $toReturn . "</tr>";
	}

	$toReturn=$toReturn."</table>";
	return $toReturn;
}



function printTableToCopy
($headingString, $string, $headingSeperator, $rowSep, $colSep)
{
	$toReturn=
	htmlspecialchars('<table>');

	$toReturn=$toReturn."<br><br>";
	
	$toReturn=$toReturn.
	"&nbsp"."&nbsp"."&nbsp"."&nbsp"."&nbsp".
	htmlspecialchars('<tr>');
	
	$toReturn=$toReturn."<br>";


	$headingArray = 
	splitString($headingString,$headingSeperator);
	
	foreach ($headingArray as $key => $value) 
	{
		$toReturn=$toReturn.
		"&nbsp"."&nbsp"."&nbsp"."&nbsp"."&nbsp".
		"&nbsp"."&nbsp"."&nbsp"."&nbsp"."&nbsp".
		htmlspecialchars("<th>").
		htmlspecialchars($value).htmlspecialchars("</th>");
		$toReturn=$toReturn."<br>";
	}	
	$toReturn=$toReturn.
	"&nbsp"."&nbsp"."&nbsp"."&nbsp"."&nbsp".
	htmlspecialchars('</tr>');
	$toReturn=$toReturn."<br>";
	$toReturn=$toReturn."<br>";

	$rows = splitString($string,$rowSep);

	//var_dump($rows);

	foreach ($rows as $keys1 => $row) 
	{
		if ($string==="") 
		{
			break;
		}
		$toReturn = $toReturn .
		"&nbsp"."&nbsp"."&nbsp"."&nbsp"."&nbsp".
		htmlspecialchars("<tr>");
		$toReturn=$toReturn."<br>";

		$elements= 
		splitString($row,$colSep);

		foreach ($elements as $keys2 => $element) 
		{
			$toReturn =$toReturn . 
			"&nbsp"."&nbsp"."&nbsp"."&nbsp"."&nbsp".
			"&nbsp"."&nbsp"."&nbsp"."&nbsp"."&nbsp".
			htmlspecialchars("<td>").
			htmlspecialchars($element).
			htmlspecialchars("</td>");
			$toReturn=$toReturn."<br>";
		}
		//$toReturn=$toReturn."<br>";
		$toReturn = $toReturn . 
		"&nbsp"."&nbsp"."&nbsp"."&nbsp"."&nbsp".
		htmlspecialchars("</tr>");
		$toReturn=$toReturn."<br>";
		$toReturn=$toReturn."<br>";
	}

	$toReturn=$toReturn.htmlspecialchars("</table>");
	$toReturn=$toReturn."<br>";
	print($toReturn);
}



function getMobileTableString
($mobileString,$verLoc,$delLoc,$addLoc)
{
	$mobileArray=sqlGetMobileArray($mobileString);

	$toReturn='<table style="width:100%"><tr>
	<th>Mobile</th><th>Verification</th><th>Delete</th>';

	$isVerified=false;

	foreach ($mobileArray as $key => $value) 
	{
		if($value=="v"){$isVerified=true;}
		else{$isVerified=false;}
	
		$toReturn=$toReturn.
		getMobileRowInTable
		($key,$verLoc,$delLoc,$isVerified);
	}
	$toReturn=$toReturn."</table>";
	
	if(count($mobileArray)>=10)
	{
		$toReturn=$toReturn."You can't have more than 10 mobiles";
	}
	else
	{
		$toReturn=$toReturn.'<form method="post" action="'.
			htmlspecialchars($addLoc)
			.'">
	<input type="text" name="mobileToAdd" autocomplete="off">
	<input type="submit" value="Add Mobile" >
	</form>';
	}
	return $toReturn;
}


/*
Description:

function getTableOfArray_getNotSpecial
($headingString, $string, $headingSeperator, $rowSep, $colSep)
	-Inputs: 
		-$headingsArray: a string of the names of the headings
		-$string: the string to be converted to a table
		-$headingSeperator: the character that seperates
		the headings string
		-$
	-Function: generate the string of an html table.
	-Return: string of the html table
	-Note: when getting the string of the the table,
	the values inside the table will not be converted into 
	html special charaters.
	They will be as they are.


function getTableOfArray_getSpecial
($headingString, $string, $headingSeperator, $rowSep, $colSep)
	-The same as the previous function
	-Except, before adding the previous function to the 
	string it will be converted to htmlSpecial chars


function printTableToCopy
($headingString, $string, $headingSeperator, $rowSep, $colSep)
	-Inputs: the same inputs
	-Function: 
	Sometimes you want the table as html elemnts to copy them
	and paste them
	It will print to you the html elements on the screen
	so that you can copy and paste
	-Return: no Return

*/
?>




























<?php
/*

/*validation.php*/

SUMMARY:

This is not a view page
This is just a functions page
to record all the functions that we need alot about validation

Explain,Clean,Validate
Expected,Restricted

EXPECTED:
INTEGER,FLOAT,LETTERS,EMAIL

(We will start now by EXPECTED, and move later to
Restricted)

A)Expected

A1) Expected explain 
function explainExpectedInt($input,$message,$maxSize);
function explainExpectedFloat($in,$message,$max);
function explainExpectedLetters($in,$message,$max);
function explainExpectedEmail($in,$message,$max);




A2) Expected validate
function validateExpectedInt($input,$maxSize);
function validateExpectedFloat($in,$max);
function validateExpectedLetters($in,$max);
function validateExpectedEmail($in,$max);


A3) Expected clean
function cleanExpectedInt($input,$maxSize);
function cleanExpectedFloat($in,$max);
function cleanExpectedLetters($in,$max);
function cleanExpectedEmail($in,$max);





*/


//A)Expected

//A1) Expected explain 
function explainExpectedInt($input,$message,$maxSize)
{
	$input=$input."";
	$message=$message."";
	$maxSize=$maxSize+0;

	$inArray=
	array
	("+","-","0","1","2","3","4","5","6","7","8","9");	
	$explained=
	explainExpectedChars($input,$maxSize,$inArray);
	if(strlen($explained)>0)
	{
		$result=$message.
		$explained;
		return $result;		
	}

	$positiveSignLocations=
	findInString($input,"+");

	$negativeSignLocations=
	findInString($input,"-");

	$numberOfPositive=count($positiveSignLocations);
	$numberOfNegative=count($negativeSignLocations);

	

	


	if($numberOfPositive>1)
	{
		$result=$message.
		"There is more than a positive sign.";
		return $result;	
	}


	if($numberOfNegative>1)
	{
		$result=$message.
		"There is more than a negative sign.";
		return $result;	
	}





	if(isset($positiveSignLocations[0]))
		{$posLoc=$positiveSignLocations[0];}
	else{$posLoc=0;}

	if(isset($negativeSignLocations[0]))
		{$negLoc=$negativeSignLocations[0];}
	else{$negLoc=0;}

	if($posLoc!==0)
	{$result=$message.
		"The positive sign should be at the beginning of the number.";
		return $result;	
	}

	if($negLoc!==0)
	{$result=$message.
		"The negative sign should be at the beginning of the number.";
		return $result;	
	}


	return "";
}

function explainExpectedFloat($input,$message,$maxSize)
{
	$input=$input."";
	$message=$message."";
	$maxSize=$maxSize+0;
	//var_dump($input);

	$inArray=
	array
	("+","-","0","1","2","3","4","5","6",
		"7","8","9",".");	
	
	$explained=
	explainExpectedChars($input,$maxSize,$inArray);
	if(strlen($explained)>0)
	{
		$result=$message.
		$explained;
		return $result;	
	}

	$floatingPointLocations=
	findInString($input,".");

	$positiveSignLocations=
	findInString($input,"+");

	$negativeSignLocations=
	findInString($input,"-");

	$numberOfFloating=count($floatingPointLocations);
	$numberOfPositive=count($positiveSignLocations);
	$numberOfNegative=count($negativeSignLocations);


	if($numberOfFloating>1)
	{
		$result=$message.
		"There is more than a floating point.";
		return $result;	
	}
	
	if($numberOfPositive>1)
	{
		$result=$message.
		"There is more than a positive sign.";
		return $result;	
	}


	if($numberOfNegative>1)
	{
		$result=$message.
		"There is more than a negative sign.";
		return $result;	
	}

	if(isset($positiveSignLocations[0]))
		{$posLoc=$positiveSignLocations[0];}
	else{$posLoc=0;}

	if(isset($negativeSignLocations[0]))
		{$negLoc=$negativeSignLocations[0];}
	else{$negLoc=0;}

	if($posLoc!==0)
	{$result=$message.
		"The positive sign should be at the beginning of the number.";
		return $result;	
	}

	if($negLoc!==0)
	{$result=$message.
		"The negative sign should be at the beginning of the number.";
		return $result;	
	}
	return "";
}

function explainExpectedLetters($input,$message,$max)
{

	$input=$input."";
	$message=$message."";
	$max=$max+0;
	//var_dump($input);

	$inArray=
	array(
	"0","1","2","3","4","5","6","7","8","9",".",",",
	"a","b","c","d","e","f","g","h","i","j","k","l","m","n",
	"o","p","q","r","s","t","u","v","w","x","y","z",
	"A","B","C","D","E","F","G","H","I","J","K","L","M","N",
	"O","P","Q","R","S","T","U","V","W","X","Y","Z","_",
	"ا","أ","إ","ئ","ء","ب","ت","ث","ج","ح","خ","د","ذ","ر","ز","س",
	"ش","ص","ض","ط","ظ","ع","غ","ف","ق","ك","ل","م","ن","ه","و",
	"ي","ى","ئ",
	"ؤ","1","2","3","4","5","6","7","8","9","0");	


//You can find the text in validation_.txt
//This file should be opened with notepad

	$explained=
	explainExpectedChars($input,$max,$inArray);
	if(strlen($explained)>0)
	{
		$result=$message.
		$explained;
		return $result;	
	}
	return "";

}




//A2) Expected validate
function validateExpectedInt($input,$maxSize)
{
	if(strlen
	(explainExpectedInt($input,"Error: ",$maxSize))
	===0)
		{return true;}
	else{return false;}
}

function validateExpectedFloat($input,$max)
{if(strlen
	(explainExpectedFloat($input,"Error: ",$max))
	===0)
		{return true;}
	else{return false;}
}

function validateExpectedLetters($input,$max)
{
	if(strlen
	(explainExpectedLetters($input,"Error: ",$max))
	===0)
		{return true;}
	else{return false;}
}


//A3) Expected clean

function cleanExpectedInt($input,$maxSize)
{
	$allowed=
	array
	("+","-","0","1","2","3","4","5","6","7","8","9");
	return simpleClean($input,$allowed,$maxSize);
}


function cleanExpectedFloat($in,$max)
{
	$allowed=
	array
	("+","-","0","1","2","3","4","5","6",
		"7","8","9",".");
	return simpleClean($in,$allowed,$max);
}


function cleanExpectedLetters($in,$max)
{

	$allowed=
	array(
	"0","1","2","3","4","5","6","7","8","9",".",",",
	"a","b","c","d","e","f","g","h","i","j","k","l","m","n",
	"o","p","q","r","s","t","u","v","w","x","y","z",
	"A","B","C","D","E","F","G","H","I","J","K","L","M","N",
	"O","P","Q","R","S","T","U","V","W","X","Y","Z","_",
	"ا","أ","إ","ئ","ء","ب","ت","ث","ج","ح","خ","د","ذ","ر","ز","س",
	"ش","ص","ض","ط","ظ","ع","غ","ف","ق","ك","ل","م","ن","ه","و",
	"ي","ى","ئ",
	"ؤ","1","2","3","4","5","6","7","8","9","0");	
	return simpleClean($in,$allowed,$max);
}






/*
DESCRIPTION:

Expected:
means that there some expected characters
does it meet the expected cretia


Restricted:
Means that all letters are allowed, except those 
restricted letters or characters

Explain: 
Means if it meets the criteria give an empty string
else tell me at least one reason why it doesn't



Validate:
Means that you will return true when it meets the 
spesifications.
False: doesn't meet the spesifications.



Clean:
Delete all the letters that doesn't meet the 
spesifiactions, and after that take the first max 
charachters if more than max characters



Clean at the beginning wll be simple
We will not apply that deep claening now
I need to get up and running for now

Integer:
consits of these letters only
"1,2,3,4,5,6,7,8,9,0"


Float:
consits of these letters only
"1,2,3,4,5,6,7,8,9,0,."

Letters:
consits of these letters only:
"1,2,3,4,5,6,7,8,9,0,.,,,
a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,
A,B,C,D,E,F,G,H,I,J,K,L,N,M,O,P,Q,R,S,T,U,V,W,X,Y,Z, ,
arabic letters"



*/
?>




