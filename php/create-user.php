<?php
    include_once("dbutils.php");
    include_once("config.php");
	
	$pageTitle = "Create User";
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
            <a href="#">Link to index of site</a>
        </div>
    </div>  
</div>

<div class="row">
<div class="col-xs-12">
<form action="insertpage.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="urlTitle">URL Title</label>
        <input type="text" class="form-control" name="urlTitle"/>
    </div>
    
    <div class="form-group">
        <label for="parent">Parent Page</label>
        <?php echo $selectStatement ?>
    </div>
    
    <div class="form-group">
        <label for="pageTitle">Page Title</label>
        <input type="text" class="form-control" name="pageTitle"/>
    </div>
    
    <div class="form-group">
        <label for="menuTitle">Menu Title</label>
        <input type="text" class="form-control" name="menuTitle"/>
    </div>
    
    <div class="form-group">
        <label for="bodyTitle">Body Title</label>
        <input type="text" class="form-control" name="bodyTitle"/>
    </div>
    
    <div class="form-group">
        <label for="body">Body</label>
        <textarea class="form-control" name="body" rows="5"></textarea>
    </div>
    
    <button type="submit" class="btn btn-default">Add</button>
</form>
</div> <!-- close column -->
</div> <!-- close row -->



</div> <!-- Closing container div -->

<!-- Code for editing form -->
<div id="dialog-form" title="Edit page" style="display: none">
<form>
    <fieldset>
    <div class="form-group">
        <label for="editurlTitle">URL Title</label>
        <input type="text" class="form-control" name="editurlTitle" id="editurlTitle"/>
    </div>
    
    <div class="form-group">
        <label for="editparent">Parent Page</label>
        <?php echo $editselectStatement ?>
    </div>
    
    <div class="form-group">
        <label for="editpageTitle">Page Title</label>
        <input type="text" class="form-control" name="editpageTitle" id="editpageTitle"/>
    </div>
    
    <div class="form-group">
        <label for="editmenuTitle">Menu Title</label>
        <input type="text" class="form-control" name="editmenuTitle" id="editmenuTitle"/>
    </div>
    
    <div class="form-group">
        <label for="editbodyTitle">Body Title</label>
        <input type="text" class="form-control" name="editbodyTitle" id="editbodyTitle"/>
    </div>
    
    <div class="form-group">
        <label for="editbody">Body</label>
        <textarea class="form-control" name="editbody" id="editbody" rows="5"></textarea>
    </div>
    
    <input type="hidden" name="editid" id="editid"/>
    </fieldset>
</form>    
    


</body>
</html>