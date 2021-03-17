<?php 
    if (!(isset($_POST["id_menu"]))) {
        header("Location: ../../index.php");
    }
?>
<?php
    include_once '../../model/Menus_model.php';
    include_once '../../model/Menus_bebidas_model.php';
    include_once '../../model/Menus_platos_model.php';
    include_once '../../model/Bebidas_model.php';
    include_once '../../model/Platos_model.php';
    $menu = new Menus();
    $menu_plato = new MenusPlatos();
    $menu_bebida = new MenusBebidas();
    $bebida = new Bebidas();
    $plato = new Platos(); 
  
        
    /**
     * para tener disponible el id del menu */        
    $id_menu=$_POST["id_menu"];
    $datoActual=$menu->obtieneDeID($id_menu);

    /**
     * ver menu
     */
    if (isset($_POST["id_bebida"])||isset($_POST["id_plato"])||isset($_POST["mostrar"])) {
        if (isset($_POST["id_bebida"])) {
            $id_bebida=$_POST["id_bebida"];
            $menu_bebida->borrarBebidadeMenu($id_bebida, $id_menu);
        }
        if (isset($_POST["id_plato"])) {
            $id_plato=$_POST["id_plato"];
            $menu_plato->borrarPlatodeMenu($id_plato, $id_menu);
        }
        $primeros_array=$menu_plato->obtener_platosMenu_por_tipo($id_menu, "primero");
        $segundos_array=$menu_plato->obtener_platosMenu_por_tipo($id_menu, "segundo");
        $postres_array=$menu_plato->obtener_platosMenu_por_tipo($id_menu, "postre");
        $bebidas_array=$menu_bebida->obtener_bebidasMenu_por_tipo($id_menu);

        include_once '../../view/administradores_view/Administrar_menus_ver_view.php';
    }
    
        
    /**
     * ampliar menu
     */
    if(isset($_POST["ampliar"])){
        $menus_primeros = $plato->obtiene_primeros_menos_menu($id_menu);
        $menus_segundos = $plato->obtiene_segundos_menos_menu($id_menu);
        $menus_postres = $plato->obtiene_postres_menos_menu($id_menu);
        $menus_bebidas = $bebida->obtiene_bebidas_menu_menos_menu($id_menu);
        include_once '../../view/administradores_view/Administrar_menus_ampliar_view.php';
    }
    
    /**
     * ampliar menu despues de modificar
     */
    if (isset($_POST["modificar"])) {
            
        $estado=$_POST["estado"];
        $descripcion=$_POST["descripcion"];
        $menu->cambia_x_id($id_menu, "estado", $estado);
        if($descripcion!=""){
            $menu->cambia_x_id($id_menu, "descripcion", $descripcion);
        }
        
        
        if (isset($_POST["plato"])) {
            $platos_recibidos=$_POST["plato"];

            foreach ($platos_recibidos as $clave => $valor) {
                $menu_plato->id_plato=$valor;
                $menu_plato->id_menu=$id_menu;
                $menu_plato->crear();
            }

        }

        if (isset($_POST["bebida"])) {
            $bebidas_recibidas=$_POST["bebida"];

            foreach ($bebidas_recibidas as $clave => $valor) {
                $menu_bebida->id_bebida=$valor;
                $menu_bebida->id_menu=$id_menu;
                $menu_bebida->crear();
            }
            
        }
        $menus_primeros = $plato->obtiene_primeros_menos_menu($id_menu);
        $menus_segundos = $plato->obtiene_segundos_menos_menu($id_menu);
        $menus_postres = $plato->obtiene_postres_menos_menu($id_menu);
        $menus_bebidas = $bebida->obtiene_bebidas_menu_menos_menu($id_menu);
        $datoActual=$menu->obtieneDeID($id_menu);
        include_once '../../view/administradores_view/Administrar_menus_ampliar_view.php';
    }
            
            
    


?>













    

