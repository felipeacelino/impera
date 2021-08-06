<footer class="conta-footer">
  <div><?= TITULO_PAGS ?> &copy - <?=date('Y')?> - Todos os direitos reservados</div>
</footer>

<div class="modal" id="modal-link-afiliado">
  <div class="modal-wrap modal-sm">
    <span class="modal-btn-close modal-close" data-modal="modal-link-afiliado"></span>
    <div class="modal-header">
      <span class="modal-titulo">Link de Afiliados</span>                
    </div>
    <div class="modal-body">
      <div class="texto center">
        <p>Copie o link abaixo e compartilhe com possíveis proprietários e clientes.</p>
      </div>
      <div class="campo-container">
        <input type="text" name="link-afiliado" id="link-afiliado" class="campo" value="<?=$user['link_afiliado']?>" readonly />
      </div>
      <div style="text-align: center;">
        <button type="button" class="btn btn-sm btn-primario btn-copy-link">Copiar Link</button>
      </div>
    </div>
  </div>
</div>

<script>
const $pag = document.querySelector('.pg-conta');
const $menuItem = document.querySelector('.conta-lateral-menu [data-menu="'+$pag.dataset.pg+'"]');
$menuItem.classList.add('active');
</script>

<!-- GERAIS -->
<? include(APP_PATH . '/estrutura/gerais_footer.php'); ?>
