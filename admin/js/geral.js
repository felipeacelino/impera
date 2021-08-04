/* * * * * * * * * * * * * * * * * * * * * * * * * * * ** * * * * * * * *
 *                              FUNÇÕES                                 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * ** * * * * * * * * */

// Valida CPF
function validarCPF(a) {
  if (((a = a.replace(/[^\d]+/g, "")), "" == a)) return !1;
  if (
    11 != a.length ||
    "00000000000" == a ||
    "11111111111" == a ||
    "22222222222" == a ||
    "33333333333" == a ||
    "44444444444" == a ||
    "55555555555" == a ||
    "66666666666" == a ||
    "77777777777" == a ||
    "88888888888" == a ||
    "99999999999" == a
  )
    return !1;
  for (add = 0, i = 0; i < 9; i++) add += parseInt(a.charAt(i)) * (10 - i);
  if (
    ((rev = 11 - (add % 11)),
    (10 != rev && 11 != rev) || (rev = 0),
    rev != parseInt(a.charAt(9)))
  )
    return !1;
  for (add = 0, i = 0; i < 10; i++) add += parseInt(a.charAt(i)) * (11 - i);
  return (
    (rev = 11 - (add % 11)),
    (10 != rev && 11 != rev) || (rev = 0),
    rev == parseInt(a.charAt(10))
  );
}

// Valida CNPJ
function validarCNPJ(a) {
  if ("" == (a = a.replace(/[^\d]+/g, ""))) return !1;
  if (14 != a.length) return !1;
  if (
    "00000000000000" == a ||
    "11111111111111" == a ||
    "22222222222222" == a ||
    "33333333333333" == a ||
    "44444444444444" == a ||
    "55555555555555" == a ||
    "66666666666666" == a ||
    "77777777777777" == a ||
    "88888888888888" == a ||
    "99999999999999" == a
  )
    return !1;
  for (
    tamanho = a.length - 2,
      numeros = a.substring(0, tamanho),
      digitos = a.substring(tamanho),
      soma = 0,
      pos = tamanho - 7,
      i = tamanho;
    i >= 1;
    i--
  )
    (soma += numeros.charAt(tamanho - i) * pos--), pos < 2 && (pos = 9);
  if (
    ((resultado = soma % 11 < 2 ? 0 : 11 - (soma % 11)),
    resultado != digitos.charAt(0))
  )
    return !1;
  for (
    tamanho += 1,
      numeros = a.substring(0, tamanho),
      soma = 0,
      pos = tamanho - 7,
      i = tamanho;
    i >= 1;
    i--
  )
    (soma += numeros.charAt(tamanho - i) * pos--), pos < 2 && (pos = 9);
  return (
    (resultado = soma % 11 < 2 ? 0 : 11 - (soma % 11)),
    resultado == digitos.charAt(1)
  );
}

// Debounce (performance)
debounce = function (n, t, u) {
  var e;
  return function () {
    var i = this,
      o = arguments,
      a = u && !e;
    clearTimeout(e),
      (e = setTimeout(function () {
        (e = null), u || n.apply(i, o);
      }, t)),
      a && n.apply(i, o);
  };
};

// Verifica se o tamanho da tela é menor do que o tamanho passado
function isMobile(screenSize) {
  return $(window).width() < screenSize;
}

