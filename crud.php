<?php
/* ----------------------------------------
 * Início da Classe Motorista
 * ----------------------------------------  
 */

class motorista{

    private $db;

    function __construct($DB_con) {
        $this->db = $DB_con;
    }

    public function inserir($nome, $login, $email, $senha,$tipo) {
        $sql_insert = "INSERT INTO motorista(email,login,nome,senha,admin) VALUES(:nome, :login, :email, MD5(:senha),admin)";
        try {
            $stmt = $this->db->prepare($sql_insert);
            //substituimos os parametros do sql pelo conteúdo
            $stmt->bindparam(":nome", $email);
            $stmt->bindparam(":login", $login);
            $stmt->bindparam(":email", $nome);
            $stmt->bindparam(":senha", $senha);
             $stmt->bindparam(":tipo", $tipo);
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='menu.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi inserido com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
    echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível inserir o registro. <strong>Erro: ".$e->getMessage()."</strong>
	          </div>
	      </div>";
	return false;
        }
    }

    public function getID($id) {
        $sql_selectid = "SELECT * FROM motorista WHERE id=:id";
        $stmt = $this->db->prepare($sql_selectid);
        $stmt->execute(array(":id" => $id));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function getTipo($login) {
        $sql_selecttipo = "SELECT * FROM motorista WHERE login=:login";
        $stmt = $this->db->prepare($sql_selecttipo);
        $stmt->execute(array(":login" => $login));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }
    
    public function alterar($id, $nome, $login, $email, $senha, $tipo) {
        $sql_update = "UPDATE motorista 
                           SET nome=:nome, 
		               login=:login,						   
                               email=:email, 
			       senha=MD5(:senha),
                               tipo= tipo
                           WHERE id=:id";
        try {
            $stmt = $this->db->prepare($sql_update);
            $stmt->bindparam(":nome", $nome);
            $stmt->bindparam(":login", $login);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":senha", $senha);
             $stmt->bindparam(":tipo", $tipo);
            $stmt->bindparam(":id", $id);
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='menu.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi alterado com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
       echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível alterar o registro. A descrição informada já existe! <strong>Erro: ".$e->getMessage()."</strong>
	          </div>
	      </div>";
   } else {
      echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível alterar o registro. <strong>Erro: ".$e->getMessage()."</strong>
	          </div>
	      </div>";
   }
    
	return false;
        }
    }

    public function apagar($id) {
        $sql_delete = "DELETE FROM motorista WHERE id=:id";
        try{
        $stmt = $this->db->prepare($sql_delete);
        $stmt->bindparam(":id", $id);
        $stmt->execute();
         echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='menu.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi excluído com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
    echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível remover o registro. <strong>Erro: ".$e->getMessage()."</strong>
	          </div>
	      </div>";
	      return false;
    }
    }  

    public function validaLogin($login, $senha) {
        $stmt = $this->db->prepare("SELECT * from motorista where login =:login AND senha =MD5(:senha)");
        $stmt->bindparam(":login", $login);
        $stmt->bindparam(":senha", $senha);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function listar() {
        $sql_select = "select id, login, nome, email,tipo from motorista";
        $stmt = $this->db->prepare($sql_select);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php print($row['id']); ?></td>
                    <td><?php print($row['login']); ?></td>
                    <td><?php print($row['nome']); ?></td>
                    <td><?php print($row['email']); ?></td>
                     <td><?php print($row['tipo']); ?></td>
                   
                    <td align="center">
                        <a href="edita-motorista.php?edit_id=<?php print($row['id']); ?>" title="Editar o registro selecionado"><i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                    <td align="center">
                        <a href="apaga-motorista.php?delete_id=<?php print($row['id']); ?>" title="Apagar o registro selecionado"><i class="glyphicon glyphicon-remove-circle text-danger"></i></a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td>Não existe nenhum registro cadastrado.</td>
            </tr>
            <?php
        }
    }
    
     public function listarApenasMotorista($idMotorista) {
        $sql_select = "select id, login, nome, email,tipo from motorista where id = :id";
        $stmt = $this->db->prepare($sql_select);
        $stmt->bindparam(":id", $idMotorista);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php print($row['id']); ?></td>
                    <td><?php print($row['login']); ?></td>
                    <td><?php print($row['nome']); ?></td>
                    <td><?php print($row['email']); ?></td>
                     <td><?php print($row['tipo']); ?></td>
                   
                    <td align="center">
                        <a href="edita-motorista.php?edit_id=<?php print($row['id']); ?>" title="Editar o registro selecionado"><i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                    <td align="center">
                        <a href="apaga-motorista.php?delete_id=<?php print($row['id']); ?>" title="Apagar o registro selecionado"><i class="glyphicon glyphicon-remove-circle text-danger"></i></a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td>Não existe nenhum registro cadastrado.</td>
            </tr>
            <?php
        }
    }
    
    

    public function combo() {
        /* Para usar na pagina html, insira o codigo conforme exemplo:
          <select name="cliente" required>
          <option value="">Selecione...</option>
          <?php $cliente->combo(); ?>
          </select>
         */
        $comando = $this->db->prepare("select id, nome from motorista");
        $comando->execute();
        if ($comando->rowCount() > 0) {
            while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
                ?>

                <option value="<?php print($row['id']); ?>">
                <?php print($row['nome']); ?></option>

                <?php
            }
        }
    }

}

