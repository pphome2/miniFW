<?php

$FOOTER=true;


function footer($copyright='',$developer='',$devname='',$devmail=''){
	global $SYS_PLUGINS_DIR;

	if (file_exists($SYS_PLUGINS_DIR."footer/footer.css")){
		include($SYS_PLUGINS_DIR."footer/footer.css");
	}
	if (($devname<>"")and($devmail<>"")){
		$developer="<a href=\"maxi3xlt3o:";
		$developer=$developer.substr($devmail,0,1)."x";
		$developer=$developer.substr($devmail,1,1)."3";
		$developer=$developer.substr($devmail,2,1)."3";
		$developer=$developer.substr($devmail,3,1)."3";
		$developer=$developer.substr($devmail,4,1)."x";
		$developer=$developer.substr($devmail,5,1)."x";
		$developer=$developer.substr($devmail,6,1)."3";
		$developer=$developer.substr($devmail,7,1)."3";
		$developer=$developer.substr($devmail,8,1)."3";
		$developer=$developer.substr($devmail,9,1)."x";
		$developer=$developer.substr($devmail,10,1)."3";
		$developer=$developer.substr($devmail,11,1)."3";
		$developer=$developer.substr($devmail,12,1)."x";
		$developer=$developer.substr($devmail,13,1)."3";
		$developer=$developer.substr($devmail,14,1)."x";
		$developer=$developer.substr($devmail,15,1)."3";
		$developer=$developer.substr($devmail,16,1)."3";
		$developer=$developer.substr($devmail,17,1)."x";
		$developer=$developer.substr($devmail,18,1)."3";
		$developer=$developer.substr($devmail,19,1)."3";
		$developer=$developer.substr($devmail,20,1)."x";
		$developer=$developer.substr($devmail,21,20);
		$developer=$developer."\" onmouseover=\"this.href=this.href.replace(/x/g,'');this.href=this.href.replace(/3/g,'');\">";
		$developer=$developer."$devname</a>";
	}
	echo("<div class=\"foot-footer\">");
	echo("<ul>");
	echo("<li class=\"foot-copyright\">$copyright</li>");
	echo("<li class=\"foot-developer\">$developer</li>");
	echo("</ul>");
	echo("</div>");

	if (file_exists($SYS_PLUGINS_DIR."footer/footer.js")){
		include($SYS_PLUGINS_DIR."footer/footer.js");
	}
	
}


?>
