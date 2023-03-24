<?php

 #
 # MiniFW - Admin app
 #
 # info: main folder copyright file
 #
 #



function a_userdel(){
	global $A_TITLE_DEL,$A_OK,$A_ERROR;

		if (isset($_POST['idd'])){
			$id=$_POST['idd'];
			$sqlc="delete from mfw_users where id=$id;";
			if (sql_run($sqlc)){
				mess_ok($A_TITLE_DEL.": ".$A_OK.".");
			}else{
				mess_error($A_TITLE_DEL.": ".$A_ERROR.".");
			}
		}
}



function a_userdata($new,$data=false){
	global $MA_SQL_RESULT,$A_USER_FIELDS,$MA_ADMINFILE,
			$A_SAVE,$A_TITLE_NEW,$A_TITLE_CHANGE,
			$A_OK,$A_ERROR,$A_DELUSER,$A_USER_ROLE,
			$MA_USER_ROLE,$L_USER_ROLE_NAME,$MA_HASH_FIRST;

	$db=count($A_USER_FIELDS);
	if ($new){
		$title=$A_TITLE_NEW;
		if (isset($_POST['0'])){
			$da=$_POST[0];
			for($i=1;$i<$db;$i++){
		        $p=$_POST[$i];
			    if ($i===2){
			        $p=password_hash("$p",PASSWORD_DEFAULT);
				}
				$da=$da.", '".$p."'";
			}
			$sqlc="insert into mfw_users (id,name,pass,role,email,comm) values ($da);";
			if (sql_run($sqlc)){
				mess_ok($A_TITLE_NEW.": ".$A_OK.".");
			}else{
				mess_error($A_TITLE_NEW.": ".$A_ERROR.".");
			}
		}
		$d[0]=genid();
		for($i=1;$i<$db;$i++){
			$d[$i]="";
		}
	}else{
		$title=$A_TITLE_CHANGE;
		if (isset($_POST['id'])){
			if (isset($_POST['id2'])){
				$id2=$_POST['id2'];
				if (substr($_POST[2],0,strlen($MA_HASH_FIRST))<>$MA_HASH_FIRST){
				    $p=password_hash("$_POST[2]", PASSWORD_DEFAULT);
				}else{
				    $p=$_POST[2];
				}
				$sqlc="update mfw_users set";
				$sqlc=$sqlc." id = ".$_POST[0].", ";
				$sqlc=$sqlc." name = \"$_POST[1]\", ";
				$sqlc=$sqlc." pass = \"$p\", ";
				$sqlc=$sqlc." role = \"$_POST[3]\", ";
				$sqlc=$sqlc." email = \"$_POST[4]\", ";
				$sqlc=$sqlc." comm = \"$_POST[5]\" ";
				$sqlc=$sqlc." where id=$id2;";
				if (sql_run($sqlc)){
					mess_ok($A_TITLE_CHANGE.": ".$A_OK.".");
				}else{
					mess_error($A_TITLE_CHANGE.": ".$A_ERROR.".");
				}
			}else{
			    $data=true;
			}
			$id=$_POST['id'];
			$sqlc="select * from mfw_users where id=$id;";
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
    		echo("<div class=fcol1>$A_USER_FIELDS[$i]");
	    	echo("</div>");
    		echo("<div class=fcol2>");
    		if ($i===3){
    			echo("<select name=$i id=$i>");
    			$dbr=count($MA_USER_ROLE);
    			for($j=0;$j<$dbr;$j++){
    			    $sel="";
    			    if ("$d[$i]"==="$MA_USER_ROLE[$j]"){
    			        $sel="selected";
    			    }
    				echo("<option value=\"$MA_USER_ROLE[$j]\" $sel>$L_USER_ROLE_NAME[$j]</option>");
    			}
    			echo("</select>");
    		}else{
	    		echo("<input type=text id=$i name=$i placeholder='$A_USER_FIELDS[$i]' value='$d[$i]'>");
	    	}
    		echo("</div>");
	    	echo("</div>");
    	}
	    echo("<div class=frow><br /></div>");
    	if ($new){
	    	echo("<input type=hidden id=id name=id value=\"$d[0]\">");
		    echo("<input type=submit id=newu name=newu value=\"$A_SAVE\">");
    		echo("</form>");
	    }else{
		    echo("<input type=hidden id=id name=id value=\"$d[0]\">");
    		echo("<input type=hidden id=id2 name=id2 value=\"$d[0]\">");
	    	echo("<input type=submit id=chu name=chu value=\"$A_SAVE\">");
		    echo("</form>");
    		echo("<div class=frow><br /></div>");
	    	echo("<form method=post>");
		    echo("<input type=hidden id=idd name=idd value=\"$d[0]\">");
    		echo("<input  type=submit id=delu name=delu value=\"$A_DELUSER\">");
	    	echo("</form>");
	    }
	}
	return(!$data);
}



