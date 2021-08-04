// Fotos
(function () {
  "use strict";

  // Slide
  $(".anuncio-det-slide").slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    dots: false,
    autoplay: false,
    //autoplaySpeed: 5000,
    adaptiveHeight: true,
    responsive: [
      {
        breakpoint: 1199,
        settings: {
          arrows: false,
          slidesToShow: 2,
          slidesToScroll: 2,
        },
      },
      {
        breakpoint: 760,
        settings: {
          arrows: false,
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });
  $(".anuncio-det-slide-wrp").css("height", "auto");
  $(".anuncio-det-slide").css("opacity", "1");
})();

// Lateral
(function () {
  "use strict";
  if (!isMobileX(1199) && $(".anuncio-lateral").length > 0) {
    const topSpacing = $(".header-full").outerHeight() + 20;
    const bottomSpacing =
      $(".anuncio-det-relacionados").length > 0 ? 1045 : 505;
    $(".anuncio-lateral").sticky({
      topSpacing: topSpacing,
      bottomSpacing: bottomSpacing,
    });
  }

  // Exibe a âncora fixa (MOBILE)
  if (isMobileX(1199) && $("#reserva-mobile-sec").length > 0) {
    $(window).on(
      "scroll",
      debounce(function () {
        const offset =
          $("#reserva-mobile-sec").offset().top +
          $("#reserva-mobile-sec").outerHeight() -
          $(".header-full").outerHeight();
        if ($(window).scrollTop() > offset) {
          $(".anuncio-det-anchor").addClass("active");
        } else {
          $(".anuncio-det-anchor").removeClass("active");
        }
      }, 50)
    );
  }

  // Botão compartilhar (Mobile)
  $(".btn-mbl-share").on("click", function (ev) {
    ev.preventDefault();
    const $btn = $(this);
    const title = $btn.data("title");
    const text = $btn.data("text");
    const url = $btn.data("url");
    if (navigator.share) {
      navigator
        .share({
          title: title,
          text: text,
          url: url,
        })
        .then(() => {
          console.log("Obrigado por compartilhar!");
        })
        .catch((error) => console.log("Error sharing", error));
    }
  });
})();

// Localização
(function () {
  "use strict";

  function initMap() {
    const elementMap = $("#anuncio-det-mapa");
    const elementStreet = $("#anuncio-det-street");
    const icon = elementMap.data("icon");
    const lat = elementMap.data("lat");
    const lng = elementMap.data("lng");
    const location = new google.maps.LatLng(lat, lng);
    const $btnViewMap = $(".view-map");
    const $btnViewStreet = $(".view-street");
    const $btnScrollMap = $(".scroll-map");
    const $btnScrollStreet = $(".scroll-street");
    let panorama;
    let gestureHandling = isMobileX(760) ? "greedy" : "auto";

    const mapOptions = {
      zoom: 14,
      center: location,
      streetViewControl: false,
      gestureHandling: gestureHandling,
    };

    const map = new google.maps.Map(elementMap.get(0), mapOptions);

    const marker = new google.maps.Marker({
      position: location,
      icon: icon,
      map: map,
    });

    panorama = map.getStreetView();
    panorama.setPosition(location);
    /* panorama.setPov({
      heading: 265,
      pitch: 0,
    }); */

    $btnViewMap.on("click", viewMap);
    $btnScrollMap.on("click", function (ev) {
      ev.preventDefault();
      scrollToX("#imovel-localizacao");
      viewMap();
    });
    function viewMap() {
      $btnViewStreet.removeClass("btn-primario");
      $btnViewMap.addClass("btn-primario");
      if (panorama.getVisible()) {
        panorama.setVisible(false);
      }
    }

    $btnViewStreet.on("click", viewStreet);
    $btnScrollStreet.on("click", function (ev) {
      ev.preventDefault();
      scrollToX("#imovel-localizacao");
      viewStreet();
    });
    function viewStreet() {
      $btnViewMap.removeClass("btn-primario");
      $btnViewStreet.addClass("btn-primario");
      if (!panorama.getVisible()) {
        panorama.setVisible(true);
      }
    }
  }

  $(window).load(function () {
    if ($("#anuncio-det-mapa").length > 0) {
      initMap();
    }
  });
})();

// Envia avaliação
var enviando_formulario = false;
$("#form-avaliacao").on("submit", function (e) {
  e.preventDefault();

  var obj = this;
  var form = $(obj);
  var submit_btn = form.find("#enviar_avaliacao");
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
        submit_btn.text("Enviando...");
      },
      success: function (data) {
        //console.log(data);
        volta_submit();
        if (data == "ok") {
          closeModal("modal-avaliacao");
          $("#form-avaliacao .campo").val("");
          showAlert(
            "Sucesso",
            "Obrigado! Sua avaliação foi enviada com sucesso.",
            "success"
          );
        } else {
          showAlert("Erro", "Não foi possível enviar a mensagem.", "error");
        }
      },
      error: function (xhr, type, exception) {
        volta_submit();
        showAlert("Erro", "Não foi possível enviar a mensagem.", "error");
        console.log("ajax error response type " + type);
      },
    });
  }
});
