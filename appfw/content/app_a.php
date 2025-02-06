<?php

 #
 # MiniFW 3
 #
 # app admin
 #



class fw_app_admin{

  public $ADMIN_PAGE=0;
  public $ADMIN_TABLE_ROW=10;



  function __construct(){
  }



  # vezérlő
  function main(){
    global $fwapp,$fwlang;

    if ($fwapp->APP_USER_ROLE<>"0"){
      echo($fwlang->lang("Nem megfelelő jogosultság."));
    }else{
      if (isset($_POST['page1'])){
        $p1=$_POST['page1'];
      }else{
        $p1=0;
      }
      if (isset($_POST['page2'])){
        $p2=$_POST['page2'];
      }else{
        $p2=0;
      }
      echo("<div class=\"amenuline\">");
      echo("<form class=adminmenuform method=post>");
      echo("<input type=hidden id=page1 name=page1 value=\"$p1\">");
      echo("<input type=hidden id=page2 name=page2 value=\"$p2\">");
      echo("<input type=hidden id=adminpage name=adminpage value=\"0\">");
      echo("<input type=submit class=menubutton d=menu name=menu value=\"".$fwlang->lang("Felhasználók")."\">");
      echo("</form>");
      echo("<form class=adminmenuform method=post>");
      echo("<input type=hidden id=page1 name=page1 value=\"$p1\">");
      echo("<input type=hidden id=page2 name=page2 value=\"$p2\">");
      echo("<input type=hidden id=adminpage name=adminpage value=\"1\">");
      echo("<input type=submit class=menubutton id=menu name=menu value=\"".$fwlang->lang("Paraméterek")."\">");
      echo("</form>");
      echo("<form class=adminmenuform method=post>");
      echo("<input type=hidden id=page1 name=page1 value=\"$p1\">");
      echo("<input type=hidden id=page2 name=page2 value=\"$p2\">");
      echo("<input type=hidden id=adminpage name=adminpage value=\"2\">");
      echo("<input class=\"pagerbutton\" type=submit id=menu name=menu value=\"".$fwlang->lang("Mentés")."\">");
      echo("</form>");
      echo("</div>");
      if (isset($_POST['adminpage'])){
        $this->ADMIN_PAGE=$_POST['adminpage'];
      }
      $form=true;
      $m=$this->ADMIN_PAGE;
      switch($m){
        case 0:
          if (isset($_POST['nextu'])or(isset($_POST['delu']))){
            $form=$this->admin_mod_user();
          }
          if (isset($_POST['newu'])){
            $form=$this->admin_new_user();
          }
          if ($form){
            $this->admin_table_user();
          }
          break;
        case 1:
          if (isset($_POST['nextp'])or(isset($_POST['delp']))){
            $form=$this->admin_mod_param();
          }
          if (isset($_POST['newp'])){
            $form=$this->admin_new_param();
          }
          if ($form){
            $this->admin_table_param();
          }
          break;
        case 2:
          $this->admin_backup();
          break;
        default:
          break;
      }
    }
  }



  # mentés
  function admin_backup(){
    global $fwlang,$fwsql,$fwsqlm,$fwapp,$fwcfg;

    echo("<div class=placeh></div>");
    echo("<h3>".$fwlang->lang("Mentés")."</h3>");
    echo("<div class=placeh></div>");
    if (!isset($_POST['backup'])){
      echo("<div class=formbox>");
      echo("<form method=post>");
      echo("<input type=hidden id=adminpage name=adminpage value=\"2\">");
      echo("<input type=submit id=backup name=backup value=\"".$fwlang->lang("Mentés indítása")."\">");
      echo("</div>");
    }else{
      echo("<div class=placeh></div>");
      echo("<div class=formbox>");
      $fwsqlm->SQL_TABLE_APP[]="afw_param";
      $fwapp->app_backup();
      $filesql=$fwcfg->FW_URI_MAIN_DIR."/".$fwcfg->FW_MEDIA_DIR."/".$fwcfg->FW_SQL_DB.".sql";
      $file=$fwcfg->FW_URI_MAIN_DIR."/".$fwcfg->FW_MEDIA_DIR."/".$fwapp->APP_NAME.".tar.gz";
      echo("<div class=placeh></div>");
      echo("<a href=\"$filesql\"><input type=submit id=backup name=backup value=\"".$fwlang->lang("SQL mentés letöltése")."\"></a>");
      echo("<a href=\"$file\"><input type=submit id=backup name=backup value=\"".$fwlang->lang("Fájlmentés letöltése")."\"></a>");
      echo("</div>");
    }
  }



