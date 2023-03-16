<?php

$LOGIN=true;

$LOGGED_IN=false;


if (file_exists($SYS_PLUGINS_DIR."login/login.$LANGUAGE_TITLE")){
	include($SYS_PLUGINS_DIR."login/login.$LANGUAGE_TITLE");
}

if (isset($LOGIN_LANG_NAME)){
	$LOGIN_LANG_NAME="név";
	$LOGIN_LANG_PASS="jelszó";
	$LOGIN_LANG_MAIL="e-mail cím";
	$LOGIN_LANG_CREATE="Felhasználó regisztrálása";
	$LOGIN_LANG_LOGIN="Belépés";
	$LOGIN_LANG_NOREGIST="Nem regiszrált még?";
	$LOGIN_LANG_REGISTERED="Már felhasználónk?";
}



$LOGIN_F_NAME="user";
$LOGIN_F_PASS="pass";
$LOGIN_F_MAIL="email";

$LOGIN_ROLE="";

$LOGIN_ONLY_LOGIN=false;

$LOGINPARAM="loginname";
$LOGIN_FORM_NAME="minicms-login";
$LOGINSEPARATOR="§";

$LOGIN_AUTO_LOGOUT=true;

$LOGIN_LOGOUT_TIME=20;       # minute

$LOGIN_LOGOUT_TIME_SEC=$LOGIN_LOGOUT_TIME*60;
$LOGIN_LOGOUT_TIME=$LOGIN_LOGOUT_TIME*60*1000;    # 600000 = 10 minute

$LOGIN_LOADED=false;

$LOGIN_NAME="";
$LOGIN_PASS="";
$LOGIN_MAIL="";
$LOGIN_TIME=0;
$LOGIN_ROLE="";

$LOGIN_USE_SESSION=false;
$LOGIN_USE_COOKIE=false;



#loginload();

$USERS_DATA=array();
$USERS_DATA[0]=array($SYS_ADMIN_NAME,$SYS_ADMIN_PASS,"");

#get_login();


function login_only(){
	global $LOGIN_ONLY_LOGIN;

	$LOGIN_ONLY_LOGIN=true;
	login();
}


function loginload(){
	global $SYS_PLUGINS_DIR,$LOGIN_LOADED,$LOGINPARAM,$LOGIN_LOGOUT_TIME,
		$LOGIN_FORM_NAME;
	
	if (!$LOGIN_LOADED){
		if (file_exists($SYS_PLUGINS_DIR."login/login.css")){
			include($SYS_PLUGINS_DIR."login/login.css");
		}
		#echo("<form id='formloginlogout' method=post>");
		#echo("<input name='$LOGIN_FORM_NAME' type='hidden' value='1'/>");
		#echo("<input id=\"$LOGINPARAM\" name=\"$LOGINPARAM\" type=text value=\"\" style=\"display:none;\">");
		#echo("<input id=\"loginsubmit\" name=\"loginsubmit\" type=submit value=\"\" style=\"display:none;\">");
		#echo("</form>");
		if (file_exists($SYS_PLUGINS_DIR."login/login.js")){
			include($SYS_PLUGINS_DIR."login/login.js");
		}
		$LOGIN_LOADED=true;
	}
		
}


