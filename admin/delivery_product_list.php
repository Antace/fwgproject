<?php
//connect db
if(@$_GET['do']=='success'){
  echo '<script type="text/javascript">
        swal("", "ทำรายการสำเร็จ !!", "success");
        </script>';
  echo '<meta http-equiv="refresh" content="1;url=delivery.php" />';

}else if(@$_GET['do']=='finish'){
  echo '<script type="text/javascript">
        swal("", "แก้ไขสำเร็จ !!", "success");
        </script>';
  echo '<meta http-equiv="refresh" content="1;url=delivery.php" />';
}
$query = "SELECT * FROM tb_delivery
ORDER BY delivery_id DESC" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);
echo ' <table id="example1" class="table table-bordered table-striped">';
echo "<thead>";
  echo "<tr class=''>
    <th width='3%'>ลำดับ</th>
     <th width='10%'>เลขที่ใบส่งของ</th>
     <th width='10%' >วันที่ทำรายการ</th>
    <th>ชื่อลูกค้า</th>
    <th>โครงการ</th>
    <th width='10%'>-</th>
  </tr>";
echo "</thead>";
$i = 1;
while ($row = mysqli_fetch_array($result)) {
echo "<tr>";
  echo "<td  align=center>" . $i++  . "</td> ";
  echo "<td>" .$row["delivery_id"] .  "</td> ";
  echo "<td> " .$row["delivery_date"] . "</td> ";
  echo "<td>" .$row["customer_name"] ."</td> ";
  echo "<td>" .$row["department_name"] ."</td> ";
  
  echo "<td align=center><a href='delivery.php?act=view&ID=$row[delivery_id]' class='btn btn-warning btn-xs'>เปิด</a>
  <a href='delivery.php?act=delivery_cancel&ID=$row[delivery_id]' class='btn btn-danger btn-xs'>คืนสินค้า</a>
  
</td> ";
  echo "</tr>";
}
?>
</table>