<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>CrediWire coding assignment. [Zeynal Zeynalov]</title>

		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script type="text/javascript" src="js/mainscript.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>    
	</head>
	<body>
      <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="https://crediwire.herokuapp.com/">CrediWire Coding Assignment</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <!--li class="active"><a href="#">Dummy<span class="sr-only">(current)</span></a></li-->
            <li class="dropdown">
          <a href="#" class="btn-default dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">API DEMO<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="https://crediwire.herokuapp.com/restfulapi/getjson.php/getProjectDetails/1" target="_blank">API - Get Project Details (Project ID = 1)</a></li>
            <li><a href="https://crediwire.herokuapp.com/restfulapi/getjson.php/getProjectTimeRecords/1" target="_blank">API - Get Project Time Records (Project ID = 1)</a></li>
            <li><a href="https://crediwire.herokuapp.com/restfulapi/performaction.php/addnewproject/Test_Project" target="_blank">API - Add New Project (Title: Test Project)</a></li>            
          </ul>
        </li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="https://crediwire.herokuapp.com/help/main">HELP (Documentation)</a></li>
            <li><a href="https://crediwire.herokuapp.com/">Welcome, <b>Bob!</b></a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    
	<header>

	</header>

	<form> 
		<?php require_once(dirname(dirname(__FILE__)).'/includes/starter.php'); ?>
	</form>

	<footer>
		<center>CrediWire coding assignment. [Zeynal Zeynalov]</center>
	<br>
	</footer>
    
    </body>
</html>
