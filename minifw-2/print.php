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
if (file_exists("$MA_INCLUDE_DIR/$MA_HEADER_PRINT")){
  include("$MA_INCLUDE_DIR/$MA_HEADER_PRINT");
}else{
  page_header_print();
}

# load local app jsfile
for ($i=0;$i<count($MA_APPJSFILE);$i++){
	if (file_exists("$MA_CONTENT_DIR/$MA_APPJSFILE[$i]")){
		include("$MA_CONTENT_DIR/$MA_APPJSFILE[$i]");
	}
}

# user/admin menu start
if (function_exists("mainprint")){
    mainprint();
}


# end local app file

# page end
if (file_exists("$MA_INCLUDE_DIR/$MA_FOOTER_PRINT")){
  include("$MA_INCLUDE_DIR/$MA_FOOTER_PRINT");
}else{
  page_foter_print();
}


?>
