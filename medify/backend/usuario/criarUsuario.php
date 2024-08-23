<?php

//Requer conexao com o banco de dados
require_once '../database/conexao.php';

//Coloca todas as informações recebidas via POST
//em uma variavel para ser utilizada posteriormente 
$requisicao = $_POST;
$senha = sha1('123Mudar!');

//Utiliza uma estrutura de tentativa para tentar
//inserir as informações no banco de dados
try{
    //utiliza o metodo prepare() da variavel conexao (que esta disponivel
    //no arquivo por meio do require_once), para preparar uma instrução
    //sql (banco de dados)
    $preparacao = $conexao->prepare("
        insert into tb_usuario(
            nome, sobrenome, endereco, telefone, login, senha, cargo
        )values (
            :nome, :sobrenome, :endereco, :telefone, :login, :senha, :tipo
        )
    ");
    //utiliza o metodo bindParam da classe PreparedStatement disponivel
    //na variavel preparação, que recebeu a preparação acima.
    //a função bindParam troca um dos parametros da instrução sql pelo 
    //valor contido em uma variavel. não esquecer de mudar o tipo no
    //ultimo argumento.
    $preparacao->bindParam(':nome',$requisicao['nome'],PDO::PARAM_STR);
    $preparacao->bindParam(':sobrenome',$requisicao['sobrenome'],PDO::PARAM_STR);
    $preparacao->bindParam(':endereco',$requisicao['endereco'],PDO::PARAM_STR);
    $preparacao->bindParam(':telefone',$requisicao['telefone'],PDO::PARAM_STR);
    $preparacao->bindParam(':login',$requisicao['usuario'],PDO::PARAM_STR);
    $preparacao->bindParam(':senha',$senha,PDO::PARAM_STR);
    $preparacao->bindParam(':tipo',$requisicao['cargo'],PDO::PARAM_INT);
    //ao final da troca dos parametros, estamos prontos para executar
    //a instrução, por isso utilizamos o metodo execute() da classe
    //PreparedStatement
    $preparacao->execute();
    //ao executar, precisamos verificar se o valor foi de fato
    //inserido no banco de dados para isso verificamos o valor do
    //rowCount() é igual a 1 (quantidade de linhas que foram inseridas)
    if($preparacao->rowCount()==1){
        //caso isso seja positivo, retorna para a pagina de cadastro
        //com o status 201(created)
        header('Location:../../paginas/cad-usuario/usuario.php?status=201');
        //morre a execução para evitar lacunas de segurança
        die();
    } else{
        //caso a quantidade não seja 1, retorna com o status
        //400 (Bad Request), informando que faltou algo
        header('Location:../../paginas/cad-usuario/usuario.php?status=400');
        //morre a execução para evitar lacunas de segurança
        die();
    }

}catch(PDOException $erro){
    print_r($erro);
    //executa caso recebe algum erro
    //volta para a pagina de cadastro e apresenta
    //um erro tipo 500 (Server Error)
    //header('Location:../../paginas/cad-usuario/usuario.php?status=500');
    //morre a execução para evitar lacunas de segurança
    die();
};















?>