<?php

 #
 # MiniFW 3
 #
 # sql tábla függvények
 #
 #



class fw_sqlm{
  public $SQL_PREFIX="afw_";
  public $SQL_TABLE_PARAM="";
  public $SQL_TABLE_PARAM_CREATE="";
  public $SQL_TABLE_USERS="";
  public $SQL_TABLE_USERS_CREATE="";
  public $SQL_TABLE_SYS=array();
  public $SQL_TABLE_APP=array();



  function __construct(){
    global $fwsql,$fwcfg;

    $this->SQL_TABLE_PARAM=$this->SQL_PREFIX."param";
    $this->SQL_TABLE_SYS[]=$this->SQL_TABLE_PARAM;
    $this->SQL_TABLE_PARAM_CREATE="CREATE TABLE IF NOT EXISTS ".$this->SQL_TABLE_PARAM." (
                                      id mediumint(9) NOT NULL AUTO_INCREMENT,
                                      name tinytext NOT NULL,
                                      text text NOT NULL,
                                      PRIMARY KEY  (id)
                                      );";
    $this->SQL_TABLE_USERS=$this->SQL_PREFIX."users";
    $this->SQL_TABLE_SYS[]=$this->SQL_TABLE_USERS;
    $this->SQL_TABLE_USERS_CREATE="CREATE TABLE IF NOT EXISTS ".$this->SQL_TABLE_USERS." (
                                      id mediumint(9) NOT NULL AUTO_INCREMENT,
                                      uname tinytext NOT NULL,
                                      upass tinytext NOT NULL,
                                      urole int NOT NULL,
                                      text text NOT NULL,
                                      PRIMARY KEY  (id)
                                      );";

    # rendszertáblák ellenőrzése
    $sql="SELECT * FROM $this->SQL_TABLE_PARAM;";
    if (!$fwsql->sql_run($sql)){
      $fwsql->sql_run($this->SQL_TABLE_PARAM_CREATE);
      $sql="INSERT INTO $this->SQL_TABLE_PARAM (name,text) VALUES (\'$fwsql->SQL_VERSION_STR\',\'$fwsql->SQL_VERSION\');";
      $fwsql->sql_run($sql);
      $sql="INSERT INTO $this->SQL_TABLE_PARAM (name,text) VALUES (\'$fwcfg->FW_VERSION_STR\',\'$fwcfg->FW_VERSION\');";
      $fwsql->sql_run($sql);
      $sql="INSERT INTO $this->SQL_TABLE_PARAM (name,text) VALUES (\'$fwsql->SQL_DEV_MODE_STR\',\'$fwsql->SQL_DEV_MODE\');";
      $fwsql->sql_run($sql);
    }
    $sql="SELECT * FROM $this->SQL_TABLE_USERS;";
    if (!$fwsql->sql_run($sql)){
      $fwsql->sql_run($this->SQL_TABLE_USERS_CREATE);
    }
  }



  # paraméter mentése
  function save_param($name="",$data=""){
    global $fwsql;

    $sql="SELECT * FROM $this->SQL_TABLE_PARAM WHERE name='$name';";
    if ($fwsql->sql_run($sql)){
      if (count($fwsql->SQL_RESULT)>0){
        $sql="UPDATE $this->SQL_TABLE_PARAM SET text='$data' WHERE name='$name';";
      }else{
        $sql="INSERT INTO $this->SQL_TABLE_PARAM (name,text) VALUES ('$name','$data');";
      }
      $fwsql->sql_run($sql);
    }
  }



  # paraméter beolvasása
  function get_param($name=""){
    global $fwsql;

    $r="";
    $sql="SELECT * FROM $this->SQL_TABLE_PARAM WHERE name='$name';";
    if ($fwsql->sql_run($sql)){
      foreach ($fwsql->SQL_RESULT as $d){
        $r=$r.$d[2];
      }
    }
    return($r);
  }



  # felhasználó mentése
  function save_user($uname="",$upass="",$urole,$text=""){
    global $fwsql;

    $sql="SELECT * FROM $this->SQL_TABLE_USERS WHERE uname='$uname';";
    if ($fwsql->sql_run($sql)){
      if (count($fwsql->SQL_RESULT)>0){
        $sql="UPDATE $this->SQL_TABLE_USERS SET upass=$upass,urole=$urole,text='$text' WHERE uname='$uname';";
      }else{
        $sql="INSERT INTO $this->SQL_TABLE_USERS (uname,upass,urole,text) VALUES ('$uname','$upass','$urole','$text');";
      }
      $fwsql->sql_run($sql);
    }
  }



  # felhasználó beolvasása
  function get_user($uname=""){
    global $fwsql;

    $r="";
    $sql="SELECT * FROM $this->SQL_TABLE_USERS WHERE uname='$uname';";
    if ($fwsql->sql_run($sql)){
      foreach ($fwsql->SQL_RESULT as $d){
        $r=$r.$d[2];
      }
    }
    return($r);
  }



  # felhasználó ellenőrzése
  function check_user($uname="",$upasss=""){
    global $fwsql;

    $r=false;
    if (($uname<>"")and($upass<>"")){
      $sql="SELECT * FROM $this->SQL_TABLE_USERS WHERE uname='$uname',upass='$upass';";
      if ($fwsql->sql_run($sql)){
        if (count($fwsql->SQL_RESULT)>1){
          $r=true;
        }
      }
    }
    return($r);
  }



}


?>
