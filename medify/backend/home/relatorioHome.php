<?php

require_once '../../backend/database/conexao.php';

$mensagem_erro = '';

try{

    $preparo = $conexao->prepare("
with estoque as(
	select
    med.id,
	med.nome,
	sum(oc.quantidade) - sum(vi.quantidade) as estoque
from tb_medicamento med
	left join tb_compraitem oc on med.id = oc.medicamento
    left join tb_odc o on o.id = oc.odc
    left join tb_vendaitem vi on vi.medicamento = med.id
    left join tb_venda v on v.id = vi.venda
where v.situacao = 1 and o.situacao = 1
group by med.nome 
), pendenteCompra as(
	select
    med.id,
        med.nome,
        sum(oc.quantidade) as receber
    from tb_compraitem oc
        left join tb_medicamento med on med.id = oc.medicamento
        left join tb_odc c on c.id = oc.odc
    where situacao = 2
    group by med.nome 
), pendenteVenda as (
	select
			med.id,
            med.nome,
            sum(vi.quantidade) as vender
        from tb_vendaitem vi
            left join tb_medicamento med on med.id = vi.medicamento
            left join tb_venda v on v.id = vi.venda     
        where situacao = 2
        group by med.nome 
)
select
	e.nome,
    e.estoque,
    c.receber,
    v.vender
from estoque e
	left join pendenteCompra c on c.id = e.id
    left join pendenteVenda v on v.id = e.id
order by e.estoque desc, c.receber desc, v.vender desc


    ");
    $preparo->execute();

    $relatorio = $preparo->fetchAll();

}catch(PDOException $erro){
    print_r($erro);
    $mensagem_erro = 'erro';
}
?>