<?php

$PARAMFORM=true;
$PARAMFORMNUM=0;
$PARAMFORM_STARTED=false;



function paramform($param='',$text=''){
	global $PARAMFORMNUM;

	echo("<input id=\"$param\" name=\"$param\" type=text value=\"$text\" style=\"display:none;\">");
}




function paramform_start(){
	global $PARAMFORM_STARTED,$PARAMFORMNUM;

	if (!$PARAMFORM_STARTED){
		echo("<form method=post id=\"paramform$PARAMFORMNUM\" name=\"paramform$PARAMFORMNUM\">");
		$PARAMFORMNUM++;
		$PARAMFORM_STARTED=true;
	}
}


function paramform_end(){
	global $PARAMFORM_STARTED;

	if ($PARAMFORM_STARTED){
		echo("</form>");
		$PARAMFORM_STARTED=false;
	}
}


function paramform_get($param=""){
	$ret="";
	if (isset($_POST["$param"])){
		$ret=$_POST["$param"];
	}
	return($ret);
}




?>
