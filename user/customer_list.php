<?php
if(@$_GET['do']=='success'){
echo '<script type="text/javascript">
swal("", "ทำรายการสำเร็จ !!", "success");
</script>';
echo '<meta http-equiv="refresh" content="1;url=customer.php" />';
}else if(@$_GET['do']=='finish'){
echo '<script type="text/javascript">
swal("", "แก้ไขสำเร็จ !!", "success");
</script>';
echo '<meta http-equiv="refresh" content="1;url=customer.php" />';
}
$query = "SELECT * FROM tb_customer
ORDER BY customer_id DESC" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);
echo ' <table id="example1" class="table table-bordered table-striped">';
  echo "<thead>";
    echo "<tr class=''>
      <th width='3%'  class='hidden-xs'>ID</th>
      <th width='30%'>ชื่อบริษัท</th>
      <th width='30%' class='hidden-xs'>ที่อยู่</th>
      <th>สาขา</th>
      <th width='7%'>-</th>
    </tr>";
  echo "</thead>";
  $i=1;
  while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
    echo "<td  class='hidden-xs'>" .  $i++   .  "</td> ";
  echo "<td>" .$row["customer_name"] ."</td class='hidden-xs'> ";
  echo "<td class='hidden-xs'>" .$row["customer_address"] ."</td> ";
  echo "<td>" .$row["customer_branch"] .  "<br>Tax-id : ".$row["customer_tax"]." โทร : ".$row["customer_tel"].
  "</td> ";
"</td> ";

echo "<td><a href='customer.php?act=edit&ID=$row[customer_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a>
  <a href='customer_del_db.php?ID=$row[customer_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a>
</td> ";

}
echo "</table>";
mysqli_close($con);
?>