function toggleMobileMenu() {
    const menu = document.getElementById("mobileMenu");
    if (menu.style.width === "100%") {
        menu.style.width = "0";
    } else {
        menu.style.width = "100%";
    }
}
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
  
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
var slideInterval = setInterval(function() {
    plusDivs(1); // Bir sonraki slayta geç
  }, 7000); // Her 10 saniyede bir geçiş yap
  
  // Kullanıcı fareyi slayta getirdiğinde otomatik geçişi durdur
  document.querySelector('.slider').addEventListener('mouseenter', function() {
    clearInterval(slideInterval);
  });
  
  // Kullanıcı fareyi slayttan çıkardığında otomatik geçişi başlat
  document.querySelector('.slider').addEventListener('mouseleave', function() {
    slideInterval = setInterval(function() {
      plusDivs(1); // Bir sonraki slayta geç
    }, 7000); // Her 10 saniyede bir geçiş yap
  }
);
