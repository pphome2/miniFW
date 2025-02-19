<?php

 #
 # MiniFW 3
 #
 # app indító
 #

namespace App;

trait app_variable{
  # verzió adatok
  public $APP_VERSION;
  public $APP_VERSION_STR;
  public $APP_NAME;
  public $APP_COPYRIGHT;
  # betöltendő fájlok
  public $APP_CONTENT_DIR;
  public $APP_JS;
  public $APP_CSS;
  public $APP_FILES;
  # könyvtárnveke, betöltés: könyvtárnév.php
  public $APP_PLUGIN_FILES;
  # beállítások
  public $APP_TITLE;
  public $APP_FAVICON;
  public $APP_TEMPLATE;
  public $APP_MENU_LETTER;
  # felhasználó
  public $APP_USER_ADMIN;
  public $APP_USER_NAME;
  public $APP_USER_PW;
  public $APP_USER_ROLE;
  public $APP_USER_LOGIN;
  # felépítés
  public $APP_MENU;
  public $APP_MENU_ACT;
  # cookie
  public $APP_COOKIE;
  # egyéb beállítások
  public $APP_TABLE_ROW;
}

trait app_func{
  # előkészítés (cookie)
  abstract function appstart();
  # vezérlő - menü indító
  abstract function main();
}


abstract class app{
  use app_variable,app_func;
}


interface app_i{
  public static function appstart();
  public static function main();
}



?>
