<?php 
  if(@$_GET['do']=='success'){
    echo '<script type="text/javascript">
          swal("", "ทำรายการสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=salary.php" />';

  }else if(@$_GET['do']=='finish'){
    echo '<script type="text/javascript">
          swal("", "แก้ไขสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=salary.php" />';

  }else if(@$_GET['do']=='wrong'){
    echo '<script type="text/javascript">
          swal("", "รหัสผ่านใหม่ไม่ตรงกัน !!", "warning");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=salary.php" />';

  }else if(@$_GET['do']=='error'){
    echo '<script type="text/javascript">
          swal("", "ผิดพลาด !!", "error");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=salary.php" />';
  }

  echo ' โครงการ  = ';
  echo '<font color="blue">'; 
  echo $_GET['qdeptnpd'];
  echo '</font>';
 
  echo '<br/>'; 

  

  $query = "SELECT * FROM tb_labeldetail 
  WHERE  department_name LIKE '%$qdeptnpd%' AND label_orderstatus = 0 "  or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query);
  
  include "labeldetail_list_ashow.php";
  mysqli_close($con);