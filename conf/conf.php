<?
ini_set('memory_limit','1024M');

if(!defined('PATH_ATUAL')) die();

$conexao = Init::conectar();

$pasta_admin = "admin/";

// Configurações do sistema
$confs = new Crud('sistema_conf');

$linha_sys = $confs->SelectSingle("SELECT * FROM sistema_conf ORDER BY id DESC LIMIT 1");
$linha_conf = $confs->SelectSingle("SELECT * FROM loja_conf ORDER BY id DESC LIMIT 1");

// Configurações do sistema
$url_local = true;
if ($url_local) {
	if(!defined('URL')){ define('URL', 'http://192.168.15.14/imperareal/');}
} else {
	if(!defined('URL')){ define('URL',$linha_sys['url_base']);}
}
if(!defined('URL_APP')){ define('URL_APP', URL.'app/');}
if(!defined('URL_ADMIN')){ define('URL_ADMIN', URL.$pasta_admin);}
if(!defined('TIMEZONE')){ define('TIMEZONE', $linha_sys['timezone']);}

// Maps
if(!defined('MAPS_API')){ define('MAPS_API', 'AIzaSyA79TLkMA5xQgPetP_gFPeZKYrg0Awa_Vw');}

// Recaptcha
if (!defined('RECAPTCHA_SECRET')) {
  define('RECAPTCHA_SECRET', '6LdChAsaAAAAAFlgsmYAIt4G43xbPf0F7nWRDNS3');
}
if (!defined('RECAPTCHA_KEY')) {
  define('RECAPTCHA_KEY', '6LdChAsaAAAAAGcDDsaScExWQ2wI19DTeCQKuOra');
}

// Configurações de e-mail
if(!defined('EMAIL_AUTENTICADO')){ define('EMAIL_AUTENTICADO',$linha_sys['email_autenticado']);}
if(!defined('ENVIO_GMAIL')){ define('ENVIO_GMAIL',$linha_sys['envio_gmail']);}
if(!defined('SMTP_HOST')){ define('SMTP_HOST',$linha_sys['smtp_host']);}
if(!defined('SMTP_USER')){ define('SMTP_USER',$linha_sys['smtp_user']);}
if(!defined('SMTP_PASS')){ define('SMTP_PASS',$linha_sys['smtp_pass']);}
if(!defined('EMAIL_CONTATO')){ define('EMAIL_CONTATO',$linha_conf['email_formulario']);}
if(!defined('EMAIL_AGENDAMENTOS')){ define('EMAIL_AGENDAMENTOS',$linha_conf['email_agendamentos']);}
if(!defined('EMAIL_PROPOSTAS')){ define('EMAIL_PROPOSTAS',$linha_conf['email_propostas']);}
if(!defined('EMAIL_DOCS_CLIENTES')){ define('EMAIL_DOCS_CLIENTES',$linha_conf['email_docs_clientes']);}
if(!defined('EMAIL_DOCS_PROPRIETARIOS')){ define('EMAIL_DOCS_PROPRIETARIOS',$linha_conf['email_docs_proprietarios']);}
if(!defined('EMAIL_DOCS_CORRETORES')){ define('EMAIL_DOCS_CORRETORES',$linha_conf['email_docs_corretores']);}

// Configurações da loja	
if(!defined('TITULO_PAGS')){ define('TITULO_PAGS',$linha_conf['titulo_loja']);}
if(!defined('ENDERECO')){ define('ENDERECO',$linha_conf['endereco']);}
if(!defined('MAPA')){ define('MAPA',$linha_conf['mapa']);}
if(!defined('TELEFONES')){ define('TELEFONES',$linha_conf['telefones']);}
if(!defined('EMAIL_ATENDIMENTO')){ define('EMAIL_ATENDIMENTO',$linha_conf['email_atendimento']);}
if(!defined('HORARIO_FUNCIONAMENTO')){ define('HORARIO_FUNCIONAMENTO',$linha_conf['horario_funcionamento']);}

