<?php

 #
 # MiniFW - Admin app
 #
 # info: main folder copyright file
 #
 #



function a_savetofile(){
    global $A_BACKUP_TITLE,$A_GOBUTTON,$A_BACKBUTTON,
            $A_DBBACKUP,$A_FILEBACKUP,$A_BACKUP_TABLES,
            $A_BACKUP_DIR,$A_SITE_ROOT,$MA_CONTENT_DIR,
            $MA_MINIFW_DIR,$MA_SQL_RESULT,$MA_SQL_FILE;

    echo("<div class=frow>");
    echo("<div class=colx1></div>");
    echo("<div class=colx2>");
    echo("<div class=spaceline></div>");

    echo("<h3>$A_BACKUP_TITLE</h3>");
    echo("<div class=spaceline></div>");
    echo("<div class=spaceline></div>");

    $d=date('YmdHis');
    $sqlf=getcwd()."/$A_BACKUP_DIR/$d.sql";
    $tf="$A_BACKUP_DIR/$d.tar";

    echo("$A_DBBACKUP");
    if (file_exists($MA_SQL_FILE)){
	    $f=file_get_contents($MA_SQL_FILE, true);
		$d=explode(PHP_EOL,$f);
		$dbl=count($d);
		echo("<br />");
		$l=array();
		$ldb=0;
		for($k=0;$k<$dbl;$k++){
			if (substr($d[$k],0,12)==="create table"){
				$tn=substr($d[$k],0,strpos($d[$k],"(")-1);
				$tnn=explode(" ",$tn);
				$tnp=count($tnn)-1;
				$tn=$tnn[$tnp];
				echo("<br />- $tn");
			    $sqlc="desc $tn;";
			    $sqlline="insert into $tn (";
			    if (sql_run($sqlc)){
					for($ix=0;$ix<count($MA_SQL_RESULT);$ix++){
						$r=$MA_SQL_RESULT[$ix];
						if ($ix>0){
							$sqlline=$sqlline.",".$r[0];
						}else{
							$sqlline=$sqlline.$r[0];
						}
					}
			    }
			    $l[$ldb]="delete from $tn;".PHP_EOL;
			    $ldb++;
			    $sqlline=$sqlline.") values (";
			    $sqlc="select * from $tn;";
			    if (sql_run($sqlc)){
					$sqldb=count($MA_SQL_RESULT);
					for($i2=0;$i2<$sqldb;$i2++){
				  		$sqlline2=$sqlline;
						$rd=$MA_SQL_RESULT[$i2];
						$rdb=count($rd);
						for($i3=0;$i3<$rdb;$i3++){
							if ($i3<>0){
								$sqlline2=$sqlline2.",\"".$rd[$i3]."\"";
							}else{
								$sqlline2=$sqlline2."\"".$rd[$i3]."\"";
							}
						}
						$l[$ldb]=$sqlline2.");".PHP_EOL;
						$ldb++;
					}
			    }
			}
		}
		if ($fo=fopen($sqlf,'w+')) {
			for($i=0;$i<$ldb;$i++){
  	    		fwrite($fo,$l[$i]);
    	    }
      		fclose($fo);
		}
    }

    echo("<div class=spaceline></div>");
    echo("$A_FILEBACKUP");

    $pd=new PharData($tf);
	$pd->buildFromDirectory($A_SITE_ROOT,'/^(?!(.*.tar|.*.git))(.*)$/i');
    $pd->compress(\Phar::GZ);
    unlink($tf);
    unlink($sqlf);

    echo("<div class=spaceline></div>");
    echo("<div class=spaceline></div>");
    echo("<form method=post>");
    echo("<input type=submit id=x name=x value=\"$A_BACKBUTTON\">");
    echo("</form>");
    echo("<div class=spaceline></div>");

    echo("</div>");
    echo("<div class=colx1></div>");
    echo("</div>");
}



