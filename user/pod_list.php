<?php
if(@$_GET['do']=='success'){
echo '<script type="text/javascript">
swal("", "ทำรายการสำเร็จ !!", "success");
</script>';
echo '<meta http-equiv="refresh" content="1;url=pod.php" />';
}else if(@$_GET['do']=='finish'){
echo '<script type="text/javascript">
swal("", "แก้ไขสำเร็จ !!", "success");
</script>';
echo '<meta http-equiv="refresh" content="1;url=pod.php" />';
}
//$query = "
//SELECT * FROM tb_po 
//ORDER BY po_id ASC" or die("Error:" . mysqli_error());
//$result = mysqli_query($con, $query);
$query = "SELECT * FROM tb_po 
WHERE po_dateexpire < current_date AND po_dateexpire != 0000-00-00 AND cb_name != ''ORDER BY po_id DESC" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);
//$sql="SELECT * FROM tb_po WHERE po_dateexpire < current_date AND po_dateexpire != 0000-00-00" ;
//$result1 = mysqli_query($con, $sql,);
echo ' <table id="example1" class="table table-bordered table-striped">';
  echo "<thead>";
    //echo mysqli_num_rows($result1);
    //exit;
    echo "<tr class=''>
      <th width='3%'  class='hidden-xs'>ID</th>
      <th width='25%'>ข้อมูลใบสั่งซื้อ</th>
      <th width='9%' class='hidden-xs'>PO</th>
      <th width='2%'>*</th>
      <th width='9%' class='hidden-xs'>DB</th>
      <th width='2%'>*</th>
      <th width='9%' class='hidden-xs'>IV</th>
      <th width='2%'>*</th>
      <th width='9%' class='hidden-xs'>PM</th>
      <th width='2%'>*</th>
      <th width='25%' class='hidden-xs'>ข้อมูลงานประกัน</th>
      <th width='2%'>*</th>
    </tr>";
  echo "</thead>";
  include "po_slist.php";
mysqli_close($con);
?>