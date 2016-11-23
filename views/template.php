<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CrediWire coding assignment. [Zeynal Zeynalov]</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <script>
    function showHint(js_project_id,js_action) {
    if (js_project_id.length == 0) { 
        document.getElementById("txtHint" + js_project_id).innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint" + js_project_id).innerHTML = this.responseText;
                document.getElementById("btnAjax" + js_project_id).text = "STOP";
              
              
            }
        };
        //alert("includes/recordprojecttime.php?project_id=" + js_project_id + "&action=" + js_action);
        xmlhttp.open("GET", "includes/recordprojecttime.php?project_id=" + js_project_id + "&action=" + js_action, true);
        xmlhttp.send();
    }
    }
    </script>
    
    
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
          <a class="navbar-brand" href="#">CrediWire Coding Assignment</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Help</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    
    <h4><span class="label label-info">Welcome, Bob!</span>Let's start completing waiting projects!</h4>
    
    <header>
      <a href='/php_mvc_blog'>Home</a>
    </header>
    <form> 
      <?php require_once(dirname(dirname(__FILE__)).'/includes/starter.php'); ?>
    </form>
    

    <footer>
      CrediWire coding assignment. [Zeynal Zeynalov]
    </footer>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
