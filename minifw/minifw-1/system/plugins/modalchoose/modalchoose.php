<?php

$MODALCHOOSE=true;
$MODALCHOOSELOADCS=false;
$MODALCHOOSENUM=0;
$MODALCHOOSEPARAM="modalchoose";
$MODALCHOOSEDATA="";


function modalchoose_button($btn='',$message='',$buttons=''){
	global $SYS_PLUGINS_DIR,$MODALCHOOSENUM,$MODALCHOOSELOADCS,$MODALCHOOSEPARAM;
	
	if (!$MODALCHOOSELOADCS){
		if (file_exists($SYS_PLUGINS_DIR."modalchoose/modalchoose.css")){
			include($SYS_PLUGINS_DIR."modalchoose/modalchoose.css");
		}
		$MODALCHOOSELOADCS=true;
	}
	
	if ($btn<>""){
		echo("<div class=\"mc-button-width\">");
		echo("<div id=\"mymcBtn$MODALCHOOSENUM\" class=mc-button onclick=\"modalchooseopen('mymcModal$MODALCHOOSENUM');\">$btn</div>");
		echo("</div>");
	}
	
	echo("<input type=\"hidden\" id=\"$MODALCHOOSEPARAM\" name=\"$MODALCHOOSEPARAM\" value=\"\" style=\"display:none;\">");
	
	echo("<div id=\"mymcModal$MODALCHOOSENUM\" class=\"mc-modal\">");
	
	echo("<div class=\"mc-modal-content\">");
	echo("<div class=\"mc-modal-body\">");
		echo("<p>$message</p>");
		$db=count($buttons);
		for($i=0;$i<$db;$i++){
			$d=$buttons[$i];
			$ddb=count($d);
			echo("<div class=\"mc-button-width-center\">");
			$active="";
			if ($d[2]<>""){
				$active="background-color:green;";
			}
			echo("<span id=\"mcBtn$MODALCHOOSENUM\" class=mc-button2 style=\"$active\" ");
			echo("onclick=\"modalchooseclick('mcform$MODALCHOOSENUM','$MODALCHOOSEPARAM','$d[1]');\">$d[0]</span>");
			echo("</div>");
		}
	echo("</div>");
	
	echo("</div>");
	echo("</div>");
	
	if (file_exists($SYS_PLUGINS_DIR."modalchoose/modalchoose.js")){
		include($SYS_PLUGINS_DIR."modalchoose/modalchoose.js");
	}
	$MODALCHOOSENUM++;
}


function modalchoose($message='',$buttons=''){
	global $SYS_PLUGINS_DIR,$MODALCHOOSENUM,$MODALCHOOSELOADCS,$MODALCHOOSEPARAM;
	
	if (!$MODALCHOOSELOADCS){
		if (file_exists($SYS_PLUGINS_DIR."modalchoose/modalchoose.css")){
			include($SYS_PLUGINS_DIR."modalchoose/modalchoose.css");
		}
	}

	echo("<div id=\"mymcBtn$MODALCHOOSENUM\" class=mc-button onclick=\"modalchooseopen('mymcModal$MODALCHOOSENUM');\" ");
	echo("style=\"display:none;\">$MODALCHOOSENUM</div>");
	
	echo("<input type=\"hidden\" id=\"$MODALCHOOSEPARAM\" name=\"$MODALCHOOSEPARAM\" value=\"\" style=\"display:none;\">");
	
	echo("<div id=\"mymcModal$MODALCHOOSENUM\" class=\"mc-modal\">");
	
	echo("<div class=\"mc-modal-content\">");
	echo("<div class=\"mc-modal-body\">");
		echo("<p>$message</p>");
		$db=count($buttons);
		for($i=0;$i<$db;$i++){
			$d=$buttons[$i];
			$ddb=count($d);
			echo("<div class=\"mc-button-width-center\">");
			$active="";
			if ($d[2]<>""){
				$active="background-color:green;";
			}
			echo("<span id=\"mcBtn$MODALCHOOSENUM\" class=mc-button2 style=\"$active\" ");
			echo("onclick=\"modalchooseclick('mcform$MODALCHOOSENUM','$MODALCHOOSEPARAM','$d[1]');\">$d[0]</span>");
			echo("</div>");
		}
	echo("</div>");
	
	echo("</div>");
	echo("</div>");
	
	
	if (!$MODALCHOOSELOADCS){
		if (file_exists($SYS_PLUGINS_DIR."modalchoose/modalchoose.js")){
			include($SYS_PLUGINS_DIR."modalchoose/modalchoose.js");
		}
		$MODALCHOOSELOADCS=true;
	}
	echo("<script>window.onload=function(){document.getElementById('mymcBtn$MODALCHOOSENUM').onclick();};</script>");
	$MODALCHOOSENUM++;
}



function get_modalchoose_select(){
	global $MODALCHOOSEDATA,$MODALCHOOSEPARAM;
	
	if (isset($_POST["$MODALCHOOSEPARAM"])){
		$MODALCHOOSEDATA=$_POST[$MODALCHOOSEPARAM];
	}
	return($MODALCHOOSEDATA);
}



function modalchoose_form_start(){
	global $MODALCHOOSENUM;
	
	echo("<form method=post name=\"mcform$MODALCHOOSENUM\" id=\"mcform$MODALCHOOSENUM\">");
}


function modalchoose_form_end(){
	echo("</form>");
}


?>
