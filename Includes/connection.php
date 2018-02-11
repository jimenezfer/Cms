<?php

require("constants.php");

//Connect to the db
$db = mysqli_connect(DB_SERVER,DB_USER,DB_PASS);

if(!$db){
die("Conexion con la base de Datos Fallo  " . mysqli_error());
}

//Select the db
$db_select = mysqli_select_db($db, DB_NAME);

if(!$db_select){
die("Selecion de la base de Datos Fallo  " . mysqli_error());}

?>
