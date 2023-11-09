<?php
if (@$_GET['do'] == 'success') {
  echo '<script type="text/javascript">
          swal("", "ทำรายการสำเร็จ !!", "success");
          </script>';
  echo '<meta http-equiv="refresh" content="1;url=employee.php" />';
} else if (@$_GET['do'] == 'finish') {
  echo '<script type="text/javascript">
          swal("", "แก้ไขสำเร็จ !!", "success");
          </script>';
  echo '<meta http-equiv="refresh" content="1;url=employee.php" />';
}

$query = "SELECT * FROM tb_employees as e
INNER JOIN tb_dept as d ON e.name_dept = d.dept_id
INNER JOIN tb_position as p ON e.name_position = p.position_id
ORDER BY employee_id ASC" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);

echo '<table id="example1" class="table table-bordered table-striped">';
echo "<thead align=center>";
echo "<tr class='table-light'>
      <th width='3%'>ลำดับ</th>
      <th width='5%'>รหัส</th>
      <th width='25%'>ชื่อ-นามสกุล</th>
      <th width='25%'>แผนก</th>
      <th width='30%'>ตำแหน่ง</th>
      <th width='12%'>-</th>
      
    </tr>";
echo "</thead>";
$i = 1;
while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td align=center>" .  $i++   .  "</td> ";
  echo "<td align=center> " . $row["emp_id"] .  "</td> ";
  echo "<td> " . $row["employee_name"] .  "</td> ";
  echo "<td> " . $row["name_dept"] .  "</td> ";
  echo "<td> " . $row["name_position"] .  "</td> ";
  

  echo "<td align=center><a href='employee.php?act=edit&ID=$row[employee_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a>   
          <a href='employee_del_db.php?ID=$row[employee_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a>
          <a href='employee.php?act=salary&ID=$row[employee_id]' class='btn btn-success btn-xs'><i class='fas fa-money-check'></i></a> 
    </td> ";
  
}
echo "</table>";
mysqli_close($con);
