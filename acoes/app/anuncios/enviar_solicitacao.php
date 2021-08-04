<?php
if (!isset($_SESSION)) { session_start(); } 
include("../../../paths.php");
include("" . BASE_PATH . "/base.class.php");
include("" . BASE_PATH . "/init.class.php");
include("" . BASE_PATH . "/tools.class.php");
include("" . BASE_PATH . "/crud.class.php");
include("" . CONF_PATH . "/conf.php");
include("" . CLASS_PATH . "/email/email.class.php");

Tools::debug(false);

if (!empty($_POST)) {

  // RESGATA DADOS DO LOCATÁRIO
  $tabela = "locatarios";
  $locatarios = new Crud($tabela);
  $usuario = $locatarios->SelectSingle("SELECT * FROM $tabela WHERE id = " . $_POST['locatario_id']);

  // CADASTRO DA SOLICITAÇÃO
  $tabela = "anuncios_reservas";
  $anuncios = new Crud($tabela);

  $dados = array(
    'anuncio_id' => $_POST['anuncio_id'],
    'locatario_id' => $_POST['locatario_id'],
    'chegada' => Tools::formataDataBd($_POST['chegada']),
    'saida' => Tools::formataDataBd($_POST['saida']),
    'hospedes' => $_POST['hospedes'],
    'diarias' => $_POST['diarias'],
    'mensagem' => $_POST['mensagem'],
    'telefone_reserva' => $_POST['telefone'],
    'total' => $_POST['total'],
    'taxas' => $_POST['taxas'],
    'total_sem_taxas' => $_POST['total_sem_taxas'],
    'data_cad' => Tools::getDateTime(),
    'aceitacao_contrato' => 0,
    'status' => 2
  );

  $insert_solicitacao = $anuncios->Insert($dados);

  if ($insert_solicitacao) {

    // Código
    $ultimo_id = $anuncios->getId();
    $cod = "1" . Tools::zerofill($ultimo_id, 5);
    $updatePedido = $anuncios->Update(array(
      'codigo' => $cod
    ), "WHERE id=$ultimo_id");

    // Datas pré-reservadas
    /*$chegada = Tools::formataDataBd($_POST['chegada']);
    $saida = Tools::formataDataBd($_POST['saida']);
    $dtas = Tools::intervaloDatas($chegada, $saida);
    $acoes_reservas = new Crud('anuncios_datas_indisponiveis');
    foreach ($dtas as $key => $dta) {
      // DADOS
      $dados = array(
        'dta' => $dta,
        'origem' => 2,
        'anuncio_id' => $_POST['anuncio_id'],
        'origem_id' => $ultimo_id,
        'dta_cad' => Tools::getDate()
      );
      $operacao = $acoes_reservas->Insert($dados);
      if (!$operacao) {
        $erro++;
      }
    }*/

    $_POST['total'] = Tools::formataMoeda($_POST['total']);

    // E-MAIL (ADMINISTRAÇÃO)
    $dados_email = array(
      'titulo' => 'Solicitação de Orçamento',
      'infos' => array(
        'Imóvel' => Tools::protege($_POST['imovel']),
        'Locatário' => Tools::protege($usuario['nome']),
        'Chegada' => Tools::protege($_POST['chegada']),
        'Saída' => Tools::protege($_POST['saida']),
        'Noites' => Tools::protege($_POST['diarias']),
        'Hóspedes' => Tools::protege($_POST['hospedes']),
        'Total' => 'R$ '.Tools::protege($_POST['total']),
        'Mensagem' => Tools::protege($_POST['mensagem']),
        'Telefone' => Tools::protege($_POST['telefone'])
      )
    );
    $assunto = "Orçamento - " . $_POST['imovel'];
    $destinatarios = array(EMAIL_CONTATO);
    $responderParaNome = SMTP_USER;
    $responderParaEmail = SMTP_USER;
    $anexos = array();
    $email = new Email($dados_email, $assunto, $destinatarios, $responderParaNome, $responderParaEmail, $anexos);

    $email->enviar();

    // E-MAIL (LOCATÁRIO)
    $dados_email = array(
      'titulo' => 'Solicitação de Orçamento',
      'texto' => 'Olá, <b>' . $usuario['nome'] . '</b>! Sua solicitação foi enviada com sucesso. Em breve um de nossos especialistas entrarão em contato.',
      'infos' => array(
        'Imóvel' => Tools::protege($_POST['imovel']),
        'Chegada' => Tools::protege($_POST['chegada']),
        'Saída' => Tools::protege($_POST['saida']),
        'Noites' => Tools::protege($_POST['diarias']),
        'Hóspedes' => Tools::protege($_POST['hospedes']),
        'Total' => 'R$ '.Tools::protege($_POST['total'])
      )
    );
    $assunto = "Orçamento - " . $_POST['imovel'];
    $destinatarios = array($usuario['email']);
    $responderParaNome = SMTP_USER;
    $responderParaEmail = SMTP_USER;
    $anexos = array();
    $email = new Email($dados_email, $assunto, $destinatarios, $responderParaNome, $responderParaEmail, $anexos);

    $email->enviar();

    echo "ok";
  } else {
    echo "erro";
  }
}
