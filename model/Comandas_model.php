<?php

//use Comandas;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Comandas
 *
 * @author Luis Damian
 */
include_once 'Crud_model.php';
class Comandas extends Crud {
    //put your code here
    private $id_comanda;
    private $id_camarero;
    private $numero_mesa;
    private $conexion;
    const TABLA=["comandas", "id_comanda"];
    
    function __construct() {
        parent::__construct(Comandas::TABLA);
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
        // para acceder a una cosntante de la clase NombreClase::NOMBRECONSTANTE
        try {
            $sql="UPDATE ".Comandas::TABLA." SET $atributo = '$valor' WHERE id_comanda = '$this->id_comanda'";
            $this->conexion->query($sql);
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
         * asignamos el id del objeto = al ultimo id que añadimos a la bd, asi coincidiran el id objeto con tupla con insert_id
         *                                                 lista de atributos a introducir    valores de atributos a introducir
         * formato insertar datos INSERT INTO NombreTabla (NombreAtributo1, NombreAtributo2) VALUES (ValorAtributo1, ValorAtributo2)
         */
        // para acceder a una cosntante de la clase NombreClase::NOMBRECONSTANTE
        
        try {
            $sql="INSERT INTO ".Comandas::TABLA." (id_camarero, numero_mesa) VALUES ('$this->id_camarero', '$this->numero_mesa')";
            $this->conexion->query($sql);
            $this->__set("id_comanda",$this->conexion->insert_id);
        } catch (Exception $ex) {
            echo 'error '.$ex;
        }
        
    }

    //fin clase Comandas
    /**
     * asociar en bd con tablas 
     * recibe_cocinero
     * recibe_barman
     * comanda_plato
     * comanda_menu
     * comanda_bebida
     */
}