// Taxas
if(!defined('TAXA')){ define('TAXA',$linha_conf['taxa']);}
if(!defined('TAXA_EXCLUSIVOS')){ define('TAXA_EXCLUSIVOS',$linha_conf['taxa_exclusivos']);}

// Redes Sociais
if(!defined('WHATSAPP')){ define('WHATSAPP',$linha_conf['whatsapp']);}
if(!defined('SKYPE')){ define('SKYPE',$linha_conf['skype']);}
if(!defined('FACEBOOK')){ define('FACEBOOK',$linha_conf['facebook']);}
if(!defined('TWITTER')){ define('TWITTER',$linha_conf['twitter']);}
if(!defined('INSTAGRAM')){ define('INSTAGRAM',$linha_conf['instagram']);}
if(!defined('YOUTUBE')){ define('YOUTUBE',$linha_conf['youtube']);}
if(!defined('LINKEDIN')){ define('LINKEDIN',$linha_conf['linkedin']);}

// CORES
if(!defined('COR_PRINCIPAL')){ define('COR_PRINCIPAL', $linha_sys['cor_principal']);}
if(!defined('COR_SECUNDARIA')){ define('COR_SECUNDARIA', $linha_sys['cor_secundaria']);}
if(!defined('BTN_PRINCIPAL')){ define('BTN_PRINCIPAL', $linha_sys['btn_principal']);}
if(!defined('BTN_SECUNDARIO')){ define('BTN_SECUNDARIO', $linha_sys['btn_secundario']);}
if(!defined('COR_ICHECK')){ define('COR_ICHECK', $linha_sys['cor_icheck']);}

// Logo Principal
$logo_principal = $confs->SelectSingle("SELECT * FROM loja_logo WHERE local = 'principal' AND status = 1 ORDER BY id DESC LIMIT 1");
if(!defined('LOGO_PRINCIPAL')){ define('LOGO_PRINCIPAL',URL.'uploads/img/loja_logo/'.$logo_principal['id'].'/'.$logo_principal['logo']);}

// Logo Footer
$logo_footer = $confs->SelectSingle("SELECT * FROM loja_logo WHERE local = 'footer' AND status = 1 ORDER BY id DESC LIMIT 1");
if(!defined('LOGO_FOOTER')){ define('LOGO_FOOTER',URL.'uploads/img/loja_logo/'.$logo_footer['id'].'/'.$logo_footer['logo']);}

// Logo E-mail
$logo_email = $confs->SelectSingle("SELECT * FROM loja_logo WHERE local = 'email' AND status = 1 ORDER BY id DESC LIMIT 1");
if(!defined('LOGO_EMAIL')){ define('LOGO_EMAIL',URL.'uploads/img/loja_logo/'.$logo_email['id'].'/'.$logo_email['logo']);}

// Logo Ícone Admin
$logo_admin = $confs->SelectSingle("SELECT * FROM loja_logo WHERE local = 'icon_admin' AND status = 1 ORDER BY id DESC LIMIT 1");
if(!defined('LOGO_ADMIN')){ define('LOGO_ADMIN',URL.'uploads/img/loja_logo/'.$logo_admin['id'].'/'.$logo_admin['logo']);}

header ('Content-type: text/html; charset=UTF-8');
date_default_timezone_set(''.TIMEZONE.'');

define('DURACAO_VISITA', 60); // Minutos

// Sol
$opcoesSol = array(
  'manha' => 'Manhã',
  'tarde' => 'Tarde'
);

// Orientações
$opcoesOrientacoes = array(
  'frente' => 'Frente',
  'fundos' => 'Fundos',
  'lateral' => 'Lateral',
  'meio' => 'Meio',
);

// Status imóveis
$statusAnuncios = array(
  '0' => array(
    'titulo' => "Encerrado",
    'descricao' => "O cadastro do imóvel foi encerrado.",
  ),
  '1' => array(
    'titulo' => "Publicado",
    'descricao' => "O imóvel está cadastrado e publicado corretamente no site.",
  ),
  '2' => array(
    'titulo' => "Avaliação",
    'descricao' => "O imóvel está em análise e aguardando a aprovação da imobiliária",
  ),
  '3' => array(
    'titulo' => "Pendência",
    'descricao' => "O cadastro do imóvel está incorreto ou incompleto.",
  ),
  '4' => array(
    'titulo' => "Vendido",
    'descricao' => "O imóvel foi vendido.",
  ),
  '5' => array(
    'titulo' => "Alugado",
    'descricao' => "O imóvel foi alugado.",
  )
);

