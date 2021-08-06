/* =================== MINHA CONTA =================== */
jQuery(document).ready(function ($) {
  // Abre o modal de recuperaçao de senha
  $(".link-rec").on("click", function (e) {
    e.preventDefault();
    closeModal("modal-login");
    openModal("modal-recuperacao");
  });

  // Abre o modal de cadastro
  $(".open-cadastro").on("click", function (e) {
    e.preventDefault();
    const tipo = $(this).data("tipo");
    if (tipo) {
      $("#login-tipo").val(tipo);
      $("#cadastro-tipo").val(tipo);
    }
    closeModal("modal-login");
    openModal("modal-cadastro");
  });

  // Abre o modal de login
  $(".open-login").on("click", function (e) {
    e.preventDefault();
    const tipo = $(this).data("tipo");
    if (tipo) {
      $("#login-tipo").val(tipo);
      $("#cadastro-tipo").val(tipo);
    }
    closeModal("modal-cadastro");
    openModal("modal-login");
  });

  // Exibe a confirmação ao clicar no botão de remover
  $(".btn-confirm").on("click", function (e) {
    e.preventDefault();
    var idRemove = $(this).data("id");
    $("#id_remove").val(idRemove);
    openModal("modal-confirm");
  });

  // Exibe a confirmação ao clicar no botão de duplicar
  $(".btn-duplicar").on("click", function (e) {
    e.preventDefault();
    var idAnuncio = $(this).data("id");
    $("#id_duplica").val(idAnuncio);
    openModal("modal-confirm2");
  });

  // Exibe a confirmação ao clicar no botão de cancelar plano
  $(".btn-cancela").on("click", function (e) {
    e.preventDefault();
    var idCancela = $(this).data("id");
    $("#id_cancela").val(idCancela);
    openModal("modal-cancelar");
  });

  // TIPO DE CONTA DO LOCATARIO
  function validaTipoConta() {
    var tipo = $('input[name="tipo_cadastro"]:checked').val();
    if (tipo == "fisica") {
      $(".campo-cnpj").hide();
      $(".campo-cnpj input").prop("required", false);

      $(".campo-razao").hide();
      $(".campo-razao input").prop("required", false);
    } else if (tipo == "juridica") {
      $(".campo-cnpj").show();
      $(".campo-cnpj input").prop("required", true);

      $(".campo-razao").show();
      $(".campo-razao input").prop("required", true);
    }
  }
  validaTipoConta();
  $('input[name="tipo_cadastro"]').on("change", function () {
    validaTipoConta();
  });

  // Exibe/Oculta os campos da forma de pagamento escolhida
  $('input[name="forma-pagamento"]').on("change", function () {
    $(".forma-pag-content").slideUp();
    $(".forma-pag-content .campo").prop("disabled", true);
    $(".forma-pag-content .campo").prop("required", false);

    $('.forma-pag-content[data-forma="' + $(this).val() + '"]').slideDown();
    $('.forma-pag-content[data-forma="' + $(this).val() + '"] .campo').prop(
      "disabled",
      false
    );
    $('.forma-pag-content[data-forma="' + $(this).val() + '"] .campo').prop(
      "required",
      true
    );
  });

  // TERMOS (LOCATARIOS E PROPRIETARIOS)
  $(".botao-gera-contrato").show();
  $(".escolha-contrato-proprietario").on("change", function () {
    if ($(this).find("option:selected").data("termo") != 1) {
      openModal("modal-termo-" + $(this).val());
      $(".botao-gera-contrato").hide();
    } else {
      $(".botao-gera-contrato").show();
    }
  });
  $(".refresh-button-contrato").on("click", function () {
    $(".botao-gera-contrato").show();
  });
  $(".refresh-pag").on("click", function () {
    location.reload();
  });
  $(".check-termos").on("click", function () {
    let url_contrato = $(this).data("reload");
    $.ajax({
      url: $(this).data("url"),
      beforeSend: function () {
        showLoading();
      },
      success: function (data) {
        console.log(data);
        if (data == "ok") {
          location.href = url_contrato;
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
        showAlert("Erro", "Não foi possível realizar essa operação.", "error");
        console.log("ajax error response type " + type);
      },
    });
  });
});

// Menu lateral
(function () {
  "use strict";
  handleItemActive();
  function handleItemActive() {
    $(".conta-lateral-menu li.active").prev().addClass("top");
    $(".conta-lateral-menu li.active").next().addClass("bottom");
  }
})();

// Modal link restrito
$(".btn-modal-restrito").on("click", function (ev) {
  ev.preventDefault();

  const $btn = $(this);
  const $modal = $("#modal-user-restrito");

  if ($modal.find(".btn-cliente").data("logado") > 0) {
    $modal.find(".btn-cliente").attr("href", $btn.data("cliente"));
  } else {
    $modal
      .find(".btn-cliente")
      .attr(
        "href",
        url_base + "cliente/entrar?retorno=" + $btn.data("cliente")
      );
  }

  if ($modal.find(".btn-proprietario").data("logado") > 0) {
    $modal.find(".btn-proprietario").attr("href", $btn.data("proprietario"));
  } else {
    $modal
      .find(".btn-proprietario")
      .attr(
        "href",
        url_base + "proprietario/entrar?retorno=" + $btn.data("proprietario")
      );
  }

  if ($modal.find(".btn-corretor").data("logado") > 0) {
    $modal.find(".btn-corretor").attr("href", $btn.data("corretor"));
  } else {
    $modal
      .find(".btn-corretor")
      .attr(
        "href",
        url_base + "corretor/entrar?retorno=" + $btn.data("corretor")
      );
  }

  if ($modal.find(".btn-afiliado").data("logado") > 0) {
    $modal.find(".btn-afiliado").attr("href", $btn.data("afiliado"));
  } else {
    $modal
      .find(".btn-afiliado")
      .attr(
        "href",
        url_base + "afiliado/entrar?retorno=" + $btn.data("afiliado")
      );
  }

  openModal("modal-user-restrito");
});

// Link restrito
$(".link-restrito").on("click", function (ev) {
  ev.preventDefault();
  const $link = $(this);
  const linkArea = $link.data("area");
  const linkUrl = $link.attr("href");
  let logado = $link.data("logado");
  if (logado > 0) {
    location.href = linkUrl;
  } else {
    location.href = url_base + linkArea + "/entrar?retorno=" + linkUrl;
  }
});

// Regiões de atuação
$('input[name="atuacao[]"]').on("change", handleRegioesAtuacao);
if ($('input[name="atuacao[]"]').length > 0) {
  handleRegioesAtuacao();
}
function handleRegioesAtuacao() {
  if (
    $('input[name="atuacao[]"][value="avulso"]').is(":checked") ||
    $('input[name="atuacao[]"][value="locacao"]').is(":checked")
  ) {
    $(".regioes1").show();
    $(".regioes1").find("input").prop("disabled", false).prop("required", true);
  } else {
    $(".regioes1").hide();
    $(".regioes1").find("input").prop("disabled", true).prop("required", false);
  }
  if ($('input[name="atuacao[]"][value="planta"]').is(":checked")) {
    $(".regioes2").show();
    $(".regioes2").find("input").prop("disabled", false).prop("required", true);
  } else {
    $(".regioes2").hide();
    $(".regioes2").find("input").prop("disabled", true).prop("required", false);
  }
}

// Leads
$(".status-lead").on("change", handleStatusLead);
function handleStatusLead() {
  const statusLead = $(".status-lead").val();
  if (statusLead == "1") {
    $(".sem-interesse").hide();
    $(".com-interesse").show();
    $(".sem-interesse")
      .find("input, select")
      .prop("disabled", true)
      .prop("required", false);
    $(".com-interesse").find("input, select").prop("disabled", false);
    $(".com-interesse")
      .find("input[data-required], select[data-required]")
      .prop("required", true);
  } else if (statusLead == "0") {
    $(".sem-interesse").show();
    $(".com-interesse").hide();
    $(".sem-interesse").find("input, select").prop("disabled", false);
    $(".sem-interesse")
      .find("input[data-required], select[data-required]")
      .prop("required", true);
    $(".com-interesse")
      .find("input, select")
      .prop("disabled", true)
      .prop("required", false);
  } else {
    $(".sem-interesse").hide();
    $(".com-interesse").hide();
    $(".sem-interesse")
      .find("input, select")
      .prop("disabled", true)
      .prop("required", false);
    $(".com-interesse")
      .find("input, select")
      .prop("disabled", true)
      .prop("required", false);
  }
}

// Copia o link de afiliados
$(".btn-copy-link").on("click", function (ev) {
  ev.preventDefault();
  copyToClipboard($("#link-afiliado").val());
  closeModal("modal-link-afiliado");
  showAlert(
    "Copiado!",
    "Seu link de afiliado foi copiado, agora você já pode compartilhar com seus clientes e proprietários.",
    "success"
  );
});
