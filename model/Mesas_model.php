<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mesas
 *
 * @author Luis Damian
 */
include_once 'Crud_model.php';
class Mesas extends Crud {
    //put your code here
    private $numero_mesa;
    private $ubicacionX;
    private $ubicacionY;
    private $conexion;
    const TABLA=["mesas", "numero_mesa"];
    
    /**
     * Constructor de clase
     */
    function __construct() {
        /*pasamos como parametro la constante TABLA de esta clase al costructor de la clase padre
         * asignamos la funcion protected conexion a la variable conexion de la claset
         **/
        parent::__construct(Mesas::TABLA);
        $this->conexion= $this->conexion();
        
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
            $sql = "UPDATE ".Mesas::TABLA[0]." SET $atributo = '$valor' WHERE id_mesa = '$this->numero_mesa'"; 
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
            $sql="INSERT INTO ".Mesas::TABLA[0]." (ubicacionX, ubicacionY) VALUES ('$this->ubicacionX', '$this->ubicacionY')";
            $this->conexion->query($sql);
            $this->__set("numero_mesa", $this->conexion->insert_id);
        } catch (Exception $ex) {
            echo 'error '.$ex;
        }
        
    }
    
    // fin clase Mesas
}
