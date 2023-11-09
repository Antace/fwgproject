<?php include('h.php'); ?>

<body class="hold-transition skin-purple sidebar-mini">
  <div class="wrapper">
    <!-- Main Header -->
    <?php include('menutop.php'); ?>
    <?php include('menu_l.php'); ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <i class="glyphicon glyphicon-check hidden-xs"></i> <span class="hidden-xs">บันทึกการจ่ายเงิน</span>
          <a href="payment_form_add.php" class="btn btn-primary btn-sm">เพิ่ม</a>
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
                    $contractor_nickname = $_POST['contractor_nickname'];
                    $d_s = (isset($_POST['d_s']) ? $_POST['d_s'] : '');
                    $d_e = (isset($_POST['d_e']) ? $_POST['d_e'] : '');
                    
                    if ($contractor_nickname and $d_s and $d_e != '') {
                      include('payment_list_show.php');
                      include('footerjs.php');
                      exit;
                    }

                    if ($act == 'add' && !empty($slabel_ida)) {
                      if (isset($_SESSION['order'][$slabel_ida])) {
                          $_SESSION['order'][$slabel_ida]++;
                      } else {
                          $_SESSION['order'][$slabel_ida] = 1;
                      }
                  }

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
                    <!-- <form action="labeldetail_form_add_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                      <div class="form-group">
                        <div class="col-sm-2 control-label">
                          วันที่ทำรายการ : <font color="red">*</font>
                        </div>
                        <div class="col-sm-2">
                          <input type="date" name="payment_date" required class="form-control">
                        </div>
                      </div> -->


                      <?php include('payment_form_search.php'); ?>



                      <form id="frmpayment" name="frmpayment" method="post" action="?act=update">
                        <table width="600" border="0" align="center" class="table table-bordered table-striped">

                          <tr>
                            <td>รายการ</td>
                            <!-- <td align="center">คงเหลือ</td> -->
                            <td align="center">ราคา/หน่วย</td>
                            <!-- <td align="center">ราคา<font color='red'>* </font></td> -->
                            <td align="center">จำนวนที่ผลิต</td>
                            <!-- <td align="center">รวม(บาท)</td> -->
                            <td align="center">ลบ</td>
                          </tr>
                          <?php
                          $total = 0;
                          if (!empty($_SESSION['payment'])) {
                            foreach ($_SESSION['payment'] as $product_id => $qty) {
                              $payment_price = $payment_pricearray[$product_id];
                              $sql = "SELECT * FROM tb_product WHERE product_id=$product_id";

                              $query = mysqli_query($con, $sql);
                              $row = mysqli_fetch_array($query);
                              $sum = $payment_price * $qty;
                              $total += $sum;
                              $total1 = $total - $discount;


                              $vat = ($total1 * 0.07);
                              $stotal = $total1 + $vat;
                              $p_qty = $row['product_uom']; //จำนวนสินค้าในสต๊อก
                              echo "<tr>";
                              echo "<td width='334'>" . $row["product_name"] . "</td>";
                              // echo "<td width='20' align='center'>" . $row["product_uom"]  . "</td>";
                              // echo "<td width='46' align='right'>" . number_format($row["payment_price"], 2) . "</td>";
                              echo "<td width='57' align='right'>";
                              echo "<input type='number' class='form-control' style='text-align:right;' name='payment_price[$product_id]' value='$row[payment_price]' size='2' Required/ readonly></td>";
                              echo "<td width='57' align='right'>";
                              echo "<input type='number' class='form-control' style='text-align:right;' name='amount[$product_id]' value='$qty' size='2' min='1' /></td>";
                              // echo "<td width='93' align='right'>" . number_format($sum, 2) . "</td>";
                              //remove product
                              echo "<td width='46' align='center'><a href='payment_form_add.php?product_id=$product_id&act=remove'class='btn btn-danger'>ลบ</a></td>";
                              echo "</tr>";
                            }
                            // echo "<tr>";
                            // echo "<td colspan='5'  align='right'><b>ราคาก่อน Vat</b></td>";
                            // echo "<td align='right' >" . "<input type='decimal' style='text-align:right;' name='payment_total' class='form-control' value='$total' Required readonly>". "</td>";
                            // echo "<td align='left' >บาท</td>";
                            // echo "</tr>";
                            // echo "<tr>";
                            // echo "<td colspan='5'  align='right'><b>ส่วนลด</b><font color='red'>*ถ้าไม่มีส่วนลดให้ใส่ 0 </font></td>";
                            // echo "<td align='right' >" . "<input type='decimal' style='text-align:right;' name='payment_discount' class='form-control' value='$discount' Required>" . "</td>";
                            // echo "<td align='left' >บาท</td>";
                            // echo "</tr>";
                            // echo "<tr>";
                            // echo "<td colspan='5'  align='right'><b>Vat 7%</b></td>";
                            // echo "<td align='right' >" . "<input type='decimal' style='text-align:right;' name='payment_vat' class='form-control' value='$vat' Required readonly>" . "</td>";
                            // echo "<td align='left' >บาท</td>";
                            // echo "</tr>";
                            // echo "<tr>";
                            // echo "<td colspan='5'  align='right'><b>ราคารวม Vat</b></td>";
                            // echo "<td align='right' >" . "<input type='decimal' style='text-align:right;' name='payment_stotal' class='form-control' value='$stotal' Required readonly>" . "</td>";
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
                                <input type="button" value="สั่งผลิต" class="btn btn-info btn-sm" onClick="this.form.action='payment_confirm.php'; submit()">

                              <?php } ?>
                            </td>
                          </tr>
                        </table>
                      </form>
                      <!-- /.card-body -->
                      <a href="payment.php" class="btn btn-warning">ปิด</a>
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