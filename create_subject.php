<?php  include_once("includes/connection.php"); //Creates connection and selects Db ?>
<?php include_once("includes/functions.php"); //Functions folder ?>
<?php

	//Form Validation, make sure not empty and that is set.
$errors = array();
$required_fields = array('name','menu_name','visible');
foreach ($required_fields as $key => $fieldname) {
	if (isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
	$errors[] = $fieldname;
	}
}

// Not longer than 30 characters since it may break the code.
$field_with_names = array('menu_name' => 30);
foreach($fields_with_lenghts as $fieldname => $maxlenght ) {
	if (strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlenght) {
		$errors[] = $fieldname;
	}
}


if(empty($errors)) {

$id = mysql_prep($_GET['subj'];
$menu_name = mysql_prep($_POST['menu_name']);
$position = mysql_prep($_POST['position']);
$visible = mysql_prep($_POST['visible']);




	} else {

		// Errors occured
	}




?>
<?php

	$query = "INSERT INTO subjects (
			menu_name, position, visible
			) VALUES (
			'{$menu_name}',{$position},{$visible}
			)";
			$result = mysql_query($query, $db);
			if($result){
				//Sucess!!
				header("Location: content.php");
				exit;
			}else{
				//Display Error
				echo "<p>Subject Creation Error</p>";
				echo "<p>" . mysql_error() . "</p>";

			}
?>
<?php mysql_close($db); ?>