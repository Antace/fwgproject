<?php
include "po_list_show_h.php";
  
  $query = "SELECT * FROM tb_po 
  WHERE po_name LIKE '%$qpo%' AND department_name LIKE '%$qdept%' AND work_by LIKE '%$qcate%' "  or die("Error:" . mysqli_error());

  $result = mysqli_query($con, $query);
  include "po_slist.php";

mysqli_close($con);
?>