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
    <title>Editar trabajador</title>
    <link rel="stylesheet" href="./Style/style.css">
    <link rel="stylesheet" href="./Style/style_administradores.css">
    <style>
        .radio_camarero{
            visibility: <?php 
                            if($checkbox_camarero=="<label>Camarero</label>"){
                                echo "visible";
                            }else{
                                echo "hidden";
                            }
                        ?>
        }
        .radio_cocinero{
            visibility: <?php 
                            if($checkbox_cocinero=="<label>Cocinero</label>"){
                                echo "visible";
                            }else{
                                echo "hidden";
                            }
                        ?>
        }
        .radio_barman{
            visibility: <?php 
                            if($checkbox_barman=="<label>Barman</label>"){
                                echo "visible";
                            }else{
                                echo "hidden";
                            }
                        ?>
        }
        .radio_administrador{
            visibility: <?php 
                            if($checkbox_administrador=="<label>Administrador</label>"){
                                echo "visible";
                            }else{
                                echo "hidden";
                            }
                        ?>
        }
        #contraseña_input, #div_contraseña{
            display: none;
        }
        #genera_contraseña{
            display: inline-block;
            margin-left: 1vw;
            background-color: #394949;
            padding: 0.5vw;
            color: white;
        }
    </style>
    <script src="././Js/jquery-3.5.1.min.js"></script>
    <script>
        var contraseña_generada="Tr"+<?php 
        echo $datoActual->dni[7];
        echo $datoActual->dni[6];
        echo $datoActual->dni[5];
        echo $datoActual->dni[4];
        echo $datoActual->dni[3];
        echo $datoActual->dni[2];
        echo $datoActual->dni[1];
        ?>;
        $(document).ready(function(){
            var administrador=false;
            var camarero=false;
            var barman=false;
            var cocinero=false;
            var contraseña=false;
            /**
             * hacer visible con checbox accionado los radiobbuton
             */
            $(".click_administrador").click(function(){
                administrador=!administrador;
                if(administrador){
                    $(".radio_administrador").css("visibility", "visible")
                    
                }else{
                    $(".radio_administrador").css("visibility", "hidden")
                }
            });
            $(".click_camarero").click(function(){
                camarero=!camarero;
                if(camarero){
                    $(".radio_camarero").css("visibility", "visible")
                    
                }else{
                    $(".radio_camarero").css("visibility", "hidden") 
                }
            });
            $(".click_barman").click(function(){
                barman=!barman;
                if(barman){
                    $(".radio_barman").css("visibility", "visible")
                    
                }else{
                    $(".radio_barman").css("visibility", "hidden")
                }
            });
            $(".click_cocinero").click(function(){
                cocinero=!cocinero;
                if(cocinero){
                    $(".radio_cocinero").css("visibility", "visible")
                    
                }else{
                    $(".radio_cocinero").css("visibility", "hidden")
                }
                
            });
            /**
             * mostrar ocultar contraseña_input
             */
            $("#contraseña_label").click(function(){
                contraseña=!contraseña;
                if(contraseña){
                    $("#contraseña_input").css("display", "block")
                    $("#div_contraseña").css("display", "block")
                    
                }else{
                    $("#contraseña_input").css("display", "none")
                    $("#div_contraseña").css("display", "none")
                    $("#contraseña_input").val("");
                }
                
            });
            var mostrar_contraseña =true;
            $('#mostrar').click(function(){
                if(mostrar_contraseña)
                {
                    $('#contraseña_input').attr('type','text');
                    $('.mensaje').html("Ocultar contraseña");
                    mostrar_contraseña=!mostrar_contraseña;
                }else{
                    $('#contraseña_input').attr('type','password'); 
                    $('.mensaje').html("Mostrar contraseña");
                    mostrar_contraseña=!mostrar_contraseña;
                }
            });
            $("#genera_contraseña").click(function(){
                $("#contraseña_input").val(contraseña_generada);
            })
        });
    </script>
