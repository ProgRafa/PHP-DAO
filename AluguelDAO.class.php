<?php
    include_once "BDO_Conection.php";
    include_once "Cliente.class.php";
    include_once "ClienteDAO.class.php";
    include_once "Veiculo.class.php";
    include_once "VeiculoDAO.class.php";
    include_once "Aluguel.class.php";

    public $con;

    public function _construct(){
        $this->con=ConexaoDAO::obterConexao()
    }

    public function getAll(){
        $list_aluguel = [];
        $aluguel = null;
        $cliente = null;
        $veiculo = null;

        $query = "SELECT * FROM Aluguel";

        $result = $this->con->prepare($query);
        $result->execute();

        foreach($row = $result->fetchAssoc()){
            extract($row);
            $aluguel = new Aluguel($data_entrada, $data_saida);
            $aluguel->setIdAluguel($idaluguel);
            
            $c_dao = new ClienteDAO();
            $cliente = $c_dao->getForID($idcliente);

            $v_dao = new VeiculoDAO();
            $veiculo = $v_dao->getForID($idveiculo);

            $aluguel->setCliente($cliente);
            $aluguel->setCliente($veiculo);

            array_push($list_aluguel, $aluguel);
        }

        return $list_aluguel;
    }

    public function getForID($id){
        $aluguel = null;
        $cliente = null;
        $veiculo = null;
        
        $query="SELECT * FROM Aluguel WHERE idAluguel = :id";
        $resp=$this->con->prepare($query);
        $resp->bindValue(':id', $id);
        $resp->execute();

        $result=$resp->fetchAssoc();//Máximo uma linha de resposta
        extract($result[0])
        if(count($result) > 0){
            $aluguel = new Aluguel($data_entrada, $data_saida);
            $client->setIdAluguel($id);
            
            $c_dao = new ClienteDAO();
            $cliente = $c_dao->getForID($idcliente);

            $v_dao = new VeiculoDAO();
            $veiculo = $v_dao->getForID($idveiculo);

            $aluguel->setCliente($cliente);
            $aluguel->setCliente($veiculo);
        }

        return $aluguel;
    }

    public function save($aluguel){
        if($aluguel->getIdAluguel() == null){
            $query = "INSERT INTO Aluguel(dataDevolucao, dataRetirada, idCliente, idVeiculo)
                      VALUES (?, ?, ?, ?)";
        }else{
            $query = "UPDATE Aluguel 
                      SET dataDevolucao = ?, dataRetirada = ?, idCliente = ?, idVeiculo = ?
                      WHERE idAluguel = ".$aluguel->getIdAluguel();
        }
        
        $result = $this->con->prepare($query);
        $vetor = array(
                        $aluguel->data_entrada, 
                        $aluguel->data_saida, 
                        $aluguel->cliente->getIdCliente(), 
                        $aluguel->veiculo->getIdCliente()
                      );
        $result->execute($vetor);

        return $result->rowCount();
    }

    public function delete($id){
        $query = "DELETE FROM Aluguel WHERE idAluguel = :id";
        $result = $this->con->prepare($query);
        $result->bind(':id', $id);
        $result->execute();
        
        return $result->rowCount();
    }

?>