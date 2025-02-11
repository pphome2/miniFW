<?php

 #
 # MiniFW 3
 #
 # app admin
 #



class fw_app_admin{

  public $ADMIN_PAGE=0;
  public $ADMIN_TABLE_ROW=2;



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
      echo("<form class=adminmenuform id=f0 method=post>");
      echo("<input type=hidden id=page1 name=page1 value=\"$p1\">");
      echo("<input type=hidden id=page2 name=page2 value=\"$p2\">");
      echo("<input type=hidden id=adminpage name=adminpage value=\"0\">");
      echo("<input type=submit class=menubutton id=\"admenu0\" name=\"admenu0\" value=\"".$fwlang->lang("Felhasználók")."\">");
      echo("</form>");
      echo("<form class=adminmenuform id=f1 method=post>");
      echo("<input type=hidden id=page1 name=page1 value=\"$p1\">");
      echo("<input type=hidden id=page2 name=page2 value=\"$p2\">");
      echo("<input type=hidden id=adminpage name=adminpage value=\"1\">");
      echo("<input type=submit class=menubutton id=\"admenu1\" name=\"admenu1\" value=\"".$fwlang->lang("Paraméterek")."\">");
      echo("</form>");
      echo("<form class=adminmenuform id=f2 method=post>");
      echo("<input type=hidden id=page1 name=page1 value=\"$p1\">");
      echo("<input type=hidden id=page2 name=page2 value=\"$p2\">");
      echo("<input type=hidden id=adminpage name=adminpage value=\"2\">");
      echo("<input type=submit class=menubutton id=\"admenu2\" name=\"admenu2\" value=\"".$fwlang->lang("Mentés")."\">");
      echo("</form>");
      echo("</div>");
      if (isset($_POST['adminpage'])){
        $this->ADMIN_PAGE=$_POST['adminpage'];
      }
      $mid="admenu".$this->ADMIN_PAGE;
      echo("<script>document.getElementById(\"$mid\").disabled=true;</script>");
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
    $filesql=$fwcfg->FW_FS_MAIN_DIR."/".$fwcfg->FW_MEDIA_DIR."/".$fwcfg->FW_SQL_DB.".sql";
    $filegz=$fwcfg->FW_FS_MAIN_DIR."/".$fwcfg->FW_MEDIA_DIR."/".$fwapp->APP_NAME.".tar.gz";
    if (isset($_POST['delbackup'])){
      $ok=true;
      if (file_exists($filesql)){
        try{
          unlink($filesql);
        }catch (Exception $e){
          $c=$fwlang->lang("Hiba a törlés közben");
          if(function_exists('message_error')){
            message_error($c.".");
          }else{
            echo("<br /><br /><b>! $c.</b><br /><br />");
          }
          $ok=false;
        }
      }
      if (file_exists($filegz)){
        try{
          unlink($filegz);
        }catch (Exception $e){
          $c=$fwlang->lang("Hiba a törlés közben");
          if(function_exists('message_error')){
            message_error($c.".");
          }else{
            echo("<br /><br /><b>! $c.</b><br /><br />");
          }
          $ok=false;
        }
      }
      if($ok){
        $c=$fwlang->lang("A törlés megtörtént");
        if(function_exists('message_ok')){
          message_ok($c.".");
        }else{
          echo("<br /><br /><b>$c.</b><br /><br />");
        }
      }
    }
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
      $filesqlu=$fwcfg->FW_URI_MAIN_DIR."/".$fwcfg->FW_MEDIA_DIR."/".$fwcfg->FW_SQL_DB.".sql";
      $filegzu=$fwcfg->FW_URI_MAIN_DIR."/".$fwcfg->FW_MEDIA_DIR."/".$fwapp->APP_NAME.".tar.gz";
      echo("<div class=placeh></div>");
      echo("<a href=\"$filesqlu\"><input type=submit id=backup name=backup value=\"".$fwlang->lang("SQL mentés letöltése")."\"></a>");
      echo("<a href=\"$filegzu\"><input type=submit id=backup name=backup value=\"".$fwlang->lang("Fájlmentés letöltése")."\"></a>");
      echo("</div>");
    }
    if ((file_exists($filesql))or(file_exists($filegz))){
      echo("<div class=placeh></div>");
      echo("<div class=placeh></div>");
      echo("<h3>".$fwlang->lang("Korábbi mentés")."</h3>");
      echo("<div class=placeh></div>");
      echo("<div class=formbox>");
      echo("<form method=post>");
      echo("<input type=hidden id=adminpage name=adminpage value=\"2\">");
      echo("<input type=submit id=delbackup name=delbackup value=\"".$fwlang->lang("Mentésfájlok törlése")."\">");
      echo("</div>");
      echo("<div class=placeh></div>");
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
          if ($fwsqlm->save_param_id($_POST['id'],$_POST['pname'],$_POST['ptext'])){
            $c=$fwlang->lang("Hiba történt");
            if(function_exists('message_error')){
              message_error($c.": ".$fwsql->SQL_ERROR);
            }else{
              echo("<br /><br /><b>! $c: $fwsql->SQL_ERROR</b><br /><br />");
            }
          }else{
            $c=$fwlang->lang("Adattárolás megtörtént");
            if(function_exists('message_ok')){
              message_ok($c.".");
            }else{
              echo("<br /><br /><b>$c.</b><br /><br />");
            }
          }
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
            if (!$fwsql->sql_run($sql)){
              $c=$fwlang->lang("Hiba történt");
              if(function_exists('message_error')){
                message_error($c.": ".$fwsql->SQL_ERROR);
              }else{
                echo("<br /><br /><b>! $c: $fwsql->SQL_ERROR</b><br /><br />");
              }
            }else{
              $c=$fwlang->lang("Adattörlés megtörtént");
              if(function_exists('message_ok')){
                message_ok($c.".");
              }else{
                echo("<br /><br /><b>$c.</b><br /><br />");
              }
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
          if(!$fwsqlm->save_user_id($_POST['id'],$_POST['auname'],$_POST['aupass'],$_POST['aurole'],$_POST['autext'])){
            $c=$fwlang->lang("Hiba történt");
            if(function_exists('message_error')){
              message_error($c.": ".$fwsql->SQL_ERROR);
            }else{
              echo("<br /><br /><b>! $c: $fwsql->SQL_ERROR</b><br /><br />");
            }
          }else{
            $c=$fwlang->lang("Adattárolás megtörtént");
            if(function_exists('message_ok')){
              message_ok($c.".");
            }else{
              echo("<br /><br /><b>$c.</b><br /><br />");
            }
          }
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
            if (!$fwsql->sql_run($sql)){
              $c=$fwlang->lang("Hiba történt");
              if(function_exists('message_error')){
                message_error($c.": ".$fwsql->SQL_ERROR);
              }else{
                echo("<br /><br /><b>! $c: $fwsql->SQL_ERROR</b><br /><br />");
              }
            }else{
              $c=$fwlang->lang("Adattörlés megtörtént");
              if(function_exists('message_ok')){
                message_ok($c.".");
              }else{
                echo("<br /><br /><b>$c.</b><br /><br />");
              }
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
    echo("<input type=\"password\" id=\"aupass\" name=\"aupass\" placeholder=\"\" value=\"\"><br>");
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
      echo("<th class='df_th3'>".$fwlang->lang("Név")."</th>");
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
      $c=pager($db,$this->ADMIN_TABLE_ROW,$p1,"page1",$this->ADMIN_PAGE,"adminpage");
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
      $c=pager($db,$this->ADMIN_TABLE_ROW,$p2,"page2",$p1,"page1");
      echo($c);
      echo("<div class=placeh></div>");
    }
    echo("<div class=placeh></div>");
  }



}



?>
