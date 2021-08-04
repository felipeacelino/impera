<!--menu lateral -->
<div class="col-md-3 left_col menu_fixed">
  <div class="left_col scroll-view">

    <div class="navbar nav_title" style="border: 0;">
      <a href="<?= URL_ADMIN; ?>" class="site_title"><i class="fas fa-home" style="color: #fff !important;"></i> <span>Impera Real</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile">
      <div class="profile_pic">
        <a href="<?= URL_ADMIN; ?>">
          <img src="<?= LOGO_ADMIN; ?>" class="img-circle profile_img">
        </a>
      </div>
      <div class="profile_info">
        <span>Bem-vindo(a),</span>
        <h2><?= NOME_USUARIO_ADMIN; ?></h2>
      </div>
    </div>
    <!-- /menu profile quick info -->

    <div class="clearfix"></div>
    <br>
    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">

        <h3>Anúncios</h3>

        <ul class="nav side-menu">

          <!-- repete -->
          <? if ((ID_USUARIO_ADMIN == 1) || (in_array('anuncios_reservas', $permissoes_usuarios_admin))
          ) { ?>
            <li>
              <a href="<?= URL_ADMIN; ?>anuncios/anuncios_reservas/<?= TOKEN; ?>/view"><i class="fas fa-calendar-alt"></i>Reservas</a>
            </li>
          <? } ?>
          <!-- repete -->

          <!-- repete -->
          <? if ((ID_USUARIO_ADMIN == 1) || (in_array('anuncios', $permissoes_usuarios_admin))
          ) { ?>
            <li>
              <a href="<?= URL_ADMIN; ?>anuncios/anuncios/<?= TOKEN; ?>/view"><i class="fas fa-tags"></i>Anúncios</a>
            </li>
          <? } ?>
          <!-- repete -->

          <!-- repete -->
          <? if ((ID_USUARIO_ADMIN == 1) || (in_array('anuncios', $permissoes_usuarios_admin))
          ) { ?>
            <li>
              <a href="<?= URL_ADMIN; ?>anuncios/buscas/<?= TOKEN; ?>/view"><i class="fas fa-search"></i>Buscas Personalizadas</a>
            </li>
          <? } ?>
          <!-- repete -->

          <!-- repete -->
          <? if ((ID_USUARIO_ADMIN == 1) || (in_array('locatarios', $permissoes_usuarios_admin))
          ) { ?>
            <?
              $locatarios_mensagens = new Crud("locatarios_mensagens");
              $totalMsgLocatario = $locatarios_mensagens->SelectTotalSQL("SELECT id FROM locatarios_mensagens WHERE lida = 0 AND remetente='usuario'");
            ?>
            <li>
              <a href="<?= URL_ADMIN; ?>locatarios/locatarios/<?= TOKEN; ?>/view"><i class="fas fa-user"></i>Locatários
                <? if ($totalMsgLocatario > 0) { ?>
                  <span class="mcount"><?= $totalMsgLocatario ?></span>
                <? } ?>
              </a>
            </li>
          <? } ?>
          <!-- repete -->

          <!-- repete -->
          <? if ((ID_USUARIO_ADMIN == 1) || (in_array('proprietarios', $permissoes_usuarios_admin))
          ) { ?>
            <?
              $proprietarios_mensagens = new Crud("proprietarios_mensagens");
              $totalMsgProprietario = $proprietarios_mensagens->SelectTotalSQL("SELECT id FROM proprietarios_mensagens WHERE lida = 0 AND remetente='usuario'");
            ?>
            <li>
              <a href="<?= URL_ADMIN; ?>proprietarios/proprietarios/<?= TOKEN; ?>/view"><i class="fas fa-user-tie"></i>Proprietários
                <? if ($totalMsgProprietario > 0) { ?>
                  <span class="mcount"><?= $totalMsgProprietario ?></span>
                <? } ?>
              </a>
            </li>
          <? } ?>
          <!-- repete -->

          <!-- repete -->
          <? if ((ID_USUARIO_ADMIN == 1) || (in_array('anuncios_destinos', $permissoes_usuarios_admin)) || (in_array('anuncios_condominios', $permissoes_usuarios_admin)) || (in_array('anuncios_caracteristicas', $permissoes_usuarios_admin))
          ) { ?>
            <li>
              <a>
                <i class="fas fa-sliders-h"></i>Filtros
                <span class="fas fa-chevron-down"></span>
              </a>
              <ul class="nav child_menu">
                <? if ((in_array('anuncios_cidades', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>anuncios/anuncios_cidades/<?= TOKEN; ?>/view/">Cidades e Bairros</a></li>
                <? } ?>
                <? if ((in_array('anuncios_regioes', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>anuncios/anuncios_regioes/<?= TOKEN; ?>/view/">Regiões</a></li>
                <? } ?>
                <? if ((in_array('anuncios_tipos', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>anuncios/anuncios_tipos/<?= TOKEN; ?>/view/">Tipos de imóveis</a></li>
                <? } ?>
                <li>
                  <a>Residencial<span class="fas fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <? if ((in_array('anuncios_caracteristicas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                      <li class="sub_menu"><a href="<?= URL_ADMIN; ?>anuncios/anuncios_caracteristicas/<?= TOKEN; ?>/view/">Detalhes</a></li>
                    <? } ?>
                    <? if ((in_array('anuncios_comodos', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                      <li><a href="<?= URL_ADMIN; ?>anuncios/anuncios_comodos/<?= TOKEN; ?>/view/">Cômodos</a></li>
                    <? } ?>
                    <? if ((in_array('anuncios_condominio', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                      <li><a href="<?= URL_ADMIN; ?>anuncios/anuncios_condominio/<?= TOKEN; ?>/view/">Condomínio</a></li>
                    <? } ?>
                    <? if ((in_array('anuncios_mobilias', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                      <li><a href="<?= URL_ADMIN; ?>anuncios/anuncios_mobilias/<?= TOKEN; ?>/view/">Mobílias e Eletros</a></li>
                    <? } ?>
                  </ul>
                </li>
                <li>
                  <a>Comercial<span class="fas fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <? if ((in_array('anuncios_comodidades', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                      <li><a href="<?= URL_ADMIN; ?>anuncios/anuncios_comodidades/<?= TOKEN; ?>/view/">Comodidades e Serviços</a></li>
                    <? } ?>
                    <? if ((in_array('anuncios_seguranca', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                      <li><a href="<?= URL_ADMIN; ?>anuncios/anuncios_seguranca/<?= TOKEN; ?>/view/">Segurança</a></li>
                    <? } ?>
                    <? if ((in_array('anuncios_lazer', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                      <li><a href="<?= URL_ADMIN; ?>anuncios/anuncios_lazer/<?= TOKEN; ?>/view/">Lazer e Esporte</a></li>
                    <? } ?>
                    <? if ((in_array('anuncios_comodos2', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                      <li><a href="<?= URL_ADMIN; ?>anuncios/anuncios_comodos2/<?= TOKEN; ?>/view/">Cômodos</a></li>
                    <? } ?>
                  </ul>
                </li>
                <? if ((in_array('regioes_atuacao', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>anuncios/regioes_atuacao/<?= TOKEN; ?>/view/">Regiões de atuação (Corretores)</a></li>
                <? } ?>
              </ul>
            </li>
          <? } ?>
          <!-- repete -->

        </ul>

        <h3>Institucional</h3>

        <ul class="nav side-menu">

          <!-- repete -->
          <? if ((ID_USUARIO_ADMIN == 1) || (in_array('slide', $permissoes_usuarios_admin)) || (in_array('blocos_home', $permissoes_usuarios_admin) || (in_array('paginas', $permissoes_usuarios_admin)))) { ?>
            <li>
              <a>
                <i class="fas fa-home"></i>Home
                <span class="fas fa-chevron-down"></span>
              </a>
              <ul class="nav child_menu">
                <? if ((in_array('slide', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>slide/slide/<?= TOKEN; ?>/view/">Busca</a></li>
                <? } ?>
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_imoveis-home">Imóveis</a></li>
                <? } ?>
                <? if ((in_array('blocos_home', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>blocos_home/blocos_home/<?= TOKEN; ?>/view/">Como funciona</a></li>
                <? } ?>
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_podemos-ajudar">Como podemos ajudar</a></li>
                <? } ?>
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_regioes-home">Regiões</a></li>
                <? } ?>
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_contato-home">Ajuda</a></li>
                <? } ?>
              </ul>
            </li>
          <? } ?>
          <!-- repete -->

          <!-- repete -->
          <? if ((ID_USUARIO_ADMIN == 1) || (in_array('paginas', $permissoes_usuarios_admin))) { ?>
            <li>
              <a>
                <i class="fas fa-user"></i> Para proprietários
                <span class="fas fa-chevron-down"></span>
              </a>
              <ul class="nav child_menu">
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_para-voce-proprietario">Página</a></li>
                <? } ?>
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_proprietario-vantagens">Vantagens</a></li>
                <? } ?>
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_proprietario-ajuda">Me ajuda</a></li>
                <? } ?>
              </ul>
            </li>
          <? } ?>
          <!-- repete -->

          <!-- repete -->
          <? if ((ID_USUARIO_ADMIN == 1) || (in_array('paginas', $permissoes_usuarios_admin))) { ?>
            <li>
              <a>
                <i class="fas fa-user"></i> Para afiliados
                <span class="fas fa-chevron-down"></span>
              </a>
              <ul class="nav child_menu">
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_para-voce-afiliado">Página</a></li>
                <? } ?>
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_comissoes-afiliados">Comissões</a></li>
                <? } ?>
              </ul>
            </li>
          <? } ?>
          <!-- repete -->

          <!-- repete -->
          <? if ((ID_USUARIO_ADMIN == 1) || (in_array('paginas', $permissoes_usuarios_admin))) { ?>
            <li>
              <a>
                <i class="fas fa-user"></i> Para corretores
                <span class="fas fa-chevron-down"></span>
              </a>
              <ul class="nav child_menu">
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_para-voce-corretor">Página</a></li>
                <? } ?>
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_faq-corretor-imovel-pronto">Faq (Imóvel pronto)</a></li>
                <? } ?>
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_faq-corretor-imovel-planta">Faq (Imóvel planta)</a></li>
                <? } ?>
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_faq-corretor-imovel-locacao">Faq (Imóvel locação)</a></li>
                <? } ?>
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_corretor-ajuda">Me ajuda</a></li>
                <? } ?>
              </ul>
            </li>
          <? } ?>
          <!-- repete -->

          <!-- repete -->
          <? if ((ID_USUARIO_ADMIN == 1) || (in_array('paginas', $permissoes_usuarios_admin))) { ?>
            <li>
              <a>
                <i class="fas fa-user"></i> Para clientes
                <span class="fas fa-chevron-down"></span>
              </a>
              <ul class="nav child_menu">
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_cliente-ajuda">Me ajuda</a></li>
                <? } ?>
              </ul>
            </li>
          <? } ?>
          <!-- repete -->

          <!-- repete -->
          <? if ((ID_USUARIO_ADMIN == 1) || (in_array('paginas', $permissoes_usuarios_admin))) { ?>
            <li>
              <a>
                <i class="fas fa-file-upload"></i> Enviar Documentos
                <span class="fas fa-chevron-down"></span>
              </a>
              <ul class="nav child_menu">
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_enviar-documentos">Página</a></li>
                <? } ?>
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_documentos-beneficios">Benefícios</a></li>
                <? } ?>
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_quais-documentos-enviar">Quais documentos enviar</a></li>
                <? } ?>
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_quais-documentos-enviar-comprar">Lista documentos (Comprar)</a></li>
                <? } ?>
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_quais-documentos-enviar-alugar">Lista documentos (Alugar)</a></li>
                <? } ?>
              </ul>
            </li>
          <? } ?>
          <!-- repete -->

          <!-- repete -->
          <? if ((ID_USUARIO_ADMIN == 1) || (in_array('paginas', $permissoes_usuarios_admin)) || (in_array('faq', $permissoes_usuarios_admin))
          ) { ?>
            <li>
              <a>
                <i class="fas fa-file-alt"></i>Outras páginas
                <span class="fas fa-chevron-down"></span>
              </a>
              <ul class="nav child_menu">
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_sobre">Quem Somos</a></li>
                <? } ?>
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_contato">Contato</a></li>
                <? } ?>
                <? if ((in_array('faq', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <!-- <li><a href="<?= URL_ADMIN; ?>faq/faq/<?= TOKEN; ?>/view">Perguntas frequentes</a></li> -->
                <? } ?>
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_ajuda">Ajuda</a></li>
                <? } ?>
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_casa-verde-e-amarela">Casa Verde e Amarela</a></li>
                <? } ?>
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_politica-de-privacidade">Política de privacidade</a></li>
                <? } ?>
                <? if ((in_array('paginas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>paginas/paginas/<?= TOKEN; ?>/edit/pag_termos-de-uso">Termos de uso</a></li>
                <? } ?>
              </ul>
            </li>
          <? } ?>
          <!-- repete -->

          <!-- repete -->
          <? if ((ID_USUARIO_ADMIN == 1) || (in_array('blog_posts', $permissoes_usuarios_admin)) || (in_array('blog_categorias', $permissoes_usuarios_admin)) || (in_array('blog_comentarios', $permissoes_usuarios_admin))
          ) { ?>
            <li>
              <a>
                <i class="fas fa-rss"></i>Blog
                <span class="fas fa-chevron-down"></span>
              </a>
              <ul class="nav child_menu">
                <? if ((in_array('blog_posts', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>blog/blog_posts/<?= TOKEN; ?>/view/">Posts</a></li>
                <? } ?>
                <? if ((in_array('blog_comentarios', $permissoes_usuarios_admin) | s | (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>blog/blog_comentarios/<?= TOKEN; ?>/view/">Comentários</a></li>
                <? } ?>
              </ul>
            </li>
          <? } ?>
          <!-- repete -->

          <!-- repete -->
          <? if ((ID_USUARIO_ADMIN == 1) || (in_array('newsletter', $permissoes_usuarios_admin))
          ) { ?>
            <li>
              <a href="<?= URL_ADMIN; ?>newsletter/newsletter/<?= TOKEN; ?>/view"><i class="fas fa-envelope"></i>Newsletter</a>
            </li>
          <? } ?>
          <!-- repete -->

          <h3>Sistema</h3>

          <!-- repete -->
          <? if ((ID_USUARIO_ADMIN == 1) || (in_array('configuracoes_loja', $permissoes_usuarios_admin)) || (in_array('anuncios_taxas', $permissoes_usuarios_admin)) || (in_array('logos', $permissoes_usuarios_admin))
          ) { ?>
            <li>
              <a>
                <i class="fas fa-cog"></i>Opções do site
                <span class="fas fa-chevron-down"></span>
              </a>
              <ul class="nav child_menu">
                <? if ((in_array('anuncios_taxas', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>anuncios/anuncios_taxas/<?= TOKEN; ?>/view/">Taxas (Venda)</a></li>
                <? } ?>
                <? if ((in_array('configuracoes_loja', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>geral/configuracoes_loja/<?= TOKEN; ?>/edit">Informações gerais</a></li>
                <? } ?>
                <? if ((in_array('logos', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>geral/logos/<?= TOKEN; ?>/view/">Logos</a></li>
                <? } ?>
              </ul>
            </li>
          <? } ?>
          <!-- repete -->

          <!-- repete -->
          <? if ((in_array('usuarios', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
            <li>
              <a>
                <i class="fas fa-user"></i>Administradores
                <span class="fas fa-chevron-down"></span>
              </a>

              <ul class="nav child_menu">
                <? if ((in_array('usuarios', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>geral/usuarios/<?= TOKEN; ?>/view">Usuários</a></li>
                <? } ?>
                <? if ((in_array('niveis', $permissoes_usuarios_admin) || (ID_USUARIO_ADMIN == 1))) { ?>
                  <li><a href="<?= URL_ADMIN; ?>geral/niveis/<?= TOKEN; ?>/view">Níveis de acesso</a></li>
                <? } ?>
                <? if (ID_USUARIO_ADMIN == 1) { ?>
                  <li><a href="<?= URL_ADMIN; ?>geral/categorias_niveis/<?= TOKEN; ?>/view">Categorias de acesso</a></li>
                <? } ?>
              </ul>
            </li>
          <? } ?>
          <!-- repete -->

          <!-- repete -->
          <? if (ID_USUARIO_ADMIN == 1) { ?>
            <li>
              <a href="<?= URL_ADMIN; ?>geral/configuracoes/<?= TOKEN; ?>/edit"><i class="fas fa-wrench"></i>Configurações</a>
            </li>
          <? } ?>
          <!-- repete -->

        </ul>
      </div>
    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Sair" href="<?= URL; ?>acoes/admin/geral/logout.php">
        <span class="glyphicon glyphicon-off"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Avisos" href="<?= URL_ADMIN; ?>geral/alertas/<?= TOKEN; ?>/view">
        <span class="glyphicon glyphicon-bell"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>
