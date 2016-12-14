<?php

// Import libraries before anything
include_once("src/dbutils.php");
include_once("src/config.php");
include_once("src/cmsutils.php");


// get DB connection before the case switches
$db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);

// CASE SWITCH GOES HERE
//
switch($_GET['inputType']) {
	
	// Deleting a page
	case "deletePage":
		// A user needs to be logged in to delete
		checkLogin();
		
		// We need an unique ID to delete a page
		$pageID = $_POST['pageID'];

		$delQuery = "DELETE FROM pages WHERE pageID= " . $pageID . ";";
		$result = queryDB($delQuery, $db);
		
		// Create a json header because now we'll need feedback
		header('Content-Type: application/json');
		if ($result) {
			echo json_encode(array('message' => "Page successfully deleted", "class" => "success"));
		} else {
			echo json_encode(array('message' => $db, 'class' => 'danger'));
		}

		exit;
		break;
		
	case "search":
		
		$searchTerm = $_GET['term'];
		// Ideally we would sanitize this
		$searchQuery = "SELECT * FROM orgs WHERE orgName LIKE '%".$searchTerm."%';";
		$select = queryDB($searchQuery, $db);
	
		
		$results = array();
		if ($select) {
			while ($row = nextTuple($select)) {
				$results[] = $row;	
			}
		}
		
		header('Content-Type: application/json');
		echo json_encode($results);
		$db->close();
		exit;
		break;
	
	case "joinOrg":
		// Insert into members, setting permissions as -1 (unapproved)
		$orgID = $_GET['orgID'];
		$stuID = $_SESSION['stuID'];
		
		$memberQuery = "INSERT INTO members (orgID, stuID, memPermissions) VALUES (" . $orgID . ", " . $stuID . ", -1);";
		$result = queryDB($memberQuery, $db);
		
		
		// Create a json header because now we'll need feedback
		header('Content-Type: application/json');
		if ($result) {
			echo json_encode(array('message' => "Your request has been sent.", "class" => "success"));
		} else {
			echo json_encode(array('message' => $db, 'class' => 'danger'));
		}

		exit;
		break;
	
	case "test":
		$message = $_REQUEST['message'];
		$noSpace = preg_replace('/\s+/', '', $message);
		
		header('Content-Type: application/json');
		echo json_encode(array('message' => ("White space stripped: <strong>".$noSpace ."</strong>"), "class" => "info"));
		break;
		
	case "editPage":
		
		// Because this is coming from an existing record, all variables will be present even if they're null
		$orgID = $_POST['orgID'];
		$pageID = $_POST['pageID'];
		// get data from fields
		$designID = $_POST['designID'];
		
		$urlTitle = $_POST['urlTitle'];
		$pageTitle = $_POST['pageTitle'];
		$menuTitle = $_POST['menuTitle'];
		$bodyTitle = $_POST['bodyTitle'];
		$body = $_POST['body'];
		
		$required = array($orgID, $designID, $urlTitle, $pageTitle, $menuTitle, $bodyTitle, $body, $pageID);
		// add escape characters to text
		foreach ($required as &$value) { $value = $db->real_escape_string($value); }

		// prepare sql statement
		$query = "UPDATE pages SET orgID=". $orgID .", urlTitle='". $urlTitle ."', pageTitle='". $pageTitle ."', menuTitle='". $menuTitle ."', bodyTitle='". $bodyTitle ."', body='". $body ."', designID='". $designID ."' WHERE pageID=". $pageID .";";

		
		// execute sql statement
		$result = queryDB($query, $db);

		// Create a json header because now we'll need feedback
		//header('Content-Type: application/json');
		if ($result) {
			echo json_encode(array('message' => "Page successfully updated!", "class" => "success"));
		} else {
			echo json_encode(array('message' => $db, 'class' => 'danger'));
		}
		
    
    	$db->close();
		exit;
		break;
		
	case "updateUser":
		// Grab neccesary variables to update record
		$orgID = $_POST['orgID'];
		$stuID = $_POST['stuID'];
		
		$memPermissions = $_POST['memPermissions'];
		
		$updateMember = "UPDATE members SET memPermissions=". $memPermissions ." WHERE stuID=". $stuID ." AND orgID=". $orgID.";";
		$result = queryDB($updateMember, $db);
		
		header('Content-Type: application/json');
		if ($result) {
			echo json_encode(array('message' => "User was added to the organization", "class" => "success"));
		} else {
			echo json_encode(array('message' => $db, "class" => "danger"));
		}
		$db->close();
		break;
	
	case "deleteUser":
		// Grab neccesary variables to update record
		$orgID = $_POST['orgID'];
		$stuID = $_POST['stuID'];
		
		$removeQuery = "DELETE FROM members WHERE stuID=". $stuID ." AND orgID=". $orgID .";";
		$result = queryDB($removeQuery, $db);
		
		header('Content-Type: application/json');
		if ($result) {
			echo json_encode(array('message' => 'User removed from organization.', 'class' => 'info'));
		} else {
			echo json_encode(array('message' => $db, "class" => "danger"));
		}
		$db->close();
		break;
	
	case "approvePage":
		$pageID = $_POST['pageID'];
		$approvePage = "UPDATE pages SET pageApproved=0 WHERE pageID=". $pageID .";";
		$result = queryDB($approvePage, $db);
		
		header('Content-Type: application/json');
		if ($result) {
			echo json_encode(array('message' => 'Page approved, you can now view it live.', 'class' => 'success'));
		} else {
			echo json_encode(array('message' => $db, "class" => "danger"));
		}
		$db->close();
		break;


}
?>