  # új paraméter
  function admin_new_param(){
    $ret=false;
    $this->admin_form_param($_POST['page1'],$_POST['page2'],"","","");
    return($ret);
  }



  # új felhasználó
  function admin_new_user(){
    $ret=false;
    $this->admin_form_user($_POST['page1'],$_POST['page2'],"","","","","");
    return($ret);
  }



  # javítás/törlés
  function admin_mod_param(){
    global $fwlang,$fwsql,$fwsqlm;

    $ret=false;
    if (isset($_POST['id'])){
      $p1=$_POST['page1'];
      $p2=$_POST['page2'];
      if (isset($_POST['nextp'])){
        if (isset($_POST['pname'])){
          $fwsqlm->save_param_id($_POST['id'],$_POST['pname'],$_POST['ptext']);
          $ret=true;
        }else{
          $t=$fwsqlm->SQL_TABLE_SYS[0];
          $id=$_POST['id'];
          $sql="SELECT * FROM $t WHERE id=$id;";
          if ($fwsql->sql_run($sql)){
            $d=$fwsql->SQL_RESULT[0];
            $pn=$d[1];
            $pt=$d[2];
          }else{
            $id="";
            $pn="";
            $pt="";
          }
          $this->admin_form_param($p1,$p2,$id,$pn,$pt);
        }
      }else{
        if (isset($_POST['delp'])){
          $ret=true;
          if (isset($_POST['id'])){
            $t=$fwsqlm->SQL_TABLE_SYS[0];
            $id=$_POST['id'];
            $sql="DELETE FROM $t WHERE id=$id;";
            if ($fwsql->sql_run($sql)){
            }
          }
        }
      }
      echo("<div class=placeh></div>");
    }
    return($ret);
  }



  # paraméterek szerkesztése
  function admin_form_param($p1=0,$p2=0,$id="",$pn="",$pt=""){
    global $fwlang;

    echo("<div class=placeh></div>");
    echo("<h3>".$fwlang->lang("Paraméter")."</h3>");
    echo("<div class=placeh></div>");
    echo("<div class=formbox>");
    echo("<form method=post>");
    echo("<label for=\"0\">".$fwlang->lang("Név").":</label><br>");
    echo("<input type=\"text\" id=\"pname\" name=\"pname\" placeholder=\"\" value=\"$pn\"><br>");
    echo("<label for=\"0\">".$fwlang->lang("Érték").":</label><br>");
    echo("<input type=\"text\" id=\"ptext\" name=\"ptext\" placeholder=\"\" value=\"$pt\"><br>");
    echo("<input type=hidden id=page1 name=page1 value=\"$p1\">");
    echo("<input type=hidden id=page2 name=page2 value=\"$p2\">");
    echo("<input type=hidden id=adminpage name=adminpage value=\"$this->ADMIN_PAGE\">");
    echo("<input type=hidden id=id name=id value=\"$id\">");
    echo("<div class=placeh></div>");
    if ($id<>""){
      echo("<input type=submit id=nextp name=nextp value=\"".$fwlang->lang("Módosítás")."\">");
    }else{
      echo("<input type=submit id=nextp name=nextp value=\"".$fwlang->lang("Új")."\">");
    }
    echo("<div class=placeh></div>");
    echo("<input type=submit id=delp name=delp value=\"".$fwlang->lang("Törlés")."\">");
    echo("<div class=placeh></div>");
    echo("<input type=submit id=back name=back value=\"".$fwlang->lang("Vissza")."\">");
    echo("</form>");
    echo("</div>");
  }