/*----------------------------------------
 * Fim da Classe Motorista
 *----------------------------------------  
 */



/* ----------------------------------------
 * Início da Classe Viagem
 * ----------------------------------------  
 */

class viagem {

    private $db;

    function __construct($DB_con) {
        $this->db = $DB_con;
    }

    public function inserir( $datasaida,$destino ,$tipodecarga ,$datachegada) {
        $sql_insert = "INSERT INTO viagem ( datahorasaida, destino, tipodecarga, datahorachegada) VALUES(:datasaida, :destino, :tipodecarga, :datachegada)";
        try {
            $stmt = $this->db->prepare($sql_insert);
            //substituimos os parametros do sql pelo conteúdo
          
            $stmt->bindparam(":datasaida", $datasaida);            
            $stmt->bindparam(":destino", $destino);            
            $stmt->bindparam(":tipodecarga", $tipodecarga); 
            $stmt->bindparam(":datachegada", $datachegada);            
            $stmt->execute();
            echo "<div class='container'>
                     <div class='alert alert-info'>         
                        <a href='menu.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi inserido com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
    echo "<div class='container'>
              <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível inserir o registro. <strong>Erro: ".$e->getMessage()."</strong>
              </div>
          </div>";
    return false;
        }
    }


    public function getID($id) {
        $sql_selectid = "SELECT idviagem, date_format(datahorasaida,'%Y-%m-%dT%h:%i') as datahorasaida, destino, tipodecarga, date_format(datahorachegada,'%Y-%m-%dT%h:%i') as datahorachegada FROM viagem WHERE idviagem=:id";
        $stmt = $this->db->prepare($sql_selectid);
        $stmt->execute(array(":id" => $id));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function alterar($idviagem, $destino, $tipodecarga, $datahorasaida,$datahorachegada) {
        $sql_update = "UPDATE viagem
                           SET destino=:destino,
                               datahorasaida=:datahorasaida,
                               tipodecarga=:tipodecarga,
                               datahorachegada = :datahorachegada
                           WHERE idviagem=:id";
        try {
            $stmt = $this->db->prepare($sql_update);
            $stmt->bindparam(":destino", $destino);
            $stmt->bindparam(":tipodecarga", $tipodecarga);       
            $stmt->bindparam(":datahorasaida", $datahorasaida);  
            $stmt->bindparam(":datahorachegada", $datahorachegada); 
            $stmt->bindparam(":id", $idviagem);  
            $stmt->execute();
           echo "<div class='container'>
                     <div class='alert alert-info'>         
                        <a href='menu.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi alterado com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
    echo "<div class='container'>
              <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível alterar o registro. <strong>Erro: ".$e->getMessage()."</strong>
              </div>
          </div>";
    return false;
        }
    }

    public function apagar($id) {
        $sql_delete = "DELETE FROM viagem WHERE idviagem=:id";
        try{
        $stmt = $this->db->prepare($sql_delete);
        $stmt->bindparam(":id", $id);
        $stmt->execute();
         echo "<div class='container'>
                     <div class='alert alert-info'>         
                        <a href='menu.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi excluído com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
    echo "<div class='container'>
              <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível remover o registro. <strong>Erro: ".$e->getMessage()."</strong>
              </div>
          </div>";
          return false;
    }
    }    

    public function listar() {
        $sql_select = "select idviagem,date_format(datahorasaida,'%d/%m/%Y %h:%i') as datahorasaida,destino,tipodecarga,date_format(datahorachegada,'%d/%m/%Y %h:%i') as datahorachegada from viagem ";
        $stmt = $this->db->prepare($sql_select);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php print($row['idviagem']); ?></td>
                    <td><?php print($row['datahorasaida']); ?></td>
                    <td><?php print($row['destino']); ?></td>       
                    <td><?php print($row['tipodecarga']); ?></td>    
                    <td><?php print($row['datahorachegada']); ?></td>       
                    <td align="center">
                        <a href="edita-viagem.php?edit_id=<?php print($row['idviagem']); ?>" title="Editar o registro selecionado"><i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                    <td align="center">
                        <a href="apaga-viagem.php?delete_id=<?php print($row['idviagem']); ?>" onclick="return confirm('Confirma a exclusão do registro?');" title="Apagar o registro selecionado"><i class="glyphicon glyphicon-remove-circle text-danger"></i></a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td>Não existe nenhum registro cadastrado.</td>
            </tr>
            <?php
        }
    }

