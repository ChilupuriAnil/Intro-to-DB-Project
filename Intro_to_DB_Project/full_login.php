<?php
session_start();
if(isset($_SESSION["user"])){
header("location:./login.php");
exit();
}
?>



<?php
$host="localhost"; 
$username="root"; 
$password="1234"; 
$db_name="db_project"; 
$tbl_name="registration"; 


mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");


$email=$_POST['email'];
$passwd=$_POST['passwd'];


$email = stripslashes($email);
$passwd = stripslashes($passwd);
$email = mysql_real_escape_string($email);
$passwd = mysql_real_escape_string($passwd);

$sql="SELECT * FROM registration WHERE email='$email' and password='$passwd'";
$result=mysql_query($sql);
$list=mysql_fetch_array($result);
$id=$list["id"];
$k=$list["identity"];
echo $k;
$count=mysql_num_rows($result);



if($count==1){
echo "u have login";
$_SESSION["id"]=$id;
$_SESSION["user"]=$email;
$_SESSION["password"]=$passwd;
if ($k == 0)
{
header("location:./searchflat.php");
}
else if($k == 1 ){
header("location:./admin_main.html");
}
else
{
header("location:./admin_main.html");
}
exit();
}
else {
echo "Wrong Username or Password";
}
?>



























