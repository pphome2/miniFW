<?php

 #
 # MiniFW - starter
 #
 # info: main folder copyright file
 #
 #


if (file_exists("../public/prepare.php")){
    include("../public/prepare.php");
}



if (file_exists($SYS_MAIN_COMMANDER)){
	include($SYS_MAIN_COMMANDER);
}



if (file_exists("../public/prepare_end.php")){
    include("../public/prepare_end.php");
}


?>
