<?php

$PASSWORD=true;
$PASSWORDPARAM="pass";
$PASSWORDNUM=0;



function password(){
	global $SYS_PLUGINS_DIR,$PASSWORDPARAM;
	
	if (file_exists($SYS_PLUGINS_DIR."password/password.css")){
		include($SYS_PLUGINS_DIR."password/password.css");
	}
	
	
	if (file_exists($SYS_PLUGINS_DIR."password/password.js")){
		include($SYS_PLUGINS_DIR."password/password.js");
	}
}


function get_password(){
	global $PASSWORDPARAM;
	
	if (isset($_POST["$PASSWORDPARAM"])){
		$p=$_POST[$PASSWORDPARAM];
	}
	return($p);
}


function password_to_form($pass=''){
	global $SYS_PLUGINS_DIR,$PASSWORDPARAM;
	
	echo("<input id=\"$PASSWORDPARAM\" name=\"$PASSWORDPARAM\" type=text value=\"$pass\" style=\"display:none;\">");

}

?>

