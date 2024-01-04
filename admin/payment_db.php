<?php
session_start();

//  print_r($_POST);
include( "../condb.php" );
?>
<meta charset=utf-8>


<!--สร้างตัวแปรสำหรับบันทึกการสั่งซื้อ -->
<?php

print_r($_POST);
// exit;

$strNextSeq = "";

//*** Check Year ***//
$strSQL = "SELECT * FROM tb_prefixpayment WHERE 1 ";
$objQuery = mysqli_query($con,$strSQL) or die ("Error Query [".$strSQL."]");
$objResult = mysqli_fetch_array($objQuery);

$date1= date("y")+43;
//*** Check val = year now ***// (ถ้า val = ปี ค.ศ. +43 แล้วเท่ากับปัจจุบัน จะทำการนับต่อ)
if($objResult["val"] == $date1)
{
	$Seq = substr("0000".$objResult["seq"],-4,4);   //*** Replace Zero Fill ***//
	$strNextSeq =$objResult["val"].$objResult["mval"].$Seq;

	//*** Update Next Seq ***//
	$strSQL = "UPDATE tb_prefixpayment SET mval = '".date("m")."' ,seq= seq+1 ";
	$objQuery = mysqli_query($con,$strSQL) or die ("Error Query [".$strSQL."]");
}
else  //*** Check val != year now ***// (แต่ถ้าไม่ใช่ ปีปัจจุบัน จะทำการ ขึ้นปีใหม่ เช่น ถ้าปีนี้ 66 แต่ ค่า val = 65 จะเริ่มนับใหม่ เป็นปีปัจจุบันแทน)
{
	$Seq = substr("00001",-4,4);   //*** Replace Zero Fill ***//
	$strNextSeq =$date1.date("m").$Seq;

	//*** Update New Seq ***//
	$strSQL = "UPDATE tb_prefixpayment SET val = '".$date1."' , mval='".date("m")."', seq = '1' ";
	$objQuery = mysqli_query($con,$strSQL) or die ("Error Query [".$strSQL."]");
}

// echo $strNextSeq;
// echo '<br>';
// echo $date1;

// exit;



$rexpenses_id = $_POST['rexpenses_id'];
$production_pricearray=$_POST['production_price'];
$production_status =$_POST['production_status'];
$contractor_nickname = mysqli_real_escape_string($con,$_POST["contractor_nickname"]);
$d_s = $_POST['d_s']; //ตัวแปรวันที่เริ่มต้น
$d_e = $_POST['d_e']; //ตัวแปรวันที่สิ้นสุด
$username = mysqli_real_escape_string($con,$_POST[ "username" ]);
$payment_date = mysqli_real_escape_string($con,$_POST["payment_date"]);
$payment_dt = Date( "Y-m-d G:i:s" );
$product_name = $_POST['product_name'];
$total = mysqli_real_escape_string($con,$_POST['total']);
$sum = mysqli_real_escape_string($con,$_POST['sum']);
$vat = mysqli_real_escape_string($con,$_POST['vat']);
$balance = mysqli_real_escape_string($con,$_POST['balance']);
$rexpensestotal = mysqli_real_escape_string($con,$_POST['rexpensestotal']);
$final = mysqli_real_escape_string($con,$_POST['final']);



//บันทึกการสั่งซื้อลงใน order_detail
mysqli_query( $con, "BEGIN" );
$sql1 = "INSERT INTO tb_payment
VALUES
($strNextSeq,'$payment_date','$d_s','$d_e','$contractor_nickname','$balance','$username','$payment_dt')";
$query1 = mysqli_query($con,$sql1) or die ("Error in query: $sql1" . mysqli_error($con,$sql1));

// echo '<br>';
// echo 'sql1 ='.$sql1;
//exit;
//ฟังก์ชั่น MAX() จะคืนค่าที่มากที่สุดในคอลัมน์ที่ระบุ ออกมา หรือจะพูดง่ายๆก็ว่า ใช้สำหรับหาค่าที่มากที่สุด นั่นเอง.
$sql2 = "SELECT MAX(payment_id) as payment_id 
	FROM tb_payment
	WHERE contractor_nickname='$contractor_nickname' ";
