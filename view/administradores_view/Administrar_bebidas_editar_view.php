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
    <title>Editar bebidas</title>
    <link rel="stylesheet" href="./Style/style.css">
    <link rel="stylesheet" href="./Style/style_administradores.css">
</head>        
<body>
     
    <header>
        <div class="logo">
            <?php echo $_SESSION["login"]["logo"] ?>
        </div>
        <div class="central">
            <h1>Editar bebidas</h1>
        </div>
        <div class="desconeccion">
            <?php 
                echo $_SESSION["login"]["usuarioAcceso"].$_SESSION["login"]["logout"];
            ?> 
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
                        <legend>Bebida id <?php echo $datoActual->id_bebida; ?></legend>
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="administrador[bebidas][editar][datos][nombre]" id="nombre" value="<?php echo $datoActual->nombre; ?>"  maxlength="20" title="Requerido Maximo 20 caracteres" required>
                        <label for="descripcion">Descripcion:</label>
                        <input type="text" name="administrador[bebidas][editar][datos][descripcion]" id="descripcion" value="<?php echo $datoActual->descripcion; ?>" maxlength="50" title="Maximo 50 caracteres">

                        <label for="tipo">Tipo (<?php echo $datoActual->tipo; ?>)</label>
                        <select name="administrador[bebidas][editar][datos][tipo]" id="tipo">
                            <option value="refresco_con_gas" <?php $datoActual->tipo=="refresco_con_gas" ? $selected="selected" : $selected=""; echo $selected; ?>>Refresco con gas</option>
                            <option value="refresco_sin_gas" <?php $datoActual->tipo=="refresco_sin_gas" ? $selected="selected" : $selected=""; echo $selected; ?>>Refresco sin gas</option>
                            <option value="zumo" <?php $datoActual->tipo=="zumo" ? $selected="selected" : $selected=""; echo $selected; ?>>Zumo</option>
                            <option value="batido" <?php $datoActual->tipo=="batido" ? $selected="selected" : $selected=""; echo $selected; ?>>Batido</option>
                            <option value="infusion" <?php $datoActual->tipo=="infusion" ? $selected="selected" : $selected=""; echo $selected; ?>>Infusión</option>
                            <option value="cafe" <?php $datoActual->tipo=="cafe" ? $selected="selected" : $selected=""; echo $selected; ?>>Café</option>
                            <option value="cerveza" <?php $datoActual->tipo=="cerveza" ? $selected="selected" : $selected=""; echo $selected; ?>>Cerveza</option>
                            <option value="alcoholica" <?php $datoActual->tipo=="alcoholica" ? $selected="selected" : $selected=""; echo $selected; ?>>Licor</option>
                            <option value="coctel" <?php $datoActual->tipo=="coctel" ? $selected="selected" : $selected=""; echo $selected; ?>>Cóctel</option>
                        </select>

                        <p class="parrafo_form">Estado 
                            (<?php
                                if ($datoActual->estado) {
                                    echo "Activado";
                                }else{
                                    echo "Desactivado";
                                } 
                            ?>)
                        </p>
                        <div class="form_radio">
                            <input type="radio" name="administrador[bebidas][editar][datos][estado]" id="Activado" value="1" 
                            <?php if($datoActual->estado){
                                echo "checked";
                            } ?>>
                            <label for="Activado">Activado:</label>
                            <input type="radio" name="administrador[bebidas][editar][datos][estado]" id="desactivado" value="0" 
                            <?php if(!$datoActual->estado){
                                echo "checked";
                            } ?>>
                            <label for="desactivado">Desactivado:</label>
                        </div>
                    </fieldset>

                    <fieldset class="formulario">
                        <legend>Foto</legend>
                        
                        <div class="foto_editar">
                            <label for="foto"><img id="foto_editar" src=<?php echo $fotoActual; ?> alt="foto bebida"></label>
                        </div>
                        <input type="file" name="foto" id="foto" accept="image/jpeg">

                        <input type="submit" name="administrador[bebidas][editar][submit]" value="Modificar" id="boton_editar_bebida">
                        <input type="hidden" name="administrador[bebidas][editar][id]" value="<?php echo $id;?>">
                    </fieldset>
                </form>
                  
            </article>
        
        </section> <!--fin contenido-->

    </div> <!--fin contenedor section + aside-->


    <!--Javascrip-->
    <script>
    </script>
</body>
</html>