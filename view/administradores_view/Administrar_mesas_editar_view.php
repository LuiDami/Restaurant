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
    <title>Editar mesas</title>
    <link rel="stylesheet" href="./Style/style.css">
    <link rel="stylesheet" href="./Style/style_administradores.css">
</head>        
<body>
     
    <header>
        <div class="logo">
            <?php echo $_SESSION["login"]["logo"] ?>
        </div>
        <div class="central">
            <h1>Editar mesas</h1>
        </div>
        <div class="desconeccion">
            <?php echo $_SESSION["login"]["usuarioAcceso"].$_SESSION["login"]["logout"];?> 
        </div>
    </header>

    <nav>
        <form action="./index.php" method="post">
            <input class="butoom_nav" type="submit" value="Volver Mesas" name="administrador[mesas]">
            <input class="butoom_nav" type="submit" value="Volver Administrador" name="administrador">
        </form>
    </nav>

    <div class="contenedor"> <!--contenedor de section y aside-->

        <section> <!--contenido-->

            <article class="article_crear">
                <form action="./index.php" method="post" class="form_crear" id="crear">
                    <fieldset class="formulario">
                        <legend>Mesa número <?php echo $datoActual->numero_mesa; ?></legend>
                        
                        <label for="ubicacionY">Ubicacion en vertical</label>
                        <input type="number" name="administrador[mesas][editar][datos][ubicacionY]" id="ubicacionY" value="<?php echo $datoActual->ubicacionY; ?>"  min="1" max="9" list="posiciones" step="1" required>

                        <label for="ubicacionX">Ubicacion en horizontal</label>
                        <input type="number" name="administrador[mesas][editar][datos][ubicacionX]" id="ubicacionX" value="<?php echo $datoActual->ubicacionX; ?>"  min="1" max="9" list="posiciones" step="1" required>
                        
                        <input class="crear_doble" type="submit" name="administrador[mesas][editar][submit]" value="Modificar">
                        <input type="hidden" name="administrador[mesas][editar][id]" value="<?php echo $id;?>">
                    </fieldset>
                </form>
                <datalist id="posiciones">
                    <option value="1">
                    <option value="2">
                    <option value="3">
                    <option value="4">
                    <option value="5">
                    <option value="6">
                    <option value="7">
                    <option value="8">
                    <option value="9">
                </datalist>
                  
            </article>
        
        </section> <!--fin contenido-->

    </div> <!--fin contenedor section + aside-->

    


    <!--Javascrip-->
    <script>
    </script>
</body>
</html>