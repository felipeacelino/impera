<div class="anuncio-det-slide-wrp">
  <ul class="anuncio-det-slide">
    <? foreach ($anuncio['fotos'] as $foto) { ?>
      <li class="anuncio-det-slide-item">
        <div class="anuncio-det-slide-item-foto">
          <img src="<?=URL?>uploads/img/anuncios/<?=$anuncio['id']?>/anuncios_fotos/thumb-600-500/<?=$foto['foto']?>" alt="<?=$anuncio['titulo']?>">
        </div>
      </li>
    <? } ?>
  </ul>
  <div class="container">
    <div class="grid-12 anuncio-det-slide-btns">
      <button class="btn btn-sm btn-white anuncio-btn-fotos" title="Ver fotos"><i class="fas fa-camera"></i><?=$totalFotos?></button>
      <? if ($anuncio['video_id'] != "") { ?>
        <button class="btn btn-sm btn-white modal-open" data-modal="modal-anuncio-video" title="Ver vídeo"><i class="fas fa-video"></i>1</button>
      <? } ?>
      <? if ($anuncio['tour_url'] != "") { ?>
        <a href="<?=$anuncio['tour_url']?>" target="_blank" class="btn btn-sm btn-white" title="Ver tour 360°"><img src="<?=URL_APP?>assets/dist/img/camera360.png" style="display: inline-block; vertical-align: middle; width: 18px;"> 360°</a>
      <? } ?>
    </div>
  </div>
</div>

<!-- Vídeo -->
<div class="modal" id="modal-anuncio-video">
  <div class="modal-wrap modal-lg">
    <span class="modal-btn-close modal-close" data-modal="modal-anuncio-video"></span>
    <div class="modal-header">
      <span class="modal-titulo">Vídeo do imóvel</span>                
    </div>
    <div class="modal-body anuncio-det-video">
      <div class="bloco-video">
        <div class="bloco-video-wrapper">
          <iframe src="https://www.youtube.com/embed/<?=$anuncio['video_id']?>?rel=0&amp;showinfo=0" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- //Vídeo -->

<!-- Galeria (Oculta) -->
<link href="<?=URL_APP?>assets/lightgallery/dist/css/lightgallery.css" rel="stylesheet">
<div class="anuncio-det-galeria" style="display: none;">

  <? foreach ($anuncio['fotos'] as $foto) { ?>
    <a href="<?=URL?>uploads/img/anuncios/<?=$anuncio['id']?>/anuncios_fotos/thumb-1200-0/<?=$foto['foto']?>"><img src="<?=URL?>uploads/img/anuncios/<?=$anuncio['id']?>/anuncios_fotos/thumb-600-440/<?=$foto['foto']?>" alt="<?=$anuncio['titulo']?>"></a>
  <? } ?>

</div>
<!-- //Galeria (Oculta) -->
