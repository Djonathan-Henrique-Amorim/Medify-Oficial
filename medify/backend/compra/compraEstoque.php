<?php

require_once '../../backend/database/conexao.php';

$mensagem_erro = '';

try{

    $preparo = $conexao->prepare("

select
	med.nome,
	sum(oc.quantidade) as receber
from tb_compraitem oc
	inner join tb_medicamento med on med.id = oc.medicamento
    inner join tb_odc c on c.id = oc.odc
where situacao = 2
group by med.nome 

    ");
    $preparo->execute();

    $relatorio = $preparo->fetchAll();

}catch(PDOException $erro){
    print_r($erro);
    $mensagem_erro = 'erro';
}
?>