function login(){
	global $SYS_PLUGINS_DIR,$LOGIN_LANG_NAME,$LOGIN_LANG_PASS,
		$LOGIN_LANG_MAIL,$LOGIN_LANG_CREATE,$LOGIN_LANG_LOGIN,
		$LOGIN_LANG_NOREGIST,$LOGIN_LANG_REGISTERED,
		$LOGIN_F_NAME,$LOGIN_F_PASS,$LOGIN_F_MAIL,
		$LOGIN_ONLY_LOGIN,$LOGIN_FORM_NAME;

	loginload();
	echo("<div class='login-page'>");
	echo("  <div class='login-main-form'>");
	if (!$LOGIN_ONLY_LOGIN){
		echo("    <form method='post' id='login-register-form' class='login-register-form' style='display:none;'>");
		echo("      <input name='$LOGIN_FORM_NAME' type='hidden' value='1'/>");
		echo("      <input name='$LOGIN_F_NAME' type='text' placeholder='$LOGIN_LANG_NAME'/>");
		echo("      <input name='$LOGIN_F_PASS' type='password' placeholder='$LOGIN_LANG_PASS'/>");
		echo("      <input name='$LOGIN_F_MAIL' type='text' placeholder='$LOGIN_LANG_MAIL'/>");
		echo("      <button>$LOGIN_LANG_CREATE</button>");
		echo("      <p class='login-message'>$LOGIN_LANG_REGISTERED <a href='#' onclick='loginclick();'>$LOGIN_LANG_LOGIN</a></p>");
		echo("    </form>");
	}
	echo("    <form method='post' id='login-login-form' class='login-login-form'>");
	echo("      <input name='$LOGIN_FORM_NAME' type='hidden' value='1'/>");
	echo("      <input name='$LOGIN_F_NAME' type='text' placeholder='$LOGIN_LANG_NAME'/>");
	echo("      <input name='$LOGIN_F_PASS' type='password' placeholder='$LOGIN_LANG_PASS'/>");
	echo("      <button>$LOGIN_LANG_LOGIN</button>");
	if (!$LOGIN_ONLY_LOGIN){
		echo("      <p class='login-message'>$LOGIN_LANG_NOREGIST <a href='#' onclick='loginclick();'>$LOGIN_LANG_CREATE</a></p>");
	}
	echo("    </form>");
	echo("  </div>");
	echo("</div>");
}


function login_form(){
	global $SYS_PLUGINS_DIR,$LOGIN_LANG_NAME,$LOGIN_LANG_PASS,
		$LOGIN_LANG_MAIL,$LOGIN_LANG_CREATE,$LOGIN_LANG_LOGIN,
		$LOGIN_LANG_NOREGIST,$LOGIN_LANG_REGISTERED,
		$LOGIN_F_NAME,$LOGIN_F_PASS,$LOGIN_F_MAIL,
		$LOGIN_ONLY_LOGIN,$LOGIN_FORM_NAME;

	loginload();
	echo("<div class='login-page'>");
	echo("<div class='login-main-form'>");
	echo("<label class=\"user-icon\"></label>");
	echo("<input name='$LOGIN_FORM_NAME' type='hidden' value='1'/>");
	echo("<input name='$LOGIN_F_NAME' type='text' placeholder=''/>");
	echo("<label class=\"pass-icon\"></span>");
	echo("<input name='$LOGIN_F_PASS' type='password' placeholder=''/>");
	echo("<button><span class=\"go-icon\"></span></button>");
	echo("</div>");
	echo("</div>");
}


function login_form_start(){
	echo("    <form method='post' id='login-login-form' class='login-login-form'>");
}


function login_form_end(){
	echo("    </form>");
}




function get_login(){
	global $LOGINPARAM,$LOGINSEPARATOR,$LOGIN_NAME,$LOGIN_PASS,$LOGIN_EMAIL,
		$LOGIN_ROLE,$LOGIN_TIME;
	
	if (isset($_POST[$LOGINPARAM])){
		$x=$_POST[$LOGINPARAM];
		$t=explode($LOGINSEPARATOR,$x);
		$LOGIN_NAME=$t[0];
		if (isset($t[0])){
			$LOGIN_NAME=$t[0];
		}
		if (isset($t[1])){
			$LOGIN_PASS=validmd5($t[1]);
		}
		if (isset($t[2])){
			$LOGIN_TIME=$t[2];
		}
		if (isset($t[1])){
			$LOGIN_ROLE=$t[3];
		}
	}else{
		$LOGIN_NAME="";
		$LOGIN_PASS="";
		$LOGIN_TIME=0;
		$LOGIN_ROLE="";
	}
}


