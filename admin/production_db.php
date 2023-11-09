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
$strSQL = "SELECT * FROM tb_prefixproduction WHERE 1 ";
$objQuery = mysqli_query($con,$strSQL) or die ("Error Query [".$strSQL."]");
$objResult = mysqli_fetch_array($objQuery);

//*** Check val = year now ***//
if($objResult["val"] == date("y"))
{
	$Seq = substr("0000".$objResult["seq"],-4,4);   //*** Replace Zero Fill ***//
	$strNextSeq =$objResult["val"].$objResult["mval"].$Seq;

	//*** Update Next Seq ***//
	$strSQL = "UPDATE tb_prefixproduction SET mval = '".date("m")."' ,seq= seq+1 ";
	$objQuery = mysqli_query($con,$strSQL) or die ("Error Query [".$strSQL."]");
}
else  //*** Check val != year now ***//
{
	$Seq = substr("00001",-4,4);   //*** Replace Zero Fill ***//
	$strNextSeq =date("y").date("m").$Seq;

	//*** Update New Seq ***//
	$strSQL = "UPDATE tb_prefixproduction SET val = '".date("y")."' , mval='".date("m")."', seq = '1' ";
	$objQuery = mysqli_query($con,$strSQL) or die ("Error Query [".$strSQL."]");
}

// echo $strNextSeq;




$production_pricearray=$_POST['production_price'];
$contractor_nickname = mysqli_real_escape_string($con,$_POST["contractor_nickname"]);
$username = mysqli_real_escape_string($con,$_POST[ "username" ]);
$production_date = mysqli_real_escape_string($con,$_POST["production_date"]);
$production_dt = Date( "Y-m-d G:i:s" );
// $production_price = mysqli_real_escape_string($con,$_POST["production_price"]);
//บันทึกการสั่งซื้อลงใน order_detail
mysqli_query( $con, "BEGIN" );
$sql1 = "INSERT INTO tb_production
VALUES
($strNextSeq,'$production_date','$contractor_nickname','$username','$production_dt')";
$query1 = mysqli_query($con,$sql1) or die ("Error in query: $sql1" . mysqli_error($sql1));


// echo 'sql1 ='.$sql1;
//exit;
//ฟังก์ชั่น MAX() จะคืนค่าที่มากที่สุดในคอลัมน์ที่ระบุ ออกมา หรือจะพูดง่ายๆก็ว่า ใช้สำหรับหาค่าที่มากที่สุด นั่นเอง.
$sql2 = "SELECT MAX(production_id) as production_id 
	FROM tb_production
	WHERE contractor_nickname='$contractor_nickname' ";
$query2 = mysqli_query( $con, $sql2 )or die( "Error in query: $sql2" . mysqli_error( $sql2 ) );
$row = mysqli_fetch_array( $query2 );
$production_id = $row[ "production_id" ]; // order id ล่าสุดที่อยู่ในตาราง order_head


// echo '<br>';
// echo 'sql2 ='.$sql2;
// echo '<br>';

// echo '<br>';
// exit;
//PHP foreach() เป็นคำสั่งเพื่อนำข้อมูลออกมาจากตัวแปลที่เป็นประเภท array โดยสามารถเรียกค่าได้ทั้ง $key และ $value ของ array
foreach ( $_SESSION[ 'production' ] as $product_id => $qty ) {
  $production_price = $production_pricearray[$product_id];
  $sql3 = "SELECT * FROM tb_product WHERE product_id=$product_id";
  $query3 = mysqli_query( $con, $sql3 )or die( "Error in query: $sql3" . mysqli_error( $sql3 ) );
  $row3 = mysqli_fetch_array( $query3 );
  $pricetotal = $production_price;
  $count=mysqli_num_rows($query3);
  
  
 
  $sql4 = "INSERT INTO tb_productionlist VALUES(null, $production_id, $product_id, $qty, $pricetotal)";
  $query4 = mysqli_query( $con, $sql4 )or die( "Error in query: $sql4" . mysqli_error( $sql4 ) );

  // echo '<pre>';
  // echo $sql4;
  // echo '<pre>';
  //ตัดสต๊อก
  // for ( $i = 0; $i < $count; $i++ ) {
  //   $instock = $row3[ 'product_uom' ];

  //   $stc = $instock + $qty; //เอาจำนวนสินค้าที่มีอยู่มาลบด้วยจำนวนสั่งซื้อ

  //   $sql5 = "UPDATE tb_product SET  
  //    product_uom=$stc
  //    WHERE  product_id=$product_id ";
  //   $query5 = mysqli_query( $con, $sql5 )or die( "Error in query: $sql5" . mysqli_error( $sql5 ) );
  // //   echo '<pre>';
  // // echo $sql5;
  // // echo '<pre>';
  // }
}

// exit;

if ( $query1 && $query4 ) {
  mysqli_query( $con, "COMMIT" );
  $msg = "บันทึกข้อมูลเรียบร้อยแล้ว ";
  foreach ( $_SESSION[ 'production' ] as $product_id ) {
    //unset($_SESSION['production'][$p_id]);
    unset( $_SESSION[ 'production' ] );
  }
} else {
  mysqli_query( $con, "ROLLBACK" );
  $msg = "บันทึกข้อมูลไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่ค่ะ ";
}
?>
<script type="text/javascript">
	alert("<?php echo $msg;?>");
	window.location ='production.php?do=success';
</script>
