<?php include_once 'bd.php'; ?>
<?php include_once 'cabecalho.php'; ?>
<!-- tratamento para incluir o registro -->
<?php if(isset($_POST['botao-salvar']))
{
    
    $placa = $_POST['placa'];
    $datamanutencao = $_POST['datamanutencao'];
    if(isset($_POST['servicomanutencao']))// verifica se é nulo
    {
        $servicomanutencao = 1;
    }
        else {
    $servicomanutencao = $_POST['servicomanutencao'];        
    }
    
    

    
    $veiculo->inserir($placa,$datamanutencao,$servicomanutencao);
    
}
?>

<div class="clearfix"></div><br />

<div class="container">

 	
	 <form name="formVeiculo" method='post'>
             <fieldset><legend><i class="glyphicon glyphicon-plus text-primary"></i> Novo Registro</legend>
    <table class='table'>
 
       <tr>
           <td>Placa veiculo</td>
            <td><input type='text' name='placa' class='form-control' required maxlength="08" placeholder="ABC-1234" pattern='[A-Z]{3}[-][0-9]{4}' title='Informe a placa conforme o padrão. Exemplo; DAX-1234'></td>
        </tr>
 
        <tr>
            <td>Data manutenção</td>
            <td><input type='date' name='datamanutencao' class='form-control' required  placeholder="insira a data de manutenção"></td>
        </tr>
 
        <tr>
            <td>Serviço manutenção</td>                       
            <td><input type='radio' name='servicomanutencao'  value='1' checked>Possui
                <input type='radio' name='servicomanutencao'  value='0'>Não Possui
            </td>                        
        </tr>
 
       
 
 
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-success" name="botao-salvar">
    		<span class="glyphicon glyphicon-save-file"></span> Salvar
			</button>  
                <a href="lista-veiculo.php.php" class="btn btn-large btn-danger"><i class="glyphicon glyphicon-remove-sign"></i> &nbsp; Cancelar</a>
            </td>
        </tr>
 
    </table>
             </fieldset>
</form>
     
     
</div>

<?php include_once 'rodape.php'; ?>