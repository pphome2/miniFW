<?php

echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");


$img = array
		(
			array("../content/img/1.jpg",	"Első kép"),
			array("../content/img/2.jpg",	""),
			array("../content/img/3.jpg",	"Harmadik kép")
		);


if (isset($IMGSLIDER)){
	imgautoslider($img);
}


echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");

if (isset($IMGSLIDER)){
	imgslider($img); 
}



echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");


?>