    public function combo() {
        /* Para usar na pagina html, insira o codigo conforme exemplo:
          <select name="produto" required>
          <option value="">Selecione...</option>
          <?php $produto->combo(); ?>
          </select>
         */
        $comando = $this->db->prepare("select id, placa from viagem where situacao=1");
        $comando->execute();
        if ($comando->rowCount() > 0) {
            while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
                ?>

                <option value="<?php print($row['id']); ?>">
                <?php print($row['placa']); ?></option>

                <?php
            }
        }
    }

}

/*----------------------------------------
 * Fim da Classe Viagem
 *----------------------------------------  
 */

/* ----------------------------------------
 * Início da Classe Veiculo
 * ----------------------------------------  
 */

class veiculo {

    private $db;

    function __construct($DB_con) {
        $this->db = $DB_con;
    }

    public function inserir($placa,$datamanutencao,$servicomanutencao) {
        $sql_insert = "INSERT INTO veiculo(placa,datamanutencao,servicomanutencao) VALUES(:placa,:datamanutencao,:servicomanutencao)";
        try {
            $stmt = $this->db->prepare($sql_insert);
            //substituimos os parametros do sql pelo conteúdo
            $stmt->bindparam(":placa", $placa);
            $stmt->bindparam(":datamanutencao", $datamanutencao);   
            $stmt->bindparam(":servicomanutencao", $servicomanutencao);
        
            
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='menu.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi inserido com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
    echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível inserir o registro. <strong>Erro: ".$e->getMessage()."</strong>
	          </div>
	      </div>";
	return false;
        }
    }


