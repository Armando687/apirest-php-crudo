<?php
class ConnectionController{
    public $link;
    public $conexion;
    function __construct(){
        $link=mysql_connect("localhost","admin","admin")or die("error en la conexion");
        $conexion=mysql_select_db("db_usuarios");
        dd($conexion);
    }
    /**
     * Metodo que saca todos los datos existentes en base de datos
     */
    public function getAll(){
        $sql = "select * from usuarios";
        $query = mysql_query($sql,$this->$link);
        return $query;
    }
    /**
     * Metodo para buscar datos por id
     * @param string|null $id user id
     */
    public function getFindById($id = null){
        $sql = "select * from usuarios where id = '".$id."'";
        $query = mysql_query($sql,$this->$link);
        return $query;
    }
    /**
     * Metodo para insertar usuarios
     * @param string $nombre
     * @param string $correo
     * @param string $password
     */
    public function add($nombre,$correo,$password){
        $sql = "insert into usuarios values('',".$nombre."','".$correo."','".$password."')";
        $query = mysql_query($sql,$this->$link);
        if($query){return true;}
        else {return false;}
    }
    /**
     * Metodo para editar un dato
     * @param string|null $id user id
     * @param string $nombre
     * @param string $correo
     * @param string $password
     */
    public function edit($id = null,$nombre,$correo,$password){
        if($nombre != ''){
            $sql = "update usuarios set nombre = '".$nombre."' where id = '".$id."'" ;  

        }
        if($correo != ''){
            $sql = "update usuarios set correo = '".$correo."' where id = '".$id."'" ;  
              
        }
        if($password != ''){
            $sql = "update usuarios set password = '".$password."' where id = '".$id."'" ;  
              
        }
        if($nombre != '' && $correo != ''){
            $sql = "update usuarios set nombre = '".$nombre."',correo = '".$correo."' where id = '".$id."'" ;  
              
        }
        if($nombre != '' && $password != ''){
            $sql = "update usuarios set nombre = '".$nombre."',password = '".$password."' where id = '".$id."'" ;  
              
        }
        if($password != '' && $correo != ''){
            $sql = "update usuarios set password = '".$password."',correo = '".$correo."' where id = '".$id."'" ;  
              
        }
        if($nombre != '' && $correo != '' && $password != ''){
            $sql = "update usuarios set nombre = '".$nombre."',correo = '".$correo."', password = '".$password."' where id = '".$id."'" ;  
              
        }
        $query = mysql_query($sql,$this->$link);
        if($query){return true;}
        else {return false;}
    }
    /**
     * Medoto para eliminar un dato
     * @param string|null $id user id
     */
    public function delete($id = null){
        $sql = "delete from usuarios where id = '".$id."'";
        $query = mysql_query($sql,$this->$link);
        if($query){return true;}
        else {return false;}
    }
}

?>
