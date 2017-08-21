<?php 
	//optimize with loop
	if(!isset($_POST['name']) || empty($_POST['menu_name'])) {
	$errors[] = 'menu_name';

	}

	if(!isset($_POST['position']) || empty($_POST['position'])) {
	$errors[] = 'position';

	}

	if(!empty($errors)) {
		redirect_to("new_subject.php");

?>

<?php 
//my soultion
$error_array = $_POST['name','menu_name','visible']);
for ($i=0; $i < 3; $i++) { 
	if (!isset($error_array) || empty($error_array) {
		$errors[] = 'name','position','visible';
	}
	
}

//kevin solution
$required_fields = array('name','menu_name','visible');
foreach ($required_fields as $key => $fieldname) {
	if (isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
	$errors[] = $fieldname;
	}
}









?>