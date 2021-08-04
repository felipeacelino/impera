<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\OAuth;

require ("PHPMailer/src/Exception.php");
require ("PHPMailer/src/PHPMailer.php");
require ("PHPMailer/src/SMTP.php");
require ("PHPMailer/src/OAuth.php");

class Email {
  // Configurações
	protected $host = SMTP_HOST;
	protected $user = SMTP_USER;
  protected $password = SMTP_PASS;
  protected $autenticacao;
  protected $gmail;
	protected $erro;
	protected $dados = array();
	protected $assunto;
  protected $corpo;
  protected $destinatarios = array();
	protected $responderParaNome;	    
  protected $responderParaEmail;
  protected $anexos = array();

  // Estilo
  protected $mainColor = "#7f277a";
  protected $fontLight = "#757e8d";
  protected $fontDark = "#3c4758";

	// Construtor
	public function __construct($dados, $assunto, $destinatarios, $responderParaNome, $responderParaEmail, $anexos) {
    $this->assunto = $assunto;
    $this->destinatarios = $destinatarios;		
		$this->responderParaNome = $responderParaNome;			
		$this->responderParaEmail = $responderParaEmail;
    $this->anexos = $anexos;
    $this->dados = $dados;
		$this->dados['site_url'] = URL;
		$this->dados['site_titulo'] = TITULO_PAGS;
		$this->dados['site_email'] = EMAIL_ATENDIMENTO;
		$this->dados['site_telefone'] = TELEFONES;
    $this->dados['site_logo'] = LOGO_EMAIL;
    $this->autenticacao = EMAIL_AUTENTICADO == "1" ? true : false;
    $this->gmail = ENVIO_GMAIL == "1" ? true : false;
    $this->buildEmail();
	}

	// Exibe uma pré-visualização do e-mail
	public function getPrev() {
		return $this->corpo;
	}

	// Retorna a mensagem de erro
	public function getErro() {
		return $this->erro;		
  }

  // Envia o e-mail
	public function Enviar() {
    if ($this->autenticacao) {
      return $this->envioAutenticado();
    } else {
      return $this->envioDireto();
    }
  }

  // Envia o e-mail sem autenticação (Função mail())
  private function envioDireto() {
    $remetente = $this->user;
    $destinatarios = implode(", ", $this->destinatarios);
    $assunto = $this->assunto;
    $messagem = $this->corpo;
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
    $headers .= "From: " . $remetente . "\r\n";
    $headers .= "Return-Path: " . $remetente . "\r\n";
    $enviar = mail($destinatarios, $assunto, $messagem, $headers);
    // OBS: "From" e "Return-Path" devem ser do mesmo domínio do servidor que está enviando.
    if ($enviar) {
      return true;
    } else {
      $this->erro = "Erro: ".error_get_last()['message'];
    }
    return false;
  }
  
  // Envia o e-mail com autenticação (PHPMailer)
  private function envioAutenticado() {
    $mail = new PHPMailer();
    //$mail->SMTPDebug = 2;
    $mail->setLanguage("br");
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = $this->host; 
    $mail->Username = $this->user;
    $mail->Password = $this->password;
    $mail->Port = 587;
    if ($this->gmail) {
      $mail->SMTPSecure = "tls";
    }
    $mail->setFrom($this->user, TITULO_PAGS);
    foreach ($this->destinatarios as $destinatario) {			
      $mail->AddAddress($destinatario);
    }
    $mail->AddReplyTo($this->responderParaEmail, $this->responderParaNome);
    foreach ($this->anexos as $anexo) {
      if (file_exists($anexo['arquivo'])) {
        $mail->addAttachment($anexo['arquivo'], $anexo['nome']);
      }
    }
    $mail->isHTML(true);
    $mail->CharSet = "utf-8";
    $mail->Subject = $this->assunto;
    $mail->Body = $this->corpo;
    if ($mail->send()) {
      return true;
    } else {
      $this->erro = "Erro: ".$mail->ErrorInfo;
    }
    return false;
  }

  // Monta o corpo do e-mail
  private function buildEmail() {
    // Background
    $html = '<table cellpadding="0" cellspacing="0" border="0" style="width: 100%; line-height: 100%; border-collapse: collapse"><tr><td>';
    // Container
    $html .= '<table cellpadding="0" cellspacing="0" border="0" align="center" style="border-collapse: collapse"><tr><td width="600px" valign="top">';
    // Conteúdo
    $html .= '<table width="100%" cellpadding="20" cellspacing="0" border="0" align="center" bgcolor="#f5f5f5"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse">';
    // Título
    $html .= '<tr><td>&nbsp;</td></tr><tr><td style="font-family: Helvetica, Arial, sans-serif; font-size: 24px; font-weight: bold; color: '.$this->mainColor.'; text-align: center">'.$this->dados['titulo'].'</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>';
    // Texto
    if (isset($this->dados['texto']) && $this->dados['texto'] != "") {
      $html .= '<tr><td style="font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 1.4; color: '.$this->fontDark.'; text-align: center">'.$this->dados['texto'].'</td></tr><tr><td>&nbsp;</td></tr>';
    }
    // Informações (Lista)
    foreach ($this->dados['infos'] as $infoTit => $infoVal) {
      $html .= '<tr><td style="font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 1.4; font-weight: bold; color: '.$this->fontDark.'; text-align: left">'.$infoTit.'</td></tr><tr><td style="font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 1.4; color: '.$this->fontLight.'; text-align: left">'.$infoVal.'</td></tr><tr><td>&nbsp;</td></tr>';
    }
    // Botão
    if (isset($this->dados['botao'])) {
      $html .= '<tr><td>&nbsp;</td></tr><tr><td style="text-align: center"><table cellspacing="0" cellpadding="0" align="center"><tr><td style="border-radius: 4px;" bgcolor="'.$this->mainColor.'"><a href="'.$this->dados['botao']['url'].'" target="_blank" style="padding: 10px 20px; border: 1px solid '.$this->mainColor.';border-radius: 4px; font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #ffffff; text-decoration: none; font-weight: bold; display: inline-block">'.$this->dados['botao']['texto'].'</a></td></tr></table></td></tr><tr><td>&nbsp;</td></tr>';
    }
    // Fim conteúdo
    $html .= '</table></td></tr></table>';
    // Footer
    $html .= '<table width="100%" cellpadding="20" cellspacing="0" border="0" style="border-collapse: collapse" bgcolor="#eeeeee"><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse"><tr><td style="width: 130px; font-family: Helvetica, Arial, sans-serif; font-size: 24px; font-weight: bold; color: '.$this->mainColor.'; text-align: left"><a href="'.$this->dados['site_url'].'" title="'.$this->dados['site_titulo'].'" target="_blank" style="color: '.$this->mainColor.'; text-decoration: none"><img src="'.$this->dados['site_logo'].'" alt="'.$this->dados['site_titulo'].'" width="100px" border="0"></a></td><td style="font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 1.4; color: '.$this->fontLight.'; text-align: left"><b>'.$this->dados['site_titulo'].'</b></td></tr></table></td></tr></table>';
    // Fim container
    $html .= '</td></tr></table>';
    // Fim background
    $html .= '</td></tr></table>';
    $this->corpo = $html;
  }

}
