<?php
session_start();
$reserve_pricearray =  $_POST['reserve_price'];
$total  =  $_POST["reserve_total"]; //ราคารวมทั้ง order
$discount =  $_POST["reserve_discount"]; //ส่วนลด

// print_r($_POST);

include("../condb.php");
$sql2 = "SELECT * FROM tb_customer
ORDER BY customer_id DESC" or die("Error:" . mysqli_error($con, $sql2));
$result_t = mysqli_query($con, $sql2) or die("Error in query: $sql2 " . mysqli_error($con, $sql2));


?>
<?php include('h.php'); ?>

<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
        <!-- Main Header -->
        <?php include('menutop.php'); ?> <!-- เรียกใช้ไฟล์ menutop.php -->
        <?php include('menu_l.php'); ?> <!-- เรียกใช้ไฟล์ menu_l.php -->
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <i class="glyphicon glyphicon-check hidden-xs"></i> <span class="hidden-xs">รายละเอียดข้อมูลสินค้า</span>
                </h1>
            </section>
            <!DOCTYPE html>
            <html>

            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>Checkout</title>
            </head>

            <body>
                <script language="JavaScript">
                    //script select ข้อมูล
                    function resutName(strCusName) {
                        frmreserve.customer_id.value = strCusName.split("|")[0];
                        frmreserve.customer_name.value = strCusName.split("|")[1];
                        frmreserve.customer_address.value = strCusName.split("|")[2];
                        frmreserve.customer_branch.value = strCusName.split("|")[3];
                        frmreserve.customer_tax.value = strCusName.split("|")[4];
                    }
                </script>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="sticky-top mb-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div align="right">
                                                <font color="red">*</font>
                                                <font color="gray">Required Fields</font>
                                            </div>
                                            <hr>
                                            <form id="frmreserve" name="frmreserve" method="post" action="reserveproduct_db.php">
                                                <table border="0" cellspacing="0" align="center" class="table table-bordered table-striped">
                                                    <tr>
                                                        <td colspan="2">เลือกข้อมูลลูกค้า</td>
                                                    </tr>
                                                    <tr>
                                                        <td>วันที่ : <font color="red">*</font></td>
                                                        <td><input type="date" name="reserve_date" value="<?php echo (new DateTime())->format('Y-m-d'); ?>" required class="form-control"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>ชื่อลูกค้า : <font color="red">*</font></td> 
                                                        <td><select class="select2bs4" data-placeholder="เลือกรายการ" name="customer_id" style="width: 100%;" OnChange="resutName(this.value);" >
                                                                <option value="">-</option>
                                                                <?php

                                                                while ($row = mysqli_fetch_array($result_t)) {
                                                                ?>
                                                                    <option value="<?php echo $row["customer_id"]; ?>|<?php echo $row["customer_name"]; ?>|<?php echo $row["customer_address"]; ?>|<?php echo $row["customer_branch"]; ?>|<?php echo $row["customer_tax"]; ?>"><?php echo $row["customer_name"]; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                            <input name="customer_name" type="hidden" id="customer_name" class="form-control" required  readonly/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>ที่อยู่ : <font color="red">*</font></td>
                                                        <td>
                                                            <textarea name="customer_address" cols="60" required class="form-control" readonly></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>สาขา : <font color="red">*</font></td>
                                                        <td><input name="customer_branch" type="text" id="customer_branch" class="form-control" required  readonly/></td>
                                                    </tr>
                                                    <tr>
                                                        <td>เลขประจำตัวผู้เสียภาษี : <font color="red">*</font></td>
                                                        <td><input name="customer_tax" type="text" id="customer_tax" class="form-control" required readonly /></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>สถานะการรับของ : <font color="red">*</font></td>
                                                        <td><select class="select2bs4" data-placeholder="สถานะการรับของ" name="receive_status" style="width: 100%;" >
                                                                <option value="">-</option>
                                                                <option value="รับแล้ว">รับแล้ว</option>
                                                                <option value="ยังไม่ได้รับ">ยังไม่ได้รับ</option>
                                                            </select></td>
                                                    </tr>
                                                    <tr>
                                                        <td>สถานะการจ่าย : <font color="red">*</font></td>
                                                        <td><select class="select2bs4" data-placeholder="สถานะการจ่าย" name="payment_status" style="width: 100%;" >
                                                                <option value="">-</option>
                                                                <option value="จ่ายแล้ว">จ่ายแล้ว</option>
                                                                <option value="ยังไม่จ่าย">ยังไม่จ่าย</option>
                                                            </select></td>
                                                    </tr>
                                                    <tr>
                                                        <td>ประเภทการจ่าย : <font color="red">*</font></td>
                                                        <td><select class="select2bs4" data-placeholder="สถานะการจ่าย" name="payment_type" style="width: 100%;" >
                                                                <option value="">-</option>
                                                                <option value="-">-</option>
                                                                <option value="โอน">โอน</option>
                                                                <option value="เงินสด">เงินสด</option>
                                                            </select></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" align="center">
                                                            <input type="hidden" name="reserve_total" value="<?php echo $total; ?>">
                                                            <input type="hidden" name="reserve_discount" value="<?php echo $discount; ?>">
                                                            <input type="hidden" name="reserve_vat" value="<?php echo $vat; ?>">
                                                            <input type="hidden" name="reserve_stotal" value="<?php echo $stotal; ?>">
                                                            <input type="hidden" name="username" value="<?php echo $username; ?>">
                                                            <!--<input type="submit" name="Submit2" value="สั่งซื้อ" /> -->
                                                        </td>
                                                    </tr>
                                                    <!-- <tr>
                                                        <td>สถานะการนำออก : <font color="red">*</font></td>
                                                        <td><select class="select2bs4" data-placeholder="เลือกรายการ" name="reserve_status" style="width: 100%;" required>
                                                                <option value="">-</option>
                                                                <option value="จอง">จอง</option>
                                                                <option value="เงินสด">เงินสด</option>
                                                                <option value="โอน">โอน</option>
                                                                <option value="ส่งออก">ส่งออก</option>
                                                            </select>
                                                           
                                                        </td>
                                                    </tr> -->
                                                </table>
                                                <table width="600" border="0" align="center" class="table table-bordered table-striped">
                                                    <tr>
                                                        <td width="1558" colspan="4">
                                                            <strong>ยืนยันการขาย</strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>สินค้า</td>
                                                        <td align="center">ราคา</td>
                                                        <td align="center">จำนวน</td>
                                                        <td align="center">รวม/รายการ</td>
                                                    </tr>
                                                    <?php
                                                    $total = 0;
                                                    $vat = 0;
                                                    $stotal = 0;
                                                    foreach ($_SESSION['reserve'] as $product_id => $qty) {
                                                        $reserve_price = $reserve_pricearray[$product_id];
                                                        $sql    = "SELECT * FROM tb_product WHERE product_id=$product_id";
                                                        $query    = mysqli_query($con, $sql);
                                                        $row    = mysqli_fetch_array($query);
                                                        $sum    = $reserve_price * $qty;
                                                        $total    += $sum;
                                                        $total1 = $total - $discount;
                                                        $vat = $total1 * 0.07;
                                                        $stotal = $total1 + $vat;

                                                        echo "<input type='hidden' name='reserve_price[$product_id]' value=' $reserve_price'>";
                                                        echo "<tr>";
                                                        echo "<td>" . $row["product_name"] . "</td>";
                                                        echo "<td align='right'>" . number_format($reserve_price, 2) . "</td>";
                                                        echo "<td align='right'>$qty</td>";
                                                        echo "<td align='right'>" . number_format($sum, 2) . "</td>";
                                                        echo "</tr>";
                                                    }
                                                    echo "<tr>";
                                                    echo "<td  align='right' colspan='3' ><b>รวม</b></td>";
                                                    echo "<td align='right' >" . "<b>" . number_format($total, 2) . "</b>" . "</td>";
                                                    echo "</tr>";
                                                    echo "<tr>";
                                                    echo "<td  align='right' colspan='3' ><b>ส่วนลด</b></td>";
                                                    echo "<td align='right' >" . "<b>" . number_format($discount, 2) . "</b>" . "</td>";
                                                    echo "</tr>";
                                                    echo "<td  align='right' colspan='3' ><b>ภาษี</b></td>";
                                                    echo "<td align='right' >" . "<b>" . number_format($vat, 2) . "</b>" . "</td>";
                                                    echo "</tr>";
                                                    echo "<tr>";
                                                    echo "<td  align='right' colspan='3' ><b>รวมทั้งหมด</b></td>";
                                                    echo "<td align='right' >" . "<b>" . number_format($stotal, 2) . "</b>" . "</td>";
                                                    echo "</tr>";
                                                    ?>

                                                </table>
                                                <p>

                                                   
                                                    <center><a href="reserve_form_add1.php" class="btn btn-warning ">กลับหน้ายืนยันการสั่งซื้อ</a> &nbsp;&nbsp;<input type="submit" name="Submit2" class="btn btn-success" value="สั่งซื้อ" /></center>
                                            </form>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.col -->

                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
        </div>

</body>
<?php include('footerjs.php'); ?>

</html>