<?php

 #
 # MiniApp - demo
 #
 # info: main folder copyright file
 #
 #


function mainsearch(){
    global $D_TITLE,$L_BUTTON_NEXT,$L_SEARCH;

    searchview($D_TITLE,$L_BUTTON_NEXT,$L_SEARCH);
}


function mainprivacy(){
    global $D_TITLE,$MA_APPPRIVACYFILE;

    privacyview($D_TITLE,$MA_APPPRIVACYFILE);
}


function d_print(){
}

function mainprint(){
    echo("<a href='start.php' style='text-decoration:none;color:black;'>");
    d_print();
    echo("</a>");
}


function d_header(){
    echo("<header></header>");
}


function d_footer(){
    echo("<footer></footer>");
}


function d_table(){
    echo("123...");
}


function d_data(){
    global $MA_MENU_FIELD,$D_MENUCODE;

    echo("<div class=spaceline></div>");
    echo("<div class=content>");
    if (isset($_GET[$MA_MENU_FIELD])){
        switch ($_GET[$MA_MENU_FIELD]){
            case $D_MENUCODE[0]:
                break;
            default:
                d_table();
                break;
        }
    }else{
        d_table();
    }
    echo("</div>");
    echo("<div class=spaceline></div>");
}

function d_view(){
    echo("<div class=spaceline></div>");
    echo("<div class=content>");
    echo("</div>");
    echo("<div class=spaceline></div>");
}

function main(){
    #loadplugin("table");
    #loadplugin("cards");
    d_header();
    d_data();
    d_footer();
}


?>