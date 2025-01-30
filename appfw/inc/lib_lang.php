<?php

 #
 # MiniFW 3
 #
 # nyelvi fájl
 #



class fw_lang{
  public $LANG_NEW=array();
  public $LANG=array();



  function __construct(){
    global $fwcfg;

    $fn=$fwcfg->FW_CONFIG_DIR."/".$fwcfg->FW_LANGFILE;
    if (file_exists($fn)){
      if (include($fn)){
        $this->LANG=$FW_LANG;
      }
    }
  }



  # nyelvi adat lekérdezése
  function lang($s){
    if (isset($this->LANG[$s])){
      $ret=$this->LANG[$s];
    }else{
      $ret=".".$s.".";
      $this->LANG_NEW[]="\"".$s."\"=>\"".$s."\",";
    }
    return($ret);
  }



  # nyelvi adat lekérdezése
  function lang_new(){
    foreach($this->LANG_NEW as $l){
      echo($l."<br />");
    }
  }


}


?>
