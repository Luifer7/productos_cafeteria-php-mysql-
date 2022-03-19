



<?php

$host="localhost";
$bd="konecta";
$usuario="root";
$password="";

try {
    $conexion=new PDO("mysql:host=$host;dbname=$bd",$usuario,$password);
    if ($conexion) { }

}catch ( Exception $ex) {
    echo $ex->getMessage();
    echo "FATALLLITII";
}


?>