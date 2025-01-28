<?php

 #
 # MiniFW 3
 #
 # app indító
 #


class fw_app{
  # verzió adatok
  public $APP_VERSION="0";
  public $APP_NAME="appfw";
  # include files
  public $APP_CONTENT_DIR="";
  public $APP_JS="app.js";
  public $APP_CSS="app.css";
  # beállítások
  public $APP_TITLE="Tesztelő app";
  public $APP_FAVICON="favicon.png";
  public $APP_TEMPLATE="mini";
  public $APP_MENU_LETTER="m";
  # felépítés
  public $APP_MENU=array();
  public $APP_COOKIE=array();



  function __construct($appdir=""){
    global $fwlang,$fwsql,$fwcfg;

    $this->APP_CONTENT_DIR=$appdir;
    $fn=$this->{'APP_CONTENT_DIR'}."/".$this->{'APP_JS'};
    if (file_exists($fn)){
      echo("<script>");
      include($fn);
      echo("</script>");
    }
    $fn=$this->{'APP_CONTENT_DIR'}."/".$this->{'APP_CSS'};
    if (file_exists($fn)){
      echo("<style>");
      include($fn);
      echo("</style>");
    }

    # előkészítés

    # menü: név, link
    $this->APP_MENU=array(
                      array("Menü1",$this->APP_MENU_LETTER."=1"),
                      array("Menü2",$this->APP_MENU_LETTER."=2"),
                      array("Menü3",$this->APP_MENU_LETTER."=3")
                    );
    # cookie: név, érték, hány napig tárolja
    $this->APP_COOKIE=array(
                        array("c1","1",1),
                        array("c2","2",1)
                      );
    $r=$fwsql->get_param($fwsql->SQL_DEV_MODE_STR);
    if ($r===""){
      $fwsql->save_param($fwsql->SQL_DEV_MODE_STR,"$fwcfg->FW_DEV_MODE");
    }else{
      $fwcfg->FW_DEV_MODE=$r;
    }
    if ($fwcfg->FW_DEV_MODE){
      echo("DEV<br />");
    }
  }



  # vezérlő
  function main(){
    global $fwlang;

    echo("<br /><br />");
    $l=$this->APP_MENU_LETTER;
    $m="0";
    if (isset($_GET["$l"])){
      $m=$_GET["$l"];
      echo("Menüpont: ".$m);
    }
    $c=$this->APP_COOKIE[0];
    echo("<br />Előző: ".$c[1]);
    $c[1]=$m;
    $this->APP_COOKIE[0]=$c;
    echo("<br />Aktuális: ".$c[1]);
    $this->cookie_set();
    echo("<br /><br />");
    echo("<p class=pbody>");
    echo($fwlang->lang("első"));
    echo($fwlang->lang("második"));
    echo("</p>");
    #echo($fwsql->get_param("SQL_VERSION"));
    #$fwsql->save_param("SQL_VERSION","1.1");
    #echo($fwsql->get_param("SQL_VERSION"));
    #$fwsql->save_param("SQL_VERSION",$fwsql->SQL_VERSION);
  }



  # cookie beállítás
  function cookie_set(){
    cookie_set($this->APP_COOKIE);
  }



  # cookie beállítás
  function cookie_load(){
    cookie_load($this->APP_COOKIE);
  }



}




?>
