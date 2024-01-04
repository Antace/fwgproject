<?php
session_start();

//  print_r($_POST);

//  exit;
include( "../condb.php" );
?>
<meta charset=utf-8>


<!--สร้างตัวแปรสำหรับบันทึกการสั่งซื้อ -->
<?php
$sale_id  = mysqli_real_escape_string($con,$_POST["sale_id"]);
$salelist_id  = mysqli_real_escape_string($con,$_POST["salelist_id[]"]);
$sale_uom  = mysqli_real_escape_string($con,$_POST["sale_uom[]"]);

$product_id = mysqli_real_escape_string($con,$_POST["product_id[]"]);
$customer_name = mysqli_real_escape_string($con,$_POST["customer_name"]);
$username = mysqli_real_escape_string($con,$_POST[ "username" ]);
$sale_date = mysqli_real_escape_string($con,$_POST["sale_date"]);
$sale_dt = Date( "Y-m-d G:i:s" );
//บันทึกการสั่งซื้อลงใน sale_detail

mysqli_query( $con, "BEGIN" );

$sql1 = "DELETE FROM tb_sale WHERE sale_id=$sale_id";
$query1 = mysqli_query($con,$sql1) or die ("Error in query: $sql1" . mysqli_error($con,$sql1));


// echo $sql1;
//exit;
// ฟังก์ชั่น MAX() จะคืนค่าที่มากที่สุดในคอลัมน์ที่ระบุ ออกมา หรือจะพูดง่ายๆก็ว่า ใช้สำหรับหาค่าที่มากที่สุด นั่นเอง.
for($a=0;$a<count($_POST["salelist_id"]);$a++){
$sql2 = "DELETE FROM tb_salelist WHERE salelist_id = '".$_POST["salelist_id"][$a]."'";
$query2 = mysqli_query( $con, $sql2 )or die( "Error in query: $sql2" . mysqli_error($con, $sql2 ) );

}
// $row2 = mysqli_fetch_array( $query2 );
// $sale_id = $row[ "sale_id" ]; // sale id ล่าสุดที่อยู่ในตาราง sale_head

// exit;
//PHP foreach() เป็นคำสั่งเพื่อนำข้อมูลออกมาจากตัวแปลที่เป็นประเภท array โดยสามารถเรียกค่าได้ทั้ง $key และ $value ของ array
// $string = implode(",",$_POST["checkbox"]);
for($i=0;$i<count($_POST["product_id"]);$i++){
  $sql3 = "SELECT * FROM tb_product WHERE product_id = '".$_POST["product_id"][$i]."'";
  $query3 = mysqli_query( $con, $sql3 )or die( "Error in query: $sql3" . mysqli_error( $con,$sql3 ) );
  $row3 = mysqli_fetch_array( $query3 );
  
  $count=mysqli_num_rows($query3);
  
//   echo '<br>';
// echo 'sql2 = '.$sql2;
// echo '<br>';

// echo '$_POST[sale_uom]='.$_POST['sale_uom'][$i];
  //ตัดสต๊อก

    $instock = $row3[ 'product_uom' ];
    $sale_uom = $_POST['sale_uom'][$i];

    $stc = $instock + $sale_uom; //เอาจำนวนสินค้าที่มีอยู่มาบวกด้วยจำนวนคืนสินค้า
    // echo '<br>';
    // echo 'instcok ='.$instock;
    // echo '<br>';
    // echo 'stc ='.$stc;
    // echo '<br>';
    // echo 'sale_uom ='.$sale_uom;
    // echo '<br>';
   
    $sql5 = "UPDATE tb_product SET  
     product_uom=$stc
     WHERE  product_id='".$_POST["product_id"][$i]."'";
    $query5 = mysqli_query( $con, $sql5 )or die( "Error in query: $sql5" . mysqli_error( $con,$sql5 ) );


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
	window.location ='sale.php?do=success';
</script>



