/* =================== BLOCOS HOME =================== */
jQuery(document).ready(function ($) {
  $(".carrosel-blocos").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    infinite: true,
    /* autoplay: true,
    autoplaySpeed: 3000, */
    responsive: [
      {
        breakpoint: 1199,
        settings: {
          slidesToShow: 3,
        },
      },
      {
        breakpoint: 760,
        settings: {
          slidesToShow: 1,
          arrows: false,
          dots: true,
          adaptiveHeight: true,
        },
      },
    ],
  });
});
