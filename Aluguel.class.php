<?php 
    class Aluguel{
        private $idAluguel;
        private $cliente;
        private $veiculo;
        public $data_entrada;
        public $data_saida;

        public function _construct($in_d, $out_d){
            $this->data_entrada = $in_d;
            $this->data_saida = $out_d;
        }

        public function setIdAluguel($id){
            $this->idAluguel = $id;
        }

        public function getIdAluguel(){
            return $this->idAluguel;
        }

        public function setCliente($obj){
            $this->cliente = $obj;
        }

        public function getCliente(){
            return $this->cliente;
        }

        public function setVeiculo($obj){
            $this->veiculo = $obj;
        }

        public function getVeiculo(){
            return $this->veiculo;
        }
    } 

?>