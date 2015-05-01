
<!DOCTYPE html>
<html lang="en">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css"> 
	<link rel="stylesheet" type="text/css" href="./css/bootstrap-theme.min.css">
	<script type="text/javascript" src="./js/bootstrap.js"></script>
	<script type="text/javascript" src="./js/bootstrap.min.js"></script>
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

</head>

<body>

<div class="container">




<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "db_project";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn)
{
    die("Connection failed: " . mysqli_connect_error());
}

$tab = 'WorksFor';
$val = $_POST['id'];
   if(isset($_POST['Update'])) {
        
        header('location: worksfordisplay.php');
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


$arr = array();
$arr = fun($tab);
$k = count($arr);
$brr = fun1($tab);
$l = count($brr);


$sql = "SELECT DepartmentID FROM Departments";
$result = $conn->query($sql);
$n=0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $aaa[$n]=$row['DepartmentID'];
        $n=$n+1;
    }
}

sort($aaa);

$sql = "SELECT SSN FROM Employee";
$result = $conn->query($sql);
$m=0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $bbb[$m]=$row['SSN'];
        $m=$m+1;
    }
}

sort($bbb);


$sql = 'SELECT * FROM';
$sql .=' ';
$sql .= $tab;
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0)
{
    $field = array();
    $i=0;
    while($row = mysqli_fetch_assoc($result))
    {

    	$field[]=$row;
    	//print_r ($field); 
    	if($field[$i]['S_No'] == $_POST['id'])
    	{
    		$r=$i;
    	}
    	$i=$i+1;   
    }
 	$p = ' ';
 	$i=0;
 	$j=0;
	$c=count($field);	
    $q = ' ';
$i=0;
$p = '';

while($i<$k)
{

    if($i==3)
    {
        $p .='<div class="form-group">
                <label for="select" class="col-lg-2 control-label">DepartmentId</label>
                <div class="col-lg-10">
                <select class="form-control" id="select" name = ';
                $p .= $i;
                $p .= '>';
         $v=0;
        while($v<$n)
        {
          if($field[$r][$i]==$aaa[$v])
            {
                $p .='<option selected';
            }
            else{
         $p .='<option ';
     }
         $p .=' value = ';
         $p .= $aaa[$v];
         $p .= '>';
         $p .= $aaa[$v];
         $p .='</option>';
         $v =$v+1;
        }
         
        $p .= '</select>
      </div>
    </div>';

    }
    elseif($i==1)
    {
        $p .='<div class="form-group">
                <label for="select" class="col-lg-2 control-label">SNN</label>
                <div class="col-lg-10">
                <select class="form-control" id="select" name = ';
                $p .= $i;
                $p .= '>';
         $v=0;
        while($v<$m)
        {
         if($field[$r][$i]==$bbb[$v])
            {
                $p .='<option selected';
            }
            else{
         $p .='<option ';
     }
         $p .=' value = ';
         $p .= $bbb[$v];
         $p .= '>';
         $p .= $bbb[$v];
         $p .='</option>';
         $v =$v+1;
        }
        
        
         
        $p .= '</select>
      </div>
    </div>';

    }
    elseif($i==0)
    {
        $p .=   '<div class="form-group">
                    
                    <input type="hidden" class="form-control" id="inputDefault" placeholder='.$arr[$i].' name='.$i.' value = '.$field[$r][$arr[$i]] .'>
                    </div>';
            
    }
     elseif($brr[$i][0] == 'y')
            {
        //      echo "Yes";
            $p .=   '<div class="form-group">
                    <label class="control-label" for="inputDefault">'.$arr[$i].'</label>
                    <input type="year" class="form-control" id="inputDefault" placeholder='.$arr[$i].' name='.$i.' value = '.$field[$r][$arr[$i]] .' required aria-required=”true” >
                    </div>';
                }

    elseif($brr[$i][0] == 'v'  or $brr[$i][0] =='t')
            {
        //      echo "Yes";
            $p .=   '<div class="form-group">
                    <label class="control-label" for="inputDefault">'.$arr[$i].'</label>
                    <input type="text" class="form-control" id="inputDefault" placeholder='.$arr[$i].' name='.$i.' value = '.$field[$r][$arr[$i]] .'required aria-required=”true”  pattern="^[a-zA-Z0-9_.-]*$">
                    </div>';
            }
            elseif($brr[$i][0] == 'i')
            {
                $p .=   '<div class="form-group">
                    <label class="control-label" for="inputDefault">'.$arr[$i].'</label>
                    <input type ="number" min="1" class="form-control" id="inputDefault" placeholder='.$arr[$i].' name='.$i.' value = '.$field[$r][$arr[$i]] .' required aria-required="true" >
                    </div>';
            }
            elseif($brr[$i][0] == 'e')
            {
        //      print_r ($brr[$i]);
                 $p .= '<div class="form-group">
                        <label class="col-lg-2 control-label">Radios</label>
                        <div class="col-lg-10">';
                $aaa =str_split($brr[$i]);
                $j=6;
                $op = array();
                $t=0;
        //      print_r ($aaa);
                while($j <= count($aaa))
                {   
                    if($brr[$i][$j] != "'" and $brr[$i][$j] != ",")
                    {
                    $op[$t] .= $brr[$i][$j];
                    }
                    elseif($brr[$i][$j] == "'" )
                    {

                        $j=$j+2;
        //              echo "---";
                        $z="optionsRadio";
                        $z .= $t;
        //              echo $z;
                      //  echo $i;
                        if($op[$t] == $field[$r][$arr[$i]])
                        {
                        $p .= '<div class="radio"><label>
                                <input type="radio"    value='.$op[$t].' name='.$i.' checked>'.$op[$t].' </label>
                                </div>';
                        }
                        else
                        {
                            $p .= '<div class="radio"><label>
                                <input type="radio"    value='.$op[$t].' name='.$i.' >'.$op[$t].' </label>
                                </div>';

                        }
                        $t=$t+1;
                    }
                    $j=$j+1;
                    
                }
        //      print_r ($op);
                $p .=  '</div></div>';
            }



//echo "</br>";






$i=$i+1;
}













	echo '<div class="container">
		<form class="form-horizontal" action = "worksforupdate.php" method="post">
  		<fieldset>
    	<legend>Property</legend>';
				echo $p;
			echo '<div class="form-group">
    			<div class="col-lg-10 col-lg-offset-2">
    			
        		
        		        		<button name="Update" type="submit" class="btn btn-primary">Update</button>
      			</div>
    			</div>
			

  			</fieldset>
		</form>
	</div>';
    echo '<div class="container">
        <form class="form-horizontal" action = "worksfordisplay.php" method="post">
        <fieldset>
        ';
                
            echo '<div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                
                <button class="btn btn-default" >Cancel</button>
                                
                </div>
                </div>
            

            </fieldset>
        </form>
    </div>';
}


$sql1  = "UPDATE ";
$sql1 .= $tab;
$sql1 .= " ";
$sql1 .= "SET ";
$i=1;
while($i<$k)
{
$sql1 .= $arr[$i];
$sql1 .= "=\"";
$sql1 .= $_POST[$i];
$sql1 .= "\"";
if ($i != $k - 1) { 
    $sql1 .= ",";
}
$sql1 .= " ";
$i=$i+1;
}
$sql1 .= "WHERE S_No = ";
$sql1 .= "\"".$_POST['0']."\"";
//echo $sql1;
if (mysqli_query($conn, $sql1)) {
    //echo "Record deleted successfully";
 
} else {
   // echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);

?>
</div>
</body>

