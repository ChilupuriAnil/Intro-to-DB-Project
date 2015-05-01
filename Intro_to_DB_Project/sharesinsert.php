<!DOCTYPE html>
<html lang="en">
  <head>
  	<style>
  	input:focus + .help,
	input:invalid + .help {
    display:inline-block;
}
  	input:required {
    background:hsl(180, 50%, 90%);
    border:1px solid #999;
}
  	.help {
    display:none;
    font-size:90%;
}
	input:focus + .help {
    display:inline-block;
}
    input:valid,
	input:in-range {
    background:hsl(120, 50%, 90%);
    border-color:hsl(120, 50%, 50%);
	}

	input:invalid,
	input:out-of-range {
    border-color:hsl(0, 50%, 50%);
    background:hsl(0, 50%, 90%);
	}
    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shares Insert</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/bootstrap.css"/>
	<link rel="stylesheet" href="./dist/css/bootstrapValidator.min.css"/>
	<script type="text/javascript" src="./jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="./dist/js/bootstrapValidator.min.js"></script>
	<script type="text/javascript" src="./js/bootstrap.js"></script>
	<script type="text/javascript" src="./js/bootstrap.min.js"></script>
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
        <li class="active"><a href="./sharesinsert.php">Shares Insert</a></li>
        <li ><a href="./sharesdisplay.php">Shares Display</a></li>
              </ul>
      <ul class="nav navbar-nav navbar-right">
    
        

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
$tab = 'Shares';
if(isset($_POST['ins'])) {

		$che = fun($tab);
		$z=count($che);
		$sql = "INSERT INTO ";
		$sql  .= $tab;
		$sql .= "(";
		$x=0;
		while($x<$z-1)
		{
			$sql .=$che[$x];
			$sql .=",";
			$x=$x+1;
		}
		$sql .= $che[$z-1];
		$sql .=") VALUES ( ";
		$x=0;

		while($x<$z-1)
		{
		$sql .='"';
		$sql .= $_POST[$x];
		$sql .='",';
		$x=$x+1;
		}

		$sql .='"';
		$sql .= $_POST[$z-1];
		$sql .='")';

	
	//echo $sql;
	
	

		
	if($conn->query($sql) === TRUE)
	{

		

				echo "<div  class='bs-example'><div class='alert alert-info'><a href='#' class='close' data-dismiss='alert'>&times;</a>";
                echo "ADDED NEW RECORD CORRECTLY";
                echo "</div></div>";
		;
		
		//header('Location: ./insert.php');

		
	}
	else
	{
		
		echo "<div  class='bs-example'><div class='alert alert-info'><a href='#' class='close' data-dismiss='alert'>&times;</a>";
                echo "Error adding record: " . mysqli_error($conn);
                echo "</div></div>";
		
	}
}






function fun1($p)
{
	global $conn;
	$sql = 'SHOW COLUMNS FROM ';
	$sql .= $p;
	$result = mysqli_query($conn, $sql);   
	$record = array();
	while($record = mysqli_fetch_array($result))
	{ 
     	$fields[] = $record['1'];  	
    } 
	return $fields;
}
$tab = 'Shares';
$arr = array();
//$arr = array():
$arr = fun($tab);
$k = count($arr);
$brr = fun1($tab);
$l = count($brr);
//print_r ($brr);


$i=1;
$p = '';
while($i<$k)
{
	
			if($brr[$i][0] == 'v'  or $brr[$i][0] =='t')
			{
		//		echo "Yes";
			$p .=	'<div class="form-group">
  					<label class="control-label" for="inputDefault">'.$arr[$i].' (Should contain only alphabets)</label>
  					<input type="text" class="form-control" id="inputDefault" placeholder='.$arr[$i].' name='.$i.' required aria-required=”true”  pattern="^[a-zA-Z0-9_.-]*$">
				    </div>';
			}
			elseif($brr[$i][0] == 'i')
			{
				$p .=	'<div class="form-group">
  					<label class="control-label" for="inputDefault">'.$arr[$i].'</label>
  					<input type ="number" min="0" class="form-control" id="inputDefault" placeholder='.$arr[$i].' name='.$i.' required aria-required="true">
				    </div>';
			}
			elseif($brr[$i][0] == 'e')
			{
		//		print_r ($brr[$i]);
				 $p .= '<div class="form-group">
      					<label class="col-lg-2 control-label">Radios</label>
      					<div class="col-lg-10">';
				$aaa =str_split($brr[$i]);
				$j=6;
				$op = array();
				$t=0;
		//		print_r ($aaa);
				while($j <= count($aaa))
				{	
					if($brr[$i][$j] != "'" and $brr[$i][$j] != ",")
					{
					$op[$t] .= $brr[$i][$j];
					}
					elseif($brr[$i][$j] == "'" )
					{

						$j=$j+2;
		//				echo "---";
						$z="optionsRadio";
						$z .= $t;
		//				echo $z;
						//echo $i;
						$p .= '<div class="radio"><label>
            					<input type="radio"    value='.$op[$t].' name='.$i.'>'.$op[$t].'</label>
        						</div>';
        				$t=$t+1;
					}
					$j=$j+1;
					
				}
		//		print_r ($op);
				$p .=  '</div></div>';
			}



//echo "</br>";
$i=$i+1;
}

	echo '
		<form id="registrationForm" class="form-horizontal" action = "./sharesinsert.php" method="post">
  		<fieldset>
    	<legend>Shares</legend>';
				echo $p;
			echo '<div class="form-group">
    			<div class="col-lg-10 col-lg-offset-2">
        		<button class="btn btn-default" >Cancel</button>
        		<button type="submit" name="ins" class="btn btn-primary">Submit</button>
      			</div>
    			</div>
			

  			</fieldset>
		</form>
	';
	?>
</div>
	
	
<script src="./jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
