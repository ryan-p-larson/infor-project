<?php 

// Import libraries before anything
include_once("src/dbutils.php");
include_once("src/config.php");
include_once("src/cmsutils.php");


// get a handle to the database
$db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);

// CASE SWITCH GOES HERE
//
switch($_GET['inputType']) {
	case "createUser":
		// USER
		// get data from fields
		$stuID = $_POST['stuID'];
		$stuFirstName = $_POST['stuFirstName'];
		$stuLastName = $_POST['stuLastName'];
		$stuPhone = $_POST['stuPhone'];
		$stuEmail = $_POST['stuEmail'];
		$stuHashPass = crypt($_POST['stuHashPass'], getSalt());


		// check that we have the data we need
		if (!$stuID) {
			echo "Hey, you didn't add student ID!";
			exit;
		}

		// check if stuID title is already in the table
		$stuIDCheckQuery = "select * from students where stuID=" . $stuID . ";";
		$result = queryDB($stuIDCheckQuery, $db);
		if ($result) {
			$numberofrows = nTuples($result);
			if ($numberofrows > 0) {
				punt("The student ID " . $stuID . " already exists in the database." .
								  "<p>Please <a href='input.php'>try again</a>");
			}
		} else {
			punt("Could not check if student ID was already in table.<p>" . $db->error, $stuIDCheckQuery);
		}

		// prepare sql statement
		$query = "insert into students (stuID, stuFirstName, stuLastName, stuEmail, stuHashPass)
			values (" . $stuID . ", '" . $stuFirstName . "', '" . $stuLastName . "', '" .
			$stuEmail . "', '" . $stuHashPass . "');";

		// execute sql statement
		$result = queryDB($query, $db);

		// check if it worked
		if ($result) {
			echo $stuFirstName . " was added to the database.";
			echo "<p>";
		} else {
			echo "Something went horribly wrong when adding " . $stuFirstName . ".";
			echo "<p>This was the error: " . $db->error;
			echo "<p>This was the sql statement: " . $query;
			echo "<p>Please try again";
		}

		$db->close();
		// If everything went well until this point, send them to the login page
		header("Location: login.php");
		break;

	case "createOrg":
		// Grab org level data
		// REQUIRED FIELDS
		$orgName = $_POST['orgName'];
		$orgDesc = $_POST['orgDesc'];
		$orgEmail = $_POST['orgEmail'];
		
		// Assigned to whoever creates org, can be changed later
		$orgAdmin = getStuID($_SESSION['stuEmail']);

		// Optional fields: FB, twitter, phone, leadership, etc

		// check if Org title is already in the table
		if (checkOrgName($orgName) == true) {
			echo "there's already an org with this name.";
			break;
		}
		
		// CREATE DIRECTORIES FOR SAID PHOTOS

		// Insert Org to orgs
		$query = "insert into orgs (orgName, orgDesc, orgEmail, orgAdmin)
			values ('" . $orgName . "', '" . $orgDesc . "', '" . $orgEmail . "', '" . $orgAdmin . "');"; // ADD PHOTOS
		$result = queryDB($query, $db);
		
		// Insert into members (admin)
		$orgID = getOrgID($orgName);
		$memberQuery = "INSERT INTO members (orgID, stuID, memLeader, memPermissions) VALUES (" . $orgID . ", " . $orgAdmin . ", 1, 1);";
		$result = queryDB($memberQuery, $db);

		// check if it worked
		if ($result) {
			echo $orgName . " was added to the database.";
			// Send to newly created org
			header("Location: org.php?orgID=" . $orgID);
		} else {
			echo "Something went horribly wrong when adding " . $orgName . $orgName . ".";
			echo "<p>This was the error: " . $db->error;
			echo "<p>This was the sql statement: " . $query;
			echo "<p>Please try again";
		}

		// close out
		$db->close();
		break;
		
	case "createPage":
		
		// We can assume the orgID has been passed along, because the create page requires it
		$orgID = $_POST['orgID'];
		
		// get data from fields
		$designID = $_POST['designID'];
		
		$urlTitle = $_POST['urlTitle'];
		$pageTitle = $_POST['pageTitle'];
		$menuTitle = $_POST['menuTitle'];
		$bodyTitle = $_POST['bodyTitle'];
		$body = $_POST['body'];
		
		// Validate
		$required = array($orgID, $designID, $urlTitle, $pageTitle, $menuTitle, $bodyTitle, $body);
		foreach ($required as &$value) {
			if (!isset($value)) {
				header("Location: create-page.php?orgID=" . $orgID);
			}
		}
		// everything checks out 
		
		// add escape characters to text
		foreach ($required as &$value) { $value = $db->real_escape_string($value); }
		
		// check if url title is already in the table
		$urlCheckQuery = "select * from pages where urlTitle='" . $urlTitle . "'";
		$result = queryDB($urlCheckQuery, $db);
		if ($result) {
			$numberofrows = nTuples($result);
			if ($numberofrows > 0) {
				punt("The url title " . $urlTitle . " already exists in the database." .
								  "<p>Please <a href='input.php'>try again</a>");
			}
		} else {
			punt("Could not check if email was already in table.<p>" . $db->error, $urlCheckQuery);
		}	

		// prepare sql statement
		$query = "insert into pages (orgID, urlTitle, pageTitle, menuTitle, bodyTitle, body, designID)
			values (" . $orgID . ",  '" . $urlTitle . "', '" . $pageTitle . "', '" . $menuTitle . "', '" .
			$bodyTitle . "', '" . $body . "', '"  . $designID . "');";
		
		// execute sql statement
		$result = queryDB($query, $db);
		
		// check if it worked
		if ($result) {
			header("Location: org.php?orgID=".$orgID);
		} else {
			echo "Something went horribly wrong when adding " . $pageTitle . ".";
			echo "<p>This was the error: " . $db->error;
			echo "<p>This was the sql statement: " . $query;
			echo "<p>Please <a href='input.php'>try again</a>";
		}
    
    	$db->close();
		
		break;
	
	case "login":

		if (checkStudentEmail($_POST['stuEmail']) != True) {
			echo "We couldn't find that email, would you like to register?";
		}
		
		// password correct
		if (isset($_POST['stuHashPass'])) {
		  if (checkPassword($_POST['stuEmail'], $_POST['stuHashPass']) == True) {
			  
			  // Correct password, start a session 
			  if (session_status() == PHP_SESSION_NONE) {
				  session_start();
			  } else {
				  logoutUser();
				  session_start();
			  }
				  
			  // PERSISTENT SESSION VARIABLES
			  $_SESSION['stuEmail'] = $_POST['stuEmail'];
			  $stuID = getStuID($_POST['stuEmail']);
			  $_SESSION['stuID'] = $stuID;
			  
			  // Check if they're a site admin
			  if (singleValueStu($stuID, 'stuAdmin') == 1) {
				$_SESSION['stuAdmin'] = true;  
			  }
			  
			  header("Location: user-home.php");
			  exit;
			  break;
		  } else {
			  echo "Wrong password for email.";
			  header("refresh 5:Location: login.php");
			  exit;
			  break;
		  } 
		}
		$db->close();
		break;
	
	case "orgHome":
		// Org exists
		if (isset($_POST['orgName'])) {
		  // orgName cleaning
		  if (checkOrgName($_POST['orgName']) != True) {
			echo "We couldn't find that Organization, would you like to create it?";
		  } else {
			$db->close();
			$_SESSION['orgName'] = $_POST['orgName'];
			header("Location: org-home.php"); 
			exit;
			home;
		  }
		}
		$db->close();
		break;
	
	case "logout":
		logoutUser();
		header("Location: index.php");
		exit;
		break;
}
//add the header
include("src/header.php");
?>

<?php include("src/footer.php"); ?>







