<?php

require_once '../../backend/database/conexao.php';

$mensagem_erro = '';

try{

    $preparo = $conexao->prepare("
select
	med.nome,
	sum(vi.quantidade) as vender
from tb_vendaitem vi
	inner join tb_medicamento med on med.id = vi.medicamento
    inner join tb_venda v on v.id = vi.venda     
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