<?php

$IMGGALLERY=true;

function imggallery($img='',$text=''){
	global $SYS_PLUGINS_DIR;
		
	if (file_exists($SYS_PLUGINS_DIR."imggallery/imggallery.css")){
		include($SYS_PLUGINS_DIR."imggallery/imggallery.css");
	}	
	$db=count($img);
	$x=100/$db;
	echo("<style>.ig-column{width:$x%;}</style>");
	
	echo("<div class=\"ig-row\">");
	for($i=0;$i<$db;$i++){
		echo("<div class=\"ig-column\">");
		echo("<img src=$img[$i] alt=\"$text[$i]\" onclick=\"imgGallery(this);\">");
		echo("</div>");
	}
	echo("</div>");
	
	echo("<div class=\"ig-container\">");
	echo("<span onclick=\"this.parentElement.style.display='none'\" class=\"ig-closebtn\"></span>");
	echo("<img id=\"ig-expandedImg\" style=\"width:100%\">");
	echo("<div id=\"ig-imgtext\"></div>");
	echo("</div>");
	
	if (file_exists($SYS_PLUGINS_DIR."imggallery/imggallery.js")){
		include($SYS_PLUGINS_DIR."imggallery/imggallery.js");
	}	
}





function mimggallery($img='',$text=''){
	global $SYS_PLUGINS_DIR;
		
	include("$SYS_PLUGINS_DIR"."imggallery/imggallerym.css");
	
	$db=count($img);
	$x=100/$db;
	echo("<style>.mig-column{width:$x%;}</style>");
	
	echo("<div class=\"mig-row\">");
	for($i=0;$i<$db;$i++){
		echo("<div class=\"mig-column\">");
		$k=$i+1;
		echo("<img src=$img[$i] onclick=\"openModal();currentSlide($k)\" class=\"mig-hover-shadow mig-cursor\" alt=$text[$i]>");
		echo("</div>");
	}
	echo("</div>");
	
	echo("<div id=\"mig-myModal\" class=\"mig-modal\">");
	echo("<span class=\"mig-close cursor\" onclick=\"closeModal()\"></span>");
	echo("<div class=\"mig-modal-content\">");

	for($i=0;$i<$db;$i++){
		echo("<div class=\"mig-mySlides\">");
		$k=$i+1;
		echo("<div class=\"mig-numbertext\">$k / $db</div>");
		echo("<img src=$img[$i] class=\"mig-img\" alt=\"$text[$i]\">");
		echo("</div>");
	}
	
	echo("<a class=\"mig-prev\" onclick=\"plusSlides(-1)\"></a>");
	echo("<a class=\"mig-next\" onclick=\"plusSlides(1)\"></a>");

	echo("<div class=\"mig-caption-container\">");
	echo("<p id=\"mig-caption\"></p>");
	echo("</div>");

	for($i=0;$i<$db;$i++){
		echo("<div class=\"mig-column\">");
		$k=$i+1;
		echo("<img class=\"mig-demo mig-cursor\" src=$img[$i] style=\"width:98%;\" onclick=\"currentSlide($k)\" alt=\"$text[$i]\">");
		echo("</div>");
	}
	
	echo("</div>");
	echo("</div>");
	
	include("$SYS_PLUGINS_DIR"."imggallery/imggallerym.js");
}






function bimgmodal($img='',$text=''){
	global $SYS_PLUGINS_DIR;
		
	include("$SYS_PLUGINS_DIR"."imggallery/imggalleryb.css");
		
	echo("<img id=\"bim-myImg\" src=$img alt=$text>");
	echo("<div id=\"bim-myModal\" class=\"bim-modal\">");
	echo("<span class=\"bim-close\"></span>");
	echo("<img class=\"bim-modal-content\" id=\"bim-img01\">");
	echo("<div id=\"bim-caption\"></div>");
	echo("</div>");
	
		
	include("$SYS_PLUGINS_DIR"."imggallery/imggalleryb.js");
}






?>
