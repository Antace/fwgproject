<?php 

$ID = mysqli_real_escape_string($con,$_GET['ID']);
$sql = "SELECT * FROM tb_expenses WHERE expenses_id=$ID";
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
$row = mysqli_fetch_array($result);
?>
<div align="right">
  <font color="red">*</font>
  <font color="gray">Required Fields</font>
</div>
<hr>
<form action="expenses_form_edit_db.php" method="post" class="form-horizontal">
  
  <div class="form-group">
    <div class="col-sm-3 control-label">
      รายการค่าใช้จ่าย : <font color="red">*</font>
    </div>
    <div class="col-sm-9">
      <input type="text" name="expenses_name" required class="form-control" value="<?php echo $row['expenses_name'];?>">
    </div>
  </div>
  <div class="form-group">
      <div class="col-sm-6">
        <input type="hidden" name="username" required class="form-control" value="<?php echo $username; ?>" readonly >
      </div>
    </div>
  <hr>

  <div class="form-group">
    <div class="col-sm-12">
     <font color ="gray">บันทึกข้อมูลล่าสุด : <?php echo $row['expenses_dt']; ?> ผู้บันทึก : <?php echo $row ['username']; ?> </font> 
    </div>
  </div>
  <hr>
    <div class="form-group">
    <div class="col-sm-3">
    </div>
    <div class="col-sm-3">
      <input type="hidden" name="expenses_id" value="<?php echo $ID; ?>" />
      <button type="submit" class="btn btn-success">แก้ไขข้อมูล</button>
      <a href="expenses.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>