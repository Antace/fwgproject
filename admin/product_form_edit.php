<?php
$ID = mysqli_real_escape_string($con, $_GET['ID']);
$sql = "SELECT * FROM tb_product WHERE product_id=$ID";
$result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error());
$row = mysqli_fetch_array($result);


?>

<div align="right">
    <font color="red">*</font>
    <font color="gray">Required Fields</font>
</div>
<hr>
<form action="product_form_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
    <div class="form-group">
        <div class="form-group">
            <div class="col-sm-2 control-label">
                รหัสสินค้า :
            </div>
            <div class="col-sm-6">
                <input type="text" name="product_idn" class="form-control" value="<?php echo $row['product_idn']; ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                ชื่อสินค้า : <font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <input type="text" name="product_name" require class="form-control" value="<?php echo $row['product_name']; ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-3 control-label" class="form-control">
                รายละเอียดสินค้า :
            </div>
            <div class="col-sm-12">
                <textarea name="product_detail" cols="60" class="form-control"><?php echo $row['product_detail']; ?></textarea>
            </div>
        </div>

        <div class=" form-group">
            <div class="col-sm-2 control-label">
                ราคาสินค้า : <font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <input type="number" name="product_price" required class="form-control" value="<?php echo $row['product_price']; ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                คำนวณตาม : <font color="red">*</font>
            </div>
            <div class="col-sm-3">
                <select class="form-control" name="calculate_uom" required class="form-control">
                    <option value="<?php echo $row['calculate_uom']; ?>"><?php if($row['calculate_uom']==1){ echo 'จำนวน/ชุด';} elseif($row['calculate_uom']==2){echo 'ความยาว';} ?></option>
                    <option value="1">จำนวน/ชุด</option>
                    <option value="2">ความยาว</option>
                </select>
            </div>
        </div>
        <div class=" form-group">
            <div class="col-sm-2 control-label">
                ราคาผลิต : <font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <input type="decimal" name="production_price" required class="form-control" value="<?php echo $row['production_price']; ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                จำนวนสินค้า : <font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <input type="decimal" name="product_uom" required class="form-control" value="<?php echo $row['product_uom']; ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                หน่วย : <font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <input type="text" name="product_unit" require class="form-control" value="<?php echo $row['product_unit']; ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                น้ำหนัก : (KG)<font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <input type="decimal" name="product_weight" require class="form-control" value="<?php echo $row['product_weight']; ?>">
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
                <font color="gray">บันทึกข้อมูลล่าสุด : <?php echo $row['product_dt']; ?> ผู้บันทึก : <?php echo $row['username']; ?> </font>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-3">
                <input type="hidden" name="product_id" value="<?php echo $ID; ?>" />
                <button type="submit" class="btn btn-success">แก้ไขข้อมูล</button>
                <a href="product.php" class="btn btn-danger">ยกเลิก</a>
            </div>
        </div>
</form>