<?php
$titulo_pagina = "Site em manutenção";
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH.'/estrutura/head.php'); ?>

<body>

  <!-- MANUTENÇÃO -->
  <div class="secao manutencao">
    <div class="container">
      <div class="manutencao-img">
        <img src="<?=LOGO_PRINCIPAL?>" alt="<?=TITULO_PAGS?>">
      </div>
      <h2>Site em manutenção!</h2>
      <h3>Tente acessar novamente mais tarde</h3>
    </div>	
  </div>
  <!-- //MANUTENÇÃO -->

  <!-- GERAIS -->
  <? include('gerais_footer.php'); ?>

</body>
</html>
