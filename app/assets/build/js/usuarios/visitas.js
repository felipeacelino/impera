(function () {
  "use strict";

  // REAGENDA VISITA
  $("#form-reagenda-visita").on("submit", function (e) {
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
          //console.log(data);
          volta_submit();
          data = JSON.parse(data);
          if (data.status == "ok") {
            $("#id_remove").val("");
            showAlert("Sucesso", "Alteração realizada com sucesso.", "success");
            setTimeout(() => {
              location.reload();
            }, 2000);
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

  // Exibe a confirmação ao clicar para confirmar uma visita
  $(".btn-confirm-vis").on("click", function (e) {
    e.preventDefault();
    var idVisita = $(this).data("id");
    $("#id_confirma").val(idVisita);
    openModal("modal-confirm2");
  });

  // CONFIRMAR
  $("#form-confirmar-visita").on("submit", function (e) {
    e.preventDefault();
    var obj = this;
    var form = $(obj);
    var dados = new FormData(obj);
    var idRemove = $("#id_confirma").val();
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
          closeModal("modal-confirm2");
          showLoading();
          enviando_formulario = true;
        },
        success: function (data) {
          //console.log(data);
          volta_submit();
          data = JSON.parse(data);
          if (data.status == "ok") {
            $("#id_confirma").val("");
            showAlert("Sucesso", "Visita confirmada com sucesso.", "success");
            setTimeout(() => {
              location.reload();
            }, 2000);
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
