<?php

 #
 # System load
 #
 # info: main folder copyright file
 #
 #




echo("</div>");

if (!$ADMIN_SITE){
    $dbl=count($SYS_ACTIVE_PLUGINS_AFTER);
    if ($dbl>0){
        for($ix=0;$ix<$dbl;$ix++){
		$file=$SYS_PLUGINS_DIR.$SYS_ACTIVE_PLUGINS_AFTER[$ix]."/".$SYS_ACTIVE_PLUGINS_AFTER[$ix].".php";
    	    if (file_exists($file)){
	    	include($file);
		}
	    }
	}
}else{
    $dbl=count($SYS_ADMIN_ACTIVE_PLUGINS_AFTER);
    if ($dbl>0){
        for($ix=0;$ix<$dbl;$ix++){
		$file=$SYS_PLUGINS_DIR.$SYS_ADMIN_ACTIVE_PLUGINS_AFTER[$ix]."/".$SYS_ADMIN_ACTIVE_PLUGINS_AFTER[$ix].".php";
    	    if (file_exists($file)){
	    	include($file);
		}
	    }
	}
}


$dbl=count($SYS_MAIN_JS_AFTER);
if ($dbl>0){
	for($ix=0;$ix<$dbl;$ix++){
		$file=$SYS_INCLUDE_DIR.$SYS_MAIN_JS_AFTER[$ix];
		if (file_exists($file)){
			include($file);
		}
	}
}

main_end();

?>
