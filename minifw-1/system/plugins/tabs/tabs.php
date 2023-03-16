<?php

$TABS=true;
$TABSLOADCSS=false;
$TABSNUM=0;


function tabs($tabsdata=array()){
	global $SYS_PLUGINS_DIR,$TABSLOADCSS,$TABSNUM;

	if (!$TABSLOADCSS){
		if (file_exists($SYS_PLUGINS_DIR."tabs/tabs.css")){
			include($SYS_PLUGINS_DIR."tabs/tabs.css");
		}
		$TABSLOADCSS=true;
	}
	
	
	echo("<div class=\"tab-center\">");
	echo("<div class=\"tab-tab\">");
	$db=count($tabsdata);
	$firstid="tabdefaultopen$TABSNUM";
	for($i=0;$i<$db;$i++){
		$k=0;
		foreach($tabsdata[$i] as $key => $val){
			if ($k==0){
				echo("<button class=\"tab-links tab-tablinks$TABSNUM\" onclick=\"opentab$TABSNUM(this, '$val');\" id=\"$firstid\">$val</button>");
				$firstid=$k;
				$k++;
			}
		}
	}	
	echo("</div>");
	
	
	for($i=0;$i<$db;$i++){
		$k=0;
		foreach($tabsdata[$i] as $key => $val){
			if ($k==0){
				echo("<div id=\"$val\" class=\"tab-tabcontent tab-tabcontent$TABSNUM\">");
				echo("<h3>$val</h3>");
			}else{
				echo("$val");
			}
			$k++;
		}
		echo("</div>");
	}	
	echo("</div>");
	
	#  <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>

	if (file_exists($SYS_PLUGINS_DIR."tabs/tabs.js")){
		include($SYS_PLUGINS_DIR."tabs/tabs.js");
	}

	$TABSNUM++;

}

?>
