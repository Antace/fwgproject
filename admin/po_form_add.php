<?php
$query2 = "SELECT * FROM tb_customer ORDER BY customer_id asc" or die("Error:" . mysqli_error());
$result2 = mysqli_query($con, $query2);
$query3 = "SELECT * FROM tb_department ORDER BY department_id asc" or die("Error:" . mysqli_error());
$result3 = mysqli_query($con, $query3);

?>
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
<div align="right">
  <font color="red">*</font>
  <font color="gray">Required Fields</font>
</div>
<hr>
<form action="po_form_add_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
    <div class="form-group">
      <div class="col-sm-2 control-label">
        เลขที่ PO : <font color="red">*</font>
      </div>
      <div class="col-sm-6">
        <input type="text" name="po_name" required class="form-control">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label">
        วันที่ : <font color="red">*</font>
      </div>
      <div class="col-sm-2">
        <input type="date" name="po_date" required class="form-control">
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        บริษัท : <font color="red">*</font>
        <select class="select2bs4"  data-placeholder="บริษัท" name ="customer_name" style="width: 100%;" required>
        <option value="">-</option>
          <?php foreach($result2 as $results){?>
          <option value="<?php echo $results["customer_name"];?>">
            <?php echo $results["customer_name"]; ?>
          </option>
          <?php } ?>
        </select><a href="customer.php?act=add" >เพิ่มบริษัท</a>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        โครงการ : <font color="red">*</font>
        <select class="select2bs4"  data-placeholder="โครงการ" name ="department_name" style="width: 100%;" required>
        <option value="">-</option>
          <?php foreach($result3 as $results){?>
          <option value="<?php echo $results["department_name"];?>">
            <?php echo $results["department_name"]; ?>
          </option>
          <?php } ?>
        </select><a href="department.php?act=add" >เพิ่มโครงการ</a>
      </div>
    </div>
    
    <div class="form-group">
      <div class="col-sm-2 control-label">
        งานของ : <font color="red">*</font>
      </div>
      <div class="col-sm-6">
        <select class="select2bs4"  data-placeholder="งานของ" name ="work_by" style="width: 100%;"  required>
        <option value="">-</option>
          <option value="ไม่ระบุ">ไม่ระบุ</option>
          <option value="LH">LH</option>
          <option value="SANSIRI">SANSIRI</option>
          <option value="QHOUSE">QHOUSE</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label">
        แปลง : <font color="red">*</font>
      </div>
      <div class="col-sm-6">
        <input type="text" name="po_place" required class="form-control">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label">
        ราคา : <font color="red">*</font>
      </div>
      <div class="col-sm-6">
        <input type="decimal"  name="po_price" required class="form-control">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label">
        ไฟล์ : <font color="red">*</font>
      </div>
      <div class="custom-file col-sm-6">
        <font color="red">*อัพโหลดได้เฉพาะไฟล์รูปและPDFเท่านั้น </font>
        <input type="file" class="form-control" id="file" name="po_file" accept="image/application/PDF*" onchange="readURL(this)" required>
        
      </div>
    </div>
    <!-- <div class="form-group">
      <div class="col-sm-2 control-label">
        รูป :
      </div>
      <div class="col-sm-3">
      <div id="imgControl" class="d-none">
        <img id="imgUpload" class="img-fluid my-3">
      </div>
      </div>
    </div> -->
    
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
        <button type="submit" name="submit" class="btn btn-success">เพิ่มข้อมูล</button>
        <a href="po.php" class="btn btn-danger">ยกเลิก</a>
      </div>
    </div>
  </div>
</form>

<!-- <script>
        function readURL(input){
            if(input.files[0]){
                let reader = new FileReader();
                document.querySelector('#imgControl').classList.replace("d-none", "d-block");
                reader.onload = function (e) {
                    let element = document.querySelector('#imgUpload');
                    element.setAttribute("src", e.target.result);
                }  
                reader.readAsDataURL(input.files[0]);
            }         
        }
    </script> -->