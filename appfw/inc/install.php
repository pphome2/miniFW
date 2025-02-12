<?php
#
# AppFW
#
# Új helyre telepítés, beállítás
#
# WSWDTeam
#


# hibák kiírása
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

# language
# nyelvi adatok
$L_TITLE="Install";
$L_PAGE_ADDRESS="Telepítés";
$L_PAGE_1="Szükséges adatok megadása";
$L_PAGE_2="Folyamat";
$L_SQL_SRV="Adatbázis szerver";
$L_SQL_DB="Adatbázis neve";
$L_SQL_USER="Felhasználónév";
$L_SQL_PW="Jelszó";
$L_SQL_GO="Mehet";
$L_SQL_PHASE_1="SQL ellenőrzés";
$L_SQL_PHASE_2="SQL 2";
$L_SQL_PHASE_3="SQL domain";
$L_PHASE_1="Fájl kicsomagolva";
$L_PHASE_2="Fájl kicsomagolva";
$L_PHASE_3="Rendrakás. Átmeneti fájlok törölve";
$L_CONFIG_PHASE_1="Konfiguráció beállítása";
$L_END="Telepítés befejezve.";
$L_NEXT="Tovább";
$L_ERROR="Hiba történt. Hibaüzenet:";
$L_FILE_ERROR="Adatfájlok nem elérhetőek.";
$L_WARNING="Figyelem!";
$L_WARNING_FOUND_CONFIG="A táblázatban szereplő adatok a megtalált beállítás fájlból származnak";

# beállítások
$I_CONFIG_FILE="config/config.php";

# fej
echo("<!DOCTYPE html>");
echo("<head>");
echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />");
echo("<title>$L_TITLE</title>");
echo("<style>");
?>
  body{
    background-color:lightgray;
  }
  .box{
    margin-left:25%;
    margin-top:5%;
    width:50%;
    background-color:white;
    border:1px solid gray;
    border-radius:10px;
    padding:30px;
    box-shadow: 10px 10px 10px 10px gray;
  }
  form, .buttonbox{
    margin-left:20%;
    margin-right:20%;
    align:center;
  }
  input{
    width:100%;
  }
  .placeholder{
    max-height:2em;
    height:2em;
    display:block;
  }
<?php
echo("</style>");
echo("</head>");
echo("<html>");
echo("<body>");
echo("<div class=box>");

# fájlok felderítése
echo("<h1>$L_PAGE_ADDRESS</h1>");
echo("<span class=placeholder></span>");


# fájl elérések ellenőrzése
$allok=true;
$ok1=false;
$ok2=false;
$md=dirname(__FILE__);
$fl=scandir($md);
foreach($fl as $l){
  $ext=pathinfo($l,PATHINFO_EXTENSION);
  switch($ext){
    case "sql":
      $ok1=true;
      break;
    case "gz":
      $ok2=true;
      break;
  }
}

if ($ok1 and $ok2){
  $ok=false;
  if (isset($_POST['db'])){
    $sqlsrv=$_POST['0'];
    if ($sqlsrv===""){
      $sqlsrv="localhost";
    }
    $sqldb=$_POST['1'];
    $sqluser=$_POST['2'];
    $sqlpw=$_POST['3'];
    try{
      $sqlconn=new mysqli($sqlsrv,$sqluser,$sqlpw,$sqldb);
      $ok=true;
      mysqli_close($sqlconn);
    } catch(Exception $e){
      echo("$L_ERROR ".$e->getMessage());
      $allok=false;
      echo("<span class=placeholder></span>");
    }
  }

  # adatbekérés
  if (!$ok){
    echo("<h2>$L_PAGE_1</h2>");
    echo("<span class=placeholder></span>");
    inst_form();
  }else{
    echo("<h2>$L_PAGE_2</h2>");
    echo("<span class=placeholder></span>");
    inst_main();
  }
}else{
  echo("$L_ERROR $L_FILE_ERROR");
  echo("<span class=placeholder></span>");
}