$query2 = mysqli_query( $con, $sql2 )or die( "Error in query: $sql2" . mysqli_error( $con,$sql2 ) );
$row = mysqli_fetch_array( $query2 );
$payment_id = $row[ "payment_id" ]; // order id ล่าสุดที่อยู่ในตาราง order_head


// echo '<br>';
// echo 'sql2 ='.$sql2;
// echo '<br>';

// echo '<br>';
// exit;
//PHP foreach() เป็นคำสั่งเพื่อนำข้อมูลออกมาจากตัวแปลที่เป็นประเภท array โดยสามารถเรียกค่าได้ทั้ง $key และ $value ของ array

//   $production_price = $production_pricearray[$production_id];

  $sql3 = "SELECT tb_productionlist.*,tb_production.*,tb_product.*,SUM(production_uom) as total FROM tb_productionlist 
  LEFT JOIN tb_production ON tb_productionlist.production_id = tb_production.production_id
  LEFT JOIN tb_product ON tb_productionlist.product_id = tb_product.product_id
  WHERE (contractor_nickname = '$contractor_nickname' AND production_date BETWEEN '$d_s' AND '$d_e')
  GROUP BY product_name ";
  $query3 = mysqli_query( $con, $sql3 )or die( "Error in query: $sql3" . mysqli_error( $con,$sql3 ) );
  // $row3 = mysqli_fetch_array( $query3 );
  $count=mysqli_num_rows($query3);
  while ($row3 = mysqli_fetch_array($query3)) {
  $qty = $row3['total'];
  
  $production_price = $row3["production_price"];
  $product_id = $row3["product_id"];
  // $count=mysqli_num_rows($query3);
  // echo 'count = '.$count;
  // echo '<br>';
  // echo 'qty = '. $qty;
  // echo '<pre>';
  // echo 'sql3 = '.$sql3;
  // echo '<pre>';

  $sql4 = "INSERT INTO tb_paymentlist VALUES (null, $payment_id, $product_id, $qty, $production_price)";
  $query4 = mysqli_query( $con, $sql4 )or die( "Error in query: $sql4" . mysqli_error( $con ). "<br>$sql4" );
  
  // echo '<pre>';
  // echo 'sql4 = '.$sql4;
  // echo '<pre>';
  }

  $sql9 = "SELECT tb_wagerecordlist.*,tb_wagerecord.*,tb_wage.*,SUM(wagerecord_uom) as total1 FROM tb_wagerecordlist 
  LEFT JOIN tb_wagerecord ON tb_wagerecordlist.wagerecord_id = tb_wagerecord.wagerecord_id
  LEFT JOIN tb_wage ON tb_wagerecordlist.wage_id = tb_wage.wage_id
  WHERE (contractor_nickname = '$contractor_nickname' AND wagerecord_date BETWEEN '$d_s' AND '$d_e')
  GROUP BY wage_name ";
  $query9 = mysqli_query( $con, $sql9 )or die( "Error in query: $sql9" . mysqli_error( $con,$sql9 ) );
  // $row3 = mysqli_fetch_array( $query3 );
  $count9=mysqli_num_rows($query9);
  while ($row9 = mysqli_fetch_array($query9)) {
  $qty1 = $row9['total1'];
  
  $wagerecord_price = $row9["wage_price"];
  $wage_id = $row9["wage_id"];
  // $count=mysqli_num_rows($query3);
  // echo 'count9 = '.$count9;
  // echo '<br>';
  // echo 'qty1 = '. $qty1;
  // echo '<pre>';
  // echo 'sql9 = '.$sql9;
  // echo '<pre>';

  $sql10 = "INSERT INTO tb_paymentlist1 VALUES (null, $payment_id, $wage_id, $qty1, $wagerecord_price)";
  $query10 = mysqli_query( $con, $sql10 )or die( "Error in query: $sql10" . mysqli_error( $con ). "<br>$sql10" );
  
  // echo '<pre>';
  // echo 'sql10 = '.$sql10;
  // echo '<pre>';
  }

  $sql6 = "SELECT tb_productionlist.*,tb_production.*,tb_product.* FROM tb_productionlist 
  LEFT JOIN tb_production ON tb_productionlist.production_id = tb_production.production_id
  LEFT JOIN tb_product ON tb_productionlist.product_id = tb_product.product_id
  WHERE (contractor_nickname = '$contractor_nickname' AND production_date BETWEEN '$d_s' AND '$d_e')";
  $query6 = mysqli_query( $con, $sql6 )or die( "Error in query: $sql3" . mysqli_error( $con,$sql6 ) );
  // $count1=mysqli_num_rows($query6);
  while ($row6 = mysqli_fetch_array($query6)) {
    $production_id = $row6['production_id'];
    echo $production_id;
    echo '<br>';
    for ( $i = 0; $i < 1; $i++ ) {

      
    $production_status = 1;

    // echo 'count1 = '.$count1;

    $sql5 = "UPDATE tb_productionlist SET  
     production_status= $production_status
     WHERE  production_id= $production_id";
    $query5 = mysqli_query( $con, $sql5 )or die( "Error in query: $sql5" . mysqli_error( $con ). "<br>$sql5" );
  //   echo '<pre>';
  // echo 'sql 5 ='. $sql5;
  // echo '<pre>';
  // echo '<br>';
  // echo '<pre>';
  // echo 'sql6 = '.$sql6;
  // echo '<pre>';
  }
}

