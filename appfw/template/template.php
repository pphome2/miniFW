<?php

 #
 # MiniFW 3
 #
 # template
 #

namespace Temp;

trait temp_variable{
  # verzió adatok
  public $TEMP_VERSION;
  public $TEMP_VERSION_STR;
  # lap adatok
  public $TEMP_TITLE;
  public $TEMP_FAVICON;
  # betöltendő fájlok
  public $TEMP_DIR;
  public $TEMP_JS;
  public $TEMP_CSS;
}

trait temp_func{
  # beérkező adatok feldolgozása (bejelentkezés)
  abstract public function postdata();
  # lap eőkészítés
  abstract public function page_start();
  # fejréz, menü
  abstract public function header();
  # lábrész
  abstract public function footer();
  # lap zárás
  abstract public function page_end();
}

abstract class template{
  use temp_variable,temp_func;
}



?>
