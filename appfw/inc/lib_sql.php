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
  public $SQL_VERSION_STR="SQL_VERSION";
  public $SQL_SERVER="";
  public $SQL_DB="";
  public $SQL_USER="";
  public $SQL_PASS="";
  public $SQL_ERROR="";
  public $SQL_PREFIX="afw_";
  public $SQL_RESULT=array();
  public $SQL_DEV_MODE=false;
  public $SQL_DEV_MODE_STR="DEV_MODE";

  function __construct($s="",$d="",$u="",$p="",$dm=""){
    $this->{'SQL_SERVER'}=$s;
    $this->{'SQL_DB'}=$d;
    $this->{'SQL_USER'}=$u;
    $this->{'SQL_PASS'}=$p;
    $this->{'SQL_DEV_MODE'}=$dm;
  }



  # formázás
  function sqlinput($d){
    $d=trim($d);
    $d=rtrim($d);
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
      if(function_exists('mesage_error')){
        message_error($this->SQL_ERROR);
      }else{
        echo("<br /><br />! $sqlcomm<br />");
        echo("! $this->SQL_ERROR<br /><br />");
      }
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



  # adattáblák mentése
  function sql_backup_tables($tables=array()){
    global $fwsqlm;

    $ret="";
    foreach($tables as $tname){
      if ($this->SQL_DEV_MODE){
        echo($tname."<br />");
      }
      $sql="SELECT * FROM $tname;";
      $this->sql_run($sql);
      $resdata=$this->SQL_RESULT;
      $ret=$ret."DROP TABLE IF EXISTS $tname;";
      $sql="SHOW CREATE TABLE $tname;";
      $this->sql_run($sql);
      $rescreate=$this->SQL_RESULT;
      $r=$rescreate[0];
      $ret=$ret."\n\n".$r[1].";\n\n";
      foreach($resdata as $rd){
        $ret=$ret."INSERT INTO $tname VALUES(";
        $i=0;
        foreach($rd as $rdat){
          if($i>0){
            $ret=$ret.",'".$rdat."'";
          }else{
            $ret=$ret."'".$rdat."'";
          }
          $i++;
        }
        $ret=$ret.");\n";
      }
      $ret=$ret."\n\n\n";
    }
    return($ret);
  }



  // adat visszatöltés
  function sql_restore_tables($file=""){
    global $fwsqlm;

    if (($file<>"")and(file_exists($file))){
      if ($this->SQL_DEV_MODE){
        echo($file."<br />");
      }
      try{
        $r=file_read($file,$this->SQL_DEV_MODE);
        $sql="";
        foreach($r as $l){
          $l=$this->sqlinput($l);
          if (substr($l,-1)===";"){
            $sql=$sql.$l;
            $this->sql_run($sql);
            $sql="";
          }else{
            $sql=$sql.$l;
          }
        }
      }catch (Exception $e){
        if ($this->SQL_DEV_MODE){
          echo($e->getMessage());
        }
      }
    }
  }


}



?>
