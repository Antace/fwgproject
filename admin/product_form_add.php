<?php
if (@$_GET['do'] == 'f') {
    echo '<script type="text/javascript">
swal("", "กรุณาใส่ข้อมูลให้ถูกต้อง !!", "warning");
</script>';
    echo '<meta http-equiv="refresh" content="2;url=product.php?act=add" />';
} elseif (@$_GET['do'] == 'd') {
    echo '<script type="text/javascript">
swal("", "ชื่อสินค้าซ้ำ กรุณาเปลี่ยน  !!", "error");
</script>';
    echo '<meta http-equiv="refresh" content="1;url=product.php?act=add" />';
}
?>
<div align="right">
    <font color="red">*</font>
    <font color="gray">Required Fields</font>
</div>
<hr>
<form action="product_form_add_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
    <div class="form-group">
        <div class="form-group">
            <div class="col-sm-2 control-label">
                รหัสสินค้า :
            </div>
            <div class="col-sm-6">
                <input type="text" name="product_idn" class="form-control" value="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                ชื่อสินค้า : <font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <input type="text" name="product_name" require class="form-control">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                ความยาว (Varies) : <font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <input type="decimal" name="product_name" require class="form-control">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-3 control-label" class="form-control">
                รายละเอียดสินค้า :
            </div>
            <div class="col-sm-12">
                <textarea name="product_detail" cols="60" class="form-control"></textarea>
            </div>
        </div>
        <div class=" form-group">
            <div class="col-sm-2 control-label">
                ราคาสินค้า : <font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <input type="number" name="product_price" required class="form-control" value="0">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                คำนวณตาม : <font color="red">*</font>
            </div>
            <div class="col-sm-3">
                <select class="form-control" name="calculate_uom" required class="form-control">
                    <option value="">---คำนวณตาม---</option>
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
                <input type="decimal" name="production_price" required class="form-control" value="0">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                จำนวนสินค้า : <font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <input type="decimal" name="product_uom" required class="form-control" value="0">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                หน่วย : <font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <input type="text" name="product_unit" required class="form-control">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                น้ำหนัก : (KG)<font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <input type="decimal" name="product_weight" required class="form-control" value="0">
            </div>
        </div>
        <hr>
        <div class="form-group">
            <div class="col-sm-6">
                <input type="hidden" name="username" required class="form-control" value="<?php echo $username; ?>" readonly>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-3">
                <button type="submit" name="submit" class="btn btn-success">เพิ่มข้อมูล</button>
                <a href="product.php" class="btn btn-danger">ยกเลิก</a>
            </div>
        </div>
    </div>
</form>