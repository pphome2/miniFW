<script>


function openModal() {
  document.getElementById('mig-myModal').style.display = "block";
}

function closeModal() {
  document.getElementById('mig-myModal').style.display = "none";
}

var migslideIndex = 1;
showSlides(migslideIndex);

function plusSlides(n) {
  showSlides(migslideIndex += n);
}

function currentSlide(n) {
  showSlides(migslideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mig-mySlides");
  var dots = document.getElementsByClassName("mig-demo");
  var captionText = document.getElementById("mig-caption");
  if (n > slides.length) {migslideIndex = 1}
  if (n < 1) {migslideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" mig-active", "");
  }
  slides[migslideIndex-1].style.display = "block";
  dots[migslideIndex-1].className += " mig-active";
  captionText.innerHTML = dots[migslideIndex-1].alt;
}


</script>
