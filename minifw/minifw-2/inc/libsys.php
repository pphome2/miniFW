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
    global $MA_COOKIE_UPDATE,$MA_UPDATE_FILE,$MA_UPDATE_CHECK_DAYS,$MA_VERSION;

	if (!isset($_COOKIE[$MA_COOKIE_UPDATE])){
	    $ok=false;
        if (update_check()){
            if(update_download()){
                if (update_sys()){
                    $ok=true;
                }
                if(function_exists("sql_install")){
                    sql_install();
                    sql_update();
                }
            }
        }
		if ($ok){
	        $t=$MA_UPDATE_CHECK_DAYS*86400;
			setcookie($MA_COOKIE_UPDATE,$MA_VERSION,['expires'=>time()+$t,'samesite'=>'Strict']);
            header("Refresh:0");
		}
    }
}


# app/site frissítése
function update_site($ddir=""){;
    global $MA_COOKIE_UPDATE,$MA_UPDATE_FILE,$MA_SITE_VERSION,$MA_SITE_UPDATE_SRC,$MA_SITE_UPDATE_CHECK_DAYS,
            $MA_SERVER_DIR,$MA_CONTENT_DIR,$MA_VERSION;

	if (!isset($_COOKIE[$MA_COOKIE_UPDATE])){
		$ok=false;
        if (update_check($MA_SITE_VERSION,$MA_SITE_UPDATE_SRC)){
            if(update_download($MA_SITE_UPDATE_SRC)){
                if($ddir===""){
                    $ddir=$MA_SERVER_DIR."/".$MA_CONTENT_DIR;
                }
                $ok=update_sys($ddir);
                if(function_exists("sql_install")){
                    sql_install();
                    sql_update();
                }
            }
        }
        if ($ok){
			$t=$MA_SITE_UPDATE_CHECK_DAYS*86400;
			setcookie($MA_COOKIE_UPDATE,$MA_VERSION,['expires'=>time()+$t,'samesite'=>'Strict']);
		}
    }
}


# template frissítése
function update_template($ddir=""){;
    global $MA_COOKIE_UPDATE,$MA_UPDATE_FILE,$MA_TEMPLATE_VERSION,$MA_TEMPLATE_UPDATE_SRC,$MA_TEMPLATE_UPDATE_CHECK_DAYS,
            $MA_SERVER_DIR,$MA_TEMPLATE_DIR,$MA_VERSION;

	if (!isset($_COOKIE[$MA_COOKIE_UPDATE])){
		$ok=false;
        if (update_check($MA_TEMPLATE_VERSION,$MA_TEMPLATE_UPDATE_SRC)){
            if(update_download($MA_TEMPLATE_UPDATE_SRC)){
                if($ddir===""){
                    $ddir=$MA_SERVER_DIR."/".$MA_TEMPLATE_DIR;
                }
                $ok=update_sys($ddir);
                if(function_exists("sql_install")){
                    sql_install();
                    sql_update();
                }
            }
        }
        if ($ok){
			$t=$MA_TEMPLATE_UPDATE_CHECK_DAYS*86400;
			setcookie($MA_COOKIE_UPDATE, $MA_VERSION, ['expires'=>time()+$t,'samesite'=>'Strict']);
		}
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
    if(strpos($src,"github")>0){
        for($i=0;$i<count($l);$i++){
            $p=strpos($l[$i],"tar.gz");
            if($p<>0){
                $n=substr($l[$i],strpos($l[$i],"/"),strlen($l[$i]));
                $n=substr($n,0,strpos($n,"\""));
                if($n<>""){
                    $link="https://github.com$n";
                    $xx=explode("/",$link);
                    $xl=count($xx)-1;
                    $newver=substr($xx[$xl],0,strlen($xx[$xl])-strlen($MA_UPDATE_EXT));
                    if($newver>$ver){
                        #echo("$link - $newver<br />");
                        $MA_UPDATE_FILE=$link;
                        $ret=true;
                    }
                }
            }
        }
    }else{
        for($i=0;$i<count($l);$i++){
            $p=strpos($l[$i],"tar.gz");
            if($p<>0){
                $x=substr($l[$i],$p-strlen($ver)-1,strlen($ver)+strlen($MA_UPDATE_EXT));
                $newver=substr($x,0,strlen($x)-strlen($MA_UPDATE_EXT));
                $link=$src."/".$newver.$MA_UPDATE_EXT;
                if($newver>$ver){
                    #echo("$link - $newver<br />");
                    $MA_UPDATE_FILE=$link;
                    $ret=true;
                }
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
        $filed=$MA_UPDATE_FILE;
        $opt=array(
            "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
            ),
        );
        $xx=explode("/",$MA_UPDATE_FILE);
        $xl=count($xx)-1;
        $n=$xx[$xl];
        if(file_put_contents($MA_TMP_DIR."/".$n,file_get_contents($filed,false,stream_context_create($opt)))){
            $ret=true;
        }
    }
    return($ret);
}


# frissítés telepítése
function update_sys($destdir=""){
    global $MA_TMP_DIR,$MA_UPDATE_FILE,$MA_SERVER_DIR,$L_UPDATE_ERROR,$MA_UPDATE_SUBDIR;

    if($destdir===""){
        $destdir=$MA_SERVER_DIR;
    }
    $ok=true;
    $xx=explode("/",$MA_UPDATE_FILE);
    $xl=count($xx)-1;
    $n=$xx[$xl];
    $f=$MA_TMP_DIR."/".$n;
    $ft=substr($f,0,strlen($f)-3);
    if (file_exists($ft)){
        unlink($ft);
    }
    try{
        $p=new PharData("$f");
        $p->decompress();
        $pt=new PharData($ft);
        if(strpos($MA_UPDATE_FILE,"github")>0){
            $pt->extractTo("$MA_TMP_DIR/",null,true);
		    $dir=opendir($MA_TMP_DIR);
  			while(false!==($file=readdir($dir))){
		        if (($file!='.')&&($file!='..')){
					if (is_dir("$MA_TMP_DIR/$file/$MA_UPDATE_SUBDIR")){
			            copyfiles("./$MA_TMP_DIR/$file/$MA_UPDATE_SUBDIR",".");
          				rmfiles("./$MA_TMP_DIR/$file");
					}
		        }
		    }
  			closedir($dir);
        }else{
            $pt->extractTo("./",null,true);
        }
    }catch (exception $e){
	    echo(date('Y.m.d')." - $n - $f - $ft - $MA_SERVER_DIR - $L_UPDATE_ERROR");
        $ok=false;
    }
    unlink($f);
    unlink($ft);
    return($ok);
}


function copyfiles($src,$dst){
    $dir=opendir($src);
    while(false!==($file=readdir($dir))){
        if (($file!='.')&&($file!='..')){
            if (is_dir($src."/".$file)){
                copyfiles($src."/".$file,$dst."/".$file);
            }else{
                copy($src."/".$file,$dst."/".$file);
            }
        }
    }
    closedir($dir);
}


function rmfiles($src){
    $dir=opendir($src);
    while(false!==($file=readdir($dir))){
        if (($file!='.')&&($file!='..')){
            if (is_dir($src."/".$file)){
                rmfiles($src."/".$file);
            }else{
                unlink($src."/".$file);
            }
        }
    }
    closedir($dir);
    rmdir($src."/".$file);
}


?>
