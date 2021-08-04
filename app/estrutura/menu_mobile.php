<div class="cd-dropdown-wrapper">
  <nav class="cd-dropdown">
    <ul class="cd-dropdown-content">
      
      <!-- HEADER -->
      <li class="cd-dropdown-header">
        <a href="<?=URL?>" class="cd-dropdown-logo">
          <img src="<?=LOGO_PRINCIPAL?>" alt="<?=TITULO_PAGS?>">
        </a>
      </li>
      <!-- //HEADER -->

      <li class="has-children">
        <a href="#" class="dest">Minha Conta</a>
        <ul class="cd-secondary-dropdown is-hidden">
          <li class="go-back"><a href="#0">Voltar</a></li>
          <li class="see-all"><a href="#">Minha Conta</a></li>
          <li><a href="<?=URL?>cliente/inicio">Cliente</a></li>	
          <li><a href="<?=URL?>proprietario/inicio">Proprietário</a></li>				
          <li><a href="<?=URL?>corretor/inicio">Corretor</a></li>				
          <li><a href="<?=URL?>afiliado/inicio">Afiliado</a></li>
        </ul>
      </li>
      <li><a href="<?=URL?>ajuda" class="dest">Ajuda</a></li>
      <li><a href="<?=URL?>">Início<span></span></a></li>
      <li class="has-children">
        <a href="#">Buscar imóveis<span></span></a>
        <ul class="cd-secondary-dropdown is-hidden">
          <li class="go-back"><a href="#0">Voltar</a></li>
          <li class="see-all"><a href="<?=URL?>imoveis">Buscar imóveis</a></li>
          <li><a href="<?=URL?>imoveis?finalidade=venda">Imóveis para comprar</a></li>	
          <li><a href="<?=URL?>imoveis?finalidade=aluguel">Imóveis para alugar</a></li>
        </ul>
      </li>
      <li><a href="<?=URL?>para-voce-proprietario">Proprietário<span></span></a></li>
      <li><a href="<?=URL?>para-voce-afiliado">Afiliado<span></span></a></li>	
      <li><a href="<?=URL?>para-voce-corretor">Corretor<span></span></a></li>
      <li><a href="<?=URL?>sobre">Quem Somos<span></span></a></li>	
      <li><a href="<?=URL?>enviar-documentos">Enviar Documentos<span></span></a></li>	
      <li><a href="<?=URL?>blog">Blog</a></li>	
      
    </ul> <!-- .cd-dropdown-content -->
  </nav> <!-- .cd-dropdown -->
</div> <!-- .cd-dropdown-wrapper -->
