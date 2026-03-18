<?php

$FORM=true;
$FORMLOAD=false;
$FORMNUM=0;
$FORMSEPARATOR=";";

$FORM_SUBMIT_TEXT="Mehet";

function form($header='',$formdata='',$butt="Mehet"){
	global $SYS_PLUGINS_DIR,$FORMNUM,$FORMLOAD,$FORMSEPARATOR,$FORM_SUBMIT_TEXT;
	
	if (!$FORMLOAD){
	    if (file_exists($SYS_PLUGINS_DIR."form/form.css")){
			include($SYS_PLUGINS_DIR."form/form.css");
	    }
	}
	
	echo("<h3 class=\"form-labelcl\">$header</h3>");

	$db=count($formdata);
	for($i=0;$i<$db;$i++){
		if ((isset($sd[6]))and($sd[6]<>"")){
			$readonly="readonly";
		}else{
			$readonly="";
		}
		echo("<div class=\"form-row\">");
		$sd=$formdata[$i];
		if ($sd[1]<>'hidden'){
			echo("<div class=\"form-col-25\"><label for=\"form-$i\">$sd[0]</label></div>");
		}
		echo("<div class=\"form-col-75\">");
		switch ($sd[1]){
			case 'hidden':
				echo("<input type=\"hidden\" id=\"form-$i\" name=\"form-$i\" placeholder=\"$sd[2]\" maxlength=\"$sd[4]\" value=\"$sd[5]\" $readonly>");
				break;
			case 'readonly':
				echo("<input type=\"text\" id=\"form-$i\" name=\"form-$i\" placeholder=\"$sd[2]\" maxlength=\"$sd[4]\" value=\"$sd[5]\" readonly>");
				break;
			case 'text':
				echo("<input type=\"text\" id=\"form-$i\" name=\"form-$i\" placeholder=\"$sd[2]\" maxlength=\"$sd[4]\" value=\"$sd[5]\" $readonly>");
				break;
			case 'password':
				echo("<input type=\"password\" id=\"form-$i\" name=\"form-$i\" placeholder=\"$sd[2]\" maxlength=\"$sd[4]\" value=\"$sd[5]\" $readonly>");
				break;
			case 'textarea':
				echo("<textarea id=\"form-$i\" name=\"form-$i\" placeholder=\"$sd[2]\" rows=10 $readonly>$sd[5]</textarea>");
				break;
			case 'select':
				$line=explode($FORMSEPARATOR,$sd[3]);
				$ldb=count($line);
				echo("<div style=\"width:100%;\"><select id=\"form-$i\" name=\"form-$i\" $readonly>");
				for($k=0;$k<$ldb;$k++){
					if ($line[$k]==$sd[5]){
						$checked="selected";
					}else{
						$checked="";
					}
					echo("<option value=\"$line[$k]\" $checked>$line[$k]</option>");
				}
				echo("</select></div>");
				break;
			case 'radio':
				$line=explode($FORMSEPARATOR,$sd[3]);
				$ldb=count($line);
				for($k=0;$k<$ldb;$k++){
					if ($line[$k]==$sd[5]){
						$checked="checked";
					}else{
						$checked="";
					}
					echo("<div><input type=\"radio\" name=\"form-$i\" $checked value=\"$line[$k]\" $readonly><span class=\"form-labelcl\">$line[$k]</span></div>");
				}
				break;
			case 'checkbox':
				$line=explode($FORMSEPARATOR,$sd[3]);
				$ldb=count($line);
				for($k=0;$k<$ldb;$k++){
					if ($line[$k]==$sd[5]){
						$checked="checked";
					}else{
						$checked="";
					}
					echo("<div><input type=\"checkbox\" name=\"form-$i\" $checked value=\"$line[$k]\" $readonly><span class=\"form-labelcl\">$line[$k]</span></div>");
				}
				break;
		}
		echo("</div>");
		echo("</div>");
	}

	$text=$FORM_SUBMIT_TEXT;
	if ($butt<>""){
		$text=$butt;
	}
	echo("<div class=\"form-row\">");
		echo("<input type=\"submit\" value=\"$text\">");
	echo("</div>");
  

	if (!$FORMLOAD){
	    if (file_exists($SYS_PLUGINS_DIR."form/form.js")){
			include($SYS_PLUGINS_DIR."form/form.js");
	    }
		$FORMLOAD=true;
	}
}



function form_to_input($name='',$value=''){
	echo("<input id=\"$name\" name=\"$name\" type=text value=\"$value\" style=\"display:none;\">");
}


function form_start(){
	global $FORMNUM;
	
	echo("<div class=\"form-container\">");
	echo("<form class=\"form-form\" method=post id=\"fin$FORMNUM\" name=\"fin$FORMNUM\">");
}

function form_end(){
	echo("</form>");
	echo("</div>");
}



?>
