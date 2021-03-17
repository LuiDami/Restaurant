<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * funciones varias
 *
 * @author Luis Damian
 */





if(session_status()==1){
    session_start();
}

function nombreEstado($estado){
    if ($estado=="0") {
        $returm="Desactivado";
    }else if($estado=="1"){
        $returm="Activo";
    }
    return $returm;
}

function nombreBebidas($bebida){
    $returm="";
    if ($bebida=="refresco_con_gas") {
        $returm="refresco con gas";
    }else if($bebida=="refresco_sin_gas"){
        $returm="refresco sin gas";
    }else{
        $returm=$bebida;
    }
    return $returm;
}

/**
 * esta funcion comprueba en la bd si el usuario y la contraseña existen
 * si coinciden, crea las secciones crea una sessiones
 * @param type $user
 * @param type $password
 */
function ComprobarUsuario($user, $password){
    include_once './model/Trabajadores_model.php';
    include_once './model/Administradores_model.php';
    include_once './model/Barmans_model.php';
    include_once './model/Camareros_model.php';
    include_once './model/Cocineros_model.php';

    $ComprobarLogueado=new Trabajadores;
    $ComprobarAdministrador=new Administradores;
    $ComprobarBarman=new Barmans;
    $ComprobarCamarero=new Camareros;
    $ComprobarCocinero=new Cocineros;

    $resultado=$ComprobarLogueado->Comprobar_logueado($user, $password);
    $datosUsuario =$ComprobarLogueado->obtener_trabajador_por_user($user);
    
    /**
     * si el resultado de la busqueda es superior a 0 es que existe
     */
    if($resultado->num_rows!=0){

        $dni=$resultado->fetch_assoc()["dni"];
        
        /**
         * sessiones array login:
         * usuario: el nombre de usuario, aunque creo que no es nesesario
         * dni: con esta seccion accederemos a sus permisos de usuario (camarero, cocinero, barman, admin)
         * nombre: accedemos al nombre del usuario y lo añadimos a la sesion
         * apellido:
         * foto:
         * 
         * administrador:
         * barman:
         * camarero:
         * cocinero:
         * 
         * logout: plantilla html conde permite cerrar la session
         * crear: esto es para que no se dupliquen los insert
         * usuarioAcceso: saludo al usuario 
         */
        $_SESSION["login"]["usuario"] = $user;
        $_SESSION["login"]["dni"] = $dni;
        $_SESSION["login"]["nombre"] = $datosUsuario->nombre;
        $_SESSION["login"]["apellido"] = $datosUsuario->apellido;
        $_SESSION["login"]["foto"] = $datosUsuario->foto;
        if ($datosUsuario->foto=="") {
            $_SESSION["login"]["foto"] ="img/trabajadores/por_defecto.png";
        } else {
            $_SESSION["login"]["foto"] = $datosUsuario->foto;
        }
        
        $_SESSION["login"]["logo"] = "<form action='./index.php' method='post'><button type='submit' name='volver' id='button_logo'><img src='img/tenedor.ico' alt='Logo Restaurante' id='logo' ></button></form>";
        
        if($ComprobarAdministrador->obtener_por_dni($dni)!=false){
            $_SESSION["login"]["administrador"] = $ComprobarAdministrador->obtener_por_dni($dni)->estado; 
        }
        if($ComprobarBarman->obtener_por_dni($dni)!=false){
            $_SESSION["login"]["barman"] = $ComprobarBarman->obtener_por_dni($dni)->estado;
        }
        if($ComprobarCamarero->obtener_por_dni($dni)!=false){
            $_SESSION["login"]["camarero"] = $ComprobarCamarero->obtener_por_dni($dni)->estado;
        }
        if($ComprobarCocinero->obtener_por_dni($dni)!=false){
            $_SESSION["login"]["cocinero"] = $ComprobarCocinero->obtener_por_dni($dni)->estado;
        }
        
        $_SESSION["login"]["logout"]="<div class='logout'><form action='./index.php' method='post'>
            <input type=\"submit\" id=\"desconectar\" value=\"Desconectar\" name=\"logout\">
            </form></div>" ;
        $_SESSION["login"]["crear"]=false;
        $_SESSION["login"]["usuarioAcceso"]="<div class='usuarioAcceso'>Hola, ".$_SESSION["login"]["nombre"]."</div>";
    }
}


 /**
  * crea dinamicamente los botones de nav de la paguina principal
  */
