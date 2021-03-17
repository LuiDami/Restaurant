<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Menus_platos
 *
 * @author Luis Damian
 */
include_once 'Crud_model.php';
class MenusPlatos extends Crud {
    //put your code here
    private $id_menu;
    private $id_plato;
    private $conexion;
    const TABLA=["menu_plato", "id_menu"];
    
    /**
     * Constructor de clase
     */
    function __construct() {
        /*pasamos como parametro la constante TABLA de esta clase al costructor de la clase padre
         * asignamos la funcion protected conexion a la variable conexion de la claset
         **/
        parent::__construct(MenusPlatos::TABLA);
        $this->conexion= $this->conexion();
        $this->estado=1;
        
    }
    
    /**
     * funcion magica getter
     * @param type $name
     * @return type
     */
    function __get($name) {
        /*si la propiedad existe retornara la propiedad*/
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
        //para acceder a una cosntante de la clase NombreClase::NOMBRECONSTANTE
        
        try {
            $sql = "UPDATE ".MenusPlatos::TABLA[0]." SET $atributo = '$valor' WHERE id_menu = '$this->id_menu'"; 
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
            $sql="INSERT INTO ".MenusPlatos::TABLA[0]." (`id_menu`, `id_plato`) VALUES ('$this->id_menu', '$this->id_plato')";
            $this->conexion->query($sql);
            //$this->__set("id_menu", $this->conexion->insert_id);
        } catch (Exception $ex) {
            echo 'error '.$ex;
        }
        
    }
    
    /**
     * Metodo heredado class Grud  era abstract
     * @param type $id_menu
     * @param type $tipo
     */
    public function obtener_platosMenu_por_tipo($id_menu, $tipo=""){
        $auxiliar="";
        if($tipo=="primero"){
            $auxiliar= "&& t1.tipo='$tipo'";
        }
        if($tipo=="segundo"){
            $auxiliar= "&& t1.tipo='$tipo'";
        }
        if($tipo=="postre"){
            $auxiliar= "&& t1.tipo='$tipo'";
        }
        try {
             $sql= "SELECT * FROM `platos` t1 INNER JOIN ".MenusPlatos::TABLA[0]." t2 ON t1.id_plato = t2.id_plato WHERE t2.id_menu=".$id_menu." ".$auxiliar;
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

    function borrarPlatodeMenu($id_plato, $id_menu){
        /**
         * guardamos la consulta en $sql borra tupla del id indicado
         * ejecutamos la consulta en php
         *                                                  que tuplas borrar segun la condicion
         * formato sql borrar datos DELETE FROM NombreTabla WHERE NombreAtributo = ValorAtributo
         */
        try {
            $sql="DELETE FROM ".MenusPlatos::TABLA[0]." WHERE id_plato like '$id_plato' && id_menu like '$id_menu'";
            $this->conexion->query($sql);
        } catch (Exception $ex) {
            echo 'error '.$ex;
        }
        
        
    }
    // fin clase Menus_platos
}