// Campos dinamicos
// ------------------------------------
// Campos dinâmicos
// ------------------------------------
(function () {
  "use strict";

  // Desativa o cache do Ajax
  $.ajaxSetup({ cache: false });

  // Campos dinâmicos
  $("[data-sync-input]").each(function () {
    // Variáveis

    // Campo dinâmico
    const $input = $(this);
    // Campo relativo
    const $relativeInput = $($input.data("sync-input"));
    // Parâmetro do campo relativo
    const parentParam = $input.data("sync-param");
    // URL da ação
    let url = `${$input.data("sync-url")}?${parentParam}=`;
    // Valor cadastrado do campo dinâmico (Update)
    const inputValue = $input.data("sync-value");
    // Parâmetro que ficará no atributo "value" de cada "<option>"
    const optionValue = $input.data("sync-option-value");
    // Parâmetro que ficará dentro de cada "<option>"
    const optionText = $input.data("sync-option-text");
    // Placeholder exibido no campo dinâmico, após o carregamento
    const inputPlaceholder = $input.data("sync-placeholder");

    // Carrega o campo dinâmico ao carregar a página
    loadSyncInput();

    // Evento de alteração do campo relativo
    $relativeInput.on("change", loadSyncInput);

    // Carrega o campo dinâmico
    function loadSyncInput() {
      processingSync();
      // Realiza a requisição dos dados
      $.getJSON(`${url}${$relativeInput.val()}`, function (result) {
        console.log(result);
        if (Array.isArray(result) && result.length > 0) {
          populateInput(result);
        } else {
          resetInput();
        }
        //input.trigger('change');
      }).fail(errorInput);
    }

    // Popula o campo dinâmico com os dados retornados
    function populateInput(list) {
      $input.html("");
      changePlaceholder(inputPlaceholder);
      $input.append(`<option value="">Selecione</option>`);
      for (let i = 0, n = list.length; i < n; i++) {
        const selected = inputValue == list[i][optionValue] ? "selected" : "";
        $input.append(
          `<option value="${list[i][optionValue]}" ${selected}>${list[i][optionText]}</option>`
        );
      }
      $input.prop("disabled", false);
    }

    // Ações executadas enquanto a requisição é processada
    function processingSync() {
      $input.prop("disabled", true);
      $input.html("");
      changePlaceholder("Aguarde...");
    }

    // Reseta o campo dinâmico
    function resetInput() {
      $input.html("");
      changePlaceholder(inputPlaceholder);
      $input.prop("disabled", false);
    }

    // Erro na requisição
    function errorInput(resp) {
      console.log(resp);
      resetInput();
    }

    // Altera o placeholder do campo dinâmico
    function changePlaceholder(text) {
      // Select2
      if ($input.hasClass("select2")) {
        $input.append(`<option></option>`);
        setTimeout(() => {
          $(
            `#select2-${$input.attr(
              "id"
            )}-container .select2-selection__placeholder`
          ).text(text);
        });
      }
      // Select Padrão
      else {
        $input.append(`<option value="" hidden>${text}</option>`);
      }
    }
  });
})();

// Completa endereço
function completaEndereco(cep) {
  var cep = cep.toString().replace(/\D/gi, "");
  var endereco = null;
  $.ajax({
    url: "https://viacep.com.br/ws/" + cep + "/json/",
    dataType: "json",
    async: false,
    success: function (data) {
      endereco = data;
    },
  });
  return endereco;
}

