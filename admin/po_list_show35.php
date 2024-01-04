<?php
include "po_list_show_h.php";
  
  $query = "SELECT * FROM tb_po 
  WHERE department_name LIKE '%$qdept%'  AND work_by LIKE '%$qcate%'  "  or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  include "po_slist.php";

mysqli_close($con);
?>