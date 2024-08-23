<?php

require_once '../../backend/database/conexao.php';

$mensagem_erro = '';

try{
 
    $preparo = $conexao->prepare("
        select * from tb_venda
    ");
    $preparo->execute();

    $relatorio = $preparo->fetchAll();

}catch(PDOException $erro){
    print_r($erro);
    $mensagem_erro = 'erro';
}
?>