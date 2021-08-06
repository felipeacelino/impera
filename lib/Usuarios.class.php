<?php

if (!isset($_SESSION)) { session_start(); } 

class Usuarios {
  
  private $tabela = null;			     // Tabela de usuários
  private $ambiente = null;	       // Ambiente (Ex: admin, app, etc...)
  private $crud = null;	           // Ações CRUD
  public $dados = array();         // Dados do usuário
  private $campo_login = "email";  // Campo de login
  private $campo_senha = "senha";  // Campo de senha
  private $pagina = "";            // Página app

  // Configurações de imagem (Foto perfil)
	private $thumbs = array(
		array(
			"largura" => 150,
			"altura" => 150,
			"forma" => 'crop'
		)
	);

  public function __construct($tabela, $ambiente) {
    $this->tabela = $tabela;
    $this->ambiente = $ambiente;
    $this->crud = new Crud($this->tabela);
    switch ($this->ambiente) {
      case "cliente":
        $this->tipoCad = "Cliente";
        $this->pagina = "cliente";
        $this->tabela_mensagens = "cliente_mensagens";
      break;
      case "afiliado":
        $this->tipoCad = "Afiliado";
        $this->pagina = "afiliado";
        $this->tabela_mensagens = "afiliados_mensagens";
      break;
      case "proprietario":
        $this->tipoCad = "Proprietário";
        $this->pagina = "proprietario";
        $this->tabela_mensagens = "proprietarios_mensagens";
      break;
      case "corretor":
        $this->tipoCad = "Corretor";
        $this->pagina = "corretor";
        $this->tabela_mensagens = "corretores_mensagens";
        $this->crudRegioesAtuacao = new Crud("corretores_regioes_atuacao");
      break;
    }
  }
  
  // Retorna um usuário
  public function getUser($id) {
    $id = (int)Tools::protege($id);
    $usuario = $this->crud->SelectSingle("SELECT * FROM ".$this->tabela." WHERE id=$id");
    // Primeiro nome
    $usuario['primeiro_nome'] = $this->getPrimeiroNome($usuario['nome']);
    // Foto
		$usuario['foto_perfil'] = $usuario['foto'] != "" ? URL."uploads/img/".$this->tabela."/".$usuario['id']."/thumb-150-150/".$usuario['foto'] : URL."static/img/admin/user-profile.png";
    return $usuario;
  }
  
  // Retorna o usuário logado da sessão
  public function getUserFromSession() {
    $idUser = (int)$_SESSION['user'][$this->ambiente]['id'];
    return $this->getUser($idUser);
  }
  
  // Retorna quantidade de msg pendentes do usuario
  public function getQtdMensagens() {
    $idUser = (int)$_SESSION['user'][$this->ambiente]['id'];
    $qtdsMsg = $this->crud->SelectTotalSQL("SELECT id FROM ".$this->tabela_mensagens." WHERE lida = 0 AND remetente='admin' AND id_usuario = ".$idUser);
    if($qtdsMsg == 0){
      $qtdsMsg = '';
    }
    return $qtdsMsg;
  }

  // Retorna os imoveis para os contratos do proprietario
  public function getImoveisContrato() {
    $idUser = (int)$_SESSION['user'][$this->ambiente]['id'];
    $imoveisProprietario = $this->crud->SelectSQL("SELECT * FROM anuncios WHERE id_proprietario = ".$idUser);
    return $imoveisProprietario;
  }
  

  // Retorna os imoveis para os contratos do proprietario
  public function getQtdImoveisContrato() {
    $idUser = (int)$_SESSION['user'][$this->ambiente]['id'];
    $imoveisqtdProprietario = $this->crud->SelectTotalSQL("SELECT * FROM anuncios WHERE id_proprietario = ".$idUser);
    return $imoveisqtdProprietario;
  }
  
