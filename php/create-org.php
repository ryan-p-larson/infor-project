<?php
    include_once("dbutils.php");
    include_once("config.php");
	
	$pageTitle = "Create Student Organization";

?>

<html>

<head>
    <title><?php $pageTitle; ?></title>

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
            <h1><?php $pageTitle; ?></h1>

        </div>
    </div>  
</div>

<div class="row">
<div class="col-xs-12">
<form action="input.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="stuFirstName">Organization Name</label>
        <input type="text" class="form-control" name="orgName"/>
    </div>
    
	<div class="form-group">
        <label for="stuFirstName">Organization Description</label>
        <input type="text" class="form-control" name="orgDesc"/>
    </div>
	
	<div class="form-group">
        <label for="stuFirstName">Organization E-mail</label>
        <input type="text" class="form-control" name="orgEmail"/>
    </div>
	
	

    
    <button type="submit" class="btn btn-default">Add</button>
</form>
</div> <!-- close column -->
</div> <!-- close row -->



</div> <!-- Closing container div -->


    


</body>
</html>