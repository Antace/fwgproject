<?php
if (@$_GET['do'] == 'success') {
  echo '<script type="text/javascript">
        swal("", "ทำรายการสำเร็จ !!", "success");
        </script>';
  echo '<meta http-equiv="refresh" content="1;url=product.php" />';
} else if (@$_GET['do'] == 'finish') {
  echo '<script type="text/javascript">
        swal("", "แก้ไขสำเร็จ !!", "success");
        </script>';
  echo '<meta http-equiv="refresh" content="1;url=product.php" />';
}
if($act=='location'){
$query = "SELECT * FROM tb_product
ORDER BY product_name DESC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);

echo ' <table id="example1" class="table table-bordered table-hover table-sm">';
echo "<thead  align=center>";
echo "<tr class='table-light'>
      <th width='3%'>ลำดับ</th>
      <th width='10%'>รหัสสินค้า</th>
      <th width='40%'>ชื่อสินค้า</th>
      <th width='20%'>สถานที่จัดเก็บ</th>
      
      <th width='10%'>คงเหลือ</th>
      <th width='10%'>น้ำหนัก</th>
      <th width='7%'></th>
    </tr>";
echo "</thead>";
$i = 1;
while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td align=center>" . $i++  . "</td> ";
  echo "<td align=center>" . $row["product_idn"] . "</td> ";
  echo "<td align=left>" . $row["product_name"] . "</td> ";
  echo "<td align=left>" . $row["location_name"] . "</td> ";
  echo "<td align=right>" . $row["product_uom"] . "&nbsp;". $row["product_unit"]. "</td> ";
  echo "<td align=right>" . $row["product_weight"] ."&nbsp;". "kg"."</td> ";
  
  if($row["calculate_uom"]==1){
  echo "<td align=center><a href='product.php?act=edit&ID=$row[product_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a>
  <a href='product_del_db.php?ID=$row[product_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a>
</td> ";
  }elseif($row["calculate_uom"]==2){
    echo "<td align=center><a href='product.php?act=edit1&ID=$row[product_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a>
  <a href='product_del_db.php?ID=$row[product_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a>
</td> ";
  }
}
}else{

$query = "SELECT *, SUM(product_uom) as total
FROM tb_product
GROUP BY product_name ORDER BY product_id DESC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);

echo ' <table id="example1" class="table table-bordered table-hover table-sm">';
echo "<thead  align=center>";
echo "<tr class='table-light'>";
echo "<th width='3%'>ลำดับ</th>";
echo "<th width='10%'>รหัสสินค้า</th>";
echo "<th width='50%'>ชื่อสินค้า</th>";
echo "<th width='10%'>ราคาขาย</th>";
echo "<th width='10%'>คงเหลือ</th>";
echo "<th width='10%'>น้ำหนัก</th>";
// echo "<th width='7%'></th>";
echo "</tr>";
echo "</thead>";
$i = 1;
while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td align=center>" . $i++  . "</td> ";
  echo "<td align=center>" . $row["product_idn"] . "</td> ";
  echo "<td align=left>" . $row["product_name"] . "</td> ";
  echo "<td align=right>" . number_format($row["product_price"],2) .  "</td> ";
  echo "<td align=right>" . $row["total"] . "&nbsp;". $row["product_unit"]. "</td> ";
  echo "<td align=right>" . $row["product_weight"] ."&nbsp;". "kg"."</td> ";
  
//   if($row["calculate_uom"]==1){
//   echo "<td align=center><a href='product.php?act=edit&ID=$row[product_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a>
//   <a href='product_del_db.php?ID=$row[product_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a>
// </td> ";
//   }elseif($row["calculate_uom"]==2){
//     echo "<td align=center><a href='product.php?act=edit1&ID=$row[product_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a>
//   <a href='product_del_db.php?ID=$row[product_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a>
// </td> ";
//   }
}
}
echo "</table>";
mysqli_close($con);
