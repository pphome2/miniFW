<script>

// Get the modal

var bimmodal = document.getElementById('bim-myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption

var bimimg = document.getElementById('bim-myImg');
var bimmodalImg = document.getElementById("bim-img01");
var bimcaptionText = document.getElementById("bim-caption");
bimimg.onclick = function(){
    bimmodal.style.display = "block";
    bimmodalImg.src = this.src;
    bimcaptionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal

var bimspan = document.getElementsByClassName("bim-close")[0];

// When the user clicks on <span> (x), close the modal

bimspan.onclick = function() { 
    bimmodal.style.display = "none";
}

</script>
