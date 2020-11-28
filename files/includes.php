<?php
/*
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