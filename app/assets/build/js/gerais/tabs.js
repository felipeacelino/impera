// ------------------------------------
// Tabs
// ------------------------------------
(function () {
  "use strict";

  // Variáveis
  const $tabsNavs = $(".tabs-nav-item");

  // Evento de click em um item da tab
  $tabsNavs.on("click", function (ev) {
    ev.preventDefault();
    // Variáveis
    const $tabItem = $(this);
    const $tab = $tabItem.parent(".tabs-nav").parent(".tabs");
    const contentId = $tabItem.data("tab");
    showTab($tab, contentId);
  });
})();

// Exibe uma tab
function showTab($tab, contentId) {
  // Variáveis
  const $tabNavs = $tab.find(".tabs-nav-item");
  const $tabContens = $tab.find(".tabs-content");
  const $itemNav = $tab.find('.tabs-nav-item[data-tab="' + contentId + '"]');
  const $content = $("#" + contentId);
  // Exibe a tab
  $tabNavs.removeClass("active");
  $tabContens.removeClass("active");
  $itemNav.addClass("active");
  $content.addClass("active");
}
