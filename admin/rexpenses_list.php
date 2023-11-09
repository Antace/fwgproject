<?php 

 if(@$_GET['do']=='success'){
    echo '<script type="text/javascript">
          swal("", "ทำรายการสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=rexpenses.php" />';

  }else if(@$_GET['do']=='finish'){
    echo '<script type="text/javascript">
          swal("", "แก้ไขสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=rexpenses.php" />';

  }

$query = "SELECT * FROM tb_rexpenses ORDER BY rexpenses_id DESC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
echo ' <table id="example1" class="table table-bordered table-striped">';
  echo "<thead align=center>";
    echo "<tr class='table-light'>
      <th width='5%'>ลำดับ</th>
      <th width='15%'>ผู้รับเหมา</th>
      <th width='20%'>ประเภท</th>
      <th width='10%'>จำนวนเงิน</th>
      <th width='10%'>วันที่ทำรายการ</th>
      <th width='20%'>สถานะการจ่าย</th>
      <th width='10%'>-</th>
      
    </tr>";
  echo "</thead>";
  $i=1;
  while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
    echo "<td  align=center>" .  $i++   .  "</td> ";
    echo "<td>" .$row["contractor_nickname"] .  "</td> ";
    echo "<td>" .$row["expenses_name"] .  "</td> ";
    echo "<td>" .$row["rexpenses_uom"] .  "</td> ";
    echo "<td>" .$row["rexpenses_dt"] .  "</td> ";
    echo "<td>" .$row["rexpenses_status"] .  "</td> ";
    echo "<td align=center><a href='rexpenses.php?act=edit&ID=$row[rexpenses_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a>
    <a href='rexpenses_del_db.php?ID=$row[rexpenses_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a>         
    </td> ";
  echo "</tr>";
  }
echo "</table>";
mysqli_close($con);
?>