// Altera a posição da imagem no mobile
$(function () {
  if (isMobileX(1119)) {
    $(".load-img-mobile").each(function () {
      var container = $(this);
      var img = $('[data-id-img="' + container.data("img") + '"]');
      img.attr("data-aos", "");
      img.appendTo(container);
    });
  }
});
