<?php
    Class Cliente{
        private $idCliente;
        public $nome;
        public $habilitacao;
        public $endereco;
        public $sexo;

        public function _construct($nome, $hab, $end, $sexo){
            $this->idCliente = null;
            $this->nome = $nome;
            $this->habilitacao = $hab;
            $this->endereco = $end;
            $this->sexo = $sexo;

        }

        public function setIdCliente($num){
            $idCliente = $num;
        }

        public function getIdCliente(){
            return $this->cliente;
        }
    }

?>