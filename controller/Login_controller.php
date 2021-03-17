<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Loguin_controller
 *
 * @author Luis Damian
 * Tengo funcionando esto correctamente 25/10/20 Luisda
 */


/**
 * si hay session_start hace session_start
 */

include_once './funciones_php/Funciones.php';

if(session_status()==1){
    session_start();
}

/**
 * mensaje por si pone mal el usuario o contraseña
 */
$mensajeContraseña=""; 

/**
 * si el usuario da a logout se redireccionará al loguin y destruira las sessiones
 */
if(isset($_POST["logout"])){
    /**
     * se destruye la session
     */
    session_destroy();
    /**
     * redirecciona al controlador login
     */
    header('Location: ./index.php');
}

/**
 * solo realizara la comprobacion si session logout no existe
 */
if (!(isset($_SESSION["login"]))) {
    /**
     * si recibimos pr post el usuario y la contraseña procederemos a comprobarla en la bd
     */
    if(isset($_POST["submit"]) && isset($_POST["user"] ) && isset($_POST["password"]) ){ 
        /**
         * aqui solo empezando a logear
         * si el usuario existe crea las seciones
         */
        ComprobarUsuario($_POST["user"], $_POST["password"]);
        /**
         * si existe la sesion significa que a entrado correctamente
         */
        if(isset($_SESSION["login"])){ 
            /**
             * un saludo al usuario actual
             * aqui deberemos incluir el acceso a lo demas en este caso el controlador que gestiona todo
             * logeado incluye index_controller
             */
            include_once "./controller/Index_controller.php";
        }else{ 
            /**
             * si no existe la session significa que el usuario o contraseña no coinciden
             * por lo cual no esta logeado e incluira la vista de login Login_view
             */
            $mensajeContraseña=" Los datos introducidos no son correctos ";
            include_once "./view/Login_view.php";     
        }
    }else{
        /**
         * aqui solo accedemos si ya hemos estado logeado antes sin haber pasado por la vista de login
         */
        if(isset($_SESSION["login"])){;  
            include_once "./controller/Index_controller.php";
        }else{
            /**
             * entramos aqui si damos al boton desconectar
             */
            include_once "./view/Login_view.php";
        }
    }

}else {
    include_once "./controller/Index_controller.php";
}

?>