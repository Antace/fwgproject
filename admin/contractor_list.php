<?php
if (@$_GET['do'] == 'success') {
  echo '<script type="text/javascript">
        swal("", "ทำรายการสำเร็จ !!", "success");
        </script>';
  echo '<meta http-equiv="refresh" content="1;url=contractor.php" />';
} else if (@$_GET['do'] == 'finish') {
  echo '<script type="text/javascript">
        swal("", "แก้ไขสำเร็จ !!", "success");
        </script>';
  echo '<meta http-equiv="refresh" content="1;url=contractor.php" />';
}
if($act=='exp'){
  $query = "SELECT * FROM tb_contractor WHERE contractor_expired < current_date
  ORDER BY contractor_id ASC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
}else{
$query = "SELECT * FROM tb_contractor
ORDER BY contractor_id ASC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
}
echo ' <table id="example1" class="table table-bordered table-hover table-sm">';
echo "<thead  align=center>";
echo "<tr class='table-light'>
      <th width='5%'>ลำดับ</th>
      <th width='15%'>ชื่อ-นามสกุล</th>
      <th width='10%'>ชื่อเล่น</th>
      <th width='15%'>เลขประจำตัวประชุาชน</th>
      <th width='30%'>ที่อยู่</th>
      <th width='15%'>วันที่บัตรหมดอายุ</th>
      <th width='10%'></th>
    </tr>";
echo "</thead>";
$i = 1;
while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td align=center>" . $i++  . "</td> ";
  echo "<td>" . $row["contractor_name"] . "</td> ";
  echo "<td>" . $row["contractor_nickname"] . "</td> ";
  echo "<td align=center>" . $row["contractor_nid"] . "</td> ";
  echo "<td>" . $row["contractor_address"] . "</td> ";
  if($row["contractor_expired"] < date('Y-m-d')){
  echo "<td align=center>" .'<font color="warning">'. 'บัตรหมดอายุ'. '</font>'. "</td> ";
  }else 
  echo "<td align=center>" . $row["contractor_expired"] . "</td> ";
  "</td> ";

  echo "<td align=center><a href='contractor.php?act=edit&ID=$row[contractor_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a>
  <a href='contractor_del_db.php?ID=$row[contractor_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a>
</td> ";
}
echo "</table>";
mysqli_close($con);
