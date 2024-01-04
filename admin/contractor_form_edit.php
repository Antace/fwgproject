<?php
$ID = mysqli_real_escape_string($con, $_GET['ID']);
$sql = "SELECT * FROM tb_contractor WHERE contractor_id=$ID";
$result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
$row = mysqli_fetch_array($result);
?>

<div align="right">
  <font color="red">*</font>
  <font color="gray">Required Fields</font>
</div>
<hr>
<form action="contractor_form_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
    <div class="col-sm-3 control-label">
      ชื่อ-นามสกุล : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="text" name="contractor_name" required class="form-control" autocomplete="off" minlength="2" value="<?php echo $row['contractor_name']; ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label">
      ชื่อเล่น : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
    <input type="text" name="contractor_nickname" required class="form-control" autocomplete="off" minlength="2" value="<?php echo $row['contractor_nickname']; ?>">
    </div>
  </div>
 
  <div class="form-group">
    <div class="col-sm-3 control-label">
    เลขบัตรประจำตัวประชาชน : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="text" name="contractor_nid" onkeyup="autoTab(this)" size="17" required class="form-control" value="<?php echo $row['contractor_nid']; ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label">
    สำเนาบัตรประชาชน : <font color="red">*อัพโหลดได้เฉพาะไฟล์PDFเท่านั้น </font>
    </div>
    <div class="col-sm-3">
    <input type="file" class="form-control" id="file" name="contractor_file" accept="application/pdf" value="<?php echo $row['contractor_file']; ?>" required>
      
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label">
    วันหมดอายุ : <font color="red">* </font>
    </div>
    <div class="col-sm-3">
    <input type="date" name="contractor_expired" value="<?php echo $row['contractor_expired']; ?>" required class="form-control">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label">
      ที่อยู่ : <font color="red">*</font>
    </div>
    <div class="col-sm-6">
      <textarea name = "contractor_address" require class="form-control"><?php echo $row['contractor_address'];?></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label">
      ธนาคาร : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <select name ="contractor_bank" require class="select2bs4" style="width: 100%;">
        <option value="<?php echo $row['contractor_bank'];?>"><?php echo $row['contractor_bank'];?></option>
        <option value="ไทยพาณิชย์">ไทยพาณิชย์</option>
        <option value="กสิกร">กสิกร</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label">
      เลขที่บัญชี : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input name="account_number" type="text" value = "<?php echo $row['account_number'];?>" required class="form-control">
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
     <font color ="gray">บันทึกข้อมูลล่าสุด : <?php echo $row['contractor_dt']; ?> ผู้บันทึก : <?php echo $row ['username']; ?> </font> 
    </div>
  </div>
  <hr>
  <div class="form-group">
    <div class="col-sm-3">
    </div>
    <div class="col-sm-3">
    <input type="hidden" name="contractor_file2" value="<?php echo $row['contractor_file'];?>">
      <input type="hidden" name="contractor_id" value="<?php echo $ID; ?>" />
      <button type="submit" class="btn btn-success">บันทึก</button>
      <a href="contractor.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>