$(function(){

    // Impede que o formulário seja enviado mais de uma vez simultaneamente
    var enviando_formulario = false;

    $('#form-rec').submit(function(e){

        // Dados do formulário
        var obj = this;   
        var form = $(obj);
        var dados = new FormData(obj); 

        // Botão enviar 
        var submit_btn = $('#enviar');

        // Habilita botão de enviar     
        function ativaSubmit() {
            submit_btn.attr('disabled', false);
            submit_btn.removeAttr('disabled');        
            submit_btn.val('Enviar');
            enviando_formulario = false;
        }

        // Desabilita botão de enviar    
        function desativaSubmit() {
            enviando_formulario = true;                   
            submit_btn.attr('disabled', true);
            submit_btn.val('Aguarde');
        }

        // Oculta os campos do formulário
        function ocultaCampos() {
            $('#btn-rec-ok').show();
            $('#form-group-rec').hide();            
            $('#btn-rec-canc').hide();            
            submit_btn.hide();
        }          

        // Mensagem de sucesso
        var msg_success = $('#alert-rec-1'); 
        // Mensagem de erro 2
        var msg_erro2 = $('#alert-rec-2'); 
        // Mensagem de erro 3
        var msg_erro3 = $('#alert-rec-3'); 

        // Oculta as mensagens
        function ocultaMsg() {
            msg_success.hide();
            msg_erro2.hide();
            msg_erro3.hide();
        }

        if ( ! enviando_formulario  ) {   
           
            $.ajax({
                
                beforeSend: function() {                                                
                    desativaSubmit();
                    ocultaMsg();                    
                }, 
            
                url: form.attr('action'),
                type: form.attr('method'),
                data: dados,
                processData: false,
                cache: false,
                contentType: false,
                
                success: function( data ) {                    
                    switch (data) {                       
                        case '1':
                            ocultaCampos();
                            ativaSubmit();
                            msg_success.show();
                            break;
                        case '2':                            
                            msg_erro2.show();
                            ativaSubmit();
                            break;
                        case '3':
                            msg_erro3.show();
                            ativaSubmit();
                            break;      
                    }  
                    $("#emailrec").val("");                                                                     
                },

                error: function (request, status, error) {
                    console.log(request.statusText);     
                    msg_erro3.show();
                    ativaSubmit();                    
                }
            });
        }
        
        return false;
        
    });
});