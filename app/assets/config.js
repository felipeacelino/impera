module.exports = function (project) {
  const config = {
    paths: {
      styles: {
        src: project + "/app/assets/build/sass/**/*.scss",
        dest: project + "/app/assets/dist/css/",
      },
      scripts: {
        src: [
          // Desconsidera a pasta de plugins
          "!" + project + "/app/assets/build/js/plugins/**/*.js",
          // Gerais
          project + "/app/assets/build/js/gerais/funcoes.js",
          project + "/app/assets/build/js/gerais/loading.js",
          project + "/app/assets/build/js/gerais/modal.js",
          project + "/app/assets/build/js/gerais/tabs.js",
          project + "/app/assets/build/js/gerais/smooth_scroll.js",
          project + "/app/assets/build/js/gerais/menu.js",
          project + "/app/assets/build/js/gerais/faq.js",
          project + "/app/assets/build/js/gerais/menu_mobile.js",
          project + "/app/assets/build/js/gerais/gotop.js",
          project + "/app/assets/build/js/gerais/mascaras_input.js",
          project + "/app/assets/build/js/gerais/form_validation.js",
          project + "/app/assets/build/js/gerais/completaEndereco.js",
          project + "/app/assets/build/js/gerais/reposiciona_img.js",
          project + "/app/assets/build/js/gerais/numberPicker.js",
          project + "/app/assets/build/js/gerais/dropdown.js",
          project + "/app/assets/build/js/gerais/campos_dinamicos.js",
          project + "/app/assets/build/js/gerais/recaptcha.js",
          project + "/app/assets/build/js/gerais/share_buttons.js",
          project + "/app/assets/build/js/gerais/tooltips.js",
          // Home
          project + "/app/assets/build/js/home/slide.js",
          project + "/app/assets/build/js/home/regioes.js",
          project + "/app/assets/build/js/home/blocos.js",
          // Contato
          project + "/app/assets/build/js/contato/contato.js",
          // Blog
          project + "/app/assets/build/js/blog/envia_comentario.js",
          // Newsletter
          project + "/app/assets/build/js/newsletter/cadastro.js",
          // Anúncios
          project + "/app/assets/build/js/anuncios/anuncios.js",
          project + "/app/assets/build/js/anuncios/detalhe.js",
          project + "/app/assets/build/js/anuncios/agendamento.js",
          // Usuários
          project + "/app/assets/build/js/usuarios/registros.js",
          project + "/app/assets/build/js/usuarios/login.js",
          project + "/app/assets/build/js/usuarios/cadastro.js",
          project + "/app/assets/build/js/usuarios/recuperacao.js",
          project + "/app/assets/build/js/usuarios/cadastrar_senha.js",
          project + "/app/assets/build/js/usuarios/login_facebook.js",
          project + "/app/assets/build/js/usuarios/minha_conta.js",
          project + "/app/assets/build/js/usuarios/update_dados.js",
          project + "/app/assets/build/js/usuarios/anuncios.js",
          project + "/app/assets/build/js/usuarios/arquivos.js",
          project + "/app/assets/build/js/usuarios/fotos.js",
          project + "/app/assets/build/js/usuarios/mensagens.js",
          project + "/app/assets/build/js/usuarios/chat.js",
          project + "/app/assets/build/js/usuarios/visitas.js",

          // Animações (Obs: Sempre manter na última posição)
          project + "/app/assets/build/js/gerais/animateScroll.js",
        ],
        dest: project + "/app/assets/dist/js/",
      },
      plugins: {
        src: [
          project + "/app/assets/build/js/plugins/jquery-2.2.4.min.js",
          project + "/app/assets/build/js/plugins/jquery.mobile.custom.min.js",
          project + "/app/assets/build/js/plugins/slick.min.js",
          project + "/app/assets/build/js/plugins/lightbox.min.js",
          project + "/app/assets/build/js/plugins/jquery.maskedinput.js",
          project + "/app/assets/build/js/plugins/jquery.maskmoney.min.js",
          project + "/app/assets/build/js/plugins/parsley.min.js",
          project + "/app/assets/build/js/plugins/pt-br.js",
          project + "/app/assets/build/js/plugins/moment.min.js",
          project + "/app/assets/build/js/plugins/moment-pt-br.min.js",
          project + "/app/assets/build/js/plugins/daterangepicker.min.js",
          project + "/app/assets/build/js/plugins/markerclusterer.js",
          project + "/app/assets/build/js/plugins/select2.full.min.js",
          project + "/app/assets/build/js/plugins/select2_pt-BR.js",
          project + "/app/assets/build/js/plugins/imagesloaded.min.js",
          project + "/app/assets/build/js/plugins/jquery.sticky.js",
          project + "/app/assets/build/js/plugins/aos.js",
          project + "/app/assets/build/js/plugins/dropzone.min.js",
          project + "/app/assets/build/js/plugins/popper.min.js",
          project + "/app/assets/build/js/plugins/tippy-bundle.umd.min.js",
          project + "/app/assets/build/js/plugins/sortable.min.js",
          project + "/app/assets/build/js/plugins/jquery.timepicker.min.js",
        ],
        dest: project + "/app/assets/dist/js/",
      },
      images: {
        src: project + "/app/assets/build/img/**/*",
        dest: project + "/app/assets/dist/img/",
      },
      pages: {
        src: project + "/app/**/*.php",
      },
    },
  };
  return config;
};
