<?php  include_once("includes/connection.php"); //Creates connection and selects Db ?>
<?php include_once("includes/functions.php"); //Functions folder ?>
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
						<h2>Add a subject</h2>

<form action="create_subject.php" method="post">

<h2>Subject Name: <input type="text" name="menu_name" value="" id="menu_name"></h2>

<h2>Position: <select name="position">
<?php $subject_set = get_all_subjects();
	  $subject_count = mysql_num_rows($subject_set);
	  //subject_count +1 cuz I am adding one more subject.
	  for ($count=1; $count <= $subject_count+1; $count++) { 
	  	echo "<option value=\"{$count}\">{$count}</option>";
	  }
?>
	

</select>
</h2>

<h2>Visible: <input type="radio" name="visible" value="0"/>No
&nbsp;
<input type="radio" name="visible" value="1" />Yes

<input type="submit" value="Add Subject" name="" />

</h2>




</form>
<a href="content.php" ><h2>Cancel</h2></a>
	</td>
		</tr>
			</table>

<?php require("includes/footer.php"); ?>




	
