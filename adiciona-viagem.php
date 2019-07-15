<?php include_once 'bd.php'; ?>
<?php include_once 'cabecalho.php'; ?>
<!-- tratamento para incluir o registro -->
<?php if(isset($_POST['botao-salvar']))
{
    
    
    $datasaida = $_POST['datasaida'];
    $destino = $_POST['destino'];
    $tipodecarga = $_POST['tipodecarga'];
    $datachegada = $_POST['datachegada'];
    
    $viagem->inserir( $datasaida,$destino,$tipodecarga,$datachegada);
    
}
?>

<div class="clearfix"></div><br />

<div class="container">

 	
	 <form name="formViagem" method='post' onsubmit="return validarSenha();">
             <fieldset><legend><i class="glyphicon glyphicon-plus text-primary"></i> Novo registro de viagem</legend>
    <table class='table'>
 
        
        <tr>
            <td>Data hora saida</td>
            <td><input type='datetime-local' name='datasaida' class='form-control' required  placeholder="insira a data e hora"></td>
        </tr>
 
        <tr>
            <td>Destino</td>
            <td><input type='text' name='destino' class='form-control' required maxlength="50" placeholder="insira o destino"></td>
        </tr>
 
        <tr>
            <td>Tipo de carga</td>
            <td><input type='text' name='tipodecarga' class='form-control' required maxlength="50" placeholder="insira o tipo de carga"></td>
        </tr>
        <tr>
            <td>Data hora chegada</td>
            <td><input type='datetime-local' name='datachegada' class='form-control' required  placeholder="insira a data e hora"></td>
        </tr>
 
 
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-success" name="botao-salvar">
    		<span class="glyphicon glyphicon-save-file"></span> Salvar
			</button>  
                <a href="lista-viagem.php" class="btn btn-large btn-danger"><i class="glyphicon glyphicon-remove-sign"></i> &nbsp; Cancelar</a>
            </td>
        </tr>
 
    </table>
             </fieldset>
</form>
     
     
</div>

<?php include_once 'rodape.php'; ?>