<?php
session_start();

 print_r($_POST);

//  exit;
include( "../condb.php" );
?>
<meta charset=utf-8>


<!--สร้างตัวแปรสำหรับบันทึกการสั่งซื้อ -->
<?php
$payment_id  = mysqli_real_escape_string($con,$_POST["payment_id"]);
$paymentlist_id  = mysqli_real_escape_string($con,$_POST["paymentlist_id[]"]);
$production_uom  = mysqli_real_escape_string($con,$_POST["production_uom[]"]);
$d_s = $_POST['d_s']; //ตัวแปรวันที่เริ่มต้น
$d_e = $_POST['d_e']; //ตัวแปรวันที่สิ้นสุด
$product_id = mysqli_real_escape_string($con,$_POST["product_id[]"]);
$contractor_nickname = mysqli_real_escape_string($con,$_POST["contractor_nickname"]);
$username = mysqli_real_escape_string($con,$_POST[ "username" ]);
$payment_date = mysqli_real_escape_string($con,$_POST["payment_date"]);
$payment_dt = Date( "Y-m-d G:i:s" );
//บันทึกการสั่งซื้อลงใน order_detail

mysqli_query( $con, "BEGIN" );

$sql1 = "DELETE FROM tb_payment WHERE payment_id=$payment_id";
$query1 = mysqli_query($con,$sql1) or die ("Error in query: $sql1" . mysqli_error($con,$sql1));

echo '<br>';
echo 'sql1 ='. $sql1;
//exit;
// ฟังก์ชั่น MAX() จะคืนค่าที่มากที่สุดในคอลัมน์ที่ระบุ ออกมา หรือจะพูดง่ายๆก็ว่า ใช้สำหรับหาค่าที่มากที่สุด นั่นเอง.
for($a=0;$a<count($_POST["paymentlist_id"]);$a++){
$sql2 = "DELETE FROM tb_paymentlist WHERE paymentlist_id = '".$_POST["paymentlist_id"][$a]."'";
$query2 = mysqli_query( $con, $sql2 )or die( "Error in query: $sql2" . mysqli_error($con, $sql2 ) );

}
echo '<br>';
echo 'sql2 = '.$sql2;
echo '<br>';

for($a=0;$a<count($_POST["paymentlist_id"]);$a++){
  $sql3 = "DELETE FROM tb_paymentlist1 WHERE paymentlist_id = '".$_POST["paymentlist_id"][$a]."'";
  $query3 = mysqli_query( $con, $sql3 )or die( "Error in query: $sql3" . mysqli_error($con, $sql3 ) );
  
  }

  echo '<br>';
echo 'sql3 = '.$sql3;
echo '<br>';
// $row2 = mysqli_fetch_array( $query2 );
// $payment_id = $row[ "payment_id" ]; // order id ล่าสุดที่อยู่ในตาราง order_head

// exit;
//PHP foreach() เป็นคำสั่งเพื่อนำข้อมูลออกมาจากตัวแปลที่เป็นประเภท array โดยสามารถเรียกค่าได้ทั้ง $key และ $value ของ array
// $string = implode(",",$_POST["checkbox"]);
$sql6 = "SELECT tb_productionlist.*,tb_production.*,tb_product.* FROM tb_productionlist 
  LEFT JOIN tb_production ON tb_productionlist.production_id = tb_production.production_id
  LEFT JOIN tb_product ON tb_productionlist.product_id = tb_product.product_id
  WHERE (contractor_nickname = '$contractor_nickname' AND production_date BETWEEN '$d_s' AND '$d_e')";
  $query6 = mysqli_query( $con, $sql6 )or die( "Error in query: $sql6" . mysqli_error( $con,$sql6 ) );
  // $count=mysqli_num_rows($query6);
 

  while ($row6 = mysqli_fetch_array($query6)) {
    $production_id = $row6['production_id'];
    echo $production_id;
    echo '<br>';
    for ( $i = 0; $i < 1; $i++ ) {

      
    $production_status = 0;

    // echo 'count1 = '.$count1;

    $sql5 = "UPDATE tb_productionlist SET  
     production_status= $production_status
     WHERE  production_id= $production_id";
    $query5 = mysqli_query( $con, $sql5 )or die( "Error in query: $sql5" . mysqli_error( $con ). "<br>$sql5" );
    echo '<pre>';
  echo 'sql 5 ='. $sql5;
  echo '<pre>';
  echo '<br>';
  echo '<pre>';
  echo 'sql6 = '.$sql6;
  echo '<pre>';
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
    echo $wagerecord_id;
    echo '<br>';
    for ( $i = 0; $i < 1; $i++ ) {

      
    $wagerecord_status = 0;

    // echo 'count1 = '.$count1;

    $sql12 = "UPDATE tb_wagerecordlist SET  
     wagerecord_status= $wagerecord_status
     WHERE  wagerecord_id= $wagerecord_id";
    $query12 = mysqli_query( $con, $sql12 )or die( "Error in query: $sql12" . mysqli_error( $con ). "<br>$sql12" );
    echo '<pre>';
  echo 'sql12 ='. $sql12;
  echo '<pre>';
  echo '<br>';
  echo '<pre>';
  echo 'sql11 = '.$sql11;
  echo '<pre>';
  }
}
  
$sql7 = "SELECT * FROM tb_rexpenses WHERE (contractor_nickname = '$contractor_nickname' AND rexpenses_date BETWEEN '$d_s' AND '$d_e')";
$query7 = mysqli_query($con, $sql7);
while ($row7 = mysqli_fetch_array($query7)) {
  $rexpenses_id = $row7['rexpenses_id'];
for ( $i = 0; $i < 1; $i++ ) {
  

  $rexpenses_status = 0;

  $sql8 = "UPDATE tb_rexpenses SET  
   rexpenses_status=$rexpenses_status
   WHERE  rexpenses_id=$rexpenses_id ";
  $query8 = mysqli_query( $con, $sql8 )or die( "Error in query: $sql8" . mysqli_error( $con ) . "<br>$sql8");
  echo '<pre>';
echo 'sql 8 = '.$sql8;
echo '<pre>';
}
}
echo '<pre>';
echo $sql7;
echo '<pre>';
// exit;

if ( $query1 && $query6 ) {
  mysqli_query( $con, "COMMIT" );
  $msg = "บันทึกข้อมูลเรียบร้อยแล้ว ";
  
    //unset($_SESSION['cart'][$p_id]);
    
  
} else {
  mysqli_query( $con, "ROLLBACK" );
  $msg = "บันทึกข้อมูลไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่ค่ะ ";
}
?>
<script type="text/javascript">
	alert("<?php echo $msg;?>");
	window.location ='payment.php?do=success';
</script>



