
<?php include_once 'bd.php'; ?>
<?php include_once 'cabecalho.php'; ?>

<!-- tratamento para alterar o registro -->
<?php
if (isset($_POST['botao-alterar'])) {
    
    $idviagem = $_GET['edit_id'];
    $destino = $_POST['destino'];
    $tipodecarga = $_POST['tipodecarga'];
    $datahorasaida = $_POST['datasaida'];
    $datahorachegada =$_POST ['datachegada'];


    $viagem->alterar($idviagem, $destino, $tipodecarga, $datahorasaida,$datahorachegada);
}
?>

<!-- obtendo os dados para alteração -->
<?php
if (isset($_GET['edit_id'])) {
    extract($viagem->getID($_GET['edit_id']));
}
?>

<div class="clearfix"></div><br />

<div class="container">

    <form method='post'>
        <fieldset><legend><i class="glyphicon glyphicon-pencil text-primary"></i> Alteração do Registro</legend>
            <table class='table table-bordered'>

                <tr>
                    <td>Codigo viagem</td>
                    <td><input type='text' name='idviagem' class='form-control' value="<?php echo $idviagem; ?>" readonly></td>
                </tr>
 <tr>
                    <td>Destino</td>
                    <td><input type='text' name='destino' class='form-control' value="<?php echo $destino; ?>" required></td>
                </tr>

                <tr>
                    <td>Tipo de carga</td>
                    <td><input type='text' name='tipodecarga' class='form-control' value="<?php echo $tipodecarga; ?>" required></td>
                </tr>

                <tr>
                    <td>Data hora saída</td>
                    <td><input type='datetime-local' name='datasaida' class='form-control' value="<?php echo $datahorasaida; ?>" required></td>
                </tr>
                   
                <tr>
                    <td>Data hora chegada</td>
                    <td><input type='datetime-local' name='datachegada' class='form-control' value="<?php echo $datahorachegada; ?>" required></td>
                </tr>
                   

                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success" name="botao-alterar">
                            <span class="glyphicon glyphicon-edit"></span> Gravar a alteração
                        </button>
                        <a href="lista-viagem.php" class="btn btn-large btn-danger"><i class="glyphicon glyphicon-backward"></i> &nbsp; Cancelar</a>
                    </td>
                </tr>

            </table>
    </form>


</div>

<?php include_once 'rodape.php'; ?>