<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #


# load config and language file
if (!isset($MA_CONFIG_DIR)){
    if (file_exists("config/config.php")){
	    include("config/config.php");
    }
}
# default app and template config
if (file_exists("$MA_CONFIG_DIR/config-app.php")){
    include("$MA_CONFIG_DIR/config-app.php");
}
if (file_exists("$MA_CONFIG_DIR/config-template.php")){
    include("$MA_CONFIG_DIR/config-template.php");
}

# system language
if (file_exists("$MA_CONFIG_DIR/$MA_LANGFILE")){
    include("$MA_CONFIG_DIR/$MA_LANGFILE");
}

# app config
if (file_exists("$MA_CONTENT_DIR/$MA_APP_CONFIG_FILE")){
    include("$MA_CONTENT_DIR/$MA_APP_CONFIG_FILE");
}

# template config
if (file_exists("$MA_TEMPLATE_DIR/$MA_APP_TEMPLATE/$MA_TEMPLATE_CONFIG_FILE")){
    include("$MA_TEMPLATE_DIR/$MA_APP_TEMPLATE/$MA_TEMPLATE_CONFIG_FILE");
}

# system lib
for ($i=0;$i<count($MA_LIB);$i++){
	if (file_exists("$MA_INCLUDE_DIR/$MA_LIB[$i]")){
		include("$MA_INCLUDE_DIR/$MA_LIB[$i]");
	}
}

# local app files
for ($k=0;$k<count($MA_APPFILE);$k++){
	if (file_exists("$MA_CONTENT_DIR/$MA_APPFILE[$k]")){
		include("$MA_CONTENT_DIR/$MA_APPFILE[$k]");
	}
}

# cookies
startcookies();
if(function_exists("main_cookies")){
    main_cookies();
    setcookies();
}

# prepare
plugins();
setcss();

# build page: header
if (file_exists("$MA_TEMPLATE_DIR/$MA_APP_TEMPLATE/$MA_HEADER")){
	include("$MA_TEMPLATE_DIR/$MA_APP_TEMPLATE/$MA_HEADER");
}else{
  page_header();
}
if ($MA_ENABLE_SYSTEM_JS){
  	if (file_exists("$MA_INCLUDE_DIR/$MA_JS_BEGIN")){
    	include("$MA_INCLUDE_DIR/$MA_JS_BEGIN");
  	}
}

# load local app jsfile
for ($i=0;$i<count($MA_APPJSFILE);$i++){
	if (file_exists("$MA_CONTENT_DIR/$MA_APPJSFILE[$i]")){
		include("$MA_CONTENT_DIR/$MA_APPJSFILE[$i]");
	}
}


# user/admin menu start
if (function_exists("mainsearch")){
    mainsearch();
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
}else{
  page_footer();
}


?>
