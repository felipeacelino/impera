/* =================== CADASTRO =================== */
jQuery(document).ready(function ($) {
  var enviando_formulario = false;
  $("#form-cadastro").on("submit", function (e) {
    e.preventDefault();

    var obj = this;
    var form = $(obj);
    var submit_btn = $("#cd-cadastrar");
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
          submit_btn.text("Aguarde...");
        },
        success: function (data) {
          console.log(data);
          volta_submit();
          if (data == "ok") {
            window.location.href = $("#cadastro_retorno").val();
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
});