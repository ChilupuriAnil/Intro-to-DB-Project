<!DOCTYPE html>
<html lang="en">
  <head>
      <?php
session_start();
?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Requests For Buying</title>
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
       <li ><a href="./searchflat.php">Search For Flat</a></li>
        <li ><a href="./clientdisplay.php">Property For Buy</a></li>

        <li ><a href="./requestsellinsert.php">Request to sell for company</a></li>
        <li class="active"><a href="./clientpropertydisplay.php">Your Requests For Buying </a></li>
        
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
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "db_project";
$conn =  mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
} 
if(isset($_POST['del']))
{
    $tab = 'propertybuy';
    $val = $_POST['iddd'];
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

$tab = 'propertybuy';
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
	$j=0;
 	while($i<$c)
 	{
        
       // echo $_SESSION['user'];
       $mmm= $_SESSION["id"];
       // echo $field[$i]['UserId'];
        if($mmm == $field[$i]['UserId'])
        {
 		$j=1;
 		while($j<$k)
 		{
            
 			$p .= "<td>".$field[$i][$arr[$j]]."</td>";
        
 			$j =$j+1;
 		}
 		
 		
 		$p .='<td>
 		<form class="form-horizontal" action = "clientpropertydisplay.php" method="post">
  		<fieldset>
  		<div class="col-lg-10 col-lg-offset-2">
        		<button type="submit" name ="del" class="btn btn-primary">Delete</button>
        		<input type="hidden" name = "iddd" value='.$field[$i]["S_No"]. '>
      			</div></fieldset>
        </form></td>';/*
        $p .='<td>
        <form class="form-horizontal" action = "update.php" method="post">
        <fieldset>
        <div class="col-lg-10 col-lg-offset-2">
                <button type="submit" class="btn btn-primary">Update</button>
                <input type="hidden" name = "iddd" value='.$field[$i]["S_No"]. '>
                </div></fieldset>
        </form></td>';*/
      			$p .="</tr><tr>";
            }
      			$i=$i+1;
 	}
    echo '<legend> Your Requests of Buying properties to Comapany are Displayed Here </legend><table class="table table-striped table-hover"> <thead><tr>'; 
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
