<?php

echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");


$img = array
		(
			array("../content/img/1.jpg",	"Első kép"),
			array("../content/img/2.jpg",	""),
			array("../content/img/3.jpg",	"Harmadik kép")
		);


if (isset($IMGSLIDER)){
	imgautoslider($img);
}

echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");


if (isset($IMGZOOM)){
	imgzoom("../content/img/1.jpg","Első kép","Kép megjelenítése 1");
	imgzoom("../content/img/2.jpg","Második kép","Kép megjelenítése 2");
	imgzoom("../content/img/3.jpg","Harmadik kép","Kép megjelenítése 3");
	imgzoom("../content/img/3.jpg","Harmadik kép","");
}


echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");

if (isset($IMGSLIDER)){
	imgslider($img); 
}



echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");

if (isset($MODALBOX)){
	$m="<img src=../content/img/1.jpg>";
	modalbox_button("Kép nagyítása","Egy kép a képtárból",$m,"");
}
echo("<div class=spaceline50></div>");
if (isset($MODALBOX)){
	$m="<img src=../content/img/2.jpg>";
	modalbox_button("Kép nagyítása","Egy kép a képtárból",$m,"");
}
echo("<div class=spaceline50></div>");
if (isset($MODALBOX)){
	$m="<img src=../content/img/3.jpg>";
	modalbox("<center><img src=../content/img/3.jpg style=\"width:10%;cursor:pointer;\"></center>","Egy kép a képtárból",$m,"");
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

if (isset($IMGGALLERY)){
	$img=array("../content/img/1.jpg","../content/img/2.jpg","../content/img/3.jpg");
	$text=array("111","222","333");
	imggallery($img,$text);
}

echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");

if (isset($IMGGALLERY)){
	$img=array("../content/img/1.jpg","../content/img/2.jpg","../content/img/3.jpg");
	$text=array("111","222","333");
	mimggallery($img,$text);
}

echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");

if (isset($IMGGALLERY)){
	$img="../content/img/1.jpg";
	$text="111";
	bimgmodal($img,$text);
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



if (isset($CARD)){
	card();
	
	mess_ok_menu("Rendben","Minden rendben");
	mess_error_menu("Error","Nincs minden rendben");
	mess_ok("Rendben","Minden rendben");
	mess_error("Error","Nincs minden rendben");
	
	cardrow_start();
	card50("Első kártya","<img src=../content/img/1.jpg>");
	card50("Második kártya","<img src=../content/img/2.jpg>");
	cardrow_end();
	
	cardrow_start();
	card33("Első kártya","<img src=../content/img/1.jpg>");
	card33("Második kártya","<img src=../content/img/2.jpg>");
	card33("Harmadik kártya","<img src=../content/img/3.jpg>");
	cardrow_end();
	
	cardrow_start();
	card25("Első kártya","<img src=../content/img/1.jpg>");
	card25("Második kártya","tartalom 2");
	card25("Harmadik kártya","tartalom 3");
	card25("Negyedik kártya","<img src=../content/img/1.jpg>");
	cardrow_end();
	
	$t=get_card_name();
	echo("Card-menü: $t");
	$menu=array(
			array("Sor 1","link1"),
			array("Sor 2","link2"),
			array("Sor 3","link3")
	);
	cardrow_start();
	$CARD_MENU_LEFT=true;
	cardmenu50($menu,"<img src=../content/img/1.jpg>");
	$CARD_MENU_LEFT=false;
	cardmenu50($menu,"tartalom 2");
	cardrow_end();
}


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

?>
