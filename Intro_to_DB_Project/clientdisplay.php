<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
session_start();
?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contract Display</title>
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
        <li class="active"><a href="./clientdisplay.php">Property For Buy</a></li>
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


$a['1']=$_POST['1'];
$a['2']=$_POST['2'];
$a['3']=$_POST['3'];
$a['4']=$_POST['4'];
$a['5']=$_POST['5'];
$a['6']=$_POST['6'];
$a['7']=$_POST['7'];
$a['8']=$_POST['8'];
$a['9']=$_POST['9'];
//echo $_POST['9'];
if($a['1']==NULL)
{
$a['1']=0;
}

if($a['2']==NULL)
{
 $a['2']=999999999;   
}

if($a['3']==NULL)
{
    $a['3']='D';
}

if($a['4']==NULL)
{
    $a['4']='D';
    
}

if($a['5']==NULL)
{
    $a['5']='D';
    
}
if($a['9']==NULL)
{
    $a['9']='D';
    
}

if($a['6']==NULL)
{
    $a['6']=0;
}


if($a['7']==NULL)
{
    $a['7']=0;
}
if($a['8']==NULL)
{
    $a['8']=999999999;
}

if($a['7']>$a['8'])
{
    $a['7']=0;
    $a['8']=999999999;
    echo "<div  class='bs-example'><div class='alert alert-info'><a href='#' class='close' data-dismiss='alert'>&times;</a>";
                echo "Please Enter Boundary values correctly For Area";
                echo "</div></div>";
}
if($a['1']>$a['2'])
{
    $a['1']=0;
    $a['2']=999999999;
    echo "<div  class='bs-example'><div class='alert alert-info'><a href='#' class='close' data-dismiss='alert'>&times;</a>";
                echo "Please Enter Boundary values correctly For Price";
                echo "</div></div>";
}
/*if($a[]>$a[])
{
    $a['7']=0;
    $a['8']=999999999;
    echo "<div  class='bs-example'><div class='alert alert-info'><a href='#' class='close' data-dismiss='alert'>&times;</a>";
                echo "Record deleted successfully";
                echo "</div></div>";
}*/


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

$tab = 'Property';
$arr = array();
$arr = fun($tab);
$_SESSION["tab"] = $tab;
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
 	$j=0;
	$c=count($field);	
    $q = ' ';
    while($j<$k)
    {
    	$q .= "<th>" .$arr[$j]."</th>";
    	$j=$j+1;
    }
	$j=0;
  $a['10']='NotSold';
 	while($i<$c)
 	{
   // echo$field[$i][$arr['9']];
        if($field[$i][$arr['9']]==$a['10'])
        {
        if($field[$i][$arr['7']]<=$a['2'] && $field[$i][$arr['7']]>=$a['1'] &&$field[$i][$arr['8']]<=$a['8']&&$field[$i][$arr['8']]>=$a['7'])
        {
            if(($field[$i][$arr['6']]==$a['6'] && $a['6']!=0 )||($a['6']==0))
            {
             if((strtolower($field[$i][$arr['5']])==strtolower($a['3']) && ($a['6']!='D') )||($a['3']=='D'))
            {
            if((strtolower($field[$i][$arr['4']])==strtolower($a['4']) && ($a['6']!='D' ) )||($a['4']=='D'))
            {
            if((strtolower($field[$i][$arr['3']])==strtolower($a['5']) && ($a['6']!='D' ) )||($a['5']=='D'))
            {
            if((strtolower($field[$i][$arr['1']])==strtolower($a['9']) && ($a['9']!='D' ) )||($a['9']=='D'))
            {   
  //              echo  $field[$i][$arr['1']];
    //            echo $a['9'];
 		$j=0;
 		while($j<$k)
 		{

 			$p .= "<td>".$field[$i][$arr[$j]]."</td>";
 			$j =$j+1;
 		}
 		
 		
 		        $p .='<td>
        <form class="form-horizontal" action = "propertybuy.php" method="post">
        <fieldset>
        <div class="col-lg-10 col-lg-offset-2">
                <button type="submit" class="btn btn-primary">Buy</button>
                <input type="hidden" name = "aaa" value='.$field[$i]["PropertyID"].'>
                </div></fieldset>
        </form></td>';
      			$p .="</tr><tr>";
            }}}}}}}
      			$i=$i+1;
 	}
    echo '<legend> Available Properties as per your requests </legend><table class="table table-striped table-hover"> <thead><tr>'; 
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
