<?php
 #
 # MiniApps - demo main config
 #
 # info: main folder copyright file
 #
 #

# configuration
$MA_APP_CODENAME="demo";
$MA_APP_TEMPLATE="miniapp";

# language
$MA_LANGFILE="l_hu.php";

# local app main and css file
$MA_APPFILE=array("$MA_LANGFILE",
                "dcfg.php",
                "d.php"
            );
$MA_APPCSSFILE=array("d.css");
$MA_APPJSFILE=array("d.js");
$MA_APPPRIVACYFILE="privacy.txt";

# login
$MA_ENABLE_LOGIN=true;
$MA_ENABLE_LOGIN_VIEW=true;

# menu
$MA_MENU_FIELD="m";
$MA_MENUCODE=array();
# user menu
$MA_MENU=array();
# adminmenu
$MA_ADMINMENU=array();
# footer menu
$MA_FOOTERMENU=array();
# back icon in menu
$MA_BACKPAGE=false;

# other variables
$MA_PRIVACY_PAGE=false;
$MA_SEARCH_PAGE=false;

?>
