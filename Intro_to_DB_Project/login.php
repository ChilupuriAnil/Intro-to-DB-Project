<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DB</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
     <link href="css/login.css" rel="stylesheet">	
  </head>

  <body>
<?php

if($_GET['name']!=NULL)
{
echo "<div  class='bs-example'><div class='alert alert-info'><a href='#' class='close' data-dismiss='alert'>&times;</a>";
                echo "Re login with updated Profile";
                echo "</div></div>";
		
}
?>
    	
    <div class="wrapper">
  <form class="form-signin" action="full_login.php" method="POST">       
      <h2 class="form-signin-heading">Please login</h2>
	<br>
      <input type="email" class="form-control" name="email" placeholder="Email Address" required="" autofocus="" /><br>
      <input type="password" class="form-control" name="passwd" placeholder="Password" required=""/><br>      
      <label class="checkbox">
        <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
      </label>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button><br> 
	<div class="signup"> <a href="index.html">create account</a>
	</div>   
   </form>
	
  </div>	
    <script src="./jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

  </body>
</html>
