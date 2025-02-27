<?php

 #
 # MiniFW 3
 #
 # plugin támogatás
 #


# plugin kapcsolat
interface fw_plugin{
  # a plugin előkészítése használatra
  public function load();
  # plugin futtatása
  public function run();
}



?>
