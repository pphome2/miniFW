<?php

 #
 # MiniFW 3
 #
 # app indító
 #


class fw_app{
  public $APP_TITLE="Tesztelő app";
  public $APP_FAVICON="favicon.png";
  public $APP_TEMPLATE="default";



  function __construct(){
  }

  # vezérlő
  function main(){
    echo(fw_lang("első"));
    echo(fw_lang("második"));
  }
}




?>
