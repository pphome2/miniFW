<?php

 #
 # MiniFW - Admin app
 #
 # info: main folder copyright file
 #
 #

# configuration

# copyright link
$MA_COPYRIGHT="© ".date("Y").". <a href=https://github.com/pphome2>Github</a>";

# menü
$A_MENUCODE=array("0","1","2");
$MA_ADMINMENU=array(
            array("$A_MENUTITLE[0]","$A_MENUCODE[0]"),
            array("$A_MENUTITLE[1]","$A_MENUCODE[1]"),
            array("$A_MENUTITLE[2]","$A_MENUCODE[2]")
            );
$MA_FOOTERMENU=array(
            array("$A_MENUTITLE[0]","$A_MENUCODE[0]"),
            array("$A_MENUTITLE[1]","$A_MENUCODE[1]"),
            array("$A_MENUTITLE[2]","$A_MENUCODE[2]")
            );

# admin fájlok
$A_APPFILES=array("$MA_LANGFILE","a1.php");
$A_CSSFILE=array("a.css");
$A_JSFILE=array("a.js");

?>
