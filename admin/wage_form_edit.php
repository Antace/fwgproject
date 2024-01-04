<?php

$ID = mysqli_real_escape_string($con, $_GET['ID']);
$sql = "SELECT * FROM tb_wage WHERE wage_id=$ID";
$result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
$row = mysqli_fetch_array($result);
?>
<div align="right">
    <font color="red">*</font>
    <font color="gray">Required Fields</font>
</div>
<hr>
<form action="wage_form_edit_db.php" method="post" class="form-horizontal">
    <div class="form-group">
        <div class="col-sm-2 control-label">
            ชื่อรายการ : <font color="red">*</font>
        </div>
        <div class="col-sm-6">
            <input type="text" name="wage_name" require class="form-control" value="<?php echo $row['wage_name']; ?>">
        </div>
    </div>

    <div class=" form-group">
        <div class="col-sm-2 control-label">
            ราคา : <font color="red">*</font>
        </div>
        <div class="col-sm-6">
            <input type="number" name="wage_price" required class="form-control" value="<?php echo $row['wage_price']; ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-6">
            <input type="hidden" name="username" required class="form-control" value="<?php echo $username; ?>" readonly>
        </div>
    </div>
    <hr>

    <div class="form-group">
        <div class="col-sm-12">
            <font color="gray">บันทึกข้อมูลล่าสุด : <?php echo $row['wage_dt']; ?> ผู้บันทึก : <?php echo $row['username']; ?> </font>
        </div>
    </div>
    <hr>
    <div class="form-group">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-3">
            <input type="hidden" name="wage_id" value="<?php echo $ID; ?>" />
            <button type="submit" class="btn btn-success">บันทึก</button>
            <a href="wage.php" class="btn btn-danger">ยกเลิก</a>
        </div>
    </div>
</form>