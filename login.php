<?php

// Import libraries before anything
include_once("src/dbutils.php");
include_once("src/config.php");
include_once("src/cmsutils.php");

include("src/header.php");
?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
    	<div class="well">
            <form class="form-horizontal form-signin" action="input.php?inputType=login" method="post" enctype="multipart/form-data">
                <fieldset>
                  <legend class="col-md-offset-2 col-md-10">Login</legend>

                  <div class="form-group"> 
                    <label for="stuEmail" class="col-md-2 control-label h5">Email</label>
                    <div class="col-md-10">
                      <input type="text" class="form-control" name="stuEmail" id="stuEmail" placeholder="Email" required="" autofocus/>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="stuHashPass" class="col-md-2 control-label">Password</label>
                    <div class="col-md-10">
                      <input type="password" class="form-control" name="stuHashPass" id="stuHashPass" placeholder="Password" required=""/>
                     </div>
                  </div>
                  <br>           
                  <div class="text-center">
                      <button class="btn btn-primary btn-lg btn-block btn-raised" style="width:100%" type="submit">Continue</button>
                      <br>
                      <span class="pull-right h5">Or, create an account.&nbsp;&nbsp;<a href="create-user.php" class="btn btn-primary btn-fab btn-sm"><i class="material-icons">add</i></a>&nbsp;&nbsp;</span>
                  </div>
      			</fieldset>
              </form>
        </div>
    </div>
</div>




<?php include("src/footer.php"); ?>