# fájlok feldolgozása
function inst_main(){
  global $L_END,$L_NEXT,$L_PHASE_1,$L_PHASE_2,$L_PHASE_3,$L_ERROR,
         $sqlsrv,$sqluser,$sqlpw,$sqldb,$allok;

  $md=dirname(__FILE__);
  $fl=scandir($md);
  foreach($fl as $l){
    $ext=pathinfo($l,PATHINFO_EXTENSION);
    switch($ext){
      case "sql":
          $sqlfile=$md."/".$l;
          if (file_exists($sqlfile)){
            $sqlconn=new mysqli($sqlsrv,$sqluser,$sqlpw,$sqldb);
            if ($sqlconn){
              inst_sql($sqlfile,$sqlconn);
              mysqli_close($sqlconn);
            }
          }
          echo("<br />");
        break;
      case "gz":
        $fngz=$md."/".$l;
        $tarfile=$md."/".pathinfo($l,PATHINFO_FILENAME);
        inst_files($md,$fngz,$tarfile);
        echo("<br />");
        break;
      case "tar":
        try{
          $fntar=$md."/".$l;
          unlink($fntar);
        }catch(Exception $e){
          echo("$L_ERROR ".$e->getMessage());
          $allok=false;
        }
        break;
    }
  }
  #config fájl elkészítése
  inst_config();
  # láb
  echo("<span class=placeholder></span>");
  echo($L_END);
  echo("<span class=placeholder></span>");
  if ($_SERVER['HTTPS']!="on"){
    $newurl="http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['REQUEST_URI'])."/";
  }else{
    $newurl="https://".$_SERVER['HTTP_HOST'].dirname($_SERVER['REQUEST_URI'])."/";
  }
  if($allok){
    try{
      if (($sqlfile<>"")and(file_exists($sqlfile))){
        unlink($sqlfile);
      }
      if (($fngz<>"")and(file_exists($fngz))){
        unlink($fngz);
      }
      $instf=__FILE__;
      #echo($instf);
      if (file_exists($instf)){
        unlink($instf);
      }
    }catch(Exception $e){
      echo("$L_ERROR ".$e->getMessage());
    }
  }
  if (file_exists("index.php")){
    $url=$newurl."index.php";
    echo("<div class=buttonbox><a href=\"$url\"><input type=submit value=\"$L_NEXT\"></a></div>");
  }else{
    if (file_exists("index.html")){
      $url=$newurl."index.html";
      echo("<div class=buttonbox><a href=\"index.html\"><input type=submit value=\"$L_NEXT\"></a></div>");
    }
  }
}



#config fájl elkészítése
function inst_config(){
  global $L_ERROR,$L_CONFIG_PHASE_1,$sqlsrv,$sqldb,$sqlpw,$sqluser,$allok,
         $I_CONFIG_FILE;

  if (file_exists("$I_CONFIG_FILE")){
    echo("- $L_CONFIG_PHASE_1.<br />");
    try{
      $out="";
      foreach(file("$I_CONFIG_FILE") as $line){
        #echo($line."<br />");
        if (strpos($line,"\$FW_SQL_SERVER")<>0){
          $line="  public \$FW_SQL_SERVER=\"$sqlsrv\";".PHP_EOL;
        }
        if (strpos($line,"\$FW_SQL_DB")<>0){
          $line="  public \$FW_SQL_DB=\"$sqldb\";".PHP_EOL;
        }
        if (strpos($line,"\$FW_SQL_USER")<>0){
          $line="  public \$FW_SQL_USER=\"$sqluser\";".PHP_EOL;
        }
        if (strpos($line,"\$FW_SQL_PASS")<>0){
          $line="  public \$FW_SQL_PASS=\"$sqlpw\";".PHP_EOL;
        }
        $out=$out.$line;
      }
      try{
        $handle=fopen("$I_CONFIG_FILE",'w+');
        fwrite($handle,$out);
        fclose($handle);
      }catch (Exception $e){
        echo($e->getMessage());
        $allok=false;
      }
    }catch(Exception $e){
      echo("$L_ERROR ".$e->getMessage());
      $allok=false;
    }
  }
}



