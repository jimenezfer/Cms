<?php require_once("includes/session.php"); ?>
<?php include_once("includes/connection.php"); //Creates connection and selects Db ?>
<?php require_once("includes/functions.php"); //Functions folder ?>
<?php require_once("includes/validation_functions.php"); //Functions folder ?>
<?php include("includes/header.php"); ?>
<?php
//This function runs the loop checks and makes data gathered with fetch() available.
find_selected_page();
?>
<div>
  <div id="navigation">
		<?php echo navigation($sel_subject, $sel_page); ?>
		<br />
		<a href="new_subject.php">+ Add a subject</a>
  </div>

  <div id="page">
		<?php if ($sel_subject) { ?>
	    <h2>Manage Subject</h2>
			Menu name: <?php echo $sel_subject["menu_name"]; ?><br />


		<?php } elseif ($sel_page) { ?>
			<h2>Manage Page</h2>
			Menu name: <?php echo $sel_page["menu_name"]; ?><br />

		<?php } else { ?>
		 <h2 id="titulo">Welcome, Please Select a Subject</h2>
		<?php }?>
  </div>
</div>

<?php require("includes/footer.php"); ?>
