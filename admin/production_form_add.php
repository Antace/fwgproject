<?php include('h.php'); ?>

<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
        <!-- Main Header -->
        <?php include('menutop.php'); ?>
        <?php include('menu_l.php'); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <i class="glyphicon glyphicon-check hidden-xs"></i> <span class="hidden-xs">ข้อมูลการผลิต</span>
                    <a href="production_form_add.php" class="btn btn-primary btn-sm">เพิ่มรายการผลิต</a>
                </h1>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="sticky-top mb-12">
                                <div class="card">
                                    <div class="card-body">

                                        <?php
                                        session_start();


                                        $sproduct_id = $_POST['product_id']; //รับค่ารหัสสินค้าจาก production_form_search.php
                                        //  print_r($_POST);

                                        //  exit;
                                        @$product_id = mysqli_real_escape_string($con, $_GET['product_id']);
                                        $act = mysqli_real_escape_string($con, $_GET['act']);

                                        //print_r($product_id);
                                        // exit;
                                        if ($act == 'add' && !empty($sproduct_id)) {
                                            if (isset($_SESSION['production'][$sproduct_id])) {
                                                $_SESSION['production'][$sproduct_id]++;
                                            } else {
                                                $_SESSION['production'][$sproduct_id] = 1;
                                            }
                                        }
                                        if ($act == 'remove' && !empty($product_id))  //ยกเลิกการสั่งซื้อ
                                        {
                                            unset($_SESSION['production'][$product_id]);
                                        }
                                        if ($act == 'update') {
                                            $production_pricearray = $_POST['production_price'];
                                            // foreach($production_pricearray as $product_id => $production_price){
                                            //     $_SESSION['production'][$product_id] = $production_price;
                                            // }

                                            $discount = $_POST['production_discount'];

                                            $amount_array = $_POST['amount'];
                                            foreach ($amount_array as $product_id => $amount) {
                                                $_SESSION['production'][$product_id] = $amount;
                                            }
                                        }
                                        if ($act == 'cancel')  //ยกเลิกการสั่งซื้อ
                                        {
                                            unset($_SESSION['production']);
                                        }
                                        $query2 = "SELECT * FROM tb_customer ORDER BY customer_id asc" or die("Error:" . mysqli_error());
                                        $result2 = mysqli_query($con, $query2);
                                        $row2 = mysqli_fetch_array($result2);
                                        ?>
                                        <?php
                                        if (@$_GET['do'] == 'f') {
                                            echo '<script type="text/javascript">
                                                swal("", "กรุณาใส่ข้อมูลให้ถูกต้อง !!", "warning");
                                        </script>';
                                            echo '<meta http-equiv="refresh" content="2;url=product.php?act=add" />';
                                        } elseif (@$_GET['do'] == 'd') {
                                            echo '<script type="text/javascript">
                                                swal("", "เลขใบสั่งซื้อซ้ำ กรุณาเปลี่ยน  !!", "error");
                                        </script>';
                                            echo '<meta http-equiv="refresh" content="1;url=product.php?act=add" />';
                                        }

                                        ?>
                                        <div align="right">
                                            <font color="red">*</font>
                                            <font color="gray">Required Fields</font>
                                        </div>
                                        <hr>
                                        <?php
                                        include "production_form_search.php";

                                        ?>

                                        <form id="frmproduction" name="frmproduction" method="post" action="?act=update">
                                            <table width="600" border="0" align="center" class="table table-bordered table-striped">

                                                <tr>
                                                    <td>รายการ</td>
                                                    <!-- <td align="center">คงเหลือ</td> -->
                                                    <td align="center">ราคา/หน่วย</td>
                                                    <!-- <td align="center">ราคา<font color='red'>* </font></td> -->
                                                    <td align="center">จำนวนที่สั่งผลิต</td>
                                                    <!-- <td align="center">รวม(บาท)</td> -->
                                                    <td align="center">ลบ</td>
                                                </tr>
                                                <?php
                                                $total = 0;
                                                if (!empty($_SESSION['production'])) {
                                                    foreach ($_SESSION['production'] as $product_id => $qty) {
                                                        $production_price = $production_pricearray[$product_id];
                                                        $sql = "SELECT * FROM tb_product WHERE product_id=$product_id";

                                                        $query = mysqli_query($con, $sql);
                                                        $row = mysqli_fetch_array($query);
                                                        $sum = $production_price * $qty;
                                                        $total += $sum;
                                                        $total1 = $total - $discount;


                                                        $vat = ($total1 * 0.07);
                                                        $stotal = $total1 + $vat;
                                                        $p_qty = $row['product_uom']; //จำนวนสินค้าในสต๊อก
                                                        echo "<tr>";
                                                        echo "<td width='334'>" . $row["product_name"] . "</td>";
                                                        // echo "<td width='20' align='center'>" . $row["product_uom"]  . "</td>";
                                                        // echo "<td width='46' align='right'>" . number_format($row["production_price"], 2) . "</td>";
                                                        echo "<td width='57' align='right'>";
                                                        echo "<input type='number' class='form-control' style='text-align:right;' name='production_price[$product_id]' value='$row[production_price]' size='2' Required/ readonly></td>";
                                                        echo "<td width='57' align='right'>";
                                                        echo "<input type='number' class='form-control' style='text-align:right;' name='amount[$product_id]' value='$qty' size='2' min='1' /></td>";
                                                        // echo "<td width='93' align='right'>" . number_format($sum, 2) . "</td>";
                                                        //remove product
                                                        echo "<td width='46' align='center'><a href='production_form_add.php?product_id=$product_id&act=remove'class='btn btn-danger'>ลบ</a></td>";
                                                        echo "</tr>";
                                                    }
                                                    // echo "<tr>";
                                                    // echo "<td colspan='5'  align='right'><b>ราคาก่อน Vat</b></td>";
                                                    // echo "<td align='right' >" . "<input type='decimal' style='text-align:right;' name='production_total' class='form-control' value='$total' Required readonly>". "</td>";
                                                    // echo "<td align='left' >บาท</td>";
                                                    // echo "</tr>";
                                                    // echo "<tr>";
                                                    // echo "<td colspan='5'  align='right'><b>ส่วนลด</b><font color='red'>*ถ้าไม่มีส่วนลดให้ใส่ 0 </font></td>";
                                                    // echo "<td align='right' >" . "<input type='decimal' style='text-align:right;' name='production_discount' class='form-control' value='$discount' Required>" . "</td>";
                                                    // echo "<td align='left' >บาท</td>";
                                                    // echo "</tr>";
                                                    // echo "<tr>";
                                                    // echo "<td colspan='5'  align='right'><b>Vat 7%</b></td>";
                                                    // echo "<td align='right' >" . "<input type='decimal' style='text-align:right;' name='production_vat' class='form-control' value='$vat' Required readonly>" . "</td>";
                                                    // echo "<td align='left' >บาท</td>";
                                                    // echo "</tr>";
                                                    // echo "<tr>";
                                                    // echo "<td colspan='5'  align='right'><b>ราคารวม Vat</b></td>";
                                                    // echo "<td align='right' >" . "<input type='decimal' style='text-align:right;' name='production_stotal' class='form-control' value='$stotal' Required readonly>" . "</td>";
                                                    // echo "<td align='left' >บาท</td>";
                                                    // echo "</tr>";
                                                    // echo "<tr>";
                                                    echo "<td colspan='4' align='right'>";
                                                    echo "<input type='hidden' name='username' value=' $username'>";
                                                    echo "</td>";
                                                    echo "</tr>";
                                                }
                                                ?>

                                                <tr>
                                                    <td colspan="7" align="right">
                                                        <input type="submit" name="button" id="button" class="btn btn-success btn-sm" value="ปรับปรุง" />
                                                        <?php if ($act == 'update') { ?>
                                                            <input type="button" value="สั่งผลิต" class="btn btn-info btn-sm" onClick="this.form.action='production_confirm.php'; submit()">

                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                        <!-- /.card-body -->
                                        <a href="production.php" class="btn btn-warning">ปิด</a>
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

    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
    <?php include('footer.php'); ?>

    </html>
    <?php include('footerjs.php'); ?>