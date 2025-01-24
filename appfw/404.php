<?php

//
// Error: 403, 404
//


$L_ERROR_MESSAGE="Az oldal nem található. Hibás URL?";
$L_GOTO_MAINPAGE="Ugrás a főoldalra";


echo("<!DOCTYPE html>");
echo("<head>");
echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />");
echo("<title>403/404</title>");
echo("<style>");
?>
  body{
    background-color:lightgray;
  }
  .box{
    margin-left:25%;
    margin-top:5%;
    width:50%;
    background-color:white;
    border:1px solid gray;
    border-radius:10px;
    padding:30px;
    box-shadow: 10px 10px 10px 10px gray;
  }
  form, .buttonbox{
    margin-left:20%;
    margin-right:20%;
    align:center;
  }
  input{
    width:100%;
  }
  .placeholder{
    max-height:2em;
    height:2em;
    display:block;
  }
  .h1{
    font-size:+4em;
  }
<?php
echo("</style>");
echo("</head>");
echo("<html>");
echo("<body>");
echo("<div class=box>");

// fájlok felderítése
echo("<span class=placeholder></span>");
echo("<span class=placeholder></span>");
echo("<h1 class=h1>403 / 404</h1>");
echo("<span class=placeholder></span>");
echo("<span class=placeholder></span>");
echo("<span class=placeholder></span>");
echo($L_ERROR_MESSAGE);
echo("<span class=placeholder></span>");
echo("<span class=placeholder></span>");
echo("<span class=placeholder></span>");
echo("<a href=index.php>$L_GOTO_MAINPAGE</a>");
echo("<span class=placeholder></span>");
echo("<span class=placeholder></span>");
echo("<span class=placeholder></span>");


echo("</div>");
echo("</body></html>");

?>
