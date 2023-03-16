<script>

// Get the modal
var modmodal<?php echo("$MODALNUM") ?> = document.getElementById("mymbModal<?php echo("$MODALNUM") ?>");

// Get the button that opens the modal
var modbtn<?php echo("$MODALNUM") ?> = document.getElementById("mymbBtn<?php echo("$MODALNUM") ?>");

// Get the <span> element that closes the modal
var modspan<?php echo("$MODALNUM") ?> = document.getElementById("mb-close<?php echo("$MODALNUM") ?>");

// When the user clicks the button, open the modal 
modbtn<?php echo("$MODALNUM") ?>.onclick = function() {
    modmodal<?php echo("$MODALNUM") ?>.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
modspan<?php echo("$MODALNUM") ?>.onclick = function() {
    modmodal<?php echo("$MODALNUM") ?>.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modmodal<?php echo("$MODALNUM") ?>) {
        modmodal<?php echo("$MODALNUM") ?>.style.display = "none";
    }
}
</script>
