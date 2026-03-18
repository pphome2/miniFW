<script>

// auto slider

var immyIndex<?php echo("$IMGSLIDERNUM");?> = 0;
carousel<?php echo("$IMGSLIDERNUM");?>();

function carousel<?php echo("$IMGSLIDERNUM");?>() {
    var i;
    var x = document.getElementsByClassName("im-myAS<?php echo("$IMGSLIDERNUM");?>");
    var y = document.getElementsByClassName("im-imgtext<?php echo("$IMGSLIDERNUM");?>");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
       x[i].style.opacity = "0";  
       y[i].style.display = "none";  
       y[i].style.opacity = "0";  
    }
    immyIndex<?php echo("$IMGSLIDERNUM");?>++;
    if (immyIndex<?php echo("$IMGSLIDERNUM");?> > x.length) {immyIndex<?php echo("$IMGSLIDERNUM");?> = 1}    
    x[immyIndex<?php echo("$IMGSLIDERNUM");?>-1].style.display = "block";  
    x[immyIndex<?php echo("$IMGSLIDERNUM");?>-1].style.opacity = "1";  
    y[immyIndex<?php echo("$IMGSLIDERNUM");?>-1].style.display = "block";  
    y[immyIndex<?php echo("$IMGSLIDERNUM");?>-1].style.opacity = "0.5";  
    setTimeout(carousel<?php echo("$IMGSLIDERNUM");?>, 2000); // Change image every 2 seconds
}



</script>
