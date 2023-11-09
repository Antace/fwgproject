<?php
session_start();

//  print_r($_POST);
include( "../condb.php" );
?>
<meta charset=utf-8>


<!--สร้างตัวแปรสำหรับบันทึกการสั่งซื้อ -->
<?php

$strNextSeq = "";

//*** Check Year ***//
$strSQL = "SELECT * FROM tb_prefix WHERE 1 ";
$objQuery = mysqli_query($con,$strSQL) or die ("Error Query [".$strSQL."]");
$objResult = mysqli_fetch_array($objQuery);

//*** Check val = year now ***//
if($objResult["val"] == date("y"))
{
	$Seq = substr("0000".$objResult["seq"],-4,4);   //*** Replace Zero Fill ***//
	$strNextSeq =$objResult["val"].$objResult["mval"].$Seq;

	//*** Update Next Seq ***//
	$strSQL = "UPDATE tb_prefix SET mval = '".date("m")."' ,seq= seq+1 ";
	$objQuery = mysqli_query($con,$strSQL) or die ("Error Query [".$strSQL."]");
}
else  //*** Check val != year now ***//
{
	$Seq = substr("00001",-4,4);   //*** Replace Zero Fill ***//
	$strNextSeq =date("y").date("m").$Seq;

	//*** Update New Seq ***//
	$strSQL = "UPDATE tb_prefix SET val = '".date("y")."' , mval='".date("m")."', seq = '1' ";
	$objQuery = mysqli_query($con,$strSQL) or die ("Error Query [".$strSQL."]");
}

// echo $strNextSeq;

// exit;


$customer_name = mysqli_real_escape_string($con,$_POST["customer_name"]);
// $customer_address = $_POST[ "customer_address" ];
// $customer_branch = $_POST[ "customer_branch" ];
// $customer_tax = $_POST[ "customer_tax" ];
//$total_qty = $_POST["total_qty"];
$reserve_pricearray=$_POST['reserve_price'];
$total = mysqli_real_escape_string($con,$_POST[ "reserve_total" ]); //ราคารวมทั้ง order
$discount = mysqli_real_escape_string($con,$_POST["reserve_discount"]);
$receive_status = mysqli_real_escape_string($con,$_POST["receive_status"]);
$payment_status = mysqli_real_escape_string($con,$_POST["payment_status"]);
$payment_type = mysqli_real_escape_string($con,$_POST["payment_type"]);
$username = mysqli_real_escape_string($con,$_POST[ "username" ]);
$reserve_date = mysqli_real_escape_string($con,$_POST["reserve_date"]);
$reserve_dt = Date( "Y-m-d G:i:s" );
//บันทึกการสั่งซื้อลงใน order_detail
mysqli_query( $con, "BEGIN" );
$sql1 = "INSERT INTO tb_reserve
VALUES
($strNextSeq,'$reserve_date','$customer_name','$total','$discount','$receive_status','$payment_status','$payment_type','$username','$reserve_dt')";
$query1 = mysqli_query($con,$sql1) or die ("Error in query: $sql1" . mysqli_error($con,$sql1));


// echo $sql1;
//exit;
//ฟังก์ชั่น MAX() จะคืนค่าที่มากที่สุดในคอลัมน์ที่ระบุ ออกมา หรือจะพูดง่ายๆก็ว่า ใช้สำหรับหาค่าที่มากที่สุด นั่นเอง.
$sql2 = "SELECT MAX(reserve_id) as reserve_id 
	FROM tb_reserve
	WHERE customer_name='$customer_name' ";
$query2 = mysqli_query( $con, $sql2 )or die( "Error in query: $sql2" . mysqli_error( $sql2 ) );
$row = mysqli_fetch_array( $query2 );
$reserve_id = $row[ "reserve_id" ]; // order id ล่าสุดที่อยู่ในตาราง order_head


/*echo '<br>';
echo $sql2;
echo '<br>';
echo $o_id;
echo '<br>';*/
//exit;
//PHP foreach() เป็นคำสั่งเพื่อนำข้อมูลออกมาจากตัวแปลที่เป็นประเภท array โดยสามารถเรียกค่าได้ทั้ง $key และ $value ของ array
foreach ( $_SESSION[ 'reserve' ] as $product_id => $qty ) {
  $reserve_price = $reserve_pricearray[$product_id];
  $sql3 = "SELECT * FROM tb_product WHERE product_id=$product_id";
  $query3 = mysqli_query( $con, $sql3 )or die( "Error in query: $sql3" . mysqli_error( $sql3 ) );
  $row3 = mysqli_fetch_array( $query3 );
  $pricetotal = $reserve_price * $qty;
  $count=mysqli_num_rows($query3);
  
  
 
  $sql4 = "INSERT INTO tb_reservelist VALUES(null, $reserve_id, $product_id, $qty,$pricetotal)";
  $query4 = mysqli_query( $con, $sql4 )or die( "Error in query: $sql4" . mysqli_error( $sql4 ) );

  // echo '<pre>';
  // echo $sql4;
  // echo '<pre>';
  //ตัดสต๊อก
  for ( $i = 0; $i < $count; $i++ ) {
    $instock = $row3[ 'product_uom' ];

    $stc = $instock - $qty; //เอาจำนวนสินค้าที่มีอยู่มาลบด้วยจำนวนสั่งซื้อ

    $sql5 = "UPDATE tb_product SET  
     product_uom=$stc
     WHERE  product_id=$product_id ";
    $query5 = mysqli_query( $con, $sql5 )or die( "Error in query: $sql5" . mysqli_error( $sql5 ) );
  }
}

// exit;

if ( $query1 && $query4 ) {
  mysqli_query( $con, "COMMIT" );
  $msg = "บันทึกข้อมูลเรียบร้อยแล้ว ";
  foreach ( $_SESSION[ 'reserve' ] as $product_id ) {
    //unset($_SESSION['reserve'][$p_id]);
    unset( $_SESSION[ 'reserve' ] );
  }
} else {
  mysqli_query( $con, "ROLLBACK" );
  $msg = "บันทึกข้อมูลไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่ค่ะ ";
}
?>
<script type="text/javascript">
	alert("<?php echo $msg;?>");
	window.location ='reserve.php?do=success';
</script>
