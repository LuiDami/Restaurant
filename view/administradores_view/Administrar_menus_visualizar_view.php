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
    <title>Visualizar menu</title>
    <link rel="stylesheet" href="./Style/style.css">
    <link rel="stylesheet" href="./Style/style_administradores.css">
    <style>
        .mostrar_contenido{
             height: 30%; 
        }
        #radio_menu input{
            width: 100%;
            margin-top: 0.5vw;
        }
        #radio_menu{
            margin-top: 1.5vw;
            
        }
        .crea_menu{
            width: 20%;
        }
        .crea_menu_contenido{
            overflow-x: hidden;
        }
        .article_crear{
            display: flex;
            justify-content: end;
        }
        #menu{
            display: flex;
            justify-content: space-around;
            width: 100%;
        }

        table{
            padding 0.1vw;
            font-size: 150%;
            text-align: start;
        }
        th, td, tr{
            padding: 0.2vw;
            border:none;
        }
        .crear_doble{
            text-align: center;
            font-size: 150%;
        }
        #crear_menu_submit input {
            width: 100%;
        }
        input[type=checkbox] {
            transform: scale(1.5);
        }
        #radio_menu, #modificar, #descripcion{
            margin-top: 0;
            margin-bottom: 2vw;
        }
        #divmodificar{
            margin-top: 2vw;
        }
        
    </style>
    <script src="././Js/jquery-3.5.1.min.js"></script>
    <script>
        //$(document).ready(function(){
            var tablaMostrar=' <div id="menu"><div class="crea_menu" id="primero"><div class="crea_menu_titulo"><h3>Primeros</h3></div><div class="crea_menu_contenido"><table><tr><th>id</th><th>nombre</th><th></th></tr></table></div></div><div class="crea_menu" id="segundo"><div class="crea_menu_titulo"><h3>Segundos</h3></div><div class="crea_menu_contenido"><table><tr><th>id</th><th>nombre</th><th></th></tr></table></div></div><div class="crea_menu" id="postre"><div class="crea_menu_titulo"><h3>Postres</h3></div><div class="crea_menu_contenido"><table><tr><th>id</th><th>nombre</th><th></th></tr></table></div></div><div class="crea_menu" id="bebida"><div class="crea_menu_titulo"><h3>Bebidas</h3></div><div class="crea_menu_contenido"><table><tr><th>id</th><th>nombre</th><th></th></tr></table></div></div></div>'


            function eliminar_plato(id_plato, id_menu){
                $.ajax({
                    url: "controller/administradores_controller/Administradores_menus_ajax_controller.php",
                    type: "POST",
                    asynt: true,
                    dataType: "",
                    data: {
                        /**
                         * aqui va los $_POST
                         */
                        id_plato:id_plato,
                        id_menu:id_menu
                    },
                    
                    beforeSend: function (){
                        /**
                         * mientras recibe la respuesta
                         */
                        //$(".mostrar_contenido").html(tablaMostrar)
                    },
                    success: function (response) {
                        /**
                         * si todo va bien
                         */
                        $(".mostrar_contenido").html(response)
                    },
                    error: function(error) {
                        /**
                         * si ha dado algun error
                         */
                        console.log("da un error");
                        console.log(error);
                        $(".mostrar_contenido").html("da un error")
                    }
                });
            }
            function eliminar_bebida(id_bebida, id_menu){
                $.ajax({
                    url: "controller/administradores_controller/Administradores_menus_ajax_controller.php",
                    type: "POST",
                    asynt: true,
                    dataType: "",
                    data: {
                        /**
                         * aqui va los $_POST
                         */
                        id_bebida:id_bebida,
                        id_menu:id_menu
                    },
                    
                    beforeSend: function (){
                        /**
                         * mientras recibe la respuesta
                         */
                        //$(".mostrar_contenido").html(tablaMostrar)
                    },
                    success: function (response) {
                        /**
                         * si todo va bien
                         */
                        $(".mostrar_contenido").html(response)
                    },
                    error: function(error) {
                        /**
                         * si ha dado algun error
                         */
                        console.log("da un error");
                        console.log(error);
                        $(".mostrar_contenido").html("da un error")
                    }
                });
            }
            function mostrar_menu(id_menu){
                $.ajax({
                    url: "controller/administradores_controller/Administradores_menus_ajax_controller.php",
                    type: "POST",
                    asynt: true,
                    dataType: "",
                    data: {
                        /**
                         * aqui va los $_POST
                         */
                        id_menu:id_menu,
                        mostrar:"mostrar"
                    },
                    
                    beforeSend: function (){
                        /**
                         * mientras recibe la respuesta
                         */
                        //$(".mostrar_contenido").html(tablaMostrar)
                    },
                    success: function (response) {
                        /**
                         * si todo va bien
                         */
                        $(".mostrar_contenido").html(response)
                    },
                    error: function(error) {
                        /**
                         * si ha dado algun error
                         */
                        console.log("da un error");
                        console.log(error);
                        $(".mostrar_contenido").html("da un error")
                    }
                });
            }

            function ampliar_menu(id_menu){
                $.ajax({
                    url: "controller/administradores_controller/Administradores_menus_ajax_controller.php",
                    type: "POST",
                    asynt: true,
                    dataType: "",
                    data: {
                        /**
                         * aqui va los $_POST
                         */
                        id_menu:id_menu,
                        ampliar:"ampliar"
                    },
                    
                    beforeSend: function (){
                        /**
                         * mientras recibe la respuesta
                         */
                        // $(".mostrar_contenido").html(
                        //     "<p>procesando datos</p>"
                        // )
                    },
                    success: function (response) {
                        /**
                         * si todo va bien
                         */
                        $(".mostrar_contenido").html(response)
                    },
                    error: function(error) {
                        /**
                         * si ha dado algun error
                         */
                        console.log("da un error");
                        console.log(error);
                        $(".mostrar_contenido").html("da un error")
                    }
                });
            }

            function modificar_menu(id_menu){
                /**
                 * asignacion de valeroes de checbox_plato
                 */
                
                var checkbox_plato = [];
                $(":checkbox[name=plato]").each(function() {
                if (this.checked) {
                    // agregas cada elemento.
                    checkbox_plato.push($(this).val());
                }
                });

                /**
                 * asignacion de valeroes de checbox_bebida
                 */
                var checkbox_bebida = [];
                $(":checkbox[name=bebida]").each(function() {
                if (this.checked) {
                    // agregas cada elemento.
                    checkbox_bebida.push($(this).val());
                }
                });
                $.ajax({
                    url: "controller/administradores_controller/Administradores_menus_ajax_controller.php",
                    type: "POST",
                    asynt: true,
                    dataType: "",
                    data: {
                        /**
                         * aqui va los $_POST
                         */
                        id_menu:id_menu,
                        bebida:checkbox_bebida,
                        plato:checkbox_plato,
                        estado:$("input:radio[name=estado]:checked").val(),
                        descripcion:$("#descripcion").val(),
                        modificar:"modificar"
                    },
                    
                    beforeSend: function (){
                        /**
                         * mientras recibe la respuesta
                         */
                        //$(".mostrar_contenido").html(tablaMostrar)
                    },
                    success: function (response) {
                        /**
                         * si todo va bien
                         */
                        $(".mostrar_contenido").html(response)
                    },
                    error: function(error) {
                        /**
                         * si ha dado algun error
                         */
                        console.log("da un error");
                        console.log(error);
                        $(".mostrar_contenido").html("da un error")
                    }
                });
            }
                
        //});
    </script>
