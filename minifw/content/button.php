<?php


echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");

if (isset($MODALBOX)){
	$m="<img src=../content/img/1.jpg>";
	modalbox_button("Kép nagyítása","Egy kép a képtárból",$m,"");
}
echo("<div class=spaceline50></div>");
if (isset($MODALBOX)){
	$m="<img src=../content/img/2.jpg>";
	modalbox_button("Kép nagyítása","Egy kép a képtárból",$m,"");
}
echo("<div class=spaceline50></div>");
if (isset($MODALBOX)){
	$m="<img src=../content/img/3.jpg>";
	modalbox("<center><img src=../content/img/3.jpg style=\"width:10%;cursor:pointer;\"></center>","Egy kép a képtárból",$m,"");
}

echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");


?>
