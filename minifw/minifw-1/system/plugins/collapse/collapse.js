<script>

var cocoll = document.getElementsByClassName("col-coll<?php echo("$COLLAPSENUM"); ?>");
var i;

for (i = 0; i < cocoll.length; i++) {
  cocoll[i].addEventListener("click", function() {
    this.classList.toggle("col-active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}
</script>

