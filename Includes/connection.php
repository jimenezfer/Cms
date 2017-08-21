<?php   

require("constants.php");

//Connect to the db
$db = mysql_connect(DB_SERVER,DB_USER,DB_PASS);

if(!$db){
die("Conexion con la base de Datos Fallo  " . mysql_error());
}

//Select the db
$db_select = mysql_select_db(DB_NAME,$db);

if(!$db_select){
die("Selecion de la base de Datos Fallo  " . mysql_error());}

?>