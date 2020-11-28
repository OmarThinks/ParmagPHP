<?php
/*
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
<?php
/*
TEST:




A)Expected

A1) Expected explain 
function explainExpectedInt($input,$message,$maxSize);

Test: correct int
var_dump(explainExpectedInt("123","Wrong: ",5));
C:\wamp\www\kant\index.php:99:string '' (length=0)
T.G: it works perfectly

Test: wrong data types
var_dump(explainExpectedInt(123,"Wrong: ","5"));
C:\wamp\www\kant\index.php:99:string '' (length=0)
T.G: it works perfectly


Test: not matching the conditions: more than length
var_dump(explainExpectedInt(123,"Wrong: ",2));
C:\wamp\www\kant\index.php:99:string 'Wrong: Maximum allowed number of letters is 2' (length=45)
T.G: it works perfectly


Test: exactly the number of max characters
var_dump(explainExpectedInt(123,"Wrong: ",3));
C:\wamp\www\kant\index.php:99:string '' (length=0)
T.G: it works perfectly


Test: illegal charcter
var_dump(explainExpectedInt("123.1","Wrong: ",20));
C:\wamp\www\kant\index.php:99:string 'Wrong: These characters are not allowed(.)' (length=42)
T.G: it works perfectly


Test: positive sign
var_dump(explainExpectedInt("+123","Wrong: ",20));
C:\wamp\www\kant\index.php:99:string '' (length=0)
T.G: it works perfectly

Test: more than a positive sign
var_dump(explainExpectedInt("++123","Wrong: ",20));
C:\wamp\www\kant\index.php:99:string 'Wrong: There is more than a positive sign.' (length=42)
T.G: it works perfectly


Test: positive sign not in the beginning
var_dump(explainExpectedInt("1+23","Wrong: ",20));
C:\wamp\www\kant\index.php:99:string 'Wrong: The positive sign should be at the beginning of the number.' (length=66)
T.G: it works perfectly



Test: negative sign
var_dump(explainExpectedInt("-123","Wrong: ",20));
C:\wamp\www\kant\index.php:99:string '' (length=0)
T.G: it works perfectly


Test: more than a negative sign
var_dump(explainExpectedInt("--123","Wrong: ",20));
C:\wamp\www\kant\index.php:99:string 'Wrong: There is more than a negative sign.' (length=42)
T.G: it works perfectly


Test: negative sign not in the beginning
var_dump(explainExpectedInt("1-23","Wrong: ",20));
C:\wamp\www\kant\index.php:99:string 'Wrong: The negative sign should be at the beginning of the number.' (length=66)
T.G: it works perfectly




function explainExpectedFloat($in,$message,$max);

Test: wrong data types
var_dump(explainExpectedFloat(123.1,"Wrong: ","5"));
C:\wamp\www\kant\index.php:99:string '' (length=0)
T.G: it works perfectly


Test: not matching the conditions: more than length
var_dump(explainExpectedFloat(123.4,"Wrong: ",2));
C:\wamp\www\kant\index.php:99:string 'Wrong: Maximum allowed number of letters is 2' (length=45)
T.G: it works perfectly


Test: exactly the number of max characters
var_dump(explainExpectedFloat(123.4,"Wrong: ",5));
C:\wamp\www\kant\index.php:99:string '' (length=0)
T.G: it works perfectly


Test: illegal charcter
var_dump(explainExpectedFloat("123.1a","Wrong: ",20));
C:\wamp\www\kant\index.php:99:string 'Wrong: These characters are not allowed(a)' (length=42)
T.G: it works perfectly




Test: positive sign
var_dump(explainExpectedFloat("+12.3","Wrong: ",20));
C:\wamp\www\kant\index.php:99:string '' (length=0)
T.G: it works perfectly

Test: more than a positive sign
var_dump(explainExpectedFloat("++12.3","Wrong: ",20));
C:\wamp\www\kant\index.php:99:string 'Wrong: There is more than a positive sign.' (length=42)
T.G: it works perfectly


Test: positive sign not in the beginning
var_dump(explainExpectedFloat("1+2.3","Wrong: ",20));
C:\wamp\www\kant\index.php:99:string 'Wrong: The positive sign should be at the beginning of the number.' (length=66)
T.G: it works perfectly



Test: negative sign
var_dump(explainExpectedFloat("-12.3","Wrong: ",20));
C:\wamp\www\kant\index.php:99:string '' (length=0)
T.G: it works perfectly


Test: more than a negative sign
var_dump(explainExpectedFloat("--12.3","Wrong: ",20));
C:\wamp\www\kant\index.php:99:string 'Wrong: There is more than a negative sign.' (length=42)
T.G: it works perfectly


Test: negative sign not in the beginning
var_dump(explainExpectedFloat("1-2.3","Wrong: ",20));
C:\wamp\www\kant\index.php:99:string 'Wrong: The negative sign should be at the beginning of the number.' (length=66)
T.G: it works perfectly


Test: correct float
var_dump(explainExpectedFloat("123.1","Wrong: ",5));
C:\wamp\www\kant\index.php:99:string '' (length=0)
T.G: it works perfectly


Test: more than a floating sign
var_dump(explainExpectedFloat("1.2.3","Wrong: ",20));
C:\wamp\www\kant\index.php:99:string 'Wrong: There is more than a floating point.' (length=43)
T.G: it works perfectly


Test: floating point not in the beginning
var_dump(explainExpectedFloat("12.3","Wrong: ",20));
C:\wamp\www\kant\index.php:99:string '' (length=0)
T.G: it works perfectly


Test: floating point in the beginning
var_dump(explainExpectedFloat(".123","Wrong: ",20));
C:\wamp\www\kant\index.php:99:string '' (length=0)
T.G: it works perfectly


Test: no floating point
var_dump(explainExpectedFloat("123","Wrong: ",20));
C:\wamp\www\kant\index.php:99:string '' (length=0)
T.G: it works perfectly




function explainExpectedLetters($in,$message,$max);

Test: right text:
var_dump(explainExpectedLetters("test","Wrong: ",50));
C:\wamp\www\kant\index.php:101:string '' (length=0)
T.G: it works perfectly


Test: more than maximum
var_dump(explainExpectedLetters("test","Wrong: ",3));
C:\wamp\www\kant\index.php:99:string 'Wrong: Maximum allowed number of letters is 3' (length=45)
T.G: it works perfectly


Test: exactly the maximum
var_dump(explainExpectedLetters("test","Wrong: ",4));
C:\wamp\www\kant\index.php:99:string '' (length=0)
T.G: it works perfectly


Test: llegal characters
var_dump(explainExpectedLetters("test,","Wrong: ",9));
C:\wamp\www\kant\index.php:99:string 'Wrong: These characters are not allowed(')' (length=42)
T.G: it works perfectly



A2) Expected validate

function validateExpectedInt($input,$maxSize);

Test: Right integer:
var_dump(validateExpectedInt("1234",9));
C:\wamp\www\kant\index.php:99:boolean true
T.G: it works perfectly

Test: wrong integer:
var_dump(validateExpectedInt("1234+",9));
C:\wamp\www\kant\index.php:99:boolean false
T.G: it works perfectly

The rest is same as explain int


function validateExpectedFloat($in,$max);

Test: Right Float:
var_dump(validateExpectedFloat("1234",9));
C:\wamp\www\kant\index.php:99:boolean true
T.G: it works perfectly

Test: wrong Float:
var_dump(validateExpectedFloat("1234+",9));
C:\wamp\www\kant\index.php:99:boolean false
T.G: it works perfectly



function validateExpectedLetters($in,$max);


Test: Right Text:
var_dump(validateExpectedLetters("1234",9));
C:\wamp\www\kant\index.php:99:boolean true
T.G: it works perfectly


Test: wrong Float:
var_dump(validateExpectedLetters("1234'",9));
C:\wamp\www\kant\index.php:99:boolean false
T.G: it works perfectly



A3) Expected clean

function cleanExpectedInt($input,$maxSize);


Test:Clean integer
var_dump(cleanExpectedInt("123",5));
C:\wamp\www\kant\index.php:99:string '123' (length=3)
T.G: it works perfectly


Test: not clean integer
var_dump(cleanExpectedInt("-12.3",5));
C:\wamp\www\kant\index.php:99:string '-123' (length=4)
T.G: it works perfectly


Test: over max integer
var_dump(cleanExpectedInt("-12.345",3));
C:\wamp\www\kant\index.php:99:string '-12' (length=3)
T.G: it works perfectly



function cleanExpectedFloat($in,$max);


Test:Clean float
var_dump(cleanExpectedFloat("12.3",5));
C:\wamp\www\kant\index.php:99:string '12.3' (length=4)
T.G: it works perfectly


Test: not clean float
var_dump(cleanExpectedFloat("-12.3,",5));
C:\wamp\www\kant\index.php:99:string '-12.3' (length=5)
T.G: it works perfectly


Test: over max float
var_dump(cleanExpectedFloat("-12.345",5));
C:\wamp\www\kant\index.php:99:string '-12.3' (length=5)
T.G: it works perfectly






function cleanExpectedLetters($in,$max);


Test:Clean text
var_dump(cleanExpectedLetters("abc",5));
C:\wamp\www\kant\index.php:99:string 'abc' (length=3)
T.G: it works perfectly


Test: not clean text
var_dump(cleanExpectedLetters("abc'd",5));
C:\wamp\www\kant\index.php:99:string 'abcd' (length=4)
T.G: it works perfectly


Test: over max text
var_dump(cleanExpectedLetters("1'2'3;4:5;6",5));
C:\wamp\www\kant\index.php:99:string '12345' (length=5)
T.G: it works perfectly











*/

?>