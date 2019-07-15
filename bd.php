<?php

//Informações sobre a conexão ao banco de dados
$DB_servidor = "localhost";
$DB_usuario = "root";
$DB_senha = "";
$DB_nome = "transportadora";

//Tentaremos efetuar a conexão ao Banco de Dados
try
{
	$DB_con = new PDO("mysql:host={$DB_servidor};dbname={$DB_nome}",$DB_usuario,$DB_senha);
	$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

//Incluimos o arquivo crud.php que possui as nossas classes
include_once 'crud.php';

//Instanciamos um novo objeto a partir da classe
$motorista = new motorista($DB_con);
$viagem = new viagem($DB_con);
$manutencao = new manutencao ($DB_con);
$veiculo = new veiculo($DB_con);

?>