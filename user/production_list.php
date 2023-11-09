  <?php
  //connect db
  if(@$_GET['do']=='success'){
    echo '<script type="text/javascript">
          swal("", "ทำรายการสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=production.php" />';

  }else if(@$_GET['do']=='finish'){
    echo '<script type="text/javascript">
          swal("", "แก้ไขสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=production.php" />';
  }
  $query = "SELECT * FROM tb_production
ORDER BY production_id DESC" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);
echo ' <table id="example1" class="table table-bordered table-striped">';
  echo "<thead>";
    echo "<tr class=''>
      <th width='3%'>ลำดับ</th>
       <th width='20%'>เลขที่การผลิต</th>
       <th width='30%' >วันที่ผลิต</th>
      <th>ชื่อผู้รับเหมา</th>
      <th width='15%'>-</th>
    </tr>";
  echo "</thead>";
  $i = 1;
while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
    echo "<td  align=center>" . $i++  . "</td> ";
    echo "<td>" ."IN".$row["production_id"] .  "</td> ";
    echo "<td> " .$row["production_date"] . "</td> ";
    echo "<td>" .$row["contractor_nickname"] ."</td> ";
    
    echo "<td align=center><a href='production.php?act=view&ID=$row[production_id]' class='btn btn-warning btn-xs'>เปิด</a>
    <a href='production.php?act=production_cancel&ID=$row[production_id]' class='btn btn-danger btn-xs'>ลบ</a>
    
  </td> ";
	echo "</tr>";
  }
  ?>
</table>