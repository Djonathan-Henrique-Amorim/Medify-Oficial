<?php

//requer conexao com o banco de dados 
require_once '../../backend/database/conexao.php';

//inicializa variavel de mensagem
$mensagem_erro = '';

//inicia a estrutura de tentativa try
try{

    //prepara a query sql para execucao 
    $preparo = $conexao->prepare("
        select
            u.id,
            u.nome,
            u.sobrenome,
            u.telefone,
            u.login,
            u.cargo,
            t.descricao
        from tb_usuario u
            inner join tb_tipo t on t.id = u.cargo    
    ");
    //executa a query
    $preparo->execute();

    //coloca o resultado em um array usando o fetch_assoc
    $relatorio = $preparo->fetchAll();

    //#### TESTAR se deu certo remover depois ####
    //foreach($relatorio as $linha){
      //  print_r($linha);
    //}


}catch(PDOException $erro){
    //imprime o erro na tela
    print_r($erro);
    //coloca que deu erro na variavel mensagem_erro
    $mensagem_erro = 'erro';
}






?>