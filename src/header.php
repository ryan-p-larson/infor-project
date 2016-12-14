<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
	<title></title>
    
	<!-- fonts -->
  	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
  	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <!-- css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/css/bootstrap-material-design.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/css/ripples.min.css" />
    <link rel="stylesheet" href="css/jquery.dropdown.css" />
    
    <!-- JS -->
    <script src="http://code.jquery.com/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>  
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/ripples.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/material.min.js"></script>
    <script src="js/jquery.dropdown.js"></script>

    <style>
	  #homeNavbar {
		  box-shadow: 0px 10px 10px -5px rgba(47,44,44,.2);
	  }
	  #loginButton {
		  font-weight:700;  
	  }
	  .orgcards {
		padding-left: 10px;
		padding-right: 10px;
		padding-top: 5px;
		padding-bottom: 5px;
		margin: 0px;
	  }
	  .ui-datepicker {
		  width:100%;
	  }
	  
	  .error-message {
		position: fixed;
		box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
	}
	table_layout: fixed;
	
	.ui-autocomplete {
		z-index: 100;
	}

	</style>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
</head>
<body>


<!-- navbar -->
<nav class="navbar navbar-default">
  <div class="container-fluid"> 
  
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="homeNavBar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span><span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><b>CMS</b></a>
    </div>
  
     
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="navbar-collapse collapse navbar-responsive-collapse" id="homeNavbar">
    
   		<!-- Search -->
      <form class="navbar-form navbar-left" role="search" style="padding-top:none;padding-bottom:none;margin-top:none;margin-bottom:none">
        <div class="form-group">
          <input type="text" class="form-control select" id="navbarSearch" placeholder="Search Orgs">
        </div>
      </form>

      <!-- Right hand side -->
      <ul class="nav navbar-nav navbar-right">
      	<!-- USER HOME IF LOGGED IN -->
        <!-- Org home, also conditional --> 
        
      	<!-- Settings -->
        <li class="dropdown">
        	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            	<?php 
					$stuFName = (isset($_SESSION['stuEmail']) == false) ? "User" : getStuFName($stuID);
					echo $stuFName; 
				?>&nbsp;&nbsp;
                <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
            </a>
          	<ul class="dropdown-menu" role="menu">
            	<li><a href="user-home.php">Home</a></li>
            	<li><a href="#">Organizations</a></li>
            	<li class="divider"></li>
            	<li><a href="#">Settings</a></li>
          	</ul>
        </li>   
       	<?php 
			$loginToggle =(isset($_SESSION['stuEmail']) == false) ? "'login.php'>Log In</a></li>" : "'input.php?inputType=logout'>Log Out</a></li>";
		  	echo "<li><a id='loginButton' href=" . $loginToggle; 
		?>
      </ul>
    </div><!-- /.navbar-collapse --> 
  </div><!-- /.container-fluid --> 
</nav>

<div class="container container-fluid" id="content">