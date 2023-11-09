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

<form action="cb_form_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
  <div class="form-group">
    <div class="col-sm-2 control-label">
      เลขที่ใบสั่งซื้อ :
    </div>
    <div class="col-sm-3">
      <input type="text" name="po_name" required class="form-control" value="<?php echo $row['po_name'];?>" readonly>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      เลขที่ใบรับเงินประกัน :
    </div>
    <div class="col-sm-3">
      <input type="text" name="cb_name" required class="form-control" value="<?php echo $row['cb_name'];?>">
    </div>
  </div>
  <div class="form-group">
      <div class="col-sm-2 control-label">
        วันที่ทำรายการ :
      </div>
      <div class="col-sm-3">
        <input type="date" name="cb_date" required class="form-control" value="<?php echo $row['cb_date'];?>">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label">
        เงินประกัน :
      </div>
      <div class="col-sm-3">
        <input type="decimal" name="insurance_price" required class="form-control" value="<?php echo $row['insurance_price'];?>">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label">
        ไฟล์ :
      </div>
      <div class="col-sm-3">
        <font color="red">*อัพโหลดได้เฉพาะไฟล์รูปและPDFเท่านั้น </font>
        <input type="file" class="form-control" id="file" name="cb_file" accept="image/application/PDF*" onchange="readURL(this)"  >
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label">
        รูปเดิม :<br>
      <img src="../cb_file/<?php echo $row['cb_file'];?>" width="200px">
      <br>
      </div>
      <div class="col-sm-3">
        รูปใหม่ :
      <div id="imgControl" class="d-none">
        <img id="imgUpload" class="img-fluid my-3">
      </div>
      </div>
    </div>
  <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
      <input type="hidden" name="cb_file2" value="<?php echo $row['cb_file'];?>">
      <input type="hidden" name="po_id" value="<?php echo $ID; ?>" />
      <button type="submit" name="submit" class="btn btn-success">บันทึก</button>
      <a href="po.php" class="btn btn-danger">ยกเลิก</a>
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