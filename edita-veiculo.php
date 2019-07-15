
<?php include_once 'bd.php'; ?>
<?php include_once 'cabecalho.php'; ?>

<!-- tratamento para alterar o registro -->
<?php
if (isset($_POST['botao-alterar'])) {
    
    $idveiculo = $_GET['edit_id'];
    $placa = $_POST['placa'];
    $datamanutencao = $_POST['datamanutencao'];
    $servicomanutencao = $_POST['servicomanutencao'];


    $veiculo->alterar($idveiculo, $placa, $datamanutencao, $servicomanutencao);
}
?>

<!-- obtendo os dados para alteração -->
<?php
if (isset($_GET['edit_id'])) {
    extract($veiculo->getID($_GET['edit_id']));
}
?>

<div class="clearfix"></div><br />

<div class="container">

    <form method='post'>
        <fieldset><legend><i class="glyphicon glyphicon-pencil text-primary"></i> Alteração do Veiculo</legend>
            <table class='table table-bordered'>
                <tr>
                    <td>Codigo veiculo</td>
                    <td><input type='text' name='idveiculo' class='form-control' value="<?php echo $idveiculo; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Placa veiculo</td>
                    <td><input type='text' name='placa' class='form-control' required maxlength="08" placeholder="ABC-1234" pattern='[A-Z]{3}[-][0-9]{4}' title='Informe a placa conforme o padrão. Exemplo; DAX-1234'value=" <?php echo $placa; ?>" required</td>
                </tr>

                <tr>
                    <td>Data manutenção</td>
                    <td><input type='date' name='datamanutencao' class='form-control' value="<?php echo $datamanutencao; ?>" required></td>
                </tr>

                <tr>
                    <td>Serviço manutenção</td>
                    <td><input type='radio' name='servicomanutencao'  value='1' <?php  if (  $servicomanutencao==1){echo 'checked';} ?> >Possui
                        <input type='radio' name='servicomanutencao'  value='0' <?php  if (  $servicomanutencao==0){echo 'checked';} ?> >Não Possui</td>
                </tr>



                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success" name="botao-alterar">
                            <span class="glyphicon glyphicon-edit"></span> Gravar a alteração
                        </button>
                        <a href="lista-veiculo.php" class="btn btn-large btn-danger"><i class="glyphicon glyphicon-backward"></i> &nbsp; Cancelar</a>
                    </td>
                </tr>

            </table>
    </form>


</div>

<?php include_once 'rodape.php'; ?>