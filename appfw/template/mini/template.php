<?php

 #
 # MiniFW 3
 #
 # template
 #



class mini{
  # verzió adatok
  public $TEMP_VERSION="0";
  public $TEMP_VERSION_STR="TEMP_VERSION";
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



  # beérkező adatok feldolgozása
  function postdata(){
    global $fwapp;

    if (isset($_POST['uname'])and(isset($_POST['upass']))and
       ($_POST['uname']<>"")and($_POST['upass']<>"")){
      $fwapp->APP_USER_NAME=$_POST['uname'];
      $fwapp->APP_USER_PW=$_POST['upass'];
    }
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
  }



  # fejrész
  function header(){
    global $fwapp,$fwlang;

    echo("<div class=all-page>");
    echo("<header>\n");
    echo("<div class=\"menu\">");
    echo("<ul class=\"sidenav\">");
    echo("<li><a href=\"?\"> [ $fwapp->APP_NAME ] </a></li>");
    $i=0;
    foreach($fwapp->APP_MENU as $l){
      if (($i+1)<>$fwapp->APP_MENU_ACT){
        echo("<li><a href=\"?$l[1]\">$l[0]</a></li>");
      }else{
        echo("<li><a class=\"active\" href=\"?$l[1]\">$l[0]</a></li>");
      }
      $i++;
    }
    if ($fwapp->APP_USER_NAME<>""){
      $c=$fwapp->APP_COOKIE[0];
      echo("<li class=\"liright\">");
      echo("<a href=? onclick=\"document.cookie='".$c[0]."=; expires=passedDate';\">".$fwlang->lang("Kilépés")." [ $fwapp->APP_USER_NAME ]</a>");
      echo("</li>");
    }
    echo("</ul>");
    echo("</div>");
    echo("</header>\n");
    echo("<div class=\"content\">");

    # bejelentkezés kezelése
    if (($fwapp->APP_USER_LOGIN)and($fwapp->APP_USER_NAME==="")){
      echo("<div class=lbox>");
      echo("<form id=db0 method=\"post\">");
      echo("<div class=prlaceholder></div>");
      echo("<label for=\"0\">".$fwlang->lang("Felhasználónév").":</label><br>");
      echo("<input type=\"text\" id=\"uname\" name=\"uname\" placeholder=\"\" value=\"\"><br>");
      echo("<br />");
      echo("<label for=\"1\">".$fwlang->lang("Jelszó").":</label><br>");
      echo("<input type=\"password\" id=\"upass\" name=\"upass\" placeholder=\"\" value=\"\"><br>");
      echo("<br />");
      echo("<div class=prlaceholder></div>");
      echo("<input type=submit id=\"db\" name=\"db\" value=\"".$fwlang->lang("Mehet")."\">");
      echo("</form>");
      echo("<div class=prlaceholder></div>");
      echo("</div>");
    }
  }



  # lábrész
  function footer(){
    global $fwcfg,$fwapp,$fwlang;

    echo("</div>\n");
    echo("<footer>\n");
    echo("<div class=\"menu\">");
    echo("<ul class=\"sidenav\">");
    echo("<li class=\"lileft\"><a>$fwapp->APP_COPYRIGHT</a></li>");
    if ($fwcfg->FW_ADMIN_MODE){
      echo("<li class=\"liright\"><a href=\"?\">");
      echo($fwlang->lang("Kilépés"));
      echo("</a></li>");
    }else{
      echo("<li class=\"liright\"><a href=\"?$fwcfg->FW_ADMIN_LINK=x\">");
      #echo($fwlang->lang("Belépés"));
      echo(" [ ".$fwcfg->FW_ADMIN_LINK." ] ");
      echo("</a></li>");
    }
    echo("</ul>");
    echo("</div>\n");
    echo("</footer>");
  }



  # lap lezárás
  function pageend(){
    echo("</body>\n");
    echo("</html>\n");
  }



}


?>
