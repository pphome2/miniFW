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



  # sql frissítés
  function sql_update($oldver=""){
    global $fwsql,$fwsqlm;

    #echo("FRISSÍTÉS - $oldver - $his->SQL_VERSION");
    $this->save_param($fwsql->SQL_VERSION_STR,$fwsql->SQL_VERSION);
  }



  # verzió ellenőrzése
  function version_check(){
    global $fwsql,$fwapp,$fwtemp;

    $r=$this->get_param($fwapp->APP_VERSION_STR);
    if ($r===""){
      $this->save_param($fwapp->APP_VERSION_STR,"$fwapp->APP_VERSION");
    }
    $r=$this->get_param($fwsql->SQL_VERSION_STR);
    if ($r===""){
      $this->save_param($fwsql->SQL_VERSION_STR,"$fwsql->SQL_VERSION");
    }else{
      if ($r<>$fwsql->SQL_VERSION){
        $this->sql_update($r);
      }
    }
    $r=$this->get_param($fwtemp->TEMP_VERSION_STR);
    if ($r===""){
      $this->save_param($fwtemp->TEMP_VERSION_STR,"$fwtemp->TEMP_VERSION");
    }
  }



  # verzió kiírás
  function versions(){
    global $fwcfg,$fwsql,$fwapp,$fwtemp;

    $r=$this->get_param($fwcfg->FW_VERSION_STR);
    echo("$fwcfg->FW_VERSION_STR - $fwcfg->FW_VERSION<br />");
    $r=$this->get_param($fwsql->SQL_VERSION_STR);
    echo("$fwsql->SQL_VERSION_STR - $fwsql->SQL_VERSION<br />");
    $r=$this->get_param($fwapp->APP_VERSION_STR);
    echo("$fwapp->APP_VERSION_STR - $fwapp->APP_VERSION<br />");
    $r=$this->get_param($fwtemp->TEMP_VERSION_STR);
    echo("$fwtemp->TEMP_VERSION_STR - $fwtemp->TEMP_VERSION<br />");
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



  # paraméter mentése id alapján
  function save_param_id($id="",$name="",$data=""){
    global $fwsql;

    $sql="SELECT * FROM $this->SQL_TABLE_PARAM WHERE id='$id';";
    if ($fwsql->sql_run($sql)){
      if (count($fwsql->SQL_RESULT)>0){
        $sql="UPDATE $this->SQL_TABLE_PARAM SET name='$name',text='$data' WHERE id='$id';";
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
  function save_user($uname="",$upass="",$urole="",$text=""){
    global $fwsql;

    $sql="SELECT * FROM $this->SQL_TABLE_USERS WHERE uname='$uname';";
    if ($fwsql->sql_run($sql)){
      if (count($fwsql->SQL_RESULT)>0){
        if (($upass==="")or(strlen($upass)===60)){
          $d=$fwsql->SQL_RESULT[0];
          $upass=$d[2];
        }else{
          $upass=$this->pw($upass);
        }
        $ur=(int)$urole;
        $sql="UPDATE $this->SQL_TABLE_USERS SET upass='$upass',urole='$ur',text='$text' WHERE uname='$uname';";
      }else{
        $ur=(int)$urole;
        $sql="INSERT INTO $this->SQL_TABLE_USERS (uname,upass,urole,text) VALUES ('$uname','$upass','$ur','$text');";
      }
      $fwsql->sql_run($sql);
    }
  }



  # felhasználó mentése
  function save_user_id($id="",$uname="",$upass="",$urole="",$text=""){
    global $fwsql;

    $sql="SELECT * FROM $this->SQL_TABLE_USERS WHERE id='$id';";
    if ($fwsql->sql_run($sql)){
      if (count($fwsql->SQL_RESULT)>0){
        if (($upass==="")or(strlen($upass)===60)){
          $d=$fwsql->SQL_RESULT[0];
          $upass=$d[2];
        }else{
          $upass=$this->pw($upass);
        }
        $ur=(int)$urole;
        $sql="UPDATE $this->SQL_TABLE_USERS SET uname='$uname',upass='$upass',urole='$ur',text='$text' WHERE id='$id';";
      }else{
        $ur=(int)$urole;
        $sql="INSERT INTO $this->SQL_TABLE_USERS (uname,upass,urole,text) VALUES ('$uname','$upass','$ur','$text');";
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



  # felhasználó szerep beállítása
  function set_user_role($uname="",&$urole=""){
    global $fwsql;

    $sql="SELECT * FROM $this->SQL_TABLE_USERS WHERE uname='$uname';";
    if ($fwsql->sql_run($sql)){
      $r=$fwsql->SQL_RESULT[0];
      $urole=$r[3];
    }
  }



  # felhasználó ellenőrzése
  function check_user($uname="",$upass=""){
    global $fwsql;

    $r=false;
    if (($uname<>"")and($upass<>"")){
      $sql="SELECT * FROM $this->SQL_TABLE_USERS WHERE uname='$uname';";
      if ($fwsql->sql_run($sql)){
        if (count($fwsql->SQL_RESULT)>0){
          $u=$fwsql->SQL_RESULT[0];
          $r=$this->pwchk($upass,$u[2]);
        }
      }
    }
    return($r);
  }



  # felhasználó ellenőrzése
  function check_user_name($uname=""){
    global $fwsql;

    $r=false;
    if ($uname<>""){
      $sql="SELECT * FROM $this->SQL_TABLE_USERS WHERE uname='$uname';";
      if ($fwsql->sql_run($sql)){
        if (count($fwsql->SQL_RESULT)>0){
          $r=true;
        }
      }
    }
    return($r);
  }



  # jelszókezelés
  function pw($upass=""){
    $r=password_hash($upass,PASSWORD_DEFAULT);
    return($r);
  }



  # jelszó ellenőrzése
  function pwchk($upass="",$stpass=""){
    $r=password_verify("$upass","$stpass");
    #if($r){echo("OK");}
    #echo("$upass - $stpass");
    return($r);
  }



}




?>
