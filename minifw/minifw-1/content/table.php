<?php


echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");

if (isset($TABLER)){
	$cars = array
		(
			array("Autó",		"Eladva","Raktáron"),
			array("Volvo",		22,			18),
			array("BMW",		15,			13),
			array("Saab",		5,			2),
			array("Land Rover",	17,			15)
		);

	tabler($cars,0);
}

echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");

if (isset($TABLER)){
	$cars = array
		(
			array("Autó",		"Eladva","Raktáron"),
			array("Volvo",		22,			18),
			array("BMW",		15,			13),
			array("Saab",		5,			2),
			array("Land Rover",	17,			15)
		);

	tabler($cars,1);
}

echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");


?>
