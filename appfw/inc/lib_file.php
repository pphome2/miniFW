<?php

 #
 # MiniFW 3
 #
 # fájl/mappa műveletek
 #



# tartalom kiírása fájlba
function file_write($file="",$cont="",$devmode=false){
  if (($file<>"")and($cont<>"")){
    if ($devmode){
      echo($file."<br />");
    }
    try{
      file_put_contents($file,$cont);
    }catch (Exception $e){
      if ($devmode){
        echo($e->getMessage());
      }
    }
  }
}



# tartalom beolvasása fájlból
function file_read($file="",$devmode=false){
  $r=array();
  if (($file<>"")and(file_exists($file))){
    if ($devmode){
      echo($file."<br />");
    }
    try{
      $h=fopen("$file",'r');
      while($l=fgets($h)){
        $r[]=$l;
      }
      fclose($h);
    }catch (Exception $e){
      if ($devmode){
        echo($e->getMessage());
      }
    }
  }
  return($r);
}



# mappa tartalma
function dir_list($dir="",$devmode=false){
  $r=array();
  if (($dir<>"")and(is_dir($dir))){
    if ($devmode){
      echo($dir."<br />");
    }
    try{
      $x=scandir($dir);
      foreach($x as $f){
        if (($f<>".")and($f<>"..")){
          $r[]=$f;
        }
      }
    }catch (Exception $e){
      if ($devmode){
        echo($e->getMessage());
      }
    }
  }
  return($r);
}



# könyvtár csomagolása
function dir_backup($file="",$dir="",$devmode=false){
  if (($file<>"")and($dir<>"")){
    if ($devmode){
      echo($file." - ".$dir."<br />");
    }
    try {
      if (file_exists($file.".tar.gz")){
        unlink("$file.tar.gz");
      }
      $a=new PharData("$file.tar");
      $a->buildFromDirectory($dir);
      $a->compress(Phar::GZ);
      unlink("$file.tar");
    }catch (Exception $e){
      if ($devmode){
        echo($e->getMessage());
      }
    }
  }
}




?>
