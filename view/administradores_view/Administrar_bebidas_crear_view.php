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
    <title>Crear bebidas</title>
    <link rel="stylesheet" href="./Style/style.css">
    <link rel="stylesheet" href="./Style/style_administradores.css">
</head>        
<body>
     
    <header>
        <div class="logo">
            <?php echo $_SESSION["login"]["logo"] ?>
        </div>
        <div class="central">
            <h1>Crear bebidas</h1>
        </div>
        <div class="desconeccion">
            <?php echo $_SESSION["login"]["usuarioAcceso"].$_SESSION["login"]["logout"];?> 
        </div>
    </header>

    <nav>
        <form action="./index.php" method="post">
            <input class="butoom_nav" type="submit" value="Volver Bebidas" name="administrador[bebidas]">
            <input class="butoom_nav" type="submit" value="Volver Administrador" name="administrador">
        </form>
    </nav>

    <div class="contenedor"> <!--contenedor de section y aside-->

        <section> <!--contenido-->
            <article class="article_crear">
                <form action="./index.php" method="post" class=form_crear id="crear" enctype="multipart/form-data">
                    <fieldset class="formulario">
                        <legend>Datos bebida</legend>
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="administrador[bebidas][crear][nombre]" id="nombre" maxlength="20" title="Requerido Maximo 20 caracteres" required>
                        <label for="descripcion">Descripcion:</label>
                        <input type="text" name="administrador[bebidas][crear][descripcion]" id="descripcion" maxlength="50" title="Maximo 50 caracteres">

                        <label for="tipo">Tipo:</label>
                        <select name="administrador[bebidas][crear][tipo]" id="tipo">
                            <option value="refresco_con_gas">Refresco con gas</option>
                            <option value="refresco_sin_gas">Refresco sin gas</option>
                            <option value="zumo">Zumo</option>
                            <option value="batido">Batido</option>
                            <option value="infusion">Infusión</option>
                            <option value="cafe">Café</option>
                            <option value="cerveza">Cerveza</option>
                            <option value="alcoholica">Licor</option>
                            <option value="coctel">Cóctel</option>
                        </select>

                        <p class="parrafo_form">Seleccione Estado:</p>
                        <div class="form_radio">
                            <input type="radio" name="administrador[bebidas][crear][estado]" id="Activado" value="1" checked >
                            <label for="Activado">Activado:</label>
                            <input type="radio" name="administrador[bebidas][crear][estado]" id="desactivado" value="0">
                            <label for="desactivado">Desactivado:</label>
                        </div>
                        <label for="foto">Foto:</label>
                        <input type="file" name="foto" id="foto" accept="image/jpeg">

                        <input type="submit" name="administrador[bebidas][crear][submit]" value="Crear">
                    </fieldset>
                </form>
                <p>
                <?php echo $mensajeCreacion ?>
                </p>
                  
            </article>
        
        </section> <!--fin contenido-->

    </div> <!--fin contenedor section + aside-->

    


    <!--Javascrip-->
    <script>
    </script>
</body>
</html>