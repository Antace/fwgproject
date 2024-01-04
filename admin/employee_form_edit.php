<?php
$ID = mysqli_real_escape_string($con, $_GET['ID']);
$sql = "SELECT * FROM tb_employees as e
INNER JOIN tb_dept as d ON e.name_dept = d.dept_id
INNER JOIN tb_position as p ON e.name_position = p.position_id
WHERE employee_id=$ID
ORDER BY employee_id DESC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
$row = mysqli_fetch_array($result);
$query2 = "SELECT * FROM tb_dept ORDER BY dept_id asc" or die("Error:" . mysqli_error($con));
$result2 = mysqli_query($con, $query2);

?>
<div align="right">
  <font color="red">*</font>
  <font color="gray">Required Fields</font>
</div>
<hr>
<form action="employee_form_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
    <div class="col-sm-2 control-label">
      รหัสพนักงาน : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="number" name="emp_id" required class="form-control" value="<?php echo $row['emp_id']; ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ชื่อ-นามสกุล : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="text" name="employee_name" required class="form-control" value="<?php echo $row['employee_name']; ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      เลขที่บัญชี : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="text" name="Accountnumber" required class="form-control" maxlength="10" value="<?php echo $row['Accountnumber']; ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      แผนก : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <select class="form-control" name="name_dept" id="dept">
        <option value="<?php echo $row['dept_id']; ?>"><?php echo $row['name_dept']; ?></option>
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
        <option value="<?php echo $row['position_id']; ?>"><?php echo $row['name_position']; ?></option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      เงินเดือน : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="number" name="Salary" required class="form-control" value="<?php echo $row['Salary']; ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      เบี้ยเลี้ยง : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="number" name="Allowance" required class="form-control" value="<?php echo $row['Allowance']; ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ค่าตำแหน่ง : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="number" name="Position" required class="form-control" value="<?php echo $row['Position']; ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ค่าเช่าบ้าน : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="number" name="House" required class="form-control" value="<?php echo $row['House']; ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ค่าโทรศัพท์ : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="number" name="Phone" required class="form-control" value="<?php echo $row['Phone']; ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      เบี้ยขยัน : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="number" name="Diligent" required class="form-control" value="<?php echo $row['Diligent']; ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ค่าน้ำมัน : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="number" name="Oil" required class="form-control" value="<?php echo $row['Oil']; ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      โบนัส : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="number" name="Bonus" required class="form-control" value="<?php echo $row['Bonus']; ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      เงินได้อื่นๆ : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="number" name="Income" required class="form-control" value="<?php echo $row['Income']; ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ค่าทำงานล่วงเวลา : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="decimal" name="Overtime" required class="form-control" value="<?php echo $row['Overtime']; ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-6">
      <input type="hidden" name="username" required class="form-control" value="<?php echo $username; ?>" readonly>
    </div>
  </div>
  <hr>

  <div class="form-group">
    <div class="col-sm-12">
      <font color="gray">บันทึกข้อมูลล่าสุด : <?php echo $row['employee_dt']; ?> ผู้บันทึก : <?php echo $row['username']; ?> </font>
    </div>
  </div>
  <hr>



  <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">

      <input type="hidden" name="employee_id" value="<?php echo $ID; ?>" />
      <button type="submit" class="btn btn-success">บันทึก</button>
      <a href="employee.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>
<?php include('employeescriptselect.php'); ?>