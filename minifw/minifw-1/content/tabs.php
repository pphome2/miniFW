<?php

echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");


if (isset($TABS)){
	$cars = array
		(
			array("Volvo",		"Ez egy Volvó autó.<br /><img src=../content/img/1.jpg>"),
			array("BMW",		"Ez egy BMW autó.<img src=../content/img/1.jpg>"),
			array("Saab",		"Ez egy Saab autó."),
			array("Land Rover",	"Ez egy LandRover autó.")
		);

	tabs($cars);
}

echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");

if (isset($TABS)){
	$cars = array
		(
			array("Volvo1",			"Ez egy Volvó autó."),
			array("BMW1",			"Ez egy BMW autó."),
			array("Saab1",			"Ez egy Saab autó."),
			array("Land Rover1",	"Ez egy LandRover autó.")
		);

	tabs($cars);
}

echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");


?>
