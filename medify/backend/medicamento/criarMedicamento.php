<?php
require_once '../database/conexao.php';

$requisicao = $_POST;
try{
    $preparacao = $conexao->prepare("
        insert into tb_medicamento(
            nome, controlado, alta_vigilancia, valor, ativo
        )values (
            :nome, :controlado, :alta_vigilacia, :valor, :ativo
        )
    ");
    $preparacao->bindParam(':nome',$requisicao['nome'],PDO::PARAM_STR);
    $preparacao->bindParam(':controlado',$requisicao['controlado'],PDO::PARAM_STR);
    $preparacao->bindParam(':alta_vigilacia',$requisicao['alta_vigilancia'],PDO::PARAM_STR);
    $preparacao->bindParam(':valor',$requisicao['valor'],PDO::PARAM_STR);
    $preparacao->bindParam(':ativo',$requisicao['ativo'],PDO::PARAM_STR);
    $preparacao->execute();
    if($preparacao->rowCount()==1){
        header('Location:../../paginas/cad-medicamento/medicamento.php?status=201');
        die();
    } else{
        header('Location:../../paginas/cad-medicamento/medicamento.php?status=400');
        die();
    }

}catch(PDOException $erro){
    print_r($erro);
    die();
};
?>