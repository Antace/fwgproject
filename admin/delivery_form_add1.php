<?php include('h.php'); ?>

<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
        <!-- Main Header -->
        <?php include('menutop.php'); ?>
        <?php include('menu_l.php'); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <i class="glyphicon glyphicon-check hidden-xs"></i> <span class="hidden-xs">ใบส่งของ (ผู้รับเหมา)</span>
                    <a href="delivery_form_add1.php" class="btn btn-primary btn-sm">เพิ่ม</a>
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


                                        $sproduct_id = $_POST['product_id']; //รับค่ารหัสสินค้าจาก delivery_form_search.php
                                        //  print_r($_POST);

//  exit;
                                        @$product_id = mysqli_real_escape_string($con, $_GET['product_id']);
                                        $act = mysqli_real_escape_string($con, $_GET['act']);

                                        //print_r($product_id);
                                        // exit;
                                        if ($act == 'add' && !empty($sproduct_id)) {
                                            if (isset($_SESSION['delivery'][$sproduct_id])) {
                                                $_SESSION['delivery'][$sproduct_id]++;
                                            } else {
                                                $_SESSION['delivery'][$sproduct_id] = 1;
                                            }
                                        }
                                        if ($act == 'remove' && !empty($product_id))  //ยกเลิกการสั่งซื้อ
                                        {
                                            unset($_SESSION['delivery'][$product_id]);
                                        }
                                        if ($act == 'update') {
                                            $delivery_pricearray=$_POST['delivery_price'];
                                            // foreach($delivery_pricearray as $product_id => $delivery_price){
                                            //     $_SESSION['delivery'][$product_id] = $delivery_price;
                                            // }
                                            // $vat=$_POST['delivery_vat'];
                                            $discount=$_POST['delivery_discount'];
                                            
                                            $amount_array = $_POST['amount'];
                                            foreach ($amount_array as $product_id => $amount) {
                                                $_SESSION['delivery'][$product_id] = $amount;
                                            }
                                           
                                        }
                                        if ($act == 'cancel')  //ยกเลิกการสั่งซื้อ
                                        {
                                            unset($_SESSION['delivery']);
                                        }
                                        $query2 = "SELECT * FROM tb_customer ORDER BY customer_id asc" or die("Error:" . mysqli_error($con));
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
                                        include "delivery_form_search.php";
                                        ?>

                                        <form id="frmdelivery" name="frmdelivery" method="post" action="?act=update">
                                            <table width="600" border="0" align="center" class="table table-bordered table-striped table-sm">

                                                <tr>
                                                    <td>เลขที่</td>
                                                    <td>รายการ</td>
                                                    <td>สถานที่จัดเก็บ</td>
                                                    <td align="center">คงเหลือ</td>
                                                    <td align="center">ราคามาตราฐาน</td>
                                                    <td align="center">ราคา<font color='red'>* </font></td>
                                                    
                                                    <td align="center">จำนวน</td>
                                                    <td align="center">รวม(บาท)</td>
                                                    <td align="center">ลบ</td>
                                                </tr>
                                                <?php
                                                $total = 0;
                                                if (!empty($_SESSION['delivery'])) {
                                                    foreach ($_SESSION['delivery'] as $product_id => $qty  ) {
                                                        $delivery_price = $delivery_pricearray[$product_id];
                                                        $sql = "SELECT * FROM tb_product WHERE product_id=$product_id";
                                                        
                                                        $query = mysqli_query($con, $sql);
                                                        $row = mysqli_fetch_array($query);
                                                        $sum = $delivery_price * $qty;
                                                        $total += $sum;
                                                        $total1 = $total-$discount;
                                                        
                                                        
                                                        $vat = ($total1 * 0.07);
                                                        $stotal = $total1 + $vat;
                                                        $p_qty = $row['product_uom']; //จำนวนสินค้าในสต๊อก
                                                        echo "<tr>";
                                                        echo "<td width='57' align='right'>";
                                                        echo "<input type='text' class='form-control' style='text-align:left;' name='delivery_po[$product_id]' value=''  /></td>";
                                                        echo "<td width='200'>" . $row["product_name"] . "</td>";
                                                        echo "<td width='100'>" . $row["location_name"] . "</td>";
                                                        echo "<td width='20' align='center'>" . $row["product_uom"]  . "</td>";
                                                        echo "<td width='46' align='right'>" . number_format($row["product_price"], 2) . "</td>";
                                                        echo "<td width='57' align='right'>";
                                                        echo "<input type='number' class='form-control' style='text-align:right;' name='delivery_price[$product_id]' value='$delivery_price' size='2' Required/></td>";
                                                       
                                                        echo "<td width='57' align='right'>";
                                                        echo "<input type='number' class='form-control' style='text-align:right;' name='amount[$product_id]' value='$qty' size='2' min='1' max='$p_qty'/></td>";
                                                        echo "<td width='93' align='right'>" . number_format($sum, 2) . "</td>";
                                                        //remove product
                                                        echo "<td width='46' align='center'><a href='delivery_form_add1.php?product_id=$product_id&act=remove'class='btn btn-danger'>ลบ</a></td>";
                                                        echo "</tr>";
                                                    }
                                                    
                                                    echo "<tr>";
                                                    echo "<td colspan='9' align='right'>";
                                                    echo "<input type='hidden' name='username' value=' $username'>";
                                                    echo "</td>";
                                                    echo "</tr>";
                                                }
                                                ?>
                                                
                                                <tr>
                                                    <td colspan="9" align="right">
                                                        <input type="submit" name="button" id="button" class="btn btn-success btn-sm" value="ยืนยัน" />
                                                        <?php if ($act == 'update') { ?>
                                                            <input type="button" value="บันทึก" class="btn btn-info btn-sm" onClick="this.form.action='deliveryproduct_confirm.php'; submit()">
                                                            
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                        <hr>
                                        <!-- /.card-body -->
                                        <a href="delivery.php" class="btn btn-warning">ปิด</a>
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