    public function getID($id) {
        $sql_selectid = "SELECT * FROM veiculo WHERE idveiculo=:id";
        $stmt = $this->db->prepare($sql_selectid);
        $stmt->execute(array(":id" => $id));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function alterar($idveiculo,$placa,$datamanutencao,$servicomanutencao) {
        $sql_update = "UPDATE veiculo
                           SET  placa=:placa, 
                                datamanutencao=:datamanutencao,
                                servicomanutencao=:servicomanutencao
                               
                           WHERE idveiculo=:id";
        try {
            $stmt = $this->db->prepare($sql_update);
            $stmt->bindparam(":placa", $placa);
            $stmt->bindparam(":datamanutencao", $datamanutencao);      
               $stmt->bindparam(":servicomanutencao", $servicomanutencao);      
            $stmt->bindparam(":id", $idveiculo);  
            $stmt->execute();
           echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='menu.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi alterado com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
    echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível alterar o registro. <strong>Erro: ".$e->getMessage()."</strong>
	          </div>
	      </div>";
	return false;
        }
    }

    public function apagar($id) {
        $sql_delete = "DELETE FROM veiculo WHERE idveiculo=:id";
        try{
        $stmt = $this->db->prepare($sql_delete);
        $stmt->bindparam(":id", $id);
        $stmt->execute();
         echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='menu.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi excluído com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
    echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível remover o registro. <strong>Erro: ".$e->getMessage()."</strong>
	          </div>
	      </div>";
	      return false;
    }
    }    

    public function listar() {
        $sql_select = "select idveiculo, placa, date_format(datamanutencao,'%d/%m/%y' ) as datamanutencao, if(servicomanutencao=1,'Disponível','Indisponível') as servicomanutencao from veiculo";
        $stmt = $this->db->prepare($sql_select);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php print($row['idveiculo']); ?></td>
                    <td><?php print($row['placa']); ?></td>
                    <td><?php print($row['datamanutencao']); ?></td>   
                      <td><?php print($row['servicomanutencao']); ?></td>   
                    <td align="center">
                        <a href="edita-veiculo.php?edit_id=<?php print($row['idveiculo']); ?>" title="Editar o registro selecionado"><i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                    <td align="center">
                        <a href="apaga-veiculo.php?delete_id=<?php print($row['idveiculo']); ?>" onclick="return confirm('Confirma a exclusão do registro?');" title="Apagar o registro selecionado"><i class="glyphicon glyphicon-remove-circle text-danger"></i></a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td>Não existe nenhum registro cadastrado.</td>
            </tr>
            <?php
        }
    }

    public function combo() {
        /* Para usar na pagina html, insira o codigo conforme exemplo:
          <select name="grupo" required>
          <option value="">Selecione...</option>
          <?php $grupo->combo(); ?>
          </select>
         */
        $comando = $this->db->prepare("select idveiculo, placa from veiculo ");
        $comando->execute();
        if ($comando->rowCount() > 0) {
            while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
                ?>

                <option value="<?php print($row['placa']); ?>">
                <?php print($row['placa']); ?></option>

                <?php
            }
        }
    }

}

/*----------------------------------------
 * Fim da Classe Veiculo
 *----------------------------------------  
 */
/* ----------------------------------------
 * Início da Classe Manutenção
 * ----------------------------------------  
 */

class manutencao{

    private $db;

    function __construct($DB_con) {
        $this->db = $DB_con;
    }

    public function inserir($placa, $datamanutencao, $valormanutencao) {
        $sql_insert = "INSERT INTO manutencao(placa,datamanutencao,valormanutencao) VALUES(:placa, :datamanutencao, :valormanutencao)";
        try {
            $stmt = $this->db->prepare($sql_insert);
            //substituimos os parametros do sql pelo conteúdo
            $stmt->bindparam(":placa", $placa);
            $stmt->bindparam(":datamanutencao", $datamanutencao);
            $stmt->bindparam(":valormanutencao", $valormanutencao);
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='menu.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi inserido com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
    echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível inserir o registro. <strong>Erro: ".$e->getMessage()."</strong>
	          </div>
	      </div>";
	return false;
        }
    }

