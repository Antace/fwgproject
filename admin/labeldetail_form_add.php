<?php
$query3 = "SELECT * FROM tb_department ORDER BY department_id asc" or die("Error:" . mysqli_error($con));
$result3 = mysqli_query($con, $query3);
?>
<div align="right">
  <font color="red">*</font>
  <font color="gray">Required Fields</font>
</div>
<hr>
<form action="labeldetail_form_add_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
    <div class="col-sm-2 control-label">
      แปลง : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="text" name="label_place" required class="form-control" autocomplete="off"  minlength="2">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label" >
      เลขที่บ้าน : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="text" name="label_numberid" required class="form-control" autocomplete="off"  minlength="2">
    </div>
  </div>
  <div class="col-sm-6">
      <div class="form-group">
        โครงการ : <font color="red">*</font>
        <select class="select2bs4"  data-placeholder="โครงการ" name ="department_name" style="width: 100%;" required>
        <option value="">-</option>
          <?php foreach($result3 as $results){?>
          <option value="<?php echo $results["department_name"];?>">
            <?php echo $results["department_name"]; ?>
          </option>
          <?php } ?>
        </select>
      </div>
    </div>
  <div class="form-group">
    <div class="col-sm-3 control-label">
      สถานะการสั่ง : <font color="red">*</font> <font color = "blue">[สั่งแล้ว = 1</font> , <font color = "red">ไม่ได้สั่ง = 0]</font>
    </div> 
    <div class="col-sm-3">
      <input type="number" name="label_orderstatus" value = "0" required class="form-control"> 
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label">
      สถานะการจัดส่ง : <font color="red">*</font> <font color = "blue">[ส่งแล้ว = 1</font> , <font color = "red">ไม่ได้ส่ง = 0]</font>
    </div>
    <div class="col-sm-3">
      <input type="number" name="status_send" value = "0" required class="form-control" size="10">
    </div>
  </div>
  <hr>
  <div class="form-group">
      <div class="col-sm-6">
        <input type="hidden" name="username" required class="form-control" value="<?php echo $username; ?>" readonly >
      </div>
    </div>
  <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
      <button type="submit" class="btn btn-success">บันทึก</button>
      <a href="labeldetail.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>