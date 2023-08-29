<?php
$ID = mysqli_real_escape_string($con,$_GET['ID']);
$sql = "SELECT * FROM tb_label
WHERE label_id=$ID
ORDER BY label_id DESC" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
$row = mysqli_fetch_array($result);
?>
<div align="right">
  <font color="red">*</font>
  <font color="gray">Required Fields</font>
</div>
<hr>
<form action="label_form_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">

<div class="form-group">
    <div class="col-sm-2 control-label">
       ชื่อรายการ :
    </div>
    <div class="col-sm-9">
      <input type="text" name="label_name" required class="form-control" minlength="2" value="<?php echo $row['label_name']; ?>">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-2 control-label">
       รายละเอียด :
    </div>
    <div class="col-sm-9">
    <textarea name="label_detail" cols="60"  class="form-control"><?php echo $row['label_detail']; ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
       ราคา :
    </div>
    <div class="col-sm-3">
      <input type="decimal" name="label_price" required class="form-control" minlength="2" value="<?php echo $row['label_price']; ?>"> 
    </div>
  </div>
  <div class="form-group">
      <div class="col-sm-2 control-label">
      รูปภาพด้านหน้า(รูปเดิม) :<br>
      <img src="../label_img/<?php echo $row['label_pic1'];?>" width="200px">
      <br>
      </div>
      <hr>
      <div class="col-sm-3">
      รูปภาพด้านหน้า(รูปใหม่) :
      <div id="imgControl" class="d-none">
        <img id="imgUpload" class="img-fluid my-3" width="200px">
      </div>
      </div>
    </div>
    <hr>
  <div class="form-group">
      <div class="col-sm-2 control-label">
        อัพโหลดรูปภาพด้านหน้า :
      </div>
      <div class="col-sm-6">
        <font color="red">*อัพโหลดได้เฉพาะรูปภาพเท่านั้น </font>
        <input type="file" class="form-control" id="file" name="label_pic1" accept="image/*" onchange="readURL(this)" >
        <img id="blah" src="#" alt="" width="200px" class="img-rounded"/ style="margin-top: 10px;">
      </div>
    </div>
    

    <div class="form-group">
      <div class="col-sm-2 control-label">
        รูปภาพด้านหลัง(รูปเดิม) :<br>
      <img src="../label_img/<?php echo $row['label_pic2'];?>" width="200px">
      <br>
      </div>
      <hr>
      <div class="col-sm-3">
      รูปภาพด้านหลัง(รูปใหม่) :
      <div id="imgControl1" class="d-none">
        <img id="imgUpload1" class="img-fluid my-3" width="200px">
      </div>
      </div>
    </div>
    <hr>
    <div class="form-group">
      <div class="col-sm-2 control-label">
        อัพโหลดรูปภาพด้านหลัง :
      </div>
      <div class="col-sm-6">
        <font color="red">*อัพโหลดได้เฉพาะรูปภาพเท่านั้น </font>
        <input type="file" class="form-control" id="file" name="label_pic2" accept="image/*" onchange="readURL1(this)" >
        <img id="blah1" src="#" alt="" width="250" class="img-rounded"/ style="margin-top: 10px;">
      </div>
    </div>
    

    <hr>
  <div class="form-group">
      <div class="col-sm-6">
        <input type="hidden" name="username" required class="form-control" value="<?php echo $username; ?>" readonly >
      </div>
    </div>
  

  <div class="form-group">
    <div class="col-sm-12">
     <font color ="gray">บันทึกข้อมูลล่าสุด : <?php echo $row['label_dt']; ?> ผู้บันทึก : <?php echo $row ['username']; ?> </font> 
    </div>
  </div>
  <hr>
  <div class="fo

    <div class="form-group">
      <div class="col-sm-2">
      </div>
      <div class="col-sm-3">
        <input type="hidden" name="label_pic11" value="<?php echo $row['label_pic1'];?>">
        <input type="hidden" name="label_pic22" value="<?php echo $row['label_pic2'];?>">
        <input type="hidden" name="label_id" value="<?php echo $ID; ?>" />
        <button type="submit" name="submit" class="btn btn-success">แก้ไขข้อมูล</button>
        <a href="label.php" class="btn btn-danger">ยกเลิก</a>
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