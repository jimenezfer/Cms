<?php

$db = mysql_connect("localhost","root","Carlangas6&");
if(!$db){

	die("Conexion con la base de Datos Fallo  " . mysql_error());

}else{ echo "La conexion funciona <br /> <br />";}

$db_select = mysql_select_db("fox_corp",$db);

if(!$db_select){

	die("Selecion de la base de Datos Fallo  " . mysql_error());}

$result = mysql_query("SELECT * FROM jugadores",$db);
if(!$result){

	die("Error no hay resultados  " . mysql_error());

}

while ($row = mysql_fetch_array($result)) {

	echo $row[1]." ".$row[2]."<br />";
	# code...
}



?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 
 </body>
 </html>
<?php mysql_close($db); ?>