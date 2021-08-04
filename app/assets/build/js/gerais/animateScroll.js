/* =================== ANIMATE SCROLL =================== */

// Adiciona uma classe aos elementos após o mesmos serem exibidos na tela
function animeScroll(target, animationClass) {
  var documentTop = $(document).scrollTop();
  var windowHeight = $(window).height();
  var offset = windowHeight - windowHeight / 4;

  target.each(function () {
    eleTop = $(this).offset().top;
    if (documentTop > eleTop - offset) {
      $(this).addClass(animationClass);
    }
  });
}

$(function () {
  AOS.init({
    duration: 700,
  });
});
