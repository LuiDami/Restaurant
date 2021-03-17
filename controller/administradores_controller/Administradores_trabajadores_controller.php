<?php 
    if (!isset($_SESSION["login"])) {
        header("Location: ../../index.php");
    }
?>
<?php 

    include_once '././model/Trabajadores_model.php';
    include_once '././model/Administradores_model.php';
    include_once '././model/Barmans_model.php';
    include_once '././model/Camareros_model.php';
    include_once '././model/Cocineros_model.php';
    $trabajador=new Trabajadores();
    $administrador=new Administradores();
    $barman=new Barmans();
    $camarero=new Camareros();
    $cocinero=new Cocineros();

    /**
     * esto sirve para cuando actualisemos la paguina no se nos duplique la creacion
     */
    if (isset($_POST["administrador"]["trabajadores"]["crear"])) {
        if($_POST["administrador"]["trabajadores"]["crear"]=="Nuevo Trabajador"){
        $_SESSION["login"]["crear"]=true;   
        }
    }

    if (isset($_POST["administrador"]["trabajadores"]["crear"])&&$_SESSION["login"]["crear"]) {
        /**--------------------------------------------------------crear--------------------------------------------------
         * para crear mas trabajadores
         */
        $mensajeCreacion="";
        if (isset($_POST["administrador"]["trabajadores"]["crear"]["submit"])) {
            /**
             * crea trabajador
             */

            $nombre_foto=$_POST["administrador"]["trabajadores"]["crear"]["dni"];
            $ruta_foto=$_FILES["foto"]["tmp_name"];
            $tipo_foto=$_FILES["foto"]["type"];

            /**
             * solo creara si el archivo es imagen y formato jpeg
             * o si no tiene archivo adjunto
             */
            if ($tipo_foto==""||$tipo_foto=="image/jpeg") {
                
                if (!($tipo_foto=="")) { // si tenemos un archivo lo subiremos al servidor
                    $destino_foto="img/trabajadores/".$nombre_foto.".jpeg";
                    copy($ruta_foto, $destino_foto); 
                } else{
                    $destino_foto="";
                }

                $trabajador->dni=$_POST["administrador"]["trabajadores"]["crear"]["dni"];
                $trabajador->nombre=$_POST["administrador"]["trabajadores"]["crear"]["nombre"];
                $trabajador->apellido=$_POST["administrador"]["trabajadores"]["crear"]["apellido"];
                $trabajador->usuario=$_POST["administrador"]["trabajadores"]["crear"]["usuario"];
                $trabajador->contraseña=$_POST["administrador"]["trabajadores"]["crear"]["contraseña"];
                $trabajador->foto=$destino_foto;//añadimos la ruta de donde se guardara la foto en la bd
                $trabajador->crear();
                
                /**
                 * asignar categoria al trabajador
                 */
                if (isset($_POST["administrador"]["trabajadores"]["crear"]["categoria"]["camarero"])) {
                    # Camareros

                    $camarero->dni=$_POST["administrador"]["trabajadores"]["crear"]["dni"];
                    $camarero->estado=$_POST["administrador"]["trabajadores"]["crear"]["camarero"]["estado"];
                    $camarero->crear();
                }
                if (isset($_POST["administrador"]["trabajadores"]["crear"]["categoria"]["cocinero"])) {
                    # Cocinero

                    $cocinero->dni=$_POST["administrador"]["trabajadores"]["crear"]["dni"];
                    $cocinero->estado=$_POST["administrador"]["trabajadores"]["crear"]["cocinero"]["estado"];
                    $cocinero->crear();
                }
                if (isset($_POST["administrador"]["trabajadores"]["crear"]["categoria"]["barman"])) {
                    # Barman
                    
                    $barman->dni=$_POST["administrador"]["trabajadores"]["crear"]["dni"];
                    $barman->estado=$_POST["administrador"]["trabajadores"]["crear"]["barman"]["estado"];
                    $barman->crear();
                }
                if (isset($_POST["administrador"]["trabajadores"]["crear"]["categoria"]["administrador"])) {
                    # Administrador
                    
                    $administrador->dni=$_POST["administrador"]["trabajadores"]["crear"]["dni"];
                    $administrador->estado=$_POST["administrador"]["trabajadores"]["crear"]["administrador"]["estado"];
                    $administrador->crear();
                }

                $mensajeCreacion="trabajador $trabajador->nombre con DNI: $trabajador->dni creada";

                /**
                 * se coloc la session ["login"]["crear"] en false para que no se repita al actualizar
                 * se hace consulta para mostar
                 * al crearlo redirige a la vista principal de trabajadores
                 */
                $_SESSION["login"]["crear"]=false; 
                $trabajadores_array = $trabajador->obtieneTodos();
                include_once '././view/administradores_view/Administrar_trabajadores_view.php';
            }else{
                /**
                 * en el caso de que el formato de imagen no sea correcto
                 * redigira a creacion
                 */
                $mensajeCreacion="el formato de imagen no es el correcto";
                include_once '././view/administradores_view/Administrar_trabajadores_crear_view.php'; 
            }
        } else {
            # code...
            include_once '././view/administradores_view/Administrar_trabajadores_crear_view.php'; 
        }

    } elseif (isset($_POST["administrador"]["trabajadores"]["editar"])) {
        /**
         * para editar un trabajador
         */
        /**------------------------------------------------------editar-----------------------------------------------------
         * para editar una bebida
         * obtenemos el id por post
         */
        //administrador[trabajadores][editar][id]
        $dni=$_POST["administrador"]["trabajadores"]["editar"]["dni"];
        //["administrador"]["trabajadores"]["editar"]["dni"];
        
        if (isset($_POST["administrador"]["trabajadores"]["editar"]["submit"])) {
            /**
             * en el caso de que se de al boton de cambiar
            * obtenemos el array de datos por post
            * con for each cambiamos todos los tatos de entrada
            * excluyendo los que no tienen nada introducido
            */
            $datosCambio=$_POST["administrador"]["trabajadores"]["editar"]["datos"];
            if(is_array($datosCambio)){
                foreach ($datosCambio as $key => $value) {
                    if($value!=""){
                        if ($key=="contraseña") {
                            /**
                             * solo si has introducido una contraseña
                             */
                            $trabajador->cambia_contraseña($dni, $value);
                        }else{
                           
                           
                           //echo "estas en datos";
                           /**si es array es categoria o estado */
                            if (is_array($value)) {

                                /**
                                 * si existe checkboxs
                                 */
                                // asignar barman-----------------------------------------
                                if (isset($_POST["checkbox_barman"])) {
                                    if (isset($value["barman"])) {
                                        if ($value["barman"]=="barman") {
                                            /**
                                             * creamos barman
                                             */
                                            echo "clicaste barman<br>";
                                            
                                            $barman->dni=$dni;
                                            $barman->estado=$_POST["administrador"]["trabajadores"]["editar"]["datos"]["barman"]["estado"];
                                            $barman->crear();
                                        }
                                    }
                                }else{
                                    if($key=="barman"){
                                        $barman->cambia_x_id($barman->obtener_por_dni($dni)->id_barman, "estado", $value["estado"]);
                                    }
                                }
                                // asignar camarero----------------------------------------
                                if (isset($_POST["checkbox_camarero"])) {
                                    if (isset($value["camarero"])) {
                                        if ($value["camarero"]=="camarero") {
                                            /**
                                             * creamos camarero
                                             */
                                            $camarero->dni=$dni;
                                            $camarero->estado=$_POST["administrador"]["trabajadores"]["editar"]["datos"]["camarero"]["estado"];
                                            $camarero->crear();
                                        }
                                    }
                                }else{
                                    if($key=="camarero"){
                                        $camarero->cambia_x_id($camarero->obtener_por_dni($dni)->id_camarero, "estado", $value["estado"]);
                                    }
                                }
                                // asignar cocinero-----------------------------------
                                if (isset($_POST["checkbox_cocinero"])) {
                                    if (isset($value["cocinero"])) {
                                        if ($value["cocinero"]=="cocinero") {
                                            /**
                                             * creamos cocinero
                                             */
                                            $cocinero->dni=$dni;
                                            $cocinero->estado=$_POST["administrador"]["trabajadores"]["editar"]["datos"]["cocinero"]["estado"];
                                            $cocinero->crear();
                                        }
                                    }
                                }else{
                                    if($key=="cocinero"){
                                        $cocinero->cambia_x_id($cocinero->obtener_por_dni($dni)->id_cocinero, "estado", $value["estado"]);
                                    }
                                }
                                // asignar administrador
                                if (isset($_POST["checkbox_administrador"])) {
                                    if (isset($value["administrador"])) {
                                    # code...
                                    if ($value["administrador"]=="administrador") {
                                        /**
                                         * creamos administrador
                                         */
                                        $administrador->dni=$dni;
                                        $administrador->estado=$_POST["administrador"]["trabajadores"]["editar"]["datos"]["administrador"]["estado"];
                                        $administrador->crear();
                                    }
                                }

                                }else{
                                    if($key=="administrador"){
                                        $administrador->cambia_x_id($administrador->obtener_por_dni($dni)->id_administrador, "estado", $value["estado"]);
                                    }
                                }

                                

                            }else{
                               
                                $trabajador->cambia_x_id($dni, $key, $value);
                           }
                        }
                    }
                }
            }

            /**
             * para editar fotos
             * me excluye las que no tengan el formato requerido
             */
            $nombre_foto=$dni;
            $ruta_foto=$_FILES["foto"]["tmp_name"];
            $tipo_foto=$_FILES["foto"]["type"];
            if ($tipo_foto=="image/jpeg") {
                $destino_foto="img/trabajadores/".$nombre_foto.".jpeg";
                copy($ruta_foto, $destino_foto);
                $trabajador->foto=$destino_foto;
                $trabajador->cambia_x_id($dni, "foto", $destino_foto);
            }

            /**
             * creamos las variables necesarias para imprimir la vista
             * en el caso de que no tuviese foto se pondra la imagen por defecto
             */

            /**
             * con esto creamos dinamicamente los checkbox
             */
            if ($barman->obtenerCantidadValor("dni", $dni)!=0) {
                /**
                 * si entras aqui significa que ya tiene creado como barman
                 */
                $checkbox_barman ="<label>Barman</label>";
            }else{
                $checkbox_barman ='<input type="checkbox"  name="administrador[trabajadores][editar][datos][categoria][barman]" id="barman" value="barman" class="click_barman" title="Permite asignar al trabajador como barman" /><label for="barman" class="click_barman" >Barman</label><input type="hidden" name="checkbox_barman" value="checkbox_barman" >';
            }
            if ($camarero->obtenerCantidadValor("dni", $dni)!=0) {
                /**
                 * si entras aqui significa que ya tiene creado como camarero
                 */
                $checkbox_camarero ="<label>Camarero</label>";
            }else{
                $checkbox_camarero = '<input type="checkbox"  name="administrador[trabajadores][editar][datos][categoria][camarero]" id="camarero" value="camarero" class="click_camarero" title="Permite asignar al trabajador como camarero" /><label for="camarero" class="click_camarero" >Camarero</label><input type="hidden" name="checkbox_camarero" value="checkbox_camarero" >';
            }
            if ($cocinero->obtenerCantidadValor("dni", $dni)!=0) {
                /**
                 * si entras aqui significa que ya tiene creado como cocinero
                 */
                $checkbox_cocinero ="<label>Cocinero</label>";
            }else{
                $checkbox_cocinero ='<input type="checkbox"  name="administrador[trabajadores][editar][datos][categoria][cocinero]" id="cocinero" value="cocinero"  class="click_cocinero" title="Permite asignar al trabajador como cocinero" /><label for="cocinero"  class="click_cocinero" >Cocinero</label><input type="hidden" name="checkbox_cocinero" value="checkbox_cocinero" >';
            }
            if ($administrador->obtenerCantidadValor("dni", $dni)!=0) {
                /**
                 * si entras aqui significa que ya tiene creado como administrador
                 */
                $checkbox_administrador ="<label>Administrador</label>";
            }else{
                $checkbox_administrador ='<input type="checkbox"  name="administrador[trabajadores][editar][datos][categoria][administrador]" id="administrador" value="administrador" class="click_administrador" title="Permite asignar al trabajador como administrador" /><label for="administrador  class="click_administrador" ">Administrador</label><input type="hidden" name="checkbox_administrador" value="checkbox_administrador" >';
            }

            $datoActual_administrador=$administrador->obtenerClaveValor("dni", $dni);
            $datoActual_barman=$barman->obtenerClaveValor("dni", $dni);
            $datoActual_camarero=$camarero->obtenerClaveValor("dni", $dni);
            $datoActual_cocinero=$cocinero->obtenerClaveValor("dni", $dni);
            $datoActual=$trabajador->obtieneDeID($dni);
            if ($datoActual->foto=="") {
                $fotoActual="/img/trabajadores/por_defecto.png";
            }else{
                $fotoActual=$datoActual->foto;
            }
            include_once '././view/administradores_view/Administrar_trabajadores_editar_view.php'; 
        }else{
            /**
             * con esto creamos dinamicamente los checkbox
             */
            if ($barman->obtenerCantidadValor("dni", $dni)!=0) {
                /**
                 * si entras aqui significa que ya tiene creado como barman
                 */
                $checkbox_barman ="<label>Barman</label>";
            }else{
                $checkbox_barman ='<input type="checkbox"  name="administrador[trabajadores][editar][datos][categoria][barman]" id="barman" value="barman" class="click_barman" title="Permite asignar al trabajador como barman" /><label for="barman" class="click_barman" >Barman</label><input type="hidden" name="checkbox_barman" value="checkbox_barman" >';
            }
            if ($camarero->obtenerCantidadValor("dni", $dni)!=0) {
                /**
                 * si entras aqui significa que ya tiene creado como camarero
                 */
                $checkbox_camarero ="<label>Camarero</label>";
            }else{
                $checkbox_camarero = '<input type="checkbox"  name="administrador[trabajadores][editar][datos][categoria][camarero]" id="camarero" value="camarero"  class="click_camarero" title="Permite asignar al trabajador como camarero" /><label for="camarero" class="click_camarero" >Camarero</label><input type="hidden" name="checkbox_camarero" value="checkbox_camarero" >';
            }
            if ($cocinero->obtenerCantidadValor("dni", $dni)!=0) {
                /**
                 * si entras aqui significa que ya tiene creado como cocinero
                 */
                $checkbox_cocinero ="<label>Cocinero</label>";
            }else{
                $checkbox_cocinero ='<input type="checkbox"  name="administrador[trabajadores][editar][datos][categoria][cocinero]" id="cocinero" value="cocinero"  class="click_cocinero" title="Permite asignar al trabajador como cocinero" /><label for="cocinero"  class="click_cocinero" >Cocinero</label><input type="hidden" name="checkbox_cocinero" value="checkbox_cocinero"  >';
            }
            if ($administrador->obtenerCantidadValor("dni", $dni)!=0) {
                /**
                 * si entras aqui significa que ya tiene creado como administrador
                 */
                $checkbox_administrador ="<label>Administrador</label>";
            }else{
                $checkbox_administrador ='<input type="checkbox"  name="administrador[trabajadores][editar][datos][categoria][administrador]" id="administrador" value="administrador" class="click_administrador"title="Permite asignar al trabajador como administrador" /><label for="administrador" class="click_administrador" >Administrador</label><input type="hidden" name="checkbox_administrador" value="checkbox_administrador"  >';
            }

            $datoActual_administrador=$administrador->obtenerClaveValor("dni", $dni);
            $datoActual_barman=$barman->obtenerClaveValor("dni", $dni);
            $datoActual_camarero=$camarero->obtenerClaveValor("dni", $dni);
            $datoActual_cocinero=$cocinero->obtenerClaveValor("dni", $dni);
            $datoActual=$trabajador->obtieneDeID($dni);
            if ($datoActual->foto=="") {
                $fotoActual="/img/trabajadores/por_defecto.png";
            }else{
                $fotoActual=$datoActual->foto;
            }
            include_once '././view/administradores_view/Administrar_trabajadores_editar_view.php'; 
        }
    } else {
        /**---------------------------------------paguina principal----------------------------------------------------
         * pagina principal de administrar trabajadores
         * se asegura que session este en false
         */
        $_SESSION["login"]["crear"]=false; 
        $trabajadores_array = $trabajador->obtieneTodos();
        include_once '././view/administradores_view/Administrar_trabajadores_view.php';
    }


?>