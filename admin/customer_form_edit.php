<?php
$ID = mysqli_real_escape_string($con, $_GET['ID']);
$sql = "SELECT * FROM tb_customer WHERE customer_id=$ID";
$result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
$row = mysqli_fetch_array($result);
?>

<div align="right">
  <font color="red">*</font>
  <font color="gray">Required Fields</font>
</div>
<hr>
<form action="customer_form_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
    <div class="col-sm-9 control-label">
      ชื่อลูกค้า : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="text" name="customer_name" required class="form-control" autocomplete="off" minlength="2" value="<?php echo $row['customer_name']; ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label" class="form-control">
      ที่อยู่ : <font color="red">*</font>
    </div>
    <div class="col-sm-12">
      <textarea name="customer_address" cols="60" required class="form-control"><?php echo $row['customer_address']; ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label">
      สาขา : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="text" name="customer_branch" required class="form-control" value="<?php echo $row['customer_branch']; ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label">
      เลขประจำตัวผู้เสียภาษี : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input name="customer_tax" type="text" onkeyup="autoTab(this)" size="17" required class="form-control" value="<?php echo $row['customer_tax']; ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label">
      ประเภท : <font color="red">*</font>
    </div>
    <div class="col-sm-6">
      <select class="select2bs4" name="customer_type" style="width: 100%;" required>
      <option value="<?php echo $row['customer_type'];?>"><?php echo $row['customer_type'];?></option>
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
      <input type="number" name="customer_credit"  required class="form-control" value="<?php echo $row['customer_credit']; ?>">
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
     <font color ="gray">บันทึกข้อมูลล่าสุด : <?php echo $row['customer_dt']; ?> ผู้บันทึก : <?php echo $row ['username']; ?> </font> 
    </div>
  </div>
  <hr>
  <div class="form-group">
    <div class="col-sm-3">
    </div>
    <div class="col-sm-3">
      <input type="hidden" name="customer_id" value="<?php echo $ID; ?>" />
      <button type="submit" class="btn btn-success">บันทึก</button>
      <a href="customer.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>