<?php 
	
	// Get our functions before we load the HTML
	include_once("dbutils.php");
    include_once("config.php");
	include_once("src/cmsutils.php");
	
	include_once("src/header.php");
?>

<div class="row">
	<div class="col-md-10 col-md-offset-1 col-xs-12">
    	<div class="well">
        
         <form class="form-horizontal" action="input.php?inputType=createUser" method="post" enctype="multipart/form-data">
              <fieldset>
                <legend class="col-md-offset-2 col-md-10">Create an Account</legend>
                
                  <div class="form-group">
                      <label for="stuID" class="col-md-2 control-label h5">Student ID</label>
                      <div class="col-md-10">
                      	<input type="text" class="form-control" name="stuID" placeholder="1234567" />
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="stuFirstName" class="col-md-2 control-label h5">First Name</label>
                      <div class="col-md-10">
                      	<input type="text" class="form-control" name="stuFirstName" placeholder="John" />
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="stuLastName" class="col-md-2 control-label h5">Last Name</label>
                      <div class="col-md-10">
                      	<input type="text" class="form-control" name="stuLastName" placeholder="Smith" />
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="stuPhone" class="col-md-2 control-label h5">Phone Number</label>
                      <div class="col-md-10">
                      	<input type="text" class="form-control" name="stuPhone" placeholder="(000) 555-5555" />
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="stuEmail" class="col-md-2 control-label h5">Student Email</label>
                      <div class="col-md-10">
                      	<input type="text" class="form-control" name="stuEmail" placeholder="john-smith@uiowa.edu" />
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="stuHashPass" class="col-md-2 control-label h5">Password</label>
                      <div class="col-md-10">
                      	<input type="password" class="form-control" name="stuHashPass" placeholder="pass" />
                      </div>
                  </div>
                  <div class="text-center">
                      <!-- One hidden field for the POST header -->
                      <input type="hidden" name="inputType" value="createUser" />     
                      
                      <button class="btn btn-lg btn-primary btn-block btn-raised" style="width:100%" type="submit">Show me the organizations!</button>
                      <button type="button" class="btn btn-default"><a href=<?php echo "index.php"; ?> >Cancel</a></button>
                  </div>
              </fieldset>
        </form>
    </div>
		</div> <!-- end card -->
        
	</div> <!-- close column -->
</div> <!-- close row -->




<?php include("src/footer.php"); ?>