<?php
include('../condb.php');
if (isset($_POST['function']) && $_POST['function'] == 'dept') {
  $id = $_POST['id'];
  $sql = "SELECT * FROM tb_position WHERE dept_idp='$id'";
  $query = mysqli_query($con, $sql);
  echo '<option value="" selected disabled>-กรุณาเลือกตำแหน่ง-</option>';
  foreach ($query as $value) {
    echo '<option value="'.$value['position_id'].'">'.$value['name_position'].'</option>';
    
  }
}

?>