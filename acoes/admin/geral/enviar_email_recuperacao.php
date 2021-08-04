<?
if (!isset($_SESSION)) { session_start(); } 
include ("../../../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");
include ("".CLASS_PATH."/email/email.class.php");

Tools::debug(false);

/**
* --- RETORNOS ---
* 1 : 'Uma mensagem foi enviada para o seu e-mail de cadastro contendo as instruções para criar uma nova senha.'
* 2 : 'O e-mail informado não encontra-se cadastrado em nosso sistema.'
* 3 : 'Não foi possível realizar essa operação..'
**/

if (!empty($_POST['email'])) {

	$email = Tools::protege($_POST['email']);

	$result_email = $conexao->prepare("SELECT * FROM admin WHERE email=:email LIMIT 1");
	$result_email->bindValue(":email", $email, PDO::PARAM_STR);
	$result_email->execute();

	if ($result_email->rowCount() > 0) {

		// Dados do usuário
    $dados_user = $result_email->fetch(PDO::FETCH_ASSOC);
    
    $dados_email = array(
      'titulo' => 'Redefinição de Senha',
      'texto' => 'Olá, <b>'.$dados_user['nome'].'</b>! Clique no botão abaixo para cadastrar uma nova senha. Você será redirecionado para uma página do site onde poderá cadastrar uma nova senha de acesso.',
      'botao' => array(
        'texto' => 'Cadastrar Senha',
        'url' => URL.'admin/alterar-senha.php?id_user='.base64_encode($dados_user['id']).'&key='.$dados_user['chave']
      )
    );
    $assunto = "Redefinição de Senha";
    $destinatarios = array($dados_user['email']);
    $responderParaNome = SMTP_USER;
    $responderParaEmail = SMTP_USER;
    $anexos = array();
    $email = new Email($dados_email, $assunto, $destinatarios, $responderParaNome, $responderParaEmail, $anexos);
    //echo $email->getPrev();		
    if ($email->enviar()) {
      echo 1;
    } else {
      echo 3;
      //echo $email->getErro();
    }

	} else {
		echo 2;
	} 		
}
