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
    <title>Administrar trabajadores</title>
    <link rel="stylesheet" href="./Style/style.css">
    <link rel="stylesheet" href="./Style/style_administradores.css">
    <style>
        #search{
            padding: 0.5vw;
            font-size: 0.8vw;
            width: 14vw;
        }
    </style>
    <script src="././Js/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(){
            
            $(".submit").click(function(){

                /**
                 * asignacion de valeroes de checbox
                 */
                // var checkbox = [];
                // $(":checkbox[name=categoria]").each(function() {
                // if (this.checked) {
                //     // agregas cada elemento.
                //     checkbox.push($(this).val());
                // }
                // });
                
                /**
                 * asignacion de valores de input radio
                 */
                var categoria=$("input:radio[name=categoria]:checked").val();
                var todos_estado=$("input:radio[name=todos_estado]:checked").val();
                var administrador_estado=$("input:radio[name=administrador_estado]:checked").val();
                var cocinero_estado=$("input:radio[name=cocinero_estado]:checked").val();
                var camarero_estado=$("input:radio[name=camarero_estado]:checked").val();
                var barman_estado=$("input:radio[name=barman_estado]:checked").val();
                
                $.ajax({
                    url: "controller/administradores_controller/Administradores_trabajadores_ajax_controller.php",
                    type: "POST",
                    asynt: true,
                    dataType: "",
                    data: {
                        /**
                         * aqui va los $_POST
                         */
                        categoria:categoria,
                        todos_estado:todos_estado,
                        administrador_estado:administrador_estado,
                        cocinero_estado:cocinero_estado,
                        camarero_estado:camarero_estado,
                        barman_estado:barman_estado
                    },
                    
                    beforeSend: function (){
                        /**
                         * mientras recibe la respuesta
                         */
                        $("#tabla_datos").html(
                            "<tr>"+
                                "<th>Dni</th>"+
                                "<th>Nombres</th>"+
                                "<th>Apellidos</th>"+
                                "<th>Editar</th>"+
                            "</tr>"+
                            "<tr>"+
                            "<td>Procesando datos</td>"+
                            "<td>Procesando datos</td>"+
                            "<td>Procesando datos</td>"+
                            "<td>Procesando datos</td>"+
                            "</tr>"
                        )
                    },
                    success: function (response) {
                        /**
                         * si todo va bien
                         */
                        $("#tabla_datos").html(response)
                    },
                    error: function(error) {
                        /**
                         * si ha dado algun error
                         */
                        console.log("da un error");
                        console.log(error);
                        $("#tabla_datos").html("da un error")
                    }
                });

            });

            /**para busqueda por input */
            $("#search").keyup(function(){
                _this = this;
                $.each($("#tabla_datos tbody tr"), function() {
                    if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1){
                        $(this).hide();
                    }else{
                        $(this).show();
                    }
                });
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
            <h1>Administrar trabajadores</h1>
        </div>
        <div class="desconeccion">
            <?php echo $_SESSION["login"]["usuarioAcceso"].$_SESSION["login"]["logout"];?> 
        </div>
    </header>

    <nav>
        <form action="./index.php" method="post">
            <input class="butoom_nav" type="submit" value="Volver" name="administrador">
            <input class="butoom_nav" type="submit" value="Nuevo Trabajador" name="administrador[trabajadores][crear]">
        </form>
    </nav>

    <div class="contenedor"> <!--contenedor de section y aside-->

        <section> <!--contenido-->
            <article class="article_datos">
                <div class="div_datos">
                    <table class="muestra_datos" id="tabla_datos">
                    <thead>
                        <tr>
                            <th>Dni</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        $tuplas="";
                        for($x=0;$x<count($trabajadores_array);$x++){
                            $tuplas.= "<tr>"
                            . "<td>".$trabajadores_array[$x]->dni."</td>"
                            . "<td>".$trabajadores_array[$x]->nombre."</td>" 
                            . "<td>".$trabajadores_array[$x]->apellido."</td>"   
                            . "<td>"
                            ."<form action='./index.php' method='post'>"
                            ."<input type='submit' value='Editar' name='administrador[trabajadores][editar]'>"
                            ."<input type='hidden' value='".$trabajadores_array[$x]->dni."' name='administrador[trabajadores][editar][dni]'>"
                            ."</form>"
                            ."</td>"    
                            . "</tr>";
                        }
                        echo $tuplas;
                        ?>
                    </tbody>
                    </table>
                </div>
                
                <div class="filtar_datos">
                    <p>filtar datos</p>

                    <div class="form_checkbox" id="form_checkbox_todos">
                        <!-- todos -->
                        <input class="submit" type="radio"  name="categoria" id="todos" value="todos" checked />
                        <label for="todos">Todos los trabajadores</label>
                        <input type="text" class="form-control pull-right" id="search" placeholder="Introduce criterios de busqueda">
                    </div>

                    <div class="form_checkbox">
                            <!-- camarero -->
                            <input class="submit" type="radio"  name="categoria" id="camarero" value="camarero"  />
                            <label for="camarero">Camarero</label>

                            <input class="submit" type="radio" name="camarero_estado" id="camarero_todo" value="todo" checked />
                            <label for="camarero_todo">Todos</label>

                            <input class="submit" type="radio" name="camarero_estado" id="camarero_activado" value="1" />
                            <label for="camarero_activado">Activado</label>

                            <input class="submit" type="radio" name="camarero_estado" id="camarero_desactivado" value="0" />
                            <label for="camarero_desactivado">Desactivado</label>

                        </div>
                        <div class="form_checkbox">
                            <!-- cocinero -->
                            <input class="submit" type="radio"  name="categoria" id="cocinero" value="cocinero"  />
                            <label for="cocinero">Cocinero</label>

                            <input class="submit" type="radio" name="cocinero_estado" id="cocinero_todo" value="todo" checked />
                            <label for="cocinero_todo">Todos</label>

                            <input class="submit" type="radio" name="cocinero_estado" id="cocinero_activado" value="1" />
                            <label for="cocinero_activado">Activado</label>

                            <input class="submit" type="radio" name="cocinero_estado" id="cocinero_desactivado" value="0" />
                            <label for="cocinero_desactivado">Desactivado</label>

                        </div>
                        <div class="form_checkbox">
                            <!-- barman -->
                            <input class="submit" type="radio"  name="categoria" id="barman" value="barman"  />
                            <label for="barman">Barman</label>

                            <input class="submit" type="radio" name="barman_estado" id="barman_todo" value="todo" checked />
                            <label for="barman_todo">Todo</label>

                            <input class="submit" type="radio" name="barman_estado" id="barman_activado" value="1" />
                            <label for="barman_activado">Activado</label>

                            <input class="submit" type="radio" name="barman_estado" id="barman_desactivado" value="0" />
                            <label for="barman_desactivado">Desactivado</label>

                        </div>
                        <div class="form_checkbox">
                            <!-- administrador -->
                            <input class="submit" type="radio"  name="categoria" id="administrador" value="administrador"  />
                            <label for="administrador">Administrador</label>

                            <input class="submit" type="radio" name="administrador_estado" id="administrador_todo" value="todo" checked />
                            <label for="administrador_todo">Todo</label>

                            <input class="submit" type="radio" name="administrador_estado" id="administrador_activado" value="1" />
                            <label for="administrador_activado">Activado</label>

                            <input class="submit" type="radio" name="administrador_estado" id="administrador_desactivado" value="0" />
                            <label for="administrador_desactivado">Desactivado</label>

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