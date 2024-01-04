<?php
include "po_list_show_h.php";
  
  $query = "SELECT * FROM tb_po 
  WHERE customer_name LIKE '%$qcus%'  AND work_by LIKE '%$qcate%'  "  or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);


mysqli_close($con);
?>