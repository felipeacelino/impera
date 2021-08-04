(function() {
  "use strict";
  // Carrega imagens após aparecer na tela
  function loadLazyImages() {
    const preload = 100;
    const scrollTop = $(window).scrollTop();
    const windowHeight = $(window).height();
    $(".lazy-load")
      .not(".loaded")
      .each(function() {
        const img = $(this);
        const offset = img.offset().top;
        const imgEl = img.get(0);
        const imgSrc = img.data("img");
        if (scrollTop + windowHeight + preload >= offset) {
          img.addClass("loaded");
          imgEl.src = imgSrc;
        }
      });
    $(".lazy-load-bg")
      .not(".loaded")
      .each(function() {
        const bg = $(this);
        const offset = bg.offset().top;
        const imgSrc = bg.data("img");
        if (scrollTop + windowHeight + preload >= offset) {
          bg.addClass("loaded");
          bg.css("background-image", "url(" + imgSrc + ")");
        }
      });
  }
  loadLazyImages();
  $(window).on(
    "scroll",
    debounce(function() {
      loadLazyImages();
    }, 50)
  );
})();
