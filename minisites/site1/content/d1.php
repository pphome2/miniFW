<?php

function menu(){
    global $S_MENU_LETTER,$S_MENU;

    $m=10000;
    if (isset($_GET[$S_MENU_LETTER])){
        $m=$_GET[$S_MENU_LETTER];
    }

    # felső menü
    echo("<div class=mainnav>");
    for($i=0;$i<count($S_MENU);$i++){
        $ma=$S_MENU[$i];
        if ("$i"==="$m"){
            echo("<a class=actmenu href=?$S_MENU_LETTER=$i>$ma[0]</a>");
        }else{
            echo("<a href=?$S_MENU_LETTER=$i>$ma[0]</a>");
        }
    }
    echo("</div>");

    # oldal menü
    echo("<div class=sidenav>");
    for($i=0;$i<count($S_MENU);$i++){
        $ma=$S_MENU[$i];
        if (count($ma)>1){
            echo("<div class=subbutton onclick=\"menushow('a$i')\"><span class=fontbutton>$ma[0]</span>");
            echo("<i class=subicon>+</i></div>");
            if (substr("$m",0,1)==="$i"){
                echo("<div class=subcont2 style=\"display:block;\" id=a$i>");
            }else{
                echo("<div class=subcont style=\"display:none;\" id=a$i>");
            }
            for($l=1;$l<count($ma);$l++){
                $x=substr($m,0,1).substr($m,2,1);
                if ((strlen("$m")>1)and(substr("$m",0,1)==="$i")and(substr("$m",2,1)==="$l")){
                    echo("<a class=actmenu href=?$S_MENU_LETTER=$i-$l>$ma[$l]</a>");
                }else{
                    echo("<a href=?$S_MENU_LETTER=$i-$l>$ma[$l]</a>");
                }
            }
                echo("</div>");
        }else{
            if ("$i"==="$m"){
                echo("<a class=actmenu href=?$S_MENU_LETTER=$i>$ma[0]</a>");
            }else{
                echo("<a href=?$S_MENU_LETTER=$i>$ma[0]</a>");
            }
        }
    }
    echo("</div>");
    return($m);
}


function page(){
    global $S_MENU_LETTER,$S_MENU;

    $m=menu();
    echo("<div class=main>");
    echo("<div class=demo>");
    echo("Tartalom itt...");
    echo("</div>");
    if (function_exists("sql_run")){
      echo("SQL ok.<br />");
    }
    switch($m){
      case "1":
          echo("Menüpont: 1");
          break;
      case "2":
          echo("Menüpont: 2");
          break;
      case "7-1":
          echo("Menüpont: 7-1");
          break;
      default:
        echo("Egyéb: $m");
        break;
    }
    echo("</div>");
}


?>
