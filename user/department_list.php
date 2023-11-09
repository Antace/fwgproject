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

  }

$query = "SELECT * FROM tb_department ORDER BY department_id DESC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
echo ' <table id="example1" class="table table-bordered table-striped">';
  echo "<thead align=center>";
    echo "<tr class='table-light'>
      <th width='5%'>ลำดับ</th>
      <th width='20%'>รหัสโครงการ</th>
      <th width='65%'>ชื่อโครงการ</th>
      
      <th width='10%'>-</th>
      
    </tr>";
  echo "</thead>";
  $i=1;
  while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
    echo "<td  align=center>" .  $i++   .  "</td> ";
    echo "<td>" .$row["dept_name"] .  "</td> ";
    echo "<td>" .$row["department_name"] .  "</td> ";
    echo "<td align=center><a href='department.php?act=edit&ID=$row[department_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a>
    <a href='department_del_db.php?ID=$row[department_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a>         
    </td> ";
  echo "</tr>";
  }
echo "</table>";
mysqli_close($con);
?>