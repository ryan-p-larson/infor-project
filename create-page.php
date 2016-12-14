<?php

// Import libraries before anything
include_once("src/dbutils.php");
include_once("src/config.php");
include_once("src/cmsutils.php");

// Users must be logged in to be in an org
checkLogin();
// Each page needs a orgID to put into the database
checkOrgURL();


// for later
$orgID = $_GET['orgID'];


//add the header
include_once("src/header.php");
?>

<div class="row">
	<div class="col-xs-10">
    	<div class="well">
            <form class="form-horizontal" action="input.php?inputType=createPage" method="post" enctype="multipart/form-data">
                <fieldset>
                  <legend class="col-md-offset-2 col-md-10">Edit Page</legend>

                  <div class="form-group">
                    <label for="pageTitle" class="col-md-2 control-label h5">Page Title</label>
                    <div class="col-md-10">
                      <input type="text" class="form-control" id="pageTitle" name="pageTitle" placeholder="Man lands on Moon!">
                      <span class="help-block">Title shown on bookmarks, tab, etc.</span>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="urlTitle" class="col-md-2 control-label h5">URL for your page</label>
                    <div class="col-md-10">
                      <input type="text" class="form-control" id="urlTitle" name="urlTitle" placeholder="bring-nasa-back">
                      <span class="help-block">What word(s) goes into the url that distinguishes this page from others.</span>
                    </div>
                  </div>
                  
                  <div class="form-group">
                  	<label for="pageTitle" class="col-md-2 control-label h5">Include in menu?</label>
                    <div class="col-md-10">
                      <div class="togglebutton">
                        <label>
                          <input type="checkbox">
                        </label>
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group" style="display: none">             
                    <div class="col-md-offset-2 col-md-10">
                      <input type="text" class="form-control" id="menuTitle" name="menuTitle" placeholder="Space Launches">
					  <span class="help-block">This is a longer form, add as much text as you need!</span>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="photoUpload" class="col-md-2 control-label h5">Add a photo</label>
                    <div class="col-md-10">
                      <input type="text" readonly class="form-control" placeholder="Browse...">
                      <input type="file" id="inputFile" multiple>
                    </div>
                  </div>
                  
				  <div class="form-group">
                    <label for="bodyTitle" class="col-md-2 control-label h5">Body Title</label>
                    <div class="col-md-10">
                      <input type="text" class="form-control" id="bodyTitle" name="bodyTitle" placeholder="bring-nasa-back">
                      <span class="help-block">This the title shown for the body of the page.</span>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="bodyText" class="col-md-2 control-label h5">Content</label>
                    <div class="col-md-10">
                      <textarea class="form-control" rows="3" id="body" name="body"></textarea>
                      <span class="help-block">This is a longer form, add as much text as you need!</span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="pagePermission" class="col-md-2 control-label h5">Who can see this? (select multiple)</label>
              
                    <div class="col-md-10">
                      <select id="pagePermission" multiple="" class="form-control">
                        <option checked="">Public</option>
                        <option>Members</option>
                        <option>Org Admins</option>
                      </select>
                    </div>
                  </div>
                  
                  <br>
                  <div class="text-center">
                    <!-- One hidden field for the POST header -->
                      <input type="hidden" name="orgID" value=<?php echo $orgID; ?> />
                      <input type="hidden" name="designID" value="flatly" />
                    
                    <button class="btn btn-lg btn-primary btn-block btn-raised" style="width:100%" type="submit">Get involved!</button> 
                    <button type="button" class="btn btn-default"><a href=<?php echo "org.php?orgID=" . $orgID; ?> >Cancel</a></button>
                  </div>

                </fieldset>
              </form>
        </div>
    </div>
</div>

<?php include('src/footer.php'); ?>