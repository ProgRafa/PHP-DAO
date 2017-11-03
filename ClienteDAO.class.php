<?php
    include_once "BDO_Conection.php";
    include_once "Cliente.class.php";

    Class ClienteDAO{
        private $con;

        public function _construct(){
            $this->con=ConexaoDAO::obterConexao()
        }

        public function getAll(){
            $list_client = [];
            $obj = null;

            $query = "SELECT * FROM Cliente";

            $result = $this->con->prepare($query);
            $result->execute();

            foreach($row = $result->fetchAssoc()){
                extract($row);
                $obj = new Cliente($nome, $habilitacao, $endereco, $sexo);
                $obj->setIdCliente($idCliente);
                array_push($list_client, $obj);
            }

            return $list_client;
        }

        public function getForID($id){
            $client=null;
            
            $query="SELECT * FROM Cliente WHERE idCliente = :id";
            $resp=$this->con->prepare($query);
            $resp->bindValue(':id', $id);
            $resp->execute();

            $result=$resp->fetchAll();//Máximo uma linha de resposta
            extract($result[0])
            if(count($result) > 0){
                $client = new Cliente(
                                    $nome, 
                                    $habilitacao, 
                                    $endereco, 
                                    $sexo,
                                );
                $client->setIdCliente($id);                        
            }

            return $client;
        }

        public function save($cliente){
            if($cliente->getIdCliente() == null){
                $query = "INSERT INTO Cliente(habilitacao, nome, endereco, sexo)
                          VALUES (?, ?, ?, ?)";
            }else{
                $query = "UPDATE Cliente 
                          SET habilitacao = ?, nome = ?, endereco = ?, sexo = ?
                          WHERE idVeiculo = ".$cliente->getIdCliente();
            }
            
            $result = $this->con->prepare($query);
            $vetor = array($obj->habilitacao, $obj->nome, $obj->endereco, $obj->sexo);
            $result->execute($vetor);

            return $result->rowCount();
        }

        public function delete($id){
            $query = "DELETE FROM Cliente WHERE idCliente = :id";
            $result = $this->con->prepare($query);
            $result->bind(':id', $id);
            $result->execute();
            
            return $result->rowCount();
        }
    }

?>