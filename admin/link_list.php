<?php
if (@$_GET['do'] == 'success') {
  echo '<script type="text/javascript">
        swal("", "ทำรายการสำเร็จ !!", "success");
        </script>';
  echo '<meta http-equiv="refresh" content="1;url=link.php" />';
} else if (@$_GET['do'] == 'finish') {
  echo '<script type="text/javascript">
        swal("", "แก้ไขสำเร็จ !!", "success");
        </script>';
  echo '<meta http-equiv="refresh" content="1;url=link.php" />';
}
$query = "SELECT * FROM tb_link
ORDER BY link_id DESC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
echo ' <table id="example1" class="table table-bordered table-striped">';
echo "<thead  align=center>";
echo "<tr class='table-light'>
      <th width='3%'>ลำดับ</th>
      <th width='30%'>อีเมล์/เว็บไซต์</th>
      <th width='20%'>รหัสผ่าน</th>
      <th width='40%'>หมายเหตุ</th>
      
      <th width='7%'>-</th>
    </tr>";
echo "</thead>";
$i = 1;
while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td  align=center>" . $i++  . "</td> ";
  echo "<td>" . "<a href= ".$row['link_name']." target=blank>".$row['link_name']."</a>" . "</td> ";
  echo "<td>" . $row['link_pass'] . "</td> ";
  echo "<td>"  . $row["link_detail"] . "</td> ";
  
  "</td> ";

  echo "<td align=center><a href='link.php?act=edit&ID=$row[link_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a>
  <a href='link_del_db.php?ID=$row[link_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a>
</td> ";
}
echo "</table>";
mysqli_close($con);
