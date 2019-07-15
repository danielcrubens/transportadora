<?php
include_once 'bd.php';
header('Content-Type: text/html; charset=UTF-8');

if(empty($_SESSION)) {// Se a sessão ainda não foi iniciada
   session_start();
}

if(isset($_POST['login']))
{
	$usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
	$login = $motorista->validaLogin($usuario, $senha);        
        if($login) {
            extract($motorista->getTipo($usuario));
            $_SESSION['usuario'] = $_POST['usuario'];
            $_SESSION['usuario_tipo'] = $tipo;
            $_SESSION['usuario_nome'] = $nome;
            $_SESSION['usuario_id'] = $id;
            header("Location: menu.php");
            exit;
        } else {
            echo "<SCRIPT> 
       alert('O usuário ou a senha informados são inválidos!');
       window.location = 'http://localhost/transportadora';
    </SCRIPT>";
            
        }	
}

?>