$sql11 = "SELECT tb_wagerecordlist.*,tb_wagerecord.*,tb_wage.* FROM tb_wagerecordlist 
LEFT JOIN tb_wagerecord ON tb_wagerecordlist.wagerecord_id = tb_wagerecord.wagerecord_id
LEFT JOIN tb_wage ON tb_wagerecordlist.wage_id = tb_wage.wage_id
WHERE (contractor_nickname = '$contractor_nickname' AND wagerecord_date BETWEEN '$d_s' AND '$d_e')";
  $query11 = mysqli_query( $con, $sql11 )or die( "Error in query: $sql11" . mysqli_error( $con,$sql11 ) );
  // $count1=mysqli_num_rows($query6);
  while ($row11 = mysqli_fetch_array($query11)) {
    $wagerecord_id = $row11['wagerecord_id'];
    // echo $wagerecord_id;
    // echo '<br>';
    for ( $i = 0; $i < 1; $i++ ) {

      
    $wagerecord_status = 1;

    // echo 'count1 = '.$count1;

    $sql12 = "UPDATE tb_wagerecordlist SET  
     wagerecord_status= $wagerecord_status
     WHERE  wagerecord_id= $wagerecord_id";
    $query12 = mysqli_query( $con, $sql12 )or die( "Error in query: $sql12" . mysqli_error( $con ). "<br>$sql12" );
  //   echo '<pre>';
  // echo 'sql12 ='. $sql12;
  // echo '<pre>';
  // echo '<br>';
  // echo '<pre>';
  // echo 'sql11 = '.$sql11;
  // echo '<pre>';
  }
}


$sql7 = "SELECT * FROM tb_rexpenses WHERE (contractor_nickname = '$contractor_nickname' AND rexpenses_date BETWEEN '$d_s' AND '$d_e')";
$query7 = mysqli_query($con, $sql7);
while ($row7 = mysqli_fetch_array($query7)) {
  $rexpenses_id = $row7['rexpenses_id'];
for ( $i = 0; $i < $count; $i++ ) {
  

  $rexpenses_status = 1;

  $sql8 = "UPDATE tb_rexpenses SET  
   rexpenses_status=$rexpenses_status
   WHERE  rexpenses_id=$rexpenses_id ";
  $query8 = mysqli_query( $con, $sql8 )or die( "Error in query: $sql8" . mysqli_error( $con ) . "<br>$sql8");
//   echo '<pre>';
// echo $sql8;
// echo '<pre>';
}
}
  


// exit;

if ( $query1 || $query4 ) {
  mysqli_query( $con, "COMMIT" );
  $msg = "บันทึกข้อมูลเรียบร้อยแล้ว ";
  foreach ( $_SESSION[ 'payment' ] as $production_id ) {
    //unset($_SESSION['payment'][$p_id]);
    unset( $_SESSION[ 'payment' ] );
  }
} else {
  mysqli_query( $con, "ROLLBACK" );
  $msg = "บันทึกข้อมูลไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่ค่ะ ";
}
?>
<script type="text/javascript">
	alert("<?php echo $msg;?>");
	window.location ='payment.php?do=success';
</script>