</head>        
<body>
     
    <header>
        <div class="logo">
            <?php echo $_SESSION["login"]["logo"] ?>
        </div>
        <div class="central">
            <h1>Editar trabajador</h1>
        </div>
        <div class="desconeccion">
            <?php echo $_SESSION["login"]["usuarioAcceso"].$_SESSION["login"]["logout"];?> 
        </div>
    </header>

    <nav>
        <form action="./index.php" method="post">
            <input class="butoom_nav" type="submit" value="Volver Trabajadores" name="administrador[trabajadores]">
            <input class="butoom_nav" type="submit" value="Volver Administrador" name="administrador">
        </form>
    </nav>

    <div class="contenedor"> <!--contenedor de section y aside-->

        <section> <!--contenido-->

            <article class="article_crear">
                <form action="./index.php" method="post" class="form_crear" id="editar" enctype="multipart/form-data">
                    <fieldset class="formulario">
                        
                        <legend>Usuario <?php echo $datoActual->usuario; ?></legend>
                        <label>DNI: <strong><?php echo $datoActual->dni; ?></strong></label>
                        <label for="nombre">Nombres:</label>
                        <input type="text" name="administrador[trabajadores][editar][datos][nombre]" id="nombre" value="<?php echo $datoActual->nombre; ?>"  maxlength="20" title="Requerido Maximo 20 caracteres" >
                        <label for="apellido">Apellidos:</label>
                        <input type="text" name="administrador[trabajadores][editar][datos][apellido]" id="apellido" value="<?php echo $datoActual->apellido; ?>" maxlength="20" title="Requerido Maximo 20 caracteres">
                        <label id="contraseña_label" for="contraseña">Contraseña:</label>
                        <input id="contraseña_input" type="password" name="administrador[trabajadores][editar][datos][contraseña]" id="contraseña" title="entre 8 y 16 caracteres al menos una letra Mayuscula una miniscula y un numero"  maxlength="16" minlength="8" pattern="^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$" >
                        <div id="div_contraseña">
                            <!-- (?=.*[0-1])(?=.*[a-z])(?=.*[A-Z]).{8} -->
                            <input class="mostrar" type="checkbox"  name="mostrar" id="mostrar" value="mostrar" />
                            <label class="mensaje" for="mostrar">Mostrar contraseña</label>
                            <div id="genera_contraseña" title="Tr + 7 ultimos numeros del dni empezando desde el final">genera contraseña</div>
                        </div>
                    </fieldset>  

                    <fieldset class="formulario">
                    <legend>Foto</legend>
                        <div class="foto_editar">
                            <label for="foto"><img id="foto_editar" src=<?php echo $fotoActual; ?> alt="foto trabajador"></label>
                        </div>
                        <label for="foto">Foto:</label>
                        <input type="file" name="foto" id="foto" accept="image/jpeg">

                    </fieldset>
                    <fieldset class="formulario">
                        <legend>Asignar categoria</legend>
                        <div class="form_checkbox_edita">
                            <!-- camarero -->
                            <?php echo $checkbox_camarero ?>

                            <label class="radio_camarero" for="camarero_activado">Activado</label>
                            <input class="radio_camarero" type="radio" name="administrador[trabajadores][editar][datos][camarero][estado]" id="camarero_activado" value="1" 
                            <?php 
                                if($checkbox_camarero=="<label>Camarero</label>"){
                                    if ($datoActual_camarero->estado) {
                                       echo "checked"; 
                                    }
                                }else{
                                    echo "checked";
                                }
                            ?> />
                            
                            
                            <label class="radio_camarero" for="camarero_desactivado">Desactivado</label>
                            <input class="radio_camarero" type="radio" name="administrador[trabajadores][editar][datos][camarero][estado]" id="camarero_desactivado" value="0" 
                            <?php 
                                if($checkbox_camarero=="<label>Camarero</label>"){
                                    if (!$datoActual_camarero->estado) {
                                      echo "checked";  
                                    }
                                }
                            ?> />
                            

                        </div>
                        <div class="form_checkbox_edita">
                            <!-- cocinero -->
                            <?php echo $checkbox_cocinero ?>

                            <label class="radio_cocinero" for="cocinero_activado">Activado</label>
                            <input class="radio_cocinero" type="radio" name="administrador[trabajadores][editar][datos][cocinero][estado]" id="cocinero_activado" value="1" 
                            <?php 
                                if($checkbox_cocinero=="<label>Cocinero</label>"){
                                    if ($datoActual_cocinero->estado) {
                                        echo "checked";
                                    }
                                }else{
                                    echo "checked";
                                }
                            ?> />
                            
                            <label class="radio_cocinero" for="cocinero_desactivado">Desactivado</label>
                            <input class="radio_cocinero" type="radio" name="administrador[trabajadores][editar][datos][cocinero][estado]" id="cocinero_desactivado" value="0" 
                            <?php 
                                if($checkbox_cocinero=="<label>Cocinero</label>"){
                                    if (!$datoActual_cocinero->estado) {
                                      echo "checked";  
                                    }
                                }
                            ?> />

                        </div>
                        <div class="form_checkbox_edita">
                            <!-- barman -->
                            <?php echo $checkbox_barman ?>

                            <label class="radio_barman" for="barman_activado">Activado</label>
                            <input class="radio_barman" type="radio" name="administrador[trabajadores][editar][datos][barman][estado]" id="barman_activado" value="1" 
                            <?php 
                                if($checkbox_barman=="<label>Barman</label>"){
                                    if ($datoActual_barman->estado) {
                                        echo "checked";
                                    }
                                }else{
                                    echo "checked";
                                }
                            ?> />
                            
                            <label class="radio_barman" for="barman_desactivado">Desactivado</label>
                            <input class="radio_barman" type="radio" name="administrador[trabajadores][editar][datos][barman][estado]" id="barman_desactivado" value="0" 
                            <?php 
                                if($checkbox_barman=="<label>Barman</label>"){
                                    if (!$datoActual_barman->estado) {
                                       echo "checked"; 
                                    }
                                }
                            ?> />
                            

                        </div>
                        <div class="form_checkbox_edita">
                            <!-- administrador -->
                            <?php echo $checkbox_administrador ?>

                            <label class="radio_administrador" for="administrador_activado">Activado</label>
                            <input class="radio_administrador" type="radio" name="administrador[trabajadores][editar][datos][administrador][estado]" id="administrador_activado" value="1" 
                            <?php 
                                if($checkbox_administrador=="<label>Administrador</label>"){
                                    if ($datoActual_administrador->estado) {
                                        echo "checked";
                                    }
                                }else{
                                    echo "checked";
                                }
                            ?> />
                            
                            <label class="radio_administrador" for="administrador_desactivado">Desactivado</label>
                            <input class="radio_administrador" type="radio" name="administrador[trabajadores][editar][datos][administrador][estado]" id="administrador_desactivado" value="0" 
                            <?php 
                                if($checkbox_administrador=="<label>Administrador</label>"){
                                    if (!$datoActual_administrador->estado) {
                                        echo "checked";
                                    }
                                }
                            ?> />
                            

                        </div>

                        <input class="crear_doble" type="submit" name="administrador[trabajadores][editar][submit]" value="Modificar">
                        <input type="hidden" name="administrador[trabajadores][editar][dni]" value="<?php echo $dni;?>">
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