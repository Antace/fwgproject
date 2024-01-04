<?php include('h.php'); ?>

<body class="hold-transition skin-purple sidebar-mini">
  <div class="wrapper">
    <!-- Main Header -->
    <?php include('menutop.php'); ?>
    <?php include('menu_l.php'); ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <i class="glyphicon glyphicon-check hidden-xs"></i> <span class="hidden-xs">บันทึกรายการผลิต</span>
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

                    $query3 = "SELECT * FROM tb_production GROUP BY contractor_nickname" or die("Error:" . mysqli_error($con));
                    $result3 = mysqli_query($con, $query3);

                    $contractor_nickname = $_POST['contractor_nickname']; //รับค่ารหัสสินค้าจาก production_form_search.php
                    $d_s = $_POST['d_s']; //ตัวแปรวันที่เริ่มต้น
                    $d_e = $_POST['d_e']; //ตัวแปรวันที่สิ้นสุด

                    //  print_r($_POST);

                    //  exit;

                    $act = mysqli_real_escape_string($con, $_GET['act']);

                    if ($contractor_nickname and $d_s and $d_e != '') {
                      echo '<form action="payment_form_add.php" method="post" class="form-horizontal">';
                      echo '<div class="col-sm-6">';
                      echo '<div class="form-group">';
                      echo 'ผู้รับเหมา : <font color="red">*</font>';
                      echo '<select class="select2bs4"  name="contractor_nickname" style="width: 100%;" required>';
                      echo '<option value="' . $contractor_nickname . '">' . $contractor_nickname . '</option>';
                      foreach ($result3 as $results) {
                        echo '<option value="' . $results["contractor_nickname"] . '">
                               ' . $results["contractor_nickname"] . ' 
                            </option>';
                      }
                      echo '</select>';
                      echo '</div>';
                      echo '</div>';
                      echo '<div class="row">';
                      echo '<div class="col-md-9">';
                      echo '<div class="row">';

                      echo '<div class="col-1">จ่ายช่วงวันที่</div>';
                      echo '<div class="col-2">';
                      echo '<div class="form-group">';
                      echo '<input type="date" name="d_s" value="' . $d_s . '" class="form-control" />';
                      echo '</div>';
                      echo '</div>';

                      echo '<div class="col-1">ถึง</div>';
                      echo '<div class="col-2">';
                      echo '<div class="form-group">';
                      echo '<input type="date" name="d_e" value="' . $d_e . '" class="form-control" />';
                      echo '</div>';
                      echo '</div>';
                      echo '<div class="col-sm-1">';
                      echo '<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> </button></a>';


                      echo '</div>';

                      echo '</div>';
                      echo '</div>';

                      echo '</div>';
                      echo '</form>';



                      // echo "<input type='hidden' class= 'form-control' name = 'contractor_nickname' value = '$contractor_nickname' readonly>";
                      $query = "SELECT tb_productionlist.*,tb_production.*,tb_product.*,SUM(production_uom) as total FROM tb_productionlist 
                      LEFT JOIN tb_production ON tb_productionlist.production_id = tb_production.production_id
                      LEFT JOIN tb_product ON tb_productionlist.product_id = tb_product.product_id
                      WHERE (contractor_nickname = '$contractor_nickname' AND production_date BETWEEN '$d_s' AND '$d_e' AND production_status = '0')
                      GROUP BY product_name " or die("$query -> Error :" . mysqli_error($con));

                      $result = mysqli_query($con, $query);

                    ?>
                      <form id="frmproduction" name="frmproduction" method="post" action="payment_db.php">
                        วันที่ทำรายการ :
                        <div class='row'>
                          <div class='col-3'>
                            <input type='date' class='form-control' name='payment_date' value='<?php echo (new DateTime())->format('Y-m-d'); ?>'><br>
                          </div>
                        </div>
                        <input type='hidden' class='form-control' name='contractor_nickname' value='<?php echo $contractor_nickname; ?>' readonly>
                        <input type='hidden' class='form-control' name='d_s' value='<?php echo $d_s; ?>' readonly>
                        <input type='hidden' class='form-control' name='d_e' value='<?php echo $d_e; ?>' readonly>
                        <table class="table table-bordered table-striped">
                          <thead>
                            <tr class='' align='center'>
                              <th width='3%'>ลำดับ</th>
                              <th width='25%'>รายการ</th>
                              <th width='8%'>ราคา/หน่วย</th>
                              <th width='8%'>จำนวนที่ผลิต</th>
                              <th width='7%'>หน่วย</th>
                              <th width='7%'>รวม</th>

                            </tr>
                          </thead>
                        <?php
                        $i = 1;

                        while ($row = mysqli_fetch_array($result)) {
                          $total = $row['total'] * $row['production_price'];
                          $sum += $total;
                          $vat = $sum * 0.03;
                          $balance = $sum - $vat;
                          echo "<tr>";
                          echo "<td align=center>" . $i++  . "</td> ";
                          echo "<td >" . $row["product_name"] . "</td> ";
                          echo "<td width='57' align='right'>";
                          echo "<input type='number' class='form-control' style='text-align:right;' name='production_price[]' value='$row[production_price]' size='2' Required/ readonly></td>";
                          echo "<td width='57' align='right'>";
                          echo "<input type='number' class='form-control' style='text-align:right;' name='production_uom[]' value='$row[total]' size='2' Required/ readonly></td>";


                          echo "<td align=center>" . $row["product_unit"] . "</td> ";
                          echo "<input type = 'text' class ='form-control' name = 'production_id[]' value ='$row[production_id]' >";
                          
                          echo "<td width='57' align='right'>";
                          echo "<input type='number' class='form-control' style='text-align:right;' name='payment_price[]' value='$total' size='2' Required/ readonly></td>";


                          echo "</tr>";
                        }
                        echo "</table>";


                        //test
                        $query6 = "SELECT tb_wagerecordlist.*,tb_wagerecord.*,tb_wage.*,SUM(wagerecord_uom) as total FROM tb_wagerecordlist 
                        LEFT JOIN tb_wagerecord ON tb_wagerecordlist.wagerecord_id = tb_wagerecord.wagerecord_id
                        LEFT JOIN tb_wage ON tb_wagerecordlist.wage_id = tb_wage.wage_id
                        WHERE (contractor_nickname = '$contractor_nickname' AND wagerecord_date BETWEEN '$d_s' AND '$d_e' AND wagerecord_status = '0')
                        GROUP BY wage_name " or die("$query6 -> Error :" . mysqli_error($con));

                        $result6 = mysqli_query($con, $query6);

                        echo "<table   class='table table-bordered table-striped'>";
                        echo "<thead>";
                        echo "<tr class='' align ='center'>";
                        echo "<th width='3%'>ลำดับ</th>";
                        echo "<th width='25%'>รายการ</th>";
                        echo "<th width='25%'>ราคา</th>";
                        echo "<th width='8%'>จำนวนที่ผลิต</th>";
                        echo "<th width='7%'>รวม</th>";
                        echo "</tr>";
                        echo "</thead>";

                        $b = 1;

                        while ($row6 = mysqli_fetch_array($result6)) {
                          $total6 = $row6['total'] * $row6['wage_price'];
                          $sum6 += $total6;
                          $vat6 = $sum6 * 0.03;
                          $balance6 = $sum6 - $vat6;
                          echo "<tr>";
                          echo "<td align=center>" . $b++  . "</td> ";
                          echo "<td >" . $row6["wage_name"] . "</td> ";
                          echo "<td width='57' align='right'>";
                          echo "<input type='number' class='form-control' style='text-align:right;' name='wagerecord_price[]' value='$row6[wage_price]' size='2' Required/ readonly></td>";
                          echo "<td width='57' align='right'>";
                          echo "<input type='number' class='form-control' style='text-align:right;' name='wagerecord_uom[]' value='$row6[total]' size='2' Required/ readonly></td>";


                          
                          echo "<input type = 'text' class ='form-control' name = 'wagerecord_id[]' value ='$row6[wagerecord_id]' >";
                          
                          echo "<td width='57' align='right'>";
                          echo "<input type='number' class='form-control' style='text-align:right;' name='payment_price[]' value='$total6' size='2' Required/ readonly></td>";


                          echo "</tr>";
                        }
                        echo "</table>";

                        //close test

                        $query1 = "SELECT * FROM tb_rexpenses WHERE (contractor_nickname = '$contractor_nickname' AND rexpenses_date BETWEEN '$d_s' AND '$d_e' AND 	rexpenses_status ='0')";
                        $result1 = mysqli_query($con, $query1);

                        echo "<table   class='table table-bordered table-striped'>";
                        echo "<thead>";
                        echo "<tr class='' align ='center'>";
                        echo "<th width='3%'>ลำดับ</th>";
                        echo "<th width='25%'>เลขที่ใบงาน</th>";
                        echo "<th width='25%'>รายการ</th>";
                        echo "<th width='8%'>จำนวนเงิน</th>";
                        echo "</tr>";
                        echo "</thead>";

                        $a = 1;
                        while ($row1 = mysqli_fetch_array($result1)) {
                          $rexpensestotal += $row1['rexpenses_uom'];
                          echo "<tr>";
                          echo "<td align=center>" . $a++  . "</td> ";
                          echo "<td >" . $row1["rexpenses_id"] . "</td> ";
                          echo "<td >" . $row1["expenses_name"] . "</td> ";
                          echo "<td width='57' align='right'>";
                          echo "<input type='number' class='form-control' style='text-align:right;' name='rexpenses_uom[]' value='$row1[rexpenses_uom]' size='2' Required/ readonly></td>";
                          echo "<input type = 'hidden' class ='form-control' name = 'rexpenses_id[]' value ='$row1[rexpenses_id]' >";


                          echo "</tr>";
                        }
                        $sumtotal = $sum + $sum6;
                        $vattotal = $sumtotal * 0.03;
                        $balancetotal = $sumtotal - $vattotal;
                        $final = $balancetotal - $rexpensestotal;
                        echo "<tr>";


                        echo "</table>";
                        echo "<div class='row' >";
                        echo "<div class='col-8'></div>";
                        echo "<div class='col-2'>" . "<b><p style ='text-align: right;'>" . "จำนวนเงินรวม : " . "</p></b>" . "</div>";
                        echo "<div class='col-2'>" . "<b><p style ='text-align: right;'>" . number_format($sumtotal, 2) . "</p></b>" . "</div>";
                        echo "</div>";

                        echo "<div class='row' >";
                        echo "<div class='col-8'></div>";
                        echo "<div class='col-2'>" . "<b><p style ='text-align: right;'>" . "หัก 3% : " . "</p></b>" . "</div>";
                        echo "<div class='col-2'>" . "<b><p style ='text-align: right;'>" . number_format($vattotal, 2) . "</p></b>" . "</div>";
                        echo "</div>";

                        echo "<div class='row' >";
                        echo "<div class='col-8'></div>";
                        echo "<div class='col-2'>" . "<b><p style ='text-align: right;'>" . "เหลือ : " . "</p></b>" . "</div>";
                        echo "<div class='col-2'>" . "<b><p style ='text-align: right;'>" . number_format($balancetotal, 2) . "</p></b>" . "</div>";
                        echo "</div>";

                        echo "<div class='row' >";
                        echo "<div class='col-8'></div>";
                        echo "<div class='col-2'>" . "<b><p style ='text-align: right;'>" . "หักค่าใช้จ่าย : " . "</p></b>" . "</div>";
                        echo "<div class='col-2'>" . "<b><p style ='text-align: right;'>" . number_format($rexpensestotal, 2) . "</p></b>" . "</div>";
                        echo "</div>";

                        echo "<div class='row' >";
                        echo "<div class='col-8'></div>";
                        echo "<div class='col-2'>" . "<b><p style ='text-align: right;'>" . "คงเหลือ : " . "</p></b>" . "</div>";
                        echo "<div class='col-2'>" . "<b><p style ='text-align: right;'>" . number_format($final, 2) . "</p></b>" . "</div>";
                        echo "</div>";
                        echo "<input type='hidden' name='sum' class='form-control' value='$sumtotal'>";
                        echo "<input type='hidden' name='vat' class='form-control' value='$vattotal'>";
                        echo "<input type='hidden' name='balance' class='form-control' value='$balancetotal'>";
                        echo "<input type='hidden' name='rexpensestotal' class='form-control' value='$rexpensestotal'>";
                        echo "<input type='hidden' name='final' class='form-control' value='$final'>";
                        echo "<input type='hidden' name='username' class='form-control' value='$username'>";
                        // echo '<b><p style ="text-align: right;">'.'จำนวนเงินรวม = '. number_format($sum,2) .'</p></b>'; 
                        // echo '<b><p style ="text-align: right;">'.'หัก 3% = '.number_format($vat,2).'</p></b>';
                        echo "<input type='submit' name='button' id='button' class='btn btn-success btn-sm' value='ยืนยัน' />";
                        echo "&nbsp";
                        echo "<a href='payment.php' class='btn btn-warning btn-sm'>ปิด</a>";
                        echo "</form>";
                        include('footerjs.php');
                        exit;
                      }
                      //print_r($product_id);
                      // exit;

                        ?>
                        <div align="right">
                          <font color="red">*</font>
                          <font color="gray">Required Fields</font>
                        </div>
                        <hr>
                        <?php
                        include "payment_form_search.php";

                        ?>


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