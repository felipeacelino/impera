<?php
if (!isset($_SESSION)) { session_start(); } 
include ("../../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");
include ("".CLASS_PATH."/completaEndereco.class.php");

if (isset($_POST['cep']) && $_POST['cep'] != "") {

    $cep = Tools::somenteNumeros($_POST['cep']);

    if ($cep != "") {

        $endereco = CompletaEndereco::getEndereco($cep);

        echo $endereco;

    } else {
        echo "Informe um CEP.";
    }
}
