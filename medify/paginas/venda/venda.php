<?php
include_once '../../backend/venda/relatorioVenda.php';
include_once '../../backend/medicamento/buscaMedicamento.php';
include_once '../../backend/venda/buscarVenda.php';

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
        <title>Ordem de venda | Medify</title>
        <link rel="stylesheet" href="venda.css">
        <link rel="stylesheet" href="../../componentes/menu/menu.php">
    </head>
    <body>
<?php
   include_once '../../componentes/menu/menu.php'

?>
        <section class="pagina">
            <header class="titulo">
                <h1>Administração | Ordem de venda</h1>
            </header>
            <form action="../../backend/venda/criarVenda.php"method="post">
                <div class="inputs">
                    <div class="linha">
                        <input type="text" name="cliente" placeholder="Cliente">
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
                        <input type="date" name="dt_venda" placeholder="Data de venda">
                        <input type="text" name="quantidade" placeholder="Quantidade">
                    </div>

                    <div class="linha">
                        <select name="tipo">
                            <option value="">Tipo</option>
                            <option value="201">Normal</option>
                            <option value="200">Fidelidade</option>
                        </select>
                    </div> 

                    <div class="linha">
                        <select name="situacao">
                            <option value="">Situação</option>
                            <option value="2">Pendente</option>
                            <option value="1">Pago</option>
                        </select>    
                    </div> 
                    
                    <div class="linha">
                        <input type="text" name="mt_pagamento" placeholder="MT Pagamento">
                        <input type="date" name="dt_pagamento" placeholder="DT Pagamento">
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
                        <th>Cliente</th>
                        <th>DT Venda</th>
                        <th>Tipo</th>
                        <th>Situação</th>
                        <th>MT Pagamento</th>
                        <th>DT Pagamento</th>
                        <th>Medicamento</th>
                        <th>Id</th>
                        <th>Quantidade</th>
                    </tr>
                    <?php

                    foreach($relatorio as $venda){
                        echo("<tr>
                          
                            <td>".$venda['id']."</td>
                            <td>".$venda['cliente']."</td>
                            <td>".$venda['dt_venda']."</td>
                            <td>".$venda['tipo']."</td>
                            <td>".$venda['situacao']."</td>
                            <td>".$venda['mt_pagamento']."</td>
                            <td>".$venda['dt_pagamento']."</td>
                            <td>".$venda['nome']."</td>
                            <td>".$venda['medicamento']."</td>
                            <td>".$venda['quantidade']."</td>

                        </tr>");
                    }


                    ?>
                </table>

            </div>
        </section>
    </body>
</html>