  # javítás/törlés
  function admin_mod_user(){
    global $fwlang,$fwsql,$fwsqlm;

    $ret=false;
    if (isset($_POST['id'])){
      $p1=$_POST['page1'];
      $p2=$_POST['page2'];
      if (isset($_POST['nextu'])){
        if (isset($_POST['auname'])){
          $fwsqlm->save_user_id($_POST['id'],$_POST['auname'],$_POST['aupass'],$_POST['aurole'],$_POST['autext']);
          $ret=true;
        }else{
          $t=$fwsqlm->SQL_TABLE_SYS[1];
          $id=$_POST['id'];
          $sql="SELECT * FROM $t WHERE id=$id;";
          if ($fwsql->sql_run($sql)){
            $d=$fwsql->SQL_RESULT[0];
            $un=$d[1];
            $up=$d[2];
            $ur=$d[3];
            $ut=$d[4];
          }else{
            $id="";
            $un="";
            $up="";
            $ur="";
            $ut="";
          }
          $this->admin_form_user($p1,$p2,$id,$un,$up,$ur,$ut);
        }
      }else{
        if (isset($_POST['delu'])){
          if (isset($_POST['id'])){
            $ret=true;
            $t=$fwsqlm->SQL_TABLE_SYS[1];
            $id=$_POST['id'];
            $sql="DELETE FROM $t WHERE id=$id;";
            if ($fwsql->sql_run($sql)){
            }
          }
        }
      }
      echo("<div class=placeh></div>");
    }
    return($ret);
  }



  # felhasználó adatlap
  function admin_form_user($p1=0,$p2=0,$id="",$un="",$up="",$ur="",$ut=""){
    global $fwlang;

    echo("<div class=placeh></div>");
    echo("<h3>".$fwlang->lang("Felhasználó")."</h3>");
    echo("<div class=placeh></div>");
    echo("<div class=formbox>");
    echo("<form method=post>");
    echo("<label for=\"0\">".$fwlang->lang("Név").":</label><br>");
    echo("<input type=\"text\" id=\"auname\" name=\"auname\" placeholder=\"\" value=\"$un\"><br>");
    echo("<label for=\"0\">".$fwlang->lang("Jelszó").":</label><br>");
    echo("<input type=\"password\" id=\"aupass\" name=\"aupass\" placeholder=\"\" value=\"$up\"><br>");
    echo("<label for=\"0\">".$fwlang->lang("Szerepkör").":</label><br>");
    echo("<input type=\"text\" id=\"aurole\" name=\"aurole\" placeholder=\"\" value=\"$ur\"><br>");
    echo("<label for=\"0\">".$fwlang->lang("Leírás").":</label><br>");
    echo("<input type=\"text\" id=\"autext\" name=\"autext\" placeholder=\"\" value=\"$ut\"><br>");
    echo("<input type=hidden id=page1 name=page1 value=\"$p1\">");
    echo("<input type=hidden id=page2 name=page2 value=\"$p2\">");
    echo("<input type=hidden id=adminpage name=adminpage value=\"$this->ADMIN_PAGE\">");
    echo("<input type=hidden id=id name=id value=\"$id\">");
    echo("<div class=placeh></div>");
    if ($id<>""){
      echo("<input type=submit id=nextu name=nextu value=\"".$fwlang->lang("Módosítás")."\">");
    }else{
      echo("<input type=submit id=nextu name=nextu value=\"".$fwlang->lang("Új")."\">");
    }
    echo("<div class=placeh></div>");
    echo("<input type=submit id=delu name=delu value=\"".$fwlang->lang("Törlés")."\">");
    echo("<div class=placeh></div>");
    echo("<input type=submit id=back name=back value=\"".$fwlang->lang("Vissza")."\">");
    echo("</form>");
    echo("</div>");
  }



