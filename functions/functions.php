<?php

	function redirect_to($new_location) {
	  header("Location: " . $new_location);
	  exit;
	}

	function mysql_prep($string) {
		global $db;
    $escaped_string = mysqli_real_escape_string($db, $string);
		return $escaped_string;
	}

	function confirm_query($result_set) {
		if (!$result_set) {
			die("Database query failed.");
		}
	}


	function find_all_subjects() {
		global $db;

		$query  = "SELECT * ";
		$query .= "FROM subjects ";
		// $query .= "WHERE visible = 1 ";
		$query .= "ORDER BY position ASC";
		$subject_set = mysqli_query($db, $query);
		confirm_query($subject_set);
		return $subject_set;
	}

	function find_pages_for_subject($subject_id) {
		global $db;

		$safe_subject_id = mysqli_real_escape_string($db, $subject_id);

		$query  = "SELECT * ";
		$query .= "FROM pages ";
		$query .= "WHERE visible = 1 ";
		$query .= "AND subject_id = {$safe_subject_id} ";
		$query .= "ORDER BY position ASC";
		$page_set = mysqli_query($db, $query);
		confirm_query($page_set);
		return $page_set;
	}

	function find_subject_by_id($subject_id) {
		global $db;

		$safe_subject_id = mysqli_real_escape_string($db, $subject_id);

		$query  = "SELECT * ";
		$query .= "FROM subjects ";
		$query .= "WHERE id = {$safe_subject_id} ";
		$query .= "LIMIT 1";
		$subject_set = mysqli_query($db, $query);
		confirm_query($subject_set);
		if($subject = mysqli_fetch_assoc($subject_set)) {
			return $subject;
		} else {
			return null;
		}
	}

	function find_page_by_id($page_id) {
		global $db;

		$safe_page_id = mysqli_real_escape_string($db, $page_id);

		$query  = "SELECT * ";
		$query .= "FROM pages ";
		$query .= "WHERE id = {$safe_page_id} ";
		$query .= "LIMIT 1";
		$page_set = mysqli_query($db, $query);
		confirm_query($page_set);
		if($page = mysqli_fetch_assoc($page_set)) {
			return $page;
		} else {
			return null;
		}
	}

	function find_selected_page() {
		global $sel_subject;
		global $sel_page;

		if (isset($_GET["subject"])) {
			$sel_subject = find_subject_by_id($_GET["subject"]);
			$sel_page = null;
		} elseif (isset($_GET["page"])) {
			$sel_subject = null;
			$sel_page = find_page_by_id($_GET["page"]);
		} else {
			$sel_subject = null;
			$sel_page = null;
		}
	}

	// navigation takes 2 arguments
	// - the current subject array or null
	// - the current page array or null
	function navigation($sel_subject, $sel_page) {
		$output = "<ul class=\"subjects\">";
		$subject_set = find_all_subjects();
		while($subject = mysqli_fetch_assoc($subject_set)) {
			$output .= "<li";
			if ($sel_subject && $subject["id"] == $sel_subject["id"]) {
				$output .= " class=\"selected\"";
			}
			$output .= ">";
			$output .= "<a href=\"edit_subject.php?subject=";
			$output .= urlencode($subject["id"]);
			$output .= "\">";
			$output .= htmlentities($subject["menu_name"]);
			$output .= "</a>";

			$page_set = find_pages_for_subject($subject["id"]);
			$output .= "<ul class=\"pages\">";
			while($page = mysqli_fetch_assoc($page_set)) {
				$output .= "<li";
				if ($sel_page && $page["id"] == $sel_page["id"]) {
					$output .= " class=\"selected\"";
				}
				$output .= ">";
				$output .= "<a href=\"edit_subject.php?page=";
				$output .= urlencode($page["id"]);
				$output .= "\">";
				$output .= htmlentities($page["menu_name"]);
				$output .= "</a></li>";
			}
			mysqli_free_result($page_set);
			$output .= "</ul></li>";
		}
		mysqli_free_result($subject_set);
		$output .= "</ul>";
		return $output;
	}

?>
