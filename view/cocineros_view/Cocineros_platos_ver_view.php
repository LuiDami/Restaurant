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
    <title>Ver platos</title>
    <link rel="stylesheet" href="./Style/style.css">
    <link rel="stylesheet" href="./Style/style_administradores.css">
</head>        
<body>
     
    <header>
        <div class="logo">
            <?php echo $_SESSION["login"]["logo"] ?>
        </div>
        <div class="central">
            <h1>Ver platos</h1>
        </div>
        <div class="desconeccion">
            <?php echo $_SESSION["login"]["usuarioAcceso"].$_SESSION["login"]["logout"];?> 
        </div>
    </header>

    <nav>
        <form action="./index.php" method="post">
            <input class="butoom_nav" type="submit" value="Volver Platos" name="cocinero[platos]">
            <input class="butoom_nav" type="submit" value="Volver Cocinero" name="cocineros">
        </form>
    </nav>

    <div class="contenedor"> <!--contenedor de section y aside-->

        <section> <!--contenido-->
            <article class="article_crear">

                <form action="./index.php" method="post" class="form_crear" id="crear" enctype="multipart/form-data">
                    <fieldset  class="formulario">
                        <legend>Plato id <?php echo $datoActual->id_plato; ?></legend>
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="cocinero[platos][editar][datos][nombre]" id="nombre" value="<?php echo $datoActual->nombre; ?>"  maxlength="20" title="Requerido Maximo 20 caracteres" required>
                        <label for="descripcion">Descripcion:</label>
                        <input type="text" name="cocinero[platos][editar][datos][descripcion]" id="descripcion" value="<?php echo $datoActual->descripcion; ?>" maxlength="50" title="Maximo 50 caracteres">

                        <label for="tipo">Tipo:</label>
                        <select name="cocinero[platos][editar][datos][tipo]" id="tipo">
                            <option value="primero" <?php $datoActual->tipo=="primero" ? $selected="selected" : $selected=""; echo $selected; ?> >Primero</option>
                            <option value="segundo"<?php $datoActual->tipo=="segundo" ? $selected="selected" : $selected=""; echo $selected; ?>>Segundo</option>
                            <option value="entrante"<?php $datoActual->tipo=="entrante" ? $selected="selected" : $selected=""; echo $selected; ?>>Entrante</option>
                            <option value="postre"<?php $datoActual->tipo=="postre" ? $selected="selected" : $selected=""; echo $selected; ?>>Postre</option>
                            <option value="bocadillo"<?php $datoActual->tipo=="bocadillo" ? $selected="selected" : $selected=""; echo $selected; ?>>Bocadillo</option>
                            <option value="aperitivo"<?php $datoActual->tipo=="aperitivo" ? $selected="selected" : $selected=""; echo $selected; ?>>Aperitivo</option>
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
                            <input type="radio" name="cocinero[platos][editar][datos][estado]" id="Activado" value="1" 
                            <?php if($datoActual->estado){
                                echo "checked";
                            } ?> >
                            <label for="Activado">Activado:</label>
                            <input type="radio" name="cocinero[platos][editar][datos][estado]" id="desactivado" value="0" 
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
                        <input type="file" name="foto" id="foto" accept="image/jpeg" >

                    </fieldset>

                    <fieldset class="formulario">
                        <!-- <textarea id="receta_dasabilitada" disabled><?php echo $datoActual->receta; ?></textarea> -->
                        <label for="receta_dasabilitada">Receta:</label>
                        <textarea id="receta_dasabilitada" name="cocinero[platos][editar][datos][receta]" ><?php echo $datoActual->receta; ?></textarea>

                        <legend >Receta</legend>
                        
                        <!-- <input type="text" name="cocinero[platos][crear][receta]" id="receta"> -->
                        <!-- <textarea name="cocinero[platos][editar][datos][receta]" id="receta_editar" ></textarea> -->

                        <input class="crear_doble" type="submit" name="cocinero[platos][editar][submit]" value="Modificar">
                        <input type="hidden" name="cocinero[platos][editar][id]" value="<?php echo $id;?>">
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