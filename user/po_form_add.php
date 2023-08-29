<?php
$query2 = "SELECT * FROM tb_customer ORDER BY customer_id asc" or die("Error:" . mysqli_error());
$result2 = mysqli_query($con, $query2);
$query3 = "SELECT * FROM tb_department ORDER BY department_id asc" or die("Error:" . mysqli_error());
$result3 = mysqli_query($con, $query3);
$query4 = "SELECT * FROM tb_category ORDER BY category_id asc" or die("Error:" . mysqli_error());
$result4 = mysqli_query($con, $query4);
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
<?php
if(@$_GET['do']=='f'){
echo '<script type="text/javascript">
swal("", "กรุณาใส่ข้อมูลให้ถูกต้อง !!", "warning");
</script>';
echo '<meta http-equiv="refresh" content="2;url=po.php?act=add" />';
}elseif(@$_GET['do']=='d'){
echo '<script type="text/javascript">
swal("", "เลขใบสั่งซื้อซ้ำ กรุณาเปลี่ยน  !!", "error");
</script>';
echo '<meta http-equiv="refresh" content="1;url=po.php?act=add" />';
}
?>
<form action="po_form_add_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
    <div class="form-group">
      <div class="col-sm-2 control-label">
        เลขที่ PO :
      </div>
      <div class="col-sm-6">
        <input type="text" name="po_name" required class="form-control">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label">
        วันที่ :
      </div>
      <div class="col-sm-2">
        <input type="date" name="po_date" required class="form-control">
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        บริษัท:
        <select class="select2" multiple="multiple" data-placeholder="บริษัท" name ="customer_name" style="width: 100%;" required>
          <?php foreach($result2 as $results){?>
          <option value="<?php echo $results["customer_name"];?>">
            <?php echo $results["customer_name"]; ?>
          </option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        โครงการ:
        <select class="select2" multiple="multiple" data-placeholder="โครงการ" name ="department_name" style="width: 100%;" required>
          <?php foreach($result3 as $results){?>
          <option value="<?php echo $results["department_name"];?>">
            <?php echo $results["department_name"]; ?>
          </option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        ประเภทงาน:
        <select class="select2" multiple="multiple" data-placeholder="ประเภทงาน" name ="category_name" style="width: 100%;"  required>
          <?php foreach($result4 as $results){?>
          <option value="<?php echo $results["category_name"];?>">
            <?php echo $results["category_name"]; ?>
          </option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label">
        งานของ :
      </div>
      <div class="col-sm-6">
        <select class="select2" multiple="multiple" data-placeholder="งานของ" name ="work_by" style="width: 100%;"  required>
          <option value="">งานของ</option>
          <option value="LH">LH</option>
          <option value="SANSIRI">SANSIRI</option>
          <option value="QHOUSE">QHOUSE</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label">
        แปลง :
      </div>
      <div class="col-sm-6">
        <input type="text" name="po_place" required class="form-control">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label">
        ราคา :
      </div>
      <div class="col-sm-6">
        <input type="number" name="po_price" required class="form-control">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label">
        ไฟล์ :
      </div>
      <div class="col-sm-6">
        <font color="red">*อัพโหลดได้เฉพาะ .pdf เท่านั้น </font>
        <input type="file" name="po_file"    class="form-control" accept="application/pdf" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label">
        ผู้บันทึก :
      </div>
      <div class="col-sm-6">
        <input type="text" name="username" required class="form-control" value="<?php echo $username; ?>" readonly >
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2">
      </div>
      <div class="col-sm-3">
        <button type="submit" class="btn btn-success">เพิ่มข้อมูล</button>
        <a href="po.php" class="btn btn-danger">ยกเลิก</a>
      </div>
    </div>
  </div>
</form>