  // Cadastra um novo usuário
  public function cadastrar($dados_cadastro) {
    $primeiroNome = $this->getPrimeiroNome($dados_cadastro['nome']);
    // Dados do usuário
    $dados = array(
      'nome' => Tools::protege($dados_cadastro['nome']),
      'email' => Tools::protege($dados_cadastro['email']),
      'telefone' => Tools::protege($dados_cadastro['telefone']),
      'senha' => Tools::geraHash("password",trim($dados_cadastro['senha'])),
      //'facebook_id' => Tools::protege($dados_cadastro['facebook_id']),
      'chave' => Tools::geraHash("md5", Tools::getDateTime()),
      'dta_cad' => Tools::getDateTime(),
      'status' => 1
    );
    // Proprietários
    if ($this->ambiente == "proprietario") {
      $dados['tipo'] = "proprietario";
      $dados['creci'] = Tools::protege($dados_cadastro['creci']);
    }
    // Corretores
    if ($this->ambiente == "corretor") {
      $dados['tipo'] = "corretor";
      $dados['creci'] = Tools::protege($dados_cadastro['creci']);
    }
    // Insere o usuário no banco
    $operacao = $this->crud->Insert($dados);
    if ($operacao) {
      $idUser = (int)$this->crud->GetId();
      // Carrega o usuário cadastrado
      $usuario = $this->crud->SelectSingle("SELECT * FROM ".$this->tabela." WHERE id = $idUser");
      // E-mail notificação (Admin)
      $dados_email = array(
        'titulo' => 'Novo Cadastro',
        'infos' => array(
          'Informações do usuário:' => '&nbsp;',
          'Tipo de cadastro' => $this->tipoCad,
          'Nome' => $usuario['nome'],
          'E-mail' => $usuario['email']
        )
      );
      $assunto = "Novo Cadastro";
      $destinatarios = array(EMAIL_CONTATO);
      $responderParaNome = SMTP_USER;
      $responderParaEmail = SMTP_USER;
      $anexos = array();
      $email = new Email($dados_email, $assunto, $destinatarios, $responderParaNome, $responderParaEmail, $anexos);
      $email->enviar();
      // E-mail notificação (Usuário)	
      $dados_email = array(
        'titulo' => 'Bem-vindo',
        'texto' => 'Olá, <b>'.$primeiroNome.'</b>! Seu cadastro foi realizado com sucesso. Acesse sua conta através do botão abaixo.',
        'botao' => array(
          'texto' => 'Acessar Conta',
          'url' => URL.$this->pagina."/entrar"
        )
      );
      $assunto = "Bem-vindo";
      $destinatarios = array($usuario['email']);
      $responderParaNome = SMTP_USER;
      $responderParaEmail = SMTP_USER;
      $anexos = array();
      $email = new Email($dados_email, $assunto, $destinatarios, $responderParaNome, $responderParaEmail, $anexos);
      $email->enviar();
      // Primeiro login
      if ($this->login($dados_cadastro[$this->campo_login], $dados_cadastro[$this->campo_senha], false)) {
        return true;
      } else {
        return false;
      }	   
    } else {
      return false;
    }    
  }
      
