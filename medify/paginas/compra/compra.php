<?php
include_once '../../backend/compra/relatorioCompra.php';
include_once '../../backend/medicamento/buscaMedicamento.php';
include_once '../../backend/odc/buscaODC.php';

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
        <title>Ordem de compra | Medify</title>
        <link rel="stylesheet" href="compra.css">
        <link rel="stylesheet" href="../../componentes/menu/menu.php">
    </head>
    <body>
<?php
    include_once '../../componentes/menu/menu.php'

?>
        <section class="pagina">
            <header class="titulo">
                <h1>Administração | Ordem de compra</h1>
            </header>
            <form action="../../backend/compra/criarCompra.php"method="post">
                <div class="inputs">
                    <div class="linha">
                        <input type="date" name="dt_solicitacao" placeholder="Data e hora da solicitação">
                        <select name="medicamento">
                        <option value="">Medicamento</option>
                        <?php
                        
                        if (isset($arrMedicamento)){
                            foreach($arrMedicamento as $medicamento){
                                echo("<option value=".$medicamento["id"].">".$medicamento["nome"]."</option>");
                            }
                        }
                        
                        
                        ?>
                        </select>

                    </div>
                    <div class="linha">
                        <input type="date" name="dt_previsao" placeholder="Data de previsão de entrega">
                        <input type="text" name="quantidade" placeholder="Quantidade">


                    </div>
                    <div class="linha">
                        <input type="date" name="dt_entrega" placeholder="Data de entrega">



                    </div>
                    <div class="linha">
                        <input type="date" name="dt_pagamento" placeholder="Data do pagamento">
                    </div> 
                    <div class="linha">
                        <select name="situacao">
                            <option value="">Situação</option>
                            <option value="2">Pendente</option>
                            <option value="1">Pago</option>
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
                        <th>DT Solicitação</th>
                        <th>DT Previsão</th>
                        <th>DT Entrega</th>
                        <th>DT Pagamento</th>
                        <th>Situação</th>
                        <th>Medicamento</th>
                        <th>Id</th>
                        <th>Quantidade</th>
                    </tr>
                    <?php

                    foreach($relatorio as $compra){
                        echo("<tr>
                    
                            <td>".$compra['id']."</td>
                            <td>".$compra['dt_solicitacao']."</td>
                            <td>".$compra['dt_previsao']."</td>
                            <td>".$compra['dt_entrega']."</td>
                            <td>".$compra['dt_pagamento']."</td>
                            <td>".$compra['situacao']."</td>
                            <td>".$compra['nome']."</td>
                            <td>".$compra['medicamento']."</td>
                            <td>".$compra['quantidade']."</td>

                        </tr>");
                    }


                    ?>
                </table>

            </div>
        </section>
    </body>
</html>