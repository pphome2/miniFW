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
    if (file_exists("$MA_CONFIG_DIR/$MA_LANGFILE")){
	    include("$MA_CONFIG_DIR/$MA_LANGFILE");
    }
}

$MA_ADMINFILE=$MA_VIEWFILE;

for ($i=0;$i<count($MA_LIB);$i++){
	if (file_exists("$MA_LIB[$i]")){
		include("$MA_LIB[$i]");
	}
}

# load local app file
for ($i=0;$i<count($MA_APPFILE);$i++){
    if (file_exists($MA_APPFILE[$i])){
        include($MA_APPFILE[$i]);
    }
}

#setcookienames();
plugins();

# css setting
setcss();

# login
if ($MA_ENABLE_LOGIN_VIEW){
	login();
}

# build page: header
if ($MA_ENABLE_HEADER_VIEW){
    page_header();
}else{
    page_header_view();
}

# load local app jsfile
for ($i=0;$i<count($MA_APPJSFILE);$i++){
	if (file_exists($MA_APPJSFILE[$i])){
		include($MA_APPJSFILE[$i]);
	}
}

if (($MA_LOGGEDIN)or(!$MA_ENABLE_LOGIN_VIEW)){
	# user/admin menu start
	if (isset($_GET["$MA_MENU_FIELD"])){
		$param=$_GET["$MA_MENU_FIELD"];
   		if (function_exists($param)){
    		$param();
    	}else{
		    if (function_exists("view")){
			    view();
		    }
		}
	}else{
	    if (function_exists("view")){
		    view();
	    }
	}

}else{
    if ($MA_ENABLE_LOGIN_VIEW){
		login_form();
	}
}

# page footer
if ($MA_ENABLE_FOOTER_VIEW){
    page_footer();
}else{
    page_footer_view();
}

?>