// Tags destaque
$tagsDestaque = array(
  '1' => 'Planta',
  '2' => 'Lançamento',
  '3' => 'Construção'
);

// Tipos regiões
$tiposRegioes = array(
  'avulso-locacao' => 'Imóveis Avulso e Locação',
  'planta' => 'Imóveis na Planta'
);

// Status pagamentos
$statusPagamentos = array(
  '0' => array(
    'titulo' => "Cancelado",
    'class' => "error"
  ),
  '1' => array(
    'titulo' => "Pago",
    'class' => "success"
  ),
  '2' => array(
    'titulo' => "Pendente",
    'class' => "warning"
  )
);

// Status visitas
$statusVisitas = array(
  '0' => array(
    'titulo' => "Cancelado",
    'class' => "error"
  ),
  '1' => array(
    'titulo' => "Confirmado",
    'class' => "success"
  ),
  '2' => array(
    'titulo' => "Pendente",
    'class' => "warning"
  ),
  '3' => array(
    'titulo' => "Reagendar",
    'class' => "info"
  ),
  '4' => array(
    'titulo' => "Recusado",
    'class' => "error"
  )
);

// Status leads
$statusLeads = array(
  '0' => array(
    'titulo' => "Sem interesse",
    'class' => "error"
  ),
  '1' => array(
    'titulo' => "Agendado",
    'class' => "success"
  ),
  '2' => array(
    'titulo' => "Pendente",
    'class' => "warning"
  ),
);

// Tipos visita
$tiposVisita = array(
  'presencial' => array(
    'titulo' => "Presencial",
    'descricao' => "Visita com o corretor mostrando o imóvel pessoalmente.",
    'class' => "info"
  ),
  'video' => array(
    'titulo' => "Video Chamada",
    'descricao' => "Com o corretor mostrando o imóvel pelo celular via video chamada.",
    'class' => "success"
  ),
);

// Etapas Venda
$etapasVenda = array(
  '1' => array(
    'icone' => '<i class="las la-home"></i>',
    'titulo' => 'Imóvel anunciado',
    'descricao' => '<p>Após efetuar o cadastro completo o seu imóvel já estará disponível em nosso site para ser vendido.</p>',
  ),
  '2' => array(
    'icone' => '<i class="las la-calendar-check"></i>',
    'titulo' => 'Visitas',
    'descricao' => '<p>Aqui você fica sabendo que o seu imóvel já foi visitado.<br>
    Prezamos pela transparência em nosso relacionamento, por isso criamos uma página para que você fique ainda mais por dentro dos clientes interessados no seu imóvel. Você pode acompanhar as visitas ocorridas clicando no botão “<b>Opções</b>” e em seguida “<b>visitas</b>” na sua página “<b>Meus Imóveis</b>”.</p>',
  ),
  '3' => array(
    'icone' => '<i class="las la-comment-dots"></i>',
    'titulo' => 'Proposta',
    'descricao' => '<p>Caso o cliente tenha gostado do seu imóvel e tenha enviado uma proposta para comprá-lo, será enviado uma mensagem para que você possa nos comunicar a respeito do seu interesse quanto a proposta direcionada.</p>',
  ),
  '4' => array(
    'icone' => '<i class="las la-envelope"></i>',
    'titulo' => 'Envio de documentos',
    'descricao' => '<p>Significa que o cliente nos enviou toda a documentação solicitada para uma possível aprovação da análise de crédito direcionada para a compra do seu imóvel.</p>',
  ),
  '5' => array(
    'icone' => '<i class="las la-piggy-bank"></i>',
    'titulo' => 'Análise de crédito',
    'descricao' => '<p>Neste momento o cliente está sendo analisado para poder comprar o seu imóvel, caso ele tenha uma resposta positiva referente a sua avaliação ele poderá optar por prosseguir na aquisição do imóvel.<br>
    Essa análise de financiamento costuma ter um prazo de resposta entre 48 a 72 horas.</p>',
  ),
  '6' => array(
    'icone' => '<i class="las la-file-alt"></i>',
    'titulo' => 'Assinatura do contrato digital',
    'descricao' => '<p>Essa é a primeira etapa definitiva para o início do processo da venda do seu imóvel, pois significa que o cliente já foi aprovado pela análise de crédito e deseja prosseguir com aquisição do imóvel.</p>
    <p>Neste momento o futuro comprador já assinou o nosso contrato digital que também foi enviado para o seu e-mail.</p>',
  ),
  '7' => array(
    'icone' => '<i class="las la-landmark"></i>',
    'titulo' => 'Assinatura do banco',
    'descricao' => '<p>Neste momento, o comprador já assinou todo o contrato referente ao financiamento com o banco credor para a aquisição do imóvel, então saiba que agora definitivamente o seu imóvel foi vendido e em breve o banco efetuará o repasse do valor referente à transação imobiliária.</p>',
  ),
  '8' => array(
    'icone' => '<i class="las la-key"></i>',
    'titulo' => 'Entrega das chaves',
    'descricao' => '<p>Parabéns, o seu imóvel já foi vendido e chegou a hora de entregarmos as chaves para o novo dono.</p>',
  )
);

