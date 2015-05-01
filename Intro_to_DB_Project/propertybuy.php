<!DOCTYPE html>
<html lang="en">
  <head>
    
<?php
session_start();
?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Property Buy Display Display</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="dataTables.keyTable.css">
    <link rel="stylesheet" type="text/css" href="jquery.dataTables.css">
    <script type="text/javascript" src="dataTables.keyTable.js"></script>
    <script type="text/javascript" src="jquery.dataTables.js"></script>
    <script type="text/javascript" src="dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="jquery.js"></script>

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
        
        <li ><a href="./searchflat.php">Search For Flats</a></li> 
        <li ><a href="./clientdisplay.php">Property For BUY </a></li>
         <li ><a href="./requestsellinsert.php">Request to sell for company</a></li>
              </ul>
      <ul class="nav navbar-nav navbar-right">
    
        
<li ><a href=""><?php echo $_SESSION['user']?> </a></li>

        <li><a href="./logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
    <div class="container">
	<?php


$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "db_project";
$conn =  mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
} 



$abc['1']=$_POST['aaa'];
$abc['2']=$_SESSION["id"];
$abc['3']='Not_Decided';


function fun($p)
{
	global $conn;
	$sql = 'SHOW COLUMNS FROM ';
	$sql .= $p;
	$result = mysqli_query($conn, $sql);   
	$record = array();
	while($record = mysqli_fetch_array($result))
	{ 
     	$fields[] = $record['0'];  	
    } 
	return $fields;
}
$tab = 'propertybuy';


		$che = fun($tab);
		$z=count($che);
		$sql = "INSERT INTO ";
		$sql  .= $tab;
		$sql .= "(";
		$x=1;
		while($x<$z-1)
		{
			$sql .=$che[$x];
			$sql .=",";
			$x=$x+1;
		}
		$sql .= $che[$z-1];
		$sql .=") VALUES ( ";
		$x=1;

		while($x<$z-1)
		{
		$sql .='"';
		$sql .= $abc[$x];
		$sql .='",';
		$x=$x+1;
		}

		$sql .='"';
		$sql .= $abc[$z-1];
		$sql .='")';

	
	//echo $sql;
	
	

		if($conn->query($sql) === TRUE)
	{

		

				echo "<div  class='bs-example'><div class='alert alert-info'><a href='#' class='close' data-dismiss='alert'>&times;</a>";
                echo "Your Requested Accepted";
                echo "</div></div>";
		;
		
		//header('Location: ./insert.php');

		
	}
	else
	{
		
		echo "<div  class='bs-example'><div class='alert alert-info'><a href='#' class='close' data-dismiss='alert'>&times;</a>";
                echo "Already you have submited the Request for this property";
                echo "</div></div>";
		
	}





?>
</div>
</body>
</html>
