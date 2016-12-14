<?php

// Because this library file is called by every page, we start sessions here

if (!isset($_SESSION)) {
	session_start();
}


function logoutUser() {
	// Forget all of the associated variables
	session_unset();
	// End session
	session_destroy();
}

function checkLogin() {
	if (!isset($_SESSION['stuEmail'])) {
	//if (session_status() == PHP_SESSION_NONE) {
		// ALERT THAT YOU MUST LOG IN TO THIS SITE
		// POSSIBLY JS POP UP
		header("Location: login.php");
	}
}

function getOrgID($name) {
	// Function to retrieve an orgID from name
	// Database setup
	global $dbHost, $dbUser, $dbPassword, $dbName;
  	$db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
	
	// Query
	$query = "SELECT orgID, orgName FROM orgs WHERE orgName='" . $name . "';";   
	$result = queryDB($query, $db);	
	$db->close();
	
	if ($result) {
		$org = nextTuple($result);
		return $org['orgID'];
	}
}

function getOrgName($id) {
	// Function to retrieve an org name from ID
	global $dbHost, $dbUser, $dbPassword, $dbName;
  	$db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
	
	// Query
	$query = "SELECT orgID, orgName FROM orgs WHERE orgID='" . $id . "';";   
	$result = queryDB($query, $db);	
	
	if ($result) {
		$org = nextTuple($result);
		return $org['orgName'];
	}
}

function getOrgDesc($name) {
	// Function to retrieve an org desc from name
	// Database setup
	global $dbHost, $dbUser, $dbPassword, $dbName;
  	$db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
	
	// Query
	$query = "SELECT orgDesc, orgName FROM orgs WHERE orgName='" . $name . "';";   
	$result = queryDB($query, $db);	
	
	if ($result) {
		$org = nextTuple($result);
		return $org['orgDesc'];
	}
}

function getStuID($email) {
	// Function to retrieve an orgID from name
	// Database setup
	global $dbHost, $dbUser, $dbPassword, $dbName;
  	$db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
	
	// Query
	$query = "SELECT stuID, stuEmail FROM students WHERE stuEmail='" . $email . "';";  
	$result = queryDB($query, $db);	
	
	if ($result) {
		$stu = nextTuple($result);
		return $stu['stuID'];
	} else {
		punt("Something went wrong when grabbing studentID from the database.<p>" .
  						"This was the error: " . $db->error . "<p>", $query);	
	}
}

function getStuFName($id) {
	// Function to map student name from ID
	global $dbHost, $dbUser, $dbPassword, $dbName;
  	$db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
	
	
	// Query
	$query = "SELECT stuID, stuFirstName FROM students WHERE stuID='" . $id . "';";  
	$result = queryDB($query, $db);	
	
	if ($result) {
		$stu = nextTuple($result);
		return $stu['stuFirstName'];
	} else {
		punt("Something went wrong when grabbing studentID from the database.<p>" .
  						"This was the error: " . $db->error . "<p>", $query);	
	}
}

function getStuLName($id) {
	// Function to map student name from ID
	global $dbHost, $dbUser, $dbPassword, $dbName;
  	$db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
	
	
	// Query
	$query = "SELECT stuID, stuLastName FROM students WHERE stuID='" . $id . "';";  
	$result = queryDB($query, $db);	
	
	if ($result) {
		$stu = nextTuple($result);
		return $stu['stuLastName'];
	} else {
		punt("Something went wrong when grabbing studentID from the database.<p>" .
  						"This was the error: " . $db->error . "<p>", $query);	
	}
}

function getStuEmail($id) {
	// Function to map student email from ID
	global $dbHost, $dbUser, $dbPassword, $dbName;
  	$db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
	
	
	// Query
	$query = "SELECT stuID, stuEmail FROM students WHERE stuID='" . $id . "';";  
	$result = queryDB($query, $db);	
	
	if ($result) {
		$stu = nextTuple($result);
		return $stu['stuEmail'];
	} else {
		punt("Something went wrong when grabbing student emails from the database.<p>" .
  						"This was the error: " . $db->error . "<p>", $query);	
	}
}


