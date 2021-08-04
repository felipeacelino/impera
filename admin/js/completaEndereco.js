/* =================== COMPLETA ENDEREÇO =================== */
jQuery(document).ready(function ($) {

    $('#cep').on('change', function () {

        var input = $(this);
        var cep = $(this).val();
        var url = $(this).data('url');

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                cep: cep
            },
            beforeSend: function () {
                input.prop('disabled', true);
            },
            success: function (data) {
                console.log(data);
                input.prop('disabled', false);
                try {
                    var endereco = JSON.parse(data);

                    $('#logradouro').val(endereco.logradouro);
                    $('#bairro').val(endereco.bairro);
                    $('#cidade').val(endereco.cidade);
                    $('#estado').val(endereco.uf);
                    $('#numero').focus();

                } catch (e) {
                    return false;
                }
            },
            error: function (xhr, type, exception) {
                input.prop('disabled', false);
                console.log("ajax error response type " + type);
            }
        });
    });
});