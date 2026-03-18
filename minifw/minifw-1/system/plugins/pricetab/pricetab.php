<?php

$PRICETAB=true;
$PRICETABNUM=0;
$PRICETABLOADCSS=false;
$PRICETABSEPARATOR=";";
$PRICETABPARAM="pttext";
$PRICETABTEXT="";


function pricetab($header='',$pt=array()){
	global $SYS_PLUGINS_DIR,$PRICETABLOADCSS,$PRICETABNUM,$PRICETABSEPARATOR,$PRICETABPARAM;

	if (!$PRICETABLOADCSS){
		if (file_exists($SYS_PLUGINS_DIR."pricetab/pricetab.css")){
			include($SYS_PLUGINS_DIR."pricetab/pricetab.css");
		}
	}
	
	echo("<h2 class=pt-header>$header</h2>");
	echo("<input type=\"hidden\" id=\"$PRICETABPARAM\" name=\"$PRICETABPARAM\" value=\"\" style=\"display:none;\">");
	$db=count($pt);
	$x=(100-$db-1)/$db;
	echo("<div class=\"pt-row\">");
	for($i=0;$i<$db;$i++){
		$td=$pt[$i];
		echo("<div class=\"pt-columns\" style=\"width:$x%;\">");
		echo("<ul class=\"pt-price\">");
		$active="";
		if ($td[4]<>""){
			$active="pt-headerx-active";
		}
		echo("<li class=\"pt-headerx $active\">$td[0]</li>");
		echo("<li class=\"pt-red\">$td[1]</li>");
		$line=explode($PRICETABSEPARATOR,$td[2]);
		$ldb=count($line);
		for($k=0;$k<$ldb;$k++){
			echo("<li>$line[$k]</li>");
		}
		echo("<li class=\"pt-grey\"><span class=\"pt-button\" ");
		echo("onclick=\"pricetabclick('ptform$PRICETABNUM','$PRICETABPARAM','$td[3]');\">$td[3]</span></li>");
		echo("</ul>");
		echo("</div>");
	}
	echo("</div>");

	if (!$PRICETABLOADCSS){
		if (file_exists($SYS_PLUGINS_DIR."pricetab/pricetab.js")){
			include($SYS_PLUGINS_DIR."pricetab/pricetab.js");
		}
		$PRICETABLOADCSS=true;
	}
	$PRICETABNUM++;
}


function get_pricetab_select(){
	global $PRICETABTEXT,$PRICETABPARAM;
	
	if (isset($_POST["$PRICETABPARAM"])){
		$PRICETABTEXT=$_POST[$PRICETABPARAM];
	}
	return($PRICETABTEXT);
}



function pricetab_form_start(){
	global $PRICETABNUM;
	
	echo("<div class=\"pt-container\">");
	echo("<form method=post id=\"ptform$PRICETABNUM\" name=\"ptform$PRICETABNUM\">");
}


function pricetab_form_end(){
	echo("</form>");
	echo("</div>");
}



?>
