<?php

$GOTOTOP=true;
$GOTOTOPNUM=0;

function gototop(){
	global $SYS_PLUGINS_DIR,$GOTOTOPNUM;
	
	if ($GOTOTOPNUM<1){
		if (file_exists($SYS_PLUGINS_DIR."gototop/gototop.css")){
			include($SYS_PLUGINS_DIR."gototop/gototop.css");
		}
	
		echo("<div class=\"gt-gototop\" onclick=\"topFunction()\" id=\"gt-gototop\" title=\"\">");
		#echo("<i class=\"material-icons\">expand_less</i>");
		echo("<div class=\"gt-gototop-icon\"></div>");
		echo("</div>");

		if (file_exists($SYS_PLUGINS_DIR."gototop/gototop.js")){
			include($SYS_PLUGINS_DIR."gototop/gototop.js");
		}
	}
}

?>
