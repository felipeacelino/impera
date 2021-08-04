<? include(ACOES_APP_PATH."/anuncios/detalhe.php"); ?>
<?php
$titulo_pagina = $anuncio['titulo']." - ".TITULO_PAGS;
$descr_site = "";

$og_title = $anuncio['titulo'];
$og_description = $descr_site;
$og_description = Tools::limitarTexto($og_description, 100);
$og_image = URL."uploads/img/proprietarios/".$anuncio['id_usuario']."/anuncios/".$anuncio['id']."/anuncios_fotos/thumb-600-600/".$anuncio['fotos'][0]['foto'];
$og_url = URL.$anuncio['slug'];
$canonical = $og_url;
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH.'/estrutura/head.php'); ?>

<body class="pag-anuncio">

<!-- HEADER -->
<? include(APP_PATH.'/estrutura/header.php'); ?>

<!-- FOTOS -->
<? include(APP_PATH.'/anuncios/det_fotos.php'); ?>

<!-- PÁGINA -->
<section class="secao secao-anuncio">
  <div class="container">

    <!-- CONTEÚDO -->
    <div class="secao-anuncio-content">

      <!-- Título -->
      <? include(APP_PATH.'/anuncios/det_titulo.php'); ?>

      <span id="reserva-mobile-sec" class="load-img-mobile" data-img="reserva-mobile"></span>

      <!-- Atributos -->
      <? include(APP_PATH.'/anuncios/det_atributos.php'); ?>

      <!-- Documentos -->
      <? include(APP_PATH.'/anuncios/det_documentos.php'); ?>

      <!-- Cômodos -->
      <? include(APP_PATH.'/anuncios/det_comodos.php'); ?>

      <!-- Detalhes (Características) -->
      <? include(APP_PATH.'/anuncios/det_caracteristicas.php'); ?>

      <!-- Condomínio -->
      <? include(APP_PATH.'/anuncios/det_condominio.php'); ?>

      <!-- Mobílias -->
      <? include(APP_PATH.'/anuncios/det_mobilias.php'); ?>

      <!-- Comodidades -->
      <? include(APP_PATH.'/anuncios/det_comodidades.php'); ?>

      <!-- Segurança -->
      <? include(APP_PATH.'/anuncios/det_seguranca.php'); ?>

      <!-- Lazer -->
      <? include(APP_PATH.'/anuncios/det_lazer.php'); ?>

      <!-- Cômodos (Comercial) -->
      <? include(APP_PATH.'/anuncios/det_comodos2.php'); ?>

      <!-- Taxas -->
      <? include(APP_PATH.'/anuncios/det_taxas.php'); ?>

      <!-- Simulador -->
      <? include(APP_PATH.'/anuncios/det_simulador.php'); ?>

      <!-- Localização -->
      <? include(APP_PATH.'/anuncios/det_localizacao.php'); ?>

      <!-- Modais infos -->
      <? include(APP_PATH.'/anuncios/det_modais_infos.php'); ?>

    </div>
    <!-- //CONTEÚDO -->

    <!-- LATERAL -->
    <? include(APP_PATH . '/anuncios/det_lateral.php'); ?>

    <!-- RELACIONADOS -->
    <? include(APP_PATH.'/anuncios/det_relacionados.php'); ?>

  </div>
</section>
<!-- //PÁGINA -->

<!-- AGENDAMENTOS -->
<? include(APP_PATH.'/anuncios/det_agendamento.php'); ?>

<!-- FOOTER -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?=MAPS_API?>"></script>
<? include(APP_PATH.'/estrutura/footer.php'); ?>

<!-- Script Galeria -->
<script src="<?=URL_APP?>assets/lightgallery/dist/js/lightgallery-all.min.js"></script>
<script>
let sliding = false;
$(".anuncio-det-slide").on('beforeChange', function() {
  sliding = true;
}).on('afterChange', function() {
  sliding = false;
});
const controls = !isMobileX(1199);
$(".anuncio-det-galeria").lightGallery({
  share: false,
  download: false,
  autoplay: false,
  actualSize: false,
  controls: controls
});
$(".anuncio-btn-fotos").on("click", function (ev) {
  ev.preventDefault();
  $(".anuncio-det-galeria a:first-child").trigger("click");
});
$(".anuncio-det-slide-item").on("click", function (ev) {
  ev.preventDefault();
  if (!sliding) {
    const index = $(this).data('slick-index') + 1;
    $(".anuncio-det-galeria a:nth-child("+index+")").trigger("click");
  }  
});
</script>
<!-- //Script Galeria -->

</body>
</html>
