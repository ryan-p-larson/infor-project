<?php

// Import libraries before anything
include_once("src/dbutils.php");
include_once("src/config.php");
include_once("src/cmsutils.php");

// Users must be logged in to create an org
checkLogin();

// Requires orgID to render
validateURL('orgID', 'user-home.php');
$orgID = $_GET['orgID'];
$orgName = singleValueOrg($orgID, 'orgName');

$stuID = getStuID($_SESSION['stuEmail']);
//isOrgMember($orgID, $stuID);


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
            
            <?php joinOrgButton($orgID, $stuID); ?>
            <br><hr>              
            <ul class="nav nav-pills nav-justified">
              <li class="active btn btn-link"><a data-toggle="pill" href="#home">Home</a></li>
              <li class="btn btn-link"><a data-toggle="pill" href="#news">News</a></li>
              <li class="btn btn-link"><a data-toggle="pill" href="#pages">Pages</a></li>
              <li class="btn btn-link"><a data-toggle="pill" href="#members">Members</a></li>
            </ul>
            
            <!-- Org Content -->
            <div class="tab-content">
              <div id="home" class="tab-pane fade in active">
                  <h3>Home</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

              </div>           
              <div id="news" class="tab-pane fade">
                  <h3>News</h3>
                  <div id="datepicker" style="margin: 0 auto;"></div>
              </div>
              <div id="pages" class="tab-pane fade">
                  <h3>Manage your content here</h3>
                  
                  <?php orgPageDash($orgID, $stuID); ?>
                  <table class="table table-hover" id="orgPages">
                    <thead class="thead-inverse">
                        <tr>
                          <th>Title</th>
                          <th>URL</th>
                          <th>Edit</th>
                          <th>Delete</th>
                       </tr>
                   </thead>
                   <!-- Insert org pages -->
                   <tbody id="orgPagesBody" ><?php getOrgPages($orgID); ?></tbody>
                </table>
                <span class="pull-right">Add a page&nbsp;&nbsp;<a href=<?php echo "'create-page.php?orgID=" . $orgID . "'"; ?>class="btn btn-primary btn-fab"><i class="material-icons">add</i></a>&nbsp;&nbsp;</span> 
              </div>                
              <div id="members" class="tab-pane fade">
                  <h3>Members: peep your peeps.</h3>
                  <br>
                  
                  <?php orgUserDash($orgID, $stuID); ?>	
                  <table class="table table-hover" id="orgUsers">
                    <thead class="thead-inverse">
                        <tr>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Role</th>
                          <th>Permissions</th>
                       </tr>
                   </thead>
                   <tbody id='orgUserTable' ><?php getOrgMembers($orgID); ?></tbody>
                </table>
                <span class="pull-right">Add a member&nbsp;&nbsp;<a href='#' class="btn btn-primary btn-fab"><i class="material-icons">add</i></a>&nbsp;&nbsp;</span>          
              </div>                
            </div><!-- end tab-content -->
             
			</div><!-- end styled row -->
		</div><!-- end well -->
	</div><!-- end col-xs-12 -->
</div><!-- end row -->

<!-- Instantiate a hidden div for the dialog -->
<div id='editPageDialog' class="modal">
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"  onclick="$('#editPageDialog').fadeOut(300).dialog('close');" aria-hidden="true">×</button>
      <h4 class="modal-title h4">Edit Page</h4>
    </div>
    <div class="modal-body">
    <form class="form form-horizontal" title='Edit Page' id='editPageDialogForm'>
      <fieldset>
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
            <input type="text" class="form-control" id="urlTitle" name="urlTitle">
            <span class="help-block">What word(s) goes into the url that distinguishes this page from others.</span>
          </div>
        </div>
        
        <div class="form-group" style="margin-top: 0;">
          <div class="col-md-offset-2 col-md-10">
            <div class="checkbox">
              <label>
                <input type="checkbox"> Checkbox
              </label>
            </div>
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
            <input type="text" class="form-control" id="menuTitle" name="menuTitle">
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
            <input type="text" class="form-control" id="bodyTitle" name="bodyTitle">
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
        
        <input type="hidden" name="orgID" value=<?php echo $orgID; ?> />
        <input type="hidden" name="designID" value="flatly" />
        <input type="hidden" id="editPageID" name="pageID" value="" />
      </fieldset>
    </form>
    </div><!-- end modal body -->  
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal" onclick="$('#editPageDialog').fadeOut(300).dialog('close');">Cancel</button>
      <button id='editPageDialogSave' type="button" class="btn btn-primary" onclick="sendEditPage();">Save changes</button>
    </div>
    
  </div><!-- end modal content -->
  </div><!-- end modal dialog -->
</div><!-- end modal -->

<div id='deletePageDialog' class="modal">
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"  onclick="$('#deletePageDialog').fadeOut(300).dialog('close');" aria-hidden="true">×</button>
      <h4 class="modal-title h4">Delete Page</h4>
    </div>
    <div class="modal-body">
    	<p><strong>Are you sure</strong> you want to delete this page?</p>
	</div>
    <div class="modal-footer">
    	<input type="hidden" id="deletePageID" name="deletePageID" value="" />
  		<button type="button" class="btn btn-default" data-dismiss="modal" onclick="$('#deletePageDialog').fadeOut(300).dialog('close');">Cancel</button>
  		<button id='deletePageButton' type="button" class="btn btn-danger" onclick="sendDeletePage();">I'm sure</button>
	</div>

	</div><!-- end modal content -->
