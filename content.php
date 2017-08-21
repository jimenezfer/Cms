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
						  <ul class="subjects">	
<?php echo navigation($sel_subject,$sel_page);
//Fetch all subjects in an  array and set them inside $subject_set
/*$subject_set = get_all_subjects();


		//Get array from $subject_set and set inside $subject
		while ($subject = mysql_fetch_array($subject_set)) {
		echo "<li";
		if($subject["id"] == $sel_subject['id']){
			echo " class=\"selected\"";
		} 
		echo "><p> </p><a href=\"content.php?subj=" . //creates dinamically generated link to sent array under subj handle to GET[].
	urlencode($subject['id']) . "\">{$subject["menu_name"]}</a></li>"; // urlencode to transform from array to string and concatenate {inline subtitution}




//Fetch all pages in an  array and set them inside $page_set
$page_set = get_all_pages_subjects($subject["id"]);

				
		//Get array from $page_set and set inside $page
		while ($page = mysql_fetch_array($page_set)) {
		echo "<li";
		if ($page["id"] == $sel_page['id']) {
			echo " class=\"selected\"";
		}
		echo "><a href=\"content.php?page=" . //creates dinamically generated link to sent array under page handle to GET[].
		urldecode($page["id"]) . "\">{$page["menu_name"]}</a></li>"; // urlencode to transform from array to string and some {inline subtitution}
												 }
										}
						    ?>
						    </ul>*/?>
						<br />
						<a href="new_subject.php">+ Add a new subject</a>
					</td>
					<td id="page">

	<?php if (!is_null($sel_subject)){ //subject selected ?>
		<h2>Subject Selected<?php echo "<br/><br/>";  echo $sel_subject['menu_name']; echo "<br/><br/>";  ?></h2><!--Do this if subject has been selected-->
		
	<?php } elseif (!is_null($sel_page)) { //page selected ?>
		<h2>Page Selected<?php echo "<br/><br/>";  echo $sel_page['menu_name']; echo "<br/><br/>"; ?></h2><!--Do this if page has been selected -->
		
	<?php } else {// nothing selected  ?>
		<h2>Nothing Selected  <?php echo "<br/><br/>"; ?> Duuuuuuuude!</h2><!--Do this if nothing selected -->
	<?php } ?>

	
				</td>		
				</tr>
			</table>

<?php require("includes/footer.php"); ?>




	
