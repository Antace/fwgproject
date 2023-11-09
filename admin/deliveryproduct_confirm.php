<?php
session_start();

// print_r($_POST);

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
                                            <form id="frmdelivery" name="frmdelivery" method="post" action="deliveryproduct_db.php">
                                                <table border="0" cellspacing="0" align="center" class="table table-bordered table-striped">
                                                    <tr>
                                                        <td colspan="2">เลือกข้อมูลลูกค้า</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            วันที่ : <font color="red">*</font>
                                                        </td>
                                                        <td>
                                                            <input type="date" name="delivery_date" value="<?php echo (new DateTime())->format('Y-m-d'); ?>" required class="form-control">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>ชื่อลูกค้า : <font color="red">*</font>
                                                        </td>
                                                        <td><select class="select2bs4" data-placeholder="เลือกรายการ" name="customer_name" style="width: 100%;">
                                                                <option value="-">-</option>
                                                                <option value="ไม่ระบุ">ไม่ระบุ</option>
                                                                <?php

                                                                while ($row3 = mysqli_fetch_array($result_t)) {
                                                                ?>
                                                                    <option value="<?php echo $row3["customer_name"]; ?>"><?php echo $row3["customer_name"]; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>

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
                                                            <input type="hidden" name="username" value="<?php echo $username; ?>">
                                                            <!--<input type="submit" name="Submit2" value="สั่งซื้อ" /> -->
                                                        </td>
                                                    </tr>
                                                </table>




                                                <table width="600" border="0" align="center" class="table table-bordered table-striped">
                                                    <tr>
                                                        <td width="1558" colspan="4">
                                                            <strong>ยืนยันรายการ</strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>สินค้า</td>

                                                        <td align="center">จำนวน</td>

                                                    </tr>
                                                    <?php

                                                    foreach ($_SESSION['delivery'] as $product_id => $qty) {

                                                        $sql    = "SELECT * FROM tb_product WHERE product_id=$product_id";
                                                        $query    = mysqli_query($con, $sql);
                                                        $row    = mysqli_fetch_array($query);



                                                        echo "<tr>";
                                                        echo "<td>" . $row["product_name"] . "</td>";

                                                        echo "<td align='right'>$qty</td>";

                                                        echo "</tr>";
                                                    }

                                                    ?>

                                                </table>
                                                <p>

                                                    <center><a href="delivery_form_add1.php" class="btn btn-warning ">กลับหน้ายืนยันการสั่งซื้อ</a> &nbsp;&nbsp;<input type="submit" name="Submit2" class="btn btn-success" value="สั่งซื้อ" /></center>
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