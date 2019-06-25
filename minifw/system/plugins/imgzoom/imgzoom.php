<?php

$IMGZOOM=true;
$IMGZOOMCSSLOAD=false;

$IMGZOOM_START_BUTTON=true;



function imgzoom($img='',$text='',$butt=''){
	global $SYS_PLUGINS_DIR,$IMGZOOMCSSLOAD,$IMGZOOM_START_BUTTON;

	if (!$IMGZOOMCSSLOAD){
		if (file_exists($SYS_PLUGINS_DIR."imgzoom/imgzoom.css")){
			include($SYS_PLUGINS_DIR."imgzoom/imgzoom.css");
		}
	}
	
	echo("<div class=\"iz-dropdown\">");
	if (($IMGZOOM_START_BUTTON)and($butt<>"")){
		echo("<button class=\"iz-button\">$butt</button>");
	}else{
		echo("<div class=\"iz-miniimg\">");
		echo("<img class=\"iz-miniimg2\" src=\"$img\" alt=\"$text\"></div>");
	}
	echo("<div class=\"iz-dropdown-content\">");
	echo("<img class=\"iz-img\" src=\"$img\" alt=\"$text\">");
	echo("<div class=\"iz-desc\">$text</div>");
	echo("</div>");
	echo("</div>");
	
	if (!$IMGZOOMCSSLOAD){
		if (file_exists($SYS_PLUGINS_DIR."imgzoom/imgzoom.js")){
			#include($SYS_PLUGINS_DIR."imgzoom/imgzoom.js");
		}
		$IMGZOOMCSSLOAD=true;
	}
	
}


?>
