<?php


/*JSON is hard to hack*/
/*These hacking iteration were a big failure*/
/*Trust JSON*/

class Car 
{
	public $speed ;
}





$car1 = new Car();

$car1 -> speed = 5 ;
$car1 -> hack = '"play:"Value"';

var_dump($car1) ;

print("<br><br><br>");

$txt = json_encode($car1) ;
var_dump($txt);

print("<br><br><br>");


var_dump(json_decode($txt));
?>

<hr>

<p id="js_test"></p>

<script type="text/javascript">
	

function Car ()
{
}



var $toPrint = "" ;

$car1 = new Car();

$car1 . speed = 5 ;
$car1 . hack = '"play:"Value"';

//var_dump($car1) ;





//$toPrint += "<br><br><br>";

$txt = JSON . stringify($car1) ;
$toPrint += ($txt);

$toPrint +="<br><br><br>";


$toPrint += JSON . stringify(JSON . parse($txt));


document . getElementById('js_test') . innerHTML = $toPrint ;

</script>