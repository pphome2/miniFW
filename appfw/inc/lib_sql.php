<?php

 #
 # MiniFW 3
 #
 # sql függvények
 #
 #



mysqli_report(MYSQLI_REPORT_OFF);

class fw_sql{
  public $SQL_VERSION="0";
  public $SQL_SERVER="";
  public $SQL_DB="";
  public $SQL_USER="";
  public $SQL_PASS="";
  public $SQL_ERROR="";
  public $SQL_PREFIX="afw_";
  public $SQL_RESULT=array();
  public $SQL_DEV_MODE=false;
  public $SQL_DEV_MODE_STR="DEV_MODE";

  public $SQL_TABLE_PARAM="";
  public $SQL_TABLE_PARAM_CREATE="";
  public $SQL_TABLE_USERS="";
  public $SQL_TABLE_USERS_CREATE="";



  function __construct($s="",$d="",$u="",$p="",$dm=""){
    $this->{'SQL_SERVER'}=$s;
    $this->{'SQL_DB'}=$d;
    $this->{'SQL_USER'}=$u;
    $this->{'SQL_PASS'}=$p;
    $this->{'SQL_DEV_MODE'}=$dm;
    $this->SQL_TABLE_PARAM=$this->SQL_PREFIX."param";
    $this->SQL_TABLE_PARAM_CREATE="CREATE TABLE IF NOT EXISTS ".$this->SQL_TABLE_PARAM." (
                                      id mediumint(9) NOT NULL AUTO_INCREMENT,
                                      name tinytext NOT NULL,
                                      text text NOT NULL,
                                      PRIMARY KEY  (id)
                                      );";
    $this->SQL_TABLE_USERS=$this->SQL_PREFIX."users";
    $this->SQL_TABLE_USERS_CREATE="CREATE TABLE IF NOT EXISTS ".$this->SQL_TABLE_USERS." (
                                      id mediumint(9) NOT NULL AUTO_INCREMENT,
                                      uname tinytext NOT NULL,
                                      upass tinytext NOT NULL,
                                      urole int NOT NULL,
                                      text text NOT NULL,
                                      PRIMARY KEY  (id)
                                      );";
    $sql="SELECT * FROM $this->SQL_TABLE_PARAM;";
    if (!$this->sql_run($sql)){
      $this->sql_run($this->SQL_TABLE_PARAM_CREATE);
      $sql="INSERT INTO $this->SQL_TABLE_PARAM (name,text) VALUES ('SQL_VERSION',\'$this->SQL_VERSION\');";
      $this->sql_run($sql);
      $sql="INSERT INTO $this->SQL_TABLE_PARAM (name,text) VALUES (\'$this->SQL_DEV_MODE_STR\',\'$this->SQL_DEV_MODE\');";
      $this->sql_run($sql);
    }
    $sql="SELECT * FROM $this->SQL_TABLE_USERS;";
    if (!$this->sql_run($sql)){
      $this->sql_run($this->SQL_TABLE_USERS_CREATE);
    }
  }



  # paraméter mentése
  function save_param($name="",$data=""){
    $sql="SELECT * FROM $this->SQL_TABLE_PARAM WHERE name='$name';";
    if ($this->sql_run($sql)){
      if (count($this->SQL_RESULT)>0){
        $sql="UPDATE $this->SQL_TABLE_PARAM SET text='$data' WHERE name='$name';";
      }else{
        $sql="INSERT INTO $this->SQL_TABLE_PARAM (name,text) VALUES ('$name','$data');";
      }
      $this->sql_run($sql);
    }
  }



  # paraméter beolvasása
  function get_param($name=""){
    $r="";
    $sql="SELECT * FROM $this->SQL_TABLE_PARAM WHERE name='$name';";
    if ($this->sql_run($sql)){
      foreach ($this->SQL_RESULT as $d){
        $r=$r.$d[2];
      }
    }
    return($r);
  }


  # formázás
  function sqlinput($d){
    $d=trim($d);
    $d=stripslashes($d);
    $d=strip_tags($d);
    #$d=htmlspecialchars($d);
    return($d);
  }



  # sql parancs futtatása az sql szerveren
  function sql_run($sqlcomm="",$html=false){
    $ret=false;
    if (function_exists('mysqli_connect')){
      if ($sqlcomm<>""){
        if (!$html){
          $sqlcomm=$this->sqlinput($sqlcomm);
        }
        $this->SQL_ERROR="";
        $this->SQL_RESULT=array();
        $sqllink=mysqli_connect("$this->SQL_SERVER","$this->SQL_USER","$this->SQL_PASS","$this->SQL_DB");
        $this->SQL_ERROR=mysqli_error($sqllink);
        if ($this->SQL_ERROR===""){
          $result=mysqli_query($sqllink,$sqlcomm);
          $this->SQL_ERROR=mysqli_error($sqllink);
          if ($this->SQL_ERROR===""){
            if (!is_bool($result)){
              if ($this->SQL_ERROR===""){
                $i=0;
                while($row=mysqli_fetch_row($result)){
                  $this->SQL_RESULT[$i]=$row;
                  $i++;
                }
                $ret=true;
              }
            }else{
                $this->SQL_ERROR=mysqli_error($sqllink);
                $ret=$result;
            }
          }
          mysqli_close($sqllink);
        }
      }
    }
    if (($this->SQL_ERROR<>"")and($this->SQL_DEV_MODE)){
      echo("<br /><br />!!! $sqlcomm<br />");
      echo("$this->SQL_ERROR<br /><br />");
    }
    return($ret);
  }



  # teszt
  function sql_test(){
    $r="SQL:<br /><br />";
    $r=$r.$this->SQL_SERVER."<br />";
    $r=$r.$this->SQL_DB."<br />";
    $r=$r.$this->SQL_USER."<br />";
    $r=$r.$this->SQL_PASS."<br />";
    $r=$r."<br /><br />";
    if ($this->sql_run("SHOW TABLES;")){
      foreach ($this->SQL_RESULT as $c){
        $r=$r.$c[0]."<br />";
      }
    }
    $r=$r."<br /><br />";
    return($r);
  }


}


?>
