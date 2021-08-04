// GOOGLE RECAPTCHA V2
const $recaptchaEls = $(".recaptcha-el");

// Inicializa o Recaptcha
var initRecaptcha = function () {
  $recaptchaEls.each(function () {
    // Variáveis
    const $el = $(this);
    const $form = $("#" + $el.data("form"));
    const sitekey = $el.data("key");

    const recaptcha = grecaptcha.render($el.get(0), {
      sitekey: sitekey,
      callback: reCaptchaVerify,
      "expired-callback": reCaptchaExpired,
    });

    const $inputResponse = $form.find(".g-recaptcha-response");
    $inputResponse.prop("required", true);

    // Verifica se a validação foi realizada antes de enviar o formulário
    function reCaptchaVerify(response) {
      if (response === $inputResponse.val()) {
        $inputResponse.prop("required", false);
      } else {
        $inputResponse.prop("required", true);
      }
      $form.parsley().validate();
    }
  });
};

// Função chamada ao expirar a validação
function reCaptchaExpired() {
  //location.reload();
  /* showAlert(
    "Atenção",
    "Validação expirada, verifique novamente que não é um robô.",
    "warning"
  ); */
}
