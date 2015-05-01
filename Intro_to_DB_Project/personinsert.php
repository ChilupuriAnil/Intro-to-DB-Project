<!DOCTYPE html>
<html lang="en">
  <head>
  	<style>
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
    <title>Clients</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/bootstrap.css"/>
	<link rel="stylesheet" href="./dist/css/bootstrapValidator.min.css"/>
	<script type="text/javascript" src="./jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="./dist/js/bootstrapValidator.min.js"></script>
	<script type="text/javascript" src="./js/bootstrap.js"></script>
	<script type="text/javascript" src="./js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="./datepicker/jquery-ui.css">
  <script src="./datepicker/jquery-1.10.2.js"></script>
	
  <script src="./datepicker/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#date" ).datepicker();
  });
  $.datepicker.setDefaults({
      showOn: 'button', 
      buttonImage: 'images/calendar.gif', 
      buttonImageOnly: true,
      dateFormat: 'yy-mm-dd',
      minDate: '2013-09-10',
      maxDate: '2014-10-10'
});
$('#frm_date').datepicker({
      onSelect: function(selectedDate) {
            $('#to_date').datepicker('option', 'minDate', selectedDate || '2013-09-10');
      }
});
$('#to_date').datepicker({
      onSelect: function(selectedDate) {
            $('#frm_date').datepicker('option', 'maxDate', selectedDate || '2014-10-10');
      }
});

  </script>
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
        <li class="active"><a href="./personnsert.php">Client Insert</a></li>
        <li ><a href="./persondisplay.php">Client Display</a></li>
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
$tab = 'Persons';
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

		$_SESSION['message'] = "ADDED NEW RECORD CORRECTLY";

				echo "<div style='float:right;margin-right:2%;' class='bs-example'><div class='alert alert-info'><a href='#' class='close' data-dismiss='alert'>&times;</a>";
                echo "ADDED NEW RECORD CORRECTLY";
                echo "</div></div>";
		;
		
		//header('Location: ./insert.php');

		
	}
	else
	{
		$_SESSION['message'] = "Error adding record: " . mysqli_error($conn);
		echo "<div style='float:right;margin-right:2%;' class='bs-example'><div class='alert alert-info'><a href='#' class='close' data-dismiss='alert'>&times;</a>";
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
$tab = 'Persons';
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
				if($i==2)
				{
		//		echo "Yes";
			$p .=	'<div class="form-group">
  					<label class="control-label" for="inputDefault">'.$arr[$i].'</label>
  					<input type="text" class="form-control" id="inputDefault" placeholder='.$arr[$i].' name='.$i.'   pattern="^[a-zA-Z0-9_.-]*$">
				    </div>';
				}
				elseif($i!=2)
				{
					if($i==7)
					{
					$p .=	'<div class="form-group">
  					<label class="control-label" for="inputDefault">'.$arr[$i].'</label>
  					<input type="email" class="form-control" id="inputDefault" placeholder='.$arr[$i].' name='.$i.' required aria-required=”true”  >
				    </div>';
					}
					else
					{
						$p .=	'<div class="form-group">
  					<label class="control-label" for="inputDefault">'.$arr[$i].'</label>
  					<input type="text" class="form-control" id="inputDefault" placeholder='.$arr[$i].' name='.$i.' required aria-required=”true”  pattern="^[a-zA-Z0-9_.-]*$">
				    </div>';
					}
				}
			}
			elseif($brr[$i][0] == 'i')
			{
				$p .=	'<div class="form-group">
  					<label class="control-label" for="inputDefault">'.$arr[$i].'</label>
  					<input type ="number" min="1" class="form-control" id="inputDefault" placeholder='.$arr[$i].' name='.$i.' required aria-required=”true”  >
				    </div>';
			}
			elseif($brr[$i][0] == 'd')
			{
				$p .=	'<div class="form-group">
  					<label class="control-label" for="inputDefault">'.$arr[$i].'</label>
  					<input type ="date"  class="form-control" id="date" placeholder='.$arr[$i].' name='.$i.' required aria-required=”true”  >
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
            					<input type="radio"    value='.$op[$t].' name='.$i.' required aria-required=”true” >'.$op[$t].'</label>
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
		<form class="form-horizontal" action = "personinsert.php" method="post">
  		<fieldset>
    	<legend>Person</legend>';
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
</body>
<script src="js/bootstrap.min.js"></script>
</html>
