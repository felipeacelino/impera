(function () {
  "use strict";

  $(".faq-pergunta").on("click", function () {
    $(this).next(".faq-resposta").slideToggle();
    $(this).parent(".faq").toggleClass("open");
  });
})();
