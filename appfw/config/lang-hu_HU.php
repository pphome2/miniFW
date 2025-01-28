<?php

 #
 # MiniFW 3
 #
 # nyelvi fájl
 #


class fw_lang{
  public $FW_LANG_NEW=array();

  public $FW_LANG=array(
                    "első"=>"első sor",
                    ""=>""
                  );

  function __construct(){
  }



  # nyelvi adat lekérdezése
  function lang($s){
    if (isset($this->FW_LANG[$s])){
      $ret=$this->FW_LANG[$s];
    }else{
      $ret=".".$s.".";
      $this->FW_LANG_NEW[]="\"".$s."\"=>\"".$s."\",";
    }
    return($ret);
  }



  # nyelvi adat lekérdezése
  function lang_new(){
    foreach($this->FW_LANG_NEW as $l){
      echo($l."<br />");
    }
  }


}


?>
