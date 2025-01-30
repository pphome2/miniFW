<?php

 #
 # MiniFW 3
 #
 # indítás
 #




# beállítások betöltése
$SYS_OK=false;
if (file_exists("config/config.php")){
  include("config/config.php");
  $SYS_OK=true;
  $fwcfg=new fw_config();
  $fwcfg->FW_FS_MAIN_DIR=__DIR__;
}

if (isset($_GET[$fwcfg->FW_ADMIN_LINK])){
  $fwcfg->FW_ADMIN_MODE=true;
}


# rendszer felépítése
if ($SYS_OK){
  # függvénykönyvtárak betöltése
  foreach($fwcfg->{'FW_LIB'} as $f){
    $fn=$fwcfg->{'FW_INCLUDE_DIR'}."/".$f;
	if (file_exists($fn)){
	  $SYS_OK=$SYS_OK and include($fn);
	}else{
	  $SYS_OK=false;
	}
  }
}



# sql alrendszer beállítása
if ($SYS_OK){
  $fwlang=new fw_lang();
  $fwsql=new fw_sql($fwcfg->{'FW_SQL_SERVER'},
                    $fwcfg->{'FW_SQL_DB'},
                    $fwcfg->{'FW_SQL_USER'},
                    $fwcfg->{'FW_SQL_PASS'},
                    $fwcfg->{'FW_DEV_MODE'});
  $r=$fwsql->sql_test();
  if ($r===""){
    $SYS_OK=false;
  }else{
    $fwsqlm=new fw_sqlm();
  }
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
    $fwapp=new fw_app($fwcfg->{'FW_CONTENT_DIR'});
    $fwcfg->{'FW_TEMPLATE_PHP'}=$fwapp->{'APP_TEMPLATE'}."/".$fwcfg->{'FW_TEMPLATE_PHP'};
    foreach($fwapp->{'APP_FILES'} as $f){
      $fn=$fwcfg->{'FW_CONTENT_DIR'}."/".$f;
  	  if (file_exists($fn)){
	    $SYS_OK=$SYS_OK and include($fn);
	  }else{
  	    $SYS_OK=false;
	  }
    }
  }
  # template betöltése
  $TEMP_OK=false;
  $fn=$fwcfg->{'FW_TEMPLATE_DIR'}."/".$fwcfg->{'FW_TEMPLATE_PHP'};
  if (file_exists($fn)){
    $TEMP_OK=include($fn);
    if ($TEMP_OK){
      if (isset($fwapp->{'APP_TEMPLATE'})){
        $fwtemp=new $fwapp->{'APP_TEMPLATE'}();
      }
    }
  }



  # app indítása, előkészítésa, beállítása
  if ($APP_OK){
    $fi=starturl(__DIR__).$fwcfg->{'FW_MEDIA_DIR'}."/".$fwapp->{'APP_FAVICON'};
    $fd=$fwcfg->{'FW_TEMPLATE_DIR'}."/".$fwapp->{'APP_TEMPLATE'};
    if ($TEMP_OK){
      $fwtemp->title($fwapp->{'APP_TITLE'},$fi,$fd);
    }
  }



  # app futtatása
  if ($APP_OK){
    $fwapp->cookie_load();
    $fwapp->main();
  }

  # fejrész
  if ($TEMP_OK){
    $fwtemp->pagehead();
    $fwtemp->header();
  }

  # app futtatása
  if ($APP_OK){
    $fwapp->center();
  }

  # lábrész
  if ($TEMP_OK){
    $fwtemp->footer();
  }

  # hiányzó nyelvi lemek kiírása
  if ($fwcfg->FW_DEV_MODE){
    #$fwlang->lang_new();
  }

  # lábrész
  if ($TEMP_OK){
    $fwtemp->pageend();
  }

}



?>
