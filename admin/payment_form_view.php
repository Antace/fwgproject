<?php

$ID = mysqli_real_escape_string($con, $_GET['ID']);


$sql = "SELECT * FROM tb_payment
WHERE payment_id=$ID
ORDER BY payment_id DESC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
$row = mysqli_fetch_array($result);

$sql1 = "SELECT * FROM tb_paymentlist
WHERE payment_id=$ID
ORDER BY paymentlist_id DESC" or die("Error:" . mysqli_error($con));
$result1 = mysqli_query($con, $sql1) or die("Error in query: $sql1 " . mysqli_error($con));


?>

<form action="payment_form_return.php" method="post" class="form-horizontal" enctype="multipart/form-data">
    <div class="form-group">
        <div class="form-group">
            <div class="col-sm-2 control-label">
                วันที่ทำรายการ :
            </div>
            <div class="col-sm-3">
                <input type="text" name="payment_date" required class="form-control" value="<?php echo date('d-m-Y', strtotime($row['payment_date'])) ?>" readonly>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                ผู้รับเหมา :
                <input type="text" name="contractor_nickname" required class="form-control" value="<?php echo $row['contractor_nickname']; ?>" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="row">

                    <div class="col-1">จ่ายช่วงวันที่</div>
                    <div class="col-2">
                        <div class="form-group">
                            <input type="date" name="d_s" value="<?php echo $row['payment_ds']; ?>" class="form-control" readonly />
                        </div>
                    </div>

                    <div class="col-1">ถึง</div>
                    <div class="col-2">
                        <div class="form-group">
                            <input type="date" name="d_e" value="<?php echo $row['payment_de']; ?>" class="form-control" readonly />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <table  class="table table-bordered  table-sm">
            <thead>
            <tr align = "center">
                <th width='3%'>ลำดับ</th>
                <th width='25%'>รายการ</th>
                <th width='8%'>ราคา/หน่วย</th>
                <th width='8%'>จำนวนที่ผลิต</th>
                <th width='7%'>หน่วย</th>
                <th width='7%'>รวม</th>

                <!-- <td align="center">ลบ</td> -->
            </tr>
            </thead>
            <?php
            $total = 0;
            $i = 1;
            while ($row1 = mysqli_fetch_array($result1)) {

                $product_id = $row1['product_id'];
                
               
                
                $sql2 = "SELECT * FROM tb_product WHERE product_id=$product_id";
                $query2 = mysqli_query($con, $sql2);
                $row2 = mysqli_fetch_array($query2);
                $total = $row1['production_uom'] * $row2['production_price'];
                $sum += $total;
                // $vat = $sum * 0.03;
                // $balance = $sum - $vat;

                echo "<tr>";
                echo "<td align=center>" . $i++  . "</td> ";
                echo "<input type='hidden' style='text-align:right;'  class='form-control' name='paymentlist_id[]' value='$row1[paymentlist_id]' readonly>";
                echo "<input type='hidden' style='text-align:right;'  class='form-control' name='product_id[]' value='$row2[product_id]' readonly>";
                echo "<td >" . $row2["product_name"] . "</td> ";
                echo "<td width='57' align='right'>";
                echo "<input type='number' class='form-control' style='text-align:right;' name='production_price[]' value='$row2[production_price]' size='2' Required/ readonly></td>";
                echo "<td width='57' align='right'>";
                echo "<input type='number' class='form-control' style='text-align:right;' name='production_uom[]' value='$row1[production_uom]' size='2' Required/ readonly></td>";


                echo "<td align=center>" . $row2["product_unit"] . "</td> ";
                // echo "<input type = 'hidden' class ='form-control' name = 'production_id[]' value ='$row1[production_id]' >";

                echo "<td width='57' align='right'>";
                echo "<input type='number' class='form-control' style='text-align:right;' name='payment_price[]' value='$total' size='2' Required/ readonly></td>";
            }

            echo "<tr>";
            echo "<td colspan='7' align='right'>";
            echo "<input type='hidden' name='username' value=' $username'>";
            echo "</td>";
            echo "</tr>";
            echo "</table>";

            $contractor_nickname = $row['contractor_nickname'];
            $d_s = $row['payment_ds'];
            $d_e = $row['payment_de'];

            // echo $contractor_nickname;
            // echo $d_s;
            // echo $d_e;

            $query6 = "SELECT tb_wagerecordlist.*,tb_wagerecord.*,tb_wage.*,SUM(wagerecord_uom) as total FROM tb_wagerecordlist 
                        LEFT JOIN tb_wagerecord ON tb_wagerecordlist.wagerecord_id = tb_wagerecord.wagerecord_id
                        LEFT JOIN tb_wage ON tb_wagerecordlist.wage_id = tb_wage.wage_id
                        WHERE (contractor_nickname = '$contractor_nickname' AND wagerecord_date BETWEEN '$d_s' AND '$d_e' AND wagerecord_status = '1')
                        GROUP BY wage_name " or die("$query6 -> Error :" . mysqli_error($con));

                        $result6 = mysqli_query($con, $query6);

                        echo "<table   class='table table-bordered table-sm'>";
                        echo "<thead>";
                        echo "<tr class='' align ='center'>";
                        echo "<th width='3%'>ลำดับ</th>";
                        echo "<th width='30%'>รายการ</th>";
                        echo "<th width='20%'>ราคา</th>";
                        echo "<th width='8%'>จำนวนที่ผลิต</th>";
                        echo "<th width='7%'>รวม</th>";
                        echo "</tr>";
                        echo "</thead>";

                        $b = 1;

                        while ($row6 = mysqli_fetch_array($result6)) {
                          $total6 = $row6['total'] * $row6['wage_price'];
                          $sum6 += $total6;
                        //   $vat6 = $sum6 * 0.03;
                        //   $balance6 = $sum6 - $vat6;
                          echo "<tr>";
                          echo "<td align=center>" . $b++  . "</td> ";
                          echo "<td >" . $row6["wage_name"] . "</td> ";
                          echo "<td width='57' align='right'>";
                          echo "<input type='number' class='form-control' style='text-align:right;' name='wagerecord_price[]' value='$row6[wage_price]' size='2' Required/ readonly></td>";
                          echo "<td width='57' align='right'>";
                          echo "<input type='number' class='form-control' style='text-align:right;' name='wagerecord_uom[]' value='$row6[total]' size='2' Required/ readonly></td>";
                          echo "<input type = 'hidden' class ='form-control' name = 'wagerecord_id[]' value ='$row6[wagerecord_id]' >";
                          echo "<td width='57' align='right'>";
                          echo "<input type='number' class='form-control' style='text-align:right;' name='payment_price[]' value='$total6' size='2' Required/ readonly></td>";
                          echo "</tr>";
                        }
                        echo "</table>";






            $query1 = "SELECT * FROM tb_rexpenses WHERE (contractor_nickname = '$contractor_nickname' AND rexpenses_date BETWEEN '$d_s' AND '$d_e' AND 	rexpenses_status ='1')";
            $result2 = mysqli_query($con, $query1);
            // echo $query1;

            echo "<table   class='table table-bordered  table-sm'>";
            echo "<thead>";
            echo "<tr class='' align ='center'>";
            echo "<th width='3%'>ลำดับ</th>";
            echo "<th width='25%'>เลขที่ใบงาน</th>";
            echo "<th width='25%'>รายการ</th>";
            echo "<th width='8%'>จำนวนเงิน</th>";
            echo "</thead>";

            $a = 1;
            while ($row2 = mysqli_fetch_array($result2)) {
                $rexpensestotal += $row2['rexpenses_uom'];
                echo "<tr>";
                echo "<td align=center>" . $a++  . "</td> ";
                echo "<td >" . $row2["rexpenses_id"] . "</td> ";
                echo "<td >" . $row2["expenses_name"] . "</td> ";
                echo "<td width='57' align='right'>";
                echo "<input type='number' class='form-control' style='text-align:right;' name='rexpenses_uom[]' value='$row2[rexpenses_uom]' size='2' Required/ readonly></td>";
                echo "<input type = 'hidden' class ='form-control' name = 'rexpenses_id[]' value ='$row2[rexpenses_id]' >";


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
            ?>


        </table>
        <hr>

        <div class="form-group">
            <div class="col-sm-12">
                <font color="gray">บันทึกข้อมูลล่าสุด : <?php echo $row['payment_dt']; ?> ผู้บันทึก : <?php echo $row['username']; ?> </font>
            </div>
        </div>
        <hr>


        <div class="form-group">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-3">
                <input type="hidden" name="payment_id" value="<?php echo $ID; ?>" />

                <?php if ($_GET['act'] == 'payment_cancel') { ?>
                    <input type="submit" name="button" id="button" class="btn btn-danger " value="ยกเลิกการจ่ายเงิน" onclick="return confirm('ยืนยันการคืนสินค้า')" />
                    <!-- <a href="payment_form_return.php" onclick="return confirm('ยืนยันการคืนสินค้า')" class="btn btn-danger">คืนสินค้า</a> -->
                <?php } ?>
                <a href="payment.php" class="btn btn-warning">ปิด</a>
            </div>
        </div>
    </div>
</form>