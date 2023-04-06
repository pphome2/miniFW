<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #

# configuration

# copyright link
$MA_COPYRIGHT="© ".date("Y").". <a href=https://github.com/pphome2>Github</a>";

# title, home link
$MA_SITENAME="MiniApp";
$MA_TITLE="MiniApp";
$MA_CODENAME="mapp";
$MA_ROOT_HOME="https://google.com";
$MA_ROOT_NAME="Google";
$MA_SITE_HOME="";
$MA_DOCTYPE="<!DOCTYPE html>";
$MA_SITEURL=basename($_SERVER['PHP_SELF']);

# include files
$MA_HEADER="header.php";
$MA_FOOTER="footer.php";
$MA_HEADER_VIEW="header_view.php";
$MA_FOOTER_VIEW="footer_view.php";
$MA_HEADER_PRINT="header_print.php";
$MA_FOOTER_PRINT="footer_print.php";
$MA_FAVICON="favicon.png";

# header, footer
$MA_ENABLE_HEADER=true;
$MA_ENABLE_FOOTER=true;
$MA_ENABLE_HEADER_VIEW=false;
$MA_ENABLE_FOOTER_VIEW=false;
# pages
$MA_ENABLE_PRIVACY=false;
$MA_ENABLE_PRINT=true;
$MA_ENABLE_SEARCH=true;
$MA_ENABLE_THEME=false;

# template variables
$MA_STYLEINDEX=0;

# template files
$MA_TEMPLATE_CSS=array();
$MA_TEMPLATE_FILES=array($MA_LANGFILE,"");

?>
