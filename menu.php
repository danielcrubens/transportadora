<?php
include_once 'bd.php';
?>
<?php include_once 'cabecalho.php'; ?>
<head>
    <body background="https://unsplash.it/1150/780?image=668" />

</head>
<div class="clearfix"></div>

   <div class="container navbar-inverse ">
	<div class="alert alert-info">
            <strong><?php print strtoupper($_SESSION['usuario_id']) ?> <?php print strtoupper($_SESSION['usuario_nome']) ?></strong>, Seja bem vindo! <br>Perfil de Usuário: <?php print strtoupper($_SESSION['usuario_tipo']) ?> <br>Selecione a opção desejada na parte superior. <i class="glyphicon glyphicon-arrow-up"></i>
	</div>
   </div>





<?php include_once 'rodape.php'; ?>