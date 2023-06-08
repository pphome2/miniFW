<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #


# cookie-k beolvasása
function cookie_load(){
    global $MA_COOKIES;

    for($i=0;$i<count($MA_COOKIES);$i++){
        $c=$MA_COOKIES[$i];
        if($c[0]<>""){
            $cn=$c[0];
	        if(isset($_COOKIE[$cn])){
	            $c[1]=$_COOKIE[$cn];
	            $MA_COOKIES[$i]=$c;
            }
        }
    }
}


# cookie-k tárolása
function cookie_set(){
    global $MA_COOKIES;

    for($i=0;$i<count($MA_COOKIES);$i++){
        $c=$MA_COOKIES[$i];
        if($c[0]<>""){
            $t=$c[2]*86400;
		    setcookie($c[0],$c[1],['expires'=>time()+$t,'samesite'=>'Strict']);
            echo("$c[0],$c[1],$t");
        }
    }
}


# frissítés vezérlése
function updater(){
    global $MA_VERSION,$MA_UPDATE_SRC,$MA_SITE_VERSION,$MA_SITE_UPDATE_SRC,$MA_TEMPLATE_VERSION,$MA_TEMPLATE_UPDATE_SRC;

    if(($MA_VERSION<>"")and($MA_UPDATE_SRC<>"")){
        update_system();
    }
    if(($MA_SITE_VERSION<>"")and($MA_SITE_UPDATE_SRC<>"")){
        update_site();
    }
    if(($MA_TEMPLATE_VERSION<>"")and($MA_TEMPLATE_UPDATE_SRC<>"")){
        update_template();
    }
}


# rendszer frissítése
function update_system(){
    global $MA_COOKIE_UPDATE,$MA_UPDATE_FILE,$MA_UPDATE_CHECK_DAYS;

	if (!isset($_COOKIE[$MA_COOKIE_UPDATE])){
        if (update_check()){
            if(update_download()){
                update_sys();
                if(function_exists("sql_install")){
                    sql_install();
                    sql_update();
                }
            }
        }
        $t=$MA_UPDATE_CHECK_DAYS*86400;
		setcookie($MA_COOKIE_UPDATE,$MA_UPDATE_FILE,['expires'=>time()+$t,'samesite'=>'Strict']);
    }
}


# app/site frissítése
function update_site(){;
    global $MA_COOKIE_UPDATE,$MA_UPDATE_FILE,$MA_SITE_VERSION,$MA_SITE_UPDATE_SRC,$MA_SITE_UPDATE_CHECK_DAYS;

	if (!isset($_COOKIE[$MA_COOKIE_UPDATE])){
        if (update_check($MA_SITE_VERSION,$MA_SITE_UPDATE_SRC)){
            if(update_download($MA_SITE_UPDATE_SRC)){
                update_sys();
                if(function_exists("sql_install")){
                    sql_install();
                    sql_update();
                }
            }
        }
        $t=$MA_SITE_UPDATE_CHECK_DAYS*86400;
		setcookie($MA_COOKIE_UPDATE,$MA_UPDATE_FILE,['expires'=>time()+$t,'samesite'=>'Strict']);
    }
}


# template frissítése
function update_template(){;
    global $MA_COOKIE_UPDATE,$MA_UPDATE_FILE,$MA_TEMPLATE_VERSION,$MA_TEMPLATE_UPDATE_SRC,$MA_TEMPLATE_UPDATE_CHECK_DAYS;

	if (!isset($_COOKIE[$MA_COOKIE_UPDATE])){
        if (update_check($MA_TEMPLATE_VERSION,$MA_TEMPLATE_UPDATE_SRC)){
            if(update_download($MA_TEMPLATE_UPDATE_SRC)){
                update_sys();
                if(function_exists("sql_install")){
                    sql_install();
                    sql_update();
                }
            }
        }
        $t=$MA_TEMPLATE_UPDATE_CHECK_DAYS*86400;
		setcookie($MA_COOKIE_UPDATE, $MA_UPDATE_FILE, ['expires'=>time()+$t,'samesite'=>'Strict']);
    }
}


# frissítés ellenőrzése
function update_check($ver="",$src=""){
    global $MA_VERSION,$MA_UPDATE_SRC,$MA_UPDATE_EXT,$MA_UPDATE_FILE;

    if($ver===""){
        $ver=$MA_VERSION;
    }
    if($src===""){
        $src=$MA_UPDATE_SRC;
    }
    $opt=array(
        "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
        ),
    );
    $ret=false;
    $wp=file_get_contents("$src",false,stream_context_create($opt));
    $l=explode(PHP_EOL,$wp);
    for($i=0;$i<count($l);$i++){
        $p=stripos($l[$i],$MA_UPDATE_EXT);
        if($p<>0){
            $x=substr($l[$i],$p-strlen($ver),strlen($ver)+strlen($MA_UPDATE_EXT));
            $x2=substr($x,0,strlen($x)-strlen($MA_UPDATE_EXT));
            if ($x2>$ver){
                $MA_UPDATE_FILE=$x;
                $ret=true;
            }
        }
    }
    return($ret);
}


# frissítés letöltése
function update_download($src=""){
    global $MA_UPDATE_SRC,$MA_TMP_DIR,$MA_UPDATE_FILE;

    if($src===""){
        $src=$MA_UPDATE_SRC;
    }
    $ret=false;
    if ($MA_UPDATE_FILE<>""){
        $filed=$src."/".$MA_UPDATE_FILE;
        $opt=array(
            "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
            ),
        );
        if(file_put_contents($MA_TMP_DIR."/".$MA_UPDATE_FILE,file_get_contents($filed,false,stream_context_create($opt)))){
            $ret=true;
        }
    }
    return($ret);
}


# frissítés telepítése
function update_sys(){
    global $MA_TMP_DIR,$MA_UPDATE_FILE,$MA_SERVER_DIR,$L_UPDATE_ERROR;

    $ok=true;
    $f=$MA_TMP_DIR."/".$MA_UPDATE_FILE;
    $ft=substr($f,0,strlen($f)-3);
    if (file_exists($ft)){
        unlink($ft);
    }
    try{
        $p=new PharData("$f");
        $p->decompress();
        $pt=new PharData($ft);
        #$pt->extractTo("../",null,true);
        $pt->extractTo("$MA_SERVER_DIR/",null,true);
    }catch (exception $e){
	    echo(date('Y.m.d')." - $MA_UPDATE_FILE - $f - $ft - $MA_SERVER_DIR - $L_UPDATE_ERROR");
        $ok=false;
    }
    unlink($f);
    unlink($ft);
    if($ok){
        header("Refresh:0");
    }
}


?>
