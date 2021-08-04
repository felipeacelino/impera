(function () {
  "use strict";

  let map;
  let geocoder;
  let marker;

  // Retorna o endereço completo formatado
  function getAddress() {
    // Verifica se as informações foram preenchidas
    if (
      $("#logradouro").val() != "" &&
      $("#bairro").val() != "" &&
      $("#cidade_nome").val() != "" &&
      $("#estado_nome").val() != ""
    ) {
      const logradouro = $("#logradouro").val();
      const numero = $("#numero").val();
      const bairro = $("#bairro").val();
      const cidade = $("#cidade_nome").val();
      const estado = $("#estado_nome").val();
      const pais = "Brasil";
      let endereco =
        logradouro +
        ", " +
        numero +
        ", " +
        bairro +
        ", " +
        cidade +
        ", " +
        estado +
        ", " +
        pais;
      endereco = clearAddress(endereco);
      return endereco;
    }
    return false;
  }

  // Limpa o endereço
  function clearAddress(string) {
    return string.replace(/\s/g, "+");
  }

  // Obtém a posição no mapa do endereço passado
  function getGeocodeFromAddress(address) {
    geocoder.geocode({ address: address }, function (results, status) {
      if (status === "OK") {
        const position = results[0].geometry.location;
        setCoordinates(formatPosition(position));
        setMapLocale(position);
      } else {
        showAlert(
          "Atenção",
          "Não foi possível encontrar o endereço informado.",
          "warning"
        );
      }
    });
  }

  // Cria um marcador no local informado no mapa
  function setMapLocale(position) {
    map.setCenter(position);
    if (marker !== undefined) {
      marker.setMap(null);
    }
    marker = new google.maps.Marker({
      map: map,
      draggable: true,
      animation: google.maps.Animation.DROP,
      position: position,
      icon: {
        url: url_base + "app/assets/dist/img/maps/marker.png",
        scaledSize: new google.maps.Size(45, 45),
      },
    });
    marker.addListener("dragend", handleMarker);
    map.setZoom(16);
  }

  // Formata as coordenadas para String
  function formatPosition(position) {
    return {
      lat: position.lat().toFixed(6),
      lng: position.lng().toFixed(6),
    };
  }

  // Obtém as novas coordenadas ao mover o marcador
  function handleMarker() {
    const position = marker.getPosition();
    setCoordinates(formatPosition(position));
  }

  // Passa as coordenadas para o campo
  function setCoordinates(coordinates) {
    $("#lat").val(coordinates.lat).parsley().validate();
    $("#lng").val(coordinates.lng).parsley().validate();
  }

  // Obtem as coordenadas do campo
  function getCoordinates() {
    const coordinates = $("#lat").val() + ", " + $("#lng").val();
    return {
      lat: Number($("#lat").val()),
      lng: Number($("#lng").val()),
    };
  }

  // Evento de click no botão para encontrar o local no mapa
  $(".btn-mapa").on("click", function (e) {
    e.preventDefault();
    if (getAddress()) {
      const address = getAddress();
      getGeocodeFromAddress(address);
    } else {
      showAlert(
        "Atenção",
        "Não foi possível encontrar o local no mapa. Por favor, informe o endereço corretamente.",
        "warning"
      );
    }
  });

  // Inicializa o mapa (Formulário)
  function initMapForm() {
    map = new google.maps.Map(document.getElementById("form-mapa-anuncio"), {
      zoom: 3,
      center: { lat: -15.90812, lng: -47.983592 }, // <- Brasília
      streetViewControl: false,
    });
    geocoder = new google.maps.Geocoder();
    // Carrega a posição no mapa ao editar
    if (
      $("#form-mapa-anuncio").length > 0 &&
      $("#lat").val() != "" &&
      $("#lng").val() != ""
    ) {
      const position = getCoordinates();
      setMapLocale(position);
    }
  }

  // MAPA
  $(window).load(function () {
    if ($("#form-mapa-anuncio").length > 0) {
      initMapForm();
    }
  });

  let enviando_formulario = false;

  // CADASTRAR / EDITAR
  $("#form-anuncio").on("submit", function (e) {
    e.preventDefault();

    var obj = this;
    var form = $(obj);
    var submit_btn = form.find("#cadastrar");
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
        success: function (response) {
          console.log(response);
          response = JSON.parse(response);
          if (response.status == "ok") {
            window.location.href = response.url;
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

  // REMOVE ANÚNCIO
  $("#form-remove-anuncio").on("submit", function (e) {
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
            showAlert("Sucesso", "Anúncio removido com sucesso.", "success");
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

  // DUPLICA ANÚNCIO
  $("#form-duplica-anuncio").on("submit", function (e) {
    e.preventDefault();
    var obj = this;
    var form = $(obj);
    var dados = new FormData(obj);
    var idRemove = $("#id_duplica").val();
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
            $("#id_duplica").val("");
            showAlert("Sucesso", "Anúncio duplicado com sucesso.", "success");
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

  // FINALIDADE
  const $campoFinalidade = $(".campo-finalidade");
  const $camposVendaWrp = $(".campo-venda");
  const $camposVenda = $camposVendaWrp.find("input, select, textarea");
  const $camposVendaReq = $camposVendaWrp.find(
    "input[data-required], select[data-required], textarea[data-required]"
  );
  const $camposAluguelWrp = $(".campo-aluguel");
  const $camposAluguel = $camposAluguelWrp.find("input, select, textarea");
  const $camposAluguelReq = $camposAluguelWrp.find(
    "input[data-required], select[data-required], textarea[data-required]"
  );

  // Ao alterar a finalidade
  $campoFinalidade.on("change", handleFinalidade);
  handleFinalidade();
  function handleFinalidade() {
    const finalidade = $campoFinalidade.val();
    let tituloPlaceholder;
    if (finalidade === "aluguel") {
      tituloPlaceholder =
        "Apartamento para alugar com 80 m², 2 quartos e 1 vaga";
      $camposVendaWrp.hide();
      $camposVenda.prop("disabled", true);
      $camposVenda.prop("required", false);
      $camposAluguelWrp.show();
      $camposAluguel.prop("disabled", false);
      $camposAluguelReq.prop("required", true);
    } else if (finalidade === "venda") {
      tituloPlaceholder = "Apartamento à venda com 80 m², 2 quartos e 1 vaga";
      $camposAluguelWrp.hide();
      $camposAluguel.prop("disabled", true);
      $camposAluguelReq.prop("required", false);
      $camposVendaWrp.show();
      $camposVenda.prop("disabled", false);
      $camposVendaReq.prop("required", true);
    } else if (finalidade === "venda-aluguel") {
      tituloPlaceholder =
        "Apartamento para venda ou aluguel com 80 m², 2 quartos e 1 vaga";
      $camposVendaWrp.show();
      $camposVenda.prop("disabled", false);
      $camposVendaReq.prop("required", true);
      $camposAluguelWrp.show();
      $camposAluguel.prop("disabled", false);
      $camposAluguelReq.prop("required", true);
    }
    $("#titulo").attr("placeholder", tituloPlaceholder);
  }

  // TIPO
  const $campoTipo = $("#tipo_id");
  const $camposResWrp = $(".campos-residencial");
  const $camposRes = $camposResWrp.find("input, select, textarea");
  const $camposResReq = $camposResWrp.find(
    "input[data-required], select[data-required], textarea[data-required]"
  );
  const $camposComWrp = $(".campos-comercial");
  const $camposCom = $camposComWrp.find("input, select, textarea");
  const $camposComReq = $camposComWrp.find(
    "input[data-required], select[data-required], textarea[data-required]"
  );

  // Ao alterar o tipo
  $campoTipo.on("change", handleTipo);
  handleTipo();
  function handleTipo() {
    let tipo = "Residencial";
    if ($campoTipo.val() && $campoTipo.val() != "") {
      tipo = $campoTipo.find("option:selected").parent().attr("label");
    }
    $("#tipo_nome").val(tipo);
    tipo = tipo.toLowerCase();
    if (tipo === "comercial") {
      $camposResWrp.hide();
      $camposRes.prop("disabled", true);
      $camposRes.prop("required", false);
      $camposComWrp.show();
      $camposCom.prop("disabled", false);
      $camposComReq.prop("required", true);
    } else {
      $camposComWrp.hide();
      $camposCom.prop("disabled", true);
      $camposComReq.prop("required", false);
      $camposResWrp.show();
      $camposRes.prop("disabled", false);
      $camposResReq.prop("required", true);
    }
  }
})();

// Vídeo
(function () {
  "use strict";

  // Variáveis
  const $videoURL = $("#video_url");
  const $videoID = $("#video_id");
  const $videoPlataforma = $("#video_plataforma");
  const $videoIframe = $(".an-video-iframe");

  if ($videoURL.length > 0) {
    handleVideo();
    $videoURL.on("change", handleVideo);
  }

  // Evento ao alterar a url do vídeo
  function handleVideo() {
    const videoURL = $videoURL.val().trim();
    $videoURL.val("");
    $videoID.val("");
    $videoIframe.html("");
    $videoIframe.hide();
    if (videoURL != "") {
      const videoObj = parseVideo(videoURL);
      if (videoObj.id) {
        $videoURL.val(videoURL);
        $videoID.val(videoObj.id);
        $videoPlataforma.val(videoObj.plataforma);
        $videoIframe.append(createVideo(videoURL));
        $videoIframe.show();
      } else {
        showAlert(
          "Atenção",
          "Não foi possível carregar o vídeo. Verifique se o link informado está correto ou se o vídeo possui permissão para ser incorporado em outros sites.",
          "warning"
        );
      }
    }
  }

  // Obtém o ID de um vídeo do Youtube através da URL
  function YouTubeGetID(url) {
    url = url.split(/(vi\/|v%3D|v=|\/v\/|youtu\.be\/|\/embed\/)/);
    return undefined !== url[2] ? url[2].split(/[^0-9a-z_\-]/i)[0] : url[0];
  }

  // Obtém o ID de um vídeo do Vimeo através da URL
  function VimeoGetID(url) {
    var id = false;
    $.ajax({
      url: "https://vimeo.com/api/oembed.json?url=" + url,
      async: false,
      success: function (response) {
        if (response.video_id) {
          id = response.video_id;
        }
      },
    });
    return id;
  }

  // Retorna um objeto com as informações do vídeo
  function parseVideo(url) {
    const videoObj = {};
    // Verifica a plataforma do vídeo
    if (/youtu/.test(url)) {
      videoObj.plataforma = "youtube";
      videoObj.id = YouTubeGetID(url);
    } else if (/vimeo/.test(url)) {
      videoObj.plataforma = "vimeo";
      videoObj.id = VimeoGetID(url);
    }
    return videoObj;
  }

  // Cria um elemento Iframe de vídeo
  function createVideo(url) {
    const videoObj = parseVideo(url);
    let $iframe;
    if (videoObj.plataforma == "youtube") {
      $iframe = `<div class="bloco-video-wrapper"><iframe src="https://www.youtube.com/embed/${videoObj.id}?controls=0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>`;
    } else if (videoObj.plataforma == "vimeo") {
      $iframe = `<div class="bloco-video-wrapper"><iframe src="https://player.vimeo.com/video/${videoObj.id}?title=0&byline=0&portrait=0" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe></div>`;
    }
    return $iframe;
  }
})();

// Disponibilidade visitas
(function () {
  "use strict";

  $('.dia-disponibilidade input[type="checkbox"]').on("change", dayDispHandler);
  dayDispHandler();
  function dayDispHandler() {
    $('.dia-disponibilidade input[type="checkbox"]').each(function () {
      const $input = $(this);
      const $container = $input.parent().parent().parent().parent();
      const $inputs = $container.find('input[type="text"]');
      if ($(this).is(":checked")) {
        $container.addClass("active");
        $inputs.prop("disabled", false);
        $inputs.prop("required", true);
      } else {
        $container.removeClass("active");
        $inputs.prop("disabled", true);
        $inputs.prop("required", false);
      }
      $inputs.each(function () {
        $(this).parsley().reset();
      });
    });
  }
})();

// Verifica se já existe outro imóvel com o mesmo endereço
(function () {
  "use strict";
  $(".ver_end_dup").on("change", verificaEndereco);
  function verificaEndereco() {
    const finalidade = $("#finalidade").val();
    const logradouro = $("#logradouro").val();
    const numero = $("#numero").val();
    const complemento = $("#complemento").val() ? $("#complemento").val() : "";
    const bairroId = $("#bairro_id").val();
    const cidadeId = $("#cidade_id").val();
    const estadoId = $("#estado_id").val();
    if (
      finalidade != "" &&
      logradouro != "" &&
      bairroId != "" &&
      cidadeId != "" &&
      estadoId != "" &&
      numero != ""
    ) {
      const data = {
        finalidade: finalidade,
        logradouro: logradouro,
        numero: numero,
        complemento: complemento,
        bairro_id: bairroId,
        cidade_id: cidadeId,
        estado_id: estadoId,
      };
      if ($('#form-anuncio input[name="acao"]').val() == "update") {
        data.id_update = $('#form-anuncio input[name="id"]').val();
      }
      //console.log(data);
      $.getJSON(
        url_base + "acoes/app/proprietario/verifica_endereco.php",
        data,
        function (result) {
          console.log(result);
          if (result.total > 0) {
            $("#numero").val("");
            showAlert(
              "Atenção",
              "Já existe um outro imóvel cadastrado com este mesmo endereço e finalidade.",
              "warning"
            );
          }
        }
      );
    }
  }
})();
