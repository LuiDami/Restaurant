<?php 
    if (!isset($_SESSION["login"])) {
        header("Location: ../../index.php");
    }
?>
<?php

    include_once './model/Administradores_model.php';
     
    $administradores= new Administradores();

    if(session_status()==1){
        session_start();
    }

    if (isset($_POST["administrador"]["trabajadores"])) {//--------------------------Trabajadores------------------------------------
        /**
         * zona de administrar trabajadores
         */
            
        include_once '././controller/administradores_controller/Administradores_trabajadores_controller.php';

    } elseif (isset($_POST["administrador"]["platos"])) {//----------------------------Platos---------------------------------------
        /**
         * zona de administrar platos
         */
        
        include_once '././controller/administradores_controller/Administradores_platos_controller.php';

    } elseif(isset($_POST["administrador"]["bebidas"])){//-----------------------------Bebidas----------------------------------------
        /**
         * zona de administrar bebidas
         */
        
        include_once '././controller/administradores_controller/Administradores_bebidas_controller.php';

    } elseif(isset($_POST["administrador"]["menus"])){//----------------------------------Menus-------------------------------------                                      
        /**
         * zona de administrar menus
         */
        
        include_once '././controller/administradores_controller/Administradores_menus_controller.php';

    } elseif(isset($_POST["administrador"]["mesas"])){//-----------------------------------Mesas------------------------------------
        /**
         * zona de administrar mesas
         */
        
        include_once '././controller/administradores_controller/Administradores_mesas_controller.php';
        
    } else {//--------------------------------------------------------------------------------------------------------------------------
        /**
         * aqui vamos a la pagina principal de administradores
         * donde se muestra los botones de acceso de administracion
         */
        $_SESSION["login"]["crear"]=false; 
        //$administradores_array=$administradores->obtieneTodos();
        include_once '././view/administradores_view/Administradores_view.php'; 
    }
    
