<?php

echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");

if (isset($FORM)){
	# mezőnév, típus, placeholder, válastási lehetőségek, hossz (karakter)
	$formdata = array
		(
			array("Név",				"text",		"Felhasználói név",	"",	"200"),
			array("Jelszó",				"password",	"Jelszó",			"",	"200"),
			array("Teljes név",			"text",		"Teljes név",		"",	"200"),
			array("Ország",				"select",	"",					"Magyarország;Erdély;Délvidék",	""),
			array("Nem",				"radio",	"",					"Férfi;Nő;Nincs",	""),
			array("Kedvenc zene",		"checkbox",	"",					"Pop;Rock;Komolyzene;Népzene",	""),
			array("Kedvenc hely",		"textarea",	"Egyéb adatok",		"",	""),
		);

	form_start();
	if ($MENU){
		menu_to_form();
	}
	if ($SIDENAV){
		sidenav_to_form();
	}
	if ($PASSWORD){
		password_to_form($SYS_ADMIN_PASS);
	}
	form("Adatbekérés",$formdata,"Mehet");
	form_end();
}

echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");



?>
