<?php 
    if (!isset($_SESSION["login"])) {
        header("Location: ../../index.php");
    }
?>
<?php
    /*
    * To change this license header, choose License Headers in Project Properties.
    * To change this template file, choose Tools | Templates
    * and open the template in the editor.
    */

    /**
     * Description of Index_controller
     *
     * @author Luis Damian
     */

    include_once './funciones_php/Funciones.php';
    
    /**
     * si no hay session_start 
     * hace session_start
     */
    if(session_status()==1){
        session_start();
    }
    
    //en este index controller mandamos a cada controlador seleccionado
        
    if (isset($_POST["administrador"])){                                                                           
        /**
         * manda a Administradores_controller
         */
        require_once './controller/administradores_controller/Administradores_controller.php';
    }elseif (isset($_POST["barman"])) {                                       
        /**
         * manda a Barmans_controller
         */
        require_once './controller/barmans_controller/Barmans_controller.php';
    }elseif (isset($_POST["cocinero"])) {                                    
        /**
         * manda a Cocineros_controller
         */
        require_once './controller/cocineros_controller/Cocineros_controller.php';
    }elseif (isset($_POST["camarero"])) {  
        /**
         * manda a Camareros_controller
         */
        require_once './controller/camareros_controller/Camareros_controller.php';   
    }elseif (isset($_POST["volver"])) {  
        /**
         * manda a pagina principal index_view
         */
        $nav_button=crea_button_nav_principal();
        require_once './view/index_view.php';
    }elseif (isset($_POST["contraseña"])) {  
        /**
         * manda a pagina para cambiar la contraseña
         */
        if (isset($_POST["contraseña"]["submit"])) {
            include_once '././model/Trabajadores_model.php';
            $trabajador=new Trabajadores();
            $value=$_POST["password"];
            $trabajador->cambia_contraseña($_SESSION["login"]["dni"], $value);
            $nav_button=crea_button_nav_principal();
            require_once './view/index_view.php';
            
        }else{
            require_once './view/index_contraseña_editar_view.php';
        }
        
    }else {
        /**
         * manda a pagina principal index_view
         * en caso de que no no existans $_POST indicados
         */   
        $nav_button=crea_button_nav_principal();
        require_once './view/index_view.php';                   
    }
    
    ?>

    
    
   
    
