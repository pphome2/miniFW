<?php

$CARD=true;
$CARDLOAD=false;
$CARDNUM=0;

$CARDNAME="";
$CARDPARAM="card";
$CARDFORMNUM=0;

$CARD_CLOSE=true;
$CARD_HIDE=true;
$CARD_HEADER=true;

$CARD_MENU_LEFT=false;

$CARD_PER_ROW=1;


function card(){
	global $SYS_PLUGINS_DIR,$CARDNUM,$CARDLOAD;
	
	if (!$CARDLOAD){
	    if (file_exists($SYS_PLUGINS_DIR."card/card.css")){
		include($SYS_PLUGINS_DIR."card/card.css");
	    }
	}
	

	if (!$CARDLOAD){
		if (file_exists($SYS_PLUGINS_DIR."card/card.js")){
			include($SYS_PLUGINS_DIR."card/card.js");
		}
		$CARDLOAD=true;
	}
}


function cardmenucreate($menu='',$mess='',$num=''){
	global $CARDNUM,$CARDPARAM,$CARD_PER_ROW,$CARD_MENU_LEFT,$CARDFORMNUM;
	
	card();
	if ($CARDFORMNUM==0){
		echo("<form method=post id=\"cardmenuform\" name=\"cardmenuform\">");
		echo("<input id=\"cardmenutext\" name=$CARDPARAM type=text style=\"display:none;\">");
		echo("</form>");
		$CARDFORMNUM++;
	}
	echo("<div class=card-col$num$CARD_PER_ROW>");
	echo("<div class=card-card>");
	if ($CARD_MENU_LEFT){
		echo("<div class=\"card-topleftmenubtn\">");
		echo("<div class=\"card-topleftmenu-content\">");
	}else{
		echo("<div class=\"card-toprightmenubtn\">");
		echo("<div class=\"card-toprightmenu-content\">");
	}
	$db=count($menu);
	for($i=0;$i<$db;$i++){
		$t=$menu[$i];		
		#echo("<a href=\"#\">$t[0]</a>");
		echo("<span class=\"\" onclick=\"cardmenuclick('$t[0]');\">$t[0]</span>");
	}
	echo("</div>");
	echo("</div>");
	echo("<div class=\"card-cardbody\" id=\"card-cardbody$CARDNUM\"><p></p><p>$mess</p></div>");
	echo("</div>");
	echo("</div>");
	$CARDNUM++;
	$CARD_PER_ROW++;
}


function cardcreate($h='',$m='',$num=''){
	global $CARDNUM,$CARD_CLOSE,$CARD_HEADER,$CARD_HIDE,$CARD_PER_ROW;
	
	card();
	echo("<div class=card-col$num$CARD_PER_ROW>");
	echo("<div class=card-card>");
	if ($CARD_CLOSE){
		echo("<span onclick=\"cardclose(this);\" class=\"card-toprightclose\"></span>");
	}
	if ($CARD_HIDE){
		echo("<span onclick=\"menubodyclose($CARDNUM,this)\" class=\"card-toprightmenu\" id=\"card-toprightmenu$CARDNUM\"></span>");
	}
	if ($CARD_HEADER){
		echo("<div class=card-header><span class=card-header-text>$h</span></div>");
	}
	echo("<div class=\"card-cardbody\" id=\"card-cardbody$CARDNUM\"><p>$m</p></div>");
	echo("</div>");
	echo("</div>");
	$CARDNUM++;
	$CARD_PER_ROW++;
}




function cardmenu2($h='',$m=''){
	cardmenucreate($h,$m,50);
}


function cardmenu3($h='',$m=''){
	cardmenucreate($h,$m,33);
}


function cardmenu4($h='',$m=''){
	cardmenucreate($h,$m,25);
}


function cardmenu50($h='',$m=''){
	cardmenucreate($h,$m,50);
}


function cardmenu33($h='',$m=''){
	cardmenucreate($h,$m,33);
}


function cardmenu25($h='',$m=''){
	cardmenucreate($h,$m,25);
}


function card2($h='',$m=''){
	cardcreate($h,$m,50);
}


