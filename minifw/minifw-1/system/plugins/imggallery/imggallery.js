
<script>

function imgGallery(imgs) {
    var expandImg = document.getElementById("ig-expandedImg");
    var imgText = document.getElementById("ig-imgtext");
    expandImg.src = imgs.src;
    imgText.innerHTML = imgs.alt;
    expandImg.parentElement.style.display = "block";
}


</script>
