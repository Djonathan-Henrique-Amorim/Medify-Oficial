<?php
require_once '../../backend/database/conexao.php';

$requisicao = $_POST;
try{
    $stmt = $conexao->prepare("
        insert into tb_venda(
            cliente, dt_venda, tipo, situacao, mt_pagamento, dt_pagamento
        )values (
            :cliente, :dt_venda, :tipo, :situacao, :mt_pagamento, :dt_pagamento
        )
    ");
    $stmt->bindParam(':cliente',$requisicao['cliente'],PDO::PARAM_STR);
    $stmt->bindParam(':dt_venda',$requisicao['dt_venda'],PDO::PARAM_STR);
    $stmt->bindParam(':tipo',$requisicao['tipo'],PDO::PARAM_INT);
    $stmt->bindParam(':situacao',$requisicao['situacao'],PDO::PARAM_INT);
    $stmt->bindParam(':mt_pagamento',$requisicao['mt_pagamento'],PDO::PARAM_STR);
    $stmt->bindParam(':dt_pagamento',$requisicao['dt_pagamento'],PDO::PARAM_STR);

    $stmt->execute();

        $stmt2 = $conexao->prepare('select last_insert_id() as id');
        $stmt2->execute();
        $resultado = $stmt2->fetchAll();
        $id = $resultado[0]['id'];

        $stmt3 = $conexao->prepare("insert into tb_vendaitem(
            venda, medicamento, quantidade
            ) values(:venda, :medicamento, :quantidade)");
        $stmt3->bindParam(':venda',$id,PDO::PARAM_INT);
        $stmt3->bindParam(':medicamento',$requisicao["medicamento"],PDO::PARAM_INT);
        $stmt3->bindParam(':quantidade',$requisicao["quantidade"],PDO::PARAM_INT);

        $stmt3->execute();


    if($stmt->rowCount()==1){
        header('Location:../../paginas/venda/venda.php?status=201');
        die();
    } else{
        header('Location:../../paginas/venda/venda.php?status=400');
        die();
    }

}catch(PDOException $erro){
    print_r($erro);
    die();
};
?>