function isOrgMember($orgID, $stuID) {
	// Function that returns true if a student is a member of an org
	global $dbHost, $dbUser, $dbPassword, $dbName;
  	$db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
	
	// Query
	$query = "SELECT orgID, stuID FROM members WHERE orgID=" . $orgID . " AND stuID=" . $stuID . ";";  
	$result = queryDB($query, $db);	
	
	if ($result) {
		$numberofrows = nTuples($result);
		if ($numberofrows == 1) {
		  return true;
		} else {
			return false;	
		}
	} else {
		return false;
	}
}
function isOrgAdmin($orgID, $stuID) {
	// Function that returns true if a student is a member of an org
	global $dbHost, $dbUser, $dbPassword, $dbName;
  	$db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
	
	// Query
	$query = "SELECT * FROM members WHERE orgID=" . $orgID . " AND stuID=" . $stuID . ";";  
	$result = queryDB($query, $db);	
	
	if ($result) {
		$numberofrows = nTuples($result);
		if ($numberofrows == 1) {
			$row = nextTuple($result);
			$admin = ($row['memPermissions'] > 0) ? true: false;
		  	return $admin;
		} else {
			return false;	
		}
	} else {
		return false;
	}
}
function checkOrgName($org) {

  global $dbHost, $dbUser, $dbPassword, $dbName;
  $db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);

  $query = "SELECT orgName, orgID FROM orgs WHERE orgName = '" . $org . "';";
  $result = queryDB($query, $db);


  // check if it worked
  if ($result) {
  	$numberofrows = nTuples($result);

  	if ($numberofrows == 1) {
  	  return true;
  	} else {
  	  return false;
  	}

    } else {
  	  punt("Something went wrong when grabbing org names from the database.<p>" .
  						"This was the error: " . $db->error . "<p>", $query);
    }
}

function checkStudentEmail($email) {
    // setup DB variables
    global $dbHost, $dbUser, $dbPassword, $dbName;
    $db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);

    $checkQuery = "SELECT stuEmail FROM students WHERE stuEmail = '" . $email . "';";
    $result = queryDB($checkQuery, $db);
    if ($result) {
      $numberofrows = nTuples($result);
      if ($numberofrows == 1) {
    	  return True;
    	} else {
    	  return False;
    	}

      } else {
    	  punt("Something went wrong when grabbing org names from the database.<p>" .
    						"This was the error: " . $db->error . "<p>", $query);
      }
  }

function checkPassword($email, $pass) {
  // setup DB variables
  global $dbHost, $dbUser, $dbPassword, $dbName;
  $db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);

  $checkQuery = "SELECT stuHashPass FROM students WHERE stuEmail = '" . $email . "';";
  $result = queryDB($checkQuery, $db);
  $db->close();
  
  if (nTuples($result) > 0) {
	$row = nextTuple($result);
	$hashedPass = $row['stuHashPass'];
	  
	if ($hashedPass == crypt($pass, $hashedPass)) {
		return True;
	} else {
	  return False;
    }

    } else {
      punt("Something went wrong when grabbing org names from the database.<p>" .
              "This was the error: " . $db->error . "<p>", $checkQuery);
    }
}