  # paraméter adattábla
  function admin_table_param(){
    global $fwlang,$fwsql,$fwsqlm,$fwapp;

    if (isset($_POST['page1'])){
      $p1=$_POST['page1'];
    }else{
      $p1=0;
    }
    if (isset($_POST['page2'])){
      $p2=$_POST['page2'];
    }else{
      $p2=0;
    }
    $t=$fwsqlm->SQL_TABLE_SYS[0];
    $sql="SELECT * from $t;";
    if ($fwsql->sql_run($sql)){
      echo("<div class=placeh></div>");
      echo("<h3>".$fwlang->lang("Paraméterek")." [ ".$t." ]</h3>");
      echo("<div class=\"newbutton\">");
      echo("<form method=post>");
      echo("<input type=hidden id=page1 name=page1 value=\"$p1\">");
      echo("<input type=hidden id=page2 name=page2 value=\"$p2\">");
      echo("<input type=hidden id=adminpage name=adminpage value=\"$this->ADMIN_PAGE\">");
      echo("<input type=submit id=newp name=newp value=\"+\">");
      echo("</form>");
      echo("</div>");
      echo("<table class='df_table' id=ptable>");
      echo("<tr class='df_trh'>");
      echo("<th class='df_th4'>".$fwlang->lang("ID")."</th>");
      echo("<th class='df_th'>".$fwlang->lang("Név")."</th>");
      echo("<th class='df_th'>".$fwlang->lang("Érték")."</th>");
      echo("<th class='df_th4'>".$fwlang->lang("Törlés / Módosítás")."</th>");
      echo("</tr>");
      $db=count($fwsql->SQL_RESULT);
      if ($p1>0){
        $ind=$p1-1;
      }else{
        $ind=0;
      }
      $st1=$ind*$this->ADMIN_TABLE_ROW;
      if($st1>$db){
        $st1=0;
      }
      $st2=$st1+$this->ADMIN_TABLE_ROW;
      if($st2>$db){
        $st2=$db;
      }
      for($i=$st1;$i<$st2;$i++){
        $s=$fwsql->SQL_RESULT[$i];
        echo("<tr class='df_tr'>");
        echo("<td class='df_tdc'>");
        echo("$s[0]");
        echo("</td>");
        echo("<td class='df_td'>");
        echo("$s[1]");
        echo("</td>");
        echo("<td class='df_td'>");
        echo("$s[2]");
        echo("</td>");
        echo("<td class='df_tdc'>");
        echo("<form method=post>");
        echo("<input type=hidden id=page1 name=page1 value=\"$p1\">");
        echo("<input type=hidden id=page2 name=page2 value=\"$p2\">");
        echo("<input type=hidden id=adminpage name=adminpage value=\"$this->ADMIN_PAGE\">");
        echo("<input type=hidden id=id name=id value=\"$s[0]\">");
        echo("<input type=submit id=nextp name=nextp class=\"\" value=\"&gt;&gt;\">");
        echo("</form>");
        echo("</td>");
        echo("</td>");
        echo("</tr>");
      }
      echo("</table>");
      echo("<div class=placeh></div>");
      $c=$this->pager($db,$this->ADMIN_TABLE_ROW,$p1,"page1",$p2,"page2");
      echo($c);
      echo("<div class=placeh></div>");
    }
    echo("<div class=placeh></div>");
  }



