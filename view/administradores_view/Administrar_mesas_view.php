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
    <title>Administrar mesas</title>
    <link rel="stylesheet" href="./Style/style.css">
    <link rel="stylesheet" href="./Style/style_administradores.css">
    <style>
    .article_datos {
        display: flex;
        justify-content: space-around;
        padding-top: 3vw;
    }
    
    </style>
</head>        
<body>
     
    <header>
        <div class="logo">
            <?php echo $_SESSION["login"]["logo"] ?>
        </div>
        <div class="central">
            <h1>Administrar mesas</h1>
        </div>
        <div   div class="desconeccion">
            <?php echo $_SESSION["login"]["usuarioAcceso"].$_SESSION["login"]["logout"];?> 
        </div>
    </header>

    <nav>
        <form action="./index.php" method="post">
            <input class="butoom_nav" type="submit" value="Volver" name="administrador">
            <input class="butoom_nav" type="submit" value="Nueva Mesa" name="administrador[mesas][crear]">
        </form>
    </nav>

    <div class="contenedor"> <!--contenedor de section y aside-->

        <section> <!--contenido-->  
            <article class="article_datos">
                <div class="div_datos">
                    <table class="muestra_datos" id="tabla_datos">
                        <tr>
                            <th>numero de mesa</th>
                            <th>Ubicacion vertical</th>
                            <th>Ubicacion horizontal</th>
                            <th>Editar</th>
                        </tr>
                        <?php
                        
                        $tuplas="";
                        for($x=0;$x<count($mesas_array);$x++){
                            //print_r($telefonosactuales);
                            $tuplas.= "<tr>"
                            . "<td>".$mesas_array[$x]->numero_mesa."</td>"
                            . "<td>".$mesas_array[$x]->ubicacionY."</td>"    
                            . "<td>".$mesas_array[$x]->ubicacionX."</td>" 
                            . "<td>"
                            ."<form action='./index.php' method='post'>"
                            ."<input type='submit' value='Editar' name='administrador[mesas][editar]'>"
                            ."<input type='hidden' value='".$mesas_array[$x]->numero_mesa."' name='administrador[mesas][editar][id]'>"
                            ."</form>"
                            ."</td>"  
                            . "</tr>";
                        }
                        
                        
                        echo $tuplas;
                        ?>
                    </table> 
                </div>    
                <div id="div_salon">
                    <?php echo arraySalon($mesas_array); ?>
                </div>
                
            </article>
        
        </section> <!--fin contenido-->

    </div> <!--fin contenedor section + aside-->


    <!--Javascrip-->
    <script>
    </script>
</body>
</html>