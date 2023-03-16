<?php

 #
 # System load
 #
 # info: main folder copyright file
 #
 #


if (file_exists("../system/config/sysconfig.php")){
	include("../system/config/sysconfig.php");



    if (file_exists($SYS_LOCAL_CONFIG)){
	include($SYS_LOCAL_CONFIG);
    }

    if ($SYS_ERROR_LOG){
	#ini_set("log_errors", 1);
	error_reporting(E_ALL);
	ini_set('log_errors', TRUE);
	$file=date('Ymd');
	$file=$SYS_LOG_DIR.$file.$SYS_ERROR_LOG_FILE;
	ini_set("error_log", $file);
	#error_log( "Log init done." );
    }
    
    if (file_exists($LANGUAGE)){
	include($LANGUAGE);
    }
    
    $dbl=count($SYS_MAIN_LIB_FILES);
    if ($dbl>0){
	for($ix=0;$ix<$dbl;$ix++){
		$file=$SYS_LIB_DIR.$SYS_MAIN_LIB_FILES[$ix];
			if (file_exists($file)){
				include($file);
			}
	}
    }

    main();


	$dbl=count($SYS_MAIN_CSS);
	if ($dbl>0){
		for($ix=0;$ix<$dbl;$ix++){
			$file=$SYS_INCLUDE_DIR.$SYS_MAIN_CSS[$ix];
			if (file_exists($file)){
				include($file);
			}
		}
    }

	$dbl=count($SYS_MAIN_JS_BEFORE);
	if ($dbl>0){
		for($ix=0;$ix<$dbl;$ix++){
			$file=$SYS_INCLUDE_DIR.$SYS_MAIN_JS_BEFORE[$ix];
			if (file_exists($file)){
				include($file);
			}
		}
    }
    
    if (!$ADMIN_SITE){
	$dbl=count($SYS_ACTIVE_PLUGINS_BEFORE);
	    if ($dbl>0){
			for($ix=0;$ix<$dbl;$ix++){
				$file=$SYS_PLUGINS_DIR.$SYS_ACTIVE_PLUGINS_BEFORE[$ix]."/".$SYS_ACTIVE_PLUGINS_BEFORE[$ix].".php";
				if (file_exists($file)){
					include($file);
				}
			}
	    }
    }else{
        $dbl=count($SYS_ADMIN_ACTIVE_PLUGINS_BEFORE);
		if ($dbl>0){
    			for($ix=0;$ix<$dbl;$ix++){
				$file=$SYS_ADMIN_PLUGINS_DIR.$SYS_ADMIN_ACTIVE_PLUGINS_BEFORE[$ix]."/".$SYS_ADMIN_ACTIVE_PLUGINS_BEFORE[$ix].".php";
				if (file_exists($file)){
					include($file);
				}
			}
	    }
    }

    echo("<div class=\"all-page\">");

}else{
    if (file_exists("../public/error.html")){
	include("../public/error.html");
    }else{
        echo("System error. No files found...");
    }
}

?>
