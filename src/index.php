<html>
<body>

<?php
    include_once("dbutils.php");
    include_once("config.php");

    // get a handle to the database
    $db = connectDB($dbHost, $dbUser, $dbPassword, $dbName);

    function grabOrgNames() {
      // prepare sql statement
      $query = "SELECT orgName FROM orgs;";

      // execute sql statement
      $result = queryDB($query, $db);

      // check if it worked
      if ($result) {
          $numberofrows = nTuples($result);

          for ($i=0; $i<$numberofrows; $i++) {
              $row = nextTuple($result);

              echo "<p>" . $row["orgName"] . "</p>";
            }

      } else {
          punt("Something went wrong when retrieving pages from the database.<p>" .
                            "This was the error: " . $db->error . "<p>", $query);
      }
    }

    grabOrgNames();
?>
</body>
</html>
