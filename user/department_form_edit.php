<?php 
$ID = mysqli_real_escape_string($con,$_GET['ID']);
$sql = "SELECT * FROM tb_department WHERE department_id=$ID";
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
$row = mysqli_fetch_array($result);
?>
<form action="department_form_edit_db.php" method="post" class="form-horizontal">
  <div class="form-group">
    <div class="col-sm-2 control-label">
      รหัสโครงการ/หน่วยงาน :
    </div>
    <div class="col-sm-3">
      <input type="text" name="dept_name" required class="form-control" value="<?php echo $row['dept_name'];?>">
    </div> 
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ชื่อโครงการ/หน่วยงาน :
    </div>
    <div class="col-sm-3">
      <input type="text" name="department_name" required class="form-control" value="<?php echo $row['department_name'];?>">
    </div>
  </div>
    <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
      <input type="hidden" name="department_id" value="<?php echo $ID; ?>" />
      <button type="submit" class="btn btn-success">แก้ไขข้อมูล</button>
      <a href="department.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>