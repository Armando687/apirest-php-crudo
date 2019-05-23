<?php
//var_dump($_SERVER);
//echo $_SERVER['REQUEST_METHOD'];
$metodo = $_SERVER['REQUEST_METHOD']; 
$mysqli = new mysqli("localhost","admin","admin","db_usuarios");
switch($metodo){
    case 'GET':
        if(!empty($_SERVER['PATH_INFO'])){
            $id = substr($_SERVER['PATH_INFO'],1);
            //echo $id; 
            if ($mysqli -> connect_errno)
            {
              printf("conexion fallida: %s\n", $mysqli->connect_error);
              exit();
            }else{
                $sql = "select * from usuarios where id = '".$id."'";
                if($result = $mysqli->query($sql)){
                    $fila = $result->fetch_assoc();
                    $json = json_encode($fila);
                    print($json);
                    $result -> close();
                }
            }
        }else{
            
            //Verbindung überprüfen
            if ($mysqli -> connect_errno)
            {
              printf("conexion fallida: %s\n", $mysqli->connect_error);
              exit();
            }else{
                $sql = "select * from usuarios";
                $collection = array();
                if($result = $mysqli->query($sql)){
                    while ( $fila = $result->fetch_assoc() ) {
                            $json = json_encode($fila);
                            array_push($collection,$json);
                    }
                    $result -> close();
                }
                
                print_r($collection);
                
            }

        }
        break;
    case 'POST':
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $password = $_POST['password'];
        if ($mysqli -> connect_errno)
            {
              printf("conexion fallida: %s\n", $mysqli->connect_error);
              exit();
            }else{
                $sql = "INSERT INTO  usuarios(nombre,correo,password) values('".$nombre."','".$correo."','".$password."')";
                //echo $sql;
                $result = $mysqli->prepare($sql);
                $result -> execute();
                $result -> store_result();
                if ($result->affected_rows == 1){
                    $json = [
                        'error' => '0',
                        'filas afectadas' => $mysqli ->affected_rows,
                        'mensaje' => 'Usuario insertado correctamente'
                    ];
                    print(json_encode($json));
                    $result -> close();
                }
            }
        break;
    case 'PUT':
        $json = [
            'error' => '1',
            'mensaje' => 'El sistema aun no cuenta con actualizaciones'
        ];
        print(json_encode($json));
        break;
    case 'DELETE':
        if(!empty($_SERVER['PATH_INFO'])){
            $id = substr($_SERVER['PATH_INFO'],1);
            //echo $id; 
            if ($mysqli -> connect_errno)
            {
              printf("conexion fallida: %s\n", $mysqli->connect_error);
              exit();
            }else{
                $sql = "DELETE FROM usuarios WHERE id = $id";
                //echo $sql;
                if ($mysqli->query($sql) === TRUE){
                    $json = [
                        'error' => '0',
                        'filas afectadas' => $mysqli ->affected_rows,
                        'mensaje' => 'Usuario Eliminado correctamente'
                    ];
                    print(json_encode($json));
                    $mysqli -> close();
                }else{
                    $json = [
                        'error' => $mysqli ->error,
                        'mensaje' => 'Falla al eliminar usuario'
                    ];
                    print(json_encode($json));
                    $mysqli -> close();
                }
            }
        }
        break;

}
?>