
<?php include_once 'bd.php'; ?>
<?php include_once 'cabecalho.php'; ?>

<!-- tratamento para alterar o registro -->
<?php
if (isset($_POST['botao-alterar'])) {
    
    $idmanutencao = $_GET['edit_id'];
    $datamanutencao = $_POST['datamanutencao'];
    $placa = $_POST['placa'];
    $valormanutencao = $_POST['valormanutencao'];

    $manutencao->alterar($idmanutencao,  $placa,$datamanutencao,  $valormanutencao);
}
?>

<!-- obtendo os dados para alteração -->
<?php
if (isset($_GET['edit_id'])) {
    extract($manutencao->getID($_GET['edit_id']));
}
?>

<div class="clearfix"></div><br />

<div class="container">

    <form method='post'>
        <fieldset><legend><i class="glyphicon glyphicon-pencil text-primary"></i> Alteração do Registro</legend>
            <table class='table table-bordered'>

                <tr>
                    <td>Codigo manutenção</td>
                    <td><input type='text' name='idviagem' class='form-control' value="<?php echo $idmanutencao; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Data manutenção</td>
                    <td><input type='date' name='datamanutencao' class='form-control' value=" <?php echo $datamanutencao; ?>" required></td>
                </tr>

                <tr>
                    <td>Placa veiculo</td>
                    <td><input type='text' name='placa' class='form-control' required maxlength="08" placeholder="ABC-1234" pattern='[A-Z]{3}[-][0-9]{4}' title='Informe a placa conforme o padrão. Exemplo; DAX-1234'value=" <?php echo $placa; ?>" required</td>
                </tr>


                <tr>
                    <td>Valor manutenção</td>
                    <td><input type='number' name='valormanutencao' class='form-control' value="<?php echo $valormanutencao; ?>" required></td>
                </tr>


                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success" name="botao-alterar">
                            <span class="glyphicon glyphicon-edit"></span> Gravar a alteração
                        </button>
                        <a href="lista-manutencao.php" class="btn btn-large btn-danger"><i class="glyphicon glyphicon-backward"></i> &nbsp; Cancelar</a>
                    </td>
                </tr>

            </table>
    </form>


</div>

<?php include_once 'rodape.php'; ?>