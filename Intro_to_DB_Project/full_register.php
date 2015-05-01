<?php
$response=array();
$f_name=$_POST['f_name'];
$l_name=$_POST['l_name'];
$email=$_POST['email'];
$passwd=$_POST['passwd'];
$addrs=$_POST['addrs'];
$city=$_POST['city'];
$state=$_POST['state'];
$sex=$_POST['sex'];
$contact_no=$_POST['contact_no'];
$dob=$_POST['dob'];
if(($f_name != NULL)&&($l_name != NULL)&&($email != NULL)&&($passwd != NULL)&&($addrs != NULL)&&($city != NULL)&&($state != NULL)&&($sex != NULL)&&($contact_no != NULL)&&($dob != NULL))
{
	$con=mysqli_connect("localhost","root","1234","db_project");
	$result=mysqli_query($con,"INSERT INTO registration(firstname,lastname,email,password,address,city,state,sex,contact_no,b_date) VALUES('$f_name','$l_name','$email','$passwd','$addrs','$city','$state','$sex','contact_no','$dob')");
	if($result)
	{
		$response["success"]=1;
		$response["message"]="Name Changed Successfully!";
header('Location:./searchflat.php');		
echo json_encode($response);
	}
	else
	{
		echo "<h4>already used email</h4>";
		//header('Location:https://www.facebook.com/');
	}
}
else
{
	echo "please fill all the details";
}
?>



