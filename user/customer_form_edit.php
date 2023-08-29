<?php 
$ID = mysqli_real_escape_string($con,$_GET['ID']);
$sql = "SELECT * FROM tb_customer WHERE customer_id=$ID";
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
$row = mysqli_fetch_array($result);
?>
<script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
<form action="customer_form_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ชื่อบริษัท :
    </div>
    <div class="col-sm-3">
      <input type="text" name="customer_name" required class="form-control" autocomplete="off" minlength="2" value="<?php echo $row['customer_name'];?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ที่อยู่ :
    </div>
    <div class="col-sm-3">
      <textarea name="customer_address" cols="60"><?php echo $row['customer_address'];?></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      สาขา :
    </div>
    <div class="col-sm-3"> 
      <input type="text" name="customer_branch" required class="form-control" value="<?php echo $row['customer_branch'];?>">
    </div>
  </div>
   <div class="form-group">
    <div class="col-sm-2 control-label">
      เลขประจำตัวผู้เสียภาษี :
    </div>
    <div class="col-sm-3">
      <input type="text" name="customer_tax" required class="form-control" value="<?php echo $row['customer_tax'];?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      เบอร์โทร :
    </div>
    <div class="col-sm-3">
      <input type="text" name="customer_tel" required class="form-control" value="<?php echo $row['customer_tel'];?>">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
      <input type="hidden" name="customer_id" value="<?php echo $ID; ?>" />
      <button type="submit" class="btn btn-success">แก้ไขข้อมูล</button>
      <a href="customer.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>