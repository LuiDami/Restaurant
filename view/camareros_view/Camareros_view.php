<?php 
    if (!isset($_SESSION["login"])) {
        header("Location: ../../index.php");
    }
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Camarero</title>
    <link rel="stylesheet" href="./Style/style.css">
    <style>
        article{
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 300%;
            color: var(--header_letras_active);
            flex-direction: column;
        }
    </style>
</head>        
<body>
     
    <header>
        <div class="logo">
            <?php echo $_SESSION["login"]["logo"] ?>
        </div>
        <div class="central">
            <h1>Camarero</h1>
        </div>
        <div class="desconeccion">
            <?php echo $_SESSION["login"]["usuarioAcceso"].$_SESSION["login"]["logout"];?> 
        </div>
    </header>

    <nav>
        <form action="./index.php" method="post">
            <input class="butoom_nav" type="submit" value="Volver" name="volver">
        </form>
    </nav>

    <div class="contenedor"> <!--contenedor de section y aside-->

        <section> <!--contenido-->
            <article>
                <img id="chef" src="img/chef.png" alt="imagen chef">
                <p>Páguina en proceso, disculpen las molestias</p>
            </article>
        
        </section> <!--fin contenido-->

    </div> <!--fin contenedor section + aside-->


    <!--Javascrip-->
    <script>
    </script>
</body>
</html>