<?php 

 if(@$_GET['do']=='success'){
    echo '<script type="text/javascript">
          swal("", "ทำรายการสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=location.php" />';

  }else if(@$_GET['do']=='finish'){
    echo '<script type="text/javascript">
          swal("", "แก้ไขสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=location.php" />';

  }

$query = "SELECT * FROM tb_location ORDER BY location_id DESC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
echo ' <table id="example1" class="table table-bordered table-hover table-sm">';
  echo "<thead align=center>";
    echo "<tr class='table-light'>
      <th width='5%'>ลำดับ</th>
      <th width='30%'>ชื่อสถานที่จัดเก็บ</th>
      <th width='20%'>ผู้บันทึก</th>
      <th width='20%'>วันที่แก้ไข</th>
      <th width='10%'></th>
      
    </tr>";
  echo "</thead>";
  $i=1;
  while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
    echo "<td align=center>" .  $i++   .  "</td> ";
    echo "<td>" .$row["location_name"] .  "</td> ";
    echo "<td align=center>" .$row["username"] .  "</td> ";
    echo "<td align='center'>" .$row["location_dt"] .  "</td> ";
    echo "<td align=center><a href='location.php?act=edit&ID=$row[location_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a>
    <a href='location_del_db.php?ID=$row[location_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a>   
    </td> ";
  echo "</tr>";
  }
echo "</table>";
mysqli_close($con);
?>