function a_restore(){
    global $A_BACKUP_DIR,$A_RESTORE_TITLE,$A_BACKBUTTON,$A_RESTORE_MESS,$A_SITE_ROOT;

    echo("<div class=frow>");
    echo("<div class=colx1></div>");
    echo("<div class=colx2>");
    echo("<div class=spaceline></div>");

    echo("<h3>$A_RESTORE_TITLE</h3>");
    echo("<div class=spaceline></div>");
    echo("<div class=spaceline></div>");

    if (isset($_POST['fn'])){
        $fl=$_POST['fn'];
        if (file_exists("$fl")){
            $n=substr($fl,strlen($A_BACKUP_DIR)+1,strlen($fl));
            $n=substr($n,0,strlen($n)-7);
            $n=substr($n,0,4).". ".substr($n,4,2).". ".substr($n,6,2).". ".substr($n,8,2).":".substr($n,10,2);
            echo("$A_RESTORE_MESS $n");
            #$ph=new PharData($fl);
            #$ph->extractTo($A_BACKUP_DIR, null, true);
            #$ph->extractTo($A_SITE_ROOT, null, true);
        }
        $fs=substr($fl,0,strlen($fl)-7).".sql";
		if ($fo=fopen($fs,'r')){
			while(!feof($fo)){
				$line=fgets($fo);
				$line = trim($line);
				if ($line<>""){
					sql_run($line);
				}
			}
      		fclose($fo);
		}
    }
    echo("<div class=spaceline></div>");
    echo("<div class=spaceline></div>");
    echo("<form method=post>");
    echo("<input type=submit id=x name=x value=\"$A_BACKBUTTON\">");
    echo("</form>");
    echo("<div class=spaceline></div>");

    echo("</div>");
    echo("<div class=colx1></div>");
    echo("</div>");
}


function a_delete(){
    global $MA_BACKUP_DIR,$A_BACKUP_DELETE_TITLE,$A_BACKBUTTON,$A_BACKUP_DELETE_MESS;

    echo("<div class=frow>");
    echo("<div class=colx1></div>");
    echo("<div class=colx2>");
    echo("<div class=spaceline></div>");

    echo("<h3>$A_BACKUP_DELETE_TITLE</h3>");
    echo("<div class=spaceline></div>");
    echo("<div class=spaceline></div>");

    if (isset($_POST['fn'])){
        $fn=$_POST['fn'];
        if (file_exists("$fn")){
            unlink($fn);
        }
    }
    echo("$A_BACKUP_DELETE_MESS");
    echo("<div class=spaceline></div>");
    echo("<div class=spaceline></div>");
    echo("<form method=post>");
    echo("<input type=submit id=x name=x value=\"$A_BACKBUTTON\">");
    echo("</form>");
    echo("<div class=spaceline></div>");

    echo("</div>");
    echo("<div class=colx1></div>");
    echo("</div>");
}



function a_backup(){
    global $A_BACKUP_TITLE,$A_RESTORE_TITLE,$A_GOBUTTON,
            $A_BACKUP_DELETE_TITLE,$A_BACKUP_DIR;

    if (isset($_POST['lcode'])){
        switch ($_POST['lcode']){
            case "b":
                a_savetofile();
                break;
            case "r":
                a_restore();
                break;
            case "d":
                a_delete();
                break;
            default:
                break;
        }
    }else{
        echo("<div class=frow>");
        echo("<div class=colx1></div>");
        echo("<div class=colx2>");
        echo("<div class=spaceline></div>");

        echo("<h3>$A_BACKUP_TITLE</h3>");
        echo("<form id=0 name=0 method=post>");
        echo("<input type=hidden id=lcode name=lcode value=\"b\">");
        echo("<input type=submit id=x name=x value=\"$A_GOBUTTON\">");
        echo("</form>");
        echo("<div class=spaceline></div>");

        echo("<h3>$A_RESTORE_TITLE</h3>");
        echo("<form id=1 name=1 method=post>");
        echo("<select id=fn name=fn>");
        $fl=glob("$A_BACKUP_DIR/*.tar.gz");
        for($i=0;$i<count($fl);$i++){
            $n=substr($fl[$i],strlen($A_BACKUP_DIR)+1,strlen($fl[$i]));
            $n=substr($n,0,strlen($n)-7);
            $n=substr($n,0,4).". ".substr($n,4,2).". ".substr($n,6,2).". ".substr($n,8,2).":".substr($n,10,2);
            echo("<option value=\"$fl[$i]\">$n</option>");
        }
        echo("</select>");
        echo("<input type=hidden id=lcode name=lcode value=\"r\">");
        echo("<input type=submit id=x name=x value=\"$A_GOBUTTON\">");
        echo("</form>");
        echo("<div class=spaceline></div>");

        echo("<h3>$A_BACKUP_DELETE_TITLE</h3>");
        echo("<form id=2 name=2 method=post>");
        echo("<select id=fn name=fn>");
        $fl=glob("$A_BACKUP_DIR/*.tar.gz");
        for($i=0;$i<count($fl);$i++){
            $n=substr($fl[$i],strlen($A_BACKUP_DIR)+1,strlen($fl[$i]));
            echo("<option value=\"$fl[$i]\">$n</option>");
        }
        echo("</select>");
        echo("<input type=hidden id=lcode name=lcode value=\"d\">");
        echo("<input type=submit id=x name=x value=\"$A_GOBUTTON\">");
        echo("</form>");
        echo("<div class=spaceline></div>");

        echo("</div>");
        echo("<div class=colx1></div>");
        echo("</div>");
    }
}



?>
