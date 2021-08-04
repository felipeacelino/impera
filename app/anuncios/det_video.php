<? if ($anuncio['video'] != '') { ?>
  <div class="grid-12 anuncio-det-bloco anuncio-det-video" data-aos="fade-up">
    <div class="anuncio-det-bloco-titulo">Vídeo</div>
    <div class="anuncio-det-bloco-content">
      <div class="bloco-video-wrapper">
        <iframe src="https://www.youtube.com/embed/<?= $anuncio['video'] ?>?rel=0&amp;showinfo=0" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
      </div>
    </div>
  </div>
<? } ?>
