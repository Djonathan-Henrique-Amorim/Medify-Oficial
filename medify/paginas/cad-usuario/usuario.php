<?php
//inclui o relatorio de usuario
include_once '../../backend/usuario/relatorioUsuario.php';


//inicializa uma variavel com nome de 
$mensagem = null;
//verifica se recebeu alguma informação por meio de GET
if($_GET){
    //verifica se essa informação é um status
    if($_GET['status']){
        //utiliza a estrutura de decisão switch para verificar qual
        //status foi recebido e atribuir uma mensagem conforme necessário
        switch($_GET['status']){
            case 201:
                //criado
                $mensagem = 'Adicionado com sucesso!';
                break;
            case 400:
                //bad request
                $mensagem = 'Inserção não funcionou';
                break;
            case 500:
                //erro no servidor
                $mensagem = 'Erro ao tentar inserir informações';
                break;
        }
    }
}





?>



<html>
    <head>
        <title>Usuario | Medify</title>
        <link rel="stylesheet" href="usuario.css">
        <link rel="stylesheet" href="../../componentes/menu/menu.php">
    </head>
    <body>
<?php
    include_once '../../componentes/menu/menu.php'

?>
        <section class="pagina">
            <header class="titulo">
                <h1>Administração | Cadastro de usúarios</h1>
            </header>
            <form action="../../backend/usuario/criarUsuario.php"method="post">
                <div class="inputs">
                    <div class="linha">
                        <input type="text" name="nome" placeholder="Nome">
                        <input type="text" name="sobrenome" placeholder="Sobrenome">
                    </div> 
                    <input type="text" name="endereco" placeholder="Endereço">   
                    <div class="linha">
                        <input type="text" name="email" placeholder="E-mail">
                        <input type="text" name="telefone" placeholder="Telefone">
                    </div> 
                    <div class="linha">
                        <input type="text" name="usuario" placeholder="Usuário">
                        <select name="cargo">
                            <option value="">Tipo de usuário</option>
                            <option value="300">Administrador</option>
                            <option value="301">Normal</option>
                        </select>    
                    </div> 


                </div>
                <div class="controles">
                    <button type="submit" class="salvar">Salvar</button>
                    <button type="reset" class="cancelar">Cancelar</button>
                    <?php
                        echo('<p>'.$mensagem.'</p>');
                    ?>
                </div>

            </form>
            <div class="relatorio">
                <h1>Relatório</h1>
                <table>
                    <tr>
                       
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Login</th>
                        <th>Cargo</th>
                    </tr>
                    <?php

                    //utilizar a função foreach
                    //para iterar entre os itens do array
                    //que é o nosso $relatorio

                    foreach($relatorio as $usuario){
                        echo("<tr>
                           
                            <td>".$usuario['id']."</td>
                            <td>".$usuario['nome']." ".$usuario['sobrenome']."</td>
                            <td>".$usuario['telefone']."</td>
                            <td>".$usuario['login']."</td>
                            <td>".$usuario['descricao']."</td>
                        </tr>");
                    }


                    ?>
                </table>

            </div>
        </section>
    </body>
</html>