    public function getID($id) {
        $sql_selectid = "SELECT * FROM manutencao WHERE idmanutencao=:id";
        $stmt = $this->db->prepare($sql_selectid);
        $stmt->execute(array(":id" => $id));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function alterar($idmanutencao, $placa,$datamanutencao ,$valormanutencao) {
        $sql_update = "UPDATE manutencao 
                           SET placa=:placa, 
		               datamanutencao=:datamanutencao,						   
                               valormanutencao=:valormanutencao 
			       
                           WHERE idmanutencao=:id";
        try {
            $stmt = $this->db->prepare($sql_update);
            $stmt->bindparam(":placa", $placa);
            $stmt->bindparam(":datamanutencao", $datamanutencao);
            $stmt->bindparam(":valormanutencao", $valormanutencao);
            $stmt->bindparam(":id", $idmanutencao);
            $stmt->execute();
            echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='menu.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi alterado com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
            {
       echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível alterar o registro. A descrição informada já existe! <strong>Erro: ".$e->getMessage()."</strong>
	          </div>
	      </div>";
   } {
      echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível alterar o registro. <strong>Erro: ".$e->getMessage()."</strong>
	          </div>
	      </div>";
   }
    
	return false;
        }
    }

    public function apagar($id) {
        $sql_delete = "DELETE FROM manutencao WHERE idmanutencao=:id";
        try{
        $stmt = $this->db->prepare($sql_delete);
        $stmt->bindparam(":id", $id);
        $stmt->execute();
         echo "<div class='container'>
	                 <div class='alert alert-info'>        	
                        <a href='menu.php' class='btn btn-large btn-primary'><i class='glyphicon glyphicon-home'></i> &nbsp; Início</a>&nbsp;
                        <strong>Tudo OK!</strong> Registro foi excluído com sucesso!!
                     </div>
                  </div>";
            return true;
        } catch (PDOException $e) {
    echo "<div class='container'>
	          <div class='alert alert-danger'>
                   <strong>Ops!</strong> Não foi possível remover o registro. <strong>Erro: ".$e->getMessage()."</strong>
	          </div>
	      </div>";
	      return false;
    }
    }  

   

    public function listar() {
        $sql_select = "select idmanutencao, placa, datamanutencao, valormanutencao from manutencao";
        $stmt = $this->db->prepare($sql_select);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php print($row['idmanutencao']); ?></td>
                    <td><?php print($row['placa']); ?></td>
                    <td><?php print($row['datamanutencao']); ?></td>
                    <td><?php print($row['valormanutencao']); ?></td>
                    <td align="center">
                        <a href="edita-manutencao.php?edit_id=<?php print($row['idmanutencao']); ?>" title="Editar o registro selecionado"><i class="glyphicon glyphicon-edit"></i></a>
                    </td>
                    <td align="center">
                        <a href="apaga-manutencao.php?delete_id=<?php print($row['idmanutencao']); ?>" title="Apagar o registro selecionado"><i class="glyphicon glyphicon-remove-circle text-danger"></i></a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td>Não existe nenhum registro cadastrado.</td>
            </tr>
            <?php
        }
    }

    public function combo() {
        /* Para usar na pagina html, insira o codigo conforme exemplo:
          <select name="cliente" required>
          <option value="">Selecione...</option>
          <?php $cliente->combo(); ?>
          </select>
         */
        $comando = $this->db->prepare("select id, nome from manutencao");
        $comando->execute();
        if ($comando->rowCount() > 0) {
            while ($row = $comando->fetch(PDO::FETCH_ASSOC)) {
                ?>

                <option value="<?php print($row['id']); ?>">
                <?php print($row['placa']); ?></option>

                <?php
            }
        }
    }

}

/*----------------------------------------
 * Fim da Classe Manutenção
 *----------------------------------------  
 */