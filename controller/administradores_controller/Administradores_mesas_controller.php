<?php 
    if (!isset($_SESSION["login"])) {
        header("Location: ../../index.php");
    }
?>
<?php 
    include_once '././funciones_php/Funciones.php';
    include_once '././model/Mesas_model.php';
    $mesa= new Mesas();

    /**
     * esto sirve para cuando actualisemos la paguina no se nos duplique la creacion
     */
    if (isset($_POST["administrador"]["mesas"]["crear"])) {
        if($_POST["administrador"]["mesas"]["crear"]=="Nueva Mesa"){
        $_SESSION["login"]["crear"]=true;   
        }
    }

    if (isset($_POST["administrador"]["mesas"]["crear"])&&$_SESSION["login"]["crear"]) {
        /**
         * para crear mas mesas
         */
        $mensajeCreacion="";
        if (isset($_POST["administrador"]["mesas"]["crear"]["submit"])) {
            /**----------------------------------------------------------crear------------------------------------------
             * crea mesa
             */
            $mesa->ubicacionX=$_POST["administrador"]["mesas"]["crear"]["ubicacionX"];
            $mesa->ubicacionY=$_POST["administrador"]["mesas"]["crear"]["ubicacionY"];
            $mesa->crear();
            $mensajeCreacion="mesa con numero: $mesa->numero_mesa creada";

            /**
             * se coloc la session ["login"]["crear"] en false para que no se repita al actualizar
             * se hace consulta para mostar
             * al crearlo redirige a la vista principal de mesas
             */
            $_SESSION["login"]["crear"]=false; 
            $mesas_array = $mesa->obtieneTodos();
            include_once '././view/administradores_view/Administrar_mesas_view.php'; 
        } else {
            # code...
            include_once '././view/administradores_view/Administrar_mesas_crear_view.php'; 
        }
    } elseif (isset($_POST["administrador"]["mesas"]["editar"])) {
        /**------------------------------------------------------editar-----------------------------------------------------
         * para editar una mesa
         */

        $id=$_POST["administrador"]["mesas"]["editar"]["id"];

        if (isset($_POST["administrador"]["mesas"]["editar"]["submit"])) {
            /**
             * en el caso de que se de al boton de cambiar
            * obtenemos el array de datos por post
            * con for each cambiamos todos los tatos de entrada
            * excluyendo los que no tienen nada introducido
            */
            $datosCambio=$_POST["administrador"]["mesas"]["editar"]["datos"];
            if(is_array($datosCambio)){
                foreach ($datosCambio as $key => $value) {
                    if($value!=""){
                    $mesa->cambia_x_id($id, $key, $value);
                    }
                }
            }

            /**
             * creamos las variables necesarias para imprimir la vista
             * en el caso de que no tuviese foto se pondra la imagen por defecto
             */
            // $datoActual=$mesa->obtieneDeID($id);
            // include_once '././view/administradores_view/Administrar_mesas_editar_view.php'; 
            $_SESSION["login"]["crear"]=false; 
            $mesas_array = $mesa->obtieneTodos();
            include_once '././view/administradores_view/Administrar_mesas_view.php';
        }else{
            /**
             * aqui se llega cuando se biene desde la vista principal de mesas
             */
            $datoActual=$mesa->obtieneDeID($id);
            include_once '././view/administradores_view/Administrar_mesas_editar_view.php';
        }
    } else {
        /**----------------------------------------------------principal---------------------------------------------------
         * pagina principal de administrar mesas
         * se asegura que session este en false
         */
        $_SESSION["login"]["crear"]=false; 
        $mesas_array = $mesa->obtieneTodos();
        include_once '././view/administradores_view/Administrar_mesas_view.php';
    }


?>