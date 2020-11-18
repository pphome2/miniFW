<?php

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
	
	card_form_start();
	
	if (isset($MENU)){
		menu_to_form();
	}
	if (isset($CARD)){
		sidenav_to_form();
	}
	card_form_end();
		
	cardrow_start();
	$CARD_MENU_LEFT=true;
	cardmenu50($menu,"<img src=../content/img/1.jpg>");
	$CARD_MENU_LEFT=false;
	cardmenu50($menu,"tartalom 2");
	cardrow_end();
	
}


echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");


?>
