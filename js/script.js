// header
const header = document.querySelector("header");

window.addEventListener("scroll",function(){
  header.classList.toggle("sticky",window.scrollY > 0);
});

let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

menu.onclick = () =>{
  menu.classList.toggle('bx-x');
  navbar.classList.toggle('open');
};
window.onscroll = () =>{
  menu.classList.remove('bx-x');
  navbar.classList.remove('open');
};
 
// count
let valueDisplays = document.querySelectorAll(".num");
let interval = 5000;

valueDisplays.forEach((valueDisplays) =>{
  let startValue = 0;
  let endValue = parseInt(valueDisplays.getAttribute("data-val"));
  let duration = Math.floor(interval / endValue);
  let counter = setInterval(function(){
    startValue += 1;
    valueDisplays.textContent = startValue;
    if(startValue == endValue){
      clearInterval(counter);
    }
  }, duration);
});



// trending

var swiper = new Swiper('.blog-slider', {
    spaceBetween: 30,
    effect: 'fade',
    loop: true,
    mouseWheel: {
        invert: false,
    },
    autoplay: {
        delay: 8000,
        disableOnInteraction: false,
    },
    // autoHeight: true
    pagination: {
        el: '.blog-slider__pagination',
        clickable: true,
    }
});



// free courses
$(document).ready(function () {
  $('.teams').slick({
      dots: true,
      infinite: false,
      speed: 300,
      slidesToShow: 3,
      slidesToScroll: 3,
      nextArrow: $('.next'),
      prevArrow: $('.prev'),
      responsive: [
          {
              breakpoint: 1024,
              settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2,
                  infinite: true,
                  dots: true
              }
          },
          {
              breakpoint: 600,
              settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1
              }
          },
          {
              breakpoint: 480,
              settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1
              }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
      ]
  });
});



// testimonials

let userTexts = document.getElementsByClassName("user-text");
let userPics = document.getElementsByClassName("user-pic");

function showReview(){
    for(userPic of userPics){
        userPic.classList.remove("active-pic");
    }
    for(userText of userTexts){
        userText.classList.remove("active-text");
    }

    let i = Array.from(userPics).indexOf(event.target);

    userPics[i].classList.add("active-pic");
    userTexts[i].classList.add("active-text");
}


// categories


// all courses

$(document).ready(function() {
  $('.filter-item').click(function() {
      const value = $(this).attr('data-filter')
      if(value == 'all'){
          $('.post-box').show('1000')
      }
      else{
          $('.post-box').not('.' + value).hide('1000')
          $('.post-box').filter('.' + value).show('1000')
      }
  });

  $(".filter-item").click(function() {
      $(this).addClass("active-filter").siblings().removeClass("active-filter");
  });

});