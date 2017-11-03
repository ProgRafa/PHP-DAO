<?php
    include_once "BDO_Conection.php";
    $con=ConexaoBDO::obterConexao();
    $comando="SELECT * FROM veiculo WHERE uf = ?";
    $resp=$con->prepare($comando);
    $resp->execute(array('RS'));
    $resultado=$resp->fetchAll();
    var_dump($resultado);    
?>