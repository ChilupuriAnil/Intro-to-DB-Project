<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
$a=$_GET['name'];
session_unset();
session_destroy();
if($a!=NULL)
{

header('Location:./login.php?name="anil"');
}
else
{
header("Location: ./login.php");
}
exit();
?>

</body>
</html>
