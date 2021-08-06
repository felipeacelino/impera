/* =================== CRUD PADRÃO =================== */
(function () {
  "use strict";

  // Variáveis
  const $modal = $("#modal-registro");
  const $modalWrapper = $modal.find(".modal-wrap");
  const $modalForm = $("#form-registro");
  const $modalCampos = $modal.find(".modal-registro-campos");
  const $modalTitulo = $modal.find(".modal-titulo");
  const $modalTexto = $modal.find(".modal-registro-texto");
  const $modalBtn = $modal.find(".modal-btn-ac");
  const $modalAcao = $modal.find("#modal-acao");
  const $modalRegistro = $modal.find("#modal-registro");
  let enviando_formulario = false;

  // Exibe o modal para CADASTRO
  $(".modal-insert").on("click", function (ev) {
    ev.preventDefault();
    openModalInsert($(this));
  });
  function openModalInsert($el) {
    populaModal($el);
    $modalWrapper.removeClass("modal-sm");
    $modalCampos.show();
    openModal("modal-registro");
  }

  // Exibe o modal para EDIÇÃO
  $(".modal-update").on("click", function (ev) {
    ev.preventDefault();
    openModalUpdate($(this));
  });
  function openModalUpdate($el) {
    populaModal($el);
    $modalWrapper.removeClass("modal-sm");
    $modalCampos.show();
    openModal("modal-registro");
  }

  // Exibe o modal para REMOÇÃO
  $(".modal-rem").on("click", function (ev) {
    ev.preventDefault();
    openModalDel($(this));
  });
  function openModalDel($el) {
    populaModal($el);
    $modalWrapper.addClass("modal-sm");
    $modalCampos.hide();
    $modalForm.parsley().destroy();
    openModal("modal-registro");
  }

  // Popula o modal com as informações
  function populaModal($el) {
    $modalTitulo.text($el.data("tit"));
    if ($el.data("text")) {
      $modalTexto.text($el.data("text"));
      $modalTexto.show();
    } else {
      $modalTexto.text("");
      $modalTexto.hide();
    }
    $modalBtn.text($el.data("btn"));
    $modalAcao.val($el.data("acao"));
    if ($el.data("reg")) {
      $modalRegistro.val($el.data("reg"));
    } else {
      $modalRegistro.val($el.data(""));
    }
    resetFormModal();
    if ($el.data("campos")) {
      $.each($el.data("campos"), function (campo, valor) {
        const $campo = $("#" + campo);
        // Datepicker
        if ($campo.hasClass("datepicker")) {
          datepickerInput.setDate(valor);
        }
        // Arquivos
        else if (["arquivo", "arquivo_prev"].indexOf(campo) !== -1) {
          $campo.prop("required", false);
        }
        // Valor
        else if (campo == "valor") {
          $campo.val(formataMoeda(valor));
        }
        // Select2
        else if ($campo.hasClass("select2")) {
          $campo.val(valor).trigger("change").parsley().reset();
        }
        // Demais
        else {
          $campo.val(valor);
        }
      });
    }
  }

  // Reseta os campos do formulário
  function resetFormModal() {
    $modalCampos.find(".campo").each(function () {
      const $campo = $(this);
      if ($campo.hasClass("datepicker")) {
        datepickerInput.setDate("today");
      }
      if ($campo.is("[data-required ]")) {
        $campo.prop("required", true);
      }
      $campo.val("");
    });
    $modalForm.parsley().reset();
  }

  // Processa o formulário
  $modalForm.on("submit", function (ev) {
    ev.preventDefault();

    const obj = this;
    const dados = new FormData(obj);

    if (!enviando_formulario) {
      $.ajax({
        url: $modalForm.attr("action"),
        type: $modalForm.attr("method"),
        data: dados,
        processData: false,
        cache: false,
        contentType: false,
        beforeSend: function () {
          //showLoading();
          enviando_formulario = true;
          $modalBtn.attr("disabled", true);
          $modalBtn.text("Aguarde...");
        },
        success: function (resp) {
          console.log(resp);
          resp = JSON.parse(resp);
          if (resp.status == "success") {
            closeModal("modal-registro");
            showAlert("Sucesso", resp.msg, "success");
          } else {
            closeModal("modal-registro");
            showAlert("Erro", resp.msg, "error");
          }
          setTimeout(() => {
            location.reload();
          }, 2000);
        },
        error: function (xhr, type, exception) {
          closeModal("modal-registro");
          showAlert(
            "Erro",
            "Não foi possível realizar esta operação.",
            "error"
          );
          console.log("ajax error response type " + type);
          setTimeout(() => {
            location.reload();
          }, 2000);
        },
      });
    }
  });
})();
