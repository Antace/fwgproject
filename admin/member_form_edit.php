<?php 
$ID = mysqli_real_escape_string($con,$_GET['ID']);
$sql = "SELECT * FROM tb_employee WHERE employee_id=$ID";
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
$row = mysqli_fetch_array($result);
?>
<div align="right">
  <font color="red">*</font>
  <font color="gray">Required Fields</font>
</div>
<hr>
<form action="member_form_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
    <div class="col-sm-2 control-label">
      Username : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="text" name="username" required class="form-control" autocomplete="off" pattern="^[a-zA-Z0-9]+$" title="ภาษาอังกฤษหรือตัวเลขเท่านั้น" minlength="2" value="<?php echo $row['username'];?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ชื่อ-นามสกุล : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="text" name="employee_name" required class="form-control" value="<?php echo $row['employee_name'];?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      เบอร์โทร : <font color="red">*</font>
    </div>
    <div class="col-sm-3"> 
      <input type="text" name="employee_tel" required class="form-control" size="10" value="<?php echo $row['employee_tel'];?>">
    </div>
  </div>
   <div class="form-group">
    <div class="col-sm-2 control-label">
      อีเมล์ : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="email" name="employee_mail" required class="form-control" value="<?php echo $row['employee_mail'];?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      สถานะ : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <select name="employee_level" class="form-control" required>
    <option value="<?php echo $row['employee_level'];?>"><?php echo $row['employee_level'];?></option>
    <option value="admin">admin</option>
    <option value="user">user</option>
    </select>
    </div>
  </div>
  <div class="form-group">
      <div class="col-sm-6">
        <input type="hidden" name="username1" required class="form-control" value="<?php echo $username; ?>" readonly >
      </div>
    </div>
  <hr>

  <div class="form-group">
    <div class="col-sm-12">
     <font color ="gray">บันทึกข้อมูลล่าสุด : <?php echo $row['employee_dt']; ?> ผู้บันทึก : <?php echo $row ['username1']; ?> </font> 
    </div>
  </div>
  <hr>
  <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
      <input type="hidden" name="employee_id" value="<?php echo $ID; ?>" />
      <button type="submit" class="btn btn-success">บันทึก</button>
      <a href="member.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>