<?php
/*


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