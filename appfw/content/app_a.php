<?php

 #
 # MiniFW 3
 #
 # app admin
 #



class fw_app_admin{


  function __construct(){
  }



  # vezérlő
  function main(){
    if (isset($_POST['nextp'])or(isset($_POST['delp']))){
      $this->admin_form_param();
    }
    if (isset($_POST['nextu'])or(isset($_POST['delu']))){
      $this->admin_form_user();
    }
    $this->admin_table();
  }



  # javítás/törlés
  function admin_form_param(){
    global $fwlang,$fwsql,$fwsqlm;

    if (isset($_POST['id'])){
      echo("<div class=placeh></div>");
      echo("<h3>".$fwlang->lang("Paraméter")."</h3>");
      if (isset($_POST['nextp'])){
        $p1=$_POST['page1'];
        $p2=$_POST['page2'];
        echo("<form method=post>");
        echo("<input type=hidden id=page1 name=page1 value=\"$p1\">");
        echo("<input type=hidden id=page2 name=page2 value=\"$p2\">");
        echo("<input type=hidden id=id name=id value=\"$s[0]\">");
        echo("<input type=hidden id=idx name=idx value=\"$s[0]\">");
        echo("<input type=submit id=nextp name=nextp value=\"".$fwlang->lang("Módosítás")."\">");
        echo("<input type=submit id=delp name=delp value=\"".$fwlang->lang("Törlés")."\">");
        echo("</form>");
      }else{
        if (isset($_POST['delp'])){
          if (isset($_POST['id'])){
            echo("delp");
          }
        }
      }
      echo("<div class=placeh></div>");
    }
  }



  # javítás/törlés
  function admin_form_user(){
    global $fwlang,$fwsql,$fwsqlm;

    echo("<div class=placeh></div>");
    echo("user");
    echo("<div class=placeh></div>");
  }



  # adattáblák
  function admin_table(){
    global $fwlang,$fwsql,$fwsqlm;

    echo("<div class=placeh></div>");
    $t=$fwsqlm->SQL_TABLE_SYS[0];
    echo("<h3>".$fwlang->lang("Paraméterek")." [ ".$t." ]</h3>");
    $sql="SELECT * from $t;";
    if ($fwsql->sql_run($sql)){
      echo("<table class='df_table' id=ptable>");
      echo("<tr class='df_trh'>");
      echo("<th class='df_th4'>".$fwlang->lang("ID")."</th>");
      echo("<th class='df_th'>".$fwlang->lang("Név")."</th>");
      echo("<th class='df_th'>".$fwlang->lang("Érték")."</th>");
      echo("<th class='df_th4'>".$fwlang->lang("Törlés / Módosítás")."</th>");
      echo("</tr>");
      foreach($fwsql->SQL_RESULT as $s){
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
        echo("<input type=hidden id=id name=id value=\"$s[0]\">");
        echo("<input type=submit id=nextp name=nextp value=\"&gt;&gt;\">");
        echo("</form>");
        echo("</td>");
        echo("</td>");
        echo("</tr>");
      }
      echo("</table>");
    }
    echo("<div class=placeh></div>");
    echo("<div class=placeh></div>");
    $t=$fwsqlm->SQL_TABLE_SYS[1];
    echo("<h3>".$fwlang->lang("Felhasználók")." [ ".$t." ]</h3>");
    $sql="SELECT * from $t;";
    if ($fwsql->sql_run($sql)){
      echo("<table class='df_table' id=utable>");
      echo("<tr class='df_trh'>");
      echo("<th class='df_th4'>".$fwlang->lang("ID")."</th>");
      echo("<th class='df_th'>".$fwlang->lang("Név")."</th>");
      echo("<th class='df_th4'>".$fwlang->lang("Szerepkör")."</th>");
      echo("<th class='df_th'>".$fwlang->lang("Információ")."</th>");
      echo("<th class='df_th4'>".$fwlang->lang("Törlés / Módosítás")."</th>");
      echo("</tr>");
      foreach($fwsql->SQL_RESULT as $s){
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
        echo("<input type=hidden id=id name=id value=\"$s[0]\">");
        echo("<input type=submit id=nextu name=nextu value=\"&gt;&gt;\">");
        echo("</form>");
        echo("</td>");
        echo("</td>");
        echo("</tr>");
      }
      echo("</table>");
    }
    echo("<div class=placeh></div>");
  }



  # lapozó felhasználói felületen
  function pager($db=0,$row=0,$apage=0,$formid="",$little=false){
    $content="";
    if ($db>$row){
      $content=$content."<br /><br />";
      $content=$content."<div class=\"pagerline\">";
      $op=ceil($db/$row);
      if (($apage<>1)and($op>1)){
        $i=$apage-1;
        $content=$content."<form class=\"wswdpagerform\" action=\"".$_SERVER['REQUEST_URI']."\" method=\"post\">";
        $content=$content."<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"1\">";
        $content=$content."<input class=\"wswdpagerbutton\" type=\"submit\" id=\"x\" name=\"x\" value=\"".wswdteam_lang("Első")."\">";
        $content=$content."</form>";
        $content=$content."<form class=\"pagerform\" action=\"".$_SERVER['REQUEST_URI']."\" method=\"post\">";
        $content=$content."<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"$i\">";
        $content=$content."<input class=\"wswdpagerbutton\" type=\"submit\" id=\"x\" name=\"x\" value=\"&lt;&lt;\">";
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
              $content=$content." <span class=\"wswdpagerdots\">...</span>";
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
              $content=$content." <span class=\"wswdpagerdots\">...</span>";
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
        $content=$content."<form class=\"wswdpagerform\" action=\"".$_SERVER['REQUEST_URI']."\" method=\"post\">";
        $content=$content."<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"$i\">";
        if ($apage==$i){
          $content=$content."<input class=\"wswdpagerbutton\" type=\"submit\" id=\"x$i\" name=\"x\" value=\"$i\">";
          $content=$content."<script>document.getElementById(\"x$i\").disabled=true</script>";
        }else{
        $content=$content."<input class=\"wswdpagerbutton\" type=\"submit\" id=\"x$i\" name=\"x\" value=\"$i\">";
       }
        $content=$content."</form>";
      }
      if ($endl){
        $content=$content." <span class=\"pagerdots\">...</span>";
      }
      if (($apage<$op)and($op>1)){
        $i=$apage+1;
        $content=$content."<form class=\"wswdpagerform\" action=\"".$_SERVER['REQUEST_URI']."\" method=\"post\">";
        $content=$content."<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"$i\">";
        $content=$content."<input class=\"wswdpagerbutton\" type=\"submit\" id=\"x\" name=\"x\" value=\"&gt;&gt;\">";
        $content=$content."</form>";
        $content=$content."<form class=\"wswdpagerform\" action=\"".$_SERVER['REQUEST_URI']."\" method=\"post\">";
        $content=$content."<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"$op\">";
        $content=$content."<input class=\"wswdpagerbutton\" type=\"submit\" id=\"x\" name=\"x\" value=\"".wswdteam_lang("Utolsó")."\">";
        $content=$content."</form>";
      }
      $content=$content."</span></disv>";
    }
    return($content);
  }



}



?>
