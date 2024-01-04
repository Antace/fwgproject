<?php include('h.php'); ?>

<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
        <!-- Main Header -->
        <?php include('menutop.php'); ?>
        <?php include('menu_l.php'); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <i class="glyphicon glyphicon-check hidden-xs"></i> <span class="hidden-xs">บันทึกค่าแรง</span>
                    <a href="wagerecord_form_add.php" class="btn btn-primary btn-sm">เพิ่ม</a>
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


                                        $swage_id = $_POST['wage_id']; //รับค่ารหัสสินค้าจาก wagerecord_form_search.php
                                        //  print_r($_POST);

                                        //  exit;
                                        @$wage_id = mysqli_real_escape_string($con, $_GET['wage_id']);
                                        $act = mysqli_real_escape_string($con, $_GET['act']);

                                        //print_r($wage_id);
                                        // exit;
                                        if ($act == 'add' && !empty($swage_id)) {
                                            if (isset($_SESSION['wagerecord'][$swage_id])) {
                                                $_SESSION['wagerecord'][$swage_id]++;
                                            } else {
                                                $_SESSION['wagerecord'][$swage_id] = 1;
                                            }
                                        }
                                        if ($act == 'remove' && !empty($wage_id))  //ยกเลิกการสั่งซื้อ
                                        {
                                            unset($_SESSION['wagerecord'][$wage_id]);
                                        }
                                        if ($act == 'update') {
                                            $wagerecord_pricearray = $_POST['wagerecord_price'];
                                            // foreach($wagerecord_pricearray as $wage_id => $wagerecord_price){
                                            //     $_SESSION['wagerecord'][$wage_id] = $wagerecord_price;
                                            // }

                                            $discount = $_POST['wagerecord_discount'];

                                            $amount_array = $_POST['amount'];
                                            foreach ($amount_array as $wage_id => $amount) {
                                                $_SESSION['wagerecord'][$wage_id] = $amount;
                                            }
                                        }
                                        if ($act == 'cancel')  //ยกเลิกการสั่งซื้อ
                                        {
                                            unset($_SESSION['wagerecord']);
                                        }
                                       
                                        ?>
                                        <?php
                                        if (@$_GET['do'] == 'f') {
                                            echo '<script type="text/javascript">
                                                swal("", "กรุณาใส่ข้อมูลให้ถูกต้อง !!", "warning");
                                        </script>';
                                            echo '<meta http-equiv="refresh" content="2;url=wage.php?act=add" />';
                                        } elseif (@$_GET['do'] == 'd') {
                                            echo '<script type="text/javascript">
                                                swal("", "เลขใบสั่งซื้อซ้ำ กรุณาเปลี่ยน  !!", "error");
                                        </script>';
                                            echo '<meta http-equiv="refresh" content="1;url=wage.php?act=add" />';
                                        }

                                        ?>
                                        <div align="right">
                                            <font color="red">*</font>
                                            <font color="gray">Required Fields</font>
                                        </div>
                                        <hr>
                                        <?php
                                        include "wagerecord_form_search.php";

                                        ?>

                                        <form id="frmwagerecord" name="frmwagerecord" method="post" action="?act=update">
                                            <table width="600" border="0" align="center" class="table table-bordered table-striped">

                                                <tr>
                                                    <td>รายการ</td>
                                                    <!-- <td align="center">คงเหลือ</td> -->
                                                    <td align="center">ราคา/หน่วย</td>
                                                    <!-- <td align="center">ราคา<font color='red'>* </font></td> -->
                                                    <td align="center">จำนวนที่ทำ</td>
                                                    <!-- <td align="center">รวม(บาท)</td> -->
                                                    <td align="center">ลบ</td>
                                                </tr>
                                                <?php
                                                $total = 0;
                                                if (!empty($_SESSION['wagerecord'])) {
                                                    foreach ($_SESSION['wagerecord'] as $wage_id => $qty) {
                                                        $wagerecord_price = $wagerecord_pricearray[$wage_id];
                                                        $sql = "SELECT * FROM tb_wage WHERE wage_id=$wage_id";

                                                        $query = mysqli_query($con, $sql);
                                                        $row = mysqli_fetch_array($query);
                                                        $sum = $wagerecord_price * $qty;
                                                        $total += $sum;
                                                        $total1 = $total - $discount;


                                                        $vat = ($total1 * 0.07);
                                                        $stotal = $total1 + $vat;
                                                        $p_qty = $row['wage_uom']; //จำนวนสินค้าในสต๊อก
                                                        echo "<tr>";
                                                        echo "<td width='334'>" . $row["wage_name"] . "</td>";
                                                        // echo "<td width='20' align='center'>" . $row["wage_uom"]  . "</td>";
                                                        // echo "<td width='46' align='right'>" . number_format($row["wagerecord_price"], 2) . "</td>";
                                                        echo "<td width='57' align='right'>";
                                                        echo "<input type='number' class='form-control' style='text-align:right;' name='wage_price[$wage_id]' value='$row[wage_price]' size='2' Required/ readonly></td>";
                                                        echo "<td width='57' align='right'>";
                                                        echo "<input type='number' class='form-control' style='text-align:right;' name='amount[$wage_id]' value='$qty' size='2' min='1' /></td>";
                                                        
                                                        echo "<input type='number' class='form-control' style='text-align:right;' name='wagerecord_status' value='0' size='2' Required/ readonly>";
                                                        // echo "<td width='93' align='right'>" . number_format($sum, 2) . "</td>";
                                                        //remove wage
                                                        echo "<td width='46' align='center'><a href='wagerecord_form_add.php?wage_id=$wage_id&act=remove'class='btn btn-danger'>ลบ</a></td>";
                                                        echo "</tr>";
                                                    }
                                                    // echo "<tr>";
                                                    // echo "<td colspan='5'  align='right'><b>ราคาก่อน Vat</b></td>";
                                                    // echo "<td align='right' >" . "<input type='decimal' style='text-align:right;' name='wagerecord_total' class='form-control' value='$total' Required readonly>". "</td>";
                                                    // echo "<td align='left' >บาท</td>";
                                                    // echo "</tr>";
                                                    // echo "<tr>";
                                                    // echo "<td colspan='5'  align='right'><b>ส่วนลด</b><font color='red'>*ถ้าไม่มีส่วนลดให้ใส่ 0 </font></td>";
                                                    // echo "<td align='right' >" . "<input type='decimal' style='text-align:right;' name='wagerecord_discount' class='form-control' value='$discount' Required>" . "</td>";
                                                    // echo "<td align='left' >บาท</td>";
                                                    // echo "</tr>";
                                                    // echo "<tr>";
                                                    // echo "<td colspan='5'  align='right'><b>Vat 7%</b></td>";
                                                    // echo "<td align='right' >" . "<input type='decimal' style='text-align:right;' name='wagerecord_vat' class='form-control' value='$vat' Required readonly>" . "</td>";
                                                    // echo "<td align='left' >บาท</td>";
                                                    // echo "</tr>";
                                                    // echo "<tr>";
                                                    // echo "<td colspan='5'  align='right'><b>ราคารวม Vat</b></td>";
                                                    // echo "<td align='right' >" . "<input type='decimal' style='text-align:right;' name='wagerecord_stotal' class='form-control' value='$stotal' Required readonly>" . "</td>";
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
                                                        <input type="submit" name="button" id="button" class="btn btn-success btn-sm" value="ยืนยัน" />
                                                        <?php if ($act == 'update') { ?>
                                                            <input type="button" value="สั่งผลิต" class="btn btn-info btn-sm" onClick="this.form.action='wagerecord_confirm.php'; submit()">

                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                        <!-- /.card-body -->
                                        <a href="wagerecord.php" class="btn btn-warning">ปิด</a>
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