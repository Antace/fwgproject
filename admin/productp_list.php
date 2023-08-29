<?php
if (@$_GET['do'] == 'success') {
  echo '<script type="text/javascript">
        swal("", "ทำรายการสำเร็จ !!", "success");
        </script>';
  echo '<meta http-equiv="refresh" content="1;url=productp.php" />';
} else if (@$_GET['do'] == 'finish') {
  echo '<script type="text/javascript">
        swal("", "แก้ไขสำเร็จ !!", "success");
        </script>';
  echo '<meta http-equiv="refresh" content="1;url=productp.php" />';
}
$query = "SELECT * FROM tb_productproject
ORDER BY productp_id DESC" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);
echo ' <table id="example1" class="table table-bordered table-striped">';
echo "<thead  align=center>";
echo "<tr class='table-light'>
      <th width='3%'>ลำดับ</th>
      <th width='30%'>ชื่อสินค้า</th>
      <th width='15%'>ขนาด</th>
      <th width='25%'>โครงการ</th>
      <th width='10%'>คงเหลือ</th>
      <th width='10%'>น้ำหนัก</th>
      <th width='7%'>-</th>
    </tr>";
echo "</thead>";
$i = 1;
while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td align=center>" . $i++  . "</td> ";
  echo "<td align=center>" . $row["productp_name"] . "</td> ";
  echo "<td align=center>" . number_format($row["productp_thick"],3) .' x '.  number_format($row["productp_height"],2) .' x '.  number_format($row["productp_long"],2) .' ม.' . "</td> ";
  echo "<td align=center>" . $row["department_name"] . "</td> ";
  echo "<td align=right>" . $row["productp_uom"] . "&nbsp;". $row["productp_unit"]. "</td> ";
  echo "<td align=right>" . $row["productp_weight"] ."&nbsp;". "kg"."</td> ";
  

  echo "<td align=center><a href='product.php?act=edit&ID=$row[product_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a>
  <a href='product_del_db.php?ID=$row[product_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a>
</td> ";
}
echo "</table>";
mysqli_close($con);
