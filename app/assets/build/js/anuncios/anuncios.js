// Filtros
(function () {
  "use strict";

  // Variáveis
  const $btnToggle = $(".btn-toggle-filtros");
  const $btnClose = $(".filtros-close");
  const $filtrosWrp = $(".an-filtros-wrp");
  const $finalidadeCampo = $(".busca-finalidade");
  const $tipoCampo = $("#busca-tipo");
  const $filtrosResidencial = $(".filtros-residencial");
  const $filtrosComercial = $(".filtros-comercial");

  // Evento de click no botão pra exibir/ocultar os filtros
  $btnToggle.on("click", function (ev) {
    ev.preventDefault();
    toggleFiltros();
  });

  // Fecha os filtros ao clicar do botão de fechar
  $btnClose.on("click", function (ev) {
    ev.preventDefault();
    hideFiltros();
  });

  // Fecha os filtros ao clicar fora
  $filtrosWrp.on("click", function (ev) {
    if (ev.target == this) {
      hideFiltros();
    }
  });

  // Fecha os filtros ao pressionar a tecla ESC
  $(document).on("keyup", function (ev) {
    if (ev.keyCode == 27) {
      hideFiltros();
    }
  });

  // Exibe os filtros
  function showFiltros() {
    $("body").css("overflow", "hidden");
    $filtrosWrp.addClass("active");
  }

  // Oculta os filtros
  function hideFiltros() {
    $("body").css("overflow", "auto");
    $filtrosWrp.removeClass("active");
  }

  // Exibe ou oculta os filtros
  function toggleFiltros() {
    if ($filtrosWrp.hasClass("active")) {
      hideFiltros();
    } else {
      showFiltros();
    }
  }

  // Ao alterar a finalidade
  $finalidadeCampo.on("change", handleFiltroValor);
  handleFiltroValor();
  function handleFiltroValor() {
    const finalidade = $(".busca-finalidade:checked").val();
    if (finalidade === "aluguel") {
      $(".busca-valor-venda-wrp").hide();
      $(".busca-valor-aluguel-wrp").show();
    } else {
      $(".busca-valor-venda-wrp").show();
      $(".busca-valor-aluguel-wrp").hide();
    }
  }

  // Ao alterar o tipo de imóvel
  $tipoCampo.on("change", handleFiltroTipo);
  handleFiltroTipo();
  function handleFiltroTipo() {
    let tipo = "residencial";
    if ($tipoCampo.val() && $tipoCampo.val() != "") {
      tipo = $tipoCampo
        .find("option:selected")
        .parent()
        .attr("label")
        .toLowerCase();
    }
    if (tipo === "comercial") {
      $filtrosResidencial.find("input").prop("checked", false);
      $filtrosResidencial.hide();
      $filtrosComercial.show();
    } else {
      $filtrosComercial.find("input").prop("checked", false);
      $filtrosComercial.hide();
      $filtrosResidencial.show();
    }
  }

  // Envia filtros
  $("#ordena").on("change", function () {
    enviaFiltros();
  });
  $("#form-filtros").on("submit", function (ev) {
    ev.preventDefault();
    enviaFiltros();
  });
  function enviaFiltros() {
    var dados = $("#form-filtros, #form-ordem").serialize();
    window.location = url_base + "imoveis?" + dados;
  }
})();

// Anúncios conteúdo página
(function () {
  "use strict";
  if (!isMobileX(760)) {
    setHeightAnPag();
  }
  function setHeightAnPag() {
    const contentHeight =
      $(window).height() -
      ($(".header-full").outerHeight() + $(".anuncios-topo").outerHeight());
    $(".pag-anuncios-lista").css("height", contentHeight);
  }
})();

