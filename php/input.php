<html>

<head>
    <title>Input Feedback</title>
</head>

<body>

<h1>
    Input Feedback
</h1>

<?php
    include_once("dbutils.php");
    include_once("config.php");

	// CASE SWITCH GOES HERE
	//
	switch($_POST['inputType']) {
		case "user":
			// USER
			// get data from fields
			$stuID = $_POST['stuID'];
			$stuFirstName = $_POST['stuFirstName'];
			$stuLastName = $_POST['stuLastName'];
			$stuPhone = $_POST['stuPhone'];
			$stuEmail = $_POST['stuEmail'];
			$stuHasPass = getSalt($_POST['stuHashPass']);
			
			
			// check that we have the data we need
			if (!$stuID) {
				echo "Hey, you didn't add student ID!";
				exit;
			}
			
			
			// get a handle to the database
			$db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
			
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
				$stuEmail . "', '" . $stuHasPass . "');";
			
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
			break;
		
		case "org":
			// Grab org level data
			// REQUIRED FIELDS
			$orgName = $_POST['orgName'];
			$orgDesc = $_POST['orgDesc'];
			$orgEmail = $_POST['orgEmail'];

			// Optional fields: FB, twitter, phone, leadership, etc
			//
			
			
			// get a handle to the database
			$db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);
			
			// check if stuID title is already in the table
			$orgCheckQuery = "select * from orgs where orgName='" . $orgName . "';";
			$result = queryDB($orgCheckQuery, $db);
			if ($result) {
				$numberofrows = nTuples($result);
				if ($numberofrows > 0) {
					punt("The organization " . $orgName . " already exists in the database." .
									  "<p>Please try again");
				}
			} else {
				punt("Could not check if the organization was already in table.<p>" . $db->error, $orgCheckQuery);
			}
			
			// prepare sql statement
			$query = "insert into orgs (orgID, orgDesc, orgEmail)
				values ('" . $orgName . ", '" . $orgDesc . "', '" . $orgEmail . "');";
			
			// execute sql statement
			$result = queryDB($query, $db);
			
	}
	
	
?>

</body>

</html>