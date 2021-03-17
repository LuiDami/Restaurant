<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Crud
 *
 * @author Luis Damian
 */
require_once 'Conexion_model.php';
abstract class Crud extends Conexion {
    //put your code here
    private $tabla;
    private $id;
    private $conexion;
    
    /**
     * Constructor
     * @param type $tabla
     */
    function __construct($tabla) {
        $this->conexion= $this->conexion();
        $this->tabla=$tabla[0];
        $this->id=$tabla[1];
    }

    /**----------------------metodos abstractos que se implementarán en otras clases------------ */
    /**
     * para crear una nueva tupla
     */
    abstract function crear();

    /**
     * para cambiar atributo de una tupla
     */
    abstract function actualizar($atributo, $valor);//mo usar
    


    /**-------------------------------Metodos comunes de las clases----------------------------- */
    /**
     * retorna un array de objetos con los datos de la BD actual
     * @return type
     */
    function obtieneTodos(){
        /**
         * guardamos la consulta en $sql obtiene todos las tuplas de la tabla
         * ejecutamos la consulta en php obtenemos una tabla con los resultados
         * en el for convertimos a cada tupla en un objeto y añadimos al array $objetos uno a uno
         * retornamos un array con todas las tuplas como objetos
         */
        try {
            $sql="SELECT * FROM $this->tabla";
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
     * obtiene consulta paginada
     * $numero_paguina: 
     * si el $tamaño paguina es de 10 y hay 100 tuplas totales 
     * habra 10 paginas con 10 tuplas cada una, 
     * pues el $numero_paguina es en que paguina nos encontramos 
     * si estos tubiesen un orden del 1 al 10 en este ejemplo
     * 
     * $tamaño_paguina: cuantas tuplas mostrara en total
     * 
     * @param type $numero_paguina
     * @param type $tamaño_paguina
     */
    function obtienePaginado($numero_paguina, $tamaño_paguina){
        /**
         * funciona correctamente 08/11/2020
         */
        try {
            /**dejamos esta parte de codigo pero no se usa */
            // $sql_total="SELECT * FROM $this->tabla";
            // $resultado_total=$this->conexion->query($sql_total);
            // $numero_filas=$resultado_total->num_rows;

            /**
             * calculamos el la tupla de inicio de cada paguina
             * guardamos la consulta en $sql obtiene todos las tuplas de la tabla
             * en el for convertimos a cada tupla en un objeto y añadimos al array $objetos uno a uno
             * retornamos un array con todas las tuplas como objetos
             */
            $empezar_desde=($numero_paguina-1)*$tamaño_paguina;
            $sql="SELECT * FROM $this->tabla LIMIT $empezar_desde,$tamaño_paguina";
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
            echo 'error en '.$ex;
        }
        
    }
    
    /**
     * obtiene los datos de una tupla por si id
     * @param type $id
     */
    function obtieneDeID($id){
        /**
         * guardamos la consulta en $sql obtiene tupla del id indicado
         * ejecutamos la consulta en php
         * guardamos los datos de la consulta como un array en $salida
         * retornamos $salida
         *                       atributos que se muostrara           que tuplas mostradas segun la condicion
         * formato sql consulta SELEC NombreAtributo FROM NombreTabla WHERE NombreAtrubuto = ValorAtributo
         */
        try {
             $sql="SELECT * FROM $this->tabla WHERE $this->id like '$id'";
            $resultado=$this->conexion->query($sql);
            $salida = $resultado->fetch_object();
            return $salida;
        } catch (Exception $ex) {
            echo 'error '.$ex;
        }
        
        
    }
    /**
     * obtenemos la cantidad de tuplas que hay de un valor especifico
     * @param type $clave
     * @param type $valor
     */
    function obtenerCantidadValor($clave, $valor){
        /**
         * guardamos la consulta en $sql obtiene tupla del id indicado
         * ejecutamos la consulta en php
         * guardamos los datos de la consulta como un array en $salida
         * retornamos $salida
         *                       atributos que se muostrara           que tuplas mostradas segun la condicion
         * formato sql consulta SELEC NombreAtributo FROM NombreTabla WHERE NombreAtrubuto = ValorAtributo
         */
        try {
             $sql="SELECT * FROM $this->tabla WHERE $clave like '$valor'";
            $resultado=$this->conexion->query($sql);
            $salida = $resultado->num_rows;
            return $salida;
        } catch (Exception $ex) {
            echo 'error '.$ex;
        }
        
        
    }
    /**
     * obtenemos las tuplas que hay de un valor especifico
     * @param type $clave
     * @param type $valor
     */
    function obtenerClaveValor($clave, $valor){
        /**
         * guardamos la consulta en $sql obtiene tupla del id indicado
         * ejecutamos la consulta en php
         * guardamos los datos de la consulta como un array en $salida
         * retornamos $salida
         *                       atributos que se muostrara           que tuplas mostradas segun la condicion
         * formato sql consulta SELEC NombreAtributo FROM NombreTabla WHERE NombreAtrubuto = ValorAtributo
         */
        try {
             $sql="SELECT * FROM $this->tabla WHERE $clave like '$valor'";
            $resultado=$this->conexion->query($sql);
            $salida = $resultado->fetch_object();
            return $salida;
        } catch (Exception $ex) {
            echo 'error '.$ex;
        }
        
        
    }

    /**
     * retorna el numero de tuplas existendes en una tabla
     * @return type
     */
    function obtenerCantidadTodos(){
        /**
         * guardamos la consulta en $sql obtiene todos las tuplas de la tabla
         * ejecutamos la consulta en php obtenemos una tabla con los resultados
         * en el for convertimos a cada tupla en un objeto y añadimos al array $objetos uno a uno
         * retornamos un array con todas las tuplas como objetos
         */
        try {
            $sql="SELECT * FROM $this->tabla";
            $resultado=$this->conexion->query($sql);
            $salida=$resultado->num_rows;
            return $salida;
        } catch (Exception $ex) {
            echo 'error '.$ex;
        }
    }

    /**
     * Cambia el valor de un parametro existente
     * @param type $id
     * @param type $atributo
     * @param type $valor
     */
    public function cambia_x_id($id, $atributo, $valor) {
        /**
         * guardamos la consulta en $sql
         * ejecutamos la consulta en php el cambio en la BD
         * realizamos el cambio del valor del atributo en la clase
         *                                              atributo a cambiar          que tuplas cambias segun la condicion
         * formato actualizar UPDATE NombreTabla SET NombreAtributo = ValorAtributo WHERE NombreAtributo = ValorAtributo
        */
        
        try {
            $sql = "UPDATE ".  $this->tabla." SET $atributo = '$valor' WHERE $this->id = '$id'"; 
            $this->conexion->query($sql);
        } catch (Exception $ex) {
            echo 'error '.$ex;
        }
        
    }

    /**
     * borra los datos de una tupla por su id
     * @param type $id
     */
    function borrar($id){
        /**
         * guardamos la consulta en $sql borra tupla del id indicado
         * ejecutamos la consulta en php
         *                                                  que tuplas borrar segun la condicion
         * formato sql borrar datos DELETE FROM NombreTabla WHERE NombreAtributo = ValorAtributo
         */
        try {
            $sql="DELETE FROM $this->tabla WHERE $this->id like '$id'";
            $this->conexion->query($sql);
        } catch (Exception $ex) {
            echo 'error '.$ex;
        }
        
        
    }




    /**----------------------------funciones para realizar una consulta desde fuera----------------------------- */
    /**
     * retorna consulta definida
     * @param type $sql
     * @return type
     */
    function consulta($sql){
        
        try {
            $resultado = $this->conexion->query($sql);
            return $resultado;
        } catch (Exception $ex) {
            echo 'error '.$ex;
        }
        
    }/**
     * retorna la conexion
     * @return type
     */
    function retorna_conexion(){
        try {
            return $this->conexion;
        } catch (Exception $ex) {
            echo 'error '.$ex;
        }
        
    }
    

    

    
}
?>