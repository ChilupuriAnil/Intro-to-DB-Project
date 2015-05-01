<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Works For Display</title>
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
        <li ><a href="./admin_main.html">Home</a></li>
        <li ><a href="./soldinsert.php">Property Sold Insert</a></li>
        <li class="active"><a href="./solddisplay.php">Property Sold Display</a></li>
              </ul>
      <ul class="nav navbar-nav navbar-right">
    
        

        <li><a href="./logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
    <div class="container">
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "db_project";
 $tab = 'PropertySold';
$conn =  mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
} 
if(isset($_POST['del']))
{
    $tab = 'PropertySold';
    $val = $_POST['id'];
    $sql = ' DELETE FROM ';
    $sql .= ' ';
    $sql .= $tab;
    $sql .= ' WHERE S_No=';
    $sql .= $val;
     if (mysqli_query($conn, $sql))
    { 
        
        echo "<div  class='bs-example'><div class='alert alert-info'><a href='#' class='close' data-dismiss='alert'>&times;</a>";
                echo "Record deleted successfully";
                echo "</div></div>";
        
    }
    else
    {
        
        echo "<div  class='bs-example'><div class='alert alert-info'><a href='#' class='close' data-dismiss='alert'>&times;</a>";
                echo "Error deleting record: " . mysqli_error($conn);
                echo "</div></div>";
    
    }
} 


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


$arr = array();
$arr = fun($tab);
$k = count($arr);
$sql = 'SELECT * FROM';
$sql .=' ';
$sql .= $tab;
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0)
{
    $field = array();
    while($row = mysqli_fetch_assoc($result))
    {
    	$field[]=$row;   
    }
 	$p = ' ';
 	$i=0;
 	$j=1;
	$c=count($field);	
    $q = ' ';
    while($j<$k)
    {
    	$q .= "<th>" .$arr[$j]."</th>";
    	$j=$j+1;
    }
	$j=1;
 	while($i<$c)
 	{
 		$j=1;
 		while($j<$k)
 		{
 			$p .= "<td>".$field[$i][$arr[$j]]."</td>";
 			$j =$j+1;
 		}
 		
 		
 		$p .='<td>
 		<form class="form-horizontal" action = "solddisplay.php" method="post">
  		<fieldset>
  		<div class="col-lg-10 col-lg-offset-2">
        		<button type="submit" name ="del" class="btn btn-primary">Delete</button>
        		<input type="hidden" name = "id" value='.$field[$i]["S_No"]. '>
      			</div></fieldset>
        </form></td>';
        $p .='<td>
        <form class="form-horizontal" action = "soldupdate.php" method="post">
        <fieldset>
        <div class="col-lg-10 col-lg-offset-2">
                <button type="submit" class="btn btn-primary">Update</button>
                <input type="hidden" name = "id" value='.$field[$i]["S_No"]. '>
                </div></fieldset>
        </form></td>';
      			$p .="</tr><tr>";
      			$i=$i+1;
 	}
    echo '<legend>Property Sold to Details</legend><table class="table table-striped table-hover"> <thead><tr>'; 
    echo $q;
    echo"</tr></thread><tr><tbody>";
    echo $p;
    echo "</tr><tr></tr></tbody</table>";

} 
else 
{
    echo "0 results";
}
$conn->close();
?>
</div>

</body>
<script src="./jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
