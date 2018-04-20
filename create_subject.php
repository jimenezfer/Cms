<?php require_once("boilerplate.php"); ?>
<?php require_once("functions/functions.php"); ?>
<?php require_once("functions/validation_functions.php"); ?>
<?php include("includes/header.php"); ?>
<?php

if (isset($_POST["submit"])){

$fields_with_max_lengths = array("menu_name => 30");
validate_max_lengths($fields_with_max_lengths);

$menu_name = mysql_prep($_POST["menu_name"]);
$position = (int) $_POST["position"];
$visible = (int) $_POST["visible"];

$required_fields = array("menu_name", "position", "visible");
validate_presences($required_fields);
}

if (!empty($errors)) {
   $_SESSION["errors"] = $errors;

}


      $query  = "INSERT INTO subjects(";
      $query .= " menu_name, position, visible";
      $query .= ") VALUES(";
      $query .= " '{$menu_name}', {$position}, {$visible}";
      $query .= ")";

      $result = mysqli_query($db, $query);

      if ($result){
         $_SESSION["message"] = "Subject Created!";
         redirect_to("content.php");

      } else {
         //failure , mysql rejected the query.
         $_SESSION["message"] = "<div id=\"confirmado\" >Subject Creation Failed!</div>";
         redirect_to("new_subject.php");
      }
      ?>

      <?php
      if (isset($db)) {
         mysqli_close($db);
                      }
      ?>
