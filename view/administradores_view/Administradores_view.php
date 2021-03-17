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
    <title>Administradores</title>
    <link rel="stylesheet" href="./Style/style.css">
    <link rel="stylesheet" href="./Style/style_administradores.css">
</head>        
<body>
     
    <header>
        <div class="logo">
            <?php echo $_SESSION["login"]["logo"] ?>
        </div>
        <div class="central">
            <h1>Administradores</h1>
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
            <article class="menu_administradores">
            <form action="./index.php" method="post">
                <!-- <input type="submit" value="Trabajadores" name="administrador[trabajadores]">
                <input type="submit" value="Platos" name="administrador[platos]">
                <input type="submit" value="Bebidas" name="administrador[bebidas]">
                <input type="submit" value="Menus" name="administrador[menus]">
                <input type="submit" value="Mesas" name="administrador[mesas]"> -->
                <button type="submit" name="administrador[trabajadores]"><img src="img/trabajadores.png" alt="imagen trabajadores" />Trabajadores</button>
                <button type="submit" name="administrador[platos]"><img src="img/platos.png" alt="imagen plato" />Platos</button>
                <button type="submit" name="administrador[bebidas]"><img src="img/bebidas.png" alt="imagen bebida" />Bebidas</button>
                <button type="submit" name="administrador[menus]"><img src="img/menus.png" alt="imagen menu" />Menus</button>
                <button type="submit" name="administrador[mesas]"><img src="img/mesas2.png" alt="imagen mesa" />Mesas</button>
            </form>
                
                
            </article>
        
        </section> <!--fin contenido-->

    </div> <!--fin contenedor section + aside-->


    <!--Javascrip-->
    <script>
    </script>
</body>
</html>