<?php
$query2 = "SELECT * FROM tb_productdept ORDER BY productdept_id asc" or die("Error:" . mysqli_error($con));
$result_t = mysqli_query($con, $query2);
?>
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
<script type="text/javascript">
    function Sum_number() {
        // ประกาศตัวแปร
        //num1 = Format(Text1, "#,###,###,###.00") 
        var num1 = document.getElementById('productdept_price').value;
        var num2 = document.getElementById('num2').value;
        //ประกาศหากกรณีuserยังไม่คีย์ให้ค่าในกล่องเป็น 0 เพื่อป้องกันปัญหา NaN
        if (num1 == "") {
            num1 = 0;
        }
        if (num2 == "") {
            num2 = 0;
        }
        // ส่วนประมวลผล
        // var sum = parseInt(num1) * parseInt(num2); // parseInt คิดตามจำนวนเต็ม
        var sum = parseFloat(num1) * parseFloat(num2); //parseFloat คิดตามจุดทศนิยม
        document.getElementById('sum').value = sum;
    }
</script>

<script language="JavaScript">
    function chkNum(ele) {
        var num = parseFloat(ele.value);
        ele.value = num.toFixed(2);
    }
</script>

<script language="JavaScript">
    //script select ข้อมูล
    function resutName(strCusName) {
        frmproduct.productdept_id.value = strCusName.split("|")[0];
        frmproduct.productdept_name.value = strCusName.split("|")[1];
        frmproduct.productdept_price.value = strCusName.split("|")[2];
    }
</script>

<div align="right">
    <font color="red">*</font>
    <font color="gray">Required Fields</font>
</div>
<hr>
<form id="frmproduct" name="frmproduct" action="product_form_add_db1.php" method="post" class="form-horizontal" enctype="multipart/form-data">
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
                เลือกรูปแบบรายการ : <font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <select class="select2bs4" data-placeholder="เลือกรายการ" name="productdept_id" style="width: 100%;" OnChange="resutName(this.value);">
                    <option value="">-</option>
                    <?php

                    while ($row = mysqli_fetch_array($result_t)) {
                    ?>
                        <option value="<?php echo $row["productdept_id"]; ?>|<?php echo $row["productdept_name"]; ?>|<?php echo $row["productdept_price"]; ?>"><?php echo $row["productdept_name"]; ?></option>
                    <?php
                    }
                    ?>
                </select>
                <a href="productdept.php?act=productadd" class="btn btn-primary btn-xs">เพิ่ม</a>
                <font color="gray"> ถ้าไม่มีรายการให้กดปุ่มเพิ่ม </font>
                <input type="hidden" id="productdept_name" name="product_name" require class="form-control">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-3 control-label">
                ความยาว/เมตร (Varies) : <font color="red">*</font>
                <font color="gray"> ตัวอย่าง 3.90</font>
            </div>
            <div class="col-sm-6">
                <input type="decimal" name="num2" id="num2" require class="form-control" onKeyUp="Sum_number();" OnChange="JavaScript:chkNum(this)">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                ราคา/เมตร : <font color="red">*</font>
            </div>
            <div class="col-sm-6">
                <input type="decimal" name="num1" id="productdept_price" require class="form-control" readonly>
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
                <input type="decimal" name="production_price" id="sum" required class="form-control" onKeyUp="JavaScript:chkNum(this)" readonly>
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