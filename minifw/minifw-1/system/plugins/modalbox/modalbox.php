<?php

$MODALBOX=true;
$MODALBOXLOADCS=false;
$MODALNUM=0;

function modalbox_button($btn='',$header='',$message='',$footer=''){
	global $SYS_PLUGINS_DIR,$MODALNUM,$MODALBOXLOADCS;
	
	if (!$MODALBOXLOADCS){
		if (file_exists($SYS_PLUGINS_DIR."modalbox/modalbox.css")){
			include($SYS_PLUGINS_DIR."modalbox/modalbox.css");
			$MODALBOXLOADCS=true;
		}
	}
	
	if ($btn<>""){
		echo("<div class=\"mb-button-width\">");
		echo("<button id=\"mymbBtn$MODALNUM\" class=mb-button>$btn</button>");
		echo("</div>");
	}
	
	echo("<div id=\"mymbModal$MODALNUM\" class=\"mb-modal\">");
	
	echo("<div class=\"mb-modal-content\">");
	echo("<div class=\"mb-modal-header\">");
	echo("<span id=\"mb-close$MODALNUM\" class=\"mb-close\"></span>");
		echo("<h2>$header</h2>");
	echo("</div>");
	echo("<div class=\"mb-modal-body\">");
		echo("<p>$message</p>");
	echo("</div>");
	echo("<div class=\"mb-modal-footer\">");
		echo("<h3>$footer</h3>");
	echo("</div>");
	
	echo("</div>");
	echo("</div>");
	echo("</div>");
	
	if (file_exists($SYS_PLUGINS_DIR."modalbox/modalbox.js")){
		include($SYS_PLUGINS_DIR."modalbox/modalbox.js");
	}
	$MODALNUM++;
}


function modalbox($indicator='',$header='',$message=''){
	global $SYS_PLUGINS_DIR,$MODALNUM,$MODALBOXLOADCS;
	
	if (!$MODALBOXLOADCS){
		if (file_exists($SYS_PLUGINS_DIR."modalbox/modalbox.css")){
			include($SYS_PLUGINS_DIR."modalbox/modalbox.css");
			$MODALBOXLOADCS=true;
		}
	}
	
	if ($indicator<>""){
		echo("<div  id=\"mymbBtn$MODALNUM\" class=\"mb-indicator\">");
		echo("$indicator");
		echo("</div>");
	}
	
	echo("<div id=\"mymbModal$MODALNUM\" class=\"mb-modal\">");
	
	echo("<div class=\"mb-modal-content\">");
	echo("<div class=\"mb-modal-header\">");
	echo("<span id=\"mb-close$MODALNUM\" class=\"mb-close\"></span>");
		echo("<h2>$header</h2>");
	echo("</div>");
	echo("<div class=\"mb-modal-body\">");
		echo("<p>$message</p>");
	echo("</div>");
	echo("<div class=\"mb-modal-footer\">");
		#echo("<h3>$footer</h3>");
	echo("</div>");
	
	echo("</div>");
	echo("</div>");
	echo("</div>");
	
	if (file_exists($SYS_PLUGINS_DIR."modalbox/modalbox.js")){
		include($SYS_PLUGINS_DIR."modalbox/modalbox.js");
	}
	$MODALNUM++;
}

?>
