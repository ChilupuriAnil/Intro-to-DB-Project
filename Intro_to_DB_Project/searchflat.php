<!DOCTYPE html>
<html lang="en">
  <head>
<?php
session_start();
?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Request To Sell</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-inverse" role="navigation">
  <div class="container-fluid">
    
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
        <li class="active"><a href="./searchflat.php">Search For Flat</a></li>
        <li ><a href="./clientdisplay.php">Property For Buy</a></li>
        <li ><a href="./requestsellinsert.php">Request to sell for company</a></li>
      
        <li ><a href="./clientpropertydisplay.php">Your Requests For Buying </a></li>
        
        <li ><a href="./clientpropertyselldisplay.php">Your Requests for Selling </a></li>
        
              </ul>
      <ul class="nav navbar-nav navbar-right">
    
        
<li ><a href="./profileupdate.php"><?php echo $_SESSION['user']?> </a></li>
        <li><a href="./logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
    <div class="container">
    <form class="form-horizontal" method="post" action="clientdisplay.php">
  <fieldset>
    <legend>Seach by Fields For Property to Buy</legend>
    <div class="form-group">
      <label class="col-lg-2 control-label" >Type</label>
      <div class="col-lg-10">
        <div class="radio">
          <label>
            <input type="radio"  id="optionsRadios1"  name='9' value="Plot"  >
            Plot
          </label>
        </div>
        <div class="radio">
          <label>
            <input type="radio"  id="optionsRadios2"  name='9' value="Flat" >
            Flat
          </label>
        </div>
      </div>
    </div>
    <div class="form-group">
  <label class="control-label" for="inputDefault">From Price</label>
  <input type="number" class="form-control" id="inputDefault" name="1">
</div>
<div class="form-group">
  <label class="control-label" for="inputDefault">To price</label>
  <input type="number" class="form-control" id="inputDefault" name="2">
</div>
<div class="form-group">
  <label class="control-label" for="inputDefault">Place District</label>
  <input type="text" class="form-control" id="inputDefault" name="3" pattern="^[a-zA-Z0-9_.-]*$">
</div>
<div class="form-group">
  <label class="control-label" for="inputDefault">Place Mandal</label>
  <input type="text" class="form-control" id="inputDefault" name="4" pattern="^[a-zA-Z0-9_.-]*$">
</div>
<div class="form-group">
  <label class="control-label" for="inputDefault">Place Village</label>
  <input type="text" class="form-control" id="inputDefault" name="5" pattern="^[a-zA-Z0-9_.-]*$">
</div>
<div class="form-group">
  <label class="control-label" for="inputDefault">Pincode</label>
  <input type="number" class="form-control" id="inputDefault" name="6">
</div>
<div class="form-group">
  <label class="control-label" for="inputDefault">From Area</label>
  <input type="text" class="form-control" id="inputDefault" name="7">
</div><div class="form-group">
  <label class="control-label" for="inputDefault"> To Area</label>
  <input type="text" class="form-control" id="inputDefault" name="8">
</div>

<div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
</fieldset>
</form>
    </div>
</body>
</html>