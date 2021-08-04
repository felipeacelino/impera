// ------------------------------------
// Campos dinâmicos
// ------------------------------------
(function () {
  "use strict";

  // Desativa o cache do Ajax
  $.ajaxSetup({ cache: false });

  // Campos dinâmicos
  $("[data-sync-input]").each(function () {
    // Variáveis

    // Campo dinâmico
    const $input = $(this);
    // Campo relativo
    const $relativeInput = $($input.data("sync-input"));
    // Parâmetro do campo relativo
    const parentParam = $input.data("sync-param");
    // URL da ação
    let url = `${$input.data("sync-url")}?${parentParam}=`;
    // Valor cadastrado do campo dinâmico (Update)
    let inputValue = $input.data("sync-value");
    // Parâmetro que ficará no atributo "value" de cada "<option>"
    const optionValue = $input.data("sync-option-value");
    // Parâmetro que ficará dentro de cada "<option>"
    const optionText = $input.data("sync-option-text");
    // Placeholder exibido no campo dinâmico, após o carregamento
    const inputPlaceholder = $input.data("sync-placeholder");

    // Carrega o campo dinâmico ao carregar a página
    loadSyncInput();

    // Evento de alteração do campo relativo
    $relativeInput.on("change", loadSyncInput);

    // Carrega o campo dinâmico
    function loadSyncInput() {
      processingSync();
      // Realiza a requisição dos dados
      $.getJSON(`${url}${$relativeInput.val()}`, function (result) {
        console.log(result);
        if (Array.isArray(result) && result.length > 0) {
          populateInput(result);
        } else {
          resetInput();
        }
        //input.trigger('change');
      }).fail(errorInput);
    }

    // Popula o campo dinâmico com os dados retornados
    function populateInput(list) {
      $input.html("");
      changePlaceholder(inputPlaceholder);
      inputValue = $input.data("sync-value");
      for (let i = 0, n = list.length; i < n; i++) {
        const selected = inputValue == list[i][optionValue] ? "selected" : "";
        $input.append(
          `<option value="${list[i][optionValue]}" ${selected}>${list[i][optionText]}</option>`
        );
      }
      $input.prop("disabled", false);
      if (inputValue != "") {
        $input.trigger("change");
        $input.parsley().validate();
      }
    }

    // Ações executadas enquanto a requisição é processada
    function processingSync() {
      $input.prop("disabled", true);
      $input.html("");
      changePlaceholder("Aguarde...");
    }

    // Reseta o campo dinâmico
    function resetInput() {
      $input.html("");
      changePlaceholder(inputPlaceholder);
      $input.prop("disabled", false);
    }

    // Erro na requisição
    function errorInput(resp) {
      console.log(resp);
      resetInput();
    }

    // Altera o placeholder do campo dinâmico
    function changePlaceholder(text) {
      // Select2
      if ($input.hasClass("select2")) {
        $input.append(`<option></option>`);
        setTimeout(() => {
          $(
            `#select2-${$input.attr(
              "id"
            )}-container .select2-selection__placeholder`
          ).text(text);
        });
      }
      // Select Padrão
      else {
        $input.append(`<option value="" hidden>${text}</option>`);
      }
    }
  });
})();
