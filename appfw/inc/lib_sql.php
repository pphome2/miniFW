<?php

 #
 # MiniFW 3
 #
 # sql függvények
 #
 #



mysqli_report(MYSQLI_REPORT_OFF);

class fw_sql{
  public $SQL_SERVER="";
  public $SQL_DB="";
  public $SQL_USER="";
  public $SQL_PASS="";
  public $SQL_ERROR="";
  public $SQL_RESULT=array();
  public $SQL_DEV_MODE=false;


  function __construct(){
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
      echo("!!! $sqlcomm<br />");
      echo("$this->SQL_ERROR<br />>");
    }
    return($ret);
  }

  # teszt
  function sql_test(){
    echo("SQL:<br /><br />");
    echo($this->SQL_SERVER."<br />");
    echo($this->SQL_DB."<br />");
    echo($this->SQL_USER."<br />");
    echo($this->SQL_PASS."<br />");
    echo("<br /><br />");
    if ($this->sql_run("SHOW TABLES;")){
      foreach ($this->SQL_RESULT as $c){
        echo($c[0]."<br />");
      }
    }
    echo("<br /><br />");
  }


}


?>
