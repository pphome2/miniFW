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
#$MA_COPYRIGHT="<a href=https://github.com/pphome2>Github</a>";

# menü
$MA_MENUCODE=array("0","1","2");
$MA_ADMINMENU=array(
            array("$A_MENUTITLE[0]","$MA_MENUCODE[0]"),
            array("$A_MENUTITLE[1]","$MA_MENUCODE[1]"),
            array("$A_MENUTITLE[2]","$MA_MENUCODE[2]")
            );
$MA_FOOTERMENU=array(
            array("$A_MENUTITLE[0]","$MA_MENUCODE[0]"),
            array("$A_MENUTITLE[1]","$MA_MENUCODE[1]"),
            array("$A_MENUTITLE[2]","$MA_MENUCODE[2]")
            );

# mentés
$A_SITE_ROOT="../";
$A_BACKUP_TABLES=array("mfw-users","mfw-params");


# admin fájlok
$A_APPFILES=array(
                "$MA_LANGFILE",
                "au.php",
                "ap.php",
                "ab.php",
                "a.php"
                );

$A_CSSFILE=array("a.css");
$A_JSFILE=array("a.js");

# változók
$A_PAGEROW=100;

$A_BACKUP_DIR="data";


?>
