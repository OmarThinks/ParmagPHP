<?php
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
TEST:

function checkValidString($stringIn,$charArray);

Test:
var_dump(checkValidString
	("abcderfghi",50,
		array("0","1","2","3","4","5","6","7","8","9")));
C:\wamp\www\kant\index.php:68:boolean true

Test:
var_dump(checkValidString
	("abcderfghi1",50,
		array("0","1","2","3","4","5","6","7","8","9")));
C:\wamp\www\kant\index.php:68:boolean false




function explainInvalidString($stringIn,$charArray);

Test:
var_dump(explainInvalidString
	("99999999999999999999999999999999999999999999999999999999999990n",50,
		array("0","1","2","3","4","5","6","7","8","9")));
C:\wamp\www\kant\index.php:68:string 'Maximum allowed number of letters is 50' (length=39)

Test:

var_dump(explainInvalidString
	("999998664521537",50,
		array("0","1","2","3","4","5","6","7","8","9")));
C:\wamp\www\kant\index.php:68:string 'These characters( 123455667899999 )are invalid' (length=46)

Test:

var_dump(explainInvalidString
	("abcderfghi",50,
		array("0","1","2","3","4","5","6","7","8","9")));
C:\wamp\www\kant\index.php:68:string '' (length=0)


function expectedChars($inString,$maxSize,$inArray);

Test:
var_dump(
	expectedChars("01A55",50,
	array("0","1","2","3","4","5","6","7","8","9","A")));
//C:\wamp\www\kant\index.php:67:boolean true



function explainExpectedChars($inString,$maxSize,$inArray);

Test:

var_dump(explainExpectedChars
	("0155666",50,
		array("0","1","2","3","4","5","6","7","8","9")));
C:\wamp\www\kant\index.php:67:string '' (length=0)

Test:

var_dump(explainExpectedChars
	("0a",50,
		array("0","1","2","3","4","5","6","7","8","9")));
C:\wamp\www\kant\index.php:70:string 'These characters are not allowed(a)' (length=35)


var_dump(explainExpectedChars
	("111111111122222222223",20,
		array("0","1","2","3","4","5","6","7","8","9")));
//Number of letters is 21
C:\wamp\www\kant\index.php:69:string 'Maximum allowed number of letters is 20' (length=39)



var_dump(explainExpectedChars
	("111111111122222222223",20,
		array("0","1","2","3","4","5","6","7","8","9")));
//Number of letters is 20
C:\wamp\www\kant\index.php:69:string '' (length=0)




function simpleClean($input,$allowed,$maxSize);


$allowed=
	array
	("+","-","0","1","2","3","4","5","6","7","8","9");

Test: fully allowed text
var_dump(simpleClean("123",$allowed,5));
C:\wamp\www\kant\index.php:102:string '123' (length=3)
T.G: it works perfectly

Test: one letter wrong begin, middle, end
var_dump(simpleClean("'123",$allowed,5));
var_dump(simpleClean("1'23",$allowed,5));
var_dump(simpleClean("123'",$allowed,5));
C:\wamp\www\kant\index.php:103:string '123' (length=3)
C:\wamp\www\kant\index.php:104:string '123' (length=3)
C:\wamp\www\kant\index.php:105:string '123' (length=3)
T.G: it works perfectly

Test: 2 letters not allowed
var_dump(simpleClean("'123'",$allowed,5));
var_dump(simpleClean("1'23'",$allowed,5));
var_dump(simpleClean("'1'23",$allowed,5));
C:\wamp\www\kant\index.php:103:string '123' (length=3)
C:\wamp\www\kant\index.php:104:string '123' (length=3)
C:\wamp\www\kant\index.php:105:string '123' (length=3)
T.G: it works perfectly


Test: exactly as maximum
var_dump(simpleClean("'123'45",$allowed,5));
C:\wamp\www\kant\index.php:103:string '12345' (length=5)
T.G: works perfectly



Test: more than maximum
var_dump(simpleClean("'123'456",$allowed,5));
C:\wamp\www\kant\index.php:103:string '12345' (length=5)
T.G: works perfectly







*/
?>