function a_usertable(){
	global $MA_SQL_RESULT,$A_NEWUSER,$A_TABLE_TITLE,$L_USER_ROLE_NAME,
			$A_WORKUSER,$A_SEARCH,$A_PAGEROW,$A_PAGE_LEFT,$A_PAGE_RIGHT;

	if (isset($_POST['page'])){
		$page=(int)$_POST['page'];
		$first=$A_PAGEROW*$page;
	}else{
		$page=0;
		$first=0;
	}
	$last=false;
	if (sql_run("select count(*) from mfw_users;")){
		$r=$MA_SQL_RESULT[0];
		$odb=$r[0];
		$adb=$first+$A_PAGEROW;
		if ($adb>=$odb){
			$last=true;
		}
	}
	echo("<form method=post>");
	echo("<input type=submit id=newu name=newu value=\"$A_NEWUSER\">");
	echo("</form>");
	echo("<input type=text id=search onkeyup='searchtable()' placeholder=\"$A_SEARCH\">");
	sql_run("select * from mfw_users order by id limit $first,$A_PAGEROW;");
	echo("<center>");
	echo("<table class='df_table_full' id=ptable>");
	echo("<tr class='df_trh'>");
	echo("<th class='df_th0'>$A_TABLE_TITLE[0]</th>");
	echo("<th class='df_th1'>$A_TABLE_TITLE[1]</th>");
	echo("<th class='df_th2'>$A_TABLE_TITLE[2]</th>");
	echo("<th class='df_th2'>$A_TABLE_TITLE[3]</th>");
	echo("<th class='df_th2'>$A_TABLE_TITLE[4]</th>");
	echo("</tr>");
	$db=count($MA_SQL_RESULT);
	for($i=0;$i<$db;$i++){
		$r=$MA_SQL_RESULT[$i];
		echo("<tr class=df_tr>");
		echo("<td class='df_td'>$r[1]</td>");
		$c=(int)$r[3];
		$r[3]=$L_USER_ROLE_NAME[$c];
		echo("<td class='df_td'>$r[3]</td>");
		echo("<td class='df_td'>$r[4]</td>");
		echo("<td class='df_td'>$r[5]</td>");
		echo("<td class='df_td'>");
		echo("<center>");
		echo("<form method=post>");
		echo("<input type=hidden id=id name=id value=\"$r[0]\">");
		echo("<input class='tbutton' style=\"width:20%;padding:0px 50px 0px 30px;margin:0px;\" type=submit id=chu name=chu value=\"$A_WORKUSER\">");
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



function a_user(){
	$ptable=true;
	if (isset($_POST['newu'])){
		$ptable=false;
		a_userdata(true,true);
	}
	if (isset($_POST['delu'])){
		a_userdel();
	}
	if (isset($_POST['chu'])){
		#$ptable=false;
		$ptable=a_userdata(false,false);
	}
	if ($ptable){
		a_usertable();
	}
}


?>