// Carrosel de anúncios
(function () {
  "use strict";

  if ($(".carrosel-anuncios").length > 0) {
    $(".carrosel-anuncios").slick({
      slidesToShow: 4,
      slidesToScroll: 4,
      infinite: true,
      autoplay: true,
      autoplaySpeed: 5000,
      responsive: [
        {
          breakpoint: 1199,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
          },
        },
        {
          breakpoint: 760,
          settings: {
            arrows: false,
            dots: true,
            //autoplay: false,
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
  }
})();

// Carrosel de fotos do anúncio
(function () {
  "use strict";
  if ($(".bloco-anuncio-fotos").length > 0) {
    $(".bloco-anuncio-fotos > ul").each(function () {
      //const swipe = $(this).hasClass("swipe");
      //const arrows = !$(this).hasClass("noarrows");
      const swipe = true;
      $(this)
        .slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          dots: true,
          swipe: swipe,
          infinite: true,
          responsive: [
            {
              breakpoint: 760,
              settings: {
                arrows: false,
              },
            },
          ],
        })
        .on("mousedown touchstart", function () {
          const $carroselPai = $(this).closest(".carrosel-anuncios");
          if ($carroselPai.length > 0) {
            $carroselPai[0].slick.setOption({
              swipe: false,
              autoplay: false,
            });
            $carroselPai[0].slick.slickPause();
          }
        })
        .on("afterChange", function (event, slick) {
          const $carroselPai = $(this).closest(".carrosel-anuncios");
          if ($carroselPai.length > 0) {
            $carroselPai[0].slick.setOption({
              swipe: true,
              autoplay: true,
              autoplaySpeed: 5000,
            });
            $carroselPai[0].slick.slickPlay();
          }
        });
    });
  }
})();

// Mapa
(function () {
  "use strict";

  let map;
  let bounds;
  let caixa;
  let markers = {};
  let locais = [];

  const iconeMc = url_base + "app/assets/dist/img/maps/marker.png";
  const iconeMcHover = url_base + "app/assets/dist/img/maps/marker_hover.png";
  const clusterImg = url_base + "app/assets/dist/img/maps/m";

  // Obtém os imóveis e suas coordenadas
  function getLocais() {
    $(".bloco-anuncio").each(function () {
      // Remover depois (Gerando aleatóriamente)
      /* const randomGeoPoints = generateRandomPoints(
        { lat: -22.84, lng: -43.47 },
        15000,
        1
      );
      const newLat = Number(randomGeoPoints[0].lat);
      const newLng = Number(randomGeoPoints[0].lng); */

      if ($(this).data("lat") != "" && $(this).data("lng") != "") {
        const newLat = Number($(this).data("lat"));
        const newLng = Number($(this).data("lng"));
        locais.push({
          id: $(this).data("id"),
          url: $(this).data("url"),
          lat: newLat,
          lng: newLng,
          img: $(this).data("img"),
          titulo: $(this).data("titulo"),
          local: $(this).data("local"),
          preco: $(this).data("preco"),
          preco_add: $(this).data("preco-add"),
        });
      }
    });
  }

  // Popula os locais no mapa
  function populaLocais() {
    getLocais();
    if (locais.length > 0) {
      bounds = new google.maps.LatLngBounds();
      locais.forEach(function (local) {
        const position = {
          lat: local.lat,
          lng: local.lng,
        };
        bounds.extend(position);
        const marker = new google.maps.Marker({
          map: map,
          animation: google.maps.Animation.DROP,
          position: position,
          icon: { url: iconeMc, scaledSize: new google.maps.Size(35, 35) },
        });
        marker.addListener("click", function () {
          const precoAdd = local.preco_add
            ? `<div class="map-popup-preco-add">${local.preco_add}</div>`
            : "";
          caixa.setContent(`
            <a href="${local.url}" class="map-popup">
              <figure class="map-popup-img">
                <img src="${local.img}" alt="${local.titulo}">
              </figure>
              <div class="map-popup-infos">
                <div class="map-popup-titulo">${local.titulo}</div>
                <div class="map-popup-local">${local.local}</div>
                <div class="map-popup-preco">${local.preco}</div>
                ${precoAdd}
              </div>
            </a>`);
          caixa.open(map, marker);
        });
        markers[local.id] = marker;
      });
      if (locais.length > 1) {
        map.fitBounds(bounds);
      } else {
        map.setCenter(bounds.getCenter());
        map.setZoom(15);
      }

      const markerCluster = new MarkerClusterer(map, markers, {
        imagePath: clusterImg,
      });

      $(".anuncio-bloco")
        .on("mouseover", function () {
          markers[$(this).data("id")].setIcon({
            url: iconeMcHover,
            scaledSize: new google.maps.Size(35, 35),
          });
        })
        .on("mouseout", function () {
          markers[$(this).data("id")].setIcon({
            url: iconeMc,
            scaledSize: new google.maps.Size(35, 35),
          });
        });
    }
  }

  // Inicializa o mapa da tela
  function initMap() {
    let gestureHandling = isMobileX(760) ? "greedy" : "auto";
    map = new google.maps.Map(document.getElementById("mapa-anuncios"), {
      mapTypeControl: true,
      streetViewControl: false,
      gestureHandling: gestureHandling,
      styles: [
        {
          featureType: "landscape.natural",
          elementType: "geometry.fill",
          stylers: [
            {
              visibility: "on",
            },
            {
              color: "#e0efef",
            },
          ],
        },
        {
          featureType: "poi",
          elementType: "geometry.fill",
          stylers: [
            {
              visibility: "on",
            },
            {
              hue: "#1900ff",
            },
            {
              color: "#c0e8e8",
            },
          ],
        },
        {
          featureType: "road",
          elementType: "geometry",
          stylers: [
            {
              lightness: 100,
            },
            {
              visibility: "simplified",
            },
          ],
        },
        {
          featureType: "road",
          elementType: "labels",
          stylers: [
            {
              visibility: "off",
            },
          ],
        },
        {
          featureType: "transit.line",
          elementType: "geometry",
          stylers: [
            {
              visibility: "on",
            },
            {
              lightness: 700,
            },
          ],
        },
        {
          featureType: "water",
          elementType: "all",
          stylers: [
            {
              color: "#7dcdcd",
            },
          ],
        },
      ],
    });
    caixa = new google.maps.InfoWindow();
    google.maps.event.addListener(map, "click", function () {
      caixa.close();
    });
    populaLocais();
  }

  $(window).load(function () {
    if ($("#mapa-anuncios").length > 0) {
      initMap();
    }
  });

  const $btnShowMap = $(".btn-fl-show-map");
  const $btnShowList = $(".btn-fl-show-list");
  const $btnShowFilter = $(".btn-fl-show-filter");
  const $mapaWrp = $(".anuncios-mapa");
  const $goTop = $(".gotop");
  const $body = $("body");

  $btnShowMap.on("click", function (ev) {
    ev.preventDefault();
    $btnShowMap.hide();
    $btnShowList.show();
    $btnShowFilter.show();
    $goTop.hide();
    $body.css("overflow", "hidden");
    $(".gm-fullscreen-control").hide();
    $mapaWrp.addClass("active");
  });
  $btnShowList.on("click", function (ev) {
    ev.preventDefault();
    $btnShowList.hide();
    $btnShowFilter.hide();
    $btnShowMap.show();
    $goTop.show();
    $body.css("overflow", "auto");
    $mapaWrp.removeClass("active");
  });
  /* $btnShowFilter.on("click", function (ev) {
    ev.preventDefault();
  }); */
})();

/**
 * Generates number of random geolocation points given a center and a radius.
 * @param  {Object} center A JS object with lat and lng attributes.
 * @param  {number} radius Radius in meters.
 * @param {number} count Number of points to generate.
 * @return {array} Array of Objects with lat and lng attributes.
 */
function generateRandomPoints(center, radius, count) {
  var points = [];
  for (var i = 0; i < count; i++) {
    points.push(generateRandomPoint(center, radius));
  }
  return points;
}

/**
 * Generates number of random geolocation points given a center and a radius.
 * Reference URL: http://goo.gl/KWcPE.
 * @param  {Object} center A JS object with lat and lng attributes.
 * @param  {number} radius Radius in meters.
 * @return {Object} The generated random points as JS object with lat and lng attributes.
 */
function generateRandomPoint(center, radius) {
  var x0 = center.lng;
  var y0 = center.lat;
  // Convert Radius from meters to degrees.
  var rd = radius / 111300;

  var u = Math.random();
  var v = Math.random();

  var w = rd * Math.sqrt(u);
  var t = 2 * Math.PI * v;
  var x = w * Math.cos(t);
  var y = w * Math.sin(t);

  var xp = x / Math.cos(y0);

  // Resulting point.
  return { lat: y + y0, lng: xp + x0 };
}

// Usage Example.
// Generates 100 points that is in a 1km radius from the given lat and lng point.
/* var randomGeoPoints = generateRandomPoints(
  { lat: -22.91, lng: -43.22 },
  20000,
  9
);
 */
