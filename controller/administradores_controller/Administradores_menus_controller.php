<?php 
    if (!isset($_SESSION["login"])) {
        header("Location: ../../index.php");
    }
?>
<?php 
    include_once '././model/Menus_model.php';
    include_once '././model/Menus_bebidas_model.php';
    include_once '././model/Menus_platos_model.php';
    include_once '././model/Bebidas_model.php';
    include_once '././model/Platos_model.php';
    $menu = new Menus();
    $menu_plato = new MenusPlatos();
    $menu_bebida = new MenusBebidas();
    $bebida = new Bebidas();
    $plato = new Platos();

    /**
     * esto sirve para cuando actualisemos la paguina no se nos duplique la creacion
     */
    if (isset($_POST["administrador"]["menus"]["crear"])) {
        if($_POST["administrador"]["menus"]["crear"]=="Nuevo Menu"){
        $_SESSION["login"]["crear"]=true;   
        }
    }

    if (isset($_POST["administrador"]["menus"]["crear"])&&$_SESSION["login"]["crear"]) {
        /**-------------------------------------------------crear menus-------------------------------------------------
         * para crear mas menus
         */
        $mensajeCreacion="";
        if (isset($_POST["administrador"]["menus"]["crear"]["submit"])) {
            /**
             * crea menu
             */
            // $menu->dato1=$_POST["administrador"]["menus"]["crear"][""];
            // $menu->dato2=$_POST["administrador"]["menus"]["crear"][""];
            //$menu->crear();
            // $mensajeCreacion="menu con numero: $menu->numero_mesa creada";
                
            $menu->estado=$_POST["administrador"]["menus"]["crear"]["estado"];
            $menu->descripcion=$_POST["administrador"]["menus"]["crear"]["descripcion"];
            $menu->crear();
            
            if (isset($_POST["administrador"]["menus"]["crear"]["plato"])) {
                $platos_recibidos=$_POST["administrador"]["menus"]["crear"]["plato"];

                foreach ($platos_recibidos as $clave => $valor) {
                    $menu_plato->id_plato=$valor;
                    $menu_plato->id_menu=$menu->id_menu;
                    $menu_plato->crear();
                }

            }

            if (isset($_POST["administrador"]["menus"]["crear"]["bebida"])) {
                $bebidas_recibidas=$_POST["administrador"]["menus"]["crear"]["bebida"];

                foreach ($bebidas_recibidas as $clave => $valor) {
                    $menu_bebida->id_bebida=$valor;
                    $menu_bebida->id_menu=$menu->id_menu;
                    $menu_bebida->crear();
                }
                
            }
            
            //include_once '././view/administradores_view/Administrar_menus_crear_view.php'; 
            /**
             * se coloc la session ["login"]["crear"] en false para que no se repita al actualizar
             * se hace consulta para mostar
             * al crearlo redirige a la vista principal de menus
             */
            $_SESSION["login"]["crear"]=false; 
            $menus_array = $menu->obtieneTodos();
            include_once '././view/administradores_view/Administrar_menus_view.php'; 
            // cambiar para mandar a vista menus
        } else {
            /**
             * nos muestra las tablas con los productos disponibles para crear un menu
             */
            $menus_primeros = $plato->obtiene_primeros();
            $menus_segundos = $plato->obtiene_segundos();
            $menus_postres = $plato->obtiene_postres();
            $menus_bebidas = $bebida->obtiene_bebidas_menu();
            include_once '././view/administradores_view/Administrar_menus_crear_view.php'; 
        }
    } elseif (isset($_POST["administrador"]["menus"]["visualizar"])) {
        /**--------------------------------------------------visualizar-------------------------------------------
         * para visualizar un menu
         */
        
        $id_menu=$_POST["administrador"]["menus"]["visualizar"]["id"];
        $primeros_array=$menu_plato->obtener_platosMenu_por_tipo($id_menu, "primero");
        $segundos_array=$menu_plato->obtener_platosMenu_por_tipo($id_menu, "segundo");
        $postres_array=$menu_plato->obtener_platosMenu_por_tipo($id_menu, "postre");
        $bebidas_array=$menu_bebida->obtener_bebidasMenu_por_tipo($id_menu);

        include_once '././view/administradores_view/Administrar_menus_visualizar_view.php'; 
    } else{
        /**-----------------------------------------------pagina principal---------------------------------------------
         * pagina principal de administrar menus
         * se asegura que session este en false
         */
        $_SESSION["login"]["crear"]=false; 
        $menus_array = $menu->obtieneTodos();
        include_once '././view/administradores_view/Administrar_menus_view.php';
    }


?>