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
  foreach($fwcfg->FW_LIB as $f){
    $fn=$fwcfg->FW_INCLUDE_DIR."/".$f;
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
  $SYS_OK=$SYS_OK and method_exists($fwlang,'lang');
  $SYS_OK=$SYS_OK and method_exists($fwlang,'lang_new');
  $fwsql=new fw_sql($fwcfg->FW_SQL_SERVER,
                    $fwcfg->FW_SQL_DB,
                    $fwcfg->FW_SQL_USER,
                    $fwcfg->FW_SQL_PASS,
                    $fwcfg->FW_DEV_MODE);
  $SYS_OK=$SYS_OK and method_exists($fwsql,'sql_test');
  $SYS_OK=$SYS_OK and method_exists($fwsql,'sql_run');
  if ($SYS_OK){
    $r=$fwsql->sql_test();
    if ($r===""){
      $SYS_OK=false;
    }else{
      $fwsqlm=new fw_sqlm();
      $SYS_OK=$SYS_OK and method_exists($fwsqlm,'version_check');
    }
  }
}



# rendszer indítás
if ($SYS_OK){
  # DEV_MODE beállítása
  $dm=$fwsqlm->get_param($fwsql->SQL_DEV_MODE_STR);
  if ($dm<>"1"){
    $fwsql->SQL_DEV_MODE=false;
    $fwcfg->FW_DEV_MODE=false;
  }else{
    $fwsql->SQL_DEV_MODE=true;
    $fwcfg->FW_DEV_MOD=true;
  }
  # app betöltése
  $APP_OK=false;
  $fn=$fwcfg->FW_CONTENT_DIR."/".$fwcfg->FW_APP_PHP;
  if (file_exists($fn)){
    $APP_OK=include($fn);
  }
  # app indítása, előkészítésa, beállítása
  if ($APP_OK){
    $fwapp=new fw_app($fwcfg->FW_CONTENT_DIR);
    $APP_OK=$APP_OK and method_exists($fwapp,'appstart');
    $APP_OK=$APP_OK and method_exists($fwapp,'main');
    $fwcfg->FW_TEMPLATE_PHP=$fwapp->APP_TEMPLATE."/".$fwcfg->FW_TEMPLATE_PHP;
    foreach($fwapp->APP_FILES as $f){
      $fn=$fwcfg->FW_CONTENT_DIR."/".$f;
  	  if (file_exists($fn)){
	    $SYS_OK=$SYS_OK and include($fn);
	  }else{
  	    $SYS_OK=false;
	  }
    }
  }
  # template betöltése
  $TEMP_OK=false;
  $fn=$fwcfg->FW_TEMPLATE_DIR."/".$fwcfg->FW_TEMPLATE_PHP;
  if (file_exists($fn)){
    $TEMP_OK=include($fn);
    if ($TEMP_OK){
      if (isset($fwapp->APP_TEMPLATE)){
        $fwtemp=new $fwapp->APP_TEMPLATE();
        $TEMP_OK=$TEMP_OK and method_exists($fwtemp,'postdata');
        $TEMP_OK=$TEMP_OK and method_exists($fwtemp,'page_start');
        $TEMP_OK=$TEMP_OK and method_exists($fwtemp,'header');
        $TEMP_OK=$TEMP_OK and method_exists($fwtemp,'footer');
        $TEMP_OK=$TEMP_OK and method_exists($fwtemp,'page_end');
      }
    }
  }
}
$SYS_OK=$SYS_OK and $APP_OK and $TEMP_OK;


# a rendszer elindítása
if ($SYS_OK){
  # app alapján a template előkészítése
  $fi=starturl(__DIR__).$fwcfg->FW_MEDIA_DIR."/".$fwapp->APP_FAVICON;
  $fwcfg->FW_URI_MAIN_DIR=starturl(__DIR__);
  $fd=$fwcfg->FW_TEMPLATE_DIR."/".$fwapp->APP_TEMPLATE;
  $fwtemp->title($fwapp->APP_TITLE,$fi,$fd);

  # lap összeállítása és az app indítása
  # verziók mentése
  $fwsqlm->version_check();
  # POST adatok kezelése
  $fwtemp->postdata();
  # app futtatása
  $fwapp->appstart();
  # fejrész
  $fwtemp->page_start();
  $fwtemp->header();
  # app futtatása
  $fwapp->main();
  # lábrész
  $fwtemp->footer();
  # lábrész
  $fwtemp->page_end();

  # hiányzó nyelvi lemek kiírása
  if ($fwcfg->FW_DEV_MODE){
    $fwsqlm->versions();
    $fwlang->lang_new();
  }
}



?>
