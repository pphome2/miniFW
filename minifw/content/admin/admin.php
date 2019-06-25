<?php

 #
 # MiniCMS - demo
 #
 # info: main folder copyright file
 #
 #


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
		);
	get_menu_name();
	menu_line($menu);
}

echo("</header>");

echo("<div class=\"content\">");


echo("<h1>Adminisztráció</h1>");


echo("</div>");



echo("<footer>");

if (isset($FOOTER)){
	$copyr=$SYS_COPYRIGHT."<a href='../public'>Nyitólap</a>";
	footer($copyr,$SYS_DEVELOPER,$SYS_DEVELOPER_NAME,$SYS_DEVELOPER_MAIL);
}

echo("</footer>");



if (file_exists($LOCAL_JS_END)){
    include("$LOCAL_JS_END");
}

?>
