<?php

// Import libraries before anything
include_once("src/dbutils.php");
include_once("src/config.php");
include_once("src/cmsutils.php");

// Make sure a user is logged in before allowing them to see their homepage
checkLogin();
$stuID = $_SESSION['stuID'];
//add the header
include_once("src/header.php");
?>

<div class="row">
	<div class="col-md-10 col-xs-12">
    	<div class="well">
        	<div class="row" style="padding:10px">
            
            <!-- Org Header -->
                <h1><?php echo "Hello, " . singleValueStu($stuID, 'stuFirstName') . "."; ?>
                    <small class="text-muted">Engage at Iowa.</small>
                </h1>
                <br><br><br>
                
                <ul class="nav nav-pills nav-justified">
                  <li class="active"><a data-toggle="pill" href="#home">Home</a></li>
                  <li class=""><a data-toggle="pill" href="#orgs">Organizations</a></li>
                  <li class=""><a data-toggle="pill" href="#settings">Settings</a></li>
                </ul>
            <hr>
            <!-- Org Content -->
            <div class="tab-content">
              <div id="home" class="tab-pane fade in active">
                  <h3>Home</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              </div>           
              <div id="orgs" class="tab-pane fade">
                  <h3>Your Organizations</h3>
                  <p></p>
                  <table class="table table-hover" id="infoTable">
                    <thead class="thead-inverse">
                        <tr>
                          <th>Name</th>
                          <th>Announcements</th>
                          <th>Permissions</th>
                          <th>Home Page</th>
                       </tr>
                   </thead>
                   <tbody><?php getStuOrgs(getStuID($_SESSION['stuEmail'])); ?></tbody>
                </table>
                <span class="pull-right h5">Or, create your own.&nbsp;&nbsp;<a href='create-org.php' class="btn btn-primary btn-fab"><i class="material-icons">add</i></a>&nbsp;&nbsp;</span>  
              </div>
              <div id="settings" class="tab-pane fade">
              		
              	<?php adminDashboard(); ?>
                    
                <h3>Manage your account here.</h3>
                  
               		<form class="form-horizontal" action="testInput.php?inputType=updateUser" method="post" enctype="multipart/form-data">
                      <fieldset>                       
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
                              <input type="hidden" name="inputType" value="updateUser" />     
                              
                              <button class="btn btn-lg btn-primary btn-block btn-raised" style="width:100%" type="submit">Save</button>
                          </div>
                      </fieldset>
                    </form>
                  
                </div>                
                    
            </div><!-- end tab-content -->
             
			</div><!-- end styled row -->
		</div><!-- end well -->
	</div><!-- end col-xs-12 -->
</div><!-- end row -->


</div> <!-- Close header container -->
<script type="application/javascript">





</script>
<?php include_once("src/footer.php"); ?>