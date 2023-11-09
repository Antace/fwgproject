<?php
session_start();

// print_r($_POST);

include("../condb.php");
$sql2 = "SELECT * FROM tb_contractor
ORDER BY contractor_id DESC" or die("Error:" . mysqli_error());
$result_t = mysqli_query($con, $sql2) or die("Error in query: $sql " . mysqli_error());


?>
<?php include('h.php'); ?>

<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
        <!-- Main Header -->
        <?php include('menutop.php'); ?>
        <?php include('menu_l.php'); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <i class="glyphicon glyphicon-check hidden-xs"></i> <span class="hidden-xs">รายละเอียดข้อมูลสินค้า</span>
                    <!-- <a href="product.php?act=add" class="btn btn-primary btn-sm">เพิ่มสินค้า</a> -->
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
                                            <form id="frmproduction" name="frmproduction" method="post" action="production_db.php">
                                                <table border="0" cellspacing="0" align="center" class="table table-bordered table-striped">
                                                    <tr>
                                                        <td colspan="2">เลือกข้อมูลผู้รับเหมา</td>
                                                    </tr>
                                                    <tr>
                                                        <td>วันที่ : <font color="red">*</font>
                                                        </td>
                                                        <td> <input type="date" name="production_date" value="<?php echo (new DateTime())->format('Y-m-d'); ?>" required class="form-control"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>ชื่อผู้รับเหมา</td>
                                                        <td><select class="select2bs4" data-placeholder="เลือกรายการ" name="contractor_nickname" style="width: 100%;">
                                                                <option value="">-</option>
                                                                <?php

                                                                while ($row = mysqli_fetch_array($result_t)) {
                                                                ?>

                                                                    <option value="<?php echo $row["contractor_nickname"]; ?>">
                                                                        <?php echo $row["contractor_nickname"]; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                            <!-- <input name="contractor_nickname" type="text" id="contractor_nickname" class="form-control" required /></td> -->
                                                    </tr>



                                                    <tr>
                                                        <td colspan="2" align="center">

                                                            <input type="hidden" name="username" value="<?php echo $username; ?>">
                                                            <!--<input type="submit" name="Submit2" value="สั่งซื้อ" /> -->
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table width="600" border="0" align="center" class="table table-bordered table-striped">
                                                    <tr>
                                                        <td width="1558" colspan="4">
                                                            <strong>ยืนยันการผลิต</strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>สินค้า</td>

                                                        <td align="center">จำนวน</td>

                                                    </tr>
                                                    <?php
                                                    $total = 0;
                                                    $vat = 0;
                                                    $stotal = 0;
                                                    foreach ($_SESSION['production'] as $product_id => $qty) {
                                                        $sale_price = $sale_pricearray[$product_id];
                                                        $sql    = "SELECT * FROM tb_product WHERE product_id=$product_id";
                                                        $query    = mysqli_query($con, $sql);
                                                        $row    = mysqli_fetch_array($query);
                                                        // $sum    = $sale_price * $qty;
                                                        // $total    += $sum;
                                                        // $total1 = $total-$discount;
                                                        // $vat = $total1 * 0.07;
                                                        // $stotal = $total1 + $vat;

                                                        // echo"<input type='text' name='sale_price[$product_id]' value=' $sale_price'>";
                                                        echo "<tr>";
                                                        echo "<td>" . $row["product_name"] . "</td>";
                                                        // echo "<td align='right'>" . number_format($sale_price, 2) . "</td>";
                                                        echo "<td align='right'>$qty</td>";
                                                        // echo "<td align='right'>" . number_format($sum, 2) . "</td>";
                                                        echo "</tr>";
                                                    }
                                                    // echo "<tr>";
                                                    // echo "<td  align='right' colspan='3' ><b>รวม</b></td>";
                                                    // echo "<td align='right' >" . "<b>" . number_format($total, 2) . "</b>" . "</td>";
                                                    // echo "</tr>";
                                                    // echo "<tr>";
                                                    // echo "<td  align='right' colspan='3' ><b>ส่วนลด</b></td>";
                                                    // echo "<td align='right' >" . "<b>" . number_format($discount, 2) . "</b>" . "</td>";
                                                    // echo "</tr>";
                                                    // echo "<td  align='right' colspan='3' ><b>ภาษี</b></td>";
                                                    // echo "<td align='right' >" . "<b>" . number_format($vat, 2) . "</b>" . "</td>";
                                                    // echo "</tr>";
                                                    // echo "<tr>";
                                                    // echo "<td  align='right' colspan='3' ><b>รวมทั้งหมด</b></td>";
                                                    // echo "<td align='right' >" . "<b>" . number_format($stotal, 2) . "</b>" . "</td>";
                                                    // echo "</tr>";
                                                    ?>

                                                </table>
                                                <p>

                                                   
                                                    <center><a href="production_form_add.php" class="btn btn-warning ">กลับหน้ายืนยันการสั่งผลิต</a> &nbsp;&nbsp;<input type="submit" name="Submit2" class="btn btn-success" value="บันทึกการผลิต" /></center>
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