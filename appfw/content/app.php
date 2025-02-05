<?php

 #
 # MiniFW 3
 #
 # app indító
 #



class fw_app{
  # verzió adatok
  public $APP_VERSION="0";
  public $APP_VERSION_STR="APP_VERSION";
  public $APP_NAME="appfw";
  public $APP_COPYRIGHT="2025. WSWDTeam";

  # include files
  public $APP_CONTENT_DIR="";
  public $APP_JS="app.js";
  public $APP_CSS="app.css";
  public $APP_FILES=array("app_a.php");

  # beállítások
  public $APP_TITLE="Tesztelő app";
  public $APP_FAVICON="favicon.png";
  public $APP_TEMPLATE="mini";
  public $APP_MENU_LETTER="m";

  # felhasználó
  public $APP_USER_ADMIN="appfwadmin";
  public $APP_USER_NAME="";
  public $APP_USER_PW="";
  public $APP_USER_ROLE="";
  public $APP_USER_LOGIN=false;

  # felépítés
  public $APP_MENU=array();
  public $APP_MENU_ACT=999;

  # cookie
  public $APP_COOKIE=array();

  # egyéb beállítások
  public $APP_TABLE_ROW=2;



  function __construct($appdir=""){
    global $fwcfg,$fwlang,$fwsql,$fwsqlm;

    $this->APP_CONTENT_DIR=$appdir;

    # menü: név, link
    if ($fwcfg->FW_ADMIN_MODE){
      $this->APP_MENU=array(
                        array($fwlang->lang("Menü1"),$fwcfg->FW_ADMIN_LINK."=a&".$this->APP_MENU_LETTER."=1"),
                        array($fwlang->lang("Menü2"),$fwcfg->FW_ADMIN_LINK."=a&".$this->APP_MENU_LETTER."=2"),
                        array($fwlang->lang("Menü3"),$fwcfg->FW_ADMIN_LINK."=a&".$this->APP_MENU_LETTER."=3"),
                        array($fwlang->lang("Admin"),$fwcfg->FW_ADMIN_LINK."=a&".$this->APP_MENU_LETTER."=4")
                      );
    }else{
      $this->APP_MENU=array(
                        array($fwlang->lang("Menü1"),$this->APP_MENU_LETTER."=1"),
                        array($fwlang->lang("Menü2"),$this->APP_MENU_LETTER."=2"),
                        array($fwlang->lang("Menü3"),$this->APP_MENU_LETTER."=3")
                      );
    }
    # cookie: név, érték, hány napig tárolja
    $this->APP_COOKIE=array(
                        array("appfw-u","",1),
                        array("appfw-x","",1)
                      );

    # admin felhasználó
    if ($fwsqlm->get_user($this->APP_USER_ADMIN)===""){
      $pass=$this->APP_NAME.date('Ym');
      $fwsqlm->save_user($this->APP_USER_ADMIN,$pass,0,"Admin felhasználó");
      #echo("$this->APP_USER_ADMIN - $pass");
    }
  }



  # vezérlő
  function main(){
    global $fw_app_admin;
    $this->load_js_css();
    switch($this->APP_MENU_ACT){
      case 1:
        echo("Menüpont: 1");
        break;
      case 2:
        if ($this->APP_USER_NAME<>""){
          echo("Menüpont: 2 - belépve<br />");
          echo($this->APP_USER_NAME);
        }
        break;
      case 3:
        if ($this->APP_USER_NAME<>""){
          echo("Menüpont: 3 - belépve<br />");
          echo($this->APP_USER_NAME);
        }
        break;
      case 4:
        if ($this->APP_USER_NAME<>""){
          $fwappadmin=new fw_app_admin();
          if (method_exists($fwappadmin,'main')){
            $fwappadmin->main();
          }
        }
        break;
      default:
        echo("Főoldal<br />");
        break;
    }
  }



