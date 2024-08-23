<?php
require_once '../../backend/database/conexao.php';

$requisicao = $_POST;
try{
    $stmt = $conexao->prepare("
        insert into tb_odc(
            dt_solicitacao, dt_previsao, dt_entrega, dt_pagamento, situacao
        )values (
            :dt_solicitacao, :dt_previsao, :dt_entrega, :dt_pagamento, :situacao
        )
    ");
    $stmt->bindParam(':dt_solicitacao',$requisicao['dt_solicitacao'],PDO::PARAM_STR);
    $stmt->bindParam(':dt_previsao',$requisicao['dt_previsao'],PDO::PARAM_STR);
    $stmt->bindParam(':dt_entrega',$requisicao['dt_entrega'],PDO::PARAM_STR);
    $stmt->bindParam(':dt_pagamento',$requisicao['dt_pagamento'],PDO::PARAM_STR);
    $stmt->bindParam(':situacao',$requisicao['situacao'],PDO::PARAM_INT);

    $stmt->execute();

        $stmt2 = $conexao->prepare('select last_insert_id() as id');
        $stmt2->execute();
        $resultado = $stmt2->fetchAll();
        $id = $resultado[0]['id'];

        $stmt3 = $conexao->prepare("insert into tb_compraitem(
            odc, medicamento, quantidade
            ) values(:odc, :medicamento, :quantidade)");
        $stmt3->bindParam(':odc',$id,PDO::PARAM_INT);
        $stmt3->bindParam(':medicamento',$requisicao["medicamento"],PDO::PARAM_INT);
        $stmt3->bindParam(':quantidade',$requisicao["quantidade"],PDO::PARAM_INT);

        $stmt3->execute();


    if($stmt->rowCount()==1){
        header('Location:../../paginas/compra/compra.php?status=201');
        die();
    } else{
        header('Location:../../paginas/compra/compra.php?status=400');
        die();
    }

}catch(PDOException $erro){
    print_r($erro);
    die();
};
?>