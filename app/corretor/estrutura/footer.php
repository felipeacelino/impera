<footer class="conta-footer">
  <div><?= TITULO_PAGS ?> &copy - <?=date('Y')?> - Todos os direitos reservados</div>
</footer>

<script>
const $pag = document.querySelector('.pg-conta');
const $menuItem = document.querySelector('.conta-lateral-menu [data-menu="'+$pag.dataset.pg+'"]');
$menuItem.classList.add('active');
</script>

<!-- GERAIS -->
<? include(APP_PATH . '/estrutura/gerais_footer.php'); ?>
