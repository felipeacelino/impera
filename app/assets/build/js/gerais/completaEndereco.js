/* =================== COMPLETA ENDEREÇO =================== */
jQuery(document).ready(function ($) {
  $(".cep_completa").on("change", function () {
    var input = $(this);
    var cep = $(this).val();
    var url = $(this).data("url");
    var loading = input.prev(".campo-loading");

    $.ajax({
      url: url,
      type: "POST",
      data: {
        cep: cep,
      },
      beforeSend: function () {
        loading.fadeIn();
        input.prop("disabled", true);
      },
      success: function (data) {
        console.log(data);
        loading.fadeOut();
        input.prop("disabled", false);
        try {
          var endereco = JSON.parse(data);

          $("#logradouro").val(endereco.logradouro);
          $("#bairro").val(endereco.bairro);
          $("#cidade").val(endereco.cidade);
          $("#estado").val(endereco.uf);
          $("#numero").focus();

          $("#logradouro").parsley().validate();
          $("#bairro").parsley().validate();
          $("#cidade").parsley().validate();
          $("#estado").parsley().validate();
        } catch (e) {
          return false;
        }
      },
      error: function (xhr, type, exception) {
        loading.fadeOut();
        input.prop("disabled", false);
        console.log("ajax error response type " + type);
      },
    });
  });
});

/* =================== COMPLETA ENDEREÇO (CADASTRO DO ANÚNCIO) =================== */
jQuery(document).ready(function ($) {
  const $cep = $(".cep_completa_cad");

  $cep.on("input", handleAddress);
  function handleAddress() {
    const cepLength = $cep.val().replace(/\D/g, "").length;
    $(".campos-endereco").slideUp();
    if (cepLength >= 8) {
      completaEndereco();
    }
  }

  function completaEndereco() {
    var input = $cep;
    var cep = $cep.val();
    var url = $cep.data("url");
    var loading = $cep.prev(".campo-loading");

    $.ajax({
      url: url,
      type: "POST",
      data: {
        cep: cep,
      },
      beforeSend: function () {
        loading.fadeIn();
        $cep.prop("readonly", true);
      },
      success: function (data) {
        console.log(data);
        loading.fadeOut();
        $cep.prop("readonly", false);
        try {
          var endereco = JSON.parse(data);
          //console.log(endereco);
          if (endereco.logradouro != "") {
            // Indisponível ou bloqueado
            if (endereco.disponivel == "1" && endereco.bloqueado == "0") {
              $("#logradouro").val(endereco.logradouro).parsley().validate();

              $("#bairro_id").data("sync-value", endereco.bairro_id);
              $("#cidade_id").val(endereco.cidade_id).trigger("change");
              $("#estado_id").val(endereco.estado_id).trigger("change");
              $("#bairro_nome").val(endereco.bairro);
              $("#cidade_nome").val(endereco.cidade);
              $("#estado_nome").val(endereco.uf);
              $("#numero").focus();
              $(".campos-endereco").slideDown();
              $(".btn-mapa").trigger("click");
            } else {
              showAlert(
                "Atenção",
                "Infelizmente ainda não trabalhamos com imóveis neste endereço.",
                "warning"
              );
            }
          } else {
            showAlert(
              "Atenção",
              "<b>Endereço não encontrado.</b><br> Por favor, verifique o CEP informado.",
              "warning"
            );
          }
        } catch (e) {
          showAlert(
            "Atenção",
            "<b>Endereço não encontrado.</b><br> Por favor, verifique o CEP informado.",
            "warning"
          );
          return false;
        }
      },
      error: function (xhr, type, exception) {
        loading.fadeOut();
        $cep.prop("readonly", false);
        console.log("ajax error response type " + type);
      },
    });
  }
  $(".form-anuncio #estado_id").on("change", function () {
    $("#estado_nome").val($(this).find("option:selected").text());
  });
  $(".form-anuncio #cidade_id").on("change", function () {
    $("#cidade_nome").val($(this).find("option:selected").text());
  });
  $(".form-anuncio #bairro_id").on("change", function () {
    $("#bairro_nome").val($(this).find("option:selected").text());
  });
});
