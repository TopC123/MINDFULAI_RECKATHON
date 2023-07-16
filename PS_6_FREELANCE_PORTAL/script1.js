// Change image every 5 seconds
setInterval(nextSlide, 5000);

function nextSlide() {
  var carouselSlide = document.querySelector('.carousel-slide');
  carouselSlide.style.transform = 'translateX(-33.33%)';
  setTimeout(() => {
    carouselSlide.appendChild(carouselSlide.firstElementChild);
    carouselSlide.style.transition = 'none';
    carouselSlide.style.transform = 'translateX(0)';
    setTimeout(() => {
      carouselSlide.style.transition = 'transform 0.5s ease-in-out';
    }, 10);
  }, 500);
}