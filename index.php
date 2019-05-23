<?php
var_dump($_SERVER);
echo $_SERVER['REQUEST_METHOD'];
switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
        echo  'llamada por';
        echo $_SERVER['QUERY_STRING'];
        echo $_SERVER['REQUEST_URI'];
        break;
    case 'POST':
        $nombre = $_POST['nombre'];
        echo $nombre;
        echo $_SERVER['QUERY_STRING'];
        //echo $_SERVER['REQUEST_URI'];
        break;
    case 'PUT':
        echo  'llamada por';
        echo $_SERVER['QUERY_STRING'];
        echo $_SERVER['REQUEST_URI'];
        break;
    case 'DELETE':
        echo  'llamada por';
        echo $_SERVER['QUERY_STRING'];
        echo $_SERVER['REQUEST_URI'];
        break;




}
?>