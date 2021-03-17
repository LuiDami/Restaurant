<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bebidas
 *
 * @author Luis Damian
 */
include_once 'Crud_model.php';
class Bebidas extends Crud {
    //put your code here
    private $id_bebida;
    private $nombre;
    private $descripcion;
    private $tipo;
    private $estado;
    private $foto;
    private $conexion;
    const TABLA=["bebidas", "id_bebida"];
    
    /**
     * Constructor de clase
     */
    function __construct() {
        /*pasamos como parametro la constante TABLA de esta clase al costructor de la clase padre
         * asignamos la funcion protected conexion a la variable conexion de la claset
         **/
        parent::__construct(Bebidas::TABLA);
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
            $sql = "UPDATE ".Bebidas::TABLA[0]." SET $atributo = '$valor' WHERE id_bebida = '$this->id_bebida'"; 
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
            $sql="INSERT INTO ".Bebidas::TABLA[0]." (nombre, descripcion, tipo, estado, foto) VALUES ('$this->nombre', '$this->descripcion', '$this->tipo', '$this->estado', '$this->foto')";
            $this->conexion->query($sql);
            $this->__set("id_bebida", $this->conexion->insert_id);
        } catch (Exception $ex) {
            echo 'error '.$ex;
        }
        
    }

    /**
     * Metodo obtiene las bebidas con tipo zumo refresco_con_gas refresco_sin_gas
     * si pones 0 como parametro retornara los inactivos
     * si no pones nada retornara los activos
     * @param type $valor
     */
    function obtiene_bebidas_menu($valor=1){
        /**
         * guardamos la consulta en $sql obtiene todos las tuplas de la tabla
         * ejecutamos la consulta en php obtenemos una tabla con los resultados
         * en el for convertimos a cada tupla en un objeto y añadimos al array $objetos uno a uno
         * retornamos un array con todas las tuplas como objetos
         */
        try {
            $sql="SELECT * FROM ".Bebidas::TABLA[0]." WHERE tipo = 'zumo' and estado = $valor or tipo = 'refresco_con_gas' and estado = $valor or tipo = 'refresco_sin_gas' and estado = $valor";
            $resultado=$this->conexion->query($sql);
            $objetos=array();

            while ($fila=$resultado->fetch_object()){
                $objetos[]=$fila;
                //echo 'fila = '.  var_dump($fila);
            }

            /*
            for($x=0;$x<$resultado->field_count;$x++){
                $objetos[$x]=$resultado[$x]->fetch_object();
            }*/
            return $objetos;
        } catch (Exception $ex) {
            echo 'error '.$ex;
        }
        
        
    }

    /**
     * Metodo obtiene las bebidas menos las vevidas que estan ya en el menu con tipo zumo refresco_con_gas refresco_sin_gas
     * si pones 0 como parametro retornara los inactivos
     * si no pones nada retornara los activos
     * @param type $valor
     */
    function obtiene_bebidas_menu_menos_menu($id_menu, $valor=1){
        /**
         * guardamos la consulta en $sql obtiene todos las tuplas de la tabla
         * ejecutamos la consulta en php obtenemos una tabla con los resultados
         * en el for convertimos a cada tupla en un objeto y añadimos al array $objetos uno a uno
         * retornamos un array con todas las tuplas como objetos
         */
        try {
            $sql="SELECT * FROM ".Bebidas::TABLA[0]." WHERE (tipo = 'zumo' or tipo = 'refresco_con_gas' or tipo = 'refresco_sin_gas') and estado = $valor && id_bebida NOT IN (SELECT id_bebida FROM `menu_bebida` WHERE id_menu=$id_menu)";
            $resultado=$this->conexion->query($sql);
            $objetos=array();

            while ($fila=$resultado->fetch_object()){
                $objetos[]=$fila;
                //echo 'fila = '.  var_dump($fila);
            }

            /*
            for($x=0;$x<$resultado->field_count;$x++){
                $objetos[$x]=$resultado[$x]->fetch_object();
            }*/
            return $objetos;
        } catch (Exception $ex) {
            echo 'error '.$ex;
        }
        
        
    }
    
    // fin clase Bebidas
}
