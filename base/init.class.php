<?
class Init{
  static function conectar() {
    $db = Conexao::getInstance();
    return $db;
  }
}
?>
