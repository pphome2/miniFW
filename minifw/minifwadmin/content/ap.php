<?php

 #
 # MiniFW - Admin app
 #
 # info: main folder copyright file
 #
 #



function a_paramdel(){
	global $A_TITLE_PDEL,$A_OK,$A_ERROR;

		if (isset($_POST['idd'])){
			$id=$_POST['idd'];
			$sqlc="delete from mfw_params where id=$id;";
			if (sql_run($sqlc)){
				mess_ok($A_TITLE_PDEL.": ".$A_OK.".");
			}else{
				mess_error($A_TITLE_PDEL.": ".$A_ERROR.".");
			}
		}
}



function a_paramdata($new,$data=false){
	global $MA_SQL_RESULT,$A_PARAM_FIELDS,$MA_ADMINFILE,
			$A_SAVE,$A_TITLE_PNEW,$A_TITLE_PCHANGE,
			$A_OK,$A_ERROR,$A_DELPARAM;

	$db=count($A_PARAM_FIELDS);
	if ($new){
		$title=$A_TITLE_PNEW;
		if (isset($_POST['0'])){
			$da=$_POST[0];
			for($i=1;$i<$db;$i++){
				$da=$da.", '".$_POST[$i]."'";
			}
			$sqlc="insert into mfw_params (id,name,data) values ($da);";
			if (sql_run($sqlc)){
				mess_ok($A_TITLE_PNEW.": ".$A_OK.".");
			}else{
				mess_error($A_TITLE_PNEW.": ".$A_ERROR.".");
			}
		}
		$d[0]=genid();
		for($i=1;$i<$db;$i++){
			$d[$i]="";
		}
	}else{
		$title=$A_TITLE_PCHANGE;
		if (isset($_POST['id'])){
			if (isset($_POST['id2'])){
				$id2=$_POST['id2'];
				$sqlc="update mfw_params set";
				$sqlc=$sqlc." id = ".$_POST[0].", ";
				$sqlc=$sqlc." name = \"$_POST[1]\", ";
				$sqlc=$sqlc." data = \"$_POST[2]\" ";
				$sqlc=$sqlc." where id=$id2;";
				if (sql_run($sqlc)){
					mess_ok($A_TITLE_PCHANGE.": ".$A_OK.".");
				}else{
					mess_error($A_TITLE_PCHANGE.": ".$A_ERROR.".");
				}
			}else{
			    $data=true;
			}
			$id=$_POST['id'];
			$sqlc="select * from mfw_params where id=$id;";
			if (sql_run($sqlc)){
				$r=$MA_SQL_RESULT[0];
				for($i=0;$i<$db;$i++){
					$d[$i]=$r[$i];
				}
			}else{
				$d[0]=genid();
				for($i=1;$i<$db;$i++){
					$d[$i]="";
				}
			}
		}
	}
	if ($data){
	    echo("<div class=spaceline></div>");
    	echo("<h3>$title</h3>");
	    echo("<div class=spaceline></div>");
    	echo("<form method=post>");
	    echo("<input type=hidden id=0 name=0 value='$d[0]'>");
    	for($i=1;$i<$db;$i++){
		    echo("<div class=frow>");
	    	echo("<div class=fcol1>$A_PARAM_FIELDS[$i]");
    		echo("</div>");
		    echo("<div class=fcol2>");
	    	echo("<input type=text id=$i name=$i placeholder='$A_PARAM_FIELDS[$i]' value='$d[$i]'>");
    		echo("</div>");
		    echo("</div>");
	    }
    	echo("<div class=frow><br /></div>");
	    if ($new){
    		echo("<input type=hidden id=id name=id value=\"$d[0]\">");
		    echo("<input type=submit id=newp name=newp value=\"$A_SAVE\">");
	    	echo("</form>");
    	}else{
	    	echo("<input type=hidden id=id name=id value=\"$d[0]\">");
    		echo("<input type=hidden id=id2 name=id2 value=\"$d[0]\">");
	    	echo("<input type=submit id=chp name=chp value=\"$A_SAVE\">");
    		echo("</form>");
		    echo("<div class=frow><br /></div>");
	    	echo("<form method=post>");
    		echo("<input type=hidden id=idd name=idd value=\"$d[0]\">");
		    echo("<input  type=submit id=delp name=delp value=\"$A_DELPARAM\">");
	    	echo("</form>");
    	}
	}
	return(!$data);
}


