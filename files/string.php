<?php
/*
SUMMARY:
This file contains all the functions that are related to the string
*/


/*SummaryFunctions*/
/*
//High Level
function parmag_string_split($inputString,$separator); (Gitted)

function parmag_string_toAssocArray($stringIn,$seperator1,$seperator2);
function parmag_string_assocArrayToString ($arrayIn,$seperator1,$seperator2);
function 
parmag_string_stringToArrayOfArrays($string,$seperator1,$seperator2);
function parmag_string_arrayOfArraysToString($array,$seperator1,$seperator2);
function parmag_string_addAssocArray($arrayOfArrays);
function parmag_string_addArray($arrayOfArrays);
function parmag_string_isNew($string1,$string2,$seperator);


//Low Level
function parmag_string_arrayToString($inputArray,$seperator);
function parmag_string_charAt($stringIn,$number);
function parmag_string_cut($stringIn,$from,$to);
function parmag_string_find($stringIn, $chara);
function parmag_string_removeLastChar($stringIn);
function parmag_string_removeFirstChar($stringIn);
function parmag_string_simpleSearch($stringIn,$query);

*/



/*High Level*/





function
parmag_string_split
($inputString,$separator)
{
	if(gettype($inputString)!=="string")
		{if(gettype($inputString)!=="integer")
		{if(gettype($inputString)!=="double")
			{return 
			"parmag_string_split(Error1):The inputString is not string, integer or double.";}}}
	$inputString = $inputString . "";
	
	if(gettype($separator)!=="string")
		{if(gettype($separator)!=="integer")
		{if(gettype($separator)!=="double")
			{return 
			"parmag_string_split(Error2):The separator is not string, integer or double.";}}}
	$inputString = $inputString . "";
	$separator = $separator . "" ;
	if(strlen($separator)===0)
	{return "parmag_string_split(Error3):The separator consists of 0 characters.";}
	if(strlen($separator)>1)
	{return "parmag_string_split(Error4):The separator consists of more than one character.";}
	

	$toReturn=array();
	$n=0;
	$locations=parmag_string_find($inputString,$separator);
	//var_dump($locations);
	$nMax=count($locations);
	if($nMax==0)
		{
			$toReturn[0]=$inputString;
			return $toReturn;
		}

	$toReturn[$n++]=parmag_string_cut($inputString,0,($locations[0]));
	for($i=0;$i<($nMax-1);$i++)
	{
		$toReturn[$n++]=
		parmag_string_cut
		($inputString,($locations[$i]+1),($locations[$i+1]));
	}
	$toReturn[$n++]=
	parmag_string_cut
	($inputString,$locations[$nMax-1]+1,
		(strlen($inputString)));
	return $toReturn;

}









