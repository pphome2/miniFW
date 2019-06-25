<?php

echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");

if (isset($PRICETAB)){
	# csomagnév, ár, előnyök, link, kiemelt)
	$pdata = array
		(
			array("Mini csomag",			"10.000,- / hó",	"Mini 1;Mini 2;Mini 3;Mini 4;Mini 5",	"link1",	""),
			array("Alap csomag",			"20.000,- / hó",	"Alap 1;Alap 2;Alap 3",					"link2",	"*"),
			array("Net csomag",				"30.000,- / hó",	"Net 1;Net 2;Net 3;Net 4;Net 5",		"link3",	""),
			#array("Profi csomag",			"40.000,- / hó",	"Profi 1;Profi 2;Profi 3;Profi 4",		"link4",	""),
			#array("Üzleti csomag",			"50.000,- / hó",	"Üzleti 1;Üzleti 2;Üzleti 3;Üzlti 4",	"link5",	""),
			#array("Nagyvállalati csomag",	"60.000,- / hó",	"Nagy 1;Nagy 2;Nagy 3;Nagy 4;Nagy 5",	"link6",	""),
			#array("Intézményi csomag",		"35.000,- / hó",	"Int 1;Int 2;Int 3;Int 4;Int 5",		"link7",	""),
		);

	$l=get_pricetab_select();
	echo("Kiválasztott: $l<br />");
	pricetab_form_start();
	if ($MENU){
		menu_to_form();
	}
	if ($SIDENAV){
		sidenav_to_form();
	}
	if ($PASSWORD){
		password_to_form($SYS_ADMIN_PASS);
	}
	pricetab("Árlista",$pdata);
	pricetab_form_end();
}

echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");

if (isset($PARALLAXIMG)){
	parallaximg_start("../content/img/1.jpg");
}

echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");

if (isset($MODALCHOOSE)){
	$mcdata = array
		(
			array("Mégsem",		"gomb3",	""),
			array("Nem",		"gomb2",	""),
			array("Igen",		"gomb1",	"*"),
		);

	$l=get_modalchoose_select();
	echo("Kiválasztott: $l<br />");
	
	
	if (($MENUNAME=="Első")and($l=="")){
		modalchoose_form_start();
		if ($MENU){
			menu_to_form();
		}
		if ($SIDENAV){
			sidenav_to_form();
		}
		if ($PASSWORD){
			password_to_form($SYS_ADMIN_PASS);
		}
		modalchoose("Most mit választasz?",$mcdata);
		modalchoose_form_end();
	}
	
	
	modalchoose_form_start();
	if ($MENU){
		menu_to_form();
	}
	if ($SIDENAV){
		sidenav_to_form();
	}
	if ($PASSWORD){
		password_to_form($SYS_ADMIN_PASS);
	}
	modalchoose_button("Válassz","Most mit választasz?",$mcdata);
	modalchoose_form_end();
	
}


echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");


if (isset($COLLAPSE)){
	$header=array("1","2","3");
	$body=array("111","222<img src=../content/img/1.jpg>","333");
	collapse($header,$body);
}

echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");


if (isset($PARALLAXIMG)){
	parallaximg_end();
}

echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");


echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");

?>
