<?php

$TABLER=true;
$TABLERLOADCSS=false;
$TABLERNUM=0;

$TABLERFILTERROW=0;

$TABLERFRAME=true;

$TABLERFORM="tablerform";
$TABLERPARAM="tablerinput";

$TABLER_PLACEHOLDER="";




function tablernofilter($table=array(),$indexshow=true){
	global $SYS_PLUGINS_DIR,$TABLERLOADCSS,$TABLERNUM,
			$TABLERFORM,$TABLERPARAM,$TABLER_PLACEHOLDER,$TABLERFRAME;
	
	if (file_exists($SYS_PLUGINS_DIR."/tabler/tabler.css")and(!$TABLERLOADCSS)){
		include($SYS_PLUGINS_DIR."/tabler/tabler.css");
		$TABLERLOADCSS=true;
	}

	if ($TABLERFRAME){
		echo("<div class=tab-frame>");
	}
	echo("<div class=\"tab-center\">");
	$db=count($table[0]);
	if ($indexshow){
	}else{
		$db--;
	}
	$h=100/$db;
	if ($db>10){
		$fdb=10;
	}else{
		$fdb=$db+1;
	}
	$fh=100/$fdb;
	echo("<table class=\"tab-tabTable\" id=\"tab-tabTable$TABLERNUM\">");
	echo("<tr class=\"header\">");
	$i=0;
	foreach($table[$i] as $key => $val){
		if ($i==0){
			if ($indexshow){
				echo("<th style=\"width:$h%;\">$val</th>");
			}
		}else{
			echo("<th style=\"width:$h%;\">$val</th>");
		}
		$i++;
	}
	echo("</tr>");
		
	$dball=count($table);
	for($k=1;$k<$dball;$k++){
		$x=0;
		foreach($table[$k] as $key => $val){
			if ($x==0){
				echo("<tr onclick=\"tablerowclick('$TABLERFORM','$TABLERPARAM','$val');\">");
				if ($indexshow){
					echo("<td>$val</td>");
				}
			}else{
				echo("<td>$val</td>");
			}
			$x++;
		}
		echo("</tr>");
    }	
	
	echo("</table>");
	echo("</div>");
	if ($TABLERFRAME){
		echo("</div>");
	}
	
	if (file_exists($SYS_PLUGINS_DIR."/tabler/tabler.js")){
		include($SYS_PLUGINS_DIR."/tabler/tabler.js");
	}
	$TABLERNUM++;
}



function tablerallfilter($table=array(),$indexshow=true){
	global $SYS_PLUGINS_DIR,$TABLERLOADCSS,$TABLERNUM,
			$TABLERFORM,$TABLERPARAM,$TABLER_PLACEHOLDER,$TABLERFRAME;
	
	if (file_exists($SYS_PLUGINS_DIR."/tabler/tabler.css")and(!$TABLERLOADCSS)){
		include($SYS_PLUGINS_DIR."/tabler/tabler.css");
		$TABLERLOADCSS=true;
	}

	if ($TABLERFRAME){
		echo("<div class=tab-frame>");
	}
	echo("<div class=\"tab-center\">");
	echo("<div class=\"tab-filtmyinput\">");
	$db=count($table[0]);
	if ($indexshow){
	}else{
		$db--;
	}
	$h=100/$db;
	if ($db>10){
		$fdb=10;
	}else{
		$fdb=$db+1;
	}
	$fh=100/$fdb;
	echo("<table class=\"tab-filtTable\">");
	if ($indexshow){
		$fi=0;
	}else{
		$fi=1;
	}
	for($f=$fi;$f<$fdb;$f++){
		echo("<td style=\"width:$fh%;\">");
		echo("<label class=\"tab-search-icon\">");
		echo("</label>");
		echo("<input type=\"text\" id=\"tab-tabInput$TABLERNUM$f\" class=\"tab-filtInput\" onkeyup=\"tablerallfilter$TABLERNUM($f-1,$f)\" placeholder=\"$TABLER_PLACEHOLDER\">");
		echo("</td>");
	}
	echo("</table>");
	echo("</div>");
	
	echo("<table class=\"tab-tabTable\" id=\"tab-tabTable$TABLERNUM\">");
	echo("<tr class=\"header\">");
	$i=0;
	foreach($table[$i] as $key => $val){
		if ($i==0){
			if ($indexshow){
				echo("<th style=\"width:$h%;\">$val</th>");
			}
		}else{
			echo("<th style=\"width:$h%;\">$val</th>");
		}
		$i++;
	}
	echo("</tr>");
		
	$dball=count($table);
	for($k=1;$k<$dball;$k++){
		$x=0;
		foreach($table[$k] as $key => $val){
			if ($x==0){
				echo("<tr onclick=\"tablerowclick('$TABLERFORM','$TABLERPARAM','$val');\">");
				if ($indexshow){
					echo("<td>$val</td>");
				}
			}else{
				echo("<td>$val</td>");
			}
			$x++;
		}
		echo("</tr>");
    }	
	
	echo("</table>");
	echo("</div>");
	if ($TABLERFRAME){
		echo("</div>");
	}
	
	if (file_exists($SYS_PLUGINS_DIR."/tabler/tabler.js")){
		include($SYS_PLUGINS_DIR."/tabler/tabler.js");
	}
	$TABLERNUM++;
}



