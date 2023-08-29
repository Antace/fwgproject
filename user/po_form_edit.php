<?php
$ID = mysqli_real_escape_string($con,$_GET['ID']);
$sql = "SELECT * FROM tb_po
WHERE po_id=$ID
ORDER BY po_id DESC" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
$row = mysqli_fetch_array($result);
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
<form action="po_form_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
    <div class="form-group">
      <div class="col-sm-2 control-label">
        เลขที่ใบสั่งซื้อ :
      </div>
      <div class="col-sm-6">
        <input type="text" name="po_name" required class="form-control" value="<?php echo $row['po_name'];?>">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label">
        วันที่ :
      </div>
      <div class="col-sm-2">
        <input type="date" name="po_date" required class="form-control" value="<?php echo $row['po_date'];?>">
      </div>
    </div>
    <div class="col-6">
      <div class="form-group">
        บริษัท:
        <select class="select2"   name ="customer_name" style="width: 100%;" required >
          <?php foreach($result2 as $results){?>
          <option value="<?php echo $results["customer_name"];?>">
            <?php echo $results["customer_name"]; ?>
          </option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-6">
      <div class="form-group">
        โครงการ:
        <select class="select2"   name ="department_name" style="width: 100%;" required >
          <?php foreach($result3 as $results){?>
          <option value="<?php echo $results["department_name"];?>">
            <?php echo $results["department_name"]; ?>
          </option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-6">
      <div class="form-group">
        ประเภทงาน:
        <select class="select2"   name ="category_name" style="width: 100%;" required >
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
        <select class="select2" data-placeholder="งานของ" name ="work_by" style="width: 100%;"  required>
          <option value="<?php echo $row['work_by'];?>"><?php echo $row ['work_by'];?></option>
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
        <input type="text" name="po_place" required class="form-control" value="<?php echo $row['po_place'];?>">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label">
        ราคา :
      </div>
      <div class="col-sm-6">
        <input type="number" name="po_price" required class="form-control" value="<?php echo $row['po_price'];?>">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label">
        ชื่อเอกสาร :
      </div>
      <div class="col-sm-6">
        <a href="../po_file/<?php echo $row['po_file'];?>" target="_blank" class="btn btn-info btn-sm"> เปิดดู </a>
        <font color="red">*อัพโหลดได้เฉพาะ .pdf เท่านั้น </font>
        <input type="file" name="po_file"    class="form-control" accept="application/pdf" value="<?php echo $row['po_file'];?>">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2">
      </div>
      <div class="col-sm-3">
        <input type="hidden" name="po_file2" value="<?php echo $row['po_file'];?>">
        <input type="hidden" name="po_id" value="<?php echo $ID; ?>" />
        <button type="submit" class="btn btn-success">แก้ไขข้อมูล</button>
        <a href="po.php" class="btn btn-danger">ยกเลิก</a>
      </div>
    </div>
  </form>