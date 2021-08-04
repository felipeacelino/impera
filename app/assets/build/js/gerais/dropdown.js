// ------------------------------------
// Dropdown
// ------------------------------------
(function () {
  "use strict";

  // Variáveis
  const dropdownClass = ".dropdown";
  const $dropdowns = $(dropdownClass);
  const $dropdownToggle = $(".dropdown-toggle");
  const $dropdownMenu = $(".dropdown-menu");

  // Abre ou fecha o dropdown ao clicar no botão
  $dropdownToggle.on("click", function (ev) {
    ev.preventDefault();
    const $dropdown = $(this).parent(dropdownClass);
    dropdownToggle($dropdown);
  });

  // Fecha o dropdown ao clicar em outro local da tela
  $(document).on("click", function (ev) {
    if (ev.target !== $dropdowns && !$dropdowns.has(ev.target).length) {
      dropdownCloseAll();
    }
  });
  $dropdownMenu.on("click", function (ev) {
    ev.stopPropagation();
  });

  // Abre ou fecha o dropdown
  function dropdownToggle($dropdown) {
    if ($dropdown.hasClass("open")) {
      dropdownClose($dropdown);
    } else {
      dropdownOpen($dropdown);
    }
  }

  // Abre o dropdown
  function dropdownOpen($dropdown) {
    dropdownCloseAll();
    $dropdown.addClass("open");
  }

  // Fecha o dropdown
  function dropdownClose($dropdown) {
    $dropdown.removeClass("open");
  }

  // Fecha todos os dropdown
  function dropdownCloseAll() {
    $dropdowns.removeClass("open");
  }
})();
