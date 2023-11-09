<?php
$query2 = "SELECT * FROM tb_contractor ORDER BY contractor_id asc" or die("Error:" . mysqli_error());
$result2 = mysqli_query($con, $query2);
$query3 = "SELECT * FROM tb_expenses ORDER BY expenses_id asc" or die("Error:" . mysqli_error());
$result3 = mysqli_query($con, $query3);

?>
<?php
if(@$_GET['do']=='f'){
echo '<script type="text/javascript">
swal("", "กรุณาใส่ข้อมูลให้ถูกต้อง !!", "warning");
</script>';
echo '<meta http-equiv="refresh" content="2;url=rexpenses.php?act=add" />';
}elseif(@$_GET['do']=='d'){
echo '<script type="text/javascript">
swal("", "เลขใบสั่งซื้อซ้ำ กรุณาเปลี่ยน  !!", "error");
</script>';
echo '<meta http-equiv="refresh" content="1;url=rexpenses.php?act=add" />';
}
?>
<div align="right">
  <font color="red">*</font>
  <font color="gray">Required Fields</font>
</div>
<hr>
<form action="rexpenses_form_add_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
    <div class="form-group">
      <div class="col-sm-2 control-label">
        วันที่ : <font color="red">*</font>
      </div>
      <div class="col-sm-2">
        <input type="date" name="rexpenses_date" required class="form-control">
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        ผู้รับเหมา : <font color="red">*</font>
        <select class="select2bs4"  data-placeholder="ผู้รับเหมา" name ="contractor_nickname" style="width: 100%;" required>
        <option value="">-</option>
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
        <option value="">-</option>
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
        <input type="decimal"  name="rexpenses_uom" required class="form-control">
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
        <button type="submit" name="submit" class="btn btn-success">เพิ่มข้อมูล</button>
        <a href="rexpenses.php" class="btn btn-danger">ยกเลิก</a>
      </div>
    </div>
  </div>
</form>