// Single value accessors
function singleValueOrg($id, $val) {
	// Function to get a single value from a table
	global $dbHost, $dbUser, $dbPassword, $dbName;
  	$db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
	
	// Query
	$query = "SELECT " . $val . ", orgID FROM orgs WHERE orgID= " . $id . ";";
	$result = queryDB($query, $db);	
	$db->close();
	
	if ($result) {
		$ret = nextTuple($result);
		return $ret[$val];
	} else {
		punt("Something went wrong when grabbing organization's $" . $val . "from the database.<p>" .
  						"This was the error: " . $db->error . "<p>", $query);	
	}
}
function singleValueStu($id, $val) {
	// Function to get a single value from a table
	global $dbHost, $dbUser, $dbPassword, $dbName;
  	$db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
	
	// Query and close
	$query = "SELECT " . $val . ", stuID FROM students WHERE stuID= " . $id . ";";
	$result = queryDB($query, $db);	
	$db->close();
	
	if ($result) {
		$ret = nextTuple($result);
		return $ret[$val];
	} else {
		punt("Something went wrong when grabbing the student's $" . $val . " from the database.<p>" .
  						"This was the error: " . $db->error . "<p>", $query);	
	}
}
function singleValuePage($id, $val) {
	// Function to get a single value from a table
	global $dbHost, $dbUser, $dbPassword, $dbName;
  	$db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
	
	// Query and close
	$query = "SELECT " . $val . ", pageID FROM pages WHERE pageID= " . $id . ";";
	$result = queryDB($query, $db);	
	$db->close();
	
	if ($result) {
		$ret = nextTuple($result);
		return $ret[$val];
	} else {
		punt("Something went wrong when grabbing the pages's $" . $val . " from the database.<p>" .
  						"This was the error: " . $db->error . "<p>", $query);	
	}
}

