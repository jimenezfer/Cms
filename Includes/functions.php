<?php 
// Report error if query failed.
function confirm_query($result_set){

	if (!$result_set){
					die("Query Failed:" . mysql_error());
					 }
}

//Get all subjects availble 
function get_all_subjects(){

				global $db;
				$query = "SELECT * FROM subjects
						  ORDER BY position ASC";
				$subject_set = mysql_query($query,$db);
				confirm_query($subject_set);
				return $subject_set;
}

//Get all pages beloging to subject using subject_id which is in every page id.
function get_all_pages_subjects($subject_id){

				global $db;
				$query_pages = "SELECT * FROM pages 
					    WHERE subject_id = {$subject_id} 
					    ORDER BY position ASC";
				$page_set = mysql_query($query_pages, $db);
				confirm_query($page_set);
				return $page_set;
}


// Functions belonging to TOP LOOP that checks and makes the data available in the superglobal GET[].
//When link is click on subject,it gets a query result for all subjects, but display only 1 subject from the array.
function get_subject_by_id($subject_id){

	global $db;
	$query = "SELECT * ";
	$query .= "FROM subjects ";
	$query .= "WHERE id='" . $subject_id ."' ";
	$query .= "LIMIT 1";
	$result_set = mysql_query($query,$db);
	confirm_query($result_set);
	if($subject = mysql_fetch_array($result_set)){
	return $subject;

	}else{

	return NULL;

	}
}

//When a page link is clicked, it gets a query result for all pages, but displays only 1 page from the array.
function get_page_by_id($page_id){

	global $db;
	$query = "SELECT * ";
	$query .= "FROM pages ";
	$query .= "WHERE id='" . $page_id ."' ";
	$query .= "LIMIT 1";
	$result_set = mysql_query($query,$db);
	confirm_query($result_set);
	if($page = mysql_fetch_array($result_set)){
	return $page;

	}else{

	return NULL;

	}
 
}

function find_selected_page() {
global $sel_subject;
global $sel_page;
if (isset($_GET['subj'])) {
	$sel_subject = get_subject_by_id($_GET['subj']);
	$sel_page = NULL;
} elseif(isset($_GET['page'])){
	$sel_subject = NULL;
	$sel_page = get_page_by_id($_GET['page']);

	
}else{
 
	$sel_subject = NULL;
	$sel_page = NULL;
			
}

}


function navigation($sel_subject,$sel_page){

 $output = "<ul class=\"sujects\">"; 
//Fetch all subjects in an  array and set them inside $subject_set
$subject_set = get_all_subjects();


 		while ($subject = mysql_fetch_array($subject_set)) {
		 $output .= "<li";
		if($subject["id"] == $sel_subject['id']){
			$output .= "class=\"selected\"";
		} 
		$output .= "><p> </p><a href=\"edit_subject.php?subj=" . //creates dinamically generated link to sent array under subj handle to GET[].
		urlencode($subject['id']) . "\">{$subject["menu_name"]}</a></li>"; // urlencode to transform from array to string and some {inline subtitution}


 

//Fetch all pages in an  array and set them inside $page_set
$page_set = get_all_pages_subjects($subject["id"]);

				
		//Get array from $page_set and set inside $page
		while ($page = mysql_fetch_array($page_set)) {
		$output .= "<li";
		if ($page["id"] == $sel_page['id']) {
			$output .= " class=\"selected\"";
		}
		$output .= "><a href=\"content.php?page=" . //creates dinamically generated link to sent array under page handle to GET[].
		urldecode($page["id"]) . "\">{$page["menu_name"]}</a></li>"; // urlencode to transform from array to string and some {inline subtitution}
						}
				   
				    }
				
		return $output;
		}

function mysql_prep( $value ) {
$magic_quotes_active = get_magic_quotes_gpc();//is magic quotes active?
$new_enough_php = function_exists("mysql_real_escaped_string)");//new enough version of php
if($new_enough_php){
	// undo magic quote effect so mysql_real_escaped_string can proceed.
if ($magic_quotes_active){$value = stripslashes($value); }
$value =mysql_real_escape_string($value);
} else { // before php 4.3.0
		// if magic quotes arent already on then add slashes manually
if(!$magic_quotes_active){$value = addslashes( $value ); } 
		// if magic quote are active , then the slahes already exist
}
return $value;

}


// Redireccion 
function redirect_to( $Location = NULL ){
if($location) {
		header("Location: {$location}");
		exit;
	}

}

?> 



































