<?php 

 if(@$_GET['do']=='success'){
    echo '<script type="text/javascript">
          swal("", "ทำรายการสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=expenses.php" />';

  }else if(@$_GET['do']=='finish'){
    echo '<script type="text/javascript">
          swal("", "แก้ไขสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=expenses.php" />';

  }

$query = "SELECT * FROM tb_expenses ORDER BY expenses_id ASC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
echo ' <table id="example1" class="table table-bordered table-hover table-sm">';
  echo "<thead align=center>";
    echo "<tr class='table-light'>
      <th width='5%'>ลำดับ</th>
      <th width='65%'>รายการค่าใช้จ่าย</th>
      <th width='20%'>วันที่ทำรายการ</th>
      <th width='10%'></th>
      
    </tr>";
  echo "</thead>";
  $i=1;
  while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
    echo "<td  align=center>" .  $i++   .  "</td> ";
    echo "<td>" .$row["expenses_name"] .  "</td> ";
    echo "<td align=center>" .$row["expenses_dt"] .  "</td> ";
    echo "<td align=center><a href='expenses.php?act=edit&ID=$row[expenses_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a>
    <a href='expenses_del_db.php?ID=$row[expenses_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a>         
    </td> ";
  echo "</tr>";
  }
echo "</table>";
mysqli_close($con);
?>