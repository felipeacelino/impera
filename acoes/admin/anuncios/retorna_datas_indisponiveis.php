<?
if (!isset($_SESSION)) { session_start(); } 
include("../../../paths.php");
include("" . BASE_PATH . "/base.class.php");
include("" . BASE_PATH . "/init.class.php");
include("" . BASE_PATH . "/tools.class.php");
include("" . BASE_PATH . "/crud.class.php");
include("" . CONF_PATH . "/conf.php");
include("" . ACOES_ADMIN_PATH . "/geral/restritos.php");
include("" . ACOES_ADMIN_PATH . "/geral/user.php");

Tools::debug(false);

if (!defined('PATH_ATUAL')) exit;

$anuncio = $_GET['anuncio_id'];
$order = "ORDER BY dta ASC";

if($anuncio != ''){

// DATAS
$crudDatasIndisponiveis = new Crud('anuncios_datas_indisponiveis');

$sql = "SELECT 
dta,
origem
FROM 
anuncios_datas_indisponiveis
WHERE anuncio_id = $anuncio
ORDER BY dta ASC";
$resultado = $crudDatasIndisponiveis->SelectMultiple($sql, false, 0);
$total_registros = $crudDatasIndisponiveis->totalRegistros();

$datas_indisponiveis = array();
$datas_indisponiveis_reservas = array();

foreach ($resultado as $linhaDta) {

  $dta = Tools::formataData($linhaDta['dta']);

  switch ($linhaDta['origem']) {

    case 1: //Indisponiveis
    array_push($datas_indisponiveis_reservas,$dta);
    break;
    case 2: //Reservado
    array_push($datas_indisponiveis_reservas,$dta);
    break;

  }

}

$datas_indisponiveis = $datas_indisponiveis[0].' até '.end($datas_indisponiveis);
$datas_indisponiveis_reservas = implode(", ", $datas_indisponiveis_reservas);

$arr_retorno = array(
  'datas_indisponiveis' => $datas_indisponiveis,
  'datas_indisponiveis_reservas' => $datas_indisponiveis_reservas
);

die(json_encode($arr_retorno));

}
