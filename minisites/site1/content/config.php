<?php


# configuration

# copyright link
$S_COPYRIGHT="© ".date("Y").". <a href=https://github.com/pphome2>Github</a>";

# title, home link
$S_SITENAME="DemoMiniSite";
$S_DOCTYPE="<!DOCTYPE html>";
$S_FAVICON="favicon.png";
$S_SITEURL=basename($_SERVER['PHP_SELF']);

$S_CONTENT_DIR="content";
$S_TEMPLATE_DIR="template";

$S_APPFILES=array("d1.php");

$S_TEMPLATE_HEADER="dheader.php";
$S_TEMPLATE_FOOTER="dfooter.php";
$S_TEMPLATE_CSS=array("d.css");
$S_JS_HEAD=array("d.js");
$S_JS_FOOT=array();

# betöltés

for($i=0;$i<count($S_APPFILES);$i++){
    if (file_exists("$S_CONTENT_DIR/$S_APPFILES[$i]")){
        include("$S_CONTENT_DIR/$S_APPFILES[$i]");
    }
}


?>
