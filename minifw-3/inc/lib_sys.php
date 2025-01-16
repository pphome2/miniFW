<?php

 #
 # MiniFW 3
 #
 # alap függvények
 #
 #



# szöveg fordítása
function fw_lang($s){
  global $fwlang;

  if (isset($fwlang)){
    $s=$fwlang->lang($s);
  }else{
    $s="_".$s."_";
  }
  return($s);
}



?>
