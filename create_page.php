<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); //Creates connection and selects Db ?>
<?php require_once("includes/functions.php"); //Functions folder ?>
<?php require_once("includes/validation_functions.php"); ?>
<?php

if (isset($_POST["submit"])){

$menu_name = mysql_prep($_POST["menu_name"]);
$position = (int) $_POST["position"];
$visible = (int) $_POST["visible"];
$content = $_POST["content"];

$required_fields = array("menu_name", "position", "visible", "content");
validate_presences($required_fields);

$fields_with_max_lengths = array("menu_name => 30");
validate_max_lengths($fields_with_max_lengths);
echo errors();
}

if (!empty($errors)) {
   $_SESSION["errors"] = $errors;
   echo "Not empty of errors";


}


      $query  = "INSERT INTO pages (";
      $query .= "menu_name, subject_id, visible, content";
      $query .= ") VALUES(";
      $query .= " \"{$menu_name}\", {$position}, {$visible}, \"{$content}\"";
      $query .= ")";

      $result = mysqli_query($db, $query);

      if ($result){
         $_SESSION["message"] = "Page Created!";
         redirect_to("edit_subject.php");

      } else {
         //failure , mysql rejected the query.
         $_SESSION["message"] = "<div id=\"confirmado\" >Page Creation Failed! Ah Shit!</div>";
         redirect_to("brasta.php");
      }
      ?>

      <?php
         if (isset($db)) {
               mysqli_close($db);
                         }
       ?>
