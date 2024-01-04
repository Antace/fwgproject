<?php
include "po_list_show_h.php";
  
  $query = "SELECT * FROM tb_po 
  WHERE po_name LIKE '%$qpo%'  AND work_by LIKE '%$qcus%'  "  or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  include "po_slist.php";

mysqli_close($con);
?>