function get_login_data(){
	global $LOGIN_F_NAME,$LOGIN_F_PASS,$LOGIN_F_MAIL,$LOGIN_NAME,$LOGIN_PASS,$LOGIN_EMAIL;
	
	if (isset($_POST[$LOGIN_F_NAME])){
		$LOGIN_NAME=$_POST[$LOGIN_F_NAME];
	}else{
		$LOGIN_NAME="";
	}
	if (isset($_POST[$LOGIN_F_PASS])){
		$LOGIN_PASS=validmd5($_POST[$LOGIN_F_PASS]);
	}else{
		$LOGIN_PASS="";
	}
	if (isset($_POST[$LOGIN_F_MAIL])){
		$LOGIN_EMAIL=$_POST[$LOGIN_F_MAIL];
	}else{
		$LOGIN_EMAL="";
	}

	if (($LOGIN_NAME=="")and($LOGIN_PASS=="")){
		get_login();
	}
}


function login_to_form(){
	global $LOGINPARAM,$LOGINSEPARATOR,$LOGIN_NAME,$LOGIN_PASS,$LOGIN_AUTO_LOGOUT;
	
	loginload();
	$d=date('U');
	$l=$LOGIN_NAME.$LOGINSEPARATOR.$LOGIN_PASS.$LOGINSEPARATOR.$d;
	echo("<input id=\"$LOGINPARAM\" name=\"$LOGINPARAM\" type=text value=\"$l\" style=\"display:none;\">");
	if ($LOGIN_AUTO_LOGOUT){
		echo("<script>loginlogouttime();</script>");
	}
}


function login_logout(){
	global $SYS_PLUGINS_DIR,$LOGIN_FORM_NAME;

	loginload();
	set_cookie($LOGIN_FORM_NAME,"","-1");
	echo("<script>loginlogout();</script>");
}


function login_check($role=""){
	global $USERS_DATA,$LOGIN_NAME,$LOGIN_PASS,$LOGIN_LOGOUT_TIME,$LOGIN_ROLE,
		$SYS_ADMIN_NAME,$LOGIN_FORM_NAME,$SYS_SESSION,$LOGIN_LOGOUT_TIME_SEC,
		$LOGIN_USE_SESSION,$LOGGED_IN,$LOGIN_TIME;

	$ok=false;
	$db=count($USERS_DATA);
	for($i=0;$i<$db;$i++){
		$t=$USERS_DATA[$i];
		if (($t[0]==$LOGIN_NAME)and($t[1]==$LOGIN_PASS)){
			if (isset($t[2])){
				$LOGIN_ROLE=$t[2];
			}
			if (($t[0]<>$SYS_ADMIN_NAME)and($role<>"")){
				if ($role==$t[2]){
					$ok=true;
				}
			}else{
				$ok=true;
			}
		}
	}
	$d=date('U');
	if (($ok)and($LOGIN_TIME>0)){
		$tm=$LOGIN_TIME+$LOGIN_LOGOUT_TIME_SEC;
		if ($d>$tm){
			$ok=false;
		}
	}

	if (($ok)and($LOGIN_USE_SESSION)and($SYS_SESSION)){
		if (session_live($LOGIN_FORM_NAME)){
			$sd=session_get($LOGIN_FORM_NAME);
			if ($sd>0){
				if (($d-$sd)>$LOGIN_LOGOUT_TIME_SEC){
					session_end();
				}else{
					session_set($LOGIN_FORM_NAME,$d);
				}
			}else{
				if (isset($_POST[$LOGIN_FORM_NAME])){
					session_end();
					$ok=false;
				}
			}
		}else{
			session_set($LOGIN_FORM_NAME,$d);
		}
	}
	if (($ok)and($LOGIN_USE_COOKIE)){
		if (isset($_POST[$LOGIN_FORM_NAME])){
			set_cookie($LOGIN_FORM_NAME,$d,$LOGIN_LOGOUT_TIME);
			echo("<script>loginsetcookie(\"$LOGIN_FORM_NAME\",\"$d\",\"$LOGIN_LOGOUT_TIME_SEC\");</script>");
		}else{
			$sd=get_cookie($LOGIN_FORM_NAME);
			if ($sd==""){
				$ok=false;
			}else{
				set_cookie($LOGIN_FORM_NAME,$d,$LOGIN_LOGOUT_TIME);
			}
		}
	}
	$LOGGED_IN=$ok;
	return($ok);
}


function login_logout_timeout(){
	echo("<script>loginlogouttime();</script>");
}


?>
