<?php
session_start();

//  print_r($_POST);

//  exit;
include( "../condb.php" );
?>
<meta charset=utf-8>


<!--สร้างตัวแปรสำหรับบันทึกการสั่งซื้อ -->
<?php
$order_id  = mysqli_real_escape_string($con,$_POST["order_id"]);
$orderlist_id  = mysqli_real_escape_string($con,$_POST["orderlist_id[]"]);
$order_uom  = mysqli_real_escape_string($con,$_POST["order_uom[]"]);
$corder_note = mysqli_real_escape_string($con,$_POST["corder_note"]);
$label_id = mysqli_real_escape_string($con,$_POST["label_id[]"]);
$label_name = mysqli_real_escape_string($con,$_POST["label_name"]);
$label_detail = $_POST[ "label_detail" ];
$label_pic1 = $_POST[ "label_pic1" ];
$label_pic2 = $_POST[ "label_pic2" ];
$username = mysqli_real_escape_string($con,$_POST[ "username" ]);
$order_date = mysqli_real_escape_string($con,$_POST["order_date"]);
$order_dt = Date( "Y-m-d G:i:s" );
//บันทึกการสั่งซื้อลงใน order_detail

mysqli_query( $con, "BEGIN" );
$sql4 = "INSERT INTO tb_cancelorder
VALUES
('$order_id','$order_date','$label_name','$label_detail','$label_pic1','$label_pic2','$corder_note','$username','$order_dt')";
$query4 = mysqli_query($con,$sql4) or die ("Error in query: $sql4" . mysqli_error($con,$sql4));


$sql1 = "DELETE FROM tb_order WHERE order_id=$order_id";
$query1 = mysqli_query($con,$sql1) or die ("Error in query: $sql1" . mysqli_error($con,$sql1));

// echo $order_date;
// echo '<br>';
// echo $sql4;
// echo '<br>';

// exit;
// ฟังก์ชั่น MAX() จะคืนค่าที่มากที่สุดในคอลัมน์ที่ระบุ ออกมา หรือจะพูดง่ายๆก็ว่า ใช้สำหรับหาค่าที่มากที่สุด นั่นเอง.
for($a=0;$a<count($_POST["orderlist_id"]);$a++){
$sql2 = "DELETE FROM tb_orderlist WHERE orderlist_id = '".$_POST["orderlist_id"][$a]."'";
$query2 = mysqli_query( $con, $sql2 )or die( "Error in query: $sql2" . mysqli_error($con, $sql2 ) );

}
// $row2 = mysqli_fetch_array( $query2 );
// $order_id = $row[ "order_id" ]; // order id ล่าสุดที่อยู่ในตาราง order_head

// exit;
//PHP foreach() เป็นคำสั่งเพื่อนำข้อมูลออกมาจากตัวแปลที่เป็นประเภท array โดยสามารถเรียกค่าได้ทั้ง $key และ $value ของ array
// $string = implode(",",$_POST["checkbox"]);
for($i=0;$i<count($_POST["label_ida"]);$i++){
  $sql3 = "SELECT * FROM tb_labeldetail WHERE label_ida = '".$_POST["label_ida"][$i]."'";
  $query3 = mysqli_query( $con, $sql3 )or die( "Error in query: $sql3" . mysqli_error($con, $sql3 ) );
  $row3 = mysqli_fetch_array( $query3 );
  
  $count=mysqli_num_rows($query3);
  
//   echo '<br>';
// echo 'sql2 = '.$sql2;
// echo '<br>';

  $sql6 = "INSERT INTO tb_cancelorderlist VALUES(null, $order_id,'".$_POST["label_ida"][$i]."' )";
  $query6 = mysqli_query( $con, $sql6 )or die( "Error in query: $sql6" . mysqli_error($con, $sql6 ) ); 

// echo '$_POST[order_uom]='.$_POST['order_uom'][$i];
  //ตัดสต๊อก

    $instock = $row3[ 'label_orderstatus' ];
    $order_uom = 1;

    $stc = $instock - $order_uom; //เอาจำนวนสินค้าที่มีอยู่มาบวกด้วยจำนวนคืนสินค้า
    // echo '<br>';
    // echo 'instcok ='.$instock;
    // echo '<br>';
    // echo 'stc ='.$stc;
    // echo '<br>';
    // echo 'order_uom ='.$order_uom;
    // echo '<br>';
   
    $sql5 = "UPDATE tb_labeldetail SET  
     label_orderstatus=$stc
     WHERE  label_ida='".$_POST["label_ida"][$i]."'";
    $query5 = mysqli_query( $con, $sql5 )or die( "Error in query: $sql5" . mysqli_error($con, $sql5 ) );


    // echo 'sql5 ='.$sql5;
    // echo '<br>';
  

}
// exit;

if ( $query1 && $query3 ) {
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
	window.location ='order.php?do=success';
</script>



