  <div id="secao-avaliacoes" class="grid-12 anuncio-det-bloco anuncio-det-avaliacoes" data-aos="fade-up">
    <div class="anuncio-det-bloco-titulo">Avaliações</div>
    <div class="anuncio-det-bloco-content">
      <? if ($numAvaliacoes > 0) { ?>
        <ul class="anuncio-det-avaliacoes-lista">
          <? foreach ($avaliacoes as $avaliacao) { ?>
            <!-- Repete -->
            <li class="avaliacao">
              <div class="avaliacao-usuario">
                <div class="avaliacao-foto">
                  <? if ($avaliacao['foto'] != '') { ?>
                  <figure><img src="<?= URL ?>uploads/img/anuncios_avaliacoes/<?= $avaliacao['id'] ?>/thumb-250-250/<?= $avaliacao['foto'] ?>" alt="<?= $avaliacao['nome'] ?>"></figure>
                  <? } else { ?>
                  <figure><img src="<?=URL?>static/img/admin/user-profile.png" alt="<?= $avaliacao['nome'] ?>"></figure>
                  <? } ?>
                </div>
                <div class="avaliacao-infos">
                  <div class="star-rating">
                    <? for ($i = 0; $i < 5; $i++) { ?>
                      <? if ($i < $avaliacao['estrelas']) { ?>
                        <i class="fas fa-star active"></i>
                      <? } else { ?>
                        <i class="fas fa-star"></i>
                      <? } ?>
                    <? } ?>
                  </div>
                  <b><?= $avaliacao['nome'] ?></b>
                  <span><?= Tools::retornaMes($avaliacao['data_cad']); ?> de <?= Tools::retornaAno($avaliacao['data_cad']); ?></span>
                </div>
              </div>
              <div class="avaliacao-mensagem"><?= $avaliacao['avaliacao'] ?></div>
            </li>
            <!-- //Repete -->
          <? } ?>
        </ul>
      <? } else { ?>
        <!-- Sem avaliações -->
        <div class="texto">Nenhuma avaliação. Seja o primeiro a avaliar este imóvel!</div>
        <? if (isset($_SESSION['user']['locatario']['id'])) { ?>
          <div class="btn-container left" style="margin-bottom: 20px;">
            <button class="btn btn-sm btn-primario modal-open" data-modal="modal-avaliacao">Avaliar</button>
          </div>
        <? } else { ?>
          <div class="btn-container left" style="margin-bottom: 20px;">
          <a class="btn btn-sm btn-primario open-login">Avaliar</a>
          </div>
        <? } ?>
      <? } ?>
    </div>
  </div>
