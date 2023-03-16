<?php

 #
 # MiniFW - demo
 #
 # info: main folder copyright file
 #
 #



#if (file_exists("../public/prepare.php")){
#    include("../public/prepare.php");
#}


if (file_exists($LOCAL_JS_BEGIN)){
    include("$LOCAL_JS_BEGIN");
}


if (file_exists("$SYS_CONTENT_DIR/$LOCAL_CSS")){
    include("$SYS_CONTENT_DIR/$LOCAL_CSS");
}


echo("<header>");

if (isset($MENU)){
	$menu = array
		(
			array("Kártyák",	"",					"Kártyák"),
			array("Táblázatok",	"",					"Táblázatok"),
			array("Képek",		"Gomb;Felugró;Nagyító;Galéria;Slider",	"Gomb;Felugró;Nagyító;Galéria;Slider"),
			array("Adatbekérés","",						"Adatbekérés"),
			array("Lapok",		"",					"Lapok"),
			array("Egyebek",	"",					"Egyebek")
		);
    
    get_menu_name();
    menu_line($menu);
    
    #$h=array("Első","Második","Harmadik");
    #$l=array("","","");
    #menu_line_links($h,$l);
    echo("<br />Menü: $MENUNAME");
    
}

if (isset($SIDENAV)){
	$names=array("Kártyák","Táblázatok","Galéria","Adatbekérés","Lapok","Egyebek");
	$links=array("Kártyák","Táblázatok","Galéria","Adatbekérés","Lapok","Egyebek");
	get_sidenav_name();
	sidenav($names,$links,"");
	echo("<br />Sidenav: $SIDENAVNAME");
}


echo("</header>");


echo("<div class=\"content\">");


if (isset($MENU)){
	switch ($MENUNAME){
			case "Kártyák":
				if (file_exists($SYS_CONTENT_DIR."card.php")){
					include($SYS_CONTENT_DIR."card.php");
				}
				break;
			case "Táblázatok":
				if (file_exists($SYS_CONTENT_DIR."table.php")){
					include($SYS_CONTENT_DIR."table.php");
				}
				break;
			case "Gomb":
				if (file_exists($SYS_CONTENT_DIR."button.php")){
					include($SYS_CONTENT_DIR."button.php");
				}
				break;
			case "Felugró":
				if (file_exists($SYS_CONTENT_DIR."modal.php")){
					include($SYS_CONTENT_DIR."modal.php");
				}
				break;
			case "Nagyító":
				if (file_exists($SYS_CONTENT_DIR."zoom.php")){
					include($SYS_CONTENT_DIR."zoom.php");
				}
				break;
			case "Galéria":
				if (file_exists($SYS_CONTENT_DIR."gallery.php")){
					include($SYS_CONTENT_DIR."gallery.php");
				}
				break;
			case "Slider":
				if (file_exists($SYS_CONTENT_DIR."slider.php")){
					include($SYS_CONTENT_DIR."slider.php");
				}
				break;
			case "Adatbekérés":
				if (file_exists($SYS_CONTENT_DIR."form.php")){
					include($SYS_CONTENT_DIR."form.php");
				}
				break;
			case "Lapok":
				if (file_exists($SYS_CONTENT_DIR."tabs.php")){
					include($SYS_CONTENT_DIR."tabs.php");
				}
				break;
			case "Egyebek":
				if (file_exists($SYS_CONTENT_DIR."others.php")){
					include($SYS_CONTENT_DIR."others.php");
				}
				break;
			default:
				if (file_exists($SYS_CONTENT_DIR."all.php")){
					include($SYS_CONTENT_DIR."all.php");
				}
				break;
	}
}

if (isset($SIDENAV)){
	switch ($SIDENAVNAME){
			case "Kártyák":
				if (file_exists($SYS_CONTENT_DIR."card.php")){
					include($SYS_CONTENT_DIR."card.php");
				}
				break;
			case "Táblázatok":
				if (file_exists($SYS_CONTENT_DIR."table.php")){
					include($SYS_CONTENT_DIR."table.php");
				}
				break;
			case "Galéria":
				if (file_exists($SYS_CONTENT_DIR."gallery.php")){
					include($SYS_CONTENT_DIR."gallery.php");
				}
				break;
			case "Adatbekérés":
				if (file_exists($SYS_CONTENT_DIR."form.php")){
					include($SYS_CONTENT_DIR."form.php");
				}
				break;
			case "Lapok":
				if (file_exists($SYS_CONTENT_DIR."tabs.php")){
					include($SYS_CONTENT_DIR."tabs.php");
				}
				break;
			case "Egyebek":
				if (file_exists($SYS_CONTENT_DIR."others.php")){
					include($SYS_CONTENT_DIR."others.php");
				}
				break;
			default:
				break;
	}
}


echo("</div>");




if (isset($COLUMN)){
	$c = array
		(
			array("<b>Autó</b>",		"Renault","Saab"),
			array("<b>Eladva</b>",		22,			18),
			#array("<b>Dobozolt</b>",	15,			13),
			#array("<b>Újszerű</b>",	5,			2),
			array("<b>Raktáron</b>",	17,			15)
		);

	column_footer($c);
}



if (isset($GDPR)){
	gdpr();
}

if (isset($GOTOTOP)){
	gototop();
}



echo("<footer>");

if (isset($FOOTER)){
	$copyr=$SYS_COPYRIGHT."<a href='../admin'>Admin</a>";
	footer($copyr,$SYS_DEVELOPER,$SYS_DEVELOPER_NAME,$SYS_DEVELOPER_MAIL);
}

echo("</footer>");



if (file_exists($LOCAL_JS_END)){
    include("$LOCAL_JS_END");
}

#if (file_exists("../public/prepare_end.php")){
#    include("../public/prepare_end.php");
#}


?>