  // Atualiza os dados do usuário
  public function update($dados_update, $idUser) {
    $idUser = (int)Tools::protege($idUser);
    // Dados do usuário
    $dados = array(
      'nome' => Tools::protege($dados_update['nome']),
      'telefone' => Tools::protege($dados_update['telefone']),
      'email' => Tools::protege($dados_update['email']),
      'cpf' => Tools::protege($dados_update['cpf']),
      'cep' => Tools::protege($dados_update['cep']),
      'logradouro' => Tools::protege($dados_update['logradouro']),
      'complemento' => Tools::protege($dados_update['complemento']),
      'numero' => Tools::protege($dados_update['numero']),
      'bairro' => Tools::protege($dados_update['bairro']),
      'cidade' => Tools::protege($dados_update['cidade']),
      'estado' => Tools::protege($dados_update['estado']),
      'cad_compl' => 1,
    );
    // Proprietários
    if ($this->ambiente == "proprietario") {
      $dados['banco'] = Tools::protege($dados_update['banco']);
      $dados['agencia'] = Tools::protege($dados_update['agencia']);
      $dados['conta'] = Tools::protege($dados_update['conta']);
      $dados['operacao'] = Tools::protege($dados_update['operacao']);
      $dados['chave_pix'] = Tools::protege($dados_update['chave_pix']);
    }
    // Corretores
    if ($this->ambiente == "corretor") {
      $dados['como_conheceu'] = Tools::protege($dados_update['como_conheceu']);
      $dados['atuacao_planta'] = array_search("planta", $dados_update['atuacao']) !== FALSE ? 1 : 0;
      $dados['atuacao_avulso'] = array_search("avulso", $dados_update['atuacao']) !== FALSE ? 1 : 0;
      $dados['atuacao_locacao'] = array_search("locacao", $dados_update['atuacao']) !== FALSE ? 1 : 0;
      $dados['nascimento'] = Tools::protege($dados_update['nascimento']);
      $dados['razao_social'] = Tools::protege($dados_update['razao_social']);
      $dados['rg'] = Tools::protege($dados_update['rg']);
      $dados['creci'] = Tools::protege($dados_update['creci']);
      $dados['banco'] = Tools::protege($dados_update['banco']);
      $dados['agencia'] = Tools::protege($dados_update['agencia']);
      $dados['conta'] = Tools::protege($dados_update['conta']);
      $dados['operacao'] = Tools::protege($dados_update['operacao']);
      $dados['chave_pix'] = Tools::protege($dados_update['chave_pix']);
      $dados['domingo_status'] = $dados_update['dias_trabalho'] && array_search("domingo", $dados_update['dias_trabalho']) !== FALSE ? 1 : 0;
      $dados['segunda_status'] = $dados_update['dias_trabalho'] && array_search("segunda", $dados_update['dias_trabalho']) !== FALSE ? 1 : 0;
      $dados['terca_status'] = $dados_update['dias_trabalho'] && array_search("terca", $dados_update['dias_trabalho']) !== FALSE ? 1 : 0;
      $dados['quarta_status'] = $dados_update['dias_trabalho'] && array_search("quarta", $dados_update['dias_trabalho']) !== FALSE ? 1 : 0;
      $dados['quinta_status'] = $dados_update['dias_trabalho'] && array_search("quinta", $dados_update['dias_trabalho']) !== FALSE ? 1 : 0;
      $dados['sexta_status'] = $dados_update['dias_trabalho'] && array_search("sexta", $dados_update['dias_trabalho']) !== FALSE ? 1 : 0;
      $dados['sabado_status'] = $dados_update['dias_trabalho'] && array_search("sabado", $dados_update['dias_trabalho']) !== FALSE ? 1 : 0;
      $dados['domingo_inicio'] = Tools::protege($dados_update['domingo_inicio']);
      $dados['domingo_fim'] = Tools::protege($dados_update['domingo_fim']);
      $dados['segunda_inicio'] = Tools::protege($dados_update['segunda_inicio']);
      $dados['segunda_fim'] = Tools::protege($dados_update['segunda_fim']);
      $dados['terca_inicio'] = Tools::protege($dados_update['terca_inicio']);
      $dados['terca_fim'] = Tools::protege($dados_update['terca_fim']);
      $dados['quarta_inicio'] = Tools::protege($dados_update['quarta_inicio']);
      $dados['quarta_fim'] = Tools::protege($dados_update['quarta_fim']);
      $dados['quinta_inicio'] = Tools::protege($dados_update['quinta_inicio']);
      $dados['quinta_fim'] = Tools::protege($dados_update['quinta_fim']);
      $dados['sexta_inicio'] = Tools::protege($dados_update['sexta_inicio']);
      $dados['sexta_fim'] = Tools::protege($dados_update['sexta_fim']);
      $dados['sabado_inicio'] = Tools::protege($dados_update['sabado_inicio']);
      $dados['sabado_fim'] = Tools::protege($dados_update['sabado_fim']);
    }
    // Atualiza a senha caso seja enviada
    if ($dados_update['senha'] != "") {
      $dados['senha'] = Tools::geraHash("password",trim($dados_update['senha']));
    }
    // Atualiza o usuário no banco
    $operacao = $this->crud->Update($dados, "WHERE id=$idUser");
    if ($operacao) {
      // Corretores (Regiões)
      if ($this->ambiente == "corretor") {
        $delAtuais = $this->crudRegioesAtuacao->Delete("0", "WHERE corretor_id=$idUser", array(), false, false, "");
        if ($delAtuais) {
          $arrRegioes = array();
          if ($dados_update['regioes1'] && !empty($dados_update['regioes1'])) {
            $arrRegioes = array_merge($arrRegioes, $dados_update['regioes1']);
          }
          if ($dados_update['regioes2'] && !empty($dados_update['regioes2'])) {
            $arrRegioes = array_merge($arrRegioes, $dados_update['regioes2']);
          }
          foreach ($arrRegioes as $regiao) {
            $dadosRegiao = array(
              'corretor_id' => $idUser,
              'regiao_id' => $regiao
            );
            $this->crudRegioesAtuacao->Insert($dadosRegiao);
          }
        }
      }
      // Upload de imagem (Foto)
			$path = IMG_PATH."/".$this->tabela."/".$idUser;
			$upload = new Uploads($this->tabela);
      $upload->uploadImagens($_FILES['img'], $path, $idUser, true, true, false, 0, 0, '', $this->thumbs);
      // Upload de arquivo (Arquivo)
			/* $path = ARQ_PATH."/".$this->tabela."/".$idUser;
			$upload = new Uploads($this->tabela);
      $upload->uploadArquivos($_FILES['arq'], $path, $idUser, true, true); */
      return true;
    } else {
      return false;
    }
  }
  
