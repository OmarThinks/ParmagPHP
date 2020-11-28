<?php

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

TEST:

function now();

var_dump(now());
C:\wamp\www\kant\index.php:66:string 
'2018-09-02 10:16:27:am' (length=22)

*/
?>