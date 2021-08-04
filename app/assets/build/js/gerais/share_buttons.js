// ------------------------------------
// Botões de Compartilhamento
// ------------------------------------
(function () {
  "use strict";

  // Variáveis
  const url = location.href;
  const urlEncoded = encodeURIComponent(url);
  const pageTitle = document.title;
  const pageTitleEncoded = encodeURIComponent(pageTitle);
  const $btnFacebook = $(".share-button.facebook");
  const $btnTwitter = $(".share-button.twitter");
  const $btnWhatsApp = $(".share-button.whatsapp");
  const $btnLinkedIn = $(".share-button.linkedin");
  const $btnCopyLink = $(".share-button.copy-link");

  // Cria o link de compartilhamento para o Facebook
  function makeShareLinkFacebook() {
    const shareLinkFacebook =
      "https://www.facebook.com/sharer/sharer.php?u=" + urlEncoded;
    $btnFacebook.attr("href", shareLinkFacebook);
  }
  makeShareLinkFacebook();

  // Cria o link de compartilhamento para o Twiiter
  function makeShareLinkTwiiter() {
    const shareLinkTwiiter =
      "https://twitter.com/intent/tweet?url=" +
      urlEncoded +
      "&text=" +
      pageTitle;
    $btnTwitter.attr("href", shareLinkTwiiter);
  }
  makeShareLinkTwiiter();

  // Cria o link de compartilhamento para o WhatsApp
  function makeShareLinkWhatsApp() {
    const shareLinkWhatsApp =
      "https://api.whatsapp.com/send?text=" + pageTitle + " " + urlEncoded;
    $btnWhatsApp.attr("href", shareLinkWhatsApp);
  }
  makeShareLinkWhatsApp();

  // Cria o link de compartilhamento para o LinkedIn
  function makeShareLinkLinkedIn() {
    const shareLinkLinkedIn =
      "https://www.linkedin.com/shareArticle?mini=true&url=" +
      urlEncoded +
      "&title=" +
      pageTitleEncoded;
    $btnLinkedIn.attr("href", shareLinkLinkedIn);
  }
  makeShareLinkLinkedIn();

  // Evento de click no botão para copiar o link da página
  $btnCopyLink.on("click", function (ev) {
    ev.preventDefault();
    copyToClipboard(url);
    showAlert(
      "Link Copiado",
      "O link para esta página foi copiado com sucesso.",
      "success"
    );
  });
})();
