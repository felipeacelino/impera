/* =================== SLIDE HOME =================== */
jQuery(document).ready(function ($) {
  $(".slide-home").slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: false,
    autoplay: true,
    autoplaySpeed: 5000,
    adaptiveHeight: true,
    fade: true,
    cssEase: "linear",
  });
});
