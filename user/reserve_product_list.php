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
  $query = "SELECT * FROM tb_reserve
ORDER BY reserve_id DESC" or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query);

  echo ' <table id="example1" class="table table-bordered table-striped">';
  echo "<thead  align=center>";
  echo "<tr class=''>
      <th width='3%'>ลำดับ</th>
      <th width='7%'>เลขที่</th>
      <th width='7%'>วันที่ขาย</th>
      <th width='30%'>ชื่อลูกค้า</th>
      <th width='10%'>สถานะรับของ</th>
      <th width='10%'>สถานะการจ่าย</th>
      <th width='10%'>ประเภทการจ่าย</th>
      <th width='10%'>ใบกำกับภาษี</th>
      <th width='10%'>-</th>
    </tr>";
  echo "</thead>";
  $i = 1;
  while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td  align=center>" . $i++  . "</td> ";
    echo "<td>" . "R" . $row["reserve_id"] .  "</td> ";
    echo "<td> " .date('d-m-Y',strtotime($row["reserve_date"])) . "</td> ";
    echo "<td>" . $row["customer_name"] . "</td> ";
    echo "<td>" . $row["receive_status"] . "</td> ";
    echo "<td>" . $row["payment_status"] . "</td> ";
    echo "<td>" . $row["payment_type"] . "</td> ";
    echo "<td align=center><a href='reserve.php?act=vat&ID=$row[reserve_id]' class='btn btn-primary btn-xs'>ใบกำกับภาษี</a></td> ";
    echo "<td align=center><a href='reserve.php?act=view&ID=$row[reserve_id]' class='btn btn-warning btn-xs'>เปิด</a>
    <a href='reserve.php?act=reserve_cancel&ID=$row[reserve_id]' class='btn btn-danger btn-xs'>คืนสินค้า</a></td> ";
    echo "</tr>";
  }
  ?>
  </table>