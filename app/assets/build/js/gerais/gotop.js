/* =================== VOLTAR AO TOPO =================== */
jQuery(document).ready(function ($) {
  function toggleGoTop() {
    var scrollTop = $(window).scrollTop();
    if (scrollTop > 100) {
      $(".gotop").addClass("active");
    } else {
      $(".gotop").removeClass("active");
    }
  }
  toggleGoTop();
  $(window).on(
    "scroll",
    debounce(function () {
      toggleGoTop();
    }, 100)
  );
  $(".gotop").on("click", function () {
    scrollToX("html");
  });
});
