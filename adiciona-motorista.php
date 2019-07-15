<?php include_once 'bd.php'; ?>
<?php include_once 'cabecalho.php'; ?>
<!-- tratamento para incluir o registro -->
<?php if(isset($_POST['botao-salvar']))
{
    
    $nome = $_POST['nome'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = $_POST ['tipo'];
    
    $motorista->inserir($nome,$login,$email,$senha,$tipo);
    
}
?>

<div class="clearfix"></div><br />

<div class="container">

 	
	 <form name="formMotorista" method='post' onsubmit="return validarSenha();">
             <fieldset><legend><i class="glyphicon glyphicon-plus text-primary"></i> Novo Registro</legend>
    <table class='table'>
 
        <tr>
            <td>Nome</td>
            <td><input type='text' name='nome' class='form-control' required autofocus placeholder="Nome Completo" maxlength="50"></td>
        </tr>
 
        <tr>
            <td>Login</td>
            <td><input type='text' name='login' class='form-control' required maxlength="20" placeholder="Login do Usuário"></td>
        </tr>
 
        <tr>
            <td>Email</td>
            <td><input type='email' name='email' class='form-control' required maxlength="50" placeholder="nome@dominio.com.br"></td>
        </tr>
 
        <tr>
            <td>Senha</td>
            <td><input type='password' name='senha' class='form-control' required maxlength="20" placeholder="Senha para o login"></td>
        </tr>
        <tr>
            <td>Confirmação da Senha</td>
            <td><input type='password' name='csenha' class='form-control' required maxlength="20" placeholder="Confirmação da Senha"></td>
        </tr>
 
 
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-success" name="botao-salvar">
    		<span class="glyphicon glyphicon-save-file"></span> Salvar
			</button>  
                <a href="lista-motorista.php" class="btn btn-large btn-danger"><i class="glyphicon glyphicon-remove-sign"></i> &nbsp; Cancelar</a>
            </td>
        </tr>
 
    </table>
             </fieldset>
</form>
     
     
</div>

<?php include_once 'rodape.php'; ?>