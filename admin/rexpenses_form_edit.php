<?php
$ID = mysqli_real_escape_string($con, $_GET['ID']);
$sql = "SELECT * FROM tb_rexpenses WHERE rexpenses_id=$ID";
$result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
$row = mysqli_fetch_array($result);

$query2 = "SELECT * FROM tb_contractor ORDER BY contractor_id asc" or die("Error:" . mysqli_error($con));
$result2 = mysqli_query($con, $query2);
$query3 = "SELECT * FROM tb_expenses ORDER BY expenses_id asc" or die("Error:" . mysqli_error($con));
$result3 = mysqli_query($con, $query3);
?>

<div align="right">
  <font color="red">*</font>
  <font color="gray">Required Fields</font>
</div>
<hr>
<form action="rexpenses_form_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
  <div class="form-group">
      <div class="col-sm-2 control-label">
        วันที่ : <font color="red">*</font>
      </div>
      <div class="col-sm-2">
        <input type="date" name="rexpenses_date" required class="form-control" value="<?php echo $row['rexpenses_date']; ?>">
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        ผู้รับเหมา : <font color="red">*</font>
        <select class="select2bs4"  data-placeholder="ผู้รับเหมา" name ="contractor_nickname" style="width: 100%;" required>
        <option value="<?php echo $row['contractor_nickname']; ?>"><?php echo $row['contractor_nickname']; ?></option>
          <?php foreach($result2 as $results){?>
          <option value="<?php echo $results["contractor_nickname"];?>">
            <?php echo $results["contractor_nickname"]; ?>
          </option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        รายการค่าใช้จ่าย : <font color="red">*</font>
        <select class="select2bs4"  data-placeholder="รายการค่าใช้จ่าย" name ="expenses_name" style="width: 100%;" required>
        <option value="<?php echo $row['expenses_name']; ?>"><?php echo $row['expenses_name']; ?></option>
          <?php foreach($result3 as $results){?>
          <option value="<?php echo $results["expenses_name"];?>">
            <?php echo $results["expenses_name"]; ?>
          </option>
          <?php } ?>
        </select>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-2 control-label">
        จำนวนเงิน (บาท) : <font color="red">*</font>
      </div>
      <div class="col-sm-6">
        <input type="decimal"  name="rexpenses_uom" required class="form-control" value="<?php echo $row['rexpenses_uom']; ?>">
      </div>
    </div>


    

  
  <div class="form-group">
      <div class="col-sm-6">
        <input type="hidden" name="username" required class="form-control" value="<?php echo $username; ?>" readonly >
      </div>
    </div>




  <hr>

  <div class="form-group">
    <div class="col-sm-12">
     <font color ="gray">บันทึกข้อมูลล่าสุด : <?php echo $row['rexpenses_dt']; ?> ผู้บันทึก : <?php echo $row ['username']; ?> </font> 
    </div>
  </div>
  <hr>
  <div class="form-group">
    <div class="col-sm-3">
    </div>
    <div class="col-sm-3">
      <input type="hidden" name="rexpenses_id" value="<?php echo $ID; ?>" />
      <button type="submit" class="btn btn-success">บันทึก</button>
      <a href="rexpenses.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>