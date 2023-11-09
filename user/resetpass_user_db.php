<?php 

include('../condb.php');
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();

$password = mysqli_real_escape_string($con,$_POST['password']);
$subpass = mysqli_real_escape_string($con,$_POST['m_subpass']);
$employee_id = $_POST['employee_id'];

	if($password == $subpass){

		$sql_resetpass = " UPDATE tb_employee SET
	        password = '$password'
	        WHERE employee_id = '".$employee_id."' ";	
	        $resault_resetpass = mysqli_query($con, $sql_resetpass) or die
			("Error : ".mysqli_error($sql_resetpass));

		if($resault_resetpass){
			//แก้ไขสำเร็จ
			echo '<script>';
			echo "window.location='member.php?do=finish';";
			echo '</script>';
		}else{
			//แก้ไขไม่สำเร็จ
			echo '<script>';
			echo "window.location='member.php?do=wrongpass';";
			echo '</script>';
		}
 	}else{
	 		echo '<script>';
			echo "window.location='member.php?do=wrong';";
			echo '</script>';
 	}

 	

?>