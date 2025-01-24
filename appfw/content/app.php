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



  function __construct($appdir=""){
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
  }

  # vezérlő
  function main(){
    echo("<p class=pbody>");
    echo(fw_lang("első"));
    echo(fw_lang("második"));
    echo("</p>");
  }
}




?>
