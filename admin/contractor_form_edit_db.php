<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
 //echo "<pre>";
 //print_r($_POST);
 //echo "</pre>";
 //exit();
if($_SESSION['employee_id']==''){
	Header("Location: index.php");
}

	$contractor_id = mysqli_real_escape_string($con,$_POST["contractor_id"]);
	$contractor_name = mysqli_real_escape_string($con,$_POST["contractor_name"]);
	$contractor_nickname = mysqli_real_escape_string($con,$_POST["contractor_nickname"]);
	$contractor_nid = mysqli_real_escape_string($con,$_POST["contractor_nid"]);
	$contractor_file = mysqli_real_escape_string($con,$_POST["contractor_file"]);
	$contractor_expired = mysqli_real_escape_string($con,$_POST["contractor_expired"]);
	$contractor_address = mysqli_real_escape_string($con,$_POST["contractor_address"]);
	$contractor_bank = mysqli_real_escape_string($con,$_POST["contractor_bank"]);
	$account_number = mysqli_real_escape_string($con,$_POST["account_number"]);
	$contractor_file2 = mysqli_real_escape_string($con,$_POST["contractor_file2"]);
	$username = mysqli_real_escape_string($con,$_POST["username"]);

	$date1 = date("Ymd_His");
	$numrand = (mt_rand());
	$prodcut_img = (isset($_POST['contractor_file']) ? $_POST['contractor_file'] : '');
	$upload=$_FILES['contractor_file']['name'];
	$type = strrchr($_FILES['contractor_file']['name'],".");

	if($upload !='') { 
		$path="../contractor_file/";
		$type = strrchr($_FILES['contractor_file']['name'],".");
		$fileNewName =$numrand.$date1.$type;
		$path_copy=$path.$fileNewName;
		$path_link="../contractor_file/".$fileNewName;
		move_uploaded_file($_FILES['contractor_file']['tmp_name'],$path_copy); 
		}
		else {
			$fileNewName=$contractor_file2;
		}

	$sql = "UPDATE tb_contractor SET 
	contractor_name='$contractor_name',
	contractor_nickname='$contractor_nickname',
	contractor_nid='$contractor_nid',
	contractor_file='$fileNewName',
	contractor_expired='$contractor_expired',
	contractor_address='$contractor_address',
	contractor_bank='$contractor_bank',
	account_number='$account_number',
	username='$username'
	WHERE contractor_id=$contractor_id
	 ";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
	mysqli_close($con);
	
	if($result){
	echo '<script>';
    echo "window.location='contractor.php?do=finish';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='contractor.php?act=add&do=f';";
    echo '</script>';
}
?>