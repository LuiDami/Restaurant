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
    <title>Crear platos</title>
    <link rel="stylesheet" href="./Style/style.css">
    <link rel="stylesheet" href="./Style/style_administradores.css">
</head>        
<body>
     
    <header>
        <div class="logo">
            <?php echo $_SESSION["login"]["logo"] ?>
        </div>
        <div class="central">
            <h1>Crear platos</h1>
        </div>
        <div class="desconeccion">
            <?php echo $_SESSION["login"]["usuarioAcceso"].$_SESSION["login"]["logout"];?> 
        </div>
    </header>

    <nav>
        <form action="./index.php" method="post">
            <input class="butoom_nav" type="submit" value="Volver Platos" name="cocinero[platos]">
            <input class="butoom_nav" type="submit" value="Volver Cocinero" name="cocinero">
        </form>
    </nav>

    <div class="contenedor"> <!--contenedor de section y aside-->

        <section> <!--contenido-->
            <article class="article_crear">

                <form action="./index.php" method="post" class="form_crear" id="crear" enctype="multipart/form-data">
                    <fieldset  class="formulario">
                        <legend>Datos platos</legend>
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="cocinero[platos][crear][nombre]" id="nombre" maxlength="20" title="Requerido Maximo 20 caracteres" required>
                        <label for="descripcion">Descripcion:</label>
                        <input type="text" name="cocinero[platos][crear][descripcion]" id="descripcion" maxlength="50" title="Maximo 50 caracteres">

                        <label for="tipo">Tipo:</label>
                        <select name="cocinero[platos][crear][tipo]" id="tipo">
                            <option value="primero">Primero</option>
                            <option value="segundo">Segundo</option>
                            <option value="entrante">Entrante</option>
                            <option value="postre">Postre</option>
                            <option value="bocadillo">Bocadillo</option>
                            <option value="aperitivo">Aperitivo</option>
                        </select>

                        <p class="parrafo_form">Seleccione Estado:</p>
                        <div class="form_radio">
                            <input type="radio" name="cocinero[platos][crear][estado]" id="Activado" value="1" checked >
                            <label for="Activado">Activado:</label>
                            <input type="radio" name="cocinero[platos][crear][estado]" id="desactivado" value="0">
                            <label for="desactivado">Desactivado:</label>
                        </div>
                        <label for="foto">Foto:</label>
                        <input type="file" name="foto" id="foto" accept="image/jpeg" >
                    </fieldset>

                    <fieldset class="formulario">
                        <legend>Receta</legend>
                        <label for="receta">Receta:</label>
                        <!-- <input type="text" name="cocinero[platos][crear][receta]" id="receta"> -->
                        <textarea name="cocinero[platos][crear][receta]" id="receta" ></textarea>

                        <input class="crear_doble" type="submit" name="cocinero[platos][crear][submit]" value="Crear">
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