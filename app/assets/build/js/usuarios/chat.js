(function () {
  "use strict";

  // Verifica se o chat existe na página
  if ($(".chat").length > 0) {
    initChat();
  }

  // Inicia o chat
  function initChat() {
    $(".gotop").hide();
    scrollToX(".conta-footer");
  }

  $("#chat-anexo").on("change", function () {
    if ($(this).val() != "") {
      $(".chat-input-anexo").addClass("active");
      $("#chat-mensagem").prop("required", false).parsley().reset();
    }
  });

  let enviando_formulario = false;

  // Insert/Update
  $("#chat-form").on("submit", function (e) {
    e.preventDefault();

    var obj = this;
    var form = $(obj);
    var submit_btn = form.find("#chat-btn-send");
    var submit_btn_text = submit_btn.text();
    var dados = new FormData(obj);

    function volta_submit() {
      submit_btn.attr("disabled", false);
      submit_btn.text(submit_btn_text);
      enviando_formulario = false;
      //hideLoading();
    }

    if (!enviando_formulario) {
      $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: dados,
        processData: false,
        cache: false,
        contentType: false,
        beforeSend: function () {
          //showLoading();
          enviando_formulario = true;
          submit_btn.attr("disabled", true);
          submit_btn.text("Enviando...");
        },
        success: function (data) {
          console.log(data);
          volta_submit();
          if (data == "ok") {
            showAlert("Sucesso", "Mensagem enviada com sucesso.", "success");
            setTimeout(() => {
              location.reload();
            }, 2000);
          } else {
            showAlert(
              "Erro",
              "Não foi possível realizar essa operação.",
              "error"
            );
          }
        },
        error: function (xhr, type, exception) {
          volta_submit();
          showAlert(
            "Erro",
            "Não foi possível realizar essa operação.",
            "error"
          );
          console.log("ajax error response type " + type);
        },
      });
    }
  });
})();
