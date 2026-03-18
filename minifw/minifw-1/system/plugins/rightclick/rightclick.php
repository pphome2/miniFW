<?php

$RIGHTCLICK=true;
$RIGHTCLICKNUM=0;

#function rightclick(){
	global $SYS_PLUGINS_DIR,$RIGHTCLICKNUM;
	
	if ($RIGHTCLICKNUM<1){
		if (file_exists($SYS_PLUGINS_DIR."rightclick/rightclick.css")){
			include($SYS_PLUGINS_DIR."rightclick/rightclick.css");
		}
		if (file_exists($SYS_PLUGINS_DIR."rightclick/rightclick.js")){
			include($SYS_PLUGINS_DIR."rightclick/rightclick.js");
		}
		$RIGHTCLICKNUM++;
	}
#}

?>

