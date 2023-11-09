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
$query = "SELECT * FROM tb_productdept
ORDER BY productdept_id DESC" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);
echo ' <table id="example1" class="table table-bordered table-striped">';
echo "<thead  align=center>";
echo "<tr class='table-light'>
      <th width='3%'>ลำดับ</th>
      <th width='30%'>ชื่อสินค้า</th>
      <th width='15%'>ราคาผลิต/ความยาว(เมตร)</th>

      <th width='7%'>-</th>
    </tr>";
echo "</thead>";
$i = 1;
while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td align=center>" . $i++  . "</td> ";
  echo "<td align=left>" . $row["productdept_name"] . "</td> ";
  echo "<td align=right>" . number_format($row["productdept_price"],2) .  "</td> ";
  

  echo "<td align=center><a href='product.php?act=edit&ID=$row[product_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a>
  <a href='product_del_db.php?ID=$row[product_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a>
</td> ";
}
echo "</table>";
mysqli_close($con);
