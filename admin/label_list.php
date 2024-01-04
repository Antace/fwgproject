<?php
if (@$_GET['do'] == 'success') {
  echo '<script type="text/javascript">
        swal("", "ทำรายการสำเร็จ !!", "success");
        </script>';
  echo '<meta http-equiv="refresh" content="1;url=label.php" />';
} else if (@$_GET['do'] == 'finish') {
  echo '<script type="text/javascript">
        swal("", "แก้ไขสำเร็จ !!", "success");
        </script>';
  echo '<meta http-equiv="refresh" content="1;url=label.php" />';

}



$query = "SELECT * FROM tb_label
ORDER BY label_id DESC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
echo ' <table id="example1" class="table table-bordered table-hover table-sm">';
echo "<thead  align=center>";
echo "<tr class='table-light'>
      <th width='3%'>ลำดับ</th>
      <th width='8%'>รูป 1</th>
      <th width='8%'>รูป 2</th>
      <th width='30%'>ชื่อสินค้า</th>
      
      <th width='10%'>ราคา</th>

      <th width='7%'></th>
    </tr>";
echo "</thead>";
$i = 1;
while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td align=center>" . $i++  . "</td> ";
  echo "<td align=center>". '<a href="../label_img/'.$row["label_pic1"].'" data-toggle="lightbox" data-title="'.$row["label_pic1"].'">'.'<img src="../label_img/'.$row["label_pic1"].'" width="90" height="90" border="0"  />'."</td>";
  echo "<td align=center>". '<a href="../label_img/'.$row["label_pic2"].'" data-toggle="lightbox" data-title="'.$row["label_pic2"].'">'.'<img src="../label_img/'.$row["label_pic2"].'" width="90" height="90" border="0"  />'."</td>";
  
  echo "<td align=left>" . $row["label_name"] . "</td> ";
  echo "<td align=right>" . number_format($row["label_price"],2) .  "</td> ";
  echo "<td align=center><a href='label.php?act=edit&ID=$row[label_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a>
  <a href='label_del_db.php?ID=$row[label_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a>
</td> ";
}
echo "</table>";
mysqli_close($con);
