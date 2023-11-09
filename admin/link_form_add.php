
<?php
if (@$_GET['do'] == 'f') {
  echo '<script type="text/javascript">
            swal("", "กรุณาใส่ข้อมูลให้ถูกต้อง !!", "warning");
            </script>';
  echo '<meta http-equiv="refresh" content="2;url=link.php?act=add" />';
} elseif (@$_GET['do'] == 'd') {
  echo '<script type="text/javascript">
            swal("", "ชื่อบริษัทซ้ำ กรุณาเปลี่ยน  !!", "error");
            </script>';
  echo '<meta http-equiv="refresh" content="1;url=link.php?act=add" />';
}


?>

<div align="right">
  <font color="red">*</font>
  <font color="gray">Required Fields</font>
</div>
<hr>
<form action="link_form_add_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
    <div class="col-sm-9 control-label">
      อีเมล์/เว็บไซต์ : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="text" name="link_name" required class="form-control" autocomplete="off" minlength="2">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label" class="form-control">
      รหัสผ่าน : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="text" name="link_pass" required class="form-control" autocomplete="off" minlength="2">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label">
      หมายเหตุ : 
    </div>
    <div class="col-sm-3">
    <textarea name="link_detail" cols="60"  class="form-control"></textarea>
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
      <button type="submit" class="btn btn-success">เพิ่มข้อมูล</button>
      <a href="link.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>