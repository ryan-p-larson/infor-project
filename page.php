<?php

// Import libraries before anything
include_once("src/dbutils.php");
include_once("src/config.php");
include_once("src/cmsutils.php");


// Permissions
//isOrgMember($orgID, $stuID);
// Users must be logged in for now
checkLogin();

// Page rendering vars
$stuID = getStuID($_SESSION['stuEmail']);
$pageID = $_GET['pageID'];
$orgID = singleValuePage($pageID, 'orgID');
$orgName = singleValueOrg($orgID, 'orgName');

//add the header
include_once("src/header.php");
?>

<div class="row">
	<div class="col-md-10 col-md-offset-1 col-xs-12">
    	<div class="well">
        	<div class="row" style="padding:10px">
    
                <!-- Org Header -->
                <h1><?php echo "<a href='org.php?orgID=" . urlencode($orgID) . "'>" . $orgName . "</a>"; ?>
                    <small class="text-muted"><?php echo singleValueOrg($orgID, "orgDesc"); ?></small>
                </h1>
                <hr>
                <br>
                    
                
             	<h3><?php echo singleValuePage($pageID, 'bodyTitle'); ?></h1>
             	<p><?php echo singleValuePage($pageID, 'body'); ?></p>

                
            </div>
         </div>
     </div>
</div>

</div>

<?php include_once("src/footer.php"); ?>