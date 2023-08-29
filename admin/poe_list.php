<?php
if(@$_GET['do']=='success'){
echo '<script type="text/javascript">
swal("", "ทำรายการสำเร็จ !!", "success");
</script>';
echo '<meta http-equiv="refresh" content="1;url=poe.php" />';
}else if(@$_GET['do']=='finish'){
echo '<script type="text/javascript">
swal("", "แก้ไขสำเร็จ !!", "success");
</script>';
echo '<meta http-equiv="refresh" content="1;url=poe.php" />';
}
//$query = "
//SELECT * FROM tb_po 
//ORDER BY po_id ASC" or die("Error:" . mysqli_error());
//$result = mysqli_query($con, $query);
$query = "SELECT * FROM tb_po 
WHERE po_dateexpire < current_date AND po_dateexpire != 0000-00-00 AND cb_name = '' ORDER BY po_id DESC" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);
//$sql="SELECT * FROM tb_po WHERE po_dateexpire < current_date AND po_dateexpire != 0000-00-00" ;
//$result1 = mysqli_query($con, $sql,);
include "po_list_thead.php";
  include "po_slist.php";
mysqli_close($con);
?>