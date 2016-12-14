<?php 
// Import libraries before anything
include_once("src/dbutils.php");
include_once("src/config.php");
include_once("src/cmsutils.php");

include("src/header.php"); 
?>


<div class="row">
	<div class="col-lg-10 col-lg-offset-1 col-xs-12">

    <div class="jumbotron">
      <h1 class="text-center" style='font-weight:700' >Content Management System</h1>
      <h3 class="text-center" style='font-weight:700' >Student Organizations @ Iowa</h3>
    
    <br>
    <br>
    <br>
      
    <!-- call outs -->
	<div class="row">
      <div class="text-center col-sm-4">
        <h4><span class="glyphicon glyphicon-search" aria-hidden="true"></span><strong> Discover</strong> new interests</h4>
        <br>
        <p>Find Student organizations that are relevant to you!</p>
      </div>
      <div class="col-sm-4 text-center">
        <h4><span class="glyphicon glyphicon-user" aria-hidden="true"></span><strong> Connect</strong> members</h4>
        <br>
        <p>Easily keep track of your members using our member management tool.</p>
      </div>
      <div class="text-center col-sm-4">
        <h4><span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span><strong> Manage</strong> your Org</h4>
        <br>
        <p>Organize your articles, rearrange media, and customize your site. </p>
      </div>
	</div><!-- End row below large text -->
</div><!-- end jumbotron -->

<hr>

  <!-- Search bar -->
  <div class="row">
  	<div class="orgsearch">
  	  	<input type="search" id="orgSearchBar" class="form-control select" placeholder="Enter a group...">
    </div>
  </div>
  
  </div>


  <hr>
	<!-- Org Grids -->
  <div class="row" id="orgcardsrow">
  	<?php orgCards(4); ?>
  </div><!-- End organization cards -->
  
  <br>
</div> <!-- end container -->
  
<script type="application/javascript">
 
 // Autocomplete
$('#orgSearchBar').autocomplete({
	
	source: function(request, response) {
		$.ajax({
			url: 'testInput.php',
			dataType: "json",
			data: {
				term: request.term,
				inputType: 'search'
			}, 
		minLength: 1,
		dataType: "json"
	}
	
          ); }	});

	
 
</script>

<?php include("src/footer.php"); ?>
