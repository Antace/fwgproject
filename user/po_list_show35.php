<?php
if(@$_GET['do']=='success'){
echo '<script type="text/javascript">
swal("", "ทำรายการสำเร็จ !!", "success");
</script>';
echo '<meta http-equiv="refresh" content="1;url=po.php" />';
}else if(@$_GET['do']=='finish'){
echo '<script type="text/javascript">
swal("", "แก้ไขสำเร็จ !!", "success");
</script>';
echo '<meta http-equiv="refresh" content="1;url=po.php" />';
}
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
  
  echo 'เลขที่ใบสั่งซื้อ  = ';
  echo '<font color="blue">'; 
  echo $_GET['qpo'];
  echo '</font>';
  echo ' ลูกค้า  = ';
  echo '<font color="blue">'; 
  echo $_GET['qcus'];
  echo '</font>';
  echo ' โครงการ  = ';
  echo '<font color="blue">'; 
  echo $_GET['qdept'];
  echo '</font>';
  echo ' ประเภทงาน  = ';
  echo '<font color="blue">'; 
  echo $_GET['qcate'];
  echo '</font>';
  echo '<br/>'; 
  
  $query = "SELECT * FROM tb_po 
  WHERE department_name LIKE '%$qdept%'  AND category_name LIKE '%$qcate%'  "  or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query);
  include "po_slist.php";

mysqli_close($con);
?>