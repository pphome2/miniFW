<?php

 #
 # 1
 #
 # teszt plugin
 #



class op1 implements fw_plugin{
  function ___construct(){}
  function ___destruct(){}


  public function load(){}


  public function run(){
    echo("Plugin: 1");
    $fn=__DIR__."/p1.css";
    if (file_exists($fn)){
      include($fn);
    }
    $fn=__DIR__."/p1.js";
    if (file_exists($fn)){
      include($fn);
    }
    #echo($fn);
  }  
}

#

#$p1=new op1();
#$p1->load();
#$p1->run();

?>
