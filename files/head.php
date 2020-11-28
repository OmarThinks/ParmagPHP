<?php
function setHeadOfPage($input)
{
	$title="";
	$description="";
	$keyWords="";
	if($input=="index.php")
	{
		$title="Kanteene";
		$description="Shop online from the nearest Super-Market, Pharmacy, or Grocery.";
		$keyWords="Kanteene,Shop,Online,Pharmacy,Super-Market, Grocer";
	}

	elseif($input=="signup.php")
	{
		$title="Sign Up - Kanteene";
		$description="Sign up for Kanteene.com";
		$keyWords="Sign Up,Kanteene,Shop,Online,Pharmacy,Super-Market, Grocer";
	}
	elseif ($input=="login.php")
	 {
		$title="Login - Kanteene";
		$description="Login Kanteene.com";
		$keyWords="Login,Kanteene,Shop,Online,Pharmacy,Super-Market, Grocer";
	}
	elseif($input=="rememberme.php")
	{
		$title="Remember Me - Kanteene";
		$description="Quick account for Kanteene.com";
		$keyWords="Remember Me, Quick Account, Login,Kanteene,Shop,Online,Pharmacy,Super-Market, Grocer";
	}

	echo(fillHeadOfPage
	($title,$description,$keyWords));
}





function fillHeadOfPage
($title,$description,$keyWords)
{

	$toReturn1=
	'<title>';
	$toReturn2=
	$title;
	$toReturn3=
	'</title>

	<meta charset="UTF-8">
<meta name="description"
content="';
	$toReturn4=$description;
	$toReturn5=
	'">
<meta name="keywords"
content="';
	$toReturn6=$keyWords;
	$toReturn7=
	'">
<meta name="author"
content="Omar Magdy">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">



<!--
<link rel="alternate" hreflang="x-default" href="http://www.kanteene.com/" />
-->
'. getStyleSheet().'
<link rel="shortcut icon" href="images/favicon.png">';



$toReturn=$toReturn1.$toReturn2.$toReturn3.$toReturn4.$toReturn5.$toReturn6.$toReturn7;
return $toReturn;

}





function getStyleSheet()
{return '<link rel="stylesheet" type="text/css" href="css/default.css">';}




?>