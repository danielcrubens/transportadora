
<?php include_once 'bd.php'; ?>
<?php include_once 'cabecalho.php'; ?>

<!-- tratamento para alterar o registro -->
<?php
if (isset($_POST['botao-alterar'])) {
    $id = $_GET['edit_id'];
    $nome = $_POST['nome'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = $_POST ['tipo'];

    $motorista->alterar($id, $nome, $login, $email, $senha,$tipo);
}
?>

<!-- obtendo os dados para alteração -->
<?php
if (isset($_GET['edit_id'])) {
    extract($motorista->getID($_GET['edit_id']));
}
?>

<div class="clearfix"></div><br />

<div class="container">

    <form method='post'>
        <fieldset><legend><i class="glyphicon glyphicon-pencil text-primary"></i> Alteração do Registro</legend>
            <table class='table table-bordered'>
                <tr>
                    <td>Codigo motorista</td>
                    <td><input type='text' name='motorista' class='form-control' value="<?php echo $id; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Nome</td>
                    <td><input type='text' name='nome' class='form-control' value="<?php echo $nome; ?>" required></td>
                </tr>

                <tr>
                    <td>Login</td>
                    <td><input type='text' name='login' class='form-control' value="<?php echo $login; ?>" required></td>
                </tr>

                <tr>
                    <td>Email</td>
                    <td><input type='email' name='email' class='form-control' value="<?php echo $email; ?>" required></td>
                </tr>

                <tr>
                    <td>Senha</td>
                    <td><input type='password' name='senha' class='form-control' value="<?php echo $senha; ?>" required></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success" name="botao-alterar">
                            <span class="glyphicon glyphicon-edit"></span> Gravar a alteração
                        </button>
                        <a href="lista-motorista.php" class="btn btn-large btn-danger"><i class="glyphicon glyphicon-backward"></i> &nbsp; Cancelar</a>
                    </td>
                </tr>

            </table>
    </form>


</div>

<?php include_once 'rodape.php'; ?>