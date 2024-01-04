<?php
if (@$_GET['do'] == 'f') {
    echo '<script type="text/javascript">
swal("", "กรุณาใส่ข้อมูลให้ถูกต้อง !!", "warning");
</script>';
    echo '<meta http-equiv="refresh" content="2;url=productdept.php?act=add" />';
} elseif (@$_GET['do'] == 'd') {
    echo '<script type="text/javascript">
swal("", "ชื่อสินค้าซ้ำ กรุณาเปลี่ยน  !!", "error");
</script>';
    echo '<meta http-equiv="refresh" content="1;url=productdept.php?act=add" />';
}
?>
<?php if ($_GET['act']=='productadd') {?>
<div align="right">
    <font color="red">*</font>
    <font color="gray">Required Fields</font>
</div>
<hr>
<form action="productdept_form_add_db.php?act=productadd" method="post" class="form-horizontal" enctype="multipart/form-data">
    <div class="form-group">
        <div class="form-group">
            <div class="col-sm-2 control-label">
                ชื่อสินค้า : <font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <input type="text" name="productdept_name" require class="form-control" autocomplete="off">
            </div>
        </div>       
        <div class=" form-group">
            <div class="col-sm-2 control-label">
                ราคาผลิต (ความยาว/เมตร) : <font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <input type="decimal" name="productdept_price" required class="form-control" autocomplete="off">
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
                <a href="productdept.php" class="btn btn-danger">ยกเลิก</a>
            </div>
        </div>
    </div>
</form>
<?php 
exit;
} ?>
<?php if ($_GET['act']=='productedit') {
$ID = mysqli_real_escape_string($con, $_GET['ID']);?>
<div align="right">
    <font color="red">*</font>
    <font color="gray">Required Fields</font>
</div>
<hr>
<form action="productdept_form_add_db.php?act=productedit&ID=<?php echo $ID; ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
    <div class="form-group">
        <div class="form-group">
            <div class="col-sm-2 control-label">
                ชื่อสินค้า : <font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <input type="text" name="productdept_name" require class="form-control" autocomplete="off">
            </div>
        </div>       
        <div class=" form-group">
            <div class="col-sm-2 control-label">
                ราคาผลิต (ความยาว/เมตร) : <font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <input type="decimal" name="productdept_price" required class="form-control" autocomplete="off">
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
                <a href="productdept.php" class="btn btn-danger">ยกเลิก</a>
            </div>
        </div>
    </div>
</form>
<?php } ?>
<div align="right">
    <font color="red">*</font>
    <font color="gray">Required Fields</font>
</div>
<hr>
<form action="productdept_form_add_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
    <div class="form-group">
        <div class="form-group">
            <div class="col-sm-2 control-label">
                ชื่อสินค้า : <font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <input type="text" name="productdept_name" require class="form-control" autocomplete="off">
            </div>
        </div>       
        <div class=" form-group">
            <div class="col-sm-2 control-label">
                ราคาผลิต (ความยาว/เมตร) : <font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <input type="decimal" name="productdept_price" required class="form-control" autocomplete="off">
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
                <a href="productdept.php" class="btn btn-danger">ยกเลิก</a>
            </div>
        </div>
    </div>
</form>