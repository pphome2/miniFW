<?php

 #
 # MiniFW 3
 #
 # frissítés
 #



class fw_update{
  private static $UP_SQL_VERSION="";
  private static $UP_SYS_VERSION="";



  function __construct(){
    global $fwcfg,$fwsql,$fwsqlm;

    $this->UP_SQL_VERSION=$fwsqlm->get_param($fwcfg->FW_VERSION_STR);
    $this->UP_SYS_VERSION=$fwsqlm->get_param($fwsql->SQL_VERSION_STR);
    $fwsqlm->version_check();
  }



  function __destruct(){
  }



  # rendszer frissítés
  function system_update(){
    global $fwcfg,$fwsql,$fwsqlm;

    # sql frissítés verzió szerint
    if ($this->UP_SQL_VERSION<>$fwsql->SQL_VERSION){
      echo($this->UP_SQL_VERSION." sql ".$this->UP_SYS_VERSION);
      $fwsqlm->save_param($fwsql->SQL_VERSION_STR,$fwsql->SQL_VERSION);
    }

    # rendszer frissítés verzió szerint
    if ($this->UP_SYS_VERSION<>$fwcfg->FW_VERSION){
      echo($this->UP_SQL_VERSION." sys ".$this->UP_SYS_VERSION);
      $fwsqlm->save_param($fwcfg->FW_VERSION_STR,$fwcfg->FW_VERSION);
    }
  }



}



?>
