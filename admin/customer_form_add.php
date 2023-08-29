
<?php
if (@$_GET['do'] == 'f') {
  echo '<script type="text/javascript">
            swal("", "กรุณาใส่ข้อมูลให้ถูกต้อง !!", "warning");
            </script>';
  echo '<meta http-equiv="refresh" content="2;url=customer.php?act=add" />';
} elseif (@$_GET['do'] == 'd') {
  echo '<script type="text/javascript">
            swal("", "ชื่อบริษัทซ้ำ กรุณาเปลี่ยน  !!", "error");
            </script>';
  echo '<meta http-equiv="refresh" content="1;url=customer.php?act=add" />';
}


?>

<div align="right">
  <font color="red">*</font>
  <font color="gray">Required Fields</font>
</div>
<hr>
<form action="customer_form_add_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
    <div class="col-sm-9 control-label">
      ชื่อลูกค้า : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="text" name="customer_name" required class="form-control" autocomplete="off" minlength="2">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label" class="form-control">
      ที่อยู่ : <font color="red">*</font>
    </div>
    <div class="col-sm-12">
      <textarea name="customer_address" cols="60" required class="form-control"></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label">
      สาขา : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="text" name="customer_branch" required class="form-control">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label">
      เลขประจำตัวผู้เสียภาษี : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input name="customer_tax" type="text" onkeyup="autoTab(this)" size="17" required class="form-control">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label">
      ประเภท : <font color="red">*</font>
    </div>
    <div class="col-sm-6">
      <select class="select2" multiple="multiple" data-placeholder="ประเภท" name="customer_type" style="width: 100%;" required>
        <option value="">ประเภท</option>
        <option value="นิติบุคคล">นิติบุคคล</option>
        <option value="บุคคลธรรมดา">บุคคลธรรมดา</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label">
      เครดิต : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="number" name="customer_credit"  required class="form-control" value="0">
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
      <a href="customer.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>