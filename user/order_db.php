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



$label_name = mysqli_real_escape_string($con,$_POST["label_name"]);
$label_detail = $_POST[ "label_detail" ];
$label_pic1 = $_POST[ "label_pic1" ];
$label_pic2 = $_POST[ "label_pic2" ];

$username = mysqli_real_escape_string($con,$_POST[ "username" ]);
$order_date = mysqli_real_escape_string($con,$_POST["order_date"]);
$order_dt = Date( "Y-m-d G:i:s" );
//บันทึกการสั่งซื้อลงใน order_detail
mysqli_query( $con, "BEGIN" );
$sql1 = "INSERT INTO tb_order
VALUES
($strNextSeq,'$order_date','$label_name','$label_detail','$label_pic1','$label_pic2','$username','$order_dt')";
$query1 = mysqli_query($con,$sql1) or die ("Error in query: $sql1" . mysqli_error($con,$sql1));


// echo $sql1;
//exit;
//ฟังก์ชั่น MAX() จะคืนค่าที่มากที่สุดในคอลัมน์ที่ระบุ ออกมา หรือจะพูดง่ายๆก็ว่า ใช้สำหรับหาค่าที่มากที่สุด นั่นเอง.
$sql2 = "SELECT MAX(order_id) as order_id 
	FROM tb_order
	WHERE label_name='$label_name' ";
$query2 = mysqli_query( $con, $sql2 )or die( "Error in query: $sql2" . mysqli_error( $sql2 ) );
$row = mysqli_fetch_array( $query2 );
$order_id = $row[ "order_id" ]; // order id ล่าสุดที่อยู่ในตาราง order_head


/*echo '<br>';
echo $sql2;
echo '<br>';
echo $o_id;
echo '<br>';*/
//exit;



//PHP foreach() เป็นคำสั่งเพื่อนำข้อมูลออกมาจากตัวแปลที่เป็นประเภท array โดยสามารถเรียกค่าได้ทั้ง $key และ $value ของ array
foreach ( $_SESSION[ 'order' ] as $label_ida => $qty ) {
  $sql3 = "SELECT * FROM tb_labeldetail WHERE label_ida=$label_ida";
  $query3 = mysqli_query( $con, $sql3 )or die( "Error in query: $sql3" . mysqli_error( $sql3 ) );
  $row3 = mysqli_fetch_array( $query3 );
 
  $count=mysqli_num_rows($query3);
  
//   echo '<pre>';
//   echo $sql3;
//   echo '<pre>';
 
  $sql4 = "INSERT INTO tb_orderlist VALUES(null, $order_id, $label_ida)";
  $query4 = mysqli_query( $con, $sql4 )or die( "Error in query: $sql4" . mysqli_error( $sql4 ) );

//   echo '<pre>';
//   echo 'sql4 = '.$sql4;
//   echo '<pre>';
  //ตัดสต๊อก
  for ( $i = 0; $i < $count; $i++ ) {
    $instock = $row3[ 'label_orderstatus' ];
    // echo 'instock = '.$instock;
    $stc = $instock + $qty; //เอาจำนวนสินค้าที่มีอยู่มาลบด้วยจำนวนสั่งซื้อ
    // echo 'stc = '.$stc;
    $sql5 = "UPDATE tb_labeldetail SET  
     label_orderstatus=$stc
     WHERE  label_ida=$label_ida ";
    $query5 = mysqli_query( $con, $sql5 )or die( "Error in query: $sql5" . mysqli_error( $sql5 ) );

//     echo '<pre>';
//   echo $sql5;
//   echo '<pre>';
  }
}

// exit;

if ( $query1 && $query4 ) {
  mysqli_query( $con, "COMMIT" );
  $msg = "บันทึกข้อมูลเรียบร้อยแล้ว ";
  foreach ( $_SESSION[ 'order' ] as $label_ida ) {
    //unset($_SESSION['order'][$p_id]);
    unset( $_SESSION[ 'order' ] );
  }
} else {
  mysqli_query( $con, "ROLLBACK" );
  $msg = "บันทึกข้อมูลไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่ค่ะ ";
}
?>
<script type="text/javascript">
	alert("<?php echo $msg;?>");
	window.location ='order.php?do=success';
</script>
