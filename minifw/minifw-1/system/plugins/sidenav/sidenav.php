<?php

$SIDENAV=true;
$SIDENAVNAME="";
$SIDENAVPARAM="snav";


function sidenav_link($names=array(),$links=array(),$sidenavname=''){
	global $SYS_PLUGINS_DIR;
	
	if (file_exists($SYS_PLUGINS_DIR."/sidenav/sidenav.css")){
		include($SYS_PLUGINS_DIR."/sidenav/sidenav.css");
	}

	$db=count($names);
	echo("<div id=\"sn-mySidenav\" class=\"sn-sidenav\">");
	echo("<a href=\"javascript:void(0)\" onclick=\"sncloseNav()\"><span class=\"sn-closebtn\"></span></a>");
	for($i=0;$i<$db;$i++){
		echo("<a href=\"$links[$i]\">$names[$i]</a>");
	}
	echo("</div>");

	echo("<div id=\"sn-main\">");
	echo("<span class=\"sn-sidenavicon\" onclick=\"snopenNav()\">$sidenavname</span>");
	echo("</div>");
	
	if (file_exists($SYS_PLUGINS_DIR."/sidenav/sidenav.js")){
		include($SYS_PLUGINS_DIR."/sidenav/sidenav.js");
	}
}


function sidenav($names=array(),$links=array(),$sidenavname=''){
	global $SYS_PLUGINS_DIR,$SIDENAVNAME,$SIDENAVPARAM;
	
	if (file_exists($SYS_PLUGINS_DIR."/sidenav/sidenav.css")){
		include($SYS_PLUGINS_DIR."/sidenav/sidenav.css");
	}

	echo("<form method=post id=\"sidenavform\" name=\"sidenavform\">");
	echo("<input id=\"sidenavtext\" name=$SIDENAVPARAM type=text style=\"display:none;\">");
	echo("</form>");
	$db=count($names);
	echo("<div id=\"sn-mySidenav\" class=\"sn-sidenav\">");
	echo("<a href=\"javascript:void(0)\" onclick=\"sncloseNav()\"><span class=\"sn-closebtn\"></span></a>");
	for($i=0;$i<$db;$i++){
		#echo("<a href=\"$links[$i]\">$names[$i]</a>");
		$active="";
		if ($SIDENAVNAME==$names[$i]){
			$active=" active";
		}
		$so=$names[$i];
		echo("<li><label id=\"label$i\" class=\"sn-labtext $active\" onclick=\"sidenavclick('$so');\";>");
		echo("<div class=\"$active\">$so</div></label></li>");
	}
	echo("</div>");

	echo("<div id=\"sn-main\">");
	echo("<span class=\"sn-sidenavicon\" onclick=\"snopenNav()\">$sidenavname</span>");
	echo("</div>");
	
	if (file_exists($SYS_PLUGINS_DIR."/sidenav/sidenav.js")){
		include($SYS_PLUGINS_DIR."/sidenav/sidenav.js");
	}
}



function get_sidenav_name(){
	global $SIDENAVNAME,$SIDENAVPARAM;
	
	if (isset($_POST["$SIDENAVPARAM"])){
		$SIDENAVNAME=$_POST[$SIDENAVPARAM];
	}
	return($SIDENAVNAME);
}


function sidenav_to_form(){
	global $SIDENAVNAME,$SIDENAVPARAM;
	
	echo("<input id=\"$SIDENAVPARAM\" name=\"$SIDENAVPARAM\" type=text value=\"$SIDENAVNAME\" style=\"display:none;\">");
}


?>

