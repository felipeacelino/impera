// Mensagens
(function() {
  "use strict";

  // Exibe a modal de resposta ao clicar no botão de responder
  $(".btn-responder").on("click", function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    var usuario = $(this).data("usuario");
    var data = $(this).data("data");
    var mensagem = $(this).data("msg");
    $("#resposta_id").val(id);
    $("#resposta_usuario").text(usuario);
    $("#resposta_data").text(data);
    $("#resposta_msg").text(mensagem);
    openModal("modal-resposta");
  });

  // Enviar resposta
  var enviando_formulario = false;
  $("#form-resposta").on("submit", function(e) {
    e.preventDefault();
    var obj = this;
    var form = $(obj);
    var dados = new FormData(obj);
    function volta_submit() {
      enviando_formulario = false;
      closeModal("modal-resposta");
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
        beforeSend: function() {
          showLoading();
          enviando_formulario = true;
        },
        success: function(data) {
          //console.log(data);
          volta_submit();
          if (data == "ok") {
            showAlert("Sucesso", "Resposta enviada com sucesso.", "success");
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
        error: function(xhr, type, exception) {
          volta_submit();
          showAlert(
            "Erro",
            "Não foi possível realizar essa operação.",
            "error"
          );
          console.log("ajax error response type " + type);
        }
      });
    }
  });

  // REMOVE Mensagem
  var enviando_formulario = false;
  $("#form-remove-msg").on("submit", function(e) {
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
        beforeSend: function() {
          closeModal("modal-confirm");
          showLoading();
          enviando_formulario = true;
        },
        success: function(data) {
          //console.log(data);
          volta_submit();
          if (data == "ok") {
            $("#id_remove").val("");
            showAlert("Sucesso", "Mensagem removida com sucesso.", "success");
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
        error: function(xhr, type, exception) {
          volta_submit();
          showAlert(
            "Erro",
            "Não foi possível realizar essa operação.",
            "error"
          );
          console.log("ajax error response type " + type);
        }
      });
    }
  });
})();
