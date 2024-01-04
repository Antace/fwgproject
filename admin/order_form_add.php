<?php include('h.php'); ?>
<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
        <!-- Main Header -->
        <?php include('menutop.php'); ?>
        <?php include('menu_l.php'); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <i class="glyphicon glyphicon-check hidden-xs"></i> <span class="hidden-xs">ข้อมูลการสั่งป้าย</span>
                    <a href="order_form_add.php" class="btn btn-primary btn-sm">เพิ่มใบสั่งป้าย</a>
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


                                        @$slabel_ida = $_POST['label_ida']; //รับค่ารหัสสินค้าจาก order_form_search.php
                                         print_r($_POST);

//  exit;
                                        @$label_ida = mysqli_real_escape_string($con, $_GET['label_ida']);
                                        @$act = mysqli_real_escape_string($con, $_GET['act']);

                                        //print_r($label_ida);
                                        // exit;
                                        if ($act == 'add' && !empty($slabel_ida)) {
                                            if (isset($_SESSION['order'][$slabel_ida])) {
                                                $_SESSION['order'][$slabel_ida]++;
                                            } else {
                                                $_SESSION['order'][$slabel_ida] = 1;
                                            }
                                        }
                                        if ($act == 'remove' && !empty($label_ida))  //ยกเลิกการสั่งซื้อ
                                        {
                                            unset($_SESSION['order'][$label_ida]);
                                        }
                                        if ($act == 'update') {
                                            $amount_array = $_POST['amount'];
                                            foreach ($amount_array as $label_ida => $amount) {
                                                $_SESSION['order'][$label_ida] = $amount;
                                            }
                                           
                                        }
                                        if ($act == 'cancel')  //ยกเลิกการสั่งซื้อ
                                        {
                                            unset($_SESSION['order']);
                                        }
                                        
                                        ?>
                                        <?php
                                        if (@$_GET['do'] == 'f') {
                                            echo '<script type="text/javascript">
                                                swal("", "กรุณาใส่ข้อมูลให้ถูกต้อง !!", "warning");
                                        </script>';
                                            echo '<meta http-equiv="refresh" content="2;url=order.php?act=add" />';
                                        } elseif (@$_GET['do'] == 'd') {
                                            echo '<script type="text/javascript">
                                                swal("", "เลขใบสั่งซื้อซ้ำ กรุณาเปลี่ยน  !!", "error");
                                        </script>';
                                            echo '<meta http-equiv="refresh" content="1;url=order.php?act=add" />';
                                        }
                                        
                                        ?>
                                        <div align="right">
                                            <font color="red">*</font>
                                            <font color="gray">Required Fields</font>
                                        </div>
                                        <hr>
                                        <?php
                                        include "order_form_search.php";
                                        
                                        ?>
                                        <div align="left">
                                            <font color="red">*</font>
                                            <font color="gray">เพิ่มรายการได้แค่ 10 รายการ</font>
                                        </div>
                                        <form id="frmorder" name="frmorder" method="post" action="?act=update">
                                        
                                            <table width="600" border="0" align="center" class="table table-bordered table-striped">

                                                <tr>
                                                <td align="center" width="10">ลำดับ</td>
                                                    <td>รายการ</td>
                                                    <td>แปลง</td>
                                                    <td>โครงการ</td>
                                                    
                                                    <!-- <td align="center">ราคามาตราฐาน</td>
                                                    <td align="center">ราคา<font color='red'>* </font></td> -->
                                                    <td align="center">จำนวน</td>
                                                    <!-- <td align="center">รวม(บาท)</td> -->
                                                    <td align="center">ลบ</td>
                                                </tr>
                                                <?php
                                                $total = 0;
                                                $i=1;
                                                if (!empty($_SESSION['order'])) {
                                                    foreach ($_SESSION['order'] as $label_ida => $qty  ) {
                                                        
                                                        $sql = "SELECT * FROM tb_labeldetail WHERE label_ida=$label_ida";
                                                        
                                                        $query = mysqli_query($con, $sql);
                                                        $row = mysqli_fetch_array($query);
                                                        echo "<tr>";
                                                        echo "<td  align=center width='10'>".  $i++ ."</td>";
                                                        echo "<td width='334'>" . $row["label_numberid"] . "</td>";
                                                        echo "<td width='334'>" . $row["label_place"] . "</td>";
                                                        echo "<td width='334'>" . $row["department_name"] . "</td>";
                                                        
                                                        // echo "<td width='46' align='right'>" . number_format($row["order_price"], 2) . "</td>";
                                                        // echo "<td width='57' align='right'>";
                                                        // echo "<input type='number' class='form-control' style='text-align:right;' name='order_price[$label_ida]' value='$order_price' size='2' Required/></td>";
                                                        echo "<td width='57' align='right'>";
                                                        echo "<input type='number' class='form-control' style='text-align:right;' name='amount[$label_ida]' value='$qty' size='2' min='1' max='1' /></td>";
                                                        // echo "<td width='93' align='right'>" . number_format($sum, 2) . "</td>";
                                                        //remove order
                                                        echo "<td width='46' align='center'><a href='order_form_add.php?label_ida=$label_ida&act=remove'class='btn btn-danger'>ลบ</a></td>";
                                                        echo "</tr>";
                                                    }
                                                    // echo "<tr>";
                                                    // echo "<td colspan='5'  align='right'><b>ราคาก่อน Vat</b></td>";
                                                    // echo "<td align='right' >" . "<input type='decimal' style='text-align:right;' name='order_total' class='form-control' value='$total' Required readonly>". "</td>";
                                                    // echo "<td align='left' >บาท</td>";
                                                    // echo "</tr>";
                                                    // echo "<tr>";
                                                    // echo "<td colspan='5'  align='right'><b>ส่วนลด</b><font color='red'>*ถ้าไม่มีส่วนลดให้ใส่ 0 </font></td>";
                                                    // echo "<td align='right' >" . "<input type='decimal' style='text-align:right;' name='order_discount' class='form-control' value='$discount' Required>" . "</td>";
                                                    // echo "<td align='left' >บาท</td>";
                                                    // echo "</tr>";
                                                    // echo "<tr>";
                                                    // echo "<td colspan='5'  align='right'><b>Vat 7%</b></td>";
                                                    // echo "<td align='right' >" . "<input type='decimal' style='text-align:right;' name='order_vat' class='form-control' value='$vat' Required readonly>" . "</td>";
                                                    // echo "<td align='left' >บาท</td>";
                                                    // echo "</tr>";
                                                    // echo "<tr>";
                                                    // echo "<td colspan='5'  align='right'><b>ราคารวม Vat</b></td>";
                                                    // echo "<td align='right' >" . "<input type='decimal' style='text-align:right;' name='order_stotal' class='form-control' value='$stotal' Required readonly>" . "</td>";
                                                    // echo "<td align='left' >บาท</td>";
                                                    // echo "</tr>";
                                                    // echo "<tr>";
                                                    echo "<td colspan='6' align='right'>";
                                                    echo "<input type='hidden' name='username' value=' $username'>";
                                                    echo "</td>";
                                                    echo "</tr>";
                                                }
                                                ?>
                                                
                                                <tr>
                                                    <td colspan="7" align="right">
                                                        <input type="submit" name="button" id="button" class="btn btn-success btn-sm" value="ยืนยัน" />
                                                        <?php if ($act == 'update') { ?>
                                                            <input type="button" value="สั่งผลิต" class="btn btn-info btn-sm" onClick="this.form.action='order_confirm1.php'; submit()">
                                                            
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                        <!-- /.card-body -->
                                        <a href="order.php" class="btn btn-warning">ปิด</a>
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