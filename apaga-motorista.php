<?php include_once 'bd.php'; ?>
<?php include_once 'cabecalho.php'; ?>
<!-- tratamento para a exclusão do registro -->
<?php if(isset($_GET['delete_id'])){
    $motorista->apagar($_GET['delete_id']);
    } 
?>

<div class="container">
    <a href="lista-motorista.php" class="btn btn-large btn-danger"><i class="glyphicon glyphicon-backward"></i> &nbsp; Retornar</a>
</div>     
    
<?php include_once 'rodape.php'; ?>