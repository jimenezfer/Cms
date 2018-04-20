<?php require_once("boilerplate.php"); ?>
<?php require_once("functions/functions.php"); ?>
<?php require_once("functions/validation_functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
//This function runs the loop checks and makes data gathered with fetch() available.
find_selected_page();

?>
<?php
  if (!$sel_subject){
    redirect_to("content.php");

  }
  ?>
<?php
if (isset($_POST['submit'])) {
	// Process the form

	// validations
	$required_fields = array("menu_name", "position", "visible");
	validate_presences($required_fields);

	$fields_with_max_lengths = array("menu_name" => 30);
	validate_max_lengths($fields_with_max_lengths);

	if (empty($errors)) {

		// Perform Update

		$id = $sel_subject["id"];
		$menu_name = mysql_prep($_POST["menu_name"]);
		$position = (int) $_POST["position"];
		$visible = (int) $_POST["visible"];

		$query  = "UPDATE subjects SET ";
		$query .= "menu_name = '{$menu_name}', ";
		$query .= "position = {$position}, ";
		$query .= "visible = {$visible} ";
		$query .= "WHERE id = {$id} ";
		$query .= "LIMIT 1";
		$result = mysqli_query($db, $query);

		if ($result && mysqli_affected_rows($db) >= 0) {
			// Success
			$_SESSION["message"] = "Subject updated.";
			redirect_to("content.php");
		} else {
			// Failure
			$_SESSION["message"] = "Subject update failed.";
			 echo "no no no no no no no no no no";
		}

	}
} else {
	// This is probably a GET request

} // end: if (isset($_POST['submit']))

?>

<?php require_once("includes/header.php"); ?>

<div>
  <div id="navigation">
    <?php echo navigation($sel_subject,$sel_page); ?>

  </div>

</div>
<?php // $message is just a variable, doesn't use the SESSION
			if (!empty($message)) {
				echo "<div class=\"message\">" . htmlentities($message) . "</div>";
			}
?>
<?php echo form_errors($errors); ?>
</div>
  <div class="forma">
    <form  action="edit_subject.php?subject=<?php echo urlencode($sel_subject["id"]); ?>" method="post">
        <h2>Edit Subject:<?php echo " ";?><?php echo $sel_subject["menu_name"]; ?></h2>
        <h2>Subject name:</h2>
          <input type="text" name="menu_name" value="<?php echo $sel_subject["menu_name"]; ?>"  />

      </h2>
      <h2><p>Position:</p>
        <select  name="position">
          <?php
          $subject_set = find_all_subjects();
          $subject_count = mysqli_num_rows($subject_set);
          for($count=1; $count <= $subject_count; $count++){
            echo "<option value=\"{$count}\"";
            if($sel_subject["position"] == $count){
             echo " selected";
            }
            echo ">{$count}</option>";
          }
          ?>
        </select>
      </h2>
      <h2>Visible:

          <input type="radio" name="visible" value="0" <?php if($sel_subject["visible"] == 0){echo "checked"; }  ?> />No
          &nbsp;
          <input  type="radio" name="visible" value="1" <?php if($sel_subject["visible"] == 1){echo "checked"; } ?> />Yes
          </br></br>
          <input type="submit" name="submit" value="Edit Subject"  />
          </br></br>
          <a href="content.php">Cancel</a>
          &nbsp;
          <a href="delete_content.php?subject=<?php echo urlencode($sel_subject["id"]); ?>">Delete Subject</a>
          &nbsp;
          <a href="new_page.php">New Page</a>

      </h2>

  </form>
  </div>
<?php require("includes/footer.php"); ?>
