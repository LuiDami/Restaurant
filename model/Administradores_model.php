<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Administradores
 *
 * @author Luis Damian
 */
include_once 'Crud_model.php';
class Administradores extends Crud {
    private $id_administrador;
    private $dni;
    private $estado;
    private $conexion;
    const TABLA=["administradores", "id_administrador"]; // declaramos una constante en clase
    
    /**
     * Constructor de clase
     */
    function __construct() {
        /*pasamos como parametro la constante TABLA de esta clase al costructor de la clase padre
         * asignamos la funcion protected conexion a la variable conexion de la clase
         **/
        parent::__construct(Administradores::TABLA);
        $this->conexion= $this->conexion();
        $this->estado=1;
    }
    
    /**
     * funcion magica getter
     * @param type $name
     * @return type
     */
    function __get($name) {
        /* si la propiedad existe retornara la propiedad*/
        if(property_exists($this, $name)) {
            return $this->$name;
        }
    }
    
    /**
     * funcion magica setter
     * @param type $name
     * @param type $value
     */
    function __set($name, $value) {
        /*si la propiedad existe retornara la propiedad*/
        if(property_exists($this, $name)){
            $this->$name=$value;
        } 
    }

    
    /**
     * Metodo heredado class Grud  era abstract
     * @param type $atributo
     * @param type $valor
     */
    public function actualizar($atributo, $valor) {
        /**
         * guardamos la consulta en $sql
         * ejecutamos la consulta en php el cambio en la BD
         * realizamos el cambio del valor del atributo en la clase
         *                                              atributo a cambiar          que tuplas cambias segun la condicion
         * formato actualizar UPDATE NombreTabla SET NombreAtributo = ValorAtributo WHERE NombreAtributo = ValorAtributo
         */
        // para acceder a una cosntante de la clase NombreClase::NOMBRECONSTANTE
        try {
            $sql = "UPDATE ".Administradores::TABLA[0]." SET $atributo = '$valor' WHERE id_administrador = '$this->id_administrador'"; 
            $this->conexion->query($sql);
            $this->__set($atributo, $valor);
        } catch (Exception $ex) {
            echo 'error '.$ex;
        }
        
    }
    
    /**
     * Metodo heredado class Grud era abstract
     * crea la tupla en la bd y asigna el id al objeto
     */
    public function crear() {
        /**
         * guardamos la consulta en $sql
         * ejecutamos la consulta en php 
         * asignamos el id del objeto = al ultimo id que añadimos a la bd, asi coincidiran el id objeto con tupla
         *                                                 lista de atributos a introducir    valores de atributos a introducir
         * formato insertar datos INSERT INTO NombreTabla (NombreAtributo1, NombreAtributo2) VALUES (ValorAtributo1, ValorAtributo2)
         */
        // para acceder a una cosntante de la clase NombreClase::NOMBRECONSTANTE
        try {
           $sql="INSERT INTO ".Administradores::TABLA[0]." (dni, estado) VALUES ('$this->dni', '$this->estado')";
            $this->conexion->query($sql);
            $this->__set("id_administrador", $this->conexion->insert_id); 
        } catch (Exception $ex) {
            echo 'error '.$ex;
        }
        
    }

    /**
     * Obtiene Administradores por dni
     * si no obtiene nada retorna false
     * @param type $dni
     */
    public function obtener_por_dni($dni){
        $sql= "SELECT * FROM ".Administradores::TABLA[0]." WHERE dni = '$dni'";
        $resultado = $this->conexion->query($sql);
        if ($resultado->num_rows!=0) {
            $salida = $resultado->fetch_object();
        }else{
            $salida=false;
        }
        return $salida;
    }

    /**
     * Obtiene Administradores con los datos de trabajadores
     */
    public function obtener_trabajadores(){
        try {
            $sql= "SELECT * FROM `trabajadores` t1 INNER JOIN ".Administradores::TABLA[0]." t2 ON t1.dni = t2.dni";
            $resultado=$this->conexion->query($sql);
            //$salida = $resultado->fetch_object();

            $objetos=array();

            while ($fila=$resultado->fetch_object()){
                $objetos[]=$fila;
            }

            return $objetos;
            
       } catch (Exception $ex) {
            $salida = 'error '.$ex;
            return $salida;
       }
    }

    /**
     * Obtiene Administradores con los datos de trabajadores desactivado
     */
    public function obtener_trabajadores_desactivados(){
        try {
            $sql= "SELECT * FROM `trabajadores` t1 INNER JOIN ".Administradores::TABLA[0]." t2 ON t1.dni = t2.dni WHERE t2.estado=0";
            $resultado=$this->conexion->query($sql);
            //$salida = $resultado->fetch_object();

            $objetos=array();

            while ($fila=$resultado->fetch_object()){
                $objetos[]=$fila;
            }

            return $objetos;
            
       } catch (Exception $ex) {
            $salida = 'error '.$ex;
            return $salida;
       }
    }

    /**
     * Obtiene Administradores con los datos de trabajadores activados
     */
    public function obtener_trabajadores_activados(){
        try {
            $sql= "SELECT * FROM `trabajadores` t1 INNER JOIN ".Administradores::TABLA[0]." t2 ON t1.dni = t2.dni WHERE t2.estado=1";
            $resultado=$this->conexion->query($sql);
            //$salida = $resultado->fetch_object();

            $objetos=array();

            while ($fila=$resultado->fetch_object()){
                $objetos[]=$fila;
            }

            return $objetos;
            
       } catch (Exception $ex) {
            $salida = 'error '.$ex;
            return $salida;
       }
    }

 //fin clase Administradores
}
