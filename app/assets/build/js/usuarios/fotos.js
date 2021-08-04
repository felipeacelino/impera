(function () {
  "use strict";

  // CADASTRAR / EDITAR
  if ($("#dzupload-fotos").length > 0) {
    Dropzone.autoDiscover = false;

    var dzupload = $("#dzupload-fotos");
    var form = $("#form-fotos");
    var btn = $("#cad-fotos");
    var urlForm = form.attr("action");
    var maxFile = dzupload.data("maxfile");
    var maxSize = dzupload.data("maxsize");
    var required = dzupload.data("required") == "sim" ? true : false;
    dzupload.dropzone({
      url: urlForm,
      uploadMultiple: true,
      autoProcessQueue: false,
      parallelUploads: 100,
      timeout: 90000,
      paramName: "fotos",
      maxFilesize: 2048,
      maxFiles: maxFile,
      acceptedFiles: "image/*",
      addRemoveLinks: true,
      dictDefaultMessage: "Clique ou arraste para carregar as fotos",
      dictRemoveFile: "Remover",
      dictFileTooBig:
        "O tamanho do arquivo selecionado é maior do que o limite de <b>" +
        maxSize +
        "Mb</b>",
      dictInvalidFileType: "Tipo de arquivo inválido",
      dictMaxFilesExceeded: "Selecione no máximo <b>" + maxFile + "</b> fotos",
      dictResponseError: "server_error",

      init: function () {
        var myDropzone = this;

        // Evento ao clicar no botão de cadastrar/atualizar
        btn.on("click", function (e) {
          e.preventDefault();
          e.stopPropagation();

          // Valida o formulário
          if (form.parsley().validate()) {
            // Verifica se alguma imagem foi selecionada
            if (myDropzone.files.length > 0) {
              // Envia o formulário
              myDropzone.processQueue();
            } else {
              $(".dz-msg-error").html(
                "É necessário cadastrar pelo menos uma foto."
              );
              scrollToX(".dz-msg-error");
            }
          }
        });

        // Envio sendo processado
        myDropzone.on("sendingmultiple", function (file, xhr, formData) {
          // Resgata os dados do formulário
          var data = form.serializeArray();
          for (var i = 0; i < data.length; i++) {
            formData.append(data[i].name, data[i].value);
          }
          showLoading();
        });

        // Sucesso
        myDropzone.on("successmultiple", function (files, response) {
          console.log(response);
          response = JSON.parse(response);
          if (response.status == "ok") {
            hideLoading();
            showAlert("Sucesso", "Fotos cadastradas com sucesso.", "success");
            setTimeout(() => {
              location.reload();
            }, 1500);
          } else {
            hideLoading();
            showAlert(
              "Erro",
              "Não foi possível realizar essa operação.",
              "error"
            );
          }
        });

        // Erro
        myDropzone.on("error", function (file, response) {
          console.log(response);
          myDropzone.removeFile(file);
          $(".dz-msg-error").html(response);
          scrollToX(".dz-msg-error");
          hideLoading();
          if (response == "server_error") {
            showAlert(
              "Erro",
              "Não foi possível realizar essa operação.",
              "error"
            );
          }
        });

        // Evento quando um arquivo é adicionado
        myDropzone.on("addedfile", function () {
          $(".dz-msg-error").html("");
          btn.parent(".btn-container").show();
        });

        // Evento quando um arquivo é removido
        myDropzone.on("removedfile", function () {
          if (!myDropzone.files.length) {
            btn.parent(".btn-container").hide();
          }
        });
      },
    });

    $(".btn-concluir-fotos").on("click", function (ev) {
      ev.preventDefault();
      const acao = $(this).data("acao");
      const totalImg = $(".form-fotos li").length;
      //if (acao == "insert" && totalImg == 0) {
      //if (totalImg == 0) {
      if (totalImg < 5) {
        /* showAlert(
          "Atenção",
          'É necessário cadastrar pelo menos uma foto do seu imóvel. Selecione as fotos e clique no botão "Cadastrar Fotos".',
          "warning"
        ); */
        showAlert(
          "Atenção",
          'É necessário cadastrar pelo menos <b>5 fotos</b> do seu imóvel. Selecione as fotos e clique no botão "Cadastrar Fotos".',
          "warning"
        );
        return false;
      } else {
        showLoading();
        location.href = $(this).attr("href");
      }
    });
  }

  // Exibe a confirmação ao clicar no botão tornar foto destaque
  $(".btn-dest").on("click", function (e) {
    e.preventDefault();
    var idDestaque = $(this).data("id");
    $("#id_destaque").val(idDestaque);
    openModal("modal-confirm2");
  });

  // REMOVE FOTO
  var enviando_formulario = false;
  $("#form-remove-foto").on("submit", function (e) {
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
            showAlert("Sucesso", "Foto removida com sucesso.", "success");
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

  // UPDATE FOTO
  var enviando_formulario = false;
  $("#form-update-foto").on("submit", function (e) {
    e.preventDefault();
    var obj = this;
    var form = $(obj);
    var dados = new FormData(obj);
    var idAtualiza = $("#id_destaque").val();
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
            $("#id_destaque").val("");
            showAlert("Sucesso", "Ação realizada com sucesso.", "success");
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

// ORDEM DE EXIBIÇÃO
(function () {
  "use strict";
  if ($(".ordena-fotos-lista").length > 0) {
    new Sortable($(".ordena-fotos-lista")[0], {
      handle: "figure",
      animation: 150,
      forceFallback: true,
      onStart: function () {
        $("body").addClass("grabbing");
        this._currentOrder = this.toArray();
      },
      onEnd: function () {
        $("body").removeClass("grabbing");
      },
      onUpdate: function (ev) {
        const instance = this;
        const order = instance.toArray();
        instance.option("disabled", true);
        $.ajax({
          url:
            url_base + "acoes/app/proprietario/altera_ordem_exibicao_fotos.php",
          type: "POST",
          data: {
            ordem: order,
          },
          success: function (data) {
            console.log(data);
            instance.option("disabled", false);
            if (data == "ok") {
              console.log("Ordem alterada com sucesso.");
            } else {
              instance.sort(instance._currentOrder);
              showAlert(
                "Erro",
                "Não foi possível realizar essa operação.",
                "error"
              );
            }
          },
          error: function (request, status, error) {
            console.log(request.responseText);
            instance.option("disabled", false);
            instance.sort(instance._currentOrder);
            showAlert(
              "Erro",
              "Não foi possível realizar essa operação.",
              "error"
            );
          },
        });
      },
    });
  }
})();
