<?php


$IMGSLIDER=true;
$IMGSLIDERNUM=0;
$IMGSLIDERLOADCSS=false;
	
	

function imgautoslider($img=array()){
	global $SYS_PLUGINS_DIR,$IMGSLIDERNUM,$IMGSLIDERLOADCSS;
	
	if (!$IMGSLIDERLOADCSS){
		if (file_exists($SYS_PLUGINS_DIR."imgslider/imgslider.css")){
			include($SYS_PLUGINS_DIR."imgslider/imgslider.css");
			$IMGSLIDERLOADCSS=true;
		}
	}
	
	echo("<div class=im-box>");
	$db=count($img);
	for($i=0;$i<$db;$i++){
		$t=$img[$i];
		echo("<img class=\"im-myAutoSlides im-myAS$IMGSLIDERNUM\" src=\"$t[0]\">");
		if ($t[1]==""){
			$t[1]="...";
		}
		echo("<span class=\"im-imgtext im-imgtext$IMGSLIDERNUM\">$t[1]</span>");
	}
	echo("</div>");
	
	if (file_exists($SYS_PLUGINS_DIR."imgslider/imgslider.js")){
		include($SYS_PLUGINS_DIR."imgslider/imgslider.js");
	}
    $IMGSLIDERNUM++;
}




function imgslider($img=array()){
	global $SYS_PLUGINS_DIR,$IMGSLIDERNUM,$IMGSLIDERLOADCSS;
	
	if (!$IMGSLIDERLOADCSS){
		if (file_exists($SYS_PLUGINS_DIR."imgslider/imgslider.css")){
			include($SYS_PLUGINS_DIR."imgslider/imgslider.css");
			$IMGSLIDERLOADCSS=true;
		}
	}
	
	echo("<div class=im-littlebox>");
	$db=count($img);
	for($i=0;$i<$db;$i++){
		$t=$img[$i];
		echo("<img class=\"im-mySlides  immyS$IMGSLIDERNUM\" src=\"$t[0]\">");
		echo("<span class=\"im-imgtextx im-imgtextx$IMGSLIDERNUM\">$t[1]</span>");
	}
    echo("<div class=\"im-bottomleft\" onclick=\"plusDivs$IMGSLIDERNUM(-1)\"><span class=\"im-bottomleftmenu\"></span></div>");
    echo("<div class=\"im-bottomright\" onclick=\"plusDivs$IMGSLIDERNUM(1)\"><span class=\"im-bottomrightmenu\"></span></div>");
    echo("<div class=\"im-bottomcenter\">");
    
	for($i=0;$i<$db;$i++){
		$k=$i+1;
		echo("<span class=\"im-badge im-badge-nolight imB$IMGSLIDERNUM\" onclick=\"currentDiv$IMGSLIDERNUM($k)\"></span>");
	}
	echo("</div>");
	echo("</div>");
	
	if (file_exists($SYS_PLUGINS_DIR."/imgslider/imgslider2.js")){
		include($SYS_PLUGINS_DIR."/imgslider/imgslider2.js");
	}
    $IMGSLIDERNUM++;
}


?>
