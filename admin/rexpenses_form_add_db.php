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

$strNextSeq = "";

//*** Check Year ***//
$strSQL = "SELECT * FROM tb_prefixrexpenses WHERE 1 ";
$objQuery = mysqli_query($con,$strSQL) or die ("Error Query [".$strSQL."]");
$objResult = mysqli_fetch_array($objQuery);

$date1= date("y")+43;
//*** Check val = year now ***// (ถ้า val = ปี ค.ศ. +43 แล้วเท่ากับปัจจุบัน จะทำการนับต่อ)
if($objResult["val"] == $date1)
{
	$Seq = substr("0000".$objResult["seq"],-4,4);   //*** Replace Zero Fill ***//
	$strNextSeq =$objResult["val"].$objResult["mval"].$Seq;

	//*** Update Next Seq ***//
	$strSQL = "UPDATE tb_prefixrexpenses SET mval = '".date("m")."' ,seq= seq+1 ";
	$objQuery = mysqli_query($con,$strSQL) or die ("Error Query [".$strSQL."]");
}
else  //*** Check val != year now ***// (แต่ถ้าไม่ใช่ ปีปัจจุบัน จะทำการ ขึ้นปีใหม่ เช่น ถ้าปีนี้ 66 แต่ ค่า val = 65 จะเริ่มนับใหม่ เป็นปีปัจจุบันแทน)
{
	$Seq = substr("00001",-4,4);   //*** Replace Zero Fill ***//
	$strNextSeq =$date1.date("m").$Seq;

	//*** Update New Seq ***//
	$strSQL = "UPDATE tb_prefixrexpenses SET val = '".$date1."' , mval='".date("m")."', seq = '1' ";
	$objQuery = mysqli_query($con,$strSQL) or die ("Error Query [".$strSQL."]");
}

// echo $strNextSeq;
// echo '<br>';
// echo $date1;

// exit;


	$rexpenses_date = mysqli_real_escape_string($con,$_POST["rexpenses_date"]);
	$contractor_nickname = mysqli_real_escape_string($con,$_POST["contractor_nickname"]);
	$expenses_name = mysqli_real_escape_string($con,$_POST["expenses_name"]);
	$rexpenses_uom = mysqli_real_escape_string($con,$_POST["rexpenses_uom"]);


	
	$username = mysqli_real_escape_string($con,$_POST["username"]);

	$sql = "INSERT INTO tb_rexpenses
	(
	rexpenses_id,
	rexpenses_date,
	contractor_nickname,
	expenses_name,
	rexpenses_uom,
	username
	)
	VALUES
	(
	'$strNextSeq',
	'$rexpenses_date',
	'$contractor_nickname',
	'$expenses_name',
	'$rexpenses_uom',
	'$username'
	)";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));

	mysqli_close($con);

	if($result){
	echo '<script>';
    echo "window.location='rexpenses.php?do=success';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='rexpenses.php?act=add&do=f';";
    echo '</script>';
}
?>