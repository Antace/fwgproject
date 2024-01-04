<?php
if (@$_GET['do'] == 'f') {
    echo '<script type="text/javascript">
swal("", "กรุณาใส่ข้อมูลให้ถูกต้อง !!", "warning");
</script>';
    echo '<meta http-equiv="refresh" content="2;url=wage.php?act=add" />';
} elseif (@$_GET['do'] == 'd') {
    echo '<script type="text/javascript">
swal("", "ชื่อสินค้าซ้ำ กรุณาเปลี่ยน  !!", "error");
</script>';
    echo '<meta http-equiv="refresh" content="1;url=wage.php?act=add" />';
}
?>
<div align="right">
    <font color="red">*</font>
    <font color="gray">Required Fields</font>
</div>
<hr>
<form action="wage_form_add_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
    <div class="form-group">
        
        <div class="form-group">
            <div class="col-sm-2 control-label">
                ชื่อรายการ : <font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <input type="text" name="wage_name" require class="form-control">
            </div>
        </div>
    
        <div class=" form-group">
            <div class="col-sm-2 control-label">
                ราคา : <font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <input type="number" name="wage_price" required class="form-control" value="0">
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
                <button type="submit" name="submit" class="btn btn-success">บันทึก</button>
                <a href="wage.php" class="btn btn-danger">ยกเลิก</a>
            </div>
        </div>
    </div>
</form>