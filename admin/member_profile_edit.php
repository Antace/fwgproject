<?php 
if(@$_GET['do']=='finish'){
    echo '<script type="text/javascript">
          swal("", "แก้ไขสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=member_profile.php" />';

  }
$sql = "SELECT * FROM tb_employee WHERE employee_id=$employee_id";
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
$row = mysqli_fetch_array($result);
?>

<form action="member_profile_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
 
  <div class="form-group">
    <div class="col-sm-2 control-label">
      Username :
    </div>
    <div class="col-sm-3">
      <input type="text" name="username" required class="form-control" autocomplete="off" pattern="^[a-zA-Z0-9]+$" title="ภาษาอังกฤษหรือตัวเลขเท่านั้น" minlength="2" value="<?php echo $row['username'];?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ชื่อ-นามสกุล :
    </div>
    <div class="col-sm-3">
      <input type="text" name="employee_name" required class="form-control" value="<?php echo $row['employee_name'];?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      เบอร์โทร :
    </div>
    <div class="col-sm-3"> 
      <input type="text" name="employee_tel" required class="form-control" value="<?php echo $row['employee_tel'];?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      อีเมล์ :
    </div>
    <div class="col-sm-3">
      <input type="email" name="employee_mail" required class="form-control" value="<?php echo $row['employee_mail'];?>">
    </div>
  </div>
  
   
  <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
      <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>" />
      <button type="submit" class="btn btn-success">บันทึก</button>
      <a href="member.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>