</head>        
<body>
     
    <header>
        <div class="logo">
            <?php echo $_SESSION["login"]["logo"] ?>
        </div>
        <div class="central">
            <h1>Visualizar menu</h1>
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
                <div class="div_butoom_visualizar" >
                    <button onclick='mostrar_menu(<?php echo $id_menu; ?>)' class="butoom_visualizar">Ver menu <p><?php echo $id_menu; ?></p></button>
                    <button onclick='ampliar_menu(<?php echo $id_menu; ?>)' class="butoom_visualizar">Ampliar</button>
                </div>
                <div class="mostrar_contenido">
                    <div id="menu">

                        <div class="crea_menu" id="primero">
                            <div class="crea_menu_titulo">
                                <h3>Primeros</h3>
                            </div>
                            <div class="crea_menu_contenido">
                                <table>
                                    <tr>
                                        <th>id</th>
                                        <th>nombre</th>
                                        <th></th>
                                    </tr>
                                    <?php
                                    $tuplas_primeros="";
                                    for($x=0;$x<count($primeros_array);$x++){
                                        $tuplas_primeros.= "<tr>"
                                        . "<td>".$primeros_array[$x]->id_plato."</td>"
                                        . "<td>".$primeros_array[$x]->nombre."</td>"   
                                        . "<td>"
                                        . "<button onclick='eliminar_plato(".$primeros_array[$x]->id_plato.", $id_menu)' class='button_eliminar'>Eliminar</button>"
                                        ."</td>"  
                                        . "</tr>";
                                    }
                                    echo $tuplas_primeros;
                                    ?>
                                </table>
                            </div>
                        </div>
                        <div class="crea_menu" id="segundo">
                            <div class="crea_menu_titulo">
                                <h3>Segundos</h3>
                            </div>
                            <div class="crea_menu_contenido">
                                <table>
                                    <tr>
                                        <th>id</th>
                                        <th>nombre</th>
                                        <th></th>
                                    </tr>
                                    <?php
                                    $tuplas_segundos="";
                                    for($x=0;$x<count($segundos_array);$x++){
                                        $tuplas_segundos.= "<tr>"
                                        . "<td>".$segundos_array[$x]->id_plato."</td>"
                                        . "<td>".$segundos_array[$x]->nombre."</td>"   
                                        . "<td>"
                                        . "<button onclick='eliminar_plato(".$segundos_array[$x]->id_plato.", $id_menu)' class='button_eliminar'>Eliminar</button>"
                                        ."</td>"  
                                        . "</tr>";
                                    }
                                    echo $tuplas_segundos;
                                    ?>
                                </table>
                            </div>
                        </div>
                        <div class="crea_menu" id="postre">
                            <div class="crea_menu_titulo">
                                <h3>Postres</h3>
                            </div>
                            <div class="crea_menu_contenido">
                                <table>
                                    <tr>
                                        <th>id</th>
                                        <th>nombre</th>
                                        <th></th>
                                    </tr>
                                    <?php
                                    $tuplas_postres="";
                                    for($x=0;$x<count($postres_array);$x++){
                                        $tuplas_postres.= "<tr>"
                                        . "<td>".$postres_array[$x]->id_plato."</td>"
                                        . "<td>".$postres_array[$x]->nombre."</td>"   
                                        . "<td>"
                                        . "<button onclick='eliminar_plato(".$postres_array[$x]->id_plato.", $id_menu)' class='button_eliminar'>Eliminar</button>"
                                        ."</td>"  
                                        . "</tr>";
                                    }
                                    echo $tuplas_postres;
                                    ?>
                                </table>
                            </div>
                        </div>
                        <div class="crea_menu" id="bebida">
                            <div class="crea_menu_titulo">
                                <h3>Bebidas</h3>
                            </div>
                            <div class="crea_menu_contenido">
                                <table>
                                    <tr>
                                        <th>id</th>
                                        <th>nombre</th>
                                        <th></th>
                                    </tr>
                                    <?php
                                    $tuplas_bebidas="";
                                    for($x=0;$x<count($bebidas_array);$x++){
                                        $tuplas_bebidas.= "<tr>"
                                        . "<td>".$bebidas_array[$x]->id_bebida."</td>"
                                        . "<td>".$bebidas_array[$x]->nombre."</td>"   
                                        . "<td>"
                                        . "<button onclick='eliminar_bebida(".$bebidas_array[$x]->id_bebida.", $id_menu)' class='button_eliminar'>Eliminar</button>"
                                        ."</td>"  
                                        . "</tr>";
                                    }
                                    echo $tuplas_bebidas;
                                    ?>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
                
                
                  
            </article>
        
        </section> <!--fin contenido-->

    </div> <!--fin contenedor section + aside-->

    


    <!--Javascrip-->
    <script>
    </script>
</body>
</html>