<?php
session_start();
$wagerecord_pricearray =  $_POST['wage_price'];
$wagerecord_status = $_POST['wagerecord_status'];
print_r($_POST);

include("../condb.php");
$sql2 = "SELECT * FROM tb_contractor
ORDER BY contractor_id DESC" or die("Error:" . mysqli_error($discount));
$result_t = mysqli_query($con, $sql2) or die("Error in query: $sql " . mysqli_error($con));


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
                    <i class="glyphicon glyphicon-check hidden-xs"></i> <span class="hidden-xs">รายละเอียดการสั่งผลิต</span>
                    <!-- <a href="wage.php?act=add" class="btn btn-primary btn-sm">เพิ่มสินค้า</a> -->
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
                                            <form id="frmwagerecord" name="frmwagerecord" method="post" action="wagerecord_db.php">
                                            <table border="0" cellspacing="0" align="center" class="table table-bordered table-striped">
                                                    <tr>
                                                        <td colspan="2">เลือกข้อมูลผู้รับเหมา</td>
                                                    </tr>
                                                    <tr>
                                                        <td>วันที่ : <font color="red">*</font></td>
                                                        <td> <input type="date" name="wagerecord_date" value="<?php echo (new DateTime())->format('Y-m-d'); ?>" required class="form-control"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>ชื่อผู้รับเหมา : <font color="red">*</font></td>
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
                                                            <strong>รายการที่สั่งผลิต</strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>รายการ</td>
                                                        <td align="center">ราคา/หน่วย</td>
                                                        <td align="center">จำนวนที่สั่งผลิต</td>

                                                    </tr>
                                                    <?php
                                                    $total = 0;
                                                    $vat = 0;
                                                    $stotal = 0;
                                                    foreach ($_SESSION['wagerecord'] as $wage_id => $qty) {
                                                        $wagerecord_price = $wagerecord_pricearray[$wage_id];
                                                        $sql    = "SELECT * FROM tb_wage WHERE wage_id=$wage_id";
                                                        $query    = mysqli_query($con, $sql);
                                                        $row    = mysqli_fetch_array($query);
                                                        // $sum    = $sale_price * $qty;
                                                        // $total    += $sum;
                                                        // $total1 = $total-$discount;
                                                        // $vat = $total1 * 0.07;
                                                        // $stotal = $total1 + $vat;

                                                        echo"<input type='text' name='wage_price[$wage_id]' value=' $wagerecord_price'>";
                                                        echo"<input type='text' name='wagerecord_status' value=' $wagerecord_status'>";
                                                        echo "<tr>";
                                                        echo "<td>" . $row["wage_name"] . "</td>";
                                                        echo "<td align='right'>" . number_format($wagerecord_price, 2) . "</td>";
                                                        echo "<td align='right'>". number_format($qty,2) ."</td>";
                                                        // echo "<td align='right'>" . number_format($sum, 2) . "</td>";
                                                        echo "</tr>";
                                                    }
                                                    
                                                    ?>

                                                </table>
                                                <p>

                                                   
                                                    <center><a href="wagerecord_form_add.php" class="btn btn-warning ">กลับหน้ายืนยันการสั่งผลิต</a> &nbsp;&nbsp;<input type="submit" name="Submit2" class="btn btn-success" value="บันทึก" /></center>
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