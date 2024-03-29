<!-- Carregar o cabecalho -->
<?php include_once 'bd.php'; ?>
<?php include_once 'cabecalho.php'; ?>

<div class="clearfix"></div>

<div class="container">
<a href="menu.php" class="btn btn-large btn-warning"><i class="glyphicon glyphicon-home"></i> &nbsp; Menu Inicial</a>
<a href="adiciona-viagem.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Novo Registro</a>
</div>

<div class="clearfix"></div><br />

<div class="container">
    <h2><span class="glyphicon glyphicon-list-alt text-info"></span> Listagem  Viagem</h2>
	 <table class='table table-bordered table-responsive'>
     <tr class="info">
     <th><i class="glyphicon glyphicon-asterisk"></i> </th>
     <th>Data hora saída</th>
     <th>Destino</th>     
     <th>Tipo de carga</th>     
     <th>Data hora chegada</th>    
     <th colspan="2" align="center">Opções</th>
     </tr>
    
     <!--<th colspan="2" align="center">Opções</th>
     </tr>-->
     <!-- Carregamos a listagem da Classe -->
     <?php $viagem->listar(); ?>    
</table>          
</div>

<?php include_once 'rodape.php'; ?>