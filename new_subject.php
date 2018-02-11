<?php  require_once("includes/session.php"); ?>
<?php  require_once("includes/connection.php"); //Creates connection and selects Db ?>
<?php require_once("includes/functions.php"); //Functions folder ?>
<?php include("includes/header.php"); ?>
<?php
//This function runs the loop checks and makes data gathered with fetch() available.
find_selected_page();
?>
<div id="mail">
  <div id="navigation">
    <?php echo navigation($sel_subject,$sel_page); ?>
  </div>
</div>
  <div class="forma">
    <form  action="create_subject.php" method="post">
      <h2 >Subject name:
          <input type="text" name="menu_name" value=""  />
      </h2>
      <h2 ><p>Position:</p>
        <select  name="position">
          <?php
          $subject_set = find_all_subjects();
          $subject_count = mysqli_num_rows($subject_set);
          for($count=1; $count <= ($subject_count + 1); $count++){
            echo "<option value=\"{$count}\">{$count}</option>";
          }
          ?>
        </select>
      </h2>
      <h2>Visible:

          <input type="radio" name="visible" value="0"  />No
          &nbsp;
          <input  type="radio" name="visible" value="1"  />Yes
          </br></br>
          <input type="submit" name="submit" value="Create Subject"  />
          </br></br>
          <a href="content.php">Cancel</a>
      </h2>
  </form>
  </div>
<?php require("includes/footer.php"); ?>
