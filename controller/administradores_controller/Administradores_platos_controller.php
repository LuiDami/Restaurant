<?php 
    if (!isset($_SESSION["login"])) {
        header("Location: ../../index.php");
    }
?>
<?php 

    include_once '././model/Platos_model.php';
    $plato=new Platos();

    /**
     * esto sirve para cuando actualisemos la paguina no se nos duplique la creacion
     */
    if (isset($_POST["administrador"]["platos"]["crear"])) {
        if($_POST["administrador"]["platos"]["crear"]=="Nuevo Plato"){
        $_SESSION["login"]["crear"]=true;   
        }
    }
    
    if ((isset($_POST["administrador"]["platos"]["crear"]))&&$_SESSION["login"]["crear"]) {
        /**----------------------------------------------------------crear--------------------------------------
         * para crear mas platos
         */
        $mensajeCreacion="";
        if (isset($_POST["administrador"]["platos"]["crear"]["submit"])) {

            
            $nombre_foto="platoID".(count($plato->obtieneTodos())+1);
            $ruta_foto=$_FILES["foto"]["tmp_name"];
            $tipo_foto=$_FILES["foto"]["type"];
            

            /**
             * solo creara si el archivo es imagen y formato jpeg
             * o si no tiene archivo adjunto
             */
            if ($tipo_foto==""||$tipo_foto=="image/jpeg") {
                
                if (!($tipo_foto=="")) { // si tenemos un archivo lo subiremos al servidor
                    $destino_foto="img/platos/".$nombre_foto.".jpeg";
                    copy($ruta_foto, $destino_foto); 
                } else{
                    $destino_foto="";
                }

                $plato->nombre=$_POST["administrador"]["platos"]["crear"]["nombre"];
                $plato->descripcion=$_POST["administrador"]["platos"]["crear"]["descripcion"];
                $plato->tipo=$_POST["administrador"]["platos"]["crear"]["tipo"];
                $plato->estado=$_POST["administrador"]["platos"]["crear"]["estado"];
                $plato->foto=$destino_foto;
                $plato->receta=$_POST["administrador"]["platos"]["crear"]["receta"];
                $plato->crear();
                $mensajeCreacion="plato $plato->nombre con ID: $plato->id_plato creada";

                /**
                 * se coloc la session ["login"]["crear"] en false para que no se repita al actualizar
                 * se hace consulta para mostar
                 * al crearlo redirige a la vista principal de platos
                 */
                $_SESSION["login"]["crear"]=false; 
                $platos_array = $plato->obtieneTodos();
                include_once '././view/administradores_view/Administrar_platos_view.php'; 

            }else{
                /**
                 * en caso de que tengamos una imagen que no es correcta no creara el plato
                 * y redigira a creacion de nuevo
                 */
                $mensajeCreacion="el formato de imagen no es el correcto";
                include_once '././view/administradores_view/Administrar_platos_crear_view.php'; 
            }
            
        }else {
            include_once '././view/administradores_view/Administrar_platos_crear_view.php'; 
        }
        
    } elseif (isset($_POST["administrador"]["platos"]["editar"])) {
        /**------------------------------------------------------editar-----------------------------------------------------
         * para editar un plato
         * obtenemos el id por post
         */
        $id=$_POST["administrador"]["platos"]["editar"]["id"];

        if (isset($_POST["administrador"]["platos"]["editar"]["submit"])) {
            /**
             * en el caso de que se de al boton de cambiar
            * obtenemos el array de datos por post
            * con for each cambiamos todos los tatos de entrada
            * excluyendo los que no tienen nada introducido
            */
            $datosCambio=$_POST["administrador"]["platos"]["editar"]["datos"];
            if(is_array($datosCambio)){
                foreach ($datosCambio as $key => $value) {
                    if($value!=""){
                    $plato->cambia_x_id($id, $key, $value);
                    }
                }
            }

            /**
             * para editar fotos
             * me excluye las que no tengan el formato requerido
             */
            $nombre_foto="platoID".$id;
            $ruta_foto=$_FILES["foto"]["tmp_name"];
            $tipo_foto=$_FILES["foto"]["type"];
            if ($tipo_foto=="image/jpeg") {
                $destino_foto="img/platos/".$nombre_foto.".jpeg";
                copy($ruta_foto, $destino_foto);
                $plato->foto=$destino_foto;
                $plato->cambia_x_id($id, "foto", $destino_foto);
            }

            /**
             * creamos las variables necesarias para imprimir la vista
             * en el caso de que no tuviese foto se pondra la imagen por defecto
             */
            $datoActual=$plato->obtieneDeID($id);
            if ($datoActual->foto=="") {
                $fotoActual="/img/platos/por_defecto.png";
            }else{
                $fotoActual=$datoActual->foto;
            }
            include_once '././view/administradores_view/Administrar_platos_editar_view.php'; 
        }else{
            /**
             * creamos las variables necesarias para imprimir la vista
             * en el caso de que no tuviese foto se pondra la imagen por defecto
             */
            $datoActual=$plato->obtieneDeID($id);
            if ($datoActual->foto=="") {
                $fotoActual="/img/platos/por_defecto.png";
            }else{
                $fotoActual=$datoActual->foto;
            }
            include_once '././view/administradores_view/Administrar_platos_editar_view.php'; 
        }
    } else {
        /**----------------------------------------------------principal---------------------------------------------------
         * pagina principal de administrar platos
         * se asegura que session este en false
         */
        $_SESSION["login"]["crear"]=false; 
        $platos_array = $plato->obtieneTodos();
        include_once '././view/administradores_view/Administrar_platos_view.php';
    }




?>