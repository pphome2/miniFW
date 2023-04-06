<?php

 #
 # MiniFW - Admin app
 #
 # info: main folder copyright file
 #
 #


function mainview(){
    echo("<div class=testdiv>view</div>");
}

function mainsearch(){
    echo("<div class=testdiv>search</div>");
}

function mainprivacy(){
    echo("<div class=testdiv>privacy</div>");
}

function mainprint(){
    echo("print");
}


function a_mainpage(){
    echo("<div class=testdiv>Admin</div>");
}


function a_page(){
	global $MA_MENU_FIELD,$MA_MENUCODE;

	echo("<div class=spaceline></div>");
	echo("<div class=content>");
	if (isset($_GET[$MA_MENU_FIELD])){
		switch ($_GET[$MA_MENU_FIELD]){
			case $MA_MENUCODE[0]:
				a_user();
				break;
			case $MA_MENUCODE[1]:
				a_param();
				break;
			case $MA_MENUCODE[2]:
				a_backup();
				break;
			default:
				a_mainpage();
				break;
		}
	}else{
		#sql_install();
		#sql_test();
		a_mainpage();
	}
	echo("</div>");
	echo("<div class=spaceline></div>");
}


function main(){
    a_page();
}


?>
