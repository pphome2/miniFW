<?php

$BUTTON=true;
$BUTTONCSSLOAD=false;
$BUTTONPARAM="buttlink";
$BUTTONNUM=0;



function button($text='',$link=''){
	global $SYS_PLUGINS_DIR,$BUTTONCSSLOAD,$BUTTONPARAM,$BUTTONNUM;

	if (!$BUTTONCSSLOAD){
		if (file_exists($SYS_PLUGINS_DIR."button/button.css")){
			include($SYS_PLUGINS_DIR."button/button.css");
		}
	}
	
	echo("<input id=\"buttontext\" name=$BUTTONPARAM type=text value=\"$link\" style=\"display:none;\">");
	
	echo("<div class=\"bu-place\">");
	echo("<button class=\"bu-button\">$text</button>");
	echo("</div>");
	
	if (!$BUTTONCSSLOAD){
		if (file_exists($SYS_PLUGINS_DIR."button/button.js")){
			#include($SYS_PLUGINS_DIR."button/button.js");
		}
		$BUTTONCSSLOAD=true;
	}
	
}




function buttonform_start(){
	global $BUTTONFORM_STARTED,$BUTTONPARAM,$BUTTONNUM;

	if (!$BUTTONFORM_STARTED){
		echo("<form method=post id=\"buttonform$BUTTONNUM\" name=\"buttonform$BUTTONNUM\">");
		$BUTTONNUM++;
		$BUTTONFORM_STARTED=true;
	}
}


function buttonform_end(){
	global $BUTTONFORM_STARTED;

	if ($BUTTONFORM_STARTED){
		echo("</form>");
		$BUTTONFORM_STARTED=false;
	}
}


function buttonform_get(){
	global $BUTTONPARAM;

	$ret="";
	if (isset($_POST["$BUTTONPARAM"])){
		$ret=$_POST["$BUTTONPARAM"];
	}
	return($ret);
}




?>
