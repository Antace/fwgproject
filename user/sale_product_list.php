  <?php
  //connect db
  if (@$_GET['do'] == 'success') {
    echo '<script type="text/javascript">
          swal("", "ทำรายการสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=sale.php" />';
  } else if (@$_GET['do'] == 'finish') {
    echo '<script type="text/javascript">
          swal("", "แก้ไขสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=sale.php" />';
  }
  $query = "SELECT * FROM tb_sale
ORDER BY sale_id DESC" or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query);

  echo ' <table id="example1" class="table table-bordered table-striped">';
  echo "<thead  align=center>";
  echo "<tr class=''>
      <th width='3%'>ลำดับ</th>
      <th width='7%'>เลขที่</th>
      <th width='7%'>วันที่ขาย</th>
      <th width='30%'>ชื่อลูกค้า</th>
      <th width='8%'>จำนวนเงิน</th>
      <th width='7%'>ภาษี</th>
      <th width='10%'>จำนวนทั้งหมด</th>
      <th width='6%'>สถานะการจ่าย</th>
      <th width='10%'>-</th>
    </tr>";
  echo "</thead>";
  $i = 1;
  while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td  align=center>" . $i++  . "</td> ";
    echo "<td>" . "S" . $row["sale_id"] .  "</td> ";
    echo "<td> " .date('d-m-Y',strtotime($row["sale_date"])) . "</td> ";
    echo "<td>" . $row["customer_name"] . "</td> ";
    echo "<td align=right>" . number_format($row["sale_total"],2) . "</td> ";
    echo "<td align=right>" . number_format($row["sale_vat"],2) . "</td> ";
    echo "<td align=right>" . number_format ($row["sale_stotal"],2) . "</td> ";
    echo "<td>" . $row["sale_status"] . "</td> ";

    echo "<td align=center><a href='sale.php?act=view&ID=$row[sale_id]' class='btn btn-warning btn-xs'>เปิด</a>
    <a href='sale.php?act=sale_cancel&ID=$row[sale_id]' class='btn btn-danger btn-xs'>คืนสินค้า</a>
    
  </td> ";
    echo "</tr>";
  }
  ?>
  </table>