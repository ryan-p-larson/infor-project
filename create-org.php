<?php

// Import libraries before anything
include_once("src/dbutils.php");
include_once("src/config.php");
include_once("src/cmsutils.php");

// Users must be logged in to create an org
checkLogin();


//add the header
include_once("src/header.php");
?>

<div class="row">
	<div class="col-xs-10">
    	<div class="well">
        
         <form class="form-horizontal" action="input.php?inputType=createOrg" method="post" enctype="multipart/form-data">
              <fieldset>
                <legend class="col-md-offset-2 col-md-10">Create an Organization</legend>
      
                <div class="form-group">
                    <label for="orgName" class="col-md-2 control-label h5">Organization Name</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="orgName"/>
                        <span class="help-block">This name will be publicly available.</span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="orgDesc" class="col-md-2 control-label h5">Organization Description</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="orgDesc"/>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="orgEmail" class="col-md-2 control-label h5">Organization E-mail</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="orgEmail"/>
                    </div>
                </div>
      
                <div class="text-center">
                    <!-- One hidden field for the POST header -->
                    <input type="hidden" name="inputType" value="createOrg" />     
                    <input type="hidden" name="designID" value="defaultBootstrap" />
                    
                    <button class="btn btn-lg btn-primary btn-block btn-raised" style="width:100%" type="submit">Get involved!</button> 
                    <button type="button" class="btn btn-default"><a href=<?php echo "user-home.php"; ?> >Cancel</a></button>
                </div>
                  
                </fieldset>
              </form>
        </div>
    </div>
</div>

<hr>

<?php include("src/footer.php"); ?>