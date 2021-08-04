<?
if(!defined('PATH_ATUAL')) die();

$db = new Init();
$conexao = $db->conectar();

$user = new Crud("admin");
$obj_nivel_user = new Crud("admin_niveis");

if(!defined("ID_USUARIO_ADMIN")){ define("ID_USUARIO_ADMIN",$_SESSION['id_Admin']);}

//resgata usuário

$resultado = $user->SelectSingle("SELECT * FROM admin WHERE id = ".ID_USUARIO_ADMIN." LIMIT 1");
$mostra_nome = explode(" ",$resultado['nome']);

if(!defined("NOME_USUARIO_ADMIN")){ define("NOME_USUARIO_ADMIN", $mostra_nome[0]);}
if(!defined("NIVEL_USUARIO_ADMIN")){ define("NIVEL_USUARIO_ADMIN", $resultado['nivel']);}

$resultado_nivel = $obj_nivel_user->SelectSingle("SELECT * FROM admin_niveis WHERE id = ".NIVEL_USUARIO_ADMIN." LIMIT 1");

$permissoes_usuarios_admin = explode(",", $resultado_nivel['permissoes']);
//resgata usuário

?>