  # felhasználó adattábla
  function admin_table_user(){
    global $fwlang,$fwsql,$fwsqlm,$fwapp;

    if (isset($_POST['page1'])){
      $p1=$_POST['page1'];
    }else{
      $p1=0;
    }
    if (isset($_POST['page2'])){
      $p2=$_POST['page2'];
    }else{
      $p2=0;
    }
    $t=$fwsqlm->SQL_TABLE_SYS[1];
    $sql="SELECT * from $t;";
    if ($fwsql->sql_run($sql)){
      echo("<div class=placeh></div>");
      echo("<h3>".$fwlang->lang("Felhasználók")." [ ".$t." ]</h3>");
      echo("<div class=\"newbutton\">");
      echo("<form method=post>");
      echo("<input type=hidden id=page1 name=page1 value=\"$p1\">");
      echo("<input type=hidden id=page2 name=page2 value=\"$p2\">");
      echo("<input type=hidden id=adminpage name=adminpage value=\"$this->ADMIN_PAGE\">");
      echo("<input type=submit id=newu name=newu value=\"+\">");
      echo("</form>");
      echo("</div>");
      echo("<table class='df_table' id=utable>");
      echo("<tr class='df_trh'>");
      echo("<th class='df_th4'>".$fwlang->lang("ID")."</th>");
      echo("<th class='df_th2'>".$fwlang->lang("Név")."</th>");
      echo("<th class='df_th4'>".$fwlang->lang("Szerepkör")."</th>");
      echo("<th class='df_th'>".$fwlang->lang("Információ")."</th>");
      echo("<th class='df_th4'>".$fwlang->lang("Törlés / Módosítás")."</th>");
      echo("</tr>");
      $db=count($fwsql->SQL_RESULT);
      if ($p2>0){
        $ind=$p2-1;
      }else{
        $ind=0;
      }
      $st1=$ind*$this->ADMIN_TABLE_ROW;
      if($st1>$db){
        $st1=0;
      }
      $st2=$st1+$this->ADMIN_TABLE_ROW;
      if($st2>$db){
        $st2=$db;
      }
      for($i=$st1;$i<$st2;$i++){
        $s=$fwsql->SQL_RESULT[$i];
        echo("<tr class='df_tr'>");
        echo("<td class='df_tdc'>");
        echo("$s[0]");
        echo("</td>");
        echo("<td class='df_td'>");
        echo("$s[1]");
        echo("</td>");
        echo("<td class='df_tdc'>");
        echo("$s[3]");
        echo("</td>");
        echo("<td class='df_td'>");
        echo("$s[4]");
        echo("</td>");
        echo("<td class='df_tdc'>");
        echo("<form method=post>");
        echo("<input type=hidden id=page1 name=page1 value=\"$p1\">");
        echo("<input type=hidden id=page2 name=page2 value=\"$p2\">");
        echo("<input type=hidden id=adminpage name=adminpage value=\"$this->ADMIN_PAGE\">");
        echo("<input type=hidden id=id name=id value=\"$s[0]\">");
        echo("<input type=submit id=nextu name=nextu value=\"&gt;&gt;\">");
        echo("</form>");
        echo("</td>");
        echo("</td>");
        echo("</tr>");
      }
      echo("</table>");
      echo("<div class=placeh></div>");
      $c=$this->pager($db,$this->ADMIN_TABLE_ROW,$p2,"page2",$p1,"page1");
      echo($c);
      echo("<div class=placeh></div>");
    }
    echo("<div class=placeh></div>");
  }



