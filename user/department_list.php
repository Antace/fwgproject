<?php 

 if(@$_GET['do']=='success'){
    echo '<script type="text/javascript">
          swal("", "ทำรายการสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=department.php" />';

  }else if(@$_GET['do']=='finish'){
    echo '<script type="text/javascript">
          swal("", "แก้ไขสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=department.php" />';

  }else if(@$_GET['do']=='wrong'){
    echo '<script type="text/javascript">
          swal("", "รหัสผ่านใหม่ไม่ตรงกัน !!", "warning");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=department.php" />';

  }else if(@$_GET['do']=='error'){
    echo '<script type="text/javascript">
          swal("", "ผิดพลาด !!", "error");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=department.php" />';
  }

$query = "SELECT * FROM tb_department ORDER BY department_id DESC" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);
echo ' <table id="example1" class="table table-bordered table-striped">';
  echo "<thead>";
    echo "<tr class=''>
      <th width='5%'>ID</th>
      <th>ตัวย่อโครงการ</th>
      <th>ชื่อโครงการ</th>
      <th width='5%'>-</th>
      <th width='5%'>-</th>
    </tr>";
  echo "</thead>";
  $i=1;
  while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
    echo "<td  class='hidden-xs'>" .  $i++   .  "</td> ";
    echo "<td>" .$row["dept_name"] .  "</td> ";
    echo "<td>" .$row["department_name"] .  "</td> ";
    echo "<td><a href='department.php?act=edit&ID=$row[department_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a>         
    </td> ";
    echo "<td><a href='department_del_db.php?ID=$row[department_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a></td> ";
  echo "</tr>";
  }
echo "</table>";
mysqli_close($con);
?>