<?php

$PARALLAXIMG=true;
$PARALLAXLOADCSS=false;
$PARALLAXCLOSE=true;



function parallaximg($img=''){
	global $SYS_PLUGINS_DIR,$PARALLAXLOADCSS,$PARALLAXCLOSE;
	
	if (!$PARALLAXLOADCSS){
	    if (file_exists($SYS_PLUGINS_DIR."parallaximg/parallaximg.css")){
			include($SYS_PLUGINS_DIR."parallaximg/parallaximg.css");
	    }
	}
	
	echo("<style>.parallax-parallax{background-image:url(\"$img\");}</style>");
	echo("<div class=\"parallax-parallax\">");
	if ($PARALLAXCLOSE){
		echo("</div>");
	}
	
	if (!$PARALLAXLOADCSS){
	    if (file_exists($SYS_PLUGINS_DIR."parallaximg/parallaximg.js")){
			include($SYS_PLUGINS_DIR."parallaximg/parallaximg.js");
	    }
		$PARALAXLLOADCSS=true;
	}
}



function parallaximg_start($parallaximage=''){
	global $PARALLAXCLOSE;
	
	$PARALLAXCLOSE=false;
	parallaximg($parallaximage);
	#echo("<div class=\"parallax-parrallax\">");
	$PARALLAXCLOSE=true;
}


function parallaximg_end(){
	echo("</div>");
}



?>
