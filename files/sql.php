<?php
/*
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
/*
TEST:


function connectSQL();

function getNewId($inputTableName);

Test:
var_dump(getNewId("fastaccount"));

1) Select

function sqlSelect($fields,$tName,$condition);

Test:
$answer=sqlSelect("*","fastaccount","");
var_dump($answer);//all
$answer=sqlSelect("*","fastaccount","id=2");
var_dump($answer);//only on answer


function sqlSelectField($tName,$field)

Test: existenet table, and existent field, there is id
var_dump(
sqlSelectField("fastaccount","device"));
C:\wamp\www\kant\index.php:101:
array (size=13)
  1 => string '::1^Firefox^Windows 7' (length=21)
  2 => string '::1^Firefox^Windows 7' (length=21)
  3 => string '::1^Firefox^Windows 7' (length=21)
  4 => string '::1^Firefox^Windows 7' (length=21)
  .
  .
  .



2) Insert

function sqlSafeInsert($tableName,$fieldNamesArray,$values);

Test:
$variables=array("id","mobile","device","location", "orders","activity","theme","date");
$values=array(getNewId("fastaccount"),'01068023242', getUserDevice(),'','','t','',now());
sqlSafeInsert("fastaccount",$variables,$values);



function sqlSafeInsertInhanced($tableName,$assocNamesValues);
Test:
$array=
array
("id"=>getNewId("fastaccount"),"mobile"=>"",
"device"=>getUserDevice(),"location"=>"","orders"=>"",
"activity"=>"t","theme"=>"","date"=>now());
sqlSafeInsertInhanced
("fastaccount",$array);




3) Update

function safeSqlUpdate
($tableName,$id,$fieldNamesArray,$values);
Test:
safeSqlUpdate
("fastaccount",3,array("mobile","location"),
	array("010","Giza"));



function sqlSafeUpdateInhanced
($tableName,$id,$assocNamesValues);
Test:
sqlSafeUpdateInhanced
("fastaccount",3,
	array("mobile"=>"010","location"=>"shobra"));



4) Search
function safeSqlFastSearch($tableName,$field,$query);

Test: existent value n the table
var_dump(safeSqlFastSearch("hackattempts","type","1"));
T.G: it works perfectly

Test: another existent value
var_dump(safeSqlFastSearch("hackattempts","type","4"));
T.G: it works perfectly
C:\wamp\www\kant\index.php:99:
array (size=8)
  0 => int 11
  1 => int 13
  2 => int 34
  3 => int 35
  4 => int 36
  5 => int 49
  6 => int 50
  7 => int 51

Test: non exitent value
var_dump(safeSqlFastSearch("hackattempts","type","a"));
C:\wamp\www\kant\index.php:99:
array (size=0)
  empty
T.G: it works perfectly








5) table
function sqlCreateTable($tableName,$fieldsString);

Test: newTable:
var_dump(sqlCreateTable("test_1",
"id int,value varchar(50)"));
C:\wamp\www\kant\index.php:101:boolean true
(Note: the table was really created)
T.G: it works perfectly

Test: existent table
var_dump(sqlCreateTable("test_1",
"id int,value varchar(50)"));
C:\wamp\www\kant\index.php:101:boolean false
T.G: it works perfectly



function sqlDropTable($tableName);

Test: existent table
var_dump(sqlDropTable("test_1"));
C:\wamp\www\kant\index.php:99:boolean true
(Note: the table was really deleted)
T.G: it works perfectly

Test: non existent table
var_dump(sqlDropTable("test_1"));
C:\wamp\www\kant\index.php:99:boolean false
T.G: it works perfectly


function sqlDeleteTableContent($tableName);

Test: existent table

sqlCreateTable("test_1",
"id int,value varchar(50)");
sqlSafeInsert("test_1",array("id","value"),
array("1","hi"));
//var_dump(sqlDeleteTableContent("test_1"));
first make it a comment to check whther the record is set
or not
Then move remove the comment and run
Note: T.G: The data was stored successfully
Now removing the comment
C:\wamp\www\kant\index.php:104:boolean true
Note: the data was removed successfully
T.G: it works perfectly


Test: empty table
sqlCreateTable("test_1",
"id int,value varchar(50)");
sqlDeleteTableContent("test_1");
var_dump(sqlDeleteTableContent("test_1"));
C:\wamp\www\kant\index.php:104:boolean true
T.G: t works perfectly



Test: non existent table
sqlCreateTable("test_1",
"id int,value varchar(50)");
sqlDropTable("test_1");
var_dump(sqlDeleteTableContent("test_1"));
C:\wamp\www\kant\index.php:102:boolean false
T.G: it works perfectly









6) delete
function sqlDelete($tableName,$condition);
	-Test: v 2nd record
	sqlDeleteTableContent("test_table");
	$assocNamesValues= array("id"=>"1", "field1"=> "f1",
	"field2"=>"f2");
	sqlSafeInsertInhanced("test_table",$assocNamesValues);
	$assocNamesValues= array("id"=>"2", "field1"=> "f1",
	"field2"=>"f2");
	sqlSafeInsertInhanced("test_table",$assocNamesValues);
	var_dump(sqlDelete("test_table","id=2"));
	C:\wamp\www\kant\index.php:30:boolean true
	Note: in the table there is only the first record
	Conclusion: It works
	T.G: iw works perfectly


	-Test: v 1st record
	sqlDeleteTableContent("test_table");
	$assocNamesValues= array("id"=>"1", "field1"=> "f1",
	"field2"=>"f2");
	sqlSafeInsertInhanced("test_table",$assocNamesValues);
	$assocNamesValues= array("id"=>"2", "field1"=> "f1",
	"field2"=>"f2");
	sqlSafeInsertInhanced("test_table",$assocNamesValues);
	var_dump(sqlDelete("test_table","id=1"));
	C:\wamp\www\kant\index.php:109:boolean true
	Note: in the table there is only the second the record
	Conclusion: it works
	T.G: iw works perfectly

	-Test: all records
	sqlDeleteTableContent("test_table");
	$assocNamesValues= array("id"=>"1", "field1"=> "f1",
	"field2"=>"f2");
	sqlSafeInsertInhanced("test_table",$assocNamesValues);
	$assocNamesValues= array("id"=>"2", "field1"=> "f1",
	"field2"=>"f2");
	sqlSafeInsertInhanced("test_table",$assocNamesValues);
	var_dump(sqlDelete("test_table",""));
	C:\wamp\www\kant\index.php:111:boolean true
	Note: the table is empty
	Conclusion: it works
	T.G: iw works perfectly


	-Test: wrong id
	sqlDeleteTableContent("test_table");
	var_dump(sqlDelete("test_table","id=1"));
	C:\wamp\www\kant\index.php:102:boolean true
	T.G: it works perfectly

	
	-Test: all table, empty table
	sqlDeleteTableContent("test_table");
	var_dump(sqlDelete("test_table",""));
	C:\wamp\www\kant\index.php:101:boolean true
	T.G: it works perfectly

	-Test: wrong table name
	var_dump(sqlDelete("no_table_has_this_name",""));
	C:\wamp\www\kant\index.php:102:boolean false
	T.G: it works perfectly



*/
?>