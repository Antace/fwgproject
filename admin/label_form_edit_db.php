<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();
if($_SESSION['employee_id']==''){
	Header("Location: index.php");
}
	$label_id = mysqli_real_escape_string($con,$_POST["label_id"]);
	$label_name = mysqli_real_escape_string($con,$_POST["label_name"]);
	$label_detail = mysqli_real_escape_string($con,$_POST["label_detail"]);
	$label_price = mysqli_real_escape_string($con,$_POST["label_price"]);
	$label_pic11 = mysqli_real_escape_string($con,$_POST["label_pic11"]);
	$label_pic22 = mysqli_real_escape_string($con,$_POST["label_pic22"]);
	$username = mysqli_real_escape_string($con,$_POST["username"]);
	


	$date1 = date("Ymd_His");
	$numrand = (mt_rand());
	$prodcut_img = (isset($_POST['label_pic1'])? $_POST['label_pic1'] : '');
	$upload=$_FILES["label_pic1"]['name'];
	if($upload !='') { 
		$path="../label_img/";
		$type = strrchr($_FILES['label_pic1']['name'],".");
		$newname =$numrand.$date1.$type;
		$path_copy=$path.$newname;
		$path_link="../label_img/".$newname;
		move_uploaded_file($_FILES['label_pic1']['tmp_name'],$path_copy); 
	}else {
        $newname=$label_pic11;
    }

	$date2 = date("Ymd_His");
	$numrand1 = (mt_rand());
	$prodcut_img1 = (isset($_POST['label_pic2']) ? $_POST['label_pic2'] : '');
	$upload1=$_FILES['label_pic2']['name'];
	if($upload1 !='') { 
		$path1="../label_img/";
		$type1 = strrchr($_FILES['label_pic2']['name'],".");
		$newname1 =$numrand1.$date2.$type1;
		$path_copy1=$path1.$newname1;
		$path_link1="../label_img/".$newname1;
		move_uploaded_file($_FILES['label_pic2']['tmp_name'],$path_copy1); 
	}else {
        $newname1=$label_pic22;
    }



	
	$sql = "UPDATE tb_label SET 
	label_name='$label_name',
	label_detail='$label_detail',
	label_price='$label_price',
	label_pic1='$newname',
	label_pic2='$newname1',
	username='$username'
	WHERE label_id=$label_id
	 ";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
	mysqli_close($con);
	
	if($result){
	echo '<script>';
    echo "window.location='label.php?do=finish';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='label.php?act=add&do=f';";
    echo '</script>';
}

?>