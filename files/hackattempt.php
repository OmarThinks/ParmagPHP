<?php
/*
Summary
1)id
2)date
3)device
4)description
5)type

*/



function recordHack($type)
{
	$id=getNewId("hackattempts");
	$date=now();
	$device=getUserDevice();
	//summaryOfSessions();
	if(isset($_SESSION['fastId']))
		{$fast=$_SESSION['fastId'];}
	else{$fast="";}
	if(isset($_SESSION['realId']))
		{$real=$_SESSION['realId'];}
	else{$real="";}

	$description=prepareDescription($type);
	$toInsert=array
	("id"=>$id,"date"=>$date,"device"=>$device,
	"description"=>$description,"type"=>$type,
	"fast_account"=>$fast,"real_account"=>$real
	);

	sqlSafeInsertInhanced
	("hackattempts",$toInsert);


}




function prepareDescription($type)
{
	$toReturn="";
	switch ($type) {
    case 1:
        return hack001();
        break;
    case 2:
        return hack002();
        break;
    case 3:
        return hack003();
        break;
    case 4:
        return hack004();
        break;
    case 5:
        return hack005();
        break;
    case 6:
        return hack006();
        break;
    case 7:
        return hack007();
        break;
    case 8:
        return hack008();
        break;
    case 9:
        return hack009();
        break;
    case 10:
        return hack010();
        break;
	case 11:
        return hack011();
        break;
    case 12:
        return hack012();
        break;
    case 13:
        return hack013();
        break;
    case 14:
        return hack014();
        break;
    case 15:
        return hack015();
        break;
    case 16:
        return hack016();
        break;
    case 17:
        return hack017();
        break;
    case 18:
        return hack018();
        break;
    case 19:
        return hack019();
        break;
    case 20:
        return hack020();
        break;

    default:
        return ("unhandled hack type ".$type);


}

}

function hack001()
{

	$length=strlen(getFastCookie());
	$toReturn="Length of fast cookie value= "
		.$length.";";
	if ($length>100) 
	{
		$toReturn=$toReturn."Can't record this, It's more than 100 characters, It will cause insufficient memory";
	}

	else
		{
			$s=htmlspecialchars(getFastCookie());
			$toReturn=$toReturn."The value is:".$s;
		}
	return $toReturn;
}



function hack002()
{
	$length=strlen(getRealCookie());
	$toReturn="Length of real cookie value= "
		.$length.";";
	if ($length>100) 
	{
		$toReturn=$toReturn."Can't record this, It's more than 100 characters, It will cause insufficient memory";
	}

	else
		{
			$s=htmlspecialchars(getRealCookie());
			$toReturn=$toReturn."The value is:".$s;
		}
	return $toReturn;
}




function hack003()
{
	$toReturn="fast cookie values doesn't contain only numbers;";
	$s=htmlspecialchars(getFastCookie());
	$toReturn=$toReturn."It's value is:".$s;
	return $toReturn;
}
function hack004()
{
	$toReturn="real cookie values doesn't contain only numbers;";
	$s=htmlspecialchars(getRealCookie());
	$toReturn=$toReturn."It's value is:".$s;
	return $toReturn;
}
function hack005()
{
	$toReturn="fast cookie values doesn't exist in the table;";
	$s=htmlspecialchars(getFastCookie());
	$toReturn=$toReturn."It's value is:".$s;
	return $toReturn;
}

function hack006()
{
	$toReturn="real cookie values doesn't exist in the table;";
	$s=htmlspecialchars(getRealCookie());
	$toReturn=$toReturn."It's value is:".$s;
	return $toReturn;
}
function hack007()
{
	$toReturn="fast cookie value contains the value of a deleted account;";
	$s=htmlspecialchars(getFastCookie());
	$toReturn=$toReturn."It's value is:".$s;
	return $toReturn;
}
function hack008()
{
	$toReturn="real cookie value contains the value of a deleted account;";
	$s=htmlspecialchars(getRealCookie());
	$toReturn=$toReturn."It's value is:".$s;
	return $toReturn;
}
function hack009()
{
	$toReturn="cookie:wrong fast account device;";
	$id=htmlspecialchars(getFastCookie());
	$rightDevice=getSqlFastAccountDevice($id);
	$toReturn=$toReturn."the right device is:"
	.$rightDevice;
	return $toReturn;
}
function hack010()
{
	$toReturn="cookie:wrong real account device;";
	$id=htmlspecialchars(getRealCookie());
	$rightDevice=getRealAccountDevice($id);
	$toReturn=$toReturn."the right devices are:"
	.$rightDevice;
	var_dump($toReturn);
	return $toReturn;

}






function hack011()
{

	$length=strlen(getFastSession());
	$toReturn="Length of fast session value= "
		.$length.";";
	if ($length>100) 
	{
		$toReturn=$toReturn."Can't record this, It's more than 100 characters, It will cause insufficient memory";
	}

	else
		{
			$s=htmlspecialchars(getFastSession());
			$toReturn=$toReturn."The value is:".$s;
		}
	return $toReturn;
}