  // Login
  public function login($login, $senha, $permanecerLogado = false, $facebook_id = null) {
    $login = Tools::protege(trim($login));
    $senha = Tools::protege(trim($senha));
    $filtroTipo = "";
    if ($this->ambiente == "proprietario" || $this->ambiente == "corretor") {
      $filtroTipo = " AND tipo='".$this->ambiente."'";
    } else {}
    $usuario = $this->crud->SelectSingle("SELECT * FROM ".$this->tabela." WHERE ".$this->campo_login." = '$login' $filtroTipo AND status <> 0");
    if ($usuario != "") {
      $hash = $usuario[$this->campo_senha];
      if (password_verify($senha, $hash)) {
        $_SESSION['user'][$this->ambiente]['id'] = $usuario['id'];
        $_SESSION['user'][$this->ambiente]['chave'] = $usuario['chave'];
        // Associa o usuário a conta do facebook caso venha o facebook_id
				if ($facebook_id !== null) {
					$this->crud->Update(array("facebook_id" => $facebook_id), "WHERE id=".$usuario['id']);
				}
        // Permanecer conectado
        if ($permanecerLogado) {
          $dados_cookie = array(
            'id' => $_SESSION['user'][$this->ambiente]['id'],
            'chave' => $_SESSION['user'][$this->ambiente]['chave']	
          );	
          setcookie("logado", json_encode($dados_cookie), strtotime('+30 days'), "/");
        } else {
          setcookie("logado", "", time() - 3600, "/");
          unset($_COOKIE['logado']);
        }
        return true;
      } else {
        // Senha inválida
        return false;
      }
    } else {
      // Login não encontrado
      return false;
    }
  }
  
  // Login Facebook
	public function loginFacebook($facebook_id) {
    $facebook_id = Tools::protege($facebook_id);
		$usuario = $this->crud->SelectSingle("SELECT * FROM ".$this->tabela." WHERE facebook_id='$facebook_id' AND status<>0");
		if ($usuario != "") {
			$_SESSION['user'][$this->ambiente]['id'] = $usuario['id'];
			$_SESSION['user'][$this->ambiente]['chave'] = $usuario['chave'];
			$_SESSION['user'][$this->ambiente]['nivel'] = "user";
			return true;
		} 
    // Login não encontrado
    return false;
	}

  // Login utilizando o opção de permanecer conectado
  private function loginCookie() {
    $dados = json_decode($_COOKIE['logado'], true);
    $idUser = $dados['id'];
    $chaveUser = $dados['chave'];
    $userTotal = $this->crud->SelectTotalSQL("SELECT id FROM ".$this->tabela." WHERE id = $idUser AND chave = '$chaveUser' AND status <> 0");
    if ($userTotal > 0) {
      $_SESSION['user'][$this->ambiente]['id'] = $idUser;
      $_SESSION['user'][$this->ambiente]['chave'] = $chaveUser;
      return true;
    } else {
      return false;
    }
  }
  
