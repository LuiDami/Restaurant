<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Trabajadores
 *
 * @author Luis Damian
 */
include_once 'Crud_model.php';
class Trabajadores extends Crud {
    private $dni;
    private $usuario;
    private $contraseña;
    private $nombre;
    private $apellido;
    private $foto;
    private $conexion;
    const TABLA=["trabajadores", "dni"]; // declaramos una constante en clase
    /**
     * Constructor de clase
     */
    function __construct() {
        /*pasamos como parametro la constante TABLA de esta clase al costructor de la clase padre
         * asignamos la funcion protected conexion a la variable conexion de la clase
         **/
        parent::__construct(Trabajadores::TABLA);
        $this->conexion= $this->conexion();
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
            $sql = "UPDATE ".Trabajadores::TABLA[0]." SET $atributo = '$valor' WHERE dni = '$this->dni'"; 
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
         * ejecutamos la consulta en php clase
         *                                                 lista de atributos a introducir    valores de atributos a introducir
         * formato insertar datos INSERT INTO NombreTabla (NombreAtributo1, NombreAtributo2) VALUES (ValorAtributo1, ValorAtributo2)
         */
        // para acceder a una cosntante de la clase NombreClase::NOMBRECONSTANTE
        try {
           $sql="INSERT INTO ".Trabajadores::TABLA[0]." (`dni`, `usuario`, `contraseña`, `nombre`, `apellido`, `foto`) VALUES ('$this->dni', '$this->usuario', '".md5($this->contraseña)."', '$this->nombre', '$this->apellido', '$this->foto');";
           //$sql2="UPDATE `trabajadores` SET `contraseña` = '".md5(Aa123456)."' WHERE `trabajadores`.`dni` = '05955868H'";
           //con el de arriba cambiamos la contraseña de un trabajador
            $this->conexion->query($sql);
        } catch (Exception $ex) {
            echo 'error '.$ex;
        }
        
    }

    /**
     * esta funcion comprueba en la bd si el usuario y la contraseña existen y coinciden
     * @param type $user
     * @param type $password
     */
    function comprobar_logueado($user, $password){
        /**
         * retornara si coninside el usuario con la contraseña
         */
        $sql = "SELECT * FROM ".Trabajadores::TABLA[0]." WHERE usuario = BINARY '$user' AND contraseña = '".md5($password)."'";
        /**
         * se realiza la busqueda en la tabla
         */
        $resultado = $this->conexion->query($sql);
        //$this->conexion->set_charset("utf8");
        /**
         * retornamos informacion requerida
         */
        return $resultado;
    }

    function obtener_trabajador_por_user($user){
        $sql= "SELECT * FROM ".Trabajadores::TABLA[0]." WHERE usuario = '$user'";
        $resultado = $this->conexion->query($sql);
        $salida = $resultado->fetch_object();
        return $salida;
    }

    /**
     * permite cambiar la contraseña
     * @param type $dni
     * @param type $password
     */
    function cambia_contraseña($dni, $password){
        $sql = "UPDATE ".Trabajadores::TABLA[0]." SET contraseña = '".md5($password)."' WHERE dni = '$dni'"; 
        $this->conexion->query($sql);
    }


    

 //fin clase Trabajadores
}
