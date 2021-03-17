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
    <title>Crear trabajador</title>
    <link rel="stylesheet" href="./Style/style.css">
    <link rel="stylesheet" href="./Style/style_administradores.css">
    <style>
        .radio_camarero, .radio_cocinero, .radio_barman, .radio_administrador{
            visibility: hidden;
        }
        #dni_erroneo{
            color: red;
            font-size: 80%;
        }
    </style>
    <script src="././Js/funciones.js"></script>
    <script src="././Js/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(){
            var administrador=false;
            var camarero=false;
            var barman=false;
            var cocinero=false;
            
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
             * controlamos que el formulario no se envie si no cumple condiciones de funcion js
             */
            $("#enviar").click(function(e){
                var dni = $("#dni").val();
                if (!(compruebaDNI(dni)||compruebaNIE(dni))) {
                    /**
                     * con esto decimos que quitemos el submit yq que no se ha cumplido
                     */
                    e.preventDefault();
                    $("#dni_erroneo").text(" el DNI o NIE es incorrecto");
                }else{
                    $("#dni_erroneo").text("");
                } 
            });
            
        });
    </script>
</head>        
<body>
     
    <header>
        <div class="logo">
            <?php echo $_SESSION["login"]["logo"] ?>
        </div>
        <div class="central">
            <h1>Crear trabajador</h1>
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
                <!--  -->
                <form action="./index.php" method="post" class="form_crear" id="crear" enctype="multipart/form-data">
                    <fieldset class="formulario">
                        <legend>Datos trabajador</legend>
                        <label for="dni">DNI:<span id="dni_erroneo" ></span></label>
                        <input type="text" name="administrador[trabajadores][crear][dni]" id="dni" title="Requerido 8 caracteres formato DNI o NIE sin guiones en mayusculas" maxlength="9" pattern="[Y|W|Z]{1}[0-9]{7}[A-Z]{1}|[0-9]{8}[A-Z]{1}"  required>
                        <label for="nombre">Nombres:</label>
                        <input type="text" name="administrador[trabajadores][crear][nombre]" id="nombre" maxlength="20" title="Requerido Maximo 20 caracteres" required>
                        <label for="apellido">Apellidos:</label>
                        <input type="text" name="administrador[trabajadores][crear][apellido]" id="apellido" maxlength="20" title="Requerido Maximo 20 caracteres" required>
                        <label for="usuario">Usuario:</label>
                        <input type="text" name="administrador[trabajadores][crear][usuario]" id="usuario" minlength="4" maxlength="20" title="Requerido Minimo 4 y Maximo 20 caracteres alfanumericos" pattern="^[a-zA-Z0-9]{4,10}$" required>
                        <label for="contraseña">Contraseña:</label>
                        <input type="text" name="administrador[trabajadores][crear][contraseña]" id="contraseña"  title="8 caracteres al menos una letra Mayuscula una miniscula y un numero" maxlength="8" minlength="8" pattern="(?=.*[0-1])(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                        <label for="foto">Foto:</label>
                        <input type="file" name="foto" id="foto" accept="image/jpeg">
                    </fieldset>

                    <fieldset class="formulario">
                        
                        <legend>Asignar categoria</legend>
                        <div class="form_checkbox">
                            <!-- camarero -->
                            <input class="click_camarero" type="checkbox"  name="administrador[trabajadores][crear][categoria][camarero]" id="camarero" value="camarero" title="Permite asignar al trabajador como camarero" />
                            <label for="camarero">Camarero</label>

                            <input class="radio_camarero" type="radio" name="administrador[trabajadores][crear][camarero][estado]" id="camarero_activado" value="1" checked />
                            <label class="radio_camarero" for="camarero_activado">Activado</label>

                            <input class="radio_camarero" type="radio" name="administrador[trabajadores][crear][camarero][estado]" id="camarero_desactivado" value="0" />
                            <label class="radio_camarero" for="camarero_desactivado">Desactivado</label>

                        </div>
                        <div class="form_checkbox">
                            <!-- cocinero -->
                            <input class="click_cocinero" type="checkbox"  name="administrador[trabajadores][crear][categoria][cocinero]" id="cocinero" value="cocinero" title="Permite asignar al trabajador como cocinero" />
                            <label for="cocinero">Cocinero</label>

                            <input class="radio_cocinero" type="radio" name="administrador[trabajadores][crear][cocinero][estado]" id="cocinero_activado" value="1" checked />
                            <label class="radio_cocinero" for="cocinero_activado">Activado</label>

                            <input class="radio_cocinero" type="radio" name="administrador[trabajadores][crear][cocinero][estado]" id="cocinero_desactivado" value="0" />
                            <label class="radio_cocinero" for="cocinero_desactivado">Desactivado</label>

                        </div>
                        <div class="form_checkbox">
                            <!-- barman -->
                            <input class="click_barman" type="checkbox"  name="administrador[trabajadores][crear][categoria][barman]" id="barman" value="barman" title="Permite asignar al trabajador como barman" />
                            <label for="barman">Barman</label>

                            <input class="radio_barman" type="radio" name="administrador[trabajadores][crear][barman][estado]" id="barman_activado" value="1" checked />
                            <label class="radio_barman" for="barman_activado">Activado</label>

                            <input class="radio_barman" type="radio" name="administrador[trabajadores][crear][barman][estado]" id="barman_desactivado" value="0" />
                            <label class="radio_barman" for="barman_desactivado">Desactivado</label>

                        </div>
                        <div class="form_checkbox">
                            <!-- administrador -->
                            <input class="click_administrador" type="checkbox"  name="administrador[trabajadores][crear][categoria][administrador]" id="administrador" value="administrador" title="Permite asignar al trabajador como administrador" />
                            <label for="administrador">Administrador</label>

                            
                            <input class="radio_administrador" type="radio" name="administrador[trabajadores][crear][administrador][estado]" id="administrador_activado" value="1" checked />
                            <label class="radio_administrador" for="administrador_activado">Activado</label>

                            <input class="radio_administrador" type="radio" name="administrador[trabajadores][crear][administrador][estado]" id="administrador_desactivado" value="0" />
                            <label class="radio_administrador" for="administrador_desactivado">Desactivado</label>

                        </div>

                        <input class="crear_doble" type="submit" name="administrador[trabajadores][crear][submit]" value="Crear" id="enviar">
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