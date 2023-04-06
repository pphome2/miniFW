<?php


# configuration

# copyright link
$S_COPYRIGHT="© ".date("Y").". <a href=https://github.com/pphome2>Github</a>";

# title, home link
$S_SITENAME="DemoMiniSite";
$S_DOCTYPE="<!DOCTYPE html>";
$S_FAVICON="favicon.png";
$S_SITEURL=basename($_SERVER['PHP_SELF']);

$S_APPFILES=array("d1.php");

$S_TEMPLATE="sidenav";

$S_TEMPLATE_HEADER="dheader.php";
$S_TEMPLATE_FOOTER="dfooter.php";
$S_TEMPLATE_CSS=array("d.css");
$S_JS_HEAD=array("");
$S_JS_FOOT=array("d.js");

$S_CSS="d.css";
$S_JS="d.js";

# menü
$S_MENU_LETTER="m";
$S_MENUCODE=array();

$S_MENU=array(
          array("Kezdőlap"),
          array("Vezérlőpult"),
          array("Mentés"),
          array("Felhasználók"),
          array("Beállítások"),
          array("Megjelenés","Oldalbeálítás","Menük"),
          array("Testreszabás"),
          array("Menük","Almenü1","Almenü2"),
          array("Médiatár"),
          array("Bővítmények")
          );

# betöltés
for($i=0;$i<count($S_APPFILES);$i++){
    if (file_exists("$MA_CONTENT_DIR/$S_APPFILES[$i]")){
        include("$MA_CONTENT_DIR/$S_APPFILES[$i]");
    }
}


?>
