<?php
$erro = null;
if($_GET){
    if($_GET['erro']){
        $erro = $_GET['erro'];

    }
}


?>
<html>
    <head>
        <title>login | Medify</title>
        <link rel="stylesheet" href="styles.css">
        <meta charset="utf-8">
        <script src="https://kit.fontawesome.com/49007d2d87.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <section class="tela">
            <div class="quadradao">
                <form class="login" action="backend/login/login.php" method="post">
                    <h1 class="medify">Medify</h1>
                    <p class="seja">Insira suas credenciais abaixo</p>
                    <input type="text" placeholder="Usuário" class="grande" name="usuario">
                    <input type="password" placeholder="Senha" class="grande" name="senha">
                    <button class="entrar" type="submit">Entrar</button>
                </form>
               <?php
               if($erro != null){
                switch($erro){
                    case '401':
                        echo("<p class=\"erro\">Usuário ou senha inválida</p>");
                        break;
                    case '500':
                        echo("<p class=\"erro\">Erro no servidor, tente novamente mais tarde!</p>");
                        break;
                }
               }
               
               ?>
               <a class="e">Desenvolvido por Djonathan H. Amorim</a> 
            </div>
            <article class="logo">
                <img src="L1.png">

            </article>
        </section>
    </body>
</html>