  // Logout
  public function logout() {
    // Remove a sessão
    unset($_SESSION['user'][$this->ambiente]);
    // Remove o COOKIE de permanecer conectado
    setcookie("logado", "", time() - 3600, "/");
    unset($_COOKIE['logado']);
  }
  
  // Verifica se o usuário está logado
  public function logado() {
    // Verifica a sessão
    if (isset($_SESSION['user'][$this->ambiente])) {
      $idUser = (int)$_SESSION['user'][$this->ambiente]['id'];
      $chaveUser = $_SESSION['user'][$this->ambiente]['chave'];
      $userTotal = $this->crud->SelectTotalSQL("SELECT id FROM ".$this->tabela." WHERE id = $idUser AND chave = '$chaveUser' AND status <> 0");
      if ($userTotal > 0) {
        return true;
      } 
    } else {
      // Verifica se a opção de permanecer conectado está setada nos cookies
      if (isset($_COOKIE['logado']) && $_COOKIE['logado'] != "") {
        if ($this->loginCookie()) {
          return true;
        } 
      }
    }
    return false;
  }
  
  // Envia o e-mail de recuperação de senha para o usuário
  public function sendEmailRecuperacao($email) {
    $email = Tools::protege($email);
    $usuario = $this->crud->SelectSingle("SELECT * FROM ".$this->tabela." WHERE email = '$email' AND status <> 0 LIMIT 1");
    if ($usuario != "") {
      $primeiroNome = $this->getPrimeiroNome($usuario['nome']);
      // Envia o e-mail
      $dados_email = array(
        'titulo' => 'Recuperar de Senha',
        'texto' => 'Olá, <b>'.$primeiroNome.'</b>! Clique no botão abaixo para cadastrar uma nova senha. Você será redirecionado para uma página do site onde poderá cadastrar uma nova senha de acesso.',
        'botao' => array(
          'texto' => 'Cadastrar Senha',
          'url' => URL.$this->pagina.'/cadastrar-senha/'.base64_encode($usuario['id']).'/'.$usuario['chave']
          )
      );
      $assunto = "Recuperar Senha";
      $destinatarios = array($usuario['email']);
      $responderParaNome = SMTP_USER;
      $responderParaEmail = SMTP_USER;
      $anexos = array();
      $email = new Email($dados_email, $assunto, $destinatarios, $responderParaNome, $responderParaEmail, $anexos);
      //echo $email->getPrev();		
      if ($email->enviar()) {
        return true;
      } else {
        return false;
      } 
    } else {
      return false;
    } 
  }
    
  // Verifica se o usuário da página de recuperação de senha é válido
  public function validUserRec($idUserB64, $chaveUser) {
    $idUser = (int)base64_decode($idUserB64);
    $chaveUser = Tools::protege($chaveUser);
    $userTotal = $this->crud->SelectTotalSQL("SELECT id FROM ".$this->tabela." WHERE id = $idUser AND chave = '$chaveUser' AND status <> 0");
    if ($userTotal > 0) {
      return true;
    } 
    return false;
  }
  
  // Cadastra uma nova senha para o usuário
  public function cadastrarNovaSenha($idUserB64, $chaveUser, $senha) {
    $idUser = (int)base64_decode($idUserB64);
    $chaveUser = Tools::protege($chaveUser);
    $senha = Tools::geraHash("password",$senha);
    $userTotal = $this->crud->SelectTotalSQL("SELECT id FROM ".$this->tabela." WHERE id = $idUser AND chave = '$chaveUser' AND status <> 0");
    if ($userTotal > 0) {
      $dados = array(
        'senha' => $senha
      );
      // Cadastra a nova senha
      $operacao = $this->crud->Update($dados, "WHERE id = $idUser AND chave = '$chaveUser'");
      if ($operacao) {
        return true;
      } 
    }
    return false;
  }

  // Verifica se o usuário completou o cadastro
  public function cadastroCompleto() {
    $usuario = $this->getUserFromSession();
    return ($usuario['cad_compl'] == "1");
  }

  // Retorna o primerio nome
  public function getPrimeiroNome($nome) {
    return explode(" ", $nome)[0];
  }
}