// Table fillers
function getStuOrgs($id) {
	// Function to retrieve a list of members given on orgID
	global $dbHost, $dbUser, $dbPassword, $dbName;
  	$db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
	
	$memQuery = "SELECT * FROM members WHERE stuID=" . $id . ";";
	$result = queryDB($memQuery, $db);
	
	if ($result) {
		$numRows = nTuples($result);
		
		for ($i=0; $i<$numRows; $i++) {
			$row = nextTuple($result);	
			$name = getOrgName($row['orgID']);
			
			// VERBOSE for now
			echo "<tr>";
			echo "<td>" . $name . "</td>";
			echo "<td>" . "Blank" . "</td>";
			echo "<td>" . $row['memPermissions'] . "</td>";
			// Org home should have a neg pageindex 
			//echo "<td>" . "<a href='org/home.php?orgName=". urlencode($name) . "&pageID=" . urlencode($_GET['pageID']) . "'>Link</a>" . "</td>";
			echo "<td>" . "<a href=org.php?orgID=" . urlencode($row['orgID']) . ">Link</a>" . "</td>";
			echo "</tr>";
		}
	} else {
		punt("Something went wrong when grabbing studentID from the database.<p>" .
  						"This was the error: " . $db->error . "<p>", $query);	
	}
}
function getOrgMembers($id) {
	// Function to retrieve a list of members given on orgID
	global $dbHost, $dbUser, $dbPassword, $dbName;
  	$db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
	
	$memQuery = "SELECT * FROM members WHERE orgID=" . $id . " AND memPermissions >= 0;";
	$result = queryDB($memQuery, $db);
	
	if ($result) {
		$numRows = nTuples($result);
		for ($i=0; $i<$numRows; $i++) {
			$row = nextTuple($result);
			$stuID = $row['stuID'];
			echo "<tr>";
			echo "<td>" . singleValueStu($stuID, 'stuFirstName') ." ". singleValueStu($stuID, 'stuLastName') ."</td>";
			echo "<td>" . emailButton(singleValueStu($stuID, 'stuEmail')) . "</td>";
			echo "<td>" . $row['memLeader'] . "</td>";
			echo "<td>" . $row['memPermissions'] . "</td>";
			echo "</tr>";
		}
	}

}
function getOrgPages($id) {
	global $dbHost, $dbUser, $dbPassword, $dbName;
  	$db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
	
	$pageQuery = "SELECT * FROM pages WHERE orgID=" . $id . " AND pageApproved >= 0;";
	$result = queryDB($pageQuery, $db);
	
	if ($result) {
		$numRows = nTuples($result);
		
		for ($i=0; $i<$numRows; $i++) {
			$row = nextTuple($result);	
			$pageID = $row['pageID'];
			
			// VERBOSE for now
			echo "\n<tr id='pageID" . $pageID . "'>";
			echo "\n<td>" . $row['bodyTitle'] . "</td>";
			echo "\n<td>" . pageLinkButton($pageID) . "</td>";
			echo "\n<td>" . editPageButton($row) . "</td>";
			echo "\n<td>" . deletePageButton($row) . "</td>";
			echo "\n</tr>";
		}
	} else {
		punt("Something went wrong when grabbing org pages from the database.<p>" .
  						"This was the error: " . $db->error . "<p>", $query);	
	}	
}
function adminDashboard() {
	// Function to insert an approval queue into a user's settings page
	
	// Only if the DB has admins
	if (isset($_SESSION['stuAdmin'])) {
		
		global $dbHost, $dbUser, $dbPassword, $dbName;
	  	$db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
			
		$tableHeadSnippet = "\n<table class='table table-hover' id='infoTable'>\n\t<thead class='thead-inverse'>\n<tr>";
		$tableBodySnippet = "\n</tr>\n</thead>\n<tbody>";
		$tableFootSnippet = "\n</tbody>\n</table>";
		
		// First insert the orgs that need approval
		// Echo html until rows
		$orgQuery = "SELECT * FROM orgs WHERE orgApproved IS NULL;";
		$result = queryDB($orgQuery, $db);
		echo "<h3>Unapproved Organizations</h3>";
		
		echo $tableHeadSnippet;
		// table columns
		echo "\n<th>Org. Name</th>";
		echo "\n<th>Description</th>";
		echo "\n<th>Administrator Email</th>";
		echo "\n<th>Approve</th>";
		echo "\n<th>Deny</th>";
		echo $tableBodySnippet;
		
		if ($result) {
			$numRows = nTuples($result);
			
			for ($i=0; $i<$numRows; $i++) {
				$row = nextTuple($result);	
				
				$orgID = $row['orgID'];
				$orgName = singleValueOrg($orgID, 'orgName');
				$orgDesc = singleValueOrg($orgID, 'orgDesc');
				$adminID = singleValueOrg($orgID, 'orgAdmin');
				$adminName = singleValueStu($adminID, 'stuFirstName');
				$adminEmail = singleValueStu($adminID, 'stuEmail');
				
				// VERBOSE for now
				echo "<tr>";
				echo "<td>" . $orgName . "</td>";
				echo "<td>" . $orgDesc . "</td>";
				echo "<td><a href='mailto:" . $adminEmail . "'>". $adminName . "</a></td>";
				echo "<td> <i class='material-icons' style='color:green;'>add</i> </td>"; 
				echo "<td> <i class='material-icons' style='color:red;'>clear</i> </td>";
				echo "</tr>";
			}
		} else {
			punt("Something went wrong when grabbing orgs from the database.<p>" .
							"This was the error: " . $db->error . "<p>", $query);	
		}
		echo $tableFootSnippet;
	}
}
function orgUserDash($orgID, $stuID) {
	
	if (isOrgAdmin($orgID, $stuID) == 1) {
			
		// Set up sql
		global $dbHost, $dbUser, $dbPassword, $dbName;
		$db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
		
		$memQuery = "SELECT * FROM members WHERE orgID=".$orgID." AND memPermissions < 0;";

		
		// Table template
		$tableHeadSnippet = "\n<table class='table table-hover' id='adminUsers'>\n\t<thead class='thead-inverse'>\n<tr>";
		$tableBodySnippet = "\n</tr>\n</thead>\n<tbody>";
		$tableFootSnippet = "\n</tbody>\n</table>";
		
		// Members first
		$memResult = queryDB($memQuery, $db);
		echo "<h4>Unapproved Members</h4>";
		
		echo $tableHeadSnippet;
		// table columns
		echo "\n<th>Name</th>";
		echo "\n<th>Email</th>";
		echo "\n<th>Approve</th>";
		echo "\n<th>Deny</th>";
		echo $tableBodySnippet;
		
		
		if ($memResult) {			
			$numRows = nTuples($memResult);
			for ($i=0; $i<$numRows; $i++) {
				$row = nextTuple($memResult);	
				
				$unapprovedID = $row['stuID'];
				//$fName = singleValueStu($stuID, 'stuFirstName');
				$lName = singleValueStu($unapprovedID, 'stuLastName');
				$email = singleValueStu($unapprovedID, 'stuEmail');
				
				// VERBOSE for now
				echo "<tr id='queuedMem". $unapprovedID ."' >";
				echo "<td>" . $fName . " " . $lName . "</td>";
				echo "<td>". emailButton(singleValueStu($stuID, 'stuEmail')) ."</td>";
				echo "<td> <i class='material-icons btn-xs' style='color:green; font-size:24px;' onclick='updateUser(". $orgID .", ". $unapprovedID . ", 0);' >add</i> </td>";
				echo "<td> <i class='material-icons btn-xs' style='color:red; font-size:24px;' onclick='deleteUser(". $orgID .", ". $unapprovedID .");' >clear</i> </td>";
				echo "</tr>";
			}
			echo $tableFootSnippet;	
		} 
	}
}
function orgPageDash($orgID, $stuID) {
	
	if (isOrgAdmin($orgID, $stuID) == 1) {
	
		// Set up sql
		global $dbHost, $dbUser, $dbPassword, $dbName;
		$db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
		$pageQuery = "SELECT * FROM pages WHERE orgID=".$orgID." AND pageApproved IS NULL;";

		
		// Table template
		$tableHeadSnippet = "\n<table class='table table-hover' id='adminPages' >\n\t<thead class='thead-inverse'>\n<tr>";
		$tableBodySnippet = "\n</tr>\n</thead>\n<tbody>";
		$tableFootSnippet = "\n</tbody>\n</table>";
		
		// And then pages
		echo "\n<h4>Unapproved Pages</h4>";
		echo $tableHeadSnippet;
		// table columns
		echo "\n<th>Title</th>";
		echo "\n<th>URL</th>";
		echo "\n<th>Approve</th>";
		echo "\n<th>Deny</th>";
		echo $tableBodySnippet;
		
		$pageResult = queryDB($pageQuery, $db);
		if ($pageResult) {
			$numRows = nTuples($pageResult);
			for ($i=0; $i<$numRows; $i++) {
				$row = nextTuple($pageResult);	
				
				$title = $row['bodyTitle'];
				$unapprovedPageID = $row['pageID'];
				
				// VERBOSE for now
				echo "<tr id='approvePageID". $unapprovedPageID ."'>";
				echo "<td>" . $title . "</td>";
				echo "<td>". pageLinkButton($unapprovedPageID) ."</td>";
				echo "<td> <i class='material-icons btn-xs' style='color:green; font-size:24px;' onclick='approvePage(". $unapprovedPageID .");' >add</i> </td>";
				echo "<td> <i class='material-icons btn-xs' style='color:red; font-size:24px;' >clear</i> </td>";
				echo "</tr>";
			}
		} else {
			//header('Content-Type: application/json');
			//echo json_encode(array('message' => $db, "class" => "warning"));
			echo $db;
			break;
		}
		echo $tableFootSnippet;
		echo "\n<br/>";	
		}
	}
	
