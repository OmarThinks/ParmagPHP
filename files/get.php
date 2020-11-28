<?php
/*
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
/*
TEST:

http://localhost/kant/index.php?a=5&b=6
var_dump($_GET['a']);
var_dump($_GET['b']);
C:\wamp\www\kant\index.php:73:string '5' (length=1)
C:\wamp\www\kant\index.php:74:string '6' (length=1)




function myGetRedirect($link,$array);

Test: redirect link
var_dump(myGetRedirect("confirm.php",array()));
T.G: it works

Test: redirect link , one value to be passed
var_dump(myGetRedirect("confirm.php",array("a"=>"1")));
in confirm.php
var_dump($_GET["a"]);
C:\wamp\www\kant\confirm.php:9:string '1' (length=1)


Test: redirect link, 2 values to be passed
var_dump(myGetRedirect
("confirm.php",array("a"=>"1","b"=>"2")));
in confirm.php
var_dump($_GET["a"]);
var_dump($_GET["b"]);
C:\wamp\www\kant\confirm.php:9:string '1' (length=1)
C:\wamp\www\kant\confirm.php:10:string '2' (length=1)



Test: redirect, 2 values, messed up characters
var_dump(myGetRedirect
("confirm.php",array("a"=>"!@#$%^&*()_+|<>","b"=>"<>?")));
In confirm.php
var_dump($_GET["a"]);
var_dump($_GET["b"]);
Errors


#Be careful when passing these things



function generateGet($link,$array);


Test: no values to be passed
var_dump(generateGet("confirm.php",array()));
C:\wamp\www\kant\index.php:73:string 'confirm.php' (length=11)

Test: one Value
var_dump(generateGet("confirm.php",array("a"=>"1")));
C:\wamp\www\kant\index.php:73:string 'confirm.php?a=1' (length=15)



Test: two Values
var_dump(generateGet("confirm.php",array("a"=>"1","b"=>"2")));
C:\wamp\www\kant\index.php:73:string 
'confirm.php?a=1&b=2' (length=19)




function genereteHRefString($buttonText,$herf);

Test: printing the text of a link
print(htmlspecialchars
	(genereteHRefString("confirm","confirm.php")));
<a href='confirm.php'>confirm</a>

Test: print a link
print(genereteHRefString("confirm","confirm.php"));
Link in page:confirm
takes to: confirm.php











function sendConfirmPhp
($confirmLocation,$redirect,
$message="",$name1="",$link1="",$name2="",$link2="",
$name3="",$link3="",$name4="",$link4="",$name5="",$link5="");

Test: with redirect only
sendConfirmPhp
("confirm.php","index.php");
http://localhost/kant/confirm.php?redirect=index.php



Test: with redirect and message
sendConfirmPhp
("confirm.php","index.php","m");
http://localhost/kant/confirm.php?redirect=index.php&message=m


Test: With redirect, message and name1 and link1
sendConfirmPhp
("confirm.php","index.php","m","n1","l1");
http://localhost/kant/confirm.php?redirect=index.php&message=m&name1=n1&link1=l1



Test: unleashed
sendConfirmPhp
("confirm.php","index.php","m","n1","l1","n2","l2","n3","l3",
	"n4","l4","n5","l5");
http://localhost/kant/confirm.php?redirect=index.php&message=m&name1=n1&link1=l1&name2=n2&link2=l2&name3=n3&link3=l3&name4=n4&link4=l4&name5=n5&link5=l5






function hiddenButtonPost
($nameValueAssocArray,$buttonName,$to);

Test: single element
var_dump(
getHiddenButtonPost
(array("a"=>"a"),"Add","mob_add_fast.php"));
C:\wamp\www\kant\data\accounts\fast\mobile_fast.php:37:string '<form method="post" action="mob_add_fast.php">
<input type="text" name="a" value="a" hidden>
<input type="submit" value="Add" ></form>'
(length=132)
T.G: it works perftctly

Test: 2 elements
var_dump(
getHiddenButtonPost
(array("a"=>"a","b"=>"b"),"Add","mob_add_fast.php"));
C:\wamp\www\kant\data\accounts\fast\mobile_fast.php:37:string '<form method="post" action="mob_add_fast.php">
<input type="text" name="a" value="a" hidden>
<input type="text" name="b" value="b" hidden>
<input type="submit" value="Add" ></form>' 
(length=177)


Test: 0 Elements
var_dump(
getHiddenButtonPost
(array(),"Add","mob_add_fast.php"));
C:\wamp\www\kant\data\accounts\fast\mobile_fast.php:37:string '' (length=0)





function getHiddenTextInputOfForm($name,$value);

Test: It works
var_dump(getHiddenTextInputOfForm("a","b"));
C:\wamp\www\kant\data\accounts\fast\mobile_fast.php:37:string '<input type="text" name="a" value="b" hidden>' (length=45)


Test: empty name
var_dump(getHiddenTextInputOfForm("","b"));
C:\wamp\www\kant\data\accounts\fast\mobile_fast.php:37:string '' (length=0)

Test: empty value
var_dump(getHiddenTextInputOfForm("a",""));
C:\wamp\www\kant\data\accounts\fast\mobile_fast.php:37:string '<input type="text" name="a" value="" hidden>' (length=44)


*/
?>
