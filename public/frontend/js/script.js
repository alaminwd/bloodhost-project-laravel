
$(function(){
    'use strict'
// Menu fix
var menu = $('.navbar').offset().top;

$(window).scroll(function(){
  var scroll = $(this).scrollTop();

 if(scroll > 100){
  $('.navbar').addClass('menu_fix');
 }
 else{
  $('.navbar').removeClass('menu_fix');
 }
});


// Banner slider

$('.banner_main').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 4000,
  speed: 2000,
  arrows: false,
  fade: true,
});

// ==========Donoors Slider==========//

$('.donors_slider').slick({
  infinite: true,
  slidesToShow: 4,
  slidesToScroll: 1,
  autoplay: false,
  autoplaySpeed: 3000, 
  speed: 1500,
  prevArrow:'<a class="slick-prev slick-arrow " aria-label="Previous"><i class="fa-solid fa-arrow-left prev"></i></a>',
  nextArrow:'<a class="slick-prev slick-arrow " aria-label="Previous"><i class="fa-solid fa-arrow-right next"></i></a>',
  responsive: [
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: false,
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: false,
        arrows: false,
      }
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: false,
        arrows: false,
      }
    },
    {
      breakpoint: 1199,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
      }
    },
   
  ]
});



// =========Counter===========//
$('.counter').counterUp({
  delay: 10,
  time: 1000
});

// ============== tesmonial slider ==========
$('.test_row').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000,
  speed: 1000,
  arrows: false,
  responsive: [
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: false,
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
      }
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
      }
    },
  ]
});
// ============== tesmonial slider ==========
$('.blog_row').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000,
  speed: 1000,
  arrows: false,
  responsive: [
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: false,
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
      }
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
      }
    },
  ]
});


//----- Back to Top -----//

$('.backToTopBtn').click(function () {
  $('html, body').animate({
    scrollTop: 0
  }, 1500)
});

$(window).scroll(function () {
  var scrolling = $(this).scrollTop();

  if (scrolling > 300) {
    $('.backToTopBtn').fadeIn(300);
  } else {
    $('.backToTopBtn').fadeOut(300)
  }
  
});


});




