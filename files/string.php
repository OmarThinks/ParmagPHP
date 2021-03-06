<?php
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
TESTING:






function 
stringToArrayOfArrays($string,$seperator1,$seperator2);
	-Test:1*1, 3*1, 1*3, 3*3, empty
	var_dump(stringToArrayOfArrays("i1",";",","));
	var_dump(stringToArrayOfArrays("i1,j1,k1",";",","));
	var_dump(stringToArrayOfArrays("i1;i2;i3",";",","));
	var_dump(stringToArrayOfArrays
	("i1,j1,k1;i2,j2,k2;i3,j3,k3;",";",","));
	var_dump(stringToArrayOfArrays("",";",","));

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


function arrayOfArraysToString($array,$seperator1,$seperator2);
	-Test: 1*1, 3*1, 1*3, 3*3, empty
	$a=array(array("i1"));
	var_dump(arrayOfArraysToString($a,";",","));
	$a=array(array("i1"),array("i2"),array("i3"));
	var_dump(arrayOfArraysToString($a,";",","));
	$a=array(array("i1","j1","k1"));
	var_dump(arrayOfArraysToString($a,";",","));
	$a=array
	(array("i1","j1","k1"),array("i2","j2","k2"),
	var_dump(array("i3","j3","k3"),));
	$a=array();
	var_dump(arrayOfArraysToString($a,";",","));
	
	C:\wamp\www\kant\index.php:98:string 'i1' (length=2)
	C:\wamp\www\kant\index.php:100:string 'i1;i2;i3' (length=8)
	C:\wamp\www\kant\index.php:102:string 'i1,j1,k1' (length=8)
	C:\wamp\www\kant\index.php:106:string 'i1,j1,k1;i2,j2,k2;i3,j3,k3' (length=26)
	C:\wamp\www\kant\index.php:108:string '' (length=0)
	T.G: it works perfectly







function addAssocArray($arrayOfArrays);
Test: all are full
$a1=array("0"=>"a");$a2=array("1"=>"b");$a3=array("2"=>"c");
var_dump(addAssocArray(array($a1,$a2,$a3)));
array (size=3)
  0 => string 'a' (length=1)
  1 => string 'b' (length=1)
  2 => string 'c' (length=1)

Test: there is an empty array
$a1=array("0"=>"a");$a2=array();
var_dump(addAssocArray(array($a1,$a2)));
array (size=1)
  0 => string 'a' (length=1)



function addArray($arrayOfArrays);

Test: different types of indxed arrays
$a1=array("0","1");$a2=array("2");$a3=array();
var_dump(addArray(array($a1,$a2,$a3)));
C:\wamp\www\kant\index.php:92:
array (size=3)
  0 => string '0' (length=1)
  1 => string '1' (length=1)
  2 => string '2' (length=1)






function isNewString($string1,$string2,$seperator);

Test: when the first is empty
var_dump(isNewString("","a",";"));
C:\wamp\www\kant\index.php:94:boolean true
Note: T.G it works perfect



Test: when the second is empty
var_dump(isNewString("a","",";"));
C:\wamp\www\kant\index.php:94:boolean false


Test: when first has one value, new
var_dump(isNewString("a","b",";"));
C:\wamp\www\kant\index.php:94:boolean true

Test: first has 2 values, new
var_dump(isNewString("a;c","b",";"));
C:\wamp\www\kant\index.php:94:boolean true

Test: first has 1 value, old
var_dump(isNewString("a","a",";"));
C:\wamp\www\kant\index.php:94:boolean false

Test: has 2 values, old
var_dump(isNewString("a;b","a",";"));
C:\wamp\www\kant\index.php:94:boolean false




function simpleStringSearch($stringIn,$query)

Test: query is more than stringIn
var_dump(simpleStringSearch("hello","hello1"));
C:\wamp\www\kant\index.php:102:boolean false
T.G: works perfectly


Test: does it loop well? 1 character
Note: turn on the print inside the for loop
and the pring outside the loop
var_dump(simpleStringSearch("hello","1"));
h e l l o
C:\wamp\www\kant\index.php:100:boolean false
T.G: it works perfectly


Test: does it loop well? 2 charcters
Note: turn on the print inside the for loop
and the pring outside the loop
var_dump(simpleStringSearch("hello","12"));
he el ll lo
C:\wamp\www\kant\index.php:100:boolean false
T.G: it works perfectly

Test: does it loop well? 3 charcters
Note: turn on the print inside the for loop
and the pring outside the loop
var_dump(simpleStringSearch("hello","123"));
hel ell llo 
C:\wamp\www\kant\index.php:100:boolean false
T.G: it works perfectly


Test: does work right? 1 char
var_dump(simpleStringSearch("hello","h"));
C:\wamp\www\kant\index.php:100:boolean true
T.G: it works perfectly


Test: does work right? 2 chars
var_dump(simpleStringSearch("hello","he"));
C:\wamp\www\kant\index.php:100:boolean true
T.G: it works perfectly


Test: does work right? 3 chars
var_dump(simpleStringSearch("hello","hel"));
C:\wamp\www\kant\index.php:100:boolean true
T.G: it works perfectly



Test: does work right? 1 char, doesn't exist
var_dump(simpleStringSearch("hello","t"));
C:\wamp\www\kant\index.php:100:boolean false
T.G: it works perfectly


Test: does work right? 2 chars, doesn't exist
var_dump(simpleStringSearch("hello","tr"));
C:\wamp\www\kant\index.php:100:boolean false
T.G: it works perfectly


Test: does work right? 3 chars, doesn't exist
var_dump(simpleStringSearch("hello","trr"));
C:\wamp\www\kant\index.php:100:boolean false
T.G: it works perfectly




*/












?>