</div><!-- end modal dialog -->
</div><!-- end modal -->
    

<script type="application/javascript">
function editRecord(pageID, pageTitle, urlTitle, menuTitle, bodyTitle, body, pageID) {
		
	// Fill in form values, painfully
	document.getElementById('pageTitle').value = pageTitle;
	document.getElementById('urlTitle').value = urlTitle;
	document.getElementById('menuTitle').value = menuTitle;
	document.getElementById('bodyTitle').value = bodyTitle;
	document.getElementById('body').value = body;
	document.getElementById('editPageID').value = pageID;
	
	// Open the dialog box for editing
  	$("#editPageDialog").dialog("open");
}
function deletePageOpen(pageID) {
	// Set the hidden field to hold our pageID to pass to the php
	document.getElementById('deletePageID').value = pageID;
	// Open dialog
	$('#deletePageDialog').dialog("open");
}

// Edit popup
$("#editPageDialog").dialog({
	autoOpen: false,
	width: 600,
	modal: true
});
// Delete dialog
$('#deletePageDialog').dialog({
	autoOpen: false,
	width: 600,
	modal: true
});

// Datepicker
$("#datepicker").datepicker({
	inline: true
});

function sendEditPage() {
	
	// grab the form data
	var formData = $("#editPageDialogForm").serialize();
	var pageID = $('#editPageID').val();
	var title = $('#bodyTitle').val();
	
	$.ajax({
		type: "POST",
		url: "testInput.php?inputType=editPage",
		data: formData,
		dataType:"json",
		success: function(data) { 
			// Invoke our handy dandy alert div
			bootstrapAlert(data.message, data.class);
			// Change titles here
			$(('#pageID' + pageID)).value = title;
		},
  });
  $('#editPageDialog').fadeOut(300).dialog('close');
}
function sendDeletePage() {
	var formData = {'pageID': $("#deletePageID").val()};
	
	//console.log(formData);
	$('#deletePageDialog').fadeOut(300).dialog('close');
	
	$.ajax({
		type: "POST",
		url: "testInput.php?inputType=deletePage",
		data: formData,
		dataType:"json",
		success: function(data) { 
			// Invoke our handy dandy alert div
			bootstrapAlert(data.message, data.class);
			if (data.class == 'success') {
				$(('#pageID' + formData.pageID)).fadeOut(200).remove();
			}
		},
  });
}

function deleteUser(orgID, studentID) {
	var packet = {'stuID': studentID, 'orgID':orgID	};
	
	$.ajax({
		type: "POST",
		url: "testInput.php?inputType=deleteUser",
		data: packet,
		dataType:"json",
		success: function(data) { 
			// Invoke our handy dandy alert div
			bootstrapAlert(data.message, data.class);
			// Change titles here
			$(('#queuedMem' + studentID)).fadeOut(300).remove();
		},
		fail: function(jqXHR, textStatus) {
			bootstrapAlert(textStatus, "danger");	
		}
	});
}
function updateUser(orgID, studentID, permission) {
	var packet = {'stuID': studentID, 'orgID':orgID, 'memPermissions': permission};
	
	$.ajax({
		type: "POST",
		url: "testInput.php?inputType=updateUser",
		data: packet,
		dataType:"json",
		success: function(data) { 
			// Invoke our handy dandy alert div
			bootstrapAlert(data.message, data.class);
			// Change titles here
			$(('#queuedMem' + studentID)).addClass('success');
			$(('#queuedMem' + studentID)).prependTo('#orgUserTable');
			
		},
		fail: function(jqXHR, textStatus) {
			bootstrapAlert(textStatus, "danger");	
		}
  });
}

function approvePage(pID) {
	var packet = {'pageID': pID };
	
	$.ajax({
		type: "POST",
		url: "testInput.php?inputType=approvePage",
		data: packet,
		dataType:"json",
		success: function(data) { 
			// Invoke our handy dandy alert div
			bootstrapAlert(data.message, data.class);
			
			// Change the icons
			var icon = $(('#approvePageID' + pID)).find('i')[0];
			icon.innerText = "edit";
			icon.css({color: 'orange'});
			
			// Change titles here
			$(('#approvePageID' + pID)).prependTo('#orgPagesBody');
			// Change the icons
			var icon = $(('#approvePageID' + pID)).find('i')[0].innerText = "edit"
		},
		fail: function(jqXHR, textStatus) {
			bootstrapAlert(textStatus, "danger");	
		}
	});
}
function deletePage(pID) {
	var packet = {'pageID': pID };
	
	$.ajax({
		type: "POST",
		url: "testInput.php?inputType=deletePage",
		data: packet,
		dataType:"json",
		success: function(data) { 
			// Invoke our handy dandy alert div
			bootstrapAlert(data.message, data.class);
			// Change titles here
			$(('#unapprovedPageID' + pID))
				.fadeOut(300)
				.complete(function() {
					$(this).remove();
				});
		},
		fail: function(jqXHR, textStatus) {
			bootstrapAlert(textStatus, "danger");	
		}
	});
}



</script>
</div><!-- end container from header -->
<?php include("src/footer.php"); ?>