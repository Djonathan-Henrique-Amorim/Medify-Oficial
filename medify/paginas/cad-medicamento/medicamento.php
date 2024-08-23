<?php
include_once '../../backend/medicamento/relatorioMedicamento.php';

$mensagem = null;
if($_GET){
    if($_GET['status']){
        switch($_GET['status']){
            case 201:
                $mensagem = 'Adicionado com sucesso!';
                break;
            case 400:
                $mensagem = 'Inserção não funcionou';
                break;
            case 500:
                $mensagem = 'Erro ao tentar inserir informações';
                break;
        }
    }
}





?>



<html>
    <head>
        <title>Medicamento | Medify</title>
        <link rel="stylesheet" href="medicamento.css">
        <link rel="stylesheet" href="../../componentes/menu/menu.php">
    </head>
    <body>
        
<?php
    include_once '../../componentes/menu/menu.php'
?>

        <section class="pagina">
            <header class="titulo">
                <h1>Administração | Cadastro de medicamentos</h1>
            </header>
            <form action="../../backend/medicamento/criarMedicamento.php"method="post">
                <div class="inputs">
                    <div class="linha">
                        <input type="text" name="nome" placeholder="Nome">
                    </div>
                    <div> 
                        <select name="controlado">
                            <option value="">Controlado</option>
                            <option value="s">Sim</option>
                            <option value="n">Não</option>
                        </select>
                        <select name="alta_vigilancia">
                            <option value="">Alta Vigilância</option>
                            <option value="s">Sim</option>
                            <option value="n">Não</option>
                        </select>
                    </div>
                    <div class="linha">
                        <input type="text" name="valor" placeholder="Valor">
                    </div>
                    <div class="linha">
                        <select name="ativo">
                            <option value="">Ativo</option>
                            <option value="s">Sim</option>
                            <option value="n">Não</option>
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
                        <th>Controlado</th>
                        <th>Alta Vigilância</th>
                        <th>Valor</th>
                        <th>Ativo</th>
                    </tr>


                    <?php

                    foreach($relatorio as $medicamento){
                        echo(
                            "<tr>

                                <td>".$medicamento['id']."</td>
                                <td>".$medicamento['nome']."</td>
                                <td>".$medicamento['controlado']."</td>
                                <td>".$medicamento['alta_vigilancia']."</td>
                                <td>".$medicamento['valor']."</td>
                                <td>".$medicamento['ativo']."</td>
                        </tr>");
                    }


                    ?>

                </table>

            </div>
        </section>
    </body>
</html>