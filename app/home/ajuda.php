<? include(ACOES_APP_PATH."/home/ajuda.php"); ?>
<section class="secao fale-conosco" style="background-image: url('<?=URL_APP?>/assets/dist/img/bg_contato.jpg');">
  <span class="mascara"></span>
  <div class="container">

    <div class="grid-7 grid-m-12 grid-s-12 fale-conosco-infos">
      <h2 class="titulo left"><?=$txtSec['titulo']?></h2>
      <h3 class="texto"><?=$txtSec['subtitulo']?></h3>
      <ul class="fale-conosco-bloco">
        <li>
          <div class="icon"><i class="fas fa-envelope"></i></div>
          <div class="infos">
            <span>Envie um e-mail para</span>
            <a href="mailto:contato@imperareal.com.br">contato@imperareal.com.br</a>
          </div>
        </li>
        <li>
          <div class="icon"><i class="fas fa-flip-horizontal fa-phone"></i></div>
          <div class="infos">
            <span>Converse com a gente</span>
            <a href="tel:(21) 96530-7325">(21) 96530-7325</a>
          </div>
        </li>
      </ul>
    </div>

    <div class="grid-5 fale-conosco-img">
      <figure><img src="<?=URL?>uploads/img/paginas/<?=$txtSec['id']?>/thumb-800-0/<?=$txtSec['foto']?>" alt="Fale Conosco"></figure>
    </div>

  </div>
</section>
