<?php
    include_once("dbutils.php");
    include_once("config.php");
?>

<html>

<head>
    <title>Test</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="http://code.jquery.com/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>    
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
      
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />
    
</head>

<body> 
<div class="container" style="width: 1024px">

<div class="row">
    <div class="col-xs-12">
        <div class="page-header">
            <!-- Header -->
            <h1>Test</h1>
            <a href="#">Link to index of site</a>
        </div>
    </div>  
</div>

<div class="row">
	<div class="col-xs-12">
		<form action="input.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="stuID">Student ID</label>
				<input type="text" class="form-control" name="stuID" placeholder="1234567" />
			</div>
			
			<div class="form-group">
				<label for="stuFirstName">First Name</label>
				<input type="text" class="form-control" name="stuFirstName" placeholder="John" />
			</div>
			
			<div class="form-group">
				<label for="stuLastName">Last Name</label>
				<input type="text" class="form-control" name="stuLastName" placeholder="Smith" />
			</div>
			
			<div class="form-group">
				<label for="stuPhone">Phone Number</label>
				<input type="text" class="form-control" name="stuPhone" placeholder="(000) 555-5555" />
			</div>
			
			<div class="form-group">
				<label for="stuEmail">Student Email</label>
				<input type="text" class="form-control" name="stuEmail" placeholder="john-smith@uiowa.edu" />
			</div>
			
			<div class="form-group">
				<label for="stuHashPass">Password</label>
				<input type="text" class="form-control" name="stuHashPass" placeholder="pass" />
			</div>
			
			<!-- One hidden field for the POST header -->
			<input type="hidden" name="inputType" value="user" />
			
			<button type="submit" class="btn btn-default">Add</button>
		</form>

	</div> <!-- close column -->
</div> <!-- close row -->



</div> <!-- Closing container div -->
</body>
</html>