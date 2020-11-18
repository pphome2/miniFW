<?php

$COLLAPSE=true;
$COLLAPLOADCSS=false;
$COLLAPSENUM=0;

function collapse($head='',$body=''){
	global $SYS_PLUGINS_DIR,$COLLAPLOADCSS,$COLLAPSENUM;
	
	if (!$COLLAPLOADCSS){
		if (file_exists($SYS_PLUGINS_DIR."collapse/collapse.css")){
			include($SYS_PLUGINS_DIR."collapse/collapse.css");
			$COLLAPSELOADCSS=true;
		}
	}
	
	$db=count($head);
	for ($i=0;$i<$db;$i++){
		echo("<button class=\"col-collapsible col-coll$COLLAPSENUM\">$head[$i]</button>");
		echo("<div class=\"col-content\">");
		echo("<p>$body[$i]</p>");
		echo("</div>");
	}
		
	if (file_exists($SYS_PLUGINS_DIR."collapse/collapse.js")){
		include($SYS_PLUGINS_DIR."collapse/collapse.js");
	}
	$COLLAPSENUM++;
}


function collapse_start($head=''){
	global $SYS_PLUGINS_DIR,$COLLAPLOADCSS,$COLLAPSENUM;
	
	if (!$COLLAPLOADCSS){
		if (file_exists($SYS_PLUGINS_DIR."collapse/collapse.css")){
			include($SYS_PLUGINS_DIR."collapse/collapse.css");
			$COLLAPSELOADCSS=true;
		}
	}
	
	echo("<button class=\"col-collapsible col-coll$COLLAPSENUM\">$head</button>");
	echo("<div class=\"col-content\">");
	echo("<p>$body[$i]");
}


function collapse_end(){
	global $SYS_PLUGINS_DIR,$COLLAPLOADCSS,$COLLAPSENUM;
	
	if (!$COLLAPLOADCSS){
		if (file_exists($SYS_PLUGINS_DIR."collapse/collapse.css")){
			include($SYS_PLUGINS_DIR."collapse/collapse.css");
			$COLLAPSELOADCSS=true;
		}
	}
	
	echo("</p></div>");
		
	if (file_exists($SYS_PLUGINS_DIR."collapse/collapse.js")){
		include($SYS_PLUGINS_DIR."collapse/collapse.js");
	}
	$COLLAPSENUM++;
}

?>
