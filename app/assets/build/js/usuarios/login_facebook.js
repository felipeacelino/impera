// LOGIN FACEBOOK
(function() {
  const appId = "123";

  // Carrega o SDK
  (function(d, s, id) {
    var js,
      fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
      return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  })(document, "script", "facebook-jssdk");

  // Inicializa a API
  window.fbAsyncInit = function() {
    FB.init({
      appId: appId,
      cookie: true,
      xfbml: true,
      version: "v3.1"
    });

    /* FB.getLoginStatus(function(response) {
      console.log(response);
    }); */
  };

  // Login
  $("#facebook-login").on("click", function(e) {
    e.preventDefault();

    // Abre o popup para o usuário logar com o facebook
    FB.login(
      function(response) {
        // Verifica se o login foi realizado com sucesso
        if (response.status === "connected") {
          // Retorna os dados do usuário
          FB.api("/me", { fields: "name, email" }, function(response) {
            var dados = response;
            dados.tipo = $("#login-tipo").val();
            //response.picture = 'https://graph.facebook.com/'+dados.id+'/picture';
            // Tentativa de login
            $.ajax({
              url: $("#facebook_id_login").data("url"),
              type: "POST",
              data: dados,
              success: function(data) {
                // Se encontrar o usuário, realiza o login
                if (data == "ok") {
                  window.location.href = $("#login_retorno").val();
                }
                // Se não, abre o modal solicitando para que o usuário realize o login ou efetue um novo cadastro
                else if (data == "erro") {
                  $("#facebook_id_login").val(dados.id);
                  showAlert(
                    "Atenção",
                    `<p><b>Usuário não encontrado</b></p>
                     <p>Caso já possua uma conta, efetue o login através do e-mail e senha.</p>
                     <p>Ainda não se cadastrou? <b><a href="#" class="link open-cadastro">Cadastre-se</a></b></p>`,
                    "warning"
                  );
                } else {
                  showAlert(
                    "Erro",
                    "Não foi possível realizar essa operação.",
                    "error"
                  );
                }
              },
              error: function(request, status, error) {
                console.log(request.responseText);
              }
            });
          });
        }
      },
      // Permissões
      { scope: "public_profile, email" }
    );
  });

  // Cadastro com o facebook
  $("#facebook-cad").on("click", function(e) {
    e.preventDefault();

    // Abre o popup para o usuário logar com o facebook
    FB.login(
      function(response) {
        // Verifica se o login foi realizado com sucesso
        if (response.status === "connected") {
          // Retorna os dados do usuário
          FB.api("/me", { fields: "name, email" }, function(response) {
            var dados = response;
            dados.facebook_id = dados.id;
            dados.tipo = $("#cadastro-tipo").val();

            /* response.picture = 'https://graph.facebook.com/'+dados.id+'/picture'; */

            // Verifica se já existe algum usuário já cadastrado com o e-mail ou facebook_id
            $.ajax({
              url: $("#facebook_id_cad").data("url"),
              type: "POST",
              data: dados,
              success: function(data) {
                if (data == "ok") {
                  // Popula o formulário de cadastro
                  $("#form-cadastro #facebook_id_cad").val(dados.id);
                  $("#form-cadastro #nome").val(dados.name);
                  $("#form-cadastro #email").val(dados.email);
                } else if (data == "erro") {
                  showAlert(
                    "Atenção",
                    '<p>Já existe um usuário vinculado a esta conta do Facebook. Por favor, efetue o <b><a href="#" class="link open-login">Login</a></b>.</p>',
                    "warning"
                  );
                } else {
                  showAlert(
                    "Erro",
                    "Não foi possível realizar essa operação.",
                    "error"
                  );
                }
              },
              error: function(request, status, error) {
                console.log(request.responseText);
              }
            });
          });
        }
      },
      // Permissões
      { scope: "public_profile, email" }
    );
  });

  // Vincula com o facebook
  $("#facebook-vinc").on("click", function(e) {
    e.preventDefault();

    // Abre o popup para o usuário logar com o facebook
    FB.login(
      function(response) {
        // Verifica se o login foi realizado com sucesso
        if (response.status === "connected") {
          // Retorna os dados do usuário
          FB.api("/me", { fields: "name, email" }, function(response) {
            var dados = response;
            dados.acao = "vincular";

            $.ajax({
              url: url_base + "acoes/app/corretor/vincular_facebook.php",
              type: "POST",
              data: dados,
              success: function(data) {
                if (data == "ok") {
                  showAlert(
                    "Sucesso",
                    "O Facebook foi vinculado a sua conta com sucesso.",
                    "success"
                  );
                  setTimeout(function() {
                    window.location.reload();
                  }, 2000);
                } else {
                  showAlert(
                    "Atenção",
                    "<p>Já existe um usuário vinculado a esta conta do Facebook.</p>",
                    "warning"
                  );
                }
              },
              error: function(request, status, error) {
                console.log(request.responseText);
              }
            });
          });
        }
      },
      // Permissões
      { scope: "public_profile, email" }
    );
  });

  // Desvincular com o facebook
  $("#facebook-des").on("click", function(e) {
    e.preventDefault();

    var dados = {
      acao: "desvincular"
    };

    $.ajax({
      url: url_base + "acoes/app/corretor/vincular_facebook.php",
      type: "POST",
      data: dados,
      success: function(data) {
        if (data == "ok") {
          showAlert(
            "Sucesso",
            "O Facebook foi desvinculado da sua conta com sucesso.",
            "success"
          );
          setTimeout(function() {
            window.location.reload();
          }, 2000);
        } else {
          showAlert(
            "Erro",
            "Não foi possível realizar essa operação.",
            "error"
          );
        }
      },
      error: function(request, status, error) {
        console.log(request.responseText);
      }
    });
  });
})();
