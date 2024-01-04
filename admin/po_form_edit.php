<?php
$ID = mysqli_real_escape_string($con,$_GET['ID']);
$sql = "SELECT * FROM tb_po
WHERE po_id=$ID
ORDER BY po_id DESC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
$row = mysqli_fetch_array($result);
$query2 = "SELECT * FROM tb_customer ORDER BY customer_id asc" or die("Error:" . mysqli_error($con));
$result2 = mysqli_query($con, $query2);
$query3 = "SELECT * FROM tb_department ORDER BY department_id asc" or die("Error:" . mysqli_error($con));
$result3 = mysqli_query($con, $query3);
?>
<div align="right">
  <font color="red">*</font>
  <font color="gray">Required Fields</font>
</div>
<hr>
<form action="po_form_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
    <div class="form-group">
      <div class="col-sm-2 control-label">
        เลขที่ใบสั่งซื้อ : <font color="red">*</font>
      </div>
      <div class="col-sm-6">
        <input type="text" name="po_name" required class="form-control" value="<?php echo $row['po_name'];?>">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label">
        วันที่ : <font color="red">*</font>
      </div>
      <div class="col-sm-2">
        <input type="date" name="po_date" required class="form-control" value="<?php echo $row['po_date'];?>">
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        บริษัท : <font color="red">*</font>
        <select class="select2bs4"  name ="customer_name" style="width: 100%;" required >
        <option selected value="<?php echo $row["customer_name"];?>">
            <?php echo $row["customer_name"]; ?>
          </option>
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
        โครงการ : <font color="red">*</font>
        <select class="select2bs4"  name ="department_name" style="width: 100%;" required >
        <option selected value="<?php echo $row["department_name"];?>">
            <?php echo $row["department_name"]; ?>
          </option>
          <?php foreach($result3 as $results){?>
          <option value="<?php echo $results["department_name"];?>">
            <?php echo $results["department_name"]; ?>
          </option>
          <?php } ?>
        </select>
      </div>
    </div>
    
    <div class="form-group">
      <div class="col-sm-2 control-label">
        งานของ : <font color="red">*</font>
      </div>
      <div class="col-sm-6">
        <select class="select2bs4"  data-placeholder="งานของ" name ="work_by" style="width: 100%;"  required>
          <option selected value="<?php echo $row['work_by'];?>"><?php echo $row ['work_by'];?></option>
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
        <input type="text" name="po_place" required class="form-control" value="<?php echo $row['po_place'];?>">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label">
        ราคา : <font color="red">*</font>
      </div>
      <div class="col-sm-6">
        <input type="double" name="po_price" required class="form-control" value="<?php echo $row['po_price'];?>">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label">
        ไฟล์ : <font color="red">*</font>
      </div>
      <div class="custom-file col-sm-6">
        <font color="red">*อัพโหลดได้เฉพาะไฟล์รูปและPDFเท่านั้น </font>
        <!-- <input type="file" class="form-control" id="file" name="po_file" accept="image/application/PDF*" onchange="readURL(this)" value="<?php echo $row['po_file'];?>" > -->
        <input type="file" class="custom-file-input" id="exampleInputFile" name="po_file"  value="<?php echo $row['po_file'];?>" required>
        <label class="custom-file-label" for="customFile">Choose file</label>
      </div>
    </div>
    <!-- <div class="form-group">
      <div class="col-sm-2 control-label">
        รูปเดิม :<br>
      <img src="../po_file/<?php echo $row['po_file'];?>" width="200px">
      <br>
      </div>
      <div class="col-sm-3">
        รูปใหม่ :
      <div id="imgControl" class="d-none">
        <img id="imgUpload" class="img-fluid my-3">
      </div>
      </div>
    </div> -->
    <hr>

    <div class="form-group">
      <div class="col-sm-2">
      </div>
      <div class="col-sm-3">
        <input type="hidden" name="po_file2" value="<?php echo $row['po_file'];?>">
        <input type="hidden" name="po_id" value="<?php echo $ID; ?>" />
        <button type="submit" name="submit" class="btn btn-success">บันทึก</button>
        <a href="po.php" class="btn btn-danger">ยกเลิก</a>
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