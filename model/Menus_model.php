<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Menus
 *
 * @author Luis Damian
 */
include_once 'Crud_model.php';
class Menus extends Crud {
    //put your code here
    private $id_menu;
    private $descripcion;
    private $estado;
    private $conexion;
    const TABLA=["menus", "id_menu"];
    
    /**
     * Constructor de clase
     */
    function __construct() {
        /*pasamos como parametro la constante TABLA de esta clase al costructor de la clase padre
         * asignamos la funcion protected conexion a la variable conexion de la claset
         **/
        parent::__construct(Menus::TABLA);
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
            $sql = "UPDATE ".Menus::TABLA[0]." SET $atributo = '$valor' WHERE id_menu = '$this->id_menu'"; 
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
            $sql="INSERT INTO ".Menus::TABLA[0]." (`descripcion`, `estado`) VALUES ('$this->descripcion', '$this->estado')";
            $this->conexion->query($sql);
            $this->__set("id_menu", $this->conexion->insert_id);
        } catch (Exception $ex) {
            echo 'error '.$ex;
        }
        
    }
    
    // fin clase Menus
}
