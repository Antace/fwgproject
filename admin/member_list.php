<?php 
  if(@$_GET['do']=='success'){
    echo '<script type="text/javascript">
          swal("", "ทำรายการสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=member.php" />';

  }else if(@$_GET['do']=='finish'){
    echo '<script type="text/javascript">
          swal("", "แก้ไขสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=member.php" />';

  }else if(@$_GET['do']=='wrong'){
    echo '<script type="text/javascript">
          swal("", "รหัสผ่านใหม่ไม่ตรงกัน !!", "warning");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=member.php" />';

  }else if(@$_GET['do']=='error'){
    echo '<script type="text/javascript">
          swal("", "ผิดพลาด !!", "error");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=member.php" />';
  }

$query = "SELECT * FROM tb_employee 
ORDER BY employee_id ASC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
echo '<table id="example1" class="table table-bordered table-hover table-sm">';
  echo "<thead align=center>";
    echo "<tr class='table-light'>
      <th width='5%'>ลำดับ</th>
      <th width='15%'>บัญชีผู้ใช้งาน</th>
      <th width='20%'>ชื่อ-นามสกุล</th>
      <th width='15%'>เบอร์ติดต่อ</th>
      <th width='20%'>E-mail</th>
    <th width='15%'>สถานะ</th>
      <th width='7%'></th>
    </tr>";
  echo "</thead>";
  $i=1;
  while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
    echo "<td align=center>" .  $i++   .  "</td> ";
    echo "<td> ".$row["username"].
    "<br>"."<a href='resetpass_admin.php?employee_id=".$row['employee_id']."'><span class='btn btn-primary btn-xs'>(เปลี่ยนรหัสผ่าน)</span></a></td> ";
    echo "<td> ".$row["employee_name"]."</td> ";
    echo "<td> ".$row["employee_tel"].  "</td> ";
    echo "<td> ".$row["employee_mail"].  "</td> ";
  
  echo "<td> ".$row["employee_level"].  "</td> ";
        
    echo "<td align=center><a href='member.php?act=edit&ID=$row[employee_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a>   
          <a href='member_del_db.php?ID=$row[employee_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a>
    </td> ";
   
  } 
echo "</table>";
mysqli_close($con);
?>
