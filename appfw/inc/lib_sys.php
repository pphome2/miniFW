<?php

 #
 # MiniFW 3
 #
 # alap függvények
 #
 #



# szöveg fordítása
function fw_lang($s){
  global $fwlang;

  if (isset($fwlang)){
    $s=$fwlang->lang($s);
  }else{
    $s="_".$s."_";
  }
  return($s);
}



# cookie-k beolvasása
function cookie_load(){
    global $FW_COOKIES;

    for($i=0;$i<count($FW_COOKIES);$i++){
        $c=$FW_COOKIES[$i];
        if($c[0]<>""){
            $cn=$c[0];
	        if(isset($_COOKIE[$cn])){
	            $c[1]=$_COOKIE[$cn];
	            $FW_COOKIES[$i]=$c;
            }
        }
    }
}



# cookie-k tárolása
function cookie_set(){
    global $FW_COOKIES;

    for($i=0;$i<count($FW_COOKIES);$i++){
        $c=$FW_COOKIES[$i];
        if($c[0]<>""){
            $t=$c[2]*86400;
		    setcookie($c[0],$c[1],['expires'=>time()+$t,'samesite'=>'Strict']);
            //echo("$c[0],$c[1],$t");
        }
    }
}



# md5 sztring valóban md5
function checkmd5($md5=''){
	if(empty($md5)){
		return false;
	}
	return preg_match('/^[a-f0-9]{32}$/', $md5);
}



# sztring kezelés
function vinput($d) {
	$d=trim($d);
	$d=stripslashes($d);
	$d=strip_tags($d);
	$d=htmlspecialchars($d);
	return $d;
}



# sztring kezelés
function vinputtags($d) {
	$d=trim($d);
	$d=stripslashes($d);
	$d=htmlspecialchars($d);
	return $d;
}



# könyvtár tartalom
function dirlist($dir) {
	$result=array();
	$cdir=scandir($dir);
	foreach ($cdir as $key => $value){
		if (!in_array($value,array(".",".."))){
			$result[]=$value;
		}
	}
	return $result;
}



# id generálás dátumból
function genid(){
    $id=date('YmdHis');
    $id=$id.rand(10000,99999);
    return($id);
}




?>
