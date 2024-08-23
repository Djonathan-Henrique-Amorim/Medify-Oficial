<?php

require_once '../../backend/database/conexao.php';

$mensagem_erro = '';

try{

    $preparo = $conexao->prepare("
       select 
    v.id,
    v.cliente,
    v.dt_venda,
    v.tipo,
    v.situacao,
    v.mt_pagamento,
    v.dt_pagamento,
    m.nome,
	i.medicamento,
	i.quantidade
 from tb_venda v
	inner join tb_vendaitem i on i.venda = v.id
    inner join tb_medicamento m on m.id = i.medicamento
    ");
    $preparo->execute();

    $relatorio = $preparo->fetchAll();

}catch(PDOException $erro){
    print_r($erro);
    $mensagem_erro = 'erro';
}
?>