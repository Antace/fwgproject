<?php 
$ID = mysqli_real_escape_string($con,$_GET['ID']);
$sql = "SELECT * FROM tb_po
WHERE po_id=$ID
ORDER BY po_id DESC" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
$row = mysqli_fetch_array($result);


$sql2 = "SELECT * FROM tb_category 
ORDER BY category_id DESC" or die("Error:" . mysqli_error());
$result_t = mysqli_query($con, $sql2) or die ("Error in query: $sql " . mysqli_error());


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


<form action="db_form_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
  <div class="form-group">
    <div class="col-sm-2 control-label">
      เลขที่ใบสั่งซื้อ :
    </div>
    <div class="col-sm-3">
      <input type="text" name="po_name" required class="form-control" value="<?php echo $row['po_name'];?>" readonly >
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      เลขที่ใบส่งของ :
    </div>
    <div class="col-sm-3">
      <input type="text" name="db_name" required class="form-control" value="<?php echo $row['db_name'];?>">
    </div>
  </div>
  <div class="form-group">
      <div class="col-sm-2 control-label">
        วันที่ทำรายการ :
      </div>
      <div class="col-sm-3">
        <input type="date" name="db_date" required class="form-control" value="<?php echo $row['db_date'];?>">
      </div>
    </div>
  <div class="form-group">
      <div class="col-sm-2 control-label">
        อัปโหลดใบส่งของ :
      </div>
      <div class="col-sm-3">
        <a href="../db_file/<?php echo $row['db_file'];?>" target="_blank" class="btn btn-info btn-sm"> เปิดดู </a>
        <font color="red">*อัพโหลดได้เฉพาะ .pdf เท่านั้น </font>
        <input type="file" name="db_file"    class="form-control" accept="application/pdf" value="<?php echo $row['db_file'];?>">
      </div>
    </div>
  <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
      <input type="hidden" name="db_file2" value="<?php echo $row['db_file'];?>">
      <input type="hidden" name="po_id" value="<?php echo $ID; ?>" />
      <button type="submit" class="btn btn-success">แก้ไขข้อมูล</button>
      <a href="po.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>