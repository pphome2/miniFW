<?php

 #
 # MiniFW - Admin app
 #
 # info: main folder copyright file
 #
 #

# beállításfájlok betöltése
if (file_exists("config/config.php")){
    include("config/config.php");
}
# nyelvi féjlok
if (file_exists("$MA_MINIFW_DIR/$MA_CONFIG_DIR/$MA_LANGFILE")){
    include("$MA_MINIFW_DIR/$MA_CONFIG_DIR/$MA_LANGFILE");
}
if (file_exists("$MA_CONTENT_DIR/$MA_LANGFILE")){
    include("$MA_CONTENT_DIR/$MA_LANGFILE");
}
# template beállítások
if (file_exists("$MA_TEMPLATE_DIR/$MA_APP_TEMPLATE/$MA_TEMPLATE_CONFIG")){
    include("$MA_TEMPLATE_DIR/$MA_APP_TEMPLATE/$MA_TEMPLATE_CONFIG");
}
# admin beállítások
if (file_exists("$MA_CONTENT_DIR/$MA_ADMIN_CONFIG")){
    include("$MA_CONTENT_DIR/$MA_ADMIN_CONFIG");
}
# admin fájlok betöltése
for($i=0;$i<count($A_APPFILES);$i++){
    if (file_exists("$MA_CONTENT_DIR/$A_APPFILES[$i]")){
        include("$MA_CONTENT_DIR/$A_APPFILES[$i]");
    }
}

$MA_ENABLE_SYSTEM_CSS=true;

setcookienames();
plugins();

# css setting
setcss();

# login
if ($MA_ENABLE_LOGIN){
    login();
}

# build page: header
if (file_exists("$MA_TEMPLATE_DIR/$MA_APP_TEMPLATE/$MA_HEADER")){
	include("$MA_TEMPLATE_DIR/$MA_APP_TEMPLATE/$MA_HEADER");
}
if ($MA_ENABLE_SYSTEM_JS){
  	if (file_exists("$MA_INCLUDE_DIR/$MA_JS_BEGIN")){
    	include("$MA_INCLUDE_DIR/$MA_JS_BEGIN");
  	}
}

# CSS
echo("<style>");
for($i=0;$i<count($A_CSSFILE);$i++){
    if (file_exists("$MA_CONTENT_DIR/$A_CSSFILE[$i]")){
        include("$MA_CONTENT_DIR/$A_CSSFILE[$i]");
    }
}
echo("</style>");

# JS
echo("<script>");
for($i=0;$i<count($A_JSFILE);$i++){
    if (file_exists("$MA_CONTENT_DIR/$A_JSFILE[$i]")){
        include("$MA_CONTENT_DIR/$A_JSFILE[$i]");
    }
}
echo("</script>");

if ($MA_LOGGEDIN){
	# user/admin menu start
	if (isset($_GET["$MA_MENU_FIELD"])){
		$param=$_GET["$MA_MENU_FIELD"];
   		if (function_exists($param)){
    		$param();
    	}else{
		    if (function_exists("main")){
			    main();
		    }
		}
	}else{
	    if (function_exists("main")){
		    main();
	    }
	}

}else{
	if ($MA_ENABLE_LOGIN){
		login_form();
	}
}

# end local app file

# page end
if ($MA_ENABLE_SYSTEM_JS){
  	if (file_exists("$MA_INCLUDE_DIR/$MA_JS_END")){
    	include("$MA_INCLUDE_DIR/$MA_JS_END");
  	}
}
if (file_exists("$MA_TEMPLATE_DIR/$MA_APP_TEMPLATE/$MA_FOOTER")){
	include("$MA_TEMPLATE_DIR/$MA_APP_TEMPLATE/$MA_FOOTER");
}


?>
