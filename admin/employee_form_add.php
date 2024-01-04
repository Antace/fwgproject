<?php
$query2 = "SELECT * FROM tb_dept ORDER BY dept_id asc" or die("Error:" . mysqli_error($con));
$result2 = mysqli_query($con, $query2);
?>
<script type="text/javascript">
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
<?php
if (@$_GET['do'] == 'f') {
  echo '<script type="text/javascript">
            swal("", "กรุณาใส่ข้อมูลให้ถูกต้อง !!", "warning");
            </script>';
  echo '<meta http-equiv="refresh" content="2;url=employee.php?act=add" />';
} elseif (@$_GET['do'] == 'd') {
  echo '<script type="text/javascript">
            swal("", "รหัสพนักงานซ้ำ กรุณาเปลี่ยน  !!", "error");
            </script>';
  echo '<meta http-equiv="refresh" content="1;url=employee.php?act=add" />';
}
?>
<div align="right">
  <font color="red">*</font>
  <font color="gray">Required Fields</font>
</div>
<hr>
<form action="employee_form_add_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
    <div class="col-sm-2 control-label">
      รหัส : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="number" name="emp_id" required class="form-control">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ชื่อ-นามสกุล : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="text" name="employee_name" required class="form-control">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      เลขที่บัญชี : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="text" name="Accountnumber" required class="form-control" maxlength="10">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      แผนก : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <select class="form-control" name="name_dept" id="dept">
        <option value="" selected disabled>-กรุณาเลือกแผนก-</option>
        <?php foreach ($result2 as $value) { ?>
          <option value="<?= $value['dept_id'] ?>"><?= $value['name_dept'] ?></option>
        <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ตำแหน่ง : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <select class="form-control" name="name_position" id="position">
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      เงินเดือน : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="number" name="Salary" required class="form-control" value="0">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      เบี้ยเลี้ยง : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="number" name="Allowance" required class="form-control" value="0">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ค่าตำแหน่ง : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="number" name="Position" required class="form-control" value="0">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ค่าเช่าบ้าน : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="number" name="House" required class="form-control" value="0">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ค่าโทรศัพท์ : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="number" name="Phone" required class="form-control" value="0">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      เบี้ยขยัน : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="number" name="Diligent" required class="form-control" value="0">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ค่าน้ำมัน : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="number" name="Oil" required class="form-control" value="0">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      โบนัส : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="Bonus" name="Oil" required class="form-control" value="0">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      เงินได้อื่นๆ : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="number" name="Income" required class="form-control" value="0">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ค่าทำงานล่วงเวลา : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="decimal" name="Overtime" required class="form-control" value="0">
    </div>
  </div>
  <hr>
  <div class="form-group">
    <div class="col-sm-6">
      <input type="hidden" name="username" required class="form-control" value="<?php echo $username; ?>" readonly>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
      <button type="submit" class="btn btn-success">บันทึก</button>
      <a href="employee.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>
<?php include('employeescriptselect.php'); ?>