// Etapas do Aluguel
$etapasAluguel = array(
  '1' => array(
    'icone' => '<i class="las la-home"></i>',
    'titulo' => 'Imóvel anunciado',
    'descricao' => '<p>Após efetuar o cadastro completo o seu imóvel já estará disponível em nosso site para ser alugado.</p>',
  ),
  '2' => array(
    'icone' => '<i class="las la-calendar-check"></i>',
    'titulo' => 'Visitas',
    'descricao' => '<p>Aqui você fica sabendo que o seu imóvel já foi visitado.<br>
    Prezamos pela transparência em nosso relacionamento, por isso criamos uma página para que você fique ainda mais por dentro dos clientes interessados no seu imóvel. Você pode acompanhar as visitas ocorridas clicando no botão “<b>Opções</b>” e em seguida “<b>visitas</b>” na sua página “<b>Meus Imóveis</b>”.</p>',
  ),
  '3' => array(
    'icone' => '<i class="las la-comment-dots"></i>',
    'titulo' => 'Proposta',
    'descricao' => '<p>Caso o cliente tenha gostado do seu imóvel e tenha enviado uma proposta para alugá-lo, será enviado uma mensagem para que você possa nos comunicar a respeito do seu interesse quanto a proposta direcionada.</p>',
  ),
  '4' => array(
    'icone' => '<i class="las la-envelope"></i>',
    'titulo' => 'Envio de documentos',
    'descricao' => '<p>Significa que o cliente nos enviou toda a documentação solicitada para uma possível aprovação da análise de crédito direcionada para a locação do seu imóvel.</p>',
  ),
  '5' => array(
    'icone' => '<i class="las la-piggy-bank"></i>',
    'titulo' => 'Análise de crédito',
    'descricao' => '<p>Neste momento o cliente está sendo analisado para poder alugar o seu imóvel, caso ele
    tenha uma resposta positiva referente a sua avaliação ele poderá optar por prosseguir na locação do imóvel.</p>
    <p>O tempo de resposta dessa análise costuma ser dentro de 24 horas.</p>',
  ),
  '6' => array(
    'icone' => '<i class="las la-file-alt"></i>',
    'titulo' => 'Assinatura do contrato digital',
    'descricao' => '<p>Essa é uma das últimas etapas do processo de locação, pois significa que o cliente já foi aprovado pela análise de crédito e deseja prosseguir com a locação do seu imóvel.</p>
    <p>Neste momento o futuro inquilino já assinou o nosso contrato digital que também foi enviado para o seu e-mail.</p>',
  ),
  '7' => array(
    'icone' => '<i class="las la-search"></i>',
    'titulo' => 'Vistoria do imóvel',
    'descricao' => '<p>Nesta etapa será feita uma vistoria para registrar as condições aparentes do imóvel e também a conservação da sua propriedade. Desta forma, ao término do contrato de locação o imóvel deverá ser entregue nas mesmas condições em que foi alugado pelo inquilino.</p>',
  ),
  '8' => array(
    'icone' => '<i class="las la-key"></i>',
    'titulo' => 'Entrega das chaves',
    'descricao' => '<p>Parabéns, o seu imóvel já foi alugado e chegou a hora de entregarmos as chaves para o novo inquilino.</p>',
  )
);

