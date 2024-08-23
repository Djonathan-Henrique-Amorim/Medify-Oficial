<?php
include_once "../../backend/home/relatorioHome.php";
?>

<html>
    <head>
        <title>Relatorio de Estoque | Medify</title>
        <link rel="stylesheet" href="home.css">
        <link rel="stylesheet" href="../../componentes/menu/menu.php">
    </head>
    <body>
<?php
   include_once '../../componentes/menu/menu.php'

?>
        <section class="pagina">
            <header class="titulo">
                <h1>Estoque</h1>
            </header>
            <div class="relatorio">
                <h1>Relatório</h1>
                <table>
                    <tr>
                        <th>Medicamento</th>
                        <th>Em estoque</th>
                        <th>A receber</th>
                        <th>A vender</th>

                    </tr>
                    <?php

                    foreach($relatorio as $estoque){
                        echo("<tr>
                            <td>".$estoque['nome']."</td>
                            <td>".$estoque['estoque']."</td>
                            <td>".$estoque['receber']."</td>
                            <td>".$estoque['vender']."</td>
                        </tr>");
                    }
                    ?>
                </table>
                

            </div>
        </section>
    </body>
</html>