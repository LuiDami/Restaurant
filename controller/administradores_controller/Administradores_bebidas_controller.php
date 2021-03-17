<?php 
    if (!isset($_SESSION["login"])) {
        header("Location: ../../index.php");
    }
?>
<?php 

    include_once '././model/Bebidas_model.php';
    $bebida= new Bebidas();

    /**
     * esto sirve para cuando actualisemos la paguina no se nos duplique la creacion
     */
    if (isset($_POST["administrador"]["bebidas"]["crear"])) {
        if($_POST["administrador"]["bebidas"]["crear"]=="Nueva Bebida"){
        $_SESSION["login"]["crear"]=true;   
        }
    }

    if (isset($_POST["administrador"]["bebidas"]["crear"])&&$_SESSION["login"]["crear"]) {
        /**----------------------------------------------------------crear------------------------------------------
         * para crear mas bebidas
         * envia a Administrar_bebidas_crear_view
         */
        $mensajeCreacion="";
        if (isset($_POST["administrador"]["bebidas"]["crear"]["submit"])) {
            /**
             * crea bebida
             */

            $nombre_foto="bebidaID".(count($bebida->obtieneTodos())+1);
            $ruta_foto=$_FILES["foto"]["tmp_name"];
            $tipo_foto=$_FILES["foto"]["type"];
            

            /**
             * solo creara si el archivo es imagen y formato jpeg
             * o si no tiene archivo adjunto
             */
            if ($tipo_foto==""||$tipo_foto=="image/jpeg") {
                
                if (!($tipo_foto=="")) { // si tenemos un archivo lo subiremos al servidor
                    $destino_foto="img/bebidas/".$nombre_foto.".jpeg";
                    copy($ruta_foto, $destino_foto); 
                } else{
                    $destino_foto="";
                }

                $bebida->nombre=$_POST["administrador"]["bebidas"]["crear"]["nombre"];
                $bebida->descripcion=$_POST["administrador"]["bebidas"]["crear"]["descripcion"];
                $bebida->tipo=$_POST["administrador"]["bebidas"]["crear"]["tipo"];
                $bebida->estado=$_POST["administrador"]["bebidas"]["crear"]["estado"];
                $bebida->foto=$destino_foto;
                $bebida->crear();
                $mensajeCreacion="bebida $bebida->nombre con ID: $bebida->id_bebida creada";

                /**
                 * se coloc la session ["login"]["crear"] en false para que no se repita al actualizar
                 * se hace consulta para mostar
                 * al crearlo redirige a la vista principal de bebidas
                 */
                $_SESSION["login"]["crear"]=false; 
                $bebidas_array = $bebida->obtieneTodos();
                include_once '././view/administradores_view/Administrar_bebidas_view.php';

            }else{
                $mensajeCreacion="el formato de imagen no es el correcto";
                include_once '././view/administradores_view/Administrar_bebidas_crear_view.php'; 
            }
        } else {
            # code...
            include_once '././view/administradores_view/Administrar_bebidas_crear_view.php'; 
        }
        
    } elseif (isset($_POST["administrador"]["bebidas"]["editar"])) {
        /**------------------------------------------------------editar-----------------------------------------------------
         * para editar una bebida
         * obtenemos el id por post
         */
        $id=$_POST["administrador"]["bebidas"]["editar"]["id"];

        if (isset($_POST["administrador"]["bebidas"]["editar"]["submit"])) {
            /**
             * en el caso de que se de al boton de cambiar
            * obtenemos el array de datos por post
            * con for each cambiamos todos los tatos de entrada
            * excluyendo los que no tienen nada introducido
            */
            $datosCambio=$_POST["administrador"]["bebidas"]["editar"]["datos"];
            if(is_array($datosCambio)){
                foreach ($datosCambio as $key => $value) {
                    if($value!=""){
                    $bebida->cambia_x_id($id, $key, $value);
                    }
                }
            }

            /**
             * para editar fotos
             * me excluye las que no tengan el formato requerido
             */
            $nombre_foto="bebidaID".$id;
            $ruta_foto=$_FILES["foto"]["tmp_name"];
            $tipo_foto=$_FILES["foto"]["type"];
            if ($tipo_foto=="image/jpeg") {
                $destino_foto="img/bebidas/".$nombre_foto.".jpeg";
                copy($ruta_foto, $destino_foto);
                $bebida->foto=$destino_foto;
                $bebida->cambia_x_id($id, "foto", $destino_foto);
            }

            /**
             * creamos las variables necesarias para imprimir la vista
             * en el caso de que no tuviese foto se pondra la imagen por defecto
             */
            $datoActual=$bebida->obtieneDeID($id);
            if ($datoActual->foto=="") {
                $fotoActual="/img/bebidas/por_defecto.png";
            }else{
                $fotoActual=$datoActual->foto;
            }
            include_once '././view/administradores_view/Administrar_bebidas_editar_view.php'; 
        }else{
            /**
             * aqui se llega cuando se biene desde la vista principal de bebidas
             */
            $datoActual=$bebida->obtieneDeID($id);
            if ($datoActual->foto=="") {
                $fotoActual="/img/bebidas/por_defecto.png";
            }else{
                $fotoActual=$datoActual->foto;
            }
            include_once '././view/administradores_view/Administrar_bebidas_editar_view.php';
        }

    } else {
        /**----------------------------------------------------principal---------------------------------------------------
         * pagina principal de administrar bebidas
         * se asegura que session este en false
         */
        $_SESSION["login"]["crear"]=false;
        $bebidas_array = $bebida->obtieneTodos();
        include_once '././view/administradores_view/Administrar_bebidas_view.php'; 
    }


?>
