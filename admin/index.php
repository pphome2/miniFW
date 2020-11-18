<?php

 #
 # MiniCMS - admin
 #
 # info: main folder copyright file
 #
 #


$ADMIN_SITE=true;

if (file_exists("../public/prepare.php")){
    include("../public/prepare.php");
}



if (file_exists($ADMIN_MAIN_COMMANDER)){
	include($ADMIN_MAIN_COMMANDER);
}


if (file_exists("../public/prepare_end.php")){
    include("../public/prepare_end.php");
}


?>