function
parmag_string_toAssocArray($stringIn,$seperator1,$seperator2)
{
	$lvl1Array=parmag_string_split($stringIn,$seperator1);
	$toReturn=array();
	$n=count($lvl1Array);

	$index="";
	$value="";
	$subString="";
	for($i=0;$i<$n;$i++)
	{
		$subString=$lvl1Array[$i];

		$subArray=parmag_string_split($subString,$seperator2);
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





function parmag_string_assocArrayToString
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
	$toReturn=parmag_string_removeLastChar($toReturn);
	return $toReturn;
}





function 
parmag_string_stringToArrayOfArrays($string,$seperator1,$seperator2)
{
	$string=$string."";
	if(strlen($string)===0){return array();}
	$arraysLvl1=parmag_string_split($string,$seperator1);
	$arraysLvl2=array();
	$subArray=array();
	foreach ($arraysLvl1 as $key => $value) 
	{
		$subArray=parmag_string_split($arraysLvl1[$key],$seperator2);
		$arraysLvl2=addArray
		(array($arraysLvl2,array($subArray)));
	}
	return $arraysLvl2;
}


function parmag_string_arrayOfArraysToString($array,$seperator1,$seperator2)
{
	if(count($array)===0){return "";}
	$arrayOfStrings=array();
	foreach ($array as $key => $value) 
	{
		$arrayOfStrings=addArray
		(array($arrayOfStrings,array(
			parmag_string_arrayToString($value,$seperator2))));
	}
	return parmag_string_arrayToString($arrayOfStrings,$seperator1);
}







function parmag_string_addAssocArray($arrayOfArrays)
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






function parmag_string_addArray($arrayOfArrays)
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





function parmag_string_isNew($string1,$string2,$seperator)
{
	if(strlen($string2)==0){return false;}
	if(strlen($string1)==0){return true;}
	$array=parmag_string_split($string1,$seperator);
	foreach($array as $value)
		{if($value==$string2){return false;}}
	return true;
}




/*Low Level*/






function parmag_string_arrayToString
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
parmag_string_charAt($stringIn,$number)
{
	$toReturn=$stringIn[$number];
	return $toReturn;
}





function
parmag_string_cut($stringIn,$from,$to)
{
	$lenght=$to-$from;
	return substr
	($stringIn, 
		$from,
		 $lenght);
}





function
parmag_string_find
($stringIn, $chara)
{
	$current=0;
	$locations=array();
	//var_dump($stringIn);
	$max=strlen($stringIn);
	//var_dump($max);
	for($i=0;$i<$max;$i++)
		{
			$s=parmag_string_charAt($stringIn,$i);
			//var_dump($s);
			if($s==$chara)
			{
				$locations[$current]=$i;
				$current++;
			}
		}

	return $locations;
}


function parmag_string_removeLastChar($stringIn)
{
	return cutString
($stringIn,0,(strlen($stringIn)-1));
}

function parmag_string_removeFirstChar($stringIn)
{
	return cutString
($stringIn,1,(strlen($stringIn)));
}


function parmag_string_simpleSearch($stringIn,$query)
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
DESCRIPTION:



//High Level




parmag_string_split($inputString,$separator);
INPUTS:
	-$inpuString : The string that needd to be separated
		It might have a form like this:
		"111,222,333"
		$inputString: must have one of the following types:
			string, integer or double
	-$separator : This is the separator charcter
		It can be like this ","
		It can't be more than one character
		$seperator: must have one of the following types:
		string, integer or double
FUNCTION:
	-The string will be separated into an array
RETURN VALUE:
	-array of strings if the conditions are fulfilled
	-"parmag_string_split(Error1):The inputString is not string, integer or double." : 
	if the $inputString is not integer, double or string
	-"parmag_string_split(Error2):The separator is not string, integer or double." : 
	If the $separator is not string, integer or double
	-"parmag_string_split(Error3):The separator consists of 0 characters.":
	f the separator has no characters at all
	-"parmag_string_split(Error4):The separator consists of more than one character.":
	If the separator consists of more than one character



function
parmag_string_toAssocArray($stringIn,$seperator1,$seperator2);
splits string to associative array

Test: more than one value
var_dump(parmag_string_toAssocArray("abcd,dcba;xyz,zyx",";",","));
C:\wamp\www\kant\index.php:78:
array (size=2)
  'abcd' => string 'dcba' (length=4)
  'xyz' => string 'zyx' (length=3)

Test: only one value
var_dump(parmag_string_toAssocArray("abcd,dcba",";",","));
C:\wamp\www\kant\index.php:76:
array (size=1)
  'abcd' => string 'dcba' (length=4)

Test: no values
var_dump(parmag_string_toAssocArray("",";",","));
C:\wamp\www\kant\index.php:76:
array (size=0)
  empty



function parmag_string_assocArrayToString
($arrayIn,$seperator1,$seperator2);
$s="01234567890,v;01234567891,u;01234567892,v";
$array=sqlGetMobileArray($s);
var_dump(parmag_string_assocArrayToString($array,";",","));
//'01234567890,v;01234567891,u;01234567892,v'



function 
parmag_string_stringToArrayOfArrays($string,$seperator1,$seperator2);
	-Function: thing1,holder1,owner1;thing2,holder2,owner2
	Sometimes such strings exist, we need to handle them
	in the form of an array
	-Return: array of arrays: able to perform,
	empty array: empty string
	The array of arrays we seek looke like this
	[0]{[0]=thing1,[1]=holder1,[2]=owner1}
	[1]{[0]=thing2,[1]=holder2,[2]=owner2}


function parmag_string_arrayOfArraysToString($array,$seperator1,$seperator2);
	-Function: 
	[0]{[0]=thing1,[1]=holder1,[2]=owner1}
	[1]{[0]=thing2,[1]=holder2,[2]=owner2}
	Sometimes such array of arrays exist, we need to handle 
	them in the form of an string
	Return: string: able to perform,
	empty string: empty array







function parmag_string_addAssocArray($arrayOfArrays);
The input is an array of  assoctaive arrays



function parmag_string_addArray($arrayOfArrays);
This function merges arrays in a single array



function parmag_string_isNew($string1,$string2,$seperator);
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



parmag_string_arrayToString($inputArray,$seperator);
It's obvious, see this example
$strings=array();
$strings[0]=0;$strings[1]=1;$strings[2]=2;
$strings[3]=3;$strings[4]=4;$strings[5]=5;
$seperator=";";
echo("<br>".parmag_string_ArrayToString($strings,$seperator)."<br>");
//0;1;2;3;4;5

if only string[0]=0;
//0



parmag_string_cut($stringIn,$from,$to);
returns a string
equivalent to substr();
standard function in php
The difference is the input



parmag_string_find($stringIn, $chara);
return an array of numbers
they are the locations of this caharacter
in this string
example:
$test=",111,222,333,";
print_r(parmag_string_find($test,","));
//Array ( [0] => 0 [1] => 4 [2] => 8 [3] => 12 ) 



function parmag_string_removeLastChar($stringIn);
function parmag_string_removeFirstChar($stringIn);
$s="abcde";
var_dump(parmag_string_removeLastChar($s));//'abcd'
var_dump(parmag_string_removeFirstChar($s));//'bcde'


function parmag_string_simpleSearch($stringIn,$query);
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
TESTING:






parmag_string_split($inputString,$separator);
	//Test 01 : 3 seperated
	$s="111,222,333,444";
	print("Test 01 : ");
	print_r(parmag_string_split($s,","));
	print ("<hr>") ;
	//Test01 : Array ( [0] => 111 [1] => 222 [2] => 333 [3] => 444 )  
	
	//Test 02 : 2 Seperated
	$s="111,222";
	print("Test 02 : ");
	print_r(parmag_string_split($s,","));
	//Test02 : Array ( [0] => 111 [1] => 222 )  
	print ("<hr>") ;
	
	//Test 03 : 1 only,m no Separations
	$s="111";
	print("Test 03 : ");
	print_r(parmag_string_split($s,","));
	//Test03 : Array ( [0] => 111 ) 
	print ("<hr>") ;
	
	//Test 04 : empty two
	$s=",";
	print("Test 04 : ");
	print_r(parmag_string_split($s,","));
	//Test04 : Array ( [0] => [1] => ) 
	print ("<hr>") ;
	
	//Test 05 : empty text
	$s="";
	print("Test 05 : ");
	print_r(parmag_string_split($s,","));
	//Test05 : Array ( [0] => )  
	print ("<hr>") ;
	
	//Test 06 : inputString is integer
	$s=11522533;
	print("Test 06 : ");
	print_r(parmag_string_split($s,"5"));
	//Test 06 : Array ( [0] => 11 [1] => 22 [2] => 33 ) 
	print ("<hr>") ;
	
	//Test 07 : inputString is float
	$s=11522533.0;
	print("Test 07 : ");
	print_r(parmag_string_split($s,"5"));
	//Test 07 : Array ( [0] => 11 [1] => 22 [2] => 33 )  
	print ("<hr>") ;
	
	//Test 08 : separator is integer
	$s="11522533";
	print("Test 08 : ");
	print_r(parmag_string_split($s,5));
	//Test 08 : Array ( [0] => 11 [1] => 22 [2] => 33 )  
	print ("<hr>") ;
	
	//Test 09 : separator is float
	$s="11522533";
	print("Test 09 : ");
	print_r(parmag_string_split($s,5.0));
	//Test 09 : Array ( [0] => 11 [1] => 22 [2] => 33 )  
	print ("<hr>") ;
	
	//Test 10 : Error1
	$s=true;
	print("Test 10 : ");
	print_r(parmag_string_split($s,5.0));
	//Test 10 : parmag_string_split(Error1):The inputString is not string, integer or double. 
	print ("<hr>") ;
	
	//Test 11 : Error2
	$s="111,222,333";
	print("Test 11 : ");
	print_r(parmag_string_split($s,true));
	//Test 11 : parmag_string_split(Error2):The separator is not string, integer or double. 
	print ("<hr>") ;
	
	//Test 12 : Error3
	$s="11522533";
	print("Test 12 : ");
	print_r(parmag_string_split($s,""));
	//Test 12 : parmag_string_split(Error3):The separator consists of 0 characters. 
	print ("<hr>") ;
	
	//Test 13 : Error4
	$s="111,;222,;333";
	print("Test 13 : ");
	print_r(parmag_string_split($s,",;"));
	//Test 13 : parmag_string_split(Error4):The separator consists of more than one character. 
	print ("<br><br><br>") ;












function 
parmag_string_stringToArrayOfArrays($string,$seperator1,$seperator2);
	-Test:1*1, 3*1, 1*3, 3*3, empty
	var_dump(parmag_string_stringToArrayOfArrays("i1",";",","));
	var_dump(parmag_string_stringToArrayOfArrays("i1,j1,k1",";",","));
	var_dump(parmag_string_stringToArrayOfArrays("i1;i2;i3",";",","));
	var_dump(parmag_string_stringToArrayOfArrays
	("i1,j1,k1;i2,j2,k2;i3,j3,k3;",";",","));
	var_dump(parmag_string_stringToArrayOfArrays("",";",","));

C:\wamp\www\kant\index.php:100:
array (size=1)
  0 => 
    array (size=1)
      0 => string 'i1' (length=2)

C:\wamp\www\kant\index.php:101:
array (size=1)
  0 => 
    array (size=3)
      0 => string 'i1' (length=2)
      1 => string 'j1' (length=2)
      2 => string 'k1' (length=2)

C:\wamp\www\kant\index.php:102:
array (size=3)
  0 => 
    array (size=1)
      0 => string 'i1' (length=2)
  1 => 
    array (size=1)
      0 => string 'i2' (length=2)
  2 => 
    array (size=1)
      0 => string 'i3' (length=2)

C:\wamp\www\kant\index.php:104:
array (size=4)
  0 => 
    array (size=3)
      0 => string 'i1' (length=2)
      1 => string 'j1' (length=2)
      2 => string 'k1' (length=2)
  1 => 
    array (size=3)
      0 => string 'i2' (length=2)
      1 => string 'j2' (length=2)
      2 => string 'k2' (length=2)
  2 => 
    array (size=3)
      0 => string 'i3' (length=2)
      1 => string 'j3' (length=2)
      2 => string 'k3' (length=2)
  3 => 
    array (size=1)
      0 => boolean false

C:\wamp\www\kant\index.php:105:
array (size=0)
  empty
	T.G: it works perfectly


function parmag_string_arrayOfArraysToString($array,$seperator1,$seperator2);
	-Test: 1*1, 3*1, 1*3, 3*3, empty
	$a=array(array("i1"));
	var_dump(parmag_string_arrayOfArraysToString($a,";",","));
	$a=array(array("i1"),array("i2"),array("i3"));
	var_dump(parmag_string_arrayOfArraysToString($a,";",","));
	$a=array(array("i1","j1","k1"));
	var_dump(parmag_string_arrayOfArraysToString($a,";",","));
	$a=array
	(array("i1","j1","k1"),array("i2","j2","k2"),
	var_dump(array("i3","j3","k3"),));
	$a=array();
	var_dump(parmag_string_arrayOfArraysToString($a,";",","));
	
	C:\wamp\www\kant\index.php:98:string 'i1' (length=2)
	C:\wamp\www\kant\index.php:100:string 'i1;i2;i3' (length=8)
	C:\wamp\www\kant\index.php:102:string 'i1,j1,k1' (length=8)
	C:\wamp\www\kant\index.php:106:string 'i1,j1,k1;i2,j2,k2;i3,j3,k3' (length=26)
	C:\wamp\www\kant\index.php:108:string '' (length=0)
	T.G: it works perfectly







function parmag_string_addAssocArray($arrayOfArrays);
Test: all are full
$a1=array("0"=>"a");$a2=array("1"=>"b");$a3=array("2"=>"c");
var_dump(parmag_string_addAssocArray(array($a1,$a2,$a3)));
array (size=3)
  0 => string 'a' (length=1)
  1 => string 'b' (length=1)
  2 => string 'c' (length=1)

Test: there is an empty array
$a1=array("0"=>"a");$a2=array();
var_dump(parmag_string_addAssocArray(array($a1,$a2)));
array (size=1)
  0 => string 'a' (length=1)



function parmag_string_addArray($arrayOfArrays);

Test: different types of indxed arrays
$a1=array("0","1");$a2=array("2");$a3=array();
var_dump(parmag_string_addArray(array($a1,$a2,$a3)));
C:\wamp\www\kant\index.php:92:
array (size=3)
  0 => string '0' (length=1)
  1 => string '1' (length=1)
  2 => string '2' (length=1)






function parmag_string_isNew($string1,$string2,$seperator);

Test: when the first is empty
var_dump(parmag_string_isNew("","a",";"));
C:\wamp\www\kant\index.php:94:boolean true
Note: T.G it works perfect



Test: when the second is empty
var_dump(parmag_string_isNew("a","",";"));
C:\wamp\www\kant\index.php:94:boolean false


Test: when first has one value, new
var_dump(parmag_string_isNew("a","b",";"));
C:\wamp\www\kant\index.php:94:boolean true

Test: first has 2 values, new
var_dump(parmag_string_isNew("a;c","b",";"));
C:\wamp\www\kant\index.php:94:boolean true

Test: first has 1 value, old
var_dump(parmag_string_isNew("a","a",";"));
C:\wamp\www\kant\index.php:94:boolean false

Test: has 2 values, old
var_dump(parmag_string_isNew("a;b","a",";"));
C:\wamp\www\kant\index.php:94:boolean false




function parmag_string_simpleSearch($stringIn,$query)

Test: query is more than stringIn
var_dump(parmag_string_simpleSearch("hello","hello1"));
C:\wamp\www\kant\index.php:102:boolean false
T.G: works perfectly


Test: does it loop well? 1 character
Note: turn on the print inside the for loop
and the pring outside the loop
var_dump(parmag_string_simpleSearch("hello","1"));
h e l l o
C:\wamp\www\kant\index.php:100:boolean false
T.G: it works perfectly


Test: does it loop well? 2 charcters
Note: turn on the print inside the for loop
and the pring outside the loop
var_dump(parmag_string_simpleSearch("hello","12"));
he el ll lo
C:\wamp\www\kant\index.php:100:boolean false
T.G: it works perfectly

Test: does it loop well? 3 charcters
Note: turn on the print inside the for loop
and the pring outside the loop
var_dump(parmag_string_simpleSearch("hello","123"));
hel ell llo 
C:\wamp\www\kant\index.php:100:boolean false
T.G: it works perfectly


Test: does work right? 1 char
var_dump(parmag_string_simpleSearch("hello","h"));
C:\wamp\www\kant\index.php:100:boolean true
T.G: it works perfectly


Test: does work right? 2 chars
var_dump(parmag_string_simpleSearch("hello","he"));
C:\wamp\www\kant\index.php:100:boolean true
T.G: it works perfectly


Test: does work right? 3 chars
var_dump(parmag_string_simpleSearch("hello","hel"));
C:\wamp\www\kant\index.php:100:boolean true
T.G: it works perfectly



Test: does work right? 1 char, doesn't exist
var_dump(parmag_string_simpleSearch("hello","t"));
C:\wamp\www\kant\index.php:100:boolean false
T.G: it works perfectly


Test: does work right? 2 chars, doesn't exist
var_dump(parmag_string_simpleSearch("hello","tr"));
C:\wamp\www\kant\index.php:100:boolean false
T.G: it works perfectly


Test: does work right? 3 chars, doesn't exist
var_dump(parmag_string_simpleSearch("hello","trr"));
C:\wamp\www\kant\index.php:100:boolean false
T.G: it works perfectly




*/






















?>