function orgCards($range) {
	// Populate cards on front page and search
	
	$cardTop = "<div class='col-lg-3 col-md-6 col-xs-12 orgcards'><div class='card'><div class='card-image'><img src='imgs/org";
	$cardMiddle = ".png' alt='Card image cap'><h4 class='card-image-headline'><a style='background-color: #333; fill-opacity: 0.5; color: white;' href='org.php?orgID=";
	$cardLink = "' class='btn btn-primary'>";
	$cardBottom = "</a></h4> </div></div></div>";
	
	// Set up sql
	global $dbHost, $dbUser, $dbPassword, $dbName;
	$db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
	
	$nameQuery = "SELECT orgID, orgName FROM orgs WHERE orgID<=".$range.";";
	$names = queryDB($nameQuery, $db);
	if ($names) {
		$numRows = nTuples($names);
		for ($i=0; $i<$numRows; $i++) {
			$row = nextTuple($names);
			$orgID = $row['orgID'];
			$orgName = $row['orgName'];
			
			$card = $cardTop. $orgID . $cardMiddle . $orgID . $cardLink . $orgName . $cardBottom;
			echo $card;
		}
	}
}

// Buttons
function editPageButton($record) {
	/* 
	Functiont that takes a page record and creates 
	the appropriate javascript function call to bring up 
	the edit dialog
	*/
	$icon = "<i class='material-icons btn-xs pull-left' style='color:orange; font-size:24px;'  onclick='" . "editRecord(";
	$button = $icon . $record['pageID'] .', "'. $record['pageTitle'] .'", "'. $record['urlTitle'] 
			.'", "'. $record['menuTitle'] .'", "'. $record['bodyTitle'] .'", '. str_replace('\'', '&#39;', json_encode($record['body'])) . ', '. $record['pageID'] .");'>mode edit</i>";
	return $button;
	
}
function deletePageButton($record) {
	/* 
	Functiont that takes a page record and creates 
	the appropriate javascript function call to bring up 
	the delete dialog
	*/
	$icon = "<i class='material-icons btn-xs' style='color:red; font-size:24px;'  onclick='" . "deletePageOpen(";
	$buttonBase = "<button type='button' class='btn btn-sm btn-warning' onclick=" . '"' . "deletePageOpen(";
	$button = $icon . $record['pageID'] . ");'>delete</i>";
	return $button;
}
function joinOrgButton($orgID, $stuID) {
	// Function to give a user the option to join a group they find interesting
	if (isOrgMember($orgID, $stuID) == 0) {	
	
		$button = "<a href='testInput.php?inputType=joinOrg&orgID=" . $orgID . "&stuID=" . $stuID. "' class='btn btn-default btn-group-sm btn-fab'><i class='material-icons'>add</i></a>";
		$span = "<span class='pull-left'>" . $button . "&nbsp;<b>Join student group.</b></span>";
		echo $span;
	}
}
function pageLinkButton($pID) {
	$icon = "<i class='material-icons' style='color:black;' font-size:24px;' >cloud_queue</i>";
	$pageButton = "<a href='page.php?pageID=" . urlencode($pID) . "' >". $icon ."</a>"; 
	return $pageButton;
}
function emailButton($email) {
	$icon = "<i class='material-icons' style='color:black;' font-size:24px;' >mail</i>";
	$emailButton = "<a href='mailto:=" . urlencode($email) . "' >". $icon ."</a>"; 
	return $emailButton;
}

// TO BE FINISHED
function createBreadcrumbs() {
	if (isset($_GET['orgID'])) {
		$orgID = $_GET['orgID'];
		$orgName = getOrgName($orgID);
		//
		echo "<ul class='breadcrumb'><li><a href='org.php?orgID=" . $orgID . ">" . $orgName . "</a></li></ul>";	
	}
}
function checkOrgURL() {
	/*
	Function that takes an get request and properly redirects the request
	to the correct page. Also sets variables along the way.
	*/
	
	// Check if the URL has a orgID, if it doesn't redirect
	if (!isset($_GET['orgID'])) {
		// ADD FEEDBACK
		header("Location: user-home.org");
	}
}
function validateURL($getVar, $location) {
	/*
	Function that takes an incoming URL, and checks if it has 
	the if the appropriate GET variable is set. 
	If it isn't, it will send the page to the new location.
	Otherwise it does nothing
	*/
	
	if (!isset($_GET[$getVar])) { header("Location: " . $location); }
}
          


?>
