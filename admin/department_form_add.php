<?php
if (@$_GET['do'] == 'f') {
  echo '<script type="text/javascript">
            swal("", "กรุณาใส่ข้อมูลให้ถูกต้อง !!", "warning");
            </script>';
  echo '<meta http-equiv="refresh" content="2;url=department.php?act=add" />';
} elseif (@$_GET['do'] == 'd') {
  echo '<script type="text/javascript">
            swal("", "ชื่อโครงการ/หน่วยงานซ้ำ กรุณาเปลี่ยน  !!", "error");
            </script>';
  echo '<meta http-equiv="refresh" content="1;url=department.php?act=add" />';
}
?>
<div align="right">
  <font color="red">*</font>
  <font color="gray">Required Fields</font>
</div>
<hr>
<form action="department_form_add_db.php" method="post" class="form-horizontal">
  <div class="form-group">
    <div class="col-sm-3 control-label">
      รหัสโครงการ/หน่วยงาน : 
    </div>
    <div class="col-sm-3">
      <input type="text" name="dept_name"  class="form-control" minlength="2">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label">
      ชื่อโครงการ/หน่วยงาน : <font color="red">*</font>
    </div>
    <div class="col-sm-9">
      <input type="text" name="department_name" required class="form-control" minlength="2">
    </div>
  </div>
  <hr>
  <div class="form-group">
      <div class="col-sm-6">
        <input type="hidden" name="username" required class="form-control" value="<?php echo $username; ?>" readonly >
      </div>
    </div>
  <div class="form-group">
    <div class="col-sm-3">
    </div>
    <div class="col-sm-3">
      <button type="submit" class="btn btn-success ">เพิ่มข้อมูล</button>
      <a href="department.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>