<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Conexion
 *
 * @author Luis Damian
 */

class Conexion {
    //con esta clase controlamos la conexion con la base de datos
    
    private $localhost="localhost";
    private $usuario="root";
    private $contraseña="";
    private $baseDatos="restaurante";
    
    protected function conexion(){
        /**
         * $conexion realiza la conección a la base de datos;
         * $error recoje el error si lo ubiese
         * set_charset() determina e tipo de codificacion a usar en este caso utf8 asi salen las tildes
         * cambiar la codigficacion a UTF8
         * retornamos la conecion
         */
        //@ $conexion = new mysqli($this->localhost, $this->usuario, $this->contraseña, $this->baseDatos);
        try {
            $conexion = new mysqli($this->localhost, $this->usuario, $this->contraseña, $this->baseDatos);
            $error= $conexion->connect_errno;

            if($error){
                echo "Ha fallado la conección a la base de datos $error";
                exit();
            }
            $conexion->set_charset("utf8");
            return $conexion;
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        
    }
}
