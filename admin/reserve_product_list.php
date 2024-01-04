  <?php
  //connect db
  if (@$_GET['do'] == 'success') {
    echo '<script type="text/javascript">
          swal("", "ทำรายการสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=reserve.php" />';
  } else if (@$_GET['do'] == 'finish') {
    echo '<script type="text/javascript">
          swal("", "แก้ไขสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=reserve.php" />';
  }
  if ($_GET['act'] == 'seeall') {
    $query = "SELECT * FROM tb_reserve
ORDER BY reserve_date DESC " or die("Error:" . mysqli_error($con));
    $result = mysqli_query($con, $query);
  } else {
    $query = "SELECT * FROM tb_reserve
  WHERE reserve_date <= current_date
ORDER BY reserve_id DESC " or die("Error:" . mysqli_error($con));
    $result = mysqli_query($con, $query);
  }
  echo ' <table id="example1" class="table table-bordered table-hover table-sm">';
  echo "<thead  align=center>";
  echo "<tr class=''>
      <th width='3%'>ลำดับ</th>
      <th width='7%'>เลขที่</th>
      <th width='7%'>วันที่นัดรับ</th>
      <th width='20%'>ชื่อลูกค้า</th>
      <th width='10%'>สถานะรับของ</th>
      <th width='7%'>ผู้บันทึก</th>
      <th width='10%'>วันที่ทำรายการ</th>
      <th width='5%'>รับของ</th>
      <th width='10%'></th>
    </tr>";
  echo "</thead>";
  $i = 1;
  while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td align=center>" . $i++  . "</td> ";
    echo "<td align=center>" . "R" . $row["reserve_id"] .  "</td> ";
    echo "<td align=center> " . date('d-m-Y', strtotime($row["reserve_date"])) . "</td> ";
    echo "<td>" . $row["customer_name"] . "</td> ";
    if ($row["receive_status"] == 'รับของแล้ว') {
      echo "<td align=center>" . "<font color='green'>" . $row["receive_status"] . "</font>" . "</td> ";
    } else {
      echo "<td align=center>" . "<font color='warning'>" . $row["receive_status"] . "</font>" . "</td> ";
    }
    echo "<td align=center>" . $row["username"] . "</td> ";
    echo "<td align=center>" . $row["reserve_dt"] . "</td> ";

    


    if ($row["receive_status"] == 'รับของแล้ว') {
      echo "<td align=center><a href='reserve.php?act=sale&ID=$row[reserve_id]' class='btn btn-primary btn-xs disabled' >รับของ</a></td> ";
      echo "<td align=center><a href='reserve.php?act=view&ID=$row[reserve_id]' class='btn btn-info btn-xs'><i class='fas fa-folder-open'></i></a>
    <a href='reserve.php?act=reserve_cancel&ID=$row[reserve_id]' class='btn btn-danger btn-xs disabled' ><i class='fas fa-trash-restore'></i></a></td> ";
    } else {
      echo "<td align=center><a href='reserve.php?act=sale&ID=$row[reserve_id]' class='btn btn-primary btn-xs'>รับของ</a></td> ";
      echo "<td align=center><a href='reserve.php?act=view&ID=$row[reserve_id]' class='btn btn-info btn-xs'><i class='fas fa-folder-open'></i></a>
    <a href='reserve.php?act=reserve_cancel&ID=$row[reserve_id]' class='btn btn-danger btn-xs'><i class='fas fa-trash-restore'></i></a></td> ";
    }
    echo "</tr>";
  }
  ?>

  </table>