  # lapozó felhasználói felületen
  function pager($db=0,$row=1,$apage=0,$formid="",$apage2="",$formid2="",$little=false){
    global $fwlang;

    $content="";
    if ($db>$row){
      $content=$content."<div class=\"pagerline\">";
      $op=ceil($db/$row);
      if (($apage<>1)and($op>1)){
        $i=$apage-1;
        $content=$content."<form class=\"pagerform\" method=\"post\">";
        $content=$content."<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"1\">";
        $content=$content."<input type=\"hidden\" id=\"$formid2\" name=\"$formid2\" value=\"$apage2\">";
        $content=$content."<input type=hidden id=adminpage name=adminpage value=\"$this->ADMIN_PAGE\">";
        $content=$content."<input class=\"pagerbutton\" type=\"submit\" id=\"$formid$i\" name=\"$formid$i\" value=\"".$fwlang->lang("Első")."\">";
        $content=$content."</form>";
        $content=$content."<form class=\"pagerform\" method=\"post\">";
        $content=$content."<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"$i\">";
        $content=$content."<input type=\"hidden\" id=\"$formid2\" name=\"$formid2\" value=\"$apage2\">";
        $content=$content."<input type=hidden id=adminpage name=adminpage value=\"$this->ADMIN_PAGE\">";
        $content=$content."<input class=\"pagerbutton\" type=\"submit\" id=\"$formid$i\" name=\"$formid$i\" value=\"&lt;&lt;\">";
        $content=$content."</form>";
      }
      $endl=false;
      $l1=1;
      $l2=$op;
      if ($little){
        if ($op>3){
          $l1=$apage-1;
          $l2=$apage+1;
          if ($l1<1){
            $l1=1;
            $l2=3;
          }else{
            if ($l1>1){
              $content=$content." <span class=\"pagerdots\">...</span>";
            }
          }
          if ($l2>=$op){
            $l2=$op;
            //$l1=$op-9;
          }else{
            $endl=true;
          }
          if (($l2-$l1)<3){
            $l1=$l2-2;
          }
        }else{
          $l1=1;
          $l2=$op;
        }
      }else{
        if ($op>9){
          $l1=$apage-4;
          $l2=$apage+4;
          if ($l1<1){
            $l1=1;
            $l2=9;
          }else{
            if ($l1>1){
              $content=$content." <span class=\"pagerdots\">...</span>";
            }
          }
          if ($l2>=$op){
           $l2=$op;
            //$l1=$op-9;
          }else{
            $endl=true;
          }
          if (($l2-$l1)<9){
            $l1=$l2-8;
          }
        }else{
          $l1=1;
          $l2=$op;
        }
      }
      for($i=$l1;$i<=$l2;$i++){
        $content=$content."<form class=\"pagerform\" method=\"post\">";
        $content=$content."<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"$i\">";
        $content=$content."<input type=\"hidden\" id=\"$formid2\" name=\"$formid2\" value=\"$apage2\">";
        $content=$content."<input type=hidden id=adminpage name=adminpage value=\"$this->ADMIN_PAGE\">";
        if ($apage==$i){
          $content=$content."<input class=\"pagerbutton\" type=\"submit\" id=\"$formid$i\" name=\"$formid$i\" value=\"$i\">";
          $content=$content."<script>document.getElementById(\"$formid$i\").disabled=true</script>";
        }else{
          $content=$content."<input class=\"pagerbutton\" type=\"submit\" id=\"$formid$i\" name=\"$formid$i\" value=\"$i\">";
        }
        $content=$content."</form>";
      }
      if ($endl){
        $content=$content." <span class=\"pagerdots\">...</span>";
      }
      if (($apage<$op)and($op>1)){
        $i=$apage+1;
        $content=$content."<form class=\"pagerform\" method=\"post\">";
        $content=$content."<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"$i\">";
        $content=$content."<input type=\"hidden\" id=\"$formid2\" name=\"$formid2\" value=\"$apage2\">";
        $content=$content."<input type=hidden id=adminpage name=adminpage value=\"$this->ADMIN_PAGE\">";
        $content=$content."<input class=\"pagerbutton\" type=\"submit\" id=\"$formid$i\" name=\"$formid$i\" value=\"&gt;&gt;\">";
        $content=$content."</form>";
        $content=$content."<form class=\"pagerform\" method=\"post\">";
        $up=round(($db/$row),0);
        $content=$content."<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"$up\">";
        $content=$content."<input type=\"hidden\" id=\"$formid2\" name=\"$formid2\" value=\"$apage2\">";
        $content=$content."<input type=hidden id=adminpage name=adminpage value=\"$this->ADMIN_PAGE\">";
        $content=$content."<input class=\"pagerbutton\" type=\"submit\" id=\"$formid$i\" name=\"$formid$i\" value=\"".$fwlang->lang("Utolsó")."\">";
        $content=$content."</form>";
      }
      $content=$content."</div>";
    }
    return($content);
  }



}



?>