function crea_button_nav_principal(){

    $nav_administrador="";
    $nav_barman="";
    $nav_camarero="";
    $nav_cocinero="";
    /**
     * si existe la session significa que esta dado de alta
     * si la session tiene 1 significa que esta activo
     * si cumple las dos condiciones crea el boton para ponerlo disponible
     */
    if(isset($_SESSION["login"]["administrador"])){
        if ($_SESSION["login"]["administrador"]) {
            $nav_administrador="<input class='butoom_nav' type='submit' value='Administrador' name='administrador'>";
        }
    }
    if(isset($_SESSION["login"]["barman"])){
        if ($_SESSION["login"]["barman"]) {
            $nav_barman="<input class='butoom_nav' type='submit' value='Barman' name='barman'>";
        }
    }
    if(isset($_SESSION["login"]["camarero"])){
        if ($_SESSION["login"]["camarero"]) {
            $nav_camarero="<input class='butoom_nav' type='submit' value='Camarero' name='camarero'>";
        }
    }
    if(isset($_SESSION["login"]["cocinero"])){
        if ($_SESSION["login"]["cocinero"]) {
            $nav_cocinero="<input class='butoom_nav' type='submit' value='Cocinero' name='cocinero'>";
        }
    }
    $nav_button=$nav_camarero.$nav_cocinero.$nav_barman.$nav_administrador;
    return $nav_button;
}

/**
 * crea un array con las posisiones de las mesas en el salon
 */
function arraySalon($mesas){
    $salon =array(
        1=>array(
            1=>0,
            2=>0,
            3=>0,
            4=>0,
            5=>0,
            6=>0,
            7=>0,
            8=>0,
            9=>0
        ),
        2=>array(
            1=>0,
            2=>0,
            3=>0,
            4=>0,
            5=>0,
            6=>0,
            7=>0,
            8=>0,
            9=>0
        ),
        3=>array(
            1=>0,
            2=>0,
            3=>0,
            4=>0,
            5=>0,
            6=>0,
            7=>0,
            8=>0,
            9=>0
        ),
        4=>array(
            1=>0,
            2=>0,
            3=>0,
            4=>0,
            5=>0,
            6=>0,
            7=>0,
            8=>0,
            9=>0
        ),
        5=>array(
            1=>0,
            2=>0,
            3=>0,
            4=>0,
            5=>0,
            6=>0,
            7=>0,
            8=>0,
            9=>0
        ),
        6=>array(
            1=>0,
            2=>0,
            3=>0,
            4=>0,
            5=>0,
            6=>0,
            7=>0,
            8=>0,
            9=>0
        ),
        7=>array(
            1=>0,
            2=>0,
            3=>0,
            4=>0,
            5=>0,
            6=>0,
            7=>0,
            8=>0,
            9=>0
        ),
        8=>array(
            1=>0,
            2=>0,
            3=>0,
            4=>0,
            5=>0,
            6=>0,
            7=>0,
            8=>0,
            9=>0
        ),
        9=>array(
            1=>0,
            2=>0,
            3=>0,
            4=>0,
            5=>0,
            6=>0,
            7=>0,
            8=>0,
            9=>0
        ),
    );

    foreach ($salon as $Y => $arrayFila){
        foreach ($arrayFila as $X => $mesa){
            for($i=0;$i<count($mesas);$i++){
                if ($mesas[$i]->ubicacionX==$X && $mesas[$i]->ubicacionY==$Y) {
                    $salon[$Y][$X]=$mesas[$i]->numero_mesa;
                }
            }
        }

    }

    $tabla="<table id='salon' >";
    
    $tabla.="<tr><th colspan='9'>Salon</th></tr>";
    
    foreach ($salon as $Y => $arrayFila){
        $tabla.="<tr>";
        foreach ($arrayFila as $X => $mesa){
            
            
                if ($mesa!=0) {
                    $tabla.="<td class='mesas' style='color: white; background-color: #005f95; border: none;'>";
                    $tabla.="$mesa";
                    $tabla.="</td>";
                }else{
                    $tabla.="<td style='border: none; background-color: transparent ;'></td>";
                }

            
        }
        $tabla.="</tr>";
    }
    $tabla.="</table>";

    return $tabla;

}