function a_paramtable(){
	global $MA_SQL_RESULT,$A_NEWPARAM,$A_PTABLE_TITLE,
			$A_WORKPARAM,$A_SEARCH,$A_PAGEROW,$A_PAGE_LEFT,$A_PAGE_RIGHT;

	if (isset($_POST['page'])){
		$page=(int)$_POST['page'];
		$first=$A_PAGEROW*$page;
	}else{
		$page=0;
		$first=0;
	}
	$last=false;
	if (sql_run("select count(*) from mfw_params;")){
		$r=$MA_SQL_RESULT[0];
		$odb=$r[0];
		$adb=$first+$A_PAGEROW;
		if ($adb>=$odb){
			$last=true;
		}
	}
	echo("<form method=post>");
	echo("<input type=submit id=newp name=newp value=\"$A_NEWPARAM\">");
	echo("</form>");
	echo("<input type=text id=search onkeyup='searchtable()' placeholder=\"$A_SEARCH\">");
	sql_run("select * from mfw_params order by id limit $first,$A_PAGEROW;");
	echo("<center>");
	echo("<table class='df_table_full' id=ptable>");
	echo("<tr class='df_trh'>");
	echo("<th class='df_th0'>$A_PTABLE_TITLE[0]</th>");
	echo("<th class='df_th0'>$A_PTABLE_TITLE[1]</th>");
	echo("<th class='df_th0'>$A_PTABLE_TITLE[2]</th>");
	echo("</tr>");
	$db=count($MA_SQL_RESULT);
	for($i=0;$i<$db;$i++){
		$r=$MA_SQL_RESULT[$i];
		echo("<tr class=df_tr>");
		echo("<td class='df_td'>$r[1]</td>");
		echo("<td class='df_td'>$r[2]</td>");
		echo("<td class='df_td'>");
		echo("<center>");
		echo("<form method=post>");
		echo("<input type=hidden id=id name=id value=\"$r[0]\">");
		echo("<input class='tbutton' style=\"width:20%;padding:0px 50px 0px 30px;margin:0px;\" type=submit id=chp name=chp value=\"$A_WORKPARAM\">");
		echo("</form>");
		echo("</td>");
		echo("</tr>");
	}
	echo("</table>");
	echo("<div class=frow>");
	echo("<div class=pcol2>");
	if (($page>0)and($first>0)){
		echo("<form method=post>");
		$p=$page-1;
		echo("<input type=hidden id=page name=page value=$p>");
		echo("<input type=submit id=p name=p value=\"$A_PAGE_LEFT\">");
		echo("</form>");
	}else{
		echo("<span style=\"color:transparent;\">?</span>");
	}
	echo("</div>");
	echo("<div class=pcol1>");
	echo("<div style=\"width:90%;float:middle;\">");
	echo("<span style=\"color:transparent;\">?</span>");
	echo("</div>");
	echo("</div>");
	echo("<div class=pcol2>");
	if (($db==$A_PAGEROW)and(!$last)){
		$p=$page+1;
		echo("<form method=post>");
		echo("<input type=hidden id=page name=page value=$p>");
		echo("<input type=submit id=p name=p value=\"$A_PAGE_RIGHT\">");
		echo("</form>");
	}else{
		echo("<span style=\"color:transparent;\">?</span>");
	}
	echo("</div>");
	echo("</div>");
}




function a_param(){
	$ptable=true;
	if (isset($_POST['newp'])){
		$ptable=false;
		a_paramdata(true,true);
	}
	if (isset($_POST['delp'])){
		a_paramdel();
	}
	if (isset($_POST['chp'])){
		#$ptable=false;
		$ptable=a_paramdata(false,false);
	}
	if ($ptable){
		a_paramtable();
	}
}


?>
