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
    <title>Administrar Platos</title>
    <link rel="stylesheet" href="./Style/style.css">
    <link rel="stylesheet" href="./Style/style_administradores.css">
    <style>
        .form_checkbox{
            width: 20vw;
        }
        .filtar_datos{
            width: 25vw;
            height: 10vw;
        }
        #search{
            padding: 0.5vw;
            font-size: 1vw;
            width: 20vw;
        }
    </style>
    <script src="././Js/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(){
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
        })
    </script>
</head>        
<body>
     
    <header>
        <div class="logo">
            <?php echo $_SESSION["login"]["logo"] ?>
        </div>
        <div class="central">
          <h1>Administrar Platos</h1>  
        </div>
        <div class="desconeccion">
            <?php echo $_SESSION["login"]["usuarioAcceso"].$_SESSION["login"]["logout"];?> 
        </div>
    </header>

    <nav>
        <form action="./index.php" method="post">
            <input class="butoom_nav" type="submit" value="Volver" name="administrador">
            <input class="butoom_nav" type="submit" value="Nuevo Plato" name="administrador[platos][crear]">
        </form>
    </nav>

    <div class="contenedor"> <!--contenedor de section y aside-->

        <section> <!--contenido-->
            <article class="article_datos">
                <div class="div_datos">
                    <table class="muestra_datos" id="tabla_datos">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>descripcion</th>
                                <th>Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tuplas="";
                            for($x=0;$x<count($platos_array);$x++){
                                $tuplas.= "<tr>"
                                . "<td>".$platos_array[$x]->id_plato."</td>"
                                . "<td>".$platos_array[$x]->nombre."</td>" 
                                . "<td>".$platos_array[$x]->tipo."</td>" 
                                . "<td>".nombreEstado($platos_array[$x]->estado)."</td>"    
                                . "<td>".$platos_array[$x]->descripcion."</td>"    
                                . "<td>"
                                ."<form action='./index.php' method='post'>"
                                ."<input type='submit' value='Editar' name='administrador[platos][editar]'>"
                                ."<input type='hidden' value='".$platos_array[$x]->id_plato."' name='administrador[platos][editar][id]'>"
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
                        <input type="text" class="form-control pull-right" id="search" placeholder="Introduce criterios de busqueda">
                </div>
            </article>
        
        </section> <!--fin contenido-->

    </div> <!--fin contenedor section + aside-->


    <!--Javascrip-->
    <>
    </>
</body>
</html>