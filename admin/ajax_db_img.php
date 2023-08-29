<?php
include('../condb.php');
if (isset($_POST['function']) && $_POST['function'] == 'dept') {
  $id = $_POST['id'];
  $sql = "SELECT * FROM tb_label WHERE label_pic1='$id'";
  $query = mysqli_query($con, $sql);
    echo '<img src="../label_img/'. $row['label_pic1'].'" id="label_pic1" width="200px">';
  foreach ($query as $value) {
    echo '<option value="'.$value['position_id'].'">'.$value['name_position'].'</option>';
    
  }
}

?>