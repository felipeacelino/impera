/* =================== MÁSCARAS DOS CAMPOS =================== */

// Numérico
$(".number").mask("#");

// VALOR
//$(".valor").mask("000.000.000.000.000,00", { reverse: true });
$(".valor")
  .maskMoney({
    prefix: "R$ ",
    thousands: ".",
    decimal: ",",
    allowZero: true,
  })
  .on("change", function () {
    $(this).parsley().validate();
  })
  .on("keyup keydown keypress", function () {
    const $el = $('.campo-valor-txt[data-campo="#' + $(this).attr("id") + '"]');
    if ($el.length > 0) {
      const val = $(this).maskMoney("unmasked")[0];
      let desc = "Reais";
      let colorClass = "reais";
      if (val > 999999999.99) {
        desc = "Bilhões";
        colorClass = "bilhoes";
      } else if (val > 999999.99) {
        desc = "Milhões";
        colorClass = "milhoes";
      } else if (val > 999.99) {
        desc = "Mil";
        colorClass = "mil";
      }
      $el.removeClass("reais bilhoes milhoes mil").addClass(colorClass);
      $el.text(desc);
    }
  });
// Data
$(".date").mask("00/00/0000", { clearIfNotMatch: true });

// Horário
$(".time").mask("00:00", { clearIfNotMatch: true });

// CEP
$(".cep").mask("00000-000", { clearIfNotMatch: true });

// Cartão de crédito
$(".card-number").mask("0000 0000 0000 0000");

// Validade do cartão de crédito
$(".card-date").mask("00/00", { clearIfNotMatch: true });

// CPF
$(".cpf").mask("000.000.000-00", { clearIfNotMatch: true, reverse: true });

// CNPJ
$(".cnpj").mask("00.000.000/0000-00", { clearIfNotMatch: true, reverse: true });

// CPF OU CNPJ
const maskCpfCnpj = function (val) {
  return val.replace(/\D/g, "").length > 11
    ? "00.000.000/0000-00"
    : "000.000.000-009";
};
const optMaskCpfCnpj = {
  onKeyPress: function (val, e, field, options) {
    field.mask(maskCpfCnpj.apply({}, arguments), options);
  },
};
$(".cpf-cnpj").mask(maskCpfCnpj, optMaskCpfCnpj);

// Telefone (Com 9 dígitos)
const maskPhoneSP = function (val) {
  return val.replace(/\D/g, "").length === 11
    ? "(00) 00000-0000"
    : "(00) 0000-00009";
};
const optMaskPhoneSP = {
  onKeyPress: function (val, e, field, options) {
    field.mask(maskPhoneSP.apply({}, arguments), options);
  },
  clearIfNotMatch: true,
};
$(".telefone").mask(maskPhoneSP, optMaskPhoneSP);

// Domínio
$(".domain").on("input keydown keyup", function () {
  $(this).val($(this).val().toLowerCase().replace(/\s/g, ""));
});

// Peso
$(".weight").mask("#0,000", { reverse: true });

// Porcentagem
$(".percent").mask("##0,00", { reverse: true });

