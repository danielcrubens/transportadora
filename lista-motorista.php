<!-- Carregar o cabecalho -->
<?php include_once 'bd.php'; ?>
<?php include_once 'cabecalho.php'; ?>

<div class="clearfix"></div>

<div class="container">
<a href="menu.php" class="btn btn-large btn-warning"><i class="glyphicon glyphicon-home"></i> &nbsp; Menu Inicial</a>
<a href="adiciona-motorista.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Novo Registro</a>
</div>

<div class="clearfix"></div><br />

<div class="container">
    <h2><span class="glyphicon glyphicon-user text-info"></span> Listagem Motorista</h2>
	 <table class='table table-bordered table-responsive'>
     <tr class="info">
     <th><i class="glyphicon glyphicon-asterisk"></i> </th>
     <th>Login</th>
     <th>Nome</th>
     <th>E-mail</th>    
     <th>Tipo</th>  
     <th colspan="2" align="center">Opções</th>
     </tr>
     <!-- Carregamos a listagem da Classe -->
     <?php 
     
    if(strtoupper($_SESSION['usuario_tipo'])=='MOTORISTA'){
     $motorista->listarApenasMotorista($_SESSION['usuario_id']);
    }
    else {
     $motorista->listar();    
    }
     
     
     ?>    
</table>          
</div>

<?php include_once 'rodape.php'; ?>