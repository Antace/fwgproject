
<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
if($_SESSION['employee_id']==''){
	Header("Location: index.php");
}
	$dept_name = mysqli_real_escape_string($con,$_POST["dept_name"]);
	$department_name = mysqli_real_escape_string($con,$_POST["department_name"]);
	$check = "
	SELECT  department_name  
	FROM tb_department  
	WHERE 
	department_name = '$department_name'
	";
	
    $result1 = mysqli_query($con, $check) or die(mysqli_error());
    $num=mysqli_num_rows($result1);

    if($num > 0)
    {
     echo '<script>';
	 echo "window.location='department.php?act=add&do=d';";
	 echo '</script>';
    }else{
	
	$sql = "INSERT INTO tb_department
	(dept_name,department_name)
	VALUES
	('$dept_name','$department_name')";
	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());

}
	mysqli_close($con);
	if($result){
	echo '<script>';
    echo "window.location='department.php?do=success';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='department.php?act=add&do=f';";
    echo '</script>';
}
?>