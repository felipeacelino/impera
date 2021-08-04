$(document).ready(function () {
  /* * * * * * * * * * * * * * * * * * * * * * * * * * * ** * * * * * * * *
   *                    VALIDAÇÃO DE FORMULÁRIO                          *
   * * * * * * * * * * * * * * * * * * * * * * * * * * ** * * * * * * * * */
  var form = $("#form-geral");
  var validator = form.validate({
    ignore: [".checkbox1", "#selecctall"], // Campos ignorados pela validação
    rules: {
      // Validação para CKEDITOR (Por NAME)
      ckeditor: {
        required: function (textarea) {
          CKEDITOR.instances[textarea.id].updateElement();
          var editorcontent = textarea.value.replace(/<[^>]*>/gi, "");
          return editorcontent.length === 0;
        },
      },
      // Nome Completo
      nomecompleto: {
        fullname: true,
      },
      // Validação para senha e confirmação
      senha: {
        minlength: 6,
        maxlength: 8,
      },
      senha2: {
        minlength: 6,
        maxlength: 8,
        equalTo: "#senha",
      },
      // Validação para CPF
      cpf: {
        required: false,
        cpfBR: true,
      },
      // Validação para CNPJ
      cnpj: {
        required: false,
        cnpjBR: true,
      },
      // E-mail Cadastro (Único)
      email_verifica: {
        remote: {
          url: url_script + "acoes/admin/geral/verifica_email.php",
          type: "post",
          data: {
            id_verifica: function () {
              return $("#id").val() != null ? $("#id").val() : "null";
            },
            email_verifica: function () {
              return $("#email_verifica").val();
            },
            tabela: function () {
              return $("#tabela_verifica").val();
            },
          },
        },
      },
    },
    // Mensagens personalizadas
    messages: {
      email_verifica: {
        remote: $.validator.format("O e-mail '{0}' já está em uso."),
      },
    },
    // Ação que exibe os erros abaixo dos campos de foto
    errorPlacement: function (error, element) {
      error.insertAfter(element);
      // Exibe o ícone de alerta ao lado da mensagem de erro
      $("label.error:before").show();
      // Adiciona a classe de erro no plugin ezdz caso seja REQUIRED
      $("input[type=file].ezdz.error")
        .parents("div.ezdz-dropzone")
        .addClass("ezdz-reject");
    },
  });
});
