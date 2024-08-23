<?php

require_once '../../backend/database/conexao.php';

$mensagem_erro = '';

try{

    $preparo = $conexao->prepare("
        select
            id,
            nome

        from tb_medicamento m
    ");
    $preparo->execute();

    $arrMedicamento = $preparo->fetchAll();

}catch(PDOException $erro){
    print_r($erro);
    $mensagem_erro = 'erro';
}
?>