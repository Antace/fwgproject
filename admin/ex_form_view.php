<?php 
$ID = mysqli_real_escape_string($con,$_GET['ID']);
$sql = "SELECT * FROM tb_po
WHERE po_id=$ID
ORDER BY po_id DESC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
$row = mysqli_fetch_array($result);

?>

<form action="pm_form_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
  <div class="form-group">
    <div class="col-sm-2 control-label">
      เลขที่ใบสั่งซื้อ :
    </div>
    <div class="col-sm-3">
      <input type="text" name="po_name" required class="form-control" value="<?php echo $row['po_name'];?>" readonly>
    </div>
  </div>
  <div class="col-6">
      <div class="form-group">
        บริษัท:
        <input type="text" name="customer_name" required class="form-control" value="<?php echo $row['customer_name'];?>"readonly>
      </div>
    </div>
    <div class="col-6">
      <div class="form-group">
        โครงการ:
        <input type="text" name="department_name" required class="form-control" value="<?php echo $row['department_name'];?>"readonly>
      </div>
    </div>
    
    <div class="form-group">
      <div class="col-sm-2 control-label">
        งานของ :
      </div>
      <div class="col-sm-6">
      <input type="text" name="work_by" required class="form-control" value="<?php echo $row['work_by'];?>"readonly>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label">
        แปลง :
      </div>
      <div class="col-sm-6">
        <input type="text" name="po_place" required class="form-control" value="<?php echo $row['po_place'];?>"readonly>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label">
        ราคา :
      </div>
      <div class="col-sm-6">
        <input type="double" name="po_price" required class="form-control" value="<?php echo $row['po_price'];?>"readonly >
      </div>
    </div>
  <div class="form-group">
      <div class="col-sm-2 control-label">
        วันที่ทำรายการ :
      </div>
      <div class="col-sm-3">
        <input type="date" name="pm_date" required class="form-control" value="<?php echo $row['pm_date'];?>" readonly>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-2 control-label">
        รูปเดิม :<br>
      <img src="../pm_file/<?php echo $row['pm_file'];?>" width="200px" >
      <br>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label">
        วันที่ส่งงาน :
      </div>
      <div class="col-sm-3">
        <input type="date" name="po_datesend" required class="form-control" value="<?php echo $row['po_datesend'] ?>" readonly>
      </div>
    </div>
    <div class="form-group">
    <div class="col-sm-2 control-label">
      ระยะเวลาประกัน (ปี) :
    </div>
    <div class="col-sm-3">
      <input type="text" name="po_insurance" required class="form-control" value="<?php echo $row['po_insurance'] ?>" readonly>
    </div>
  </div>
  <div class="form-group">
      <div class="col-sm-2 control-label">
        วันที่หมดประกัน :
      </div>
      <div class="col-sm-3">
        <input type="date" name="po_dateexpire" required class="form-control" value="<?php echo $row['po_datesend'] ?>" readonly>
      </div>
    </div>
  
  <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
      <input type="hidden" name="po_id" value="<?php echo $ID; ?>" />
      <a href="po.php" class="btn btn-danger">ปิด</a>
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