(function ($) {
  "use strict";

  // Valida CPF
  function validarCPF(r) {
    var t, a, n, e, i;
    if (((i = 1), (r = r.replace(/[^\d]+/g, "")).length < 11)) return !1;
    for (e = 0; e < r.length - 1; e++)
      if (r.charAt(e) != r.charAt(e + 1)) {
        i = 0;
        break;
      }
    if (i) return !1;
    for (t = r.substring(0, 9), a = r.substring(9), n = 0, e = 10; e > 1; e--)
      n += t.charAt(10 - e) * e;
    if ((n % 11 < 2 ? 0 : 11 - (n % 11)) != a.charAt(0)) return !1;
    for (t = r.substring(0, 10), n = 0, e = 11; e > 1; e--)
      n += t.charAt(11 - e) * e;
    return (n % 11 < 2 ? 0 : 11 - (n % 11)) == a.charAt(1);
  }

  // Valida CNPJ
  function validarCNPJ(r) {
    if ("" == (r = r.replace(/[^\d]+/g, ""))) return !1;
    if (14 != r.length) return !1;
    if (
      "00000000000000" == r ||
      "11111111111111" == r ||
      "22222222222222" == r ||
      "33333333333333" == r ||
      "44444444444444" == r ||
      "55555555555555" == r ||
      "66666666666666" == r ||
      "77777777777777" == r ||
      "88888888888888" == r ||
      "99999999999999" == r
    )
      return !1;
    for (
      var t = r.length - 2,
        n = r.substring(0, t),
        a = r.substring(t),
        e = 0,
        i = t - 7,
        u = t;
      u >= 1;
      u--
    )
      (e += n.charAt(t - u) * i--), i < 2 && (i = 9);
    var f = e % 11 < 2 ? 0 : 11 - (e % 11);
    if (f != a.charAt(0)) return !1;
    for (t += 1, n = r.substring(0, t), e = 0, i = t - 7, u = t; u >= 1; u--)
      (e += n.charAt(t - u) * i--), i < 2 && (i = 9);
    return (f = e % 11 < 2 ? 0 : 11 - (e % 11)) == a.charAt(1);
  }

  // Valide CPF ou CNPJ
  function validaCPForCNPJ(value) {
    return validarCPF(value) || validarCNPJ(value);
  }

  // Nome completo
  window.Parsley.addValidator("fullname", {
    validateString: function (value) {
      var value = value.trim().split(" ");
      return value.length > 1;
    },
    messages: {
      "pt-br": "Digite o nome completo.",
    },
  });

  // Valida CPF
  window.Parsley.addValidator("cpf", {
    validateString: function (value) {
      return validarCPF(value);
    },
    messages: {
      "pt-br": "Informe um número de CPF válido.",
    },
  });

  // Valida CNPJ
  window.Parsley.addValidator("cnpj", {
    validateString: function (value) {
      return validarCNPJ(value);
    },
    messages: {
      "pt-br": "Informe um número de CNPJ válido.",
    },
  });

  // Valida CPF ou CNPJ
  window.Parsley.addValidator("cpf_cnpj", {
    validateString: function (value) {
      return validaCPForCNPJ(value);
    },
    messages: {
      "pt-br": "Informe um número de CPF ou CNPJ válido.",
    },
  });

  // Verifica um campo com validação externa (Ex: E-mail já cadastrado no sistema)
  window.Parsley.addAsyncValidator("remote", function (resposta) {
    console.log(resposta);
    return resposta.responseText == "ok";
  });

  // Tamanho do arquivo
  window.Parsley.addValidator("maxfilesize", {
    validateString: function (value, maxSize, parsleyInstance) {
      var files = parsleyInstance.$element[0].files;
      return files.length != 1 || files[0].size <= maxSize * 1048576;
    },
    requirementType: "integer",
    messages: {
      "pt-br": "Este arquivo não deve ser maior que %s Mb",
    },
  });

  // Exibe o 'check' nos campos validados com sucesso
  window.Parsley.on("field:success", function () {
    this.$element.parent(".show-validacao").addClass("valid");
  }).on("field:error", function () {
    this.$element.parent(".show-validacao").removeClass("valid");
  });

  // Instancia o validador
  $(".form-validation").parsley();

  // Contador de caracter
  $("textarea[maxlength]")
    .each(function () {
      const limite = $(this).attr("maxlength");
      const count = $(this).val().length;
      $(this).after('<span class="caracter_count"></span>');
      const countEle = $(this).next(".caracter_count");
      countEle.text(count + "/" + limite);
    })
    .on("keyup keydown keypress", function () {
      const limite = $(this).attr("maxlength");
      const count = $(this).val().length;
      const countEle = $(this).next(".caracter_count");
      countEle.text(count + "/" + limite);
    });
})(jQuery);
