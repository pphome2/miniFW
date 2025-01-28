<?php

 #
 # MiniFW 3
 #
 # template
 #

class mini{
  # verzió adatok
  public $TEMP_VERSION="0";
  public $TEMP_TITLE="appfw";
  # include files
  public $TEMP_FAVICON="";
  public $TEMP_JS="template.js";
  public $TEMP_CSS="template.css";
  public $TEMP_DIR="";


  function __construct($t="",$fi="",$td=""){
    $this->TEMP_TITLE=$t;
    $this->TEMP_FAVICON=$fi;
    $this->TEMP_DIR=$td;
  }



  # cím beállítás
  function title($t,$fi,$td){
    $this->TEMP_TITLE=$t;
    $this->TEMP_FAVICON=$fi;
    $this->TEMP_DIR=$td;
  }



  # fejrész
  function pagehead(){
    echo("<!DOCTYPE html>\n");
    echo("<html lang=\"hu\">\n");
    echo("<head>\n");
    echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\n");
    echo("<title>$this->TEMP_TITLE</title>\n");
    echo("<link rel=\"icon\" type=\"image/x-icon\" href=\"$this->TEMP_FAVICON\" >\n");
    echo("<link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"$this->TEMP_FAVICON\" >\n");
    echo("<meta name=\"robots\" content=\"noindex, nofollow, noarchive\" />\n");
    echo("<meta name=\"referrer\" content=\"strict-origin-when-cross-origin\" />\n");
    echo("<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />\n");
    # css és js
    echo("<style>\n");
    $fc=$this->TEMP_DIR."/".$this->TEMP_CSS;
    if (file_exists($fc)){
      include($fc);
    }
    echo("</style>\n");
    echo("</head>\n");
	echo("<body>\n");
    echo("<script>\n");
    $fc=$this->TEMP_DIR."/".$this->TEMP_JS;
    if (file_exists($fc)){
      include($fc);
    }
    echo("</script>\n");
	//echo($this->TEMP_FAVICON);
  }



  # fejrész
  function header(){
    global $fwapp;

    foreach($fwapp->APP_MENU as $m){
      echo("<a href=\"?$m[1]\">$m[0]</a> ");
    }
    echo("<br />");
    echo("<br />");
    echo("<header>\n");
    echo("</header>\n");
  }



  # lábrész
  function footer(){
    echo("<footer>\n");
    echo("</footer>\n");
    echo("</body>\n");
    echo("</html>\n");
  }
}


?>
