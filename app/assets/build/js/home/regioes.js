/* =================== REGIÕES =================== */
jQuery(document).ready(function ($) {
  $(".carrosel-regioes").slick({
    slidesToShow: 3,
    slidesToScroll: 3,
    infinite: true,
    /* autoplay: true,
    autoplaySpeed: 3000, */
    responsive: [
      {
        breakpoint: 1199,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        },
      },
      {
        breakpoint: 760,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          dots: true,
        },
      },
    ],
  });
});
