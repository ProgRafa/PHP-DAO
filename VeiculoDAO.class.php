<?php
    include_once "BDO_Conection.php";
    include_once "Veiculo.class.php";

    Class VeiculoDAO{
        private $con;
        
        public function _construct(){
            $this->con=ConexaoDAO::obterConexao();
        }

        public function getAll(){

        }

        public function getForID($id){
            $obj=null;

            $query="SELECT * FROM veiculo WHERE idVeiculo = :id";
            $resp=$this->con->prepare($query);
            $resp->bindValue(':id', $id);
            $resp->execute();

            $result=$resp->fetchAll();//Máximo uma linha de resposta
            //extract($result[0]) cria variavel para cada indice associativo encontrado
            if(count($result) > 0){
                $obj = new Veiculo(
                                    $result[0]['modelo'], 
                                    $result[0]['placa'], 
                                    $result[0]['ano'], 
                                    $result[0]['local'],
                                    $result[0]['uf']
                                );
                $obj->setIdVeiculo($result[0]['idVeiculo']);                        
            }

            return $obj;        
        }

        public function update($veiculo){
            if($veiculo->getIdVeiculo() == null){
                $query = "INSERT INTO Veiculo(modelo, placa, ano, local, uf)
                          VALUES (?, ?, ?, ?, ?)";
            }else{
                $query = "UPDATE Veiculo 
                          SET modelo = ?, placa = ?, ano = ?, local = ?, uf = ?
                          WHERE idVeiculo = ".$veiculo->getIdVeiculo();
            }
            
            $result = $this->con->prepare($query);
            $vetor = array($obj->getModelo(), $obj->getPlaca(), $obj->getAno(), $obj->getLocal(), $obj->getUF());
            $result->execute($vetor);

            return $result->rowCount();
        }

        public function delete($id){
            $query="DELETE FROM veiculo WHERE idVeiculo=:id";
            $resp = $this->con->prepare($query);
            $resp->bindValue(':id', $id);
            $resp->execute(); //retorna nmr de linhas
            return $resp->rowCount();
        }
    }
?>