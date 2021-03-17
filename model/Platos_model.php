<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Platos
 *
 * @author Luis Damian
 */
include_once 'Crud_model.php';
class Platos extends Crud {
    //put your code here
    private $id_plato="sindefinir";
    private $nombre;
    private $descripcion;
    private $receta;
    private $foto;
    private $estado;
    private $tipo;
    private $conexion;
    const TABLA=["platos", "id_plato"];
    // "platos";
    // const ID="id_plato";
    
    /**
     * Constructor de clase
     */
    function __construct() {
        /*pasamos como parametro la constante TABLA de esta clase al costructor de la clase padre
         * asignamos la funcion protected conexion a la variable conexion de la claset
         **/
        parent::__construct(Platos::TABLA);
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
            $sql = "UPDATE ".Platos::TABLA[0]." SET $atributo = '$valor' WHERE id_plato = '$this->id_plato'"; 
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
            $sql="INSERT INTO ".Platos::TABLA[0]." (nombre, tipo, descripcion, receta, estado, foto) VALUES ('$this->nombre', '$this->tipo', '$this->descripcion', '$this->receta', '$this->estado',  '$this->foto')";
            //echo $sql;
            $this->conexion->query($sql);
            $this->__set("id_plato", $this->conexion->insert_id);
        } catch (Exception $ex) {
            echo 'error '.$ex;
        }
        
    }

    /**
     * Metodo obtiene los platos con tipo primero
     * si pones 0 como parametro retornara los inactivos
     * si no pones nada retornara los activos
     * @param type $valor
     */
    function obtiene_primeros($valor=1){
        /**
         * guardamos la consulta en $sql obtiene todos las tuplas de la tabla
         * ejecutamos la consulta en php obtenemos una tabla con los resultados
         * en el for convertimos a cada tupla en un objeto y añadimos al array $objetos uno a uno
         * retornamos un array con todas las tuplas como objetos
         */
        try {
            $sql="SELECT * FROM ".Platos::TABLA[0]." WHERE tipo = 'primero' and estado = $valor";
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

    function obtiene_primeros_menos_menu($id_menu, $valor=1){
        /**
         * guardamos la consulta en $sql obtiene todos las tuplas de la tabla
         * ejecutamos la consulta en php obtenemos una tabla con los resultados
         * en el for convertimos a cada tupla en un objeto y añadimos al array $objetos uno a uno
         * retornamos un array con todas las tuplas como objetos
         */
        try {
            $sql="SELECT * FROM ".Platos::TABLA[0]." WHERE tipo = 'primero' and estado = $valor && id_plato NOT IN (SELECT id_plato FROM `menu_plato` WHERE id_menu=$id_menu)";
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
     * Metodo obtiene los platos con tipo segundo
     * si pones 0 como parametro retornara los inactivos
     * si no pones nada retornara los activos
     * @param type $valor
     */
    function obtiene_segundos($valor=1){
        /**
         * guardamos la consulta en $sql obtiene todos las tuplas de la tabla
         * ejecutamos la consulta en php obtenemos una tabla con los resultados
         * en el for convertimos a cada tupla en un objeto y añadimos al array $objetos uno a uno
         * retornamos un array con todas las tuplas como objetos
         */
        try {
            $sql="SELECT * FROM ".Platos::TABLA[0]." WHERE tipo = 'segundo' and estado = $valor";
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
     * Metodo obtiene los platos con tipo segundo
     * si pones 0 como parametro retornara los inactivos
     * si no pones nada retornara los activos
     * @param type $valor
     */
    function obtiene_segundos_menos_menu($id_menu, $valor=1){
        /**
         * guardamos la consulta en $sql obtiene todos las tuplas de la tabla
         * ejecutamos la consulta en php obtenemos una tabla con los resultados
         * en el for convertimos a cada tupla en un objeto y añadimos al array $objetos uno a uno
         * retornamos un array con todas las tuplas como objetos
         */
        try {
            $sql="SELECT * FROM ".Platos::TABLA[0]." WHERE tipo = 'segundo' and estado = $valor && id_plato NOT IN (SELECT id_plato FROM `menu_plato` WHERE id_menu=$id_menu)";
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
     * Metodo obtiene los platos con tipo postre
     * si pones 0 como parametro retornara los inactivos
     * si no pones nada retornara los activos
     * @param type $valor
     */
    function obtiene_postres($valor=1){
        /**
         * guardamos la consulta en $sql obtiene todos las tuplas de la tabla
         * ejecutamos la consulta en php obtenemos una tabla con los resultados
         * en el for convertimos a cada tupla en un objeto y añadimos al array $objetos uno a uno
         * retornamos un array con todas las tuplas como objetos
         */
        try {
            $sql="SELECT * FROM ".Platos::TABLA[0]." WHERE tipo = 'postre' and estado = $valor";
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
     * Metodo obtiene los platos con tipo postre que no esten incluidos en el menu
     * si pones 0 como parametro retornara los inactivos
     * si no pones nada retornara los activos
     * @param type $valor
     */
    function obtiene_postres_menos_menu($id_menu, $valor=1){
        /**
         * guardamos la consulta en $sql obtiene todos las tuplas de la tabla
         * ejecutamos la consulta en php obtenemos una tabla con los resultados
         * en el for convertimos a cada tupla en un objeto y añadimos al array $objetos uno a uno
         * retornamos un array con todas las tuplas como objetos
         */
        try {
            $sql="SELECT * FROM ".Platos::TABLA[0]." WHERE tipo = 'postre' and estado = $valor && id_plato NOT IN (SELECT id_plato FROM `menu_plato` WHERE id_menu=$id_menu)";
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
    
    // fin clase Platos
}