// Tipos documentos
$tiposDocumentos = array(
  '1' => array(
    'titulo' => "Documento de identificação",
    'texto' => "<p>Documentos aceitos: RG, CNH ou Carteira Profissional. Todos os documentos devem conter foto de identificação e número do CPF. Caso o seu RG não tenha o nº do CPF, você deverá enviar os dois documentos juntos (RG + CPF).</p>"
  ),
  '2' => array(
    'titulo' => "Comprovante de renda",
    'texto' => "<p>Serão aceitos os seguintes comprovantes de renda: 
    - Contracheques para trabalhadores CLT;
    - Extratos da Conta Corrente para trabalhadores autônomos;
    - Extratos do INSS para aposentados/pensionistas;</p>"
  ),
  '3' => array(
    'titulo' => "Comprovante de endereço",
    'texto' => "<p>Serão aceitos os seguintes comprovantes de endereço: 
    Conta de Luz / Conta de Gás / Conta de telefone / Conta de TV por assinatura / Fatura do cartão de crédito.</p>
    
    <p>Obs: Os comprovantes de endereço devem ter no máximo 60 dias da data de emissão. 
    **Não enviar comprovantes com cortes ou pela metade.</p>"
  ),
  '4' => array(
    'titulo' => "Carteira de trabalho",
    'texto' => "<p>Deverão ser enviadas as duas primeiras páginas de identificação da carteira e as páginas que constam todos os contratos de trabalhos antigos e o contrato de trabalho atual.</p>

    <p>Obs: A carteira de trabalho online baixada do site do MTE também é aceita.</p>"
  ),
  '5' => array(
    'titulo' => "Extrato do FGTS",
    'texto' => "<p>Deverá ser enviado os extratos de todas as contas com saldo.</p>

    <p>Obs: Será necessário que você ative a autorização via aplicativo do FGTS para consulta do saldo do FGTS pelas instituições financeiras.</p>"
  ),
  '6' => array(
    'titulo' => "Certidão de estado civil",
    'texto' => "<p>Neste caso deverá ser enviado a Certidão de nascimento, Certidão de casamento ou Certidão de União estável.</p>

    <p>Obs: Caso o (a) futuro comprador (a) seja casado (a) ou tenha união estável comprovada, será obrigatório o envio da documentação completa do seu cônjuge para análise.</p>"
  ),
  '7' => array(
    'titulo' => "Declaração do IRPF",
    'texto' => "<p>O envio do IRPF (Imposto de Renda de Pessoa Física) é obrigatório apenas para os declarantes.</p>

    <p>Obs: Enviar o imposto de renda completo contendo todas as páginas da declaração + as duas páginas de recibo.</p>"
  ),
  '8' => array(
    'titulo' => "Certidão do dependente",
    'texto' => "<p>A certidão de nascimento do dependente é solicitada apenas para análise de imóveis dentro do Programa Casa Verde e Amarela.</p>
    <p>Obs: São considerados dependentes os filhos de até 24 anos cursando faculdade e sem vínculo empregatício. Sendo necessário o envio do comprovante de escolaridade.</p>"
  ),
  '9' => array(
    'titulo' => "Outros",
    'texto' => "<p>Campo exclusivo para o envio de documentos complementares solicitados pela análise de crédito.</p>"
  ),
);

?>