$(document).ready(function () {
  /* * * * * * * * * * * * * * * * * * * * * * * * * * * ** * * * * * * * *
   *                             PLUGINS                                  *
   * * * * * * * * * * * * * * * * * * * * * * * * * * ** * * * * * * * * */

  // EZDZ (Preview de imagem)
  $(".ezdz").ezdz({
    text: "Procurar Imagem",
    validators: {
      maxWidth: 9999, //Largura máxima permitida
      maxHeight: 9999, //Altura máxima permitida
      maxSize: 10000000, //Tamanho máximo permitido (10Mb)
    },
    accept: function (file) {
      // Remove a classe de erro
      $("input[type=file].ezdz")
        .parents("div.ezdz-dropzone")
        .removeClass("ezdz-reject");
      $(this).valid();
    },
    reject: function (file, errors) {
      $("input[type=file].ezdz")
        .parents("div.ezdz-dropzone")
        .addClass("ezdz-reject");
      if (errors.mimeType) {
        $(".error-img").text("Selecione uma imagem válida.");
      }
      if (errors.maxSize) {
        $(".error-img").text("Selecione uma imagem de até 10MB.");
      }
      if (errors.maxWidth) {
        $(".error-img").text("A imagem deve ter no máximo 9999px de largura.");
      }
      if (errors.maxHeight) {
        $(".error-img").text("A imagem deve ter no máximo 9999px de altura");
      }
    },
  });

  // Tradução para o pluging 'Datepicker'
  var datepickerLocaleBR = {
    format: "DD/MM/YYYY",
    daysOfWeek: ["D", "S", "T", "Q", "Q", "S", "S"],
    monthNames: [
      "Janeiro",
      "Fevereiro",
      "Março",
      "Abril",
      "Maio",
      "Junho",
      "Julho",
      "Agosto",
      "Setembro",
      "Outubro",
      "Novembro",
      "Dezembro",
    ],
  };

  // Datepicker
  $(".datepicker").daterangepicker({
    singleDatePicker: true,
    locale: datepickerLocaleBR,
  });

  // Datepicker range
  $(".data_range").each(function () {
    var openDirection = $(this).data("popup-direction")
      ? $(this).data("popup-direction")
      : "right";
    $(this).daterangepicker({
      autoUpdateInput: false,
      autoApply: true,
      showDropdowns: false,
      opens: openDirection,
      locale: datepickerLocaleBR,
    });
    $(this).on("apply.daterangepicker", function (ev, picker) {
      $(this).val(
        picker.startDate.format("DD/MM/YYYY") +
          " - " +
          picker.endDate.format("DD/MM/YYYY")
      );
    });
    $(this).on("cancel.daterangepicker", function (ev, picker) {
      $(this).val("");
    });
  });

  // Maskinput
  $(".cnpj").mask("00.000.000/0000-00");
  $(".cnpj_").mask("00.000.000/0000-00");
  $(".cnpj-mask").mask("00.000.000/0000-00");
  $(".cpf").mask("000.000.000-00");
  $(".cpf_").mask("000.000.000-00");
  $(".cpf-mask").mask("000.000.000-00");
  $(".cep").mask("00000-000");
  $(".data").mask("00/00/0000");
  $(".ddd").mask("00");
  $(".telefonexddd").mask("0000-00090");

  //TIPO DO IMOVEL
  function verificaTipoImovel() {
    if ($("#tipo_anuncio").val() == "venda") {
      $(".campo-venda").show();
      $(".campo-temporada").hide();
      $("#estadia_minima").prop("required", false);
      $("#label-vaga").removeClass();
      $("#label-vaga").addClass("control-label col-md-3 col-sm-3 col-xs-1");
    } else if ($("#tipo_anuncio").val() == "temporada") {
      $(".campo-venda").hide();
      $(".campo-temporada").show();
      $("#estadia_minima").prop("required", true);
      $("#label-vaga").removeClass();
      $("#label-vaga").addClass("control-label col-md-2 col-sm-3 col-xs-1");
    } else if ($("#tipo_anuncio").val() == "venda_e_temporada") {
      $(".campo-venda").show();
      $(".campo-temporada").show();
      $("#estadia_minima").prop("required", true);
      $("#label-vaga").removeClass();
      $("#label-vaga").addClass("control-label col-md-2 col-sm-3 col-xs-1");
    }
  }
  verificaTipoImovel();
  $("#tipo_anuncio").on("change", function () {
    verificaTipoImovel();
  });

  // TIPO DE CONTA DO LOCATARIO
  function validaTipoConta() {
    var tipo = $('input[name="tipo_cadastro"]:checked').val();
    if (tipo == "fisica") {
      $(".campo-cnpj").hide();
      //$(".campo-cnpj input").prop("required", false);

      $(".campo-razao").hide();
      //$(".campo-razao input").prop("required", false);
    } else if (tipo == "juridica") {
      $(".campo-cnpj").show();
      //$(".campo-cnpj input").prop("required", true);

      $(".campo-razao").show();
      //$(".campo-razao input").prop("required", true);
    }
  }
  validaTipoConta();
  $('input[name="tipo_cadastro"]').on("change", function () {
    validaTipoConta();
  });

  //GERA LATITUTE E LONGITUDE
  function geraLatLong() {
    var address =
      $("#cidade option:selected").data("estado") +
      "," +
      $("#cidade option:selected").text() +
      "," +
      $("#cep").val() +
      "," +
      $("#destino option:selected").text() +
      ",+BR";
    //console.log(address);
    var apiKey = "AIzaSyC8CZvUJGSaMhW2juYFKMZ44XCwTKdPeq4";
    var url =
      "https://maps.googleapis.com/maps/api/geocode/json?address=" +
      address +
      "&key=" +
      apiKey;
    $.getJSON(url, function (result) {
      if (result.status === "OK") {
        var location = result.results[0].geometry.location;
        var lat = location.lat;
        var lng = location.lng;
        if (lat && lng) {
          $("#latitude").val(lat);
          $("#longitude").val(lng);
        }
      }
    });
  }

  $(".gera-lat-long").on("change", function (e) {
    e.preventDefault();
    geraLatLong();
  });

  // Number Picker
  (function () {
    "use strict";

    function updateNumberPicker() {
      $(".number-picker-input").each(function () {
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

    $(".number-picker-sub").on("click", function (e) {
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

    $(".number-picker-add").on("click", function (e) {
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

  // TELEFONE
  var telefoneSP = function (val) {
      return val.replace(/\D/g, "").length === 11
        ? "(00) 00000-0000"
        : "(00) 0000-00009";
    },
    spOptions = {
      onKeyPress: function (val, e, field, options) {
        field.mask(telefoneSP.apply({}, arguments), options);
      },
    };
  $(".telefone").mask(telefoneSP, spOptions);

  var cpfCnpj = function (val) {
      return val.length > 14 ? "00.000.000/0000-00" : "000.000.000-009";
    },
    optionsDocumento = {
      onKeyPress: function (val, e, field, options) {
        field.mask(cpfCnpj(val), options);
      },
    };
  $(".cpf-cnpj").mask(cpfCnpj, optionsDocumento);

  // Maskmoney
  $(".valor").maskMoney({
    thousands: ".", // Separador milhar
    decimal: ",", // Separador decimal
    allowNegative: false, // Impede valores negativos
  });

  // Switch (Checkbox)
  function switchChange() {
    $(".switch").each(function () {
      if ($(this).is(":checked")) {
        $(this)
          .siblings(".switch-label")
          .text($(this).data("label-true"))
          .css("color", "#64BD63");
      } else {
        $(this)
          .siblings(".switch-label")
          .text($(this).data("label-false"))
          .css("color", "#FA6C6C");
      }
    });
  }
  switchChange();
  function switchChangePersonalizado() {
    $(".switch_personalizado").each(function () {
      if ($(this).is(":checked")) {
        $(this)
          .siblings(".switch-label")
          .text($(this).data("label-true"))
          .css("color", "#64BD63");
      } else {
        $(this)
          .siblings(".switch-label")
          .text($(this).data("label-false"))
          .css("color", "#42A5F5");
      }
    });
  }
  switchChangePersonalizado();
  var switcheryEles = document.querySelectorAll(".switch");
  for (var i = 0; i < switcheryEles.length; i++) {
    var switchery = new Switchery(switcheryEles[i], {
      color: "#64BD63", // TRUE
      secondaryColor: "#FA6C6C", // FALSE
      jackColor: "#FFF", // TRUE
      jackSecondaryColor: "#FFF", // FALSE
    });
  }
  var switcheryEles = document.querySelectorAll(".switch_personalizado");
  for (var i = 0; i < switcheryEles.length; i++) {
    var switchery = new Switchery(switcheryEles[i], {
      color: "#64BD63", // TRUE
      secondaryColor: "#42A5F5", // FALSE
      jackColor: "#FFF", // TRUE
      jackSecondaryColor: "#FFF", // FALSE
    });
  }
  $(".switch").on("change", function (e) {
    switchChange();
  });
  $(".switch_personalizado").on("change", function (e) {
    switchChangePersonalizado();
  });

  // Copiar
  $(".copiar-link").tooltip({
    trigger: "click",
    placement: "bottom",
  });
  function setTooltip(btn, message) {
    $(btn).tooltip("hide").attr("data-original-title", message).tooltip("show");
  }
  function hideTooltip(btn) {
    setTimeout(function () {
      $(btn).tooltip("hide");
    }, 1000);
  }
  var clipboard = new Clipboard(".copiar-link");
  clipboard.on("success", function (e) {
    setTooltip(e.trigger, "Copiado!");
    hideTooltip(e.trigger);
  });

  // Seleciona vários
  $("#selecctall").on("change", function () {
    if ($("#selecctall").is(":checked")) {
      $(".checkbox1").each(function () {
        $(".checkbox1").prop("checked", true);
      });
      $("#selecctall_lbl").html("Desmarcar todas");
      $("#confere").val(true);
    } else {
      $(".checkbox1").each(function () {
        $(".checkbox1").prop("checked", false);
      });
      $("#selecctall_lbl").html("Selecionar todas");
      $("#confere").val(false);
    }
  });
  $(".checkbox1").on("change", function () {
    var ver = $(".checkbox1").is(":checked");
    $("#confere").val(ver);
  });

  // Confirma a ação dos multiplos campos
  $("#btn-multiplo").on("click", function () {
    $("#form_acao").submit();
  });

  // Ação dos multiplos campos
  $(".acao-multiplos").on("click", function () {
    var acao = $(this).data("acao");
    var preenchido = $("#confere").val();

    // Remover
    if (acao == "remover") {
      if (preenchido == "true") {
        $("#titulo-modal-multiplo").html("Remover itens");
        $("#texto-modal-multiplo").html(
          "Deseja remover todos os itens selecionados?"
        );
        $("#btn-multiplo").attr("class", "btn btn-danger");
        $("#btn-multiplo").html("Remover");
        $("#modal-multiplo").modal("show");
        $("#form_acao").attr("action", url_pag_atual);
        $("#acao_exec").val("6");
      } else {
        $("#acao").val("");
        $("#modal-alerta").modal("show");
      }

      // Ativar
    } else if (acao == "status_1") {
      if (preenchido == "true") {
        $("#titulo-modal-multiplo").html("Ativar itens");
        $("#texto-modal-multiplo").html(
          "Deseja ativar todos os itens selecionados?"
        );
        $("#btn-multiplo").attr("class", "btn btn-success");
        $("#btn-multiplo").html("Ativar");
        $("#modal-multiplo").modal("show");
        $("#form_acao").attr("action", url_pag_atual);
        $("#status").val("1");
        $("#campo").val("status");
        $("#acao_exec").val("5");
      } else {
        $("#acao").val("");
        $("#modal-alerta").modal("show");
      }

      // Desativar
    } else if (acao == "status_0") {
      if (preenchido == "true") {
        $("#titulo-modal-multiplo").html("Desativar itens");
        $("#texto-modal-multiplo").html(
          "Deseja desativar todos os itens selecionados?"
        );
        $("#btn-multiplo").attr("class", "btn btn-warning");
        $("#btn-multiplo").html("Desativar");
        $("#modal-multiplo").modal("show");
        $("#form_acao").attr("action", url_pag_atual);
        $("#status").val("0");
        $("#campo").val("status");
        $("#acao_exec").val("5");
      } else {
        $("#acao").val("");
        $("#modal-alerta").modal("show");
      }
    } else if (acao == "status_2") {
      if (preenchido == "true") {
        $("#titulo-modal-multiplo").html("Deixar pendente");
        $("#texto-modal-multiplo").html(
          "Deseja deixar pendente todos os itens selecionados?"
        );
        $("#btn-multiplo").attr("class", "btn btn-warning");
        $("#btn-multiplo").html("Pendente");
        $("#modal-multiplo").modal("show");
        $("#form_acao").attr("action", url_pag_atual);
        $("#status").val("2");
        $("#campo").val("status");
        $("#acao_exec").val("5");
      } else {
        $("#acao").val("");
        $("#modal-alerta").modal("show");
      }
    } else if (acao == "status_3") {
      if (preenchido == "true") {
        $("#titulo-modal-multiplo").html("Atender itens");
        $("#texto-modal-multiplo").html(
          "Deseja atender todos os itens selecionados?"
        );
        $("#btn-multiplo").attr("class", "btn btn-warning");
        $("#btn-multiplo").html("Atender");
        $("#modal-multiplo").modal("show");
        $("#form_acao").attr("action", url_pag_atual);
        $("#status").val("3");
        $("#campo").val("status");
        $("#acao_exec").val("5");
      } else {
        $("#acao").val("");
        $("#modal-alerta").modal("show");
      }
    } else if (acao == "status_atendimento_1") {
      if (preenchido == "true") {
        $("#titulo-modal-multiplo").html("Atender itens");
        $("#texto-modal-multiplo").html(
          "Deseja atender todos os itens selecionados?"
        );
        $("#btn-multiplo").attr("class", "btn btn-success");
        $("#btn-multiplo").html("Atender");
        $("#modal-multiplo").modal("show");
        $("#form_acao").attr("action", url_pag_atual);
        $("#status").val("1");
        $("#campo").val("status_atendimento");
        $("#acao_exec").val("5");
      } else {
        $("#acao").val("");
        $("#modal-alerta").modal("show");
      }
    } else if (acao == "status_atendimento_0") {
      if (preenchido == "true") {
        $("#titulo-modal-multiplo").html("Remover atendimento dos itens");
        $("#texto-modal-multiplo").html(
          "Deseja remover atendimento de todos os itens selecionados?"
        );
        $("#btn-multiplo").attr("class", "btn btn-warning");
        $("#btn-multiplo").html("Tirar atendimento");
        $("#modal-multiplo").modal("show");
        $("#form_acao").attr("action", url_pag_atual);
        $("#status").val("0");
        $("#campo").val("status_atendimento");
        $("#acao_exec").val("5");
      } else {
        $("#acao").val("");
        $("#modal-alerta").modal("show");
      }
    }
  });

  // Remover registro
  $(".btn-remove").on("click", function (e) {
    e.preventDefault();
    var idDel = $(this).data("iddel");
    $("#id_remove").val(idDel);
    $("#modal-remove").modal("show");
  });

  // Remover anexo
  $(".btn-remove-anexo").on("click", function (e) {
    e.preventDefault();
    var idDel = $(this).data("iddel");
    $("#id_remove_anexo").val(idDel);
    $("#modal-remove-anexo").modal("show");
  });

  // Ordernação
  $(".acao-ordenar").on("click", function (e) {
    e.preventDefault();
    var ordem = $(this).data("ordem");
    $("#sort_ordem").val(ordem);
    $("#form-ordem").submit();
  });
  $('.acao-ordenar[data-ordem="' + $("#sort_ordem").val() + '"]').addClass(
    "active"
  );

  // Table responsiva
  var limitHeight = 50;
  function hideTd(td) {
    td.data("height", td.height());
    td.height(limitHeight);
    td.children(".tr-btn")
      .removeClass("tr-btn-hide")
      .addClass("tr-btn-show")
      .off("click")
      .on("click", function () {
        showTd(td);
      });
  }
  function showTd(td) {
    td.height(td.data("height"));
    td.children(".tr-btn")
      .removeClass("tr-btn-show")
      .addClass("tr-btn-hide")
      .off("click")
      .on("click", function () {
        hideTd(td);
      });
  }
  $("table tr td.tr-lg-txt").each(function () {
    if ($(this).height() > limitHeight) {
      $(this).data("height", $(this).height());
      $(this).height(limitHeight);
      $(this).append('<a class="tr-btn tr-btn-show"></a>');
    }
  });
  $(".tr-btn-show").on("click", function () {
    showTd($(this).parent());
  });

  // Mensagem retorno
  setTimeout(function () {
    $("#divclean").load(url_script + "acoes/admin/geral/remove_session.php");
  }, 500);

  // Contador de caracter
  $("textarea[data-rule-maxlength]").each(function () {
    var limite = $(this).attr("data-rule-maxlength"),
      count = $(this).val().length;

    $(this).after('<span class="caracter_count"></span>');
    countEle = $(this).next(".caracter_count");
    countEle.text(count + "/" + limite);

    $(this).on("keyup keydown keypress", function () {
      count = $(this).val().length;
      countEle.text(count + "/" + limite);
    });
  });

  // Ações dos botões do formulário
  $("#bt1").on("click", function (event) {
    nome_acao = $("#bt1").val();
    $("#retorno").val(nome_acao);
  });
  $("#bt2").on("click", function (event) {
    nome_acao = $("#bt2").val();
    $("#retorno").val(nome_acao);
  });

  // Filtros
  $("#exibe_filtros").on("click", function (e) {
    e.preventDefault();
    $("#filtros").toggleClass("open");
    $(".filtros-container").slideToggle();
  });
  $(".campo-filtro .form-control").each(function () {
    if ($(this).val() != "") {
      $(this).css({
        border: "1px solid #999",
      });
      $("#filtros").addClass("open");
      $(".filtros-container").slideDown();
    }
  });
  $(".campo-filtro .campos_busca").each(function () {
    var valueFiltros = $(this).find("option:selected").text();
    if (valueFiltros != "") {
      $(this).css({
        border: "1px solid #999",
      });
      $("#filtros").addClass("open");
      $(".filtros-container").slideDown();
    }
  });

  // CLIPBOARD
  var clipboard = new Clipboard(".clipboard-btn");

  // TAGS INPUT
  if ($(".tags").length > 0) {
    $(".tags").each(function () {
      $(this).tagsInput({
        width: "auto",
        height: "100px",
        interactive: true,
        defaultText: "Add tag",
        delimiter: [",", ";"],
        removeWithBackspace: true,
        minChars: 0,
        maxChars: 0,
        placeholderColor: "#666666",
      });
    });
  }

  // TAGS DESTINOS
  if ($(".tags-destino").length > 0) {
    $(".tags-destino").each(function () {
      $(this).tagsInput({
        width: "auto",
        height: "100px",
        interactive: true,
        defaultText: "Add +",
        delimiter: [",", ";"],
        removeWithBackspace: true,
        minChars: 0,
        maxChars: 0,
        placeholderColor: "#666666",
      });
    });
  }

  // ALTERA ORDEM DE EXIBIÇÃO
  $(".select_ordem").on("change", function () {
    var tab = $("#tabela_atual").val();
    var id = $(this).val().split("|")[0];
    var atual = $(this).val().split("|")[1];
    var nova = $(this).val().split("|")[2];
    var idadc = $(this).val().split("|")[3];
    var retorno = $('input[name="retorno"]').val();

    idadc = idadc ? idadc : "";

    location.href =
      url_script +
      "acoes/admin/geral/altera_ordem_exibicao.php?tab=" +
      tab +
      "&id=" +
      id +
      "&idadc=" +
      idadc +
      "&atual=" +
      atual +
      "&nova=" +
      nova +
      "&r=" +
      retorno;
  });

  function isMobileX(screenSize) {
    return $(window).width() < screenSize;
  }

  /* INDISPONIVEIS */
  url_consulta_datas = "";
  // Carrega campos datas
  if (pag_atual == "anuncios_reservas") {
    url_consulta_datas =
      url_script +
      "acoes/admin/anuncios/retorna_datas_editar_reserva.php?anuncio_id=" +
      $("#anuncio_id").val() +
      "&reserva_id=" +
      $("#id").val();
  }
  if (pag_atual == "anuncios_datas_indisponiveis") {
    url_consulta_datas =
      url_script +
      "acoes/admin/anuncios/retorna_datas_indisponiveis.php?anuncio_id=" +
      $("#anuncio_id").val();
  }
  if (url_consulta_datas != "") {
    $.ajax({
      url: url_consulta_datas,
      processData: false,
      cache: false,
      async: true,
      contentType: false,
      success: function (data) {
        var data = $.parseJSON(data);
        $(".flatpickr-calendar").remove();
        $(".datas_indisponiveis").remove();
        $(".campo-calendario").append(
          '<input name="datas_indisponiveis" id="datas_indisponiveis" class="datas_indisponiveis" type="text value="" data-reservas="">'
        );
        $(".campo-calendario #datas_indisponiveis").val(
          data.datas_indisponiveis
        );
        $(".campo-calendario #datas_indisponiveis").data(
          "reservas",
          data.datas_indisponiveis_reservas
        );
        carregaDatasIndisponiveis(pag_atual);
        $(".segura-campos-pacote").show("slow");
      },
    });
  }

  // Datas Indisponíveis
  function carregaDatasIndisponiveis(pag_atual) {
    "use strict";
    if ($(".campo-calendario #datas_indisponiveis").length > 0) {
      let modoCalendario;
      if (pag_atual == "anuncios_reservas") {
        modoCalendario = "multiple";
      }
      if (pag_atual == "anuncios_datas_indisponiveis") {
        modoCalendario = "range";
      }
      const showMonths = isMobileX(800) ? 1 : 2;
      // Reservas e Pré-reservas
      const disablesDates = $(".campo-calendario #datas_indisponiveis")
        .data("reservas")
        .split(", ");
      $(".campo-calendario #datas_indisponiveis").flatpickr({
        dateFormat: "d/m/Y",
        disableMobile: "true",
        mode: modoCalendario,
        inline: true,
        showMonths: showMonths,
        disable: disablesDates,
        onReady: function (dateObj, dateStr, instance) {
          instance.jumpToDate(new Date());
        },
        onDayCreate: function (dObj, dStr, fp, dayElem) {
          var dataObj = dayElem.dateObj;
          var dia =
            dataObj.getDate() < 10
              ? "0" + dataObj.getDate()
              : dataObj.getDate();
          var mes = dataObj.getMonth() + 1;
          var mes = mes < 10 ? "0" + mes : mes;
          var ano = dataObj.getFullYear();
          var data = dia + "/" + mes + "/" + ano;
          if (disablesDates.indexOf(data) !== -1) {
            dayElem.className += " indisponivel";
          }
        },
        locale: {
          weekdays: {
            shorthand: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
            longhand: [
              "Domingo",
              "Segunda-feira",
              "Terça-feira",
              "Quarta-feira",
              "Quinta-feira",
              "Sexta-feira",
              "Sábado",
            ],
          },
          months: {
            shorthand: [
              "Jan",
              "Fev",
              "Mar",
              "Abr",
              "Mai",
              "Jun",
              "Jul",
              "Ago",
              "Set",
              "Out",
              "Nov",
              "Dez",
            ],
            longhand: [
              "Janeiro",
              "Fevereiro",
              "Março",
              "Abril",
              "Maio",
              "Junho",
              "Julho",
              "Agosto",
              "Setembro",
              "Outubro",
              "Novembro",
              "Dezembro",
            ],
          },
          rangeSeparator: " até ",
        },
      });
    }
  }
});

// CHAT
(function () {
  "use strict";

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
            setTimeout(() => {
              location.reload();
            }, 1000);
          } else {
            alert("Não foi possível realizar essa operação.");
          }
        },
        error: function (xhr, type, exception) {
          volta_submit();
          alert("Não foi possível realizar essa operação.");
          console.log("ajax error response type " + type);
        },
      });
    }
  });
})();
