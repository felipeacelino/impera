<!-- Divisor -->
<div class="section-divider sd-footer sd-m19">
  <div class="section-divider-inner">
    <svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 1920 75">
      <path d="M1963,327H-105V65A2647.49,2647.49,0,0,1,431,19c217.7,3.5,239.6,30.8,470,36,297.3,6.7,367.5-36.2,642-28a2511.41,2511.41,0,0,1,420,48"></path>
      <path opacity="0.5" d="M-127,404H1963V44c-140.1-28-343.3-46.7-566,22-75.5,23.3-118.5,45.9-162,64-48.6,20.2-404.7,128-784,0C355.2,97.7,341.6,78.3,235,50,86.6,10.6-41.8,6.9-127,10"></path>
      <path opacity="0.5" d="M1979,462-155,446V106C251.8,20.2,576.6,15.9,805,30c167.4,10.3,322.3,32.9,680,56,207,13.4,378,20.3,494,24"></path>
      <path opacity="0.5" d="M1998,484H-243V100c445.8,26.8,794.2-4.1,1035-39,141-20.4,231.1-40.1,378-45,349.6-11.6,636.7,73.8,828,150"></path>
    </svg>
  </div>
</div>
<!-- /.Divisor -->

<!-- FOOTER -->
<footer class="footer">
	<div class="footer-content">
		<div class="container">
      
      <!-- MAPA -->
      <div class="grid-2-4 grid-s-12 footer-bloco footer-logo">
        <a href="<?=URL?>" class="logo"><img src="<?=LOGO_PRINCIPAL?>" alt="<?=TITULO_PAGS?>"></a>
        <div class="texto center">Siga-nos nas redes sociais</div>
        <!-- REDES SOCIAIS -->
        <div class="redes-sociais">
          <? if (FACEBOOK != "") { ?>
            <a href="<?=FACEBOOK?>" target="_blank" class="facebook" title="Facebook"><i class="fab fa-facebook-f"></i></a>
          <? } ?>
          <? if (TWITTER != "") { ?>
            <a href="<?=TWITTER?>" target="_blank" class="twitter" title="Twitter"><i class="fab fa-twitter"></i></a>
          <? } ?>
          <? if (INSTAGRAM != "") { ?>
            <a href="<?=INSTAGRAM?>" target="_blank" class="instagram" title="Instagram"><i class="fab fa-instagram"></i></a>
          <? } ?>
          <? if (YOUTUBE != "") { ?>
            <a href="<?=YOUTUBE?>" target="_blank" class="youtube" title=Youtube><i class="fab fa-youtube"></i></a>
          <? } ?>
          <? if (LINKEDIN != "") { ?>
            <a href="<?=LINKEDIN?>" target="_blank" class="linkedin" title=LinkedIn><i class="fab fa-linkedin-in"></i></a>
          <? } ?>
        </div>
        <!-- //REDES SOCIAIS -->
      </div>
      <!-- //MAPA -->

			<!-- MAPA -->
			<div class="grid-2-4 grid-s-12 footer-bloco footer-mapa">

				<h2>Mapa do Site</h2>

				<ul class="footer-lista">
          <li><a href="<?=URL?>">Home</a></li>	
          <li><a href="<?=URL?>sobre">Quem Somos</a></li>
          <li><a href="<?=URL?>para-voce-proprietario">Proprietário</a></li>
          <li><a href="<?=URL?>para-voce-afiliado">Afiliado</a></li>	
          <li><a href="<?=URL?>para-voce-corretor">Corretor</a></li>
          <li><a href="<?=URL?>blog">Blog</a></li>
          <li><a href="<?=URL?>casa-verde-e-amarela">Casa Verde e Amarela</a></li>
				</ul>

			</div>
      <!-- //MAPA -->
      
      <!-- DÚVIDAS -->
			<div class="grid-2-4 grid-s-12 footer-bloco footer-duvidas">

        <h2>Dúvidas</h2>

        <ul class="footer-lista">
          <li><a href="<?=URL?>ajuda">Ajuda</a></li>
          <li><a href="<?=URL?>enviar-documentos">Enviar Documentos<span></span></a></li>
          <!-- <li><a href="<?=URL?>perguntas-frequentes">Perguntas Frequentes</a></li> -->
          <li><a href="<?=URL?>termos-de-uso">Termos de Uso</a></li>
          <li><a href="<?=URL?>politica-de-privacidade">Política de Privacidade</a></li>
          <li><a href="<?=URL?>contato">Contato</a></li>
        </ul>

      </div>
      <!-- //DÚVIDAS -->

      <!-- CONTA -->
			<div class="grid-2-4 grid-s-12 footer-bloco footer-conta">

        <h2>Minha Conta</h2>

        <ul class="footer-lista">
          <li><a href="<?=URL?>cliente/inicio">Cliente</a></li>	
          <li><a href="<?=URL?>proprietario/inicio">Proprietário</a></li>				
          <li><a href="<?=URL?>corretor/inicio">Corretor</a></li>				
          <li><a href="<?=URL?>afiliado/inicio">Afiliado</a></li>
        </ul>

      </div>
      <!-- //CONTA -->

			<!-- NEWSLETTER -->
			<div class="grid-2-4 grid-s-12 footer-bloco footer-newsletter">
				
				<h2>Newsletter</h2>

				<form id="form-newsletter" action="<?=URL?>acoes/app/newsletter/cadastrar_email.php" method="post" class="form-validation">

					<div class="texto">Cadastre seu e-mail e receba promoções e novidades!</div>

					<div class="campo-container">
            <input type="email" name="email" id="email_news" maxlength="255" class="campo" placeholder="Digite seu e-mail" required data-parsley-trigger="change" 
            data-parsley-remote="<?=URL?>acoes/app/newsletter/verifica_email.php" 
            data-parsley-remote-options='{ "type": "POST" }' 
            data-parsley-remote-validator="remote" 
            data-parsley-remote-message="Esse endereço de e-mail já foi cadastrado em nosso sistema"/>
          </div>

          <!-- Captcha -->
          <input type="text" name="cp" tabindex="-1" autocomplete="nope" style="width: 1px; height: 1px; z-index: -1; position: absolute; top: -5000px; left: -5000px; opacity: 0; border: none; background: none; outline: none; box-shadow: none; cursor: default;">
          <!-- //Captcha -->

          <button type="submit" id="enviar_news" class="btn btn-primario outlinex">Cadastrar</button>

        </form>

      </div>
      <!-- //NEWSLETTER -->

    </div>
  </div>

  <!-- BARRA FOOTER -->
  <div class="barra-footer">
    <div class="container">
      <div class="grid-12 copyright">® Impera Real Imobiliária Ltda - CRECI Jurídico - J-7871 - <?=date('Y')?> - Todos os direitos reservados</div>
    </div>
  </div>
  <!-- //BARRA FOOTER -->

</footer>
<!-- //FOOTER -->

<!-- GERAIS -->
<? include('gerais_footer.php'); ?>
