<script>

// slider with buttons

var isslideIndex<?php echo("$IMGSLIDERNUM"); ?> = 1;
showDivs<?php echo("$IMGSLIDERNUM"); ?>(isslideIndex<?php echo("$IMGSLIDERNUM"); ?>);

function plusDivs<?php echo("$IMGSLIDERNUM"); ?>(n) {
	isslideIndex<?php echo("$IMGSLIDERNUM"); ?>  = isslideIndex<?php echo("$IMGSLIDERNUM"); ?> += n;
	showDivs<?php echo("$IMGSLIDERNUM"); ?>(isslideIndex<?php echo("$IMGSLIDERNUM"); ?> );
}

function currentDiv<?php echo("$IMGSLIDERNUM") ?>(n) {
	showDivs<?php echo("$IMGSLIDERNUM"); ?>(isslideIndex<?php echo("$IMGSLIDERNUM"); ?> = n);
}

function showDivs<?php echo("$IMGSLIDERNUM"); ?>(n) {
	var i;
	var x = document.getElementsByClassName("immyS<?php echo("$IMGSLIDERNUM"); ?>");
	var y = document.getElementsByClassName("im-imgtextx<?php echo("$IMGSLIDERNUM"); ?>");
	var dots = document.getElementsByClassName("imB<?php echo("$IMGSLIDERNUM"); ?>");
	if (n > x.length) {isslideIndex<?php echo("$IMGSLIDERNUM"); ?> = 1}    
	if (n < 1) {isslideIndex<?php echo("$IMGSLIDERNUM"); ?> = x.length}
	for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";
		y[i].style.display = "none";  
	}
	for (i = 0; i < dots.length; i++) {
		dots[i].className = dots[i].className.replace(" im-badge-light", "");
	}
	var k=isslideIndex<?php echo("$IMGSLIDERNUM"); ?>-1;
	x[k].style.display = "block";  
	y[k].style.display = "block";  
	dots[isslideIndex<?php echo("$IMGSLIDERNUM"); ?>-1].className += " im-badge-light";
}

</script>
