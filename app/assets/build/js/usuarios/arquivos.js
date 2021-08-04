/* =================== CADASTRO =================== */
jQuery(document).ready(function ($) {
  var enviando_formulario = false;
  $("#form-arquivo").on("submit", function (e) {
    e.preventDefault();

    var obj = this;
    var form = $(obj);
    var submit_btn = $("#btn-form-arquivo");
    var submit_btn_text = submit_btn.text();
    var dados = new FormData(obj);

    function volta_submit() {
      submit_btn.attr("disabled", false);
      submit_btn.text(submit_btn_text);
      enviando_formulario = false;
      hideLoading();
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
          showLoading();
          enviando_formulario = true;
          submit_btn.attr("disabled", true);
          submit_btn.text("Aguarde...");
        },
        success: function (data) {
          console.log(data);
          var response = $.parseJSON(data);
          if (response.status == "ok") {
            form.find(".campo").val("");
            location.href = response.retorno;
          } else {
            hideLoading();
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

// REMOVER
var enviando_formulario = false;
$("#form-remove-arquivo").on("submit", function (e) {
  e.preventDefault();

  var obj = this;
  var form = $(obj);
  var dados = new FormData(obj);
  var idRemove = $("#id_remove").val();

  function volta_submit() {
    enviando_formulario = false;
    hideLoading();
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
        closeModal("modal-confirm");
        showLoading();
        enviando_formulario = true;
      },
      success: function (data) {
        console.log(data);
        closeModal("modal-confirm");
        if (data == "ok") {
          $("#id_remove").val("");
          volta_submit();
          showAlert("Sucesso", "Arquivo removido com sucesso.", "success");
          //$("#arquivo-" + idRemove).fadeOut();
          setTimeout(() => {
            location.href = $("#retorno_success").val();
          }, 1500);
        } else {
          volta_submit();
          showAlert(
            "Erro",
            "Não foi possível realizar essa operação.",
            "error"
          );
        }
      },
      error: function (xhr, type, exception) {
        volta_submit();
        showAlert("Erro", "Não foi possível realizar essa operação.", "error");
        console.log("ajax error response type " + type);
      },
    });
  }
});

// TIPOS DE DOCUMENTO
(function () {
  "use strict";
  $("#tipo_doc").on("change", tipoDocHandle);
  tipoDocHandle();
  function tipoDocHandle() {
    if ($("#tipo_doc").length > 0) {
      const tipoDoc = $("#tipo_doc").val();
      if (tipoDoc == "9") {
        $(".document-desc-wrp").show();
        $(".document-desc-wrp").find("input").prop("required", true);
        $(".document-desc-wrp").find("input").prop("disabled", false);
      } else {
        $(".document-desc-wrp").hide();
        $(".document-desc-wrp").find("input").prop("required", false);
        $(".document-desc-wrp").find("input").prop("disabled", true);
      }
      if (tipoDoc) {
        $(".campo-icon-help-docs").show();
        $(".campo-icon-help-docs").data("modal", "modal-tipo-doc-" + tipoDoc);
      } else {
        $(".campo-icon-help-docs").hide();
        $(".campo-icon-help-docs").data("modal", "");
      }
    }
  }
})();
