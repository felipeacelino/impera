// ------------------------------------
// Tooltips
// ------------------------------------
var tippyInstance;

// Configurações padrão
tippy.setDefaultProps({
  allowHTML: true, // Habilita as tags HTML no conteúdo
  maxWidth: 250,
  theme: "lp-dark",
});

// Inicializa a instância do Tippy.js
function initTippy() {
  tippyInstance = tippy("[data-tippy-content]");
}
initTippy();
