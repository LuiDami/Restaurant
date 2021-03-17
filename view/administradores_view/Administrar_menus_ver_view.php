<?php 
    if (!(isset($_POST["id_menu"]))) {
        header("Location: ../../index.php");
    }
?>
                
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


   

             