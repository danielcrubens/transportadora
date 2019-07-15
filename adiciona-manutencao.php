<?php include_once 'bd.php'; ?>
<?php include_once 'cabecalho.php'; ?>
<!-- tratamento para incluir o registro -->
<?php if(isset($_POST['botao-salvar']))
{
    
    $placa = $_POST['placa'];
    $datamanutencao = $_POST['datamanutencao'];
    $valormanutencao = $_POST['valormanutencao'];
   
    
    $manutencao->inserir($placa,$datamanutencao,$valormanutencao);
    
}
?>

<div class="clearfix"></div><br />

<div class="container">

 	
	 <form name="formManutencao" method='post' onsubmit="return validarSenha();">
             <fieldset><legend><i class="glyphicon glyphicon-plus text-primary"></i> Novo Registro</legend>
    <table class='table'>
 
       <tr>
           <td>Placa veiculo</td>
           <td>
                <select name="placa" class='form-control' required>
          <option value="">Selecione...</option>
          <?php $veiculo->combo(); ?>
          </select>
           </td>
        </tr>
 
        <tr>
            <td>Data manutenção</td>
            <td><input type='date' name='datamanutencao' class='form-control' required  placeholder="insira a data de manutenção"></td>
        </tr>
        <tr>
            <td>Valor manutenção</td>
            <td><input type='number' name='valormanutencao' class='form-control'  step="0.01" required min="0"></td>
        </tr>
 
 
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-success" name="botao-salvar">
    		<span class="glyphicon glyphicon-save-file"></span> Salvar
			</button>  
                <a href="lista-manutencao.php" class="btn btn-large btn-danger"><i class="glyphicon glyphicon-remove-sign"></i> &nbsp; Cancelar</a>
            </td>
        </tr>
 
    </table>
             </fieldset>
</form>
     
     
</div>

<?php include_once 'rodape.php'; ?>