// Tradução para o pluging 'Datepicker'
const datepickerLocaleBR = {
  format: "DD/MM/YYYY",
  separator: " a ",
  applyLabel: "Aplicar",
  cancelLabel: "Limpar",
  fromLabel: "De",
  toLabel: "a",
  customRangeLabel: "Personalizado",
  daysOfWeek: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
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

// ------------------------------------
// Datepicker
// ------------------------------------
(function () {
  "use strict";

  // Datepicker
  $(".datepicker").each(function () {
    const openDirection =
      $(this).data("direction") && $(this).data("direction") === "right"
        ? "left"
        : "right";
    $(this)
      .daterangepicker({
        singleDatePicker: true,
        autoUpdateInput: false,
        autoApply: true,
        opens: openDirection,
        locale: datepickerLocaleBR,
      })
      .on("apply.daterangepicker", function (ev, picker) {
        $(this).val(picker.startDate.format("DD/MM/YYYY"));
        //$(this).parsley().validate();
      })
      .on("cancel.daterangepicker", function (ev, picker) {
        $(this).val("");
      });
  });

  // Datepicker Range
  $(".datepicker_range").each(function () {
    const $campo = $(this);
    const openDirection =
      $campo.data("direction") && $campo.data("direction") === "right"
        ? "left"
        : "right";
    $campo
      .daterangepicker({
        autoUpdateInput: false,
        autoApply: false,
        opens: openDirection,
        locale: datepickerLocaleBR,
        buttonClasses: "btn btn-xs",
        applyButtonClasses: "btn-primario",
      })
      .on("apply.daterangepicker", function (ev, picker) {
        $(this).val(
          picker.startDate.format("DD/MM/YYYY") +
            " a " +
            picker.endDate.format("DD/MM/YYYY")
        );
        $(this).parsley().validate();
      })
      .on("cancel.daterangepicker", function (ev, picker) {
        $campo.val("");
        $(this).parsley().validate();
      });
  });

  // Time Picker
  $(".timepicker").each(function () {
    const $input = $(this);
    const min = $input.data("min");
    const max = $input.data("max");
    const cfg = {
      timeFormat: "HH:mm",
      interval: 30,
      dynamic: false,
      dropdown: true,
      scrollbar: true,
      change: function (time) {
        $input.parsley().validate();
      },
    };
    if (min) {
      cfg.minTime = min;
    }
    if (max) {
      cfg.maxTime = max;
    }
    $(this).timepicker(cfg);
  });
  /* $(".timepicker").each(function () {
    const openDirection =
      $(this).data("direction") && $(this).data("direction") === "right"
        ? "left"
        : "right";
    const timepickerLocaleBR = datepickerLocaleBR;
    timepickerLocaleBR.format = "HH:mm";
    $(this)
      .daterangepicker({
        singleDatePicker: true,
        maxDate: "",
        timePicker: true,
        timePicker24Hour: true,
        autoUpdateInput: false,
        opens: openDirection,
        locale: datepickerLocaleBR,
        buttonClasses: "btn btn-xs",
        applyButtonClasses: "btn-primario",
      })
      .on("show.daterangepicker", function (ev, picker) {
        picker.container.addClass("timepicker");
      })
      .on("apply.daterangepicker", function (ev, picker) {
        $(this).val(picker.startDate.format(timepickerLocaleBR.format));
        $(this).parsley().validate();
      })
      .on("cancel.daterangepicker", function (ev, picker) {
        $(this).val("");
      });
  }); */
})();

// ------------------------------------
// Select2
// ------------------------------------
!(function (e) {
  var r = e.fn.select2.amd.require("select2/defaults");
  e.extend(r.defaults, { searchInputPlaceholder: "" });
  var t = e.fn.select2.amd.require("select2/dropdown/search"),
    a = t.prototype.render;
  t.prototype.render = function (e) {
    var r = a.apply(this, Array.prototype.slice.apply(arguments));
    return (
      this.$search.attr(
        "placeholder",
        this.options.get("searchInputPlaceholder")
      ),
      r
    );
  };
})(window.jQuery);
(function () {
  "use strict";

  // Campos
  const $inputs = $(".select2");

  // Aplica o plugin nos campos
  $inputs.each(function () {
    const $input = $(this);
    const maximumSelectionLength = $input.data("max")
      ? parseInt($input.data("max"))
      : 0;
    const placeholder = $input.data("placeholder")
      ? $input.data("placeholder")
      : false;
    const search = $input.data("search") ? true : false;
    const searchPlaceholder = $input.data("src-placeholder")
      ? $input.data("src-placeholder")
      : "Pesquisar...";
    const dropdownCssClass =
      $input.data("dropdown-class") != "" ? $input.data("dropdown-class") : "";
    const options = {
      width: "100%",
      language: "pt-BR",
      dropdownCssClass: dropdownCssClass,
      maximumSelectionLength: maximumSelectionLength,
      searchInputPlaceholder: searchPlaceholder,
    };
    if (!search) {
      options.minimumResultsForSearch = -1;
    }
    if (placeholder) {
      options.placeholder = placeholder;
    }
    $input.select2(options).on("change.select2", function (ev) {
      $(ev.currentTarget).parsley().validate();
    });
  });
})();

// ------------------------------------
// Grupo de Botões (Radio/Checkbox)
// ------------------------------------
(function () {
  "use strict";

  $(".btn-group-toggle input").on("change", function () {
    const $input = $(this);
    const $btn = $input.parent(".btn");
    const $btnGroup = $btn.parent(".btn-group-toggle");
    $btnGroup.find(".btn").removeClass("active");
    $btn.addClass("active");
  });
  btnToggleHandle();
  function btnToggleHandle() {
    $(".btn-group-toggle input").each(function () {
      const $input = $(this);
      const $btn = $input.parent(".btn");
      const $btnGroup = $btn.parent(".btn-group-toggle");
      if ($input.is(":checked")) {
        $btnGroup.find(".btn").removeClass("active");
        $btn.addClass("active");
      }
    });
  }
})();
