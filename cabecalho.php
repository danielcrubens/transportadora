<?php if(empty($_SESSION)) {// Se a sessao não estiver iniciada, iniciaremos! }
   session_start();
}
if(!isset($_SESSION['usuario'])) { //Se ainda não estiver logado
   header("Location: index.html");// Enviamos para a página inicial
   exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Suporte Transportadora</title>
<!--bootstrap -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">   
<script>
    function validarSenha(){
        NovaSenha = document.formMotorista.senha.value;
        CNovaSenha = document.formMotorista.csenha.value;
        if (NovaSenha != CNovaSenha){ 
             alert("A senha e a confirmação da senha estão diferentes!");
             return false;
        }
        return true;
 }
</script>

</head>

<body>
<div class="container-fluid">
<div class="navbar navbar-inverse navbar-static-top" role="navigation">
    

         
        <div class="navbar-form navbar-right">  
                <a href="logout.php" class="btn btn-danger" ><span class="glyphicon glyphicon-log-out"></span> Logout</a>
            </div>
 </div>
</div>
    <div class="container">
      
        <ul class="nav nav-tabs">
                                <li class="active">
					
				
				<li>
					<a href="lista-motorista.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Motorista  </a>
				</li>
				<li <?php if(strtoupper($_SESSION['usuario_tipo'])=='MOTORISTA'){echo 'class="disabled"';}?>>
					<a href="lista-viagem.php"><span class="glyphicon glyphicon-road"></span>&nbsp;Viagem</a>
				</li>
                                <li>
					<a href="lista-veiculo.php"><span class="glyphicon glyphicon-send"></span>&nbsp;Veiculo</a>
				</li>
                                <li <?php if(strtoupper($_SESSION['usuario_tipo'])=='MOTORISTA'){echo 'class="disabled"';}?>>
                                    
                                    
                                    <?php if(strtoupper($_SESSION['usuario_tipo'])=='MOTORISTA'){
                                        echo '';                                        
                                    } else{ 
                                        echo '<a href="lista-manutencao.php"><span class="glyphicon glyphicon-filter"></span>&nbsp;Manutenção</a>';
                                    }
                                    
                                    ?> 
                                    
                                    
                                    
                                    
                                    
					<a href="lista-manutencao.php"><span class="glyphicon glyphicon-filter"></span>&nbsp;Manutenção</a>
				</li>				
			</ul>
        </div>
    <br>
