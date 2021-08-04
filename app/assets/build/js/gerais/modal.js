/* =================== MODAL =================== */

// Abre o modal
function openModal(modal) {
  $("body").css("overflow", "hidden");
  $("#" + modal).addClass("open");
}

// Fecha o modal
function closeModal(modal) {
  $("body").css("overflow", "auto");
  $("#" + modal).removeClass("open");
}

// Abre o modal de alerta
function showAlert(titulo, mensagem, tipo) {
  $("#modal-alert").removeClass("success warning error");
  $("#modal-alert").addClass(tipo);
  $("#alert-titulo").text(titulo);
  $("#alert-texto").html(mensagem);
  openModal("modal-alert");
}

jQuery(document).ready(function ($) {
  // Abre o modal ao clicar no botão
  $(".modal-open").on("click", function (e) {
    e.preventDefault();
    openModal($(this).data("modal"));
  });

  // Fecha o modal ao clicar no botão
  $(".modal-close").on("click", function (e) {
    e.preventDefault();
    closeModal($(this).data("modal"));
  });

  // Fecha o modal ao clicar em qualquer outro lugar da tela
  $(".modal").on("click", function (e) {
    if (e.target == this && !$(this).hasClass("modal-force")) {
      closeModal($(this).attr("id"));
    }
  });

  // Fecha o modal ao pressionar a tecla ESC
  $(document).on("keyup", function (e) {
    if (e.keyCode == 27) {
      $(".modal.open")
        .not(".modal-force")
        .each(function () {
          closeModal($(this).attr("id"));
        });
    }
  });
});
