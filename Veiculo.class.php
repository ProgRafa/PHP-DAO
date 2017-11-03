<?php
    Class Veiculo{ 
        private $idVeiculo;
        private $modelo;
        private $placa;
        private $ano;
        private $local;
        private $uf;
        
        public function _construct($modelo, $placa, $ano, $local, $uf){
            $this->idVeiculo=null;
            $this->placa=$placa;            
            $this->ano=$ano;            
            $this->local=$local;
            $this->uf=$uf;
        }

        public function setIdVeiculo($id){
            $this->idVeiculo=$id;
        }
        public function getIdVeiculo(){
            return $this->idVeiculo;
        }
        
        public function setModelo($novo_modelo){
            $this->modelo=$novo_modelo;
        }
        public function getIdVeiculo(){
            return $this->modelo;
        }

        public function setPlaca($nova_placa){
            $this->placa=$nova_placa;
        }
        public function getPlaca(){
            return $this->placa;
        }

        public function setAno($novo_ano){
            $this->ano=$novo_ano;
        }
        public function getAno(){
            return $this->ano;
        }

        public function setLocal($novo_local){
            $this->local=$novo_local;
        }
        public function getLocal(){
            return $this->local;
        }

        public function setUF($nova_uf){
            $this->uf=$nova_uf;
        }
        public function getUF(){
            return $this->uf;
        }
    }
?>