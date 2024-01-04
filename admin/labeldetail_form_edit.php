<?php 
$ID = mysqli_real_escape_string($con,$_GET['ID']);
$sql = "SELECT * FROM tb_labeldetail WHERE label_ida=$ID";
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
$row = mysqli_fetch_array($result);
$query3 = "SELECT * FROM tb_department ORDER BY department_id asc" or die("Error:" . mysqli_error($con));
$result3 = mysqli_query($con, $query3);
// print_r($row);
?>
<div align="right">
  <font color="red">*</font>
  <font color="gray">Required Fields</font>
</div>
<hr>
<form action="labeldetail_form_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
<div class="form-group">
    <div class="col-sm-2 control-label">
      แปลง : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="text" name="label_place" required class="form-control" autocomplete="off"  minlength="2" value="<?php echo $row['label_place'];?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label" >
      เลขที่บ้าน : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="text" name="label_numberid" required class="form-control" autocomplete="off"  minlength="2" value="<?php echo $row['label_numberid'];?>">
    </div>
  </div>
  <div class="col-sm-6">
      <div class="form-group">
        โครงการ : <font color="red">*</font>
        <select class="select2bs4"  data-placeholder="โครงการ" name ="department_name" style="width: 100%;" required>
        <option value="<?php echo $row['department_name'];?>"><?php echo $row['department_name'];?></option>
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
      <input type="number" name="label_orderstatus"  required class="form-control" value="<?php echo $row['label_orderstatus'];?>"> 
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label">
      สถานะการจัดส่ง : <font color="red">*</font> <font color = "blue">[ส่งแล้ว = 1</font> , <font color = "red">ไม่ได้ส่ง = 0]</font>
    </div>
    <div class="col-sm-3">
      <input type="number" name="status_send"  required class="form-control" size="10" value="<?php echo $row['status_send'];?>">
    </div>
  </div>
  <hr>
  <div class="form-group">
      <div class="col-sm-6">
        <input type="hidden" name="username" required class="form-control" value="<?php echo $username; ?>" readonly >
      </div>
    </div>
  

  <div class="form-group">
    <div class="col-sm-12">
     <font color ="gray">บันทึกข้อมูลล่าสุด : <?php echo $row['labeldetail_dt']; ?> ผู้บันทึก : <?php echo $row ['username']; ?> </font> 
    </div>
  </div>
  <hr>
  <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
      <input type="hidden" name="label_ida" value="<?php echo $ID; ?>" />
      <button type="submit" class="btn btn-success">บันทึก</button>
      <a href="labeldetail.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>