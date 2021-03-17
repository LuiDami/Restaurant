<?php 
    if (!(isset($_POST["id_menu"]))) {
        header("Location: ../../index.php");
    }
?>
                
<div id="menu">

    <div class="crea_menu">
        <div class="crea_menu_titulo">
            <h3>Asignar primeros</h3>
        </div>
        <div class="crea_menu_contenido">
            <table class="muestra_datos" id="tabla_datos">
                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th></th>
                </tr>
                <?php

                $tuplas_primeros="";
                for($x=0;$x<count($menus_primeros);$x++){
                    $tuplas_primeros.= "<tr>"
                    . "<td>".$menus_primeros[$x]->id_plato."</td>"
                    . "<td><label for='plato".$menus_primeros[$x]->id_plato."'>".$menus_primeros[$x]->nombre."</label></td>"   
                    . "<td>"
                    ."<input type='checkbox' value='".$menus_primeros[$x]->id_plato."' name='plato'  id='plato".$menus_primeros[$x]->id_plato."'>"
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
                    <th></th>
                </tr>
                <?php

                $tuplas_segundos="";
                for($x=0;$x<count($menus_segundos);$x++){
                    $tuplas_segundos.= "<tr>"
                    . "<td>".$menus_segundos[$x]->id_plato."</td>"
                    . "<td><label for='plato".$menus_segundos[$x]->id_plato."'>".$menus_segundos[$x]->nombre."</label></td>"   
                    . "<td>"
                    ."<input type='checkbox' value='".$menus_segundos[$x]->id_plato."' name='plato'  id='plato".$menus_segundos[$x]->id_plato."'>"
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
                    <th></th>
                </tr>
                <?php

                $tuplas_postres="";
                for($x=0;$x<count($menus_postres);$x++){
                    $tuplas_postres.= "<tr>"
                    . "<td>".$menus_postres[$x]->id_plato."</td>"
                    . "<td><label for='plato".$menus_postres[$x]->id_plato."'>".$menus_postres[$x]->nombre."</label></td>"   
                    . "<td>"
                    ."<input type='checkbox' value='".$menus_postres[$x]->id_plato."' name='plato' id='plato".$menus_postres[$x]->id_plato."'>"
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
                    <th></th>
                </tr>
                <?php

                $tuplas_bebidas="";
                for($x=0;$x<count($menus_bebidas);$x++){
                    $tuplas_bebidas.= "<tr>"
                    . "<td>".$menus_bebidas[$x]->id_bebida."</td>"
                    . "<td title='".$menus_bebidas[$x]->tipo."'><label for='bebida".$menus_bebidas[$x]->id_bebida."'>".$menus_bebidas[$x]->nombre."</label></td>"   
                    . "<td>"
                    ."<input type='checkbox' value='".$menus_bebidas[$x]->id_bebida."' name='bebida' id='bebida".$menus_bebidas[$x]->id_bebida."'>"
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
            <h3>descripcion/estado</h3>
        </div>
        <div id="divmodificar" class="crea_menu_contenido" >
            <label for="descripcion">Descripcion:</label>
            <input class="crear_doble" type="text" name="editar[descripcion]" id="descripcion" maxlength="20" value="<?php echo $datoActual->descripcion ?>" title="Requerido Maximo 20 caracteres" required>  
            <p>estado</p>
            <div id="radio_menu">
                <input type="radio" name="estado" id="Activado" value="1" 
                <?php if($datoActual->estado){
                    echo "checked";
                } ?> >
                <label for="Activado">Activado:</label>
                <input type="radio" name="estado" id="desactivado" value="0" 
                <?php if(!$datoActual->estado){
                    echo "checked";
                } ?>>
                <label for="desactivado">Desactivado:</label>
            </div>
            <button onclick='modificar_menu(<?php echo $id_menu; ?>)' class='crear_doble' id="modificar">Modificar</button>
        </div>
    </div>

</div>


   
                    