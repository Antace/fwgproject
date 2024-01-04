<?php 
 if(@$_GET['do']=='f'){
            echo '<script type="text/javascript">
            swal("", "กรุณาใส่ข้อมูลให้ถูกต้อง !!", "warning");
            </script>';
            echo '<meta http-equiv="refresh" content="2;url=contractor.php?act=add" />';
 }elseif(@$_GET['do']=='d'){
            echo '<script type="text/javascript">
            swal("", "ข้อมูล username ซ้ำ กรุณาเปลี่ยน  !!", "error");
            </script>';
            echo '<meta http-equiv="refresh" content="1;url=contractor.php?act=add" />';

 }
 ?>
<div align="right">
  <font color="red">*</font>
  <font color="gray">Required Fields</font>
</div>
<hr>
<form action="contractor_form_add_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ชื่อ-นามสกุล : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="text" name="contractor_name" required class="form-control" autocomplete="off" minlength="2">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label" >
      ชื่อเล่น : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="text" name="contractor_nickname" required class="form-control" autocomplete="off" minlength="2" >
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label">
      เลขบัตรประจำตัวประชาชน : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input name="contractor_nid" type="text" onkeyup="autoTab(this)" size="15" required class="form-control">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label">
    สำเนาบัตรประชาชน : <font color="red">*อัพโหลดได้เฉพาะไฟล์PDFเท่านั้น </font>
    </div>
    <div class="col-sm-3">
    <input type="file" class="form-control" id="file" name="contractor_file" accept="application/pdf" required>
      
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label">
    วันหมดอายุ : <font color="red">* </font>
    </div>
    <div class="col-sm-3">
    <input type="date" name="contractor_expired" required class="form-control">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label">
      ที่อยู่ : <font color="red">*</font>
    </div>
    <div class="col-sm-6">
      <textarea name = "contractor_address" require class="form-control"></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label">
      ธนาคาร : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <select name ="contractor_bank" require class="select2bs4" style="width: 100%;">
        <option value="">-</option>
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
      <input name="account_number" type="text" required class="form-control">
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
      <a href="contractor.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>