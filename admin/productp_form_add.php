<?php
$query2 = "SELECT * FROM tb_department ORDER BY department_id asc" or die("Error:" . mysqli_error());
$result2 = mysqli_query($con, $query2);


?>
<?php
if (@$_GET['do'] == 'f') {
    echo '<script type="text/javascript">
swal("", "กรุณาใส่ข้อมูลให้ถูกต้อง !!", "warning");
</script>';
    echo '<meta http-equiv="refresh" content="2;url=productp.php?act=add" />';
} elseif (@$_GET['do'] == 'd') {
    echo '<script type="text/javascript">
swal("", "ชื่อสินค้าซ้ำ กรุณาเปลี่ยน  !!", "error");
</script>';
    echo '<meta http-equiv="refresh" content="1;url=productp.php?act=add" />';
}
?>
<div align="right">
    <font color="red">*</font>
    <font color="gray">Required Fields</font>
</div>
<hr>
<form action="productp_form_add_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
    <div class="form-group">
        <div class="form-group">
            <div class="col-sm-2 control-label">
                ชื่อรายการผลิต : <font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <input type="text" name="productp_name" require class="form-control">
            </div>
        </div>


        <div class=" form-group">
            <div class="col-sm-2 control-label">
                หนา : <font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <input type="decimal" name="productp_thick" required class="form-control" value="0">
            </div>
            <div class="col-sm-2 control-label">
                สูง : <font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <input type="decimal" name="productp_height" required class="form-control" value="0">
            </div>
            <div class="col-sm-2 control-label">
                ยาว : <font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <input type="decimal" name="productp_long" required class="form-control" value="0">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                โครงการ : <font color="red">*</font>
                <select class="select2bs4" data-placeholder="โครงการ" name="department_name" style="width: 100%;" required>
                    <option value="">-</option>
                    <?php foreach ($result2 as $results) { ?>
                        <option value="<?php echo $results["department_name"]; ?>">
                            <?php echo $results["department_name"]; ?>
                        </option>
                    <?php } ?>
                </select><a href="department.php?act=add" ">เพิ่มโครงการ</a>
            </div>
        </div>

            <div class=" form-group">
                    <div class="col-sm-2 control-label">
                        จำนวนสินค้า : <font color="red">*</font>
                    </div>
                    <div class="col-sm-6">
                        <input type="decimal" name="productp_uom" required class="form-control" value="0">
                    </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2 control-label">
                    หน่วย : <font color="red">*</font>
                </div>
                <div class="col-sm-6">
                    <input type="text" name="productp_unit" required class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2 control-label">
                    น้ำหนัก : (KG)<font color="red">*</font>
                </div>
                <div class="col-sm-6">
                    <input type="decimal" name="productp_weight" required class="form-control" value="0">
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
                    <a href="productp.php" class="btn btn-danger">ยกเลิก</a>
                </div>
            </div>
        </div>
</form>