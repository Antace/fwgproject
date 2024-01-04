<?php
session_start();
$transport_pricearray =  $_POST['transport_price'];
$total  =  $_POST["transport_total"]; //ราคารวมทั้ง order
$discount =  $_POST["transport_discount"]; //ส่วนลด
$vat = $_POST["transport_vat"]; //ภาษี 7%
$stotal =  $_POST["transport_stotal"]; //ราคารวมสุทธิ
// print_r($_POST);
$transport_poarray = $_POST["transport_po"];

$transport_pricearray =  $_POST['transport_price'];
include('../condb.php');
$sql2 = "SELECT * FROM tb_customer
ORDER BY customer_id DESC" or die("Error:" . mysqli_error($con, $sql2));
$result_t = mysqli_query($con, $sql2) or die("Error in query: $sql2 " . mysqli_error($con, $sql2));

$sql3 = "SELECT * FROM tb_department
ORDER BY department_id DESC" or die("Error:" . mysqli_error($con, $sql3));
$result_t3 = mysqli_query($con, $sql3) or die("Error in query: $sql3 " . mysqli_error($con, $sql3));




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
                        frmtransport.customer_id.value = strCusName.split("|")[0];
                        frmtransport.customer_name.value = strCusName.split("|")[1];
                        frmtransport.customer_address.value = strCusName.split("|")[2];
                        
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
                                            <form id="frmtransport" name="frmtransport" method="post" action="transportproduct_db.php">
                                                <table border="0" cellspacing="0" align="center" class="table table-bordered table-striped">
                                                <tr>
                                                        <td colspan="2">เลือกข้อมูลลูกค้า</td>
                                                    </tr>
                                                    <tr>
                                                        <td>วันที่ : <font color="red">*</font></td>
                                                        <td><input type="date" name="transport_date" value="<?php echo (new DateTime())->format('Y-m-d'); ?>" required class="form-control"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>ชื่อลูกค้า : <font color="red">*</font></td> 
                                                        <td><select class="select2bs4" data-placeholder="เลือกรายการ" name="customer_id" style="width: 100%;" OnChange="resutName(this.value);" >
                                                                <option value="">-</option>
                                                                <?php

                                                                while ($row = mysqli_fetch_array($result_t)) {
                                                                ?>
                                                                    <option value="<?php echo $row["customer_id"]; ?>|<?php echo $row["customer_name"]; ?>|<?php echo $row["customer_address"]; ?>"><?php echo $row["customer_name"]; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                            <input name="customer_name" type="hidden" id="customer_name" class="form-control" required />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>ที่อยู่ : <font color="red">*</font></td>
                                                        <td>
                                                            <textarea name="customer_address" cols="60" required class="form-control"></textarea>
                                                        </td>
                                                    </tr>


                                                    <tr>
                                                        <td>โครงการ : <font color="red">*</font>
                                                        </td>
                                                        <td><select class="select2bs4" data-placeholder="เลือกรายการ" name="department_name" style="width: 100%;">
                                                                <option value="-">-</option>
                                                                <option value="ไม่ระบุ">ไม่ระบุ</option>
                                                                <?php

                                                                while ($row3 = mysqli_fetch_array($result_t3)) {
                                                                ?>
                                                                    <option value="<?php echo $row3["department_name"]; ?>"><?php echo $row3["department_name"]; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" align="center">
                                                            <input type="hidden" name="transport_total" value="<?php echo $total; ?>">
                                                            <input type="hidden" name="transport_discount" value="<?php echo $discount; ?>">
                                                            <input type="hidden" name="transport_vat" value="<?php echo $vat; ?>">
                                                            <input type="hidden" name="transport_stotal" value="<?php echo $stotal; ?>">
                                                            <input type="hidden" name="username" value="<?php echo $username; ?>">
                                                            <!--<input type="submit" name="Submit2" value="สั่งซื้อ" /> -->
                                                        </td>
                                                    </tr>
                                                </table>




                                                <table width="600" border="0" align="center" class="table table-bordered table-striped">
                                                    <tr>
                                                        <td width="1558" colspan="6">
                                                            <strong>ยืนยันรายการ</strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>เลขที่</td>
                                                        <td>สินค้า</td>
                                                        <td>สถานที่จัดเก็บ</td>
                                                        <td align="center">ราคา</td>
                                                        <td align="center">จำนวน</td>
                                                        <td align="center">รวม(บาท)</td>

                                                    </tr>
                                                    <?php

                                                    foreach ($_SESSION['transport'] as $product_id => $qty) {
                                                        $transport_price = $transport_pricearray[$product_id];
                                                        $transport_po = $transport_poarray[$product_id];
                                                        $sql    = "SELECT * FROM tb_product WHERE product_id=$product_id";
                                                        $query    = mysqli_query($con, $sql);
                                                        $row    = mysqli_fetch_array($query);
                                                        $sum = $transport_price * $qty;
                                                        echo "<input type='hidden' name='transport_price[$product_id]' value=' $transport_price'>";
                                                        echo "<input type='hidden' name='transport_po[$product_id]' value=' $transport_po'>";
                                                        echo "<tr>";
                                                        echo "<td>" . $transport_po . "</td>";
                                                        echo "<td>" . $row["product_name"] . "</td>";
                                                        echo "<td>" . $row["location_name"] . "</td>";

                                                        echo "<td align='right'>" . number_format($transport_price, 2) . "</td>";
                                                        echo "<td align='right'>$qty</td>";
                                                        echo "<td align='right'>" . number_format($sum, 2) . "</td>";
                                                        echo "</tr>";
                                                    }
                                                    echo "<tr>";
                                                    echo "<td  align='right' colspan='5' ><b>รวม</b></td>";
                                                    echo "<td align='right' >" . "<b>" . number_format($total, 2) . "</b>" . "</td>";
                                                    echo "</tr>";
                                                    echo "<tr>";
                                                    echo "<td  align='right' colspan='5' ><b>ส่วนลด</b></td>";
                                                    echo "<td align='right' >" . "<b>" . number_format($discount, 2) . "</b>" . "</td>";
                                                    echo "</tr>";
                                                    echo "<td  align='right' colspan='5' ><b>ภาษี</b></td>";
                                                    echo "<td align='right' >" . "<b>" . number_format($vat, 2) . "</b>" . "</td>";
                                                    echo "</tr>";
                                                    echo "<tr>";
                                                    echo "<td  align='right' colspan='5' ><b>รวมทั้งหมด</b></td>";
                                                    echo "<td align='right' >" . "<b>" . number_format($stotal, 2) . "</b>" . "</td>";
                                                    echo "</tr>";
                                                    ?>

                                                </table>
                                                <p>

                                                    <center><a href="transport_form_add1.php" class="btn btn-warning ">กลับหน้ายืนยันการสั่งซื้อ</a> &nbsp;&nbsp;<input type="submit" name="Submit2" class="btn btn-success" value="บันทึก" /></center>
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