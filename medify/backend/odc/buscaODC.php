<?php

require_once '../../backend/database/conexao.php';

$mensagem_erro = '';

try{

    $preparo = $conexao->prepare("
        select 
	        oc.id,
            i.medicamento,
            m.nome,
            i.quantidade,
            oc.dt_solicitacao,
            oc.dt_pagamento,
            oc.dt_entrega,
            oc.dt_previsao,
            oc.situacao,
            s.descricao
            from tb_odc oc
	        inner join tb_compraitem i on i.odc = oc.id
            inner join tb_medicamento m on m.id = i.medicamento
            inner join tb_situacao s on s.id = oc.situacao
    ");
    $preparo->execute();

    $relatorio = $preparo->fetchAll();

}catch(PDOException $erro){
    print_r($erro);
    $mensagem_erro = 'erro';
}
?>