  # app előkésztés: cookie, felhasználó, menürendszer
  function appstart(){
    global $fwcfg,$fwsql,$fwsqlm;

    # cookie betöltése
    $this->cookie_load();

    # cookie beállítása
    # felhasználó
    $cuser=$this->APP_COOKIE[0];

    # felhasználó ellenőrzése
    if (($this->APP_USER_NAME<>"")and($this->APP_USER_PW<>"")){
      # felhasználó ellenőrzése
      if ($fwsqlm->check_user($this->APP_USER_NAME,$this->APP_USER_PW)){
        $cuser[1]=$this->APP_USER_NAME;
        $this->APP_COOKIE[0]=$cuser;
      }else{
        $cuser[1]="";
        $this->APP_USER_NAME="";
        $this->APP_MENU_ACT=999;
      }
    }else{
      if ($cuser[1]<>""){
        if ($fwsqlm->check_user_name($cuser[1])){
          $this->APP_USER_NAME=$cuser[1];
        }else{
          $cuser[1]="";
          $this->APP_USER_NAME="";
          $this->APP_MENU_ACT=999;
        }
      }
    }

    # cookie mentése
    $this->cookie_set();

    # frissítés ellenőrzése
    $ver=$fwsqlm->get_param($this->APP_VERSION_STR);
    if ($ver<>$this->APP_VERSION){
      $this->app_update($ver);
    }

    # echo($cuser[1]."-".$this->APP_USER_NAME);
    $fwsqlm->set_user_role($this->APP_USER_NAME,$this->APP_USER_ROLE);
    if ($this->APP_USER_ROLE==="0"){
      $fwcfg->FW_ADMIN_MODE=true;
    }
    # menüoldal beállítása
    $l=$this->APP_MENU_LETTER;
    if (isset($_GET["$l"])){
      $m=$_GET["$l"];
      switch($m){
        case "1":
          $this->APP_MENU_ACT=1;
          break;
        case "2":
          $this->APP_MENU_ACT=2;
          $this->APP_USER_LOGIN=true;
          break;
        case "3":
          $this->APP_MENU_ACT=3;
          $this->APP_USER_LOGIN=true;
          break;
        case "4":
          $this->APP_MENU_ACT=4;
          $this->APP_USER_LOGIN=true;
          break;
        default:
          break;
      }
    }
  }



  # az app frissítése
  function app_update($oldver=""){
    global $fwsqlm;

    #echo("FRISSÍTÉS - $oldver - $his->APP_VERSION");
    $fwsqlm->save_param($this->APP_VERSION_STR,$his->APP_VERSION);
    if ($fwsqlm->get_user($this->APP_USER_ADMIN)===""){
      $pass=$this->APP_NAME.date('Ym');
      $fwsqlm->save_user($this->APP_USER_ADMIN,$pass,0,"Admin felhasználó");
      #echo("$this->APP_USER_ADMIN - $pass");
    }
  }



  # css js betöltése
  function load_js_css(){
    $fn=$this->APP_CONTENT_DIR."/".$this->APP_JS;
    if (file_exists($fn)){
      echo("<script>");
      include($fn);
      echo("</script>");
    }
    $fn=$this->APP_CONTENT_DIR."/".$this->APP_CSS;
    if (file_exists($fn)){
      echo("<style>");
      include($fn);
      echo("</style>");
    }
  
  }



  # adat és fájlmentés
  function app_backup(){
    global $fwcfg,$fwsqlm,$fwsql;

    $r=$fwsql->sql_backup_tables($fwsqlm->SQL_TABLE_SYS);
    $filesql=$fwcfg->{'FW_FS_MAIN_DIR'}."/".$fwcfg->{'FW_MEDIA_DIR'}."/".$fwcfg->{'FW_SQL_DB'}.".sql";
    file_write($filesql,$r,$fwcfg->{'FW_DEV_MODE'});
    $file=$fwcfg->{'FW_FS_MAIN_DIR'}."/".$fwcfg->{'FW_MEDIA_DIR'}."/".$this->APP_NAME;
    dir_backup($filesql,$fwcfg->{'FW_DEV_MODE'});
  }



  # adat és fájlmentés
  function app_restore(){
    global $fwcfg,$fwsql;
  
    $filesql=$fwcfg->{'FW_FS_MAIN_DIR'}."/".$fwcfg->{'FW_MEDIA_DIR'}."/".$fwcfg->FW_SQL_DB.".sql";
    $fwsql->sql_restore_tables($filesql);
  }



  # cookie beállítás
  function cookie_set(){
    cookie_set($this->APP_COOKIE);
  }



  # cookie beállítás
  function cookie_load(){
    cookie_load($this->APP_COOKIE);
  }



  # funkciók tesztje
  function app_test(){
    global $fwcfg,$fwlang,$fwsqlm,$fwsql;

    # cookie kezelés
    $c=$this->APP_COOKIE[0];
    echo("<br />Előző: ".$c[1]);
    echo("<br />Aktuális: ".$this->APP_MENU_ACT);
    # admin mód
    if ($fwcfg->FW_ADMIN_MODE){
      echo("<br /><br />");
      echo("<br />ADMIN<br />");
      foreach($fwsqlm->SQL_TABLE_SYS as $s){
        echo("- $s<br />");
      }
      echo("<br /><br />");
      echo("<br /><br />");
      # sql kezelés: paraméter tábla
      echo("SQL: ".$fwsqlm->get_param($fwsql->SQL_VERSION_STR));
      $fwsqlm->save_param($fwsql->SQL_VERSION_STR,"1.1");
      echo("<br />");
      echo("SQL: ".$fwsqlm->get_param($fwsql->SQL_VERSION_STR));
      $fwsqlm->save_param($fwsql->SQL_VERSION_STR,$fwsql->SQL_VERSION);
      echo("<br /><br />");
    }
    echo("<br />");
    echo("<p class=pbody>");
    echo($fwlang->lang("első"));
    echo($fwlang->lang("második"));
    echo("</p>");
  }


}




?>
