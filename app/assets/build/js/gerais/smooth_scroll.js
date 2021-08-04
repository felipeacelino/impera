/* =================== SMOOTH SCROLL (SCROLL SUAVE) =================== */

// Scroll para um determinado elemento
function scrollToX(element) {
  //const offset = isMobileX(760) ? 0 : $(".header").outerHeight();
  let offset = $(".header-full").outerHeight();
  if ($(".pag-anuncio").length > 0) {
    offset += 20;
  }
  if ($(".conta-container").length > 0) {
    offset = $(".conta-header").outerHeight() + 20;
  }
  let top = $(element) ? $(element).offset().top - offset : 0;
  $("html, body").animate(
    {
      scrollTop: top,
    },
    500
  );
}

// Verifica se o elemento está visível na tela
function isInViewport(element) {
  const rect = element.getBoundingClientRect();
  return (
    rect.top >= 0 &&
    rect.left >= 0 &&
    rect.bottom <=
      (window.innerHeight || document.documentElement.clientHeight) &&
    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
  );
}

jQuery(document).ready(function ($) {
  // Scroll suave para âncoras
  $('a[href^="#"]:not([href="#"]):not([href="#0"])').click(function (ev) {
    ev.preventDefault();
    if (
      location.pathname.replace(/^\//, "") ==
        this.pathname.replace(/^\//, "") ||
      location.hostname == this.hostname
    ) {
      var target = $(this.hash);
      target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
      if (target.length) {
        scrollToX(target);
        return false;
      }
    }
  });

  // Scroll suave para links externos
  $(document).on("ready", function () {
    var urlHash = window.location.href.split("#")[1];
    if (urlHash && urlHash != 0) {
      scrollToX("#" + urlHash);
    }
  });
});
