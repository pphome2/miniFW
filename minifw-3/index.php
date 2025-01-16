<?php

 #
 # MiniFW 3
 #
 # indítás
 #

$SYS_OK=false;

# beállítások betöltése
if (file_exists("config/config.php")){
  include("config/config.php");
  $SYS_OK=true;
  $fwcfg=new fw_config();
}

# rendszer felépítése
if ($SYS_OK){
  # nyelvi modul betöltése
  $fn=$fwcfg->{'FW_CONFIG_DIR'}."/".$fwcfg->{'FW_LANGFILE'};
  if (file_exists($fn)){
    include($fn);
  }
  $fwlang=new fw_lang();

  # függvénykönyvtárak betöltése
  for ($i=0;$i<count($fwcfg->{'FW_LIB'});$i++){
    $fn=$fwcfg->{'FW_INCLUDE_DIR'}."/".$fwcfg->{'FW_LIB'}[$i];
	if (file_exists($fn)){
	  include($fn);
	}else{
	  $SYS_OK=false;
	}
  }
}

# sql alrendszer beállítása
if ($SYS_OK){
  $sql=new fw_sql();
  $sql->{'SQL_SERVER'}=$fwcfg->{'FW_SQL_SERVER'};
  $sql->{'SQL_DB'}=$fwcfg->{'FW_SQL_DB'};
  $sql->{'SQL_USER'}=$fwcfg->{'FW_SQL_USER'};
  $sql->{'SQL_PASS'}=$fwcfg->{'FW_SQL_PASS'};
  $sql->{'SQL_DEV_MODE'}=$fwcfg->{'FW_DEV_MODE'};
  #$sql->sql_test();
  #if ($sql->sql_run("SHOW TABLES;")){
  #  foreach ($sql->SQL_RESULT as $c){
  #    echo($c[0]."<br />");
  #  }
  #  echo("<br />");
  #}
}


# rendszer indítás
if ($SYS_OK){
  # app betöltése
  $APP_OK=false;
  $fn=$fwcfg->{'FW_CONTENT_DIR'}."/".$fwcfg->{'FW_APP_PHP'};
  if (file_exists($fn)){
    $APP_OK=include($fn);
  }
  # app indítása, előkészítésa, beállítása
  if ($APP_OK){
    $fwapp=new fw_app();
    $fwcfg->{'FW_TEMPLATE_PHP'}=$fwapp->{'APP_TEMPLATE'}."/".$fwcfg->{'FW_TEMPLATE_PHP'};
  }
  # template betöltése
  $TEMP_OK=false;
  $fn=$fwcfg->{'FW_TEMPLATE_DIR'}."/".$fwcfg->{'FW_TEMPLATE_PHP'};
  if (file_exists($fn)){
    $TEMP_OK=include($fn);
    if ($TEMP_OK){
      $fwtemp=new fw_temp();
    }
  }


  # app indítása, előkészítésa, beállítása
  if ($APP_OK){
    $fi=$fwcfg->{'FW_CONTENT_DIR'}."/".$fwapp->{'APP_FAVICON'};
    $fd=$fwcfg->{'FW_TEMPLATE_DIR'}."/".$fwapp->{'APP_TEMPLATE'};
    #$fi=$fwapp->{'APP_FAVICON'};
    if ($TEMP_OK){
      $fwtemp->title($fwapp->{'APP_TITLE'},$fi,$fd);
    }
  }

  # app futtatása

  # fejrész
  if ($TEMP_OK){
    $fwtemp->header();
  }

  # app futtatása
  if ($APP_OK){
    $fwapp->main();
  }

  # lábrész
  if ($TEMP_OK){
    $fwtemp->footer();
  }
}



?>
