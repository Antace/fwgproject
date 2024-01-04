<?php

$query3 = "SELECT * FROM tb_department ORDER BY department_id asc" or die("Error:" . mysqli_error($con));
$result3 = mysqli_query($con, $query3);

?>

<div align="right">
  <font color="red">*</font>
  <font color="gray">Required Fields</font>
</div>
<hr>
<form action="label_form_add_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
    <div class="form-group">
      <div class="col-sm-2 control-label">
        ชื่อรายการ : <font color="red">*</font>
      </div>
      <div class="col-sm-6">
        <input type="text" name="label_name" required class="form-control">
      </div>
    </div>

    <div class="form-group">
    <div class="col-sm-2 control-label">
       รายละเอียด :
    </div>
    <div class="col-sm-9">
    <textarea name="label_detail" cols="60"  class="form-control"></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
       ราคา : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="decimal" name="label_price" required class="form-control" minlength="2" value="0.00"> 
    </div>
  </div>
    
  
    <div class="form-group">
      <div class="col-sm-2 control-label">
      อัพโหลดรูปภาพด้านหน้า : <font color="red">*</font>
      </div>
      <div class="custom-file col-sm-6">
        <font color="red">*อัพโหลดได้เฉพาะรูปภาพเท่านั้น </font>
        <input type="file" class="form-control" id="file" name="label_pic1" accept="image/*" onchange="readURL(this)" required>
        
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label">
      รูปภาพด้านหน้า :
      </div>
      <div class="col-sm-3">
      <div id="imgControl" class="d-none">
        <img id="imgUpload" class="img-fluid my-3">
      </div>
      </div>
    </div>
    
    <hr>
    <div class="form-group">
      <div class="col-sm-2 control-label">
      อัพโหลดรูปภาพด้านหลัง : <font color="red">*</font>
      </div>
      <div class="custom-file col-sm-6">
        <font color="red">*อัพโหลดได้เฉพาะรูปภาพเท่านั้น </font>
        <input type="file" class="form-control" id="file" name="label_pic2" accept="image/*" onchange="readURL1(this)" required>
        
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label">
      รูปภาพด้านหลัง :
      </div>
      <div class="col-sm-3">
      <div id="imgControl1" class="d-none">
        <img id="imgUpload1" class="img-fluid my-3">
      </div>
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
        <button type="submit" name="submit" class="btn btn-success">บันทึก</button>
        <a href="label.php" class="btn btn-danger">ยกเลิก</a>
      </div>
    </div>
  </div>
</form>

<script>
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
    </script>
    <script>
        function readURL1(input){
            if(input.files[0]){
                let reader = new FileReader();
                document.querySelector('#imgControl1').classList.replace("d-none", "d-block");
                reader.onload = function (e) {
                    let element = document.querySelector('#imgUpload1');
                    element.setAttribute("src", e.target.result);
                }  
                reader.readAsDataURL(input.files[0]);
            }         
        }
    </script>

