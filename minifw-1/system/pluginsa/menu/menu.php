<?php

$MENU=true;
$MENUNAME="";
$MENUPARAM="menu";
$MENUSEARCH="search";
$MENUHOME="home";
$MENUSEPARATOR=";";

$MENUFORM_STARTED=false;

$MENU_STICK_TO_TOP=false;



function menu_line($headline=array()){
	global $SYS_PLUGINS_DIR,$MENUNAME,$MENUPARAM,$MENUSEARCH,$MENUHOME,$MENU_STICK_TO_TOP,$MENUSEPARATOR;

	if (file_exists($SYS_PLUGINS_DIR."menu/menu.css")){
		include($SYS_PLUGINS_DIR."menu/menu.css");
	}
	if ($MENUNAME==""){
		get_menu_name();
	}
	$stick="";
	if ($MENU_STICK_TO_TOP){
		$stick="menu-stick";
	}
	echo("<div class=\"menu-menu $stick\"><ul class=\"menu-sidenav\">");

	$db=count($headline);
	$active="";
	if (($MENUNAME=="")or($MENUNAME==$MENUHOME)){
		$active=" active";
	}
	menuform_start();
	menuform_end();
	echo("<li><label class=\"menu-labtext $active\" onclick=\"menuclick('$MENUHOME');\">");
	echo("<div class=\"menu-home_icon\"></div></label></li>");
	for($i=0;$i<$db;$i++){
		$hl=$headline[$i];
		$active="";
		if (($MENUNAME==$hl[0])or($MENUNAME==$hl[2])){
			$active=" active";
		}
		$so=$hl[0];
		$sol=$hl[2];
		if ($hl[1]<>""){
			$line=explode($MENUSEPARATOR,$hl[1]);
			$ldb=count($line);
			echo("<li class=\"menu-dropdown\">");
			echo("<label href=\"javascript:void(0)\" class=\"menu-dropbtn\">");
			echo("<div class=\"menu-mtop\">$so</div></label>");
			echo("<div id=\"menu-dropdown-content\" class=\"menu-dropdown-content\">");
			for($k=0;$k<$ldb;$k++){
				echo("<label class=\"menu-dropdown-content-a\" onclick=\"menuclick('$sol$MENUSEPARATOR$k');\">$line[$k]</label>");
			}
			echo("</div>");
			echo("</li>");
		}else{
			echo("<li><label id=\"label$i\" class=\"menu-labtext $active\" onclick=\"menuclick('$sol');\">");
			echo("<div class=\"menu-mtop $active\">$so</div></label></li>");
		}
	}
	$active="";
	if ($MENUNAME==$MENUSEARCH){
		$active=" active";
	}
	echo("<li style=\"float:right;\"><label class=\"menu-labtext $active\" onclick=\"menuclick('$MENUSEARCH');\">");
	echo("<div class=\"menu-search_icon_link\"></div></label></li>");

	echo("</ul></div>");
	
	if ($MENU_STICK_TO_TOP){
		echo("<div style=\"font-size:1.3em;margin-top:45px;\"></div>");
	}

	if (file_exists($SYS_PLUGINS_DIR."menu/menu.js")){
		include($SYS_PLUGINS_DIR."menu/menu.js");
	}
}



function menu_line_links($headline=array(),$links=array()){
	global $SYS_PLUGINS_DIR,$MENU_STICK_TO_TOP;

	if (file_exists($SYS_PLUGINS_DIR."menu/menu.css")){
		include($SYS_PLUGINS_DIR."menu/menu.css");
	}
	
	$stick="";
	if ($MENU_STICK_TO_TOP){
		$stick="menu-stick";
	}
	echo("<div class=\"menu-menu $stick\"><ul class=\"menu-sidenav\">");

	$db=count($headline);
	echo("<li><a class=\"menu-active\" href=\"../index.html\"><span class=\"menu-home_icon\"></span></a></li>");
	for($i=0;$i<$db;$i++){
		echo("<li><a href=\"$links[$i]\"><div class=\"menu-mtop\">$headline[$i]</div></a></li>");
	}
	echo("<li style=\"float:right;\"><a href=\"../index.html\"><div class=\"menu-search_icon_link\"></div></a></li>");

	echo("</ul></div>");

	if (file_exists($SYS_PLUGINS_DIR."menu/menu.js")){
		include($SYS_PLUGINS_DIR."menu/menu.js");
	}
}


function get_menu_name(){
	global $MENUNAME,$MENUPARAM,$MENUSEPARATOR;
	
	if (isset($_POST["$MENUPARAM"])){
		$MENUNAME=$_POST[$MENUPARAM];
	}
	$mt=explode($MENUSEPARATOR,$MENUNAME);
	if ((is_array($mt))and(count($mt)>1)){
		$la=$mt[count($mt)-1];
		$MENUNAME=$mt[$la];
	}
	return($MENUNAME);
}


function menu_to_form(){
	global $MENUPARAM,$MENUNAME;
	
	echo("<input id=\"$MENUPARAM\" name=\"$MENUPARAM\" type=text value=\"$MENUNAME\" style=\"display:none;\">");
}


function menuform_start(){
	global $MENUFORM_STARTED,$MENUPARAM;

	if (!$MENUFORM_STARTED){
		echo("<form method=post id=\"menuform\" name=\"menuform\">");
		echo("<input id=\"menutext\" name=$MENUPARAM type=text style=\"display:none;\">");
		#$MENUFORM_STARTED=true;
	}
}


function menuform_end(){
	global $MENUFORM_STARTED;

	if (!$MENUFORM_STARTED){
		echo("</form>");
		$MENUFORM_STARTED=true;
	}
}


function menu_submit(){
    echo("<script type=text/javascript>menusubmit();</script>");
}


?>