function hack012()
{
	$length=strlen(getRealCookie());
	$toReturn="Length of Real cookie value= "
		.$length.";";
	if ($length>100) 
	{
		$toReturn=$toReturn."Can't record this, It's more than 100 characters, It will cause insufficient memory";
	}

	else
		{
			$s=htmlspecialchars(getLogInCookie());
			$toReturn=$toReturn."The value is:".$s;
		}
	return $toReturn;
}




function hack013()
{
	$toReturn="fast session values doesn't contain only numbers;";
	$s=htmlspecialchars(getFastSession());
	$toReturn=$toReturn."It's value is:".$s;
	return $toReturn;
}
function hack014()
{
	$toReturn="LogIn cookie values doesn't contain only numbers;";
	$s=htmlspecialchars(getLogInCookie());
	$toReturn=$toReturn."It's value is:".$s;
	return $toReturn;
}
function hack015()
{
	$toReturn="fast session values doesn't exist in the table;";
	$s=htmlspecialchars(getFastSession());
	$toReturn=$toReturn."It's value is:".$s;
	return $toReturn;
}

function hack016()
{
	$toReturn="log in cookie values doesn't exist in the table;";
	$s=htmlspecialchars(getLogInCookie());
	$toReturn=$toReturn."It's value is:".$s;
	return $toReturn;
}
function hack017()
{
	$toReturn="fast session value contains the value of a deleted account;";
	$s=htmlspecialchars(getFastSession());
	$toReturn=$toReturn."It's value is:".$s;
	return $toReturn;
}
function hack018()
{
	$toReturn="log in cookie value contains the value of a deleted account;";
	$s=htmlspecialchars(getLogInCookie());
	$toReturn=$toReturn."It's value is:".$s;
	return $toReturn;
}
function hack019()
{
	$toReturn="session: wrong fast account device;";
	$id=htmlspecialchars(getFastSession());
	$rightDevice=getSqlFastAccountDevice($id);
	$toReturn=$toReturn."the right device is:"
	.$rightDevice;
	return $toReturn;
}
function hack020()
{//can't do this now for accounts

}







/*

1)id=id of this hack in the table
2)date=date of the hack
3)device=device information
4)description=more details about the hack, the info change by the change in the type of the hack
5)type

001)cookie fast value contains letters than the maximum 
amount of letters
002)LogIn
003)cookie: the fast cookie value doesn't contain only numbers
004)logIn
005)cookie fast value does not exist in the table 
006)LogIn
007)cookie: fast deleted account
008)LogIn
009)cookie: wrong fast device
010)logIn


011)session fast value contains letters than the maximum 
amount of letters
012)LogIn
013)session: the fast session value doesn't contain only numbers
014)logIn
015)session fast value does not exist in the table 
016)LogIn
017)session: fast deleted account
018)LogIn
019)session: wrong fast device
020)logIn









Description:
function recordHack($description,$type);
recordHack("1");









function hack001();
The limited number is 50
It exists in cookies 7)check
//deleteFastCookie();
setFastCookie
("1234567891123456789212345678931234567894");
//cookieCount();
recordHack(1);
//Length of fast cookie value= 40;The value is:123...


setFastCookie
("12345678911234567892123456789312345678941234567895"
.
"12345678911234567892123456789312345678941234567895"
.
"12345678911234567892123456789312345678941234567895"
);
cookieCount();
recordHack(1);
//Length of fast cookie value= 150;Can't record th...









function hack003();

//deleteFastCookie();
setFastCookie("1a");
cookieCount();
recordHack(3);
//fast cookie values doesn't contain only numbers;...







function hack005();
//deleteFastCookie();
setFastCookie("1a");
cookieCount();
recordHack(5);
//fast cookie values doesn't exist in the table;It...





function hack007();
//deleteFastCookie();
setFastCookie("1");
cookieCount();
recordHack(7);
//fast cookie values contains the value of a delet...







function hack009();
//deleteFastCookie();
setFastCookie("1");
cookieCount();
recordHack(9);
//wrong fast account device;the right device is:::...











function hack011();
The limited number is 50
It exists in cookies 7)check
//deleteFastSession();
$_SESSION['fastId']=
("1234567891123456789212345678931234567894");
recordHack(11);
//Length of fast session value= 40;The value is:12...



$_SESSION['fastId']=
("12345678911234567892123456789312345678941234567895"
.
"12345678911234567892123456789312345678941234567895"
.
"12345678911234567892123456789312345678941234567895"
);
var_dump(getFastSession());
recordHack(11);
//Length of fast session value= 150;Can't record t...










function hack013();

//deleteFastSession();
$_SESSION['fastId']="1a";
var_dump(getFastSession());
recordHack(13);
//fast session values doesn't contain only numbers...






function hack015();
$_SESSION['fastId']="11345678974564";
var_dump(getFastSession());
recordHack(15);
//fast session values doesn't exist in the table;I...






function hack017();
deleteSqlFastAccount(1);
$_SESSION['fastId']="1";
var_dump(getFastSession());
recordHack(17);
//fast session value contains the value of a delet...







function hack019();
//setSqlFastAccountDevice(1,"randomValue");
$_SESSION['fastId']="1";
var_dump(getFastSession());
recordHack(19);
//session: wrong fast account device;the right dev...













*/




?>