# fájl kicsomagolása
function inst_files($md,$fn,$tarfile){
  global $L_PHASE_1,$L_PHASE_2,$L_PHASE_3,$L_ERROR,$allok;

  try{
    if (file_exists($tarfile)){
      unlink($tarfile);
    }
    echo("- $L_PHASE_1 (gz).<br />");
    $p=new PharData($fn);
    $p->decompress();
    # kicsomagolás
    $fn=$md."/".$tarfile.".tar";
    echo("- $L_PHASE_2 (tar).<br />");
    $phar=new PharData($tarfile);
    $phar->extractTo($md,null,true);
    # törlés
    echo("- $L_PHASE_3.<br />");
    if (file_exists($tarfile)){
       unlink($tarfile);
    }
  }catch(Exception $e){
   echo("$L_ERROR ".$e->getMessage());
   $allok=false;
  }
}



# sql feldolgozás
function inst_sql($sqlfile="",$sqlconn=false){
  global $L_SQL_PHASE_1,$L_SQL_PHASE_2,$L_SQL_PHASE_3,$sqlsrv,$sqldb,$sqlpw,$sqluser;

  if (file_exists($sqlfile)){
    echo("- $L_SQL_PHASE_1.<br />");
    $first=true;
    $sql="USE $sqldb;";
    try{
      if ($r=$sqlconn->query($sql)){
      }
      $sql="";
      foreach(file($sqlfile) as $line){
        $line=str_replace(PHP_EOL,'',$line);
        if ($line<>''){
          $sql=$sql." ".$line;
          if (substr($line,-1)===";"){
            #echo("- $L_SQL_PHASE_2.<br />");
            if ($r=$sqlconn->query($sql)){
            }
            $sql="";
          }
        }
      }
    }catch(Exception $e){
      echo($sql." - ".$e->getMessage()."<br />");
      $allok=false;
    }
  }
}



# adatbekérés
function inst_form(){
  global $L_SQL_DB,$L_SQL_GO,$L_SQL_PW,$L_SQL_SRV,$L_SQL_TABLE_PRE,
         $L_SQL_USER,$L_WARNING_FOUND_CONFIG,$L_WARNING,
         $I_CONFIG_FILE;

  $dbname="";
  $dbuser="";
  $dbpass="";
  $dbhost="";
  $pre="";
  if (file_exists("$I_CONFIG_FILE")){
    try{
      foreach(file("$I_CONFIG_FILE") as $line){
        if (strpos($line,"FW_SQL_DB")<>0){
          $a=explode("\"",$line);
          $dbname=$a[1];
        }
        if (strpos($line,"FW_SQL_USER")<>0){
          $a=explode("\"",$line);
          $dbuser=$a[1];
        }
        if (strpos($line,"FW_SQL_PASS")<>0){
          $a=explode("\"",$line);
          $dbpass=$a[1];
        }
        if (strpos($line,"FW_SQL_SERVER")<>0){
          $a=explode("\"",$line);
          $dbhost=$a[1];
        }
      }
    }catch(Exception $e){
      #echo($sql." - ".$e->getMessage()."<br />");
    }
    echo("<b>".$L_WARNING."</b> ");
    echo($L_WARNING_FOUND_CONFIG.".<br /><br /><br />");
  }
  echo("<form id=db0 method=\"post\">");
  echo("<label for=\"0\">$L_SQL_SRV:</label><br>");
  echo("<input type=\"text\" id=\"0\" name=\"0\" placeholder=\"".$L_SQL_SRV."\" value=\"".$dbhost."\"><br>");
  echo("<br />");
  echo("<label for=\"1\">$L_SQL_DB:</label><br>");
  echo("<input type=\"text\" id=\"1\" name=\"1\" placeholder=\"".$L_SQL_DB."\" value=\"".$dbname."\"><br>");
  echo("<br />");
  echo("<label for=\"2\">$L_SQL_USER:</label><br>");
  echo("<input type=\"text\" id=\"2\" name=\"2\" placeholder=\"".$L_SQL_USER."\" value=\"".$dbuser."\"><br>");
  echo("<br />");
  echo("<label for=\"3\">$L_SQL_PW:</label><br>");
  echo("<input type=\"password\" id=\"3\" name=\"3\" value=\"".$dbpass."\"><br>");
  echo("<br />");
  echo("<br /><br />");
  echo("<input type=submit id=\"db\" name=\"db\" value=\"".$L_SQL_GO."\">");
  echo("</form>");
}

echo("</div>");
echo("</body></html>");

?>
