<?php

echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");

if (isset($IMGGALLERY)){
	$img=array("../content/img/1.jpg","../content/img/2.jpg","../content/img/3.jpg");
	$text=array("111","222","333");
	imggallery($img,$text);
}

echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");

if (isset($IMGGALLERY)){
	$img=array("../content/img/1.jpg","../content/img/2.jpg","../content/img/3.jpg");
	$text=array("111","222","333");
	mimggallery($img,$text);
}

echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");

if (isset($IMGGALLERY)){
	$img="../content/img/1.jpg";
	$text="111";
	bimgmodal($img,$text);
}


echo("<div class=spaceline50></div>");
echo("<div class=spaceline50></div>");


?>