function tabler($table=array(),$filtrow='',$indexshow=true){
	global $SYS_PLUGINS_DIR,$TABLERLOADCSS,$TABLERNUM,$TABLERFILTERROW,
			$TABLERFORM,$TABLERPARAM,$TABLER_PLACEHOLDER,$TABLERFRAME;
	
	if (file_exists($SYS_PLUGINS_DIR."/tabler/tabler.css")and(!$TABLERLOADCSS)){
		include($SYS_PLUGINS_DIR."/tabler/tabler.css");
		$TABLERLOADCSS=true;
	}

	$TABLERFILTERROW=$filtrow;
	if ($TABLERFRAME){
		echo("<div class=tab-frame>");
	}
	echo("<div class=\"tab-center\">");
	echo("<div class=\"tab-myinput\">");
	echo("<label class=\"tab-search-icon\">");
	echo("</label>");
	echo("<input type=\"text\" id=\"tab-tabInput$TABLERNUM\" class=\"tab-tabInput\" onkeyup=\"tablerfilter$TABLERNUM()\" placeholder=\"$TABLER_PLACEHOLDER\">");
	echo("</div>");
	
	echo("<table class=\"tab-tabTable\" id=\"tab-tabTable$TABLERNUM\">");
	echo("<tr class=\"header\">");
	$db=count($table[0]);
	$h=100/$db;
	$i=0;
	foreach($table[$i] as $key => $val){
		if ($i==0){
			if ($indexshow){
				echo("<th style=\"width:$h%;\">$val</th>");
			}
		}else{
			echo("<th style=\"width:$h%;\">$val</th>");
		}
		$i++;
	}
	echo("</tr>");
		
	$dball=count($table);
	for($k=1;$k<$dball;$k++){
		$x=0;
		foreach($table[$k] as $key => $val){
			if ($x==0){
				echo("<tr onclick=\"tablerowclick('$TABLERFORM','$TABLERPARAM','$val');\">");
				if ($indexshow){
					echo("<td>$val</td>");
				}
			}else{
				echo("<td>$val</td>");
			}
			$x++;
		}
		echo("</tr>");
    }	
	
	echo("</table>");
	echo("</div>");
	if ($TABLERFRAME){
		echo("</div>");
	}
	
	if (file_exists($SYS_PLUGINS_DIR."/tabler/tabler.js")){
		include($SYS_PLUGINS_DIR."/tabler/tabler.js");
	}
	$TABLERNUM++;
}



function tabler_form_start(){
	global $TABLERPARAM,$TABLERFORM;
	
	echo("<form method=post id=\"$TABLERFORM\" name=\"$TABLERFORM\">");
	echo("<input id=\"$TABLERPARAM\" name=\"$TABLERPARAM\" type=text value=\"\" style=\"display:none;\">");
}

function tabler_form_end(){
	echo("</form>");
}

?>

