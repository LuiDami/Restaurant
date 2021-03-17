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
        #radio_menu input{
            width: 100%;
            margin-top: 0.5vw;
        }
        #radio_menu{
            margin-top: 1.5vw;
        }
        .crea_menu_contenido{
            overflow-x: hidden;
        }
    </style>
</head>        
<body>
     
    <header>
        <div class="logo">
            <?php echo $_SESSION["login"]["logo"] ?>
        </div>
        <div class="central">
            <h1>Crear menu</h1>
        </div>
        <div class="desconeccion">
            <?php echo $_SESSION["login"]["usuarioAcceso"].$_SESSION["login"]["logout"];?> 
        </div>
    </header>

    <nav>
        <form action="./index.php" method="post">
            <input class="butoom_nav" type="submit" value="Volver menus" name="administrador[menus]">
            <input class="butoom_nav" type="submit" value="Volver Administrador" name="administrador">
        </form>
    </nav>

    <div class="contenedor"> <!--contenedor de section y aside-->

        <section> <!--contenido-->

            <article class="article_crear">
                <form action="./index.php" method="post" class="form_crear" id="crear">

                    <div class="crea_menu">
                        <div class="crea_menu_titulo">
                            <h3>Asignar primeros</h3>
                        </div>
                        <div class="crea_menu_contenido">
                            <table class="muestra_datos" id="tabla_datos">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombres</th>
                                    <th>Selección</th>
                                </tr>
                                <?php

                                $tuplas_primeros="";
                                for($x=0;$x<count($menus_primeros);$x++){
                                    $tuplas_primeros.= "<tr>"
                                    . "<td>".$menus_primeros[$x]->id_plato."</td>"
                                    . "<td>".$menus_primeros[$x]->nombre."</td>"   
                                    . "<td>"
                                    ."<input type='checkbox' value='".$menus_primeros[$x]->id_plato."' name='administrador[menus][crear][plato][".$menus_primeros[$x]->id_plato."]'>"
                                    ."</td>"    
                                    . "</tr>";
                                }
                                echo $tuplas_primeros;
                                ?>
                            </table>
                        </div>
                        
                    </div>

                    <div class="crea_menu">
                        <div class="crea_menu_titulo">
                            <h3>Asignar segundos</h3>
                        </div>
                        <div class="crea_menu_contenido">
                            <table class="muestra_datos" id="tabla_datos">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombres</th>
                                    <th>Selección</th>
                                </tr>
                                <?php

                                $tuplas_segundos="";
                                for($x=0;$x<count($menus_segundos);$x++){
                                    $tuplas_segundos.= "<tr>"
                                    . "<td>".$menus_segundos[$x]->id_plato."</td>"
                                    . "<td>".$menus_segundos[$x]->nombre."</td>"   
                                    . "<td>"
                                    ."<input type='checkbox' value='".$menus_segundos[$x]->id_plato."' name='administrador[menus][crear][plato][".$menus_segundos[$x]->id_plato."]'>"
                                    ."</td>"    
                                    . "</tr>";
                                }
                                echo $tuplas_segundos;
                                ?>
                            </table>
                        </div>
                        
                    </div>
                    <div class="crea_menu">
                        <div class="crea_menu_titulo">
                            <h3>Asignar postres</h3>
                        </div>
                        <div class="crea_menu_contenido">
                            <table class="muestra_datos" id="tabla_datos">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombres</th>
                                    <th>Selección</th>
                                </tr>
                                <?php

                                $tuplas_postres="";
                                for($x=0;$x<count($menus_postres);$x++){
                                    $tuplas_postres.= "<tr>"
                                    . "<td>".$menus_postres[$x]->id_plato."</td>"
                                    . "<td>".$menus_postres[$x]->nombre."</td>"   
                                    . "<td>"
                                    ."<input type='checkbox' value='".$menus_postres[$x]->id_plato."' name='administrador[menus][crear][plato][".$menus_postres[$x]->id_plato."]'>"
                                    ."</td>"    
                                    . "</tr>";
                                }
                                echo $tuplas_postres;
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="crea_menu">
                        <div class="crea_menu_titulo">
                            <h3>Asignar bebidas</h3>
                        </div>
                        <div class="crea_menu_contenido">
                            <table class="muestra_datos" id="tabla_datos">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombres</th>
                                    <th>Tipo</th>
                                    <th>Selección</th>
                                </tr>
                                <?php

                                $tuplas_bebidas="";
                                for($x=0;$x<count($menus_bebidas);$x++){
                                    $tuplas_bebidas.= "<tr>"
                                    . "<td>".$menus_bebidas[$x]->id_bebida."</td>"
                                    . "<td>".$menus_bebidas[$x]->nombre."</td>"   
                                    . "<td>".$menus_bebidas[$x]->tipo."</td>"   
                                    . "<td>"
                                    ."<input type='checkbox' value='".$menus_bebidas[$x]->id_bebida."' name='administrador[menus][crear][bebida][".$menus_bebidas[$x]->id_bebida."]'>"
                                    ."</td>"    
                                    . "</tr>";
                                }
                                echo $tuplas_bebidas;
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="crea_menu" id="crear_menu_submit">
                        <div class="crea_menu_titulo">
                            <h3>Crear</h3>
                        </div>
                        <div class="crea_menu_contenido" >
                            <label for="descripcion">Descripcion:</label>
                            <input class="crear_doble" type="text" name="administrador[menus][crear][descripcion]" id="descripcion" maxlength="20" title="Requerido Maximo 20 caracteres" required>  
                            
                            <div id="radio_menu">
                            <input type="radio" name="administrador[menus][crear][estado]" id="Activado" value="1" checked >
                            <label for="Activado">Activado:</label>
                            <input type="radio" name="administrador[menus][crear][estado]" id="desactivado" value="0">
                            <label for="desactivado">Desactivado:</label>
                            </div>

                            <input class="crear_doble" type="submit" name="administrador[menus][crear][submit]" value="Crear">
                        </div>
                    </div>
                    
                    
                    <!-- buscar donde poner el boton de crear         -->
                    <!-- <fieldset class="formulario">
                        <legend>Crear:</legend>
                       

                        
                    </fieldset> -->


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