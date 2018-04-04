<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); //Creates connection and selects Db ?>
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
    <form  action="create_page.php" method="post">
      <h2>Page name:
          <input type="text" name="menu_name" value=""  />
      </h2>
      <h2><p>Position:</p>
        <select  name="position">

        <option value="">1</option>

        </select>
      </h2>
      <h2>Contenido:
      <input type="text" name="content" value="" /></h2>
      <h2>Visible:

          <input type="radio" name="visible" value="0"  />No
          &nbsp;
          <input  type="radio" name="visible" value="1"  />Yes
          </br></br>
          <input type="submit" name="submit" value="Create Page"  />
          </br></br>
          <a href="content.php">Cancel</a>
      </h2>
  </form>
  </div>
<?php require("includes/footer.php"); ?>
