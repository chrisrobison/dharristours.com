$(document).on('ready', function() {

  $(window).on("load resize scroll",function(e){
    /*bus service li dyanmic height*/
    var LiHeight = $('.charterBusServices li img').height();
    $('.charterBusServices li').css('height', LiHeight);
  });
  /*Carousel home banner*/
  $(".testimonial").slick({
    dots: true,
    speed: 1000,
    arrows:true,
    autoplay: false,
    slidesToShow: 3,
    slidesToScroll: 3,
    responsive: [
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });
  $(".logoCarousel").slick({
    speed: 1000,
    arrows:true,
    autoplay: false,
    slidesToShow: 5,
    slidesToScroll: 5,
    responsive: [
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3
        }
      }
    ]
  });
  $("#lastMinuteCounter, #mobChartTabular").slick({
    speed: 1000,
    arrows:true,
    autoplay: false,
    slidesToShow: 1,
    slidesToScroll: 1
  });
});