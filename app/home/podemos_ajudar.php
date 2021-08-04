<? include(ACOES_APP_PATH."/home/podemos_ajudar.php"); ?>

<div class="section-divider sd-m11">
  <div class="section-divider-inner">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1600 200" preserveAspectRatio="none">
      <polygon points="886,86 800,172 714,86 -4,86 -4,204 1604,204 1604,86"></polygon>
      <polygon points="800,172 886,86 900,86 800,186 700,86 714,86"></polygon>
      <polygon points="800,162 876,86 888,86 800,174 712,86 724,86"></polygon>
    </svg>
  </div>
</div>

<section class="secao podemos-ajudar">
  <div class="container">
    <div class="grid-12">
      <h2 class="titulo"><?=$txtSec['titulo']?></h2>
      <!-- <h3 class="subtitulo-secao"></h3> -->
      <div class="btn-container">
        <a href="<?=URL?>imoveis?finalidade=aluguel" class="btn btn-primario">Quero Alugar</a>
        <a href="<?=URL?>imoveis?finalidade=venda" class="btn btn-primario">Quero Comprar</a>
        <a href="<?=URL?>para-voce-proprietario" class="btn btn-primario">Quero Anunciar</a>
      </div>
    </div>
  </div>
</section>
