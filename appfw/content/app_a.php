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
  # felépítés
  public $APP_MENU=array();



  function __construct($appdir=""){
    global $fwlang;

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
    $this->APP_MENU=array(
                      array("Menü1","m=1"),
                      array("Menü2","m=2"),
                      array("Menü3","m=3")
                      );
  }



  # vezérlő
  function main(){
    global $fwlang;

    echo("<p class=pbody>");
    echo($fwlang->lang("első"));
    echo($fwlang->lang("második"));
    echo("</p>");
  }
}




?>
