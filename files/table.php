<?php

/*
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


/*
TEST:



function getTableOfArray_arrayNotSpecial
($headingString, $string, $headingSeperator, $rowSep, $colSep);
	-Test:
	$headingString="h1,h2,h3";
	$string = "ra1,ra2,ra3;rb1,rb2,rb3";
	getTableOfArray_arrayNotSpecial
	($headingString, $string , ",", ";", ","));
	-Note: It works perfectly




function getTableOfArray_arraySpecial
($headingString, $string, $headingSeperator, $rowSep, $colSep);
	-Test:
	$headingString="h1,h2,h3";
	$string = "ra1,ra2,ra3;rb1,rb2,rb3";
	print(
	getTableOfArray_arraySpecial
	($headingString, $string , ",", ";", ","));
	-Note: T.G: It works perfectly




function printTableToCopy
($headingString, $string, $headingSeperator, $rowSep, $colSep);
	-Test:
	$headingString="h1,h2,h3";
	$string = "ra1,ra2,ra3;rb1,rb2,rb3";
	printTableToCopy
	($headingString, $string , ",", ";", ",");
	-Note: T.G: It works perfectly
	This is the result:
<table>

     <tr>
          <th>h1</th>
          <th>h2</th>
          <th>h3</th>
     </tr>

     <tr>
          <td>ra1</td>
          <td>ra2</td>
          <td>ra3</td>
     </tr>

     <tr>
          <td>rb1</td>
          <td>rb2</td>
          <td>rb3</td>
     </tr>

</table>






*/




?>