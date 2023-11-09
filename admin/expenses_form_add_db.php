
<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
if($_SESSION['employee_id']==''){
	Header("Location: index.php");
}
	
	$expenses_name = mysqli_real_escape_string($con,$_POST["expenses_name"]);
    $username = mysqli_real_escape_string($con,$_POST['username']);
	$check = "
	SELECT  expenses_name  
	FROM tb_expenses  
	WHERE 
	expenses_name = '$expenses_name'
	";
	
    $result1 = mysqli_query($con, $check) or die(mysqli_error($con));
    $num=mysqli_num_rows($result1);

    if($num > 0)
    {
     echo '<script>';
	 echo "window.location='expenses.php?act=add&do=d';";
	 echo '</script>';
    }else{
	
	$sql = "INSERT INTO tb_expenses
	(expenses_name,username)
	VALUES
	('$expenses_name','$username')";
	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));

}
	mysqli_close($con);
	if($result){
	echo '<script>';
    echo "window.location='expenses.php?do=success';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='expenses.php?act=add&do=f';";
    echo '</script>';
}
?>