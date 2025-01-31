<?php

 #
 # MiniFW 3
 #
 # alap függvények
 #
 #



# indító url előállítása
function starturl($dir=__DIR__){
  $r="";
  $dir=str_replace('\\','/',realpath($dir));
  if (!empty($_SERVER['HTTPS'])){
    $r=$r."https://";
  }else{
    $r=$r."http://";
  }
  if (isset($_SERVER['HTTP_HOST'])){
    $r=$r.$_SERVER['HTTP_HOST'];
  }
  if (!empty($_SERVER['CONTEXT_PREFIX'])){
    $r=$r.$_SERVER['CONTEXT_PREFIX'];
    $r=$r.substr($dir,strlen($_SERVER['CONTEXT_DOCUMENT_ROOT'])+1);
  } else {
    $r=$r.substr($dir,strlen($_SERVER['DOCUMENT_ROOT'])+1);
  }
  $r=$r."/";
  return($r);
}



# cookie-k beolvasása
function cookie_load(&$cookiearr=array()){
  for($i=0;$i<count($cookiearr);$i++){
    $ca=$cookiearr[$i];
    if($ca[0]<>""){
      $cn=$ca[0];
      if(isset($_COOKIE[$cn])){
        $ca[1]=$_COOKIE[$cn];
        $cookiearr[$i]=$ca;
      }
    }
  }
}



# cookie-k tárolása
function cookie_set($cookiearr=array()){
  for($i=0;$i<count($cookiearr);$i++){
    $c=$cookiearr[$i];
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



# oldal úratörése
function reload($page=""){
  if ($page<>""){
    header("Refresh:0; url=$page");
  }else{
    header("Refresh:0; url=/index.php");
  }
}




?>
