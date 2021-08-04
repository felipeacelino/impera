(function () {
  "use strcit";

  $(".lista-add").on("click", function (e) {
    e.preventDefault();
    var botao = $(this);
    var id = botao.data("registro");
    var id_busca = botao.data("busca");
    var url = botao.data("url");
    adicionaAnuncio(id, id_busca, url);
  });

  function adicionaAnuncio(id, id_busca, url) {
    var campo = $('tr[data-registro="' + id + '"]');
    var anuncio = campo;
    var botaoRem = anuncio.find(".lista-rem");
    var botaoAdd = anuncio.find(".lista-add");
    $.ajax({
      url: url,
      type: "POST",
      data: {
        id_busca: id_busca,
        id: id,
      },
      success: function (data) {
        //console.log(data);
        if (data == "ok") {
          botaoAdd.hide();
          botaoRem.show();
        } else {
          console.log("Erro");
        }
      },
      error: function (xhr, type, exception) {
        input.prop("disabled", false);
        console.log("ajax error response type " + type);
      },
    });
  }

  $(".lista-rem").on("click", function (e) {
    e.preventDefault();
    var botao = $(this);
    var id = botao.data("registro");
    var id_busca = botao.data("busca");
    var url = botao.data("url");
    removeAnuncio(id, id_busca, url);
  });

  function removeAnuncio(id, id_busca, url) {
    var campo = $('tr[data-registro="' + id + '"]');
    var anuncio = campo;
    var botaoRem = anuncio.find(".lista-rem");
    var botaoAdd = anuncio.find(".lista-add");
    $.ajax({
      url: url,
      type: "POST",
      data: {
        id_busca: id_busca,
        id: id,
      },
      success: function (data) {
        //console.log(data);
        if (data == "ok") {
          botaoAdd.show();
          botaoRem.hide();
          if (botaoRem.hasClass("hide-line")) {
            let totalAtual = $(".total-anuncios-selecionados").html();
            totalAtual = parseInt(totalAtual);
            totalAtual--;
            $(".total-anuncios-selecionados").html(totalAtual);
            campo.hide();
          }
        } else {
          console.log("Erro");
        }
      },
      error: function (xhr, type, exception) {
        input.prop("disabled", false);
        console.log("ajax error response type " + type);
      },
    });
  }
})();
