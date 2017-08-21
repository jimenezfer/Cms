<?php  include_once("includes/connection.php"); //Creates connection and selects Db ?>
<?php include_once("includes/functions.php"); //Functions folder ?>
<?php 

if(intval($_GET['subj']) == 0) {

	redirect_to("content.php");
}

if (isset($_POST['submit'])) {

$errors = array();

$required_fields = array('menu_name','position','visible');
foreach ($required_fields as $key => $fieldname) {
	if (isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
	$errors[] = $fieldname;
	}
}


$fields_with_lenghts = array('menu_name' => 30);
foreach($fields_with_lenghts as $fieldname => $maxlenght ) {
	if (strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlenght ) {
		$errors[] = $fieldname; }

}				
		if(empty($errors)){
				$id = mysql_prep($_GET['subj']);
				$menu_name = mysql_prep($_POST['menu_name']);
				$position = mysql_prep($_POST['position']);
				$visible = mysql_prep($_POST['visible']);

				$query = "UPDATE subjects SET 
				menu_name = '{$menu_name}',
				position = '{$position}',
			    visible = '{$visible}' WHERE id = {$id}";

			    $result = mysql_query($query, $db);
			    if (mysql_affected_rows() == 1) {
			    	# code...
			    }else{


			    }
			
}

?>
<?php

//This function runs the loop checks and makes data gathered with fetch() available.
find_selected_page();

?>
<?php include("includes/header.php"); ?>
<table id="structure">
	<tr>
	  <td id="navigation">
<?php echo navigation($sel_subject,$sel_page); ?>		
	 </td>
	 		<td id="page">
<h2>Edit subject:</br></br><?php echo $sel_subject['menu_name']; ?></h2>

<form action="edit_subject.php?subj=<?php echo urlencode($sel_subject['id']); ?>" method="post" >

<h2>Subject Name: <input type="text" name="menu_name" value="<?php echo $sel_subject['menu_name']; ?>" id="menu_name" ></h2>

<h2>Position: <select name="position">

<?php $subject_set = get_all_subjects();
	  $subject_count = mysql_num_rows($subject_set);
	  //subject_count +1 cuz I am adding one more subject.
	  for ($count=1; $count <= $subject_count+1; $count++) { 
	  	echo "<option value=\"{$count}\"";
	  	if ($sel_subject['position'] == $count) {
	  	 echo " selected";
	  	}
	  	echo ">{$count}</option>";
	  }
?>
	

</select>
</h2>

<h2>Visible:</br> <input type="radio" name="visible" value="0" <?php if ($sel_subject['visible'] = 0) {
	echo " checked";
} ?> />No
&nbsp;
<input type="radio" name="visible" value="1" <?php if ($sel_subject['visible'] = 1) {
	echo " checked";
} ?> />Yes

<input type="submit" value="Edit Subject" name="submit" />

</h2>




</form>
<a href="content.php" ><h2>Cancel</h2></a>
	</td>
		</tr>
			</table>

<?php require("includes/footer.php"); ?>