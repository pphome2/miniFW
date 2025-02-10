<?php

 #
 # MiniFW 3
 #
 # app admin
 #



# üzenet: rendben
function message_ok($l){
  echo("<div class=message_ok id=message_ok onclick=\"this.style.display='none';\">");
  echo($l);
  echo("</div>");
  echo("<script>setTimeout(function(){document.getElementById('message_ok').style.display='none';},10000);</script>");
}



# üzenet: hiba
function message_error($l){
  echo("<div class=message_error id=message_error onclick=\"this.style.display='none';\">");
  echo($l);
  echo("</div>");
  echo("<script>setTimeout(function(){document.getElementById('message_error').style.display='none';},10000);</script>");
}



# lapozó felhasználói felületen
function pager($db=0,$row=1,$apage=0,$formid="",$apage2="",$formid2="",$little=false){
  global $fwlang;

  $ret="";
  if ($db>$row){
    $ret=$ret."<div class=\"pagerline\">";
    $op=ceil($db/$row);
    if (($apage<>1)and($op>1)){
      $i=$apage-1;
      $ret=$ret."<form class=\"pagerform\" method=\"post\">";
      $ret=$ret."<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"1\">";
      $ret=$ret."<input type=\"hidden\" id=\"$formid2\" name=\"$formid2\" value=\"$apage2\">";
      $ret=$ret."<input class=\"pagerbutton\" type=\"submit\" id=\"$formid$i\" name=\"$formid$i\" value=\"".$fwlang->lang("Első")."\">";
      $ret=$ret."</form>";
      $ret=$ret."<form class=\"pagerform\" method=\"post\">";
      $ret=$ret."<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"$i\">";
      $ret=$ret."<input type=\"hidden\" id=\"$formid2\" name=\"$formid2\" value=\"$apage2\">";
      $ret=$ret."<input class=\"pagerbutton\" type=\"submit\" id=\"$formid$i\" name=\"$formid$i\" value=\"&lt;&lt;\">";
      $ret=$ret."</form>";
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
            $ret=$ret." <span class=\"pagerdots\">...</span>";
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
            $ret=$ret." <span class=\"pagerdots\">...</span>";
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
      $ret=$ret."<form class=\"pagerform\" method=\"post\">";
      $ret=$ret."<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"$i\">";
      $ret=$ret."<input type=\"hidden\" id=\"$formid2\" name=\"$formid2\" value=\"$apage2\">";
      if ($apage==$i){
        $ret=$ret."<input class=\"pagerbutton\" type=\"submit\" id=\"$formid$i\" name=\"$formid$i\" value=\"$i\">";
        $ret=$ret."<script>document.getElementById(\"$formid$i\").disabled=true</script>";
      }else{
        $ret=$ret."<input class=\"pagerbutton\" type=\"submit\" id=\"$formid$i\" name=\"$formid$i\" value=\"$i\">";
      }
      $ret=$ret."</form>";
    }
    if ($endl){
      $ret=$ret." <span class=\"pagerdots\">...</span>";
    }
    if (($apage<$op)and($op>1)){
      $i=$apage+1;
      $ret=$ret."<form class=\"pagerform\" method=\"post\">";
      $ret=$ret."<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"$i\">";
      $ret=$ret."<input type=\"hidden\" id=\"$formid2\" name=\"$formid2\" value=\"$apage2\">";
      $ret=$ret."<input class=\"pagerbutton\" type=\"submit\" id=\"$formid$i\" name=\"$formid$i\" value=\"&gt;&gt;\">";
      $ret=$ret."</form>";
      $ret=$ret."<form class=\"pagerform\" method=\"post\">";
      $up=round(($db/$row),0);
      $ret=$ret."<input type=\"hidden\" id=\"$formid\" name=\"$formid\" value=\"$up\">";
      $ret=$ret."<input type=\"hidden\" id=\"$formid2\" name=\"$formid2\" value=\"$apage2\">";
      $ret=$ret."<input class=\"pagerbutton\" type=\"submit\" id=\"$formid$i\" name=\"$formid$i\" value=\"".$fwlang->lang("Utolsó")."\">";
      $ret=$ret."</form>";
    }
    $ret=$ret."</div>";
  }
  return($ret);
}


