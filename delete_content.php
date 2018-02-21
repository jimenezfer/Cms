<?php require_once("includes/session.php"); ?>
<?php include_once("includes/connection.php"); //Creates connection and selects Db ?>
<?php require_once("includes/functions.php"); //Functions folder ?>
<?php include("includes/header.php"); ?>
<?php
$sel_subject = find_subject_by_id($_GET["subject"]);
if (!$sel_subject){
  redirect_to("content.php");

}

$id = $sel_subject["id"];
$query = "DELETE FROM subjects WHERE id = {$id} LIMIT 1";
$result = mysqli_query($db, $query);

if ($result && mysqli_affected_rows($db) == 1) {
  $_SESSION["message"] = "Subject updated";
} else {

$_SESSION["message"] = "Subject Deletetion Failed";
redirect_to("content.php");

}

?>
<?php require("includes/footer.php"); ?>
