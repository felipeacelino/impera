(function () {
  "use strict";

  $(".radio-box-item input").parsley({
    classHandler: function (el) {
      return el.$element.closest(".campo-container");
    },
    errorsContainer: function (el) {
      return el.$element.closest(".campo-container");
    },
  });

  $(".show-modal-agendamento-cliente").on("click", function (ev) {
    ev.preventDefault();
    showModalAgCliente($(this));
  });
  $(".show-modal-agendamento-corretor").on("click", function (ev) {
    ev.preventDefault();
    showModalAgCorretor($(this));
  });

  function showModalAgCliente($btn) {
    $('label[for="ag-nome"]').text("Nome completo");
    $("#ag-nome")
      .attr("placeholder", "Digite seu nome completo")
      .val($btn.data("nome"));
    $('label[for="ag-email"]').text("E-mail");
    $("#ag-email")
      .attr("placeholder", "Digite seu e-mail")
      .val($btn.data("email"));
    $('label[for="ag-telefone"]').text("Telefone");
    $("#ag-telefone")
      .attr("placeholder", "Digite seu telefone")
      .val($btn.data("telefone"));
    $("#ag-cliente").val($btn.data("cliente"));
    $("#form-agendamento").parsley().reset();
    openModal("modal-det-agendamento");
  }
  function showModalAgCorretor($btn) {
    $('label[for="ag-nome"]').text("Nome completo do cliente");
    $("#ag-nome")
      .attr("placeholder", "Digite o nome completo do cliente")
      .val("");
    $('label[for="ag-email"]').text("E-mail do cliente");
    $("#ag-email").attr("placeholder", "Digite o e-mail do cliente").val("");
    $('label[for="ag-telefone"]').text("Telefone do cliente");
    $("#ag-telefone")
      .attr("placeholder", "Digite o telefone do cliente")
      .val("");
    $("#ag-corretor").val($btn.data("corretor"));
    $("#form-agendamento").parsley().reset();
    openModal("modal-det-agendamento");
  }

  // Ao selecionar um dia
  $(".radio-box-days input").on("change", handleAlteraDia);
  if ($(".radio-box-days input").length > 0) {
    handleAlteraDia();
  }
  function handleAlteraDia() {
    const $dia = $(".radio-box-days input:checked");
    const dia = $dia.val();
    const horarios = $dia.data("horarios").split(",");
    carregaHorarios(horarios);
  }

  // Carrossel datas
  $(".radio-box-days").slick({
    infinite: false,
    slidesToShow: 5,
    slidesToScroll: 3,
    autoplay: false,
    responsive: [
      {
        breakpoint: 1199,
        settings: {
          slidesToShow: 6,
        },
      },
      {
        breakpoint: 760,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        },
      },
    ],
  });

  // Carrossel horários
  function carregaHorarios(horarios) {
    if ($(".radio-box-time").hasClass("slick-slider")) {
      $(".radio-box-time").slick("unslick");
    }
    $(".radio-box-time").html("");
    if (horarios.length > 0) {
      horarios.forEach((item) => {
        $(".radio-box-time").append(`
        <li class="radio-box-item">
          <input type="radio" name="horario" id="ag-horario-${item}" value="${item}" required data-parsley-required-message="Selecione um horário">
          <label for="ag-horario-${item}" class="radio-box-wrp">
            <div class="radio-box-text">${item}</div>
          </label>
        </li>`);
      });
      $(".radio-box-time input").each(function () {
        $(this)
          .parsley({
            classHandler: function (el) {
              return el.$element.closest(".campo-container");
            },
            errorsContainer: function (el) {
              return el.$element.closest(".campo-container");
            },
          })
          .reset();
      });
      $(".radio-box-time").slick({
        infinite: false,
        slidesToShow: 6,
        slidesToScroll: 3,
        autoplay: false,
        responsive: [
          {
            breakpoint: 1199,
            settings: {
              slidesToShow: 6,
            },
          },
          {
            breakpoint: 760,
            settings: {
              slidesToShow: 3,
            },
          },
        ],
      });
    }
  }

  // ENVIA O FORMULÁRIO
  let enviando_formulario = false;
  $("#form-agendamento").on("submit", function (e) {
    e.preventDefault();

    var obj = this;
    var form = $(obj);
    var submit_btn = form.find(".btn-agendar");
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
          volta_submit();
          if (data == "ok") {
            closeModal("modal-det-agendamento");
            showAlert("Sucesso", "Visita agendada com sucesso.", "success");
            setTimeout(() => {
              location.reload();
            }, 3000);
          } else {
            showAlert(
              "Erro",
              "Não foi possível realizar esta operação.",
              "error"
            );
          }
        },
        error: function (xhr, type, exception) {
          volta_submit();
          showAlert(
            "Erro",
            "Não foi possível realizar esta operação.",
            "error"
          );
          console.log("ajax error response type " + type);
        },
      });
    }
  });
})();