function card3($h='',$m=''){
	cardcreate($h,$m,33);
}


function card4($h='',$m=''){
	cardcreate($h,$m,25);
}


function card50($h='',$m=''){
	cardcreate($h,$m,50);
}


function card33($h='',$m=''){
	cardcreate($h,$m,33);
}


function card25($h='',$m=''){
	cardcreate($h,$m,25);
}


function cardrow_start(){
	global $CARD_PER_ROW;
	
	$CARD_PER_ROW=1;
	echo("<div class=card-row>");
}


function cardrow_end(){
	echo("</div>");
}


function mess_error($h='',$m=''){
	global $CARDNUM;
	
	card();
	echo("<div class=card-row>");
	echo('
		<div class="card-card">
			<span onclick="cardclose(this);" class="card-toprightclose"></span>
			<span onclick="menubodyclose('.$CARDNUM.',this)" class="card-toprightmenu" id="card-toprightmenu$CARDNUM"></span>
			<div class=card-header-error>
			<span class=card-header-text>'.$h.'</span></div>
			<div class="card-cardbody" id="card-cardbody'.$CARDNUM.'"><p>'.$m.'</p>
			</div>
		</div>
	');
	echo("</div>");
	$CARDNUM++;
}


function mess_ok($h='',$m=''){
	global $CARDNUM;
	
	card();
	echo("<div class=card-row>");
	echo('
		<div class="card-card">
			<span onclick="cardclose(this);" class="card-toprightclose"></span>
			<span onclick="menubodyclose('.$CARDNUM.',this)" class="card-toprightmenu" id="card-toprightmenu$CARDNUM"></span>
			<div class=card-header>
			<span class=card-header-text>'.$h.'</span></div>
			<div class="card-cardbody" id="card-cardbody'.$CARDNUM.'"><p>'.$m.'</p>
			</div>
		</div>
	');
	echo("</div>");
	$CARDNUM++;
}


function mess_error_menu($h='',$m=''){
	global $CARDNUM;
	
	card();
	echo("<div class=card-row>");
	echo('
		<div class="card-card">
			<span onclick="cardclosemenu(this);" class="card-toprightclose"></span>
			<span onclick="menubodyclosemenu('.$CARDNUM.')" class="card-topleftmenu"></span>
			<div class=card-header-error-menu>
			<span class=card-header-text2>'.$h.'</span></div>
			<div class="card-cardbody" id="card-cardbody'.$CARDNUM.'"><p>'.$m.'</p>
			</div>
		</div>
	');
	echo("</div>");
	$CARDNUM++;
}


function mess_ok_menu($h='',$m=''){
	global $CARDNUM;
	
	card();
	echo("<div class=card-row>");
	echo('
		<div class="card-card">
			<span onclick="cardclosemenu(this);" class="card-toprightclose"></span>
			<span onclick="menubodyclosemenu('.$CARDNUM.')" class="card-topleftmenu"></span>
			<div class=card-header-menu>
			<span class=card-header-text2>'.$h.'</span></div>
			<div class="card-cardbody" id="card-cardbody'.$CARDNUM.'"><p>'.$m.'</p>
			</div>
		</div>
	');
	echo("</div>");
	$CARDNUM++;
}



function get_card_name(){
	global $CARDNAME,$CARDPARAM;
	
	if (isset($_POST["$CARDPARAM"])){
		$CARDNAME=$_POST[$CARDPARAM];
	}
	return($CARDNAME);
}


function card_to_form(){
	global $CARDPARAM,$CARDNAME;
	
	echo("<input id=\"$CARDPARAM\" name=\"$CARDPARAM\" type=text value=\"$CARDNAME\" style=\"display:none;\">");
}


function card_form_start(){
	global $CARDPARAM,$CARDNAME,$CARDFORMNUM;
	
	if ($CARDFORMNUM==0){
		echo("<form method=post id=\"cardmenuform\" name=\"cardmenuform\">");
		echo("<input id=\"cardmenutext\" name=$CARDPARAM type=text style=\"display:none;\">");
		$CARDFORMNUM++;
	}
}


function card_form_end(){
	echo("</form>");
}


?>
