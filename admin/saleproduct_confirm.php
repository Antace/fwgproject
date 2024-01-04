<?php
session_start();


$stotal =  $_POST["sale_stotal"]; //ราคารวมสุทธิ
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
                                            <form id="frmcart" name="frmcart" method="post" action="saleproduct_db.php">
                                                <table border="0" cellspacing="0" align="center" class="table table-bordered table-striped">
                                                    <tr>
                                                        <td colspan="2">เลือกข้อมูลลูกค้า</td>
                                                    </tr>
                                                    <tr>
                                                        <td>วันที่ : <font color="red">*</font></td>
                                                        <td><input type="date" name="sale_date" value="<?php echo (new DateTime())->format('Y-m-d'); ?>" required class="form-control"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>ชื่อลูกค้า : <font color="red">*</font></td> 
                                                        <td>
                                                            <input name="customer_name" type="text" id="customer_name" class="form-control" required value="ลูกค้าไม่รับบิล" readonly/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" align="center">
                                                            <input type="hidden" name="sale_stotal" value="<?php echo $stotal; ?>">
                                                            <input type="hidden" name="username" value="<?php echo $username; ?>">
                                                            
                                                        </td>
                                                    </tr>
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
                                                    foreach ($_SESSION['cart'] as $product_id => $qty) {
                                                        // $sale_price = $sale_pricearray[$product_id];
                                                        $sql    = "SELECT * FROM tb_product WHERE product_id=$product_id";
                                                        $query  = mysqli_query($con, $sql);
                                                        $row    = mysqli_fetch_array($query);
                                                        $sum    = $row["product_price"] * $qty;
                                                        $total    += $sum;
                                                        $total1 = $total;
                                                        
                                                        $stotal = $total1;

                                                        echo "<input type='hidden' name='sale_price[$product_id]' value=' $sum'>";
                                                        echo "<tr>";
                                                        echo "<td>" . $row["product_name"] . "</td>";
                                                        echo "<td align='right'>" . number_format($row["product_price"], 2) . "</td>";
                                                        echo "<td align='right'>$qty</td>";
                                                        echo "<td align='right'>" . number_format($sum, 2) . "</td>";
                                                        echo "</tr>";
                                                    }
                                                    echo "<tr>";
                                                    echo "<td  align='right' colspan='3' ><b>รวมทั้งหมด</b></td>";
                                                    echo "<td align='right' >" . "<b>" . number_format($stotal, 2) . "</b>" . "</td>";
                                                    echo "</tr>";
                                                    ?>

                                                </table>
                                                <p>

                                                   
                                                    <center><a href="sale_form_add1.php" class="btn btn-warning ">กลับหน้ายืนยันการสั่งซื้อ</a> &nbsp;&nbsp;<input type="submit" name="Submit2" class="btn btn-success" value="บันทึก" /></center>
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