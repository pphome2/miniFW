<?php

$COLUMN=true;
$COLUMNCSSLOAD=false;




function column_css(){
	global $SYS_PLUGINS_DIR,$COLUMNCSSLOAD;

	if (!$COLUMNCSSLOAD){
		if (file_exists($SYS_PLUGINS_DIR."column/column.css")){
			include($SYS_PLUGINS_DIR."column/column.css");
		}
		$COLUMNCSSLOAD=true;
	}
}



function column($col=''){
	global $SYS_PLUGINS_DIR,$COLUMNCSSLOAD;

	if (!$COLUMNCSSLOAD){
		if (file_exists($SYS_PLUGINS_DIR."column/column.css")){
			include($SYS_PLUGINS_DIR."column/column.css");
		}
		$COLUMNCSSLOAD=true;
	}
	
	echo("<div class=\"columnrow\">");
	
	$db=count($col);
	for ($i=0;$i<$db;$i++){
		echo("<div class=\"column$db\">");
		echo("<div class=\"columncontent\">");
		foreach($col[$i] as $key => $val){
			echo("<p>$val</p>");
		}
		echo("</div>");
		echo("</div>");
	}
	
	echo("</div>");
	
	if (!$COLUMNCSSLOAD){
		if (file_exists($SYS_PLUGINS_DIR."column/column.js")){
			include($SYS_PLUGINS_DIR."column/column.js");
		}
		$COLUMNCSSLOAD=true;
	}
}



function column_footer($col=''){
	global $SYS_PLUGINS_DIR,$COLUMNCSSLOAD;

	if (!$COLUMNCSSLOAD){
		if (file_exists($SYS_PLUGINS_DIR."column/column.css")){
			include($SYS_PLUGINS_DIR."column/column.css");
		}
		$COLUMNCSSLOAD=true;
	}
	
	echo("<div class=\"columnrow\">");
	
	$db=count($col);
	for ($i=0;$i<$db;$i++){
		echo("<div class=\"column$db\">");
		echo("<div class=\"columncontent\">");
		$k=0;
		foreach($col[$i] as $key => $val){
			if ($k==0){
				echo("<p><b>$val</b></p>");
				echo("<hr style=\"width:100%;\">");
			}else{
				echo("<p>$val</p>");
			}
			$k++;
		}
		echo("</div>");
		echo("</div>");
	}
	
	echo("</div>");
	
	if (!$COLUMNCSSLOAD){
		if (file_exists($SYS_PLUGINS_DIR."column/column.js")){
			include($SYS_PLUGINS_DIR."column/column.js");
		}
		$COLUMNCSSLOAD=true;
	}
}



?>

