(function() {
  "use strict";

  function updateNumberPicker() {
    $(".number-picker-input").each(function() {
      const btnSub = $(this).find(".number-picker-sub");
      const btnAdd = $(this).find(".number-picker-add");
      const input = $(this).find("input");
      const min = Number(input.data("min"));
      const max = Number(input.data("max"));
      const qtde = Number(input.val());
      if (!isNaN(min) && qtde === min) {
        btnSub.addClass("disabled");
      } else {
        btnSub.removeClass("disabled");
      }
      if (!isNaN(max) && qtde === max) {
        btnAdd.addClass("disabled");
      } else {
        btnAdd.removeClass("disabled");
      }
    });
  }

  updateNumberPicker();

  $(".number-picker-sub").on("click", function(e) {
    e.preventDefault();
    const input = $($(this).data("target"));
    const min = Number(input.data("min"));
    let qtde = Number(input.val());
    if (isNaN(min) || qtde > min) {
      qtde--;
      input.val(qtde);
      input.trigger("change");
      updateNumberPicker();
    }
  });

  $(".number-picker-add").on("click", function(e) {
    e.preventDefault();
    const input = $($(this).data("target"));
    const max = Number(input.data("max"));
    let qtde = Number(input.val());
    if (isNaN(max) || qtde < max) {
      qtde++;
      input.val(qtde);
      input.trigger("change");
      updateNumberPicker();
    }
  });
})();
