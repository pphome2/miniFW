<?php

 #
 # MiniFW 3
 #
 # nyelvi fájl
 #

class fw_lang{
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
    }
    return($ret);
  }
}


?>
