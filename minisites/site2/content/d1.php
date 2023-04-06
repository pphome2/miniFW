<?php

function menu(){
    global $S_MENU_LETTER,$S_MENU,$S_MENU_COLDB;

    $m=10000;
    if (isset($_GET[$S_MENU_LETTER])){
        $m=$_GET[$S_MENU_LETTER];
    }

    # felső menü
    echo("<div class=navbar>");
    for($i=0;$i<count($S_MENU);$i++){
        $ma=$S_MENU[$i];
        if (count($ma)>1){
            echo("<div id=$i class=dropdown>");
            echo("<button class=dropbtn>$ma[0] ");
            echo("<i>+</i>");
            echo("</button>");
            echo("<div class=dropdown-content>");
            echo("<div class=header>");
            echo("<h2>$ma[0]</h2>");
            echo("</div>");
            $z=1;
            echo("<div class=row>");
            echo("<div class=column>");
            echo("<h3>Zóna $z</h3>");
            for($t=1;$t<count($ma);$t++){
                if (($t===4)or($t===7)or($t===10)){
                    $z++;
                    echo("</div>");
                    echo("<div class=column>");
                    echo("<h3>Zóna $z</h3>");
                }
                $li=$i+1;
                $x=substr($m,0,1)."-".substr($m,2,1);
                if ("$x"==="$li-$t"){
                    echo("<a style=\"color:red;\" class=actmenu href=?$S_MENU_LETTER=$li-$t>$ma[$t]</a>");
                }else{
                    echo("<a href=?$S_MENU_LETTER=$li-$t>$ma[$t]</a>");
                }
            }
            echo("</div>");
            echo("</div>");
            echo("</div>");
            echo("</div>");
        }else{
            $li=$i+1;
            if ("$li"==="$m"){
                echo("<a style=\"color:red;\" class=actmenu href=?$S_MENU_LETTER=$li>$ma[0]</a>");
            }else{
                echo("<a href=?$S_MENU_LETTER=$li>$ma[0]</a>");
            }
        }
    }
    echo("<div>");
    return($m);
}

function page(){
    global $S_MENU_LETTER,$S_MENU,$S_MENUCODE;

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
