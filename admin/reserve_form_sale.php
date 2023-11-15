<?php
if (@$_GET['do'] == 'f') {
    echo '<script type="text/javascript">
              swal("", "กรุณาใส่ข้อมูลให้ถูกต้อง !!", "warning");
              </script>';
    echo '<meta http-equiv="refresh" content="2;url=expenses.php?act=add" />';
} elseif (@$_GET['do'] == 'd') {
    echo '<script type="text/javascript">
              swal("", "กรุณาใส่จำนวนเงิน  !!", "error");
              </script>';
    //echo '<meta http-equiv="refresh" content="1;url=reserve.php?act=sale" />';
}
$ID = mysqli_real_escape_string($con, $_GET['ID']);


$sql = "SELECT * FROM tb_reserve
WHERE reserve_id=$ID
ORDER BY reserve_id DESC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
$row = mysqli_fetch_array($result);

$sql1 = "SELECT * FROM tb_reservelist
WHERE reserve_id=$ID
ORDER BY reservelist_id DESC" or die("Error:" . mysqli_error($con));
$result1 = mysqli_query($con, $sql1) or die("Error in query: $sql1 " . mysqli_error($con));


?>

<form method="post" class="form-horizontal" enctype="multipart/form-data">
    <div class="form-group">
        <div class="form-group">
            <div class="col-sm-2 control-label">
                วันที่ขาย : <font color="red">*</font>
            </div>
            <div class="col-sm-3">
                <input type="date" name="reserve_date" required value="<?php echo (new DateTime())->format('Y-m-d'); ?>" class="form-control">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                ชื่อลูกค้า :
                <input type="text" name="customer_name" required class="form-control" value="<?php echo $row['customer_name']; ?>" readonly>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                สถานะรับของ :
                <input type="text" name="receive_status" required class="form-control" value="รับของแล้ว" readonly>
            </div>
        </div>

        <table width="600" border="0" align="center" class="table table-bordered table-striped">

            <tr>
                <td>รายการ</td>
                <td align="center">ราคามาตราฐาน</td>
                <td align="center">ราคาขาย<font color="red">*</font>
                </td>
                <td align="center">จำนวน</td>

                <!-- <td align="center">ลบ</td> -->
            </tr>

            <?php
            $total = 0;

            while ($row1 = mysqli_fetch_array($result1)) {

                $product_id = $row1['product_id'];

                $sql2 = "SELECT * FROM tb_product WHERE product_id=$product_id";
                $query2 = mysqli_query($con, $sql2);
                $row2 = mysqli_fetch_array($query2);

                //  $sum = $row['product_price'] * $row1['reserve_uom'];
                //  $total += $sum;
                //  $total1 = $total-$discount;

                // $preserve_price = $row1['reserve_price'] / $row1['reserve_uom'];
                // echo $row1['reserve_uom'];
                //  $vat = ($total1 * 0.07);
                //  $stotal = $total1 + $vat;
                //  $p_qty = $row1['product_uom']; //จำนวนสินค้าในสต๊อก
                echo "<tr>";
                echo "<input type='hidden' style='text-align:right;'  class='form-control' name='reservelist_id[]' value='$row1[reservelist_id]' readonly>";
                echo "<input type='hidden' style='text-align:right;'  class='form-control' name='product_id[]' value='$row2[product_id]' readonly>";
                echo "<td width='334'>" . $row2["product_name"] . "</td>";
                echo "<td width='46' align='right'>" . number_format($row2["product_price"], 2) . "</td>";
                echo "<td width='46' align='right'>" . "<input type='number' style='text-align:right;' required class='form-control' name='sale_price[]'>" . "</td>";
                echo "<td width='57' align='right'>" . "<input type='number' style='text-align:right;'  class='form-control' name='reserve_uom[]' value='$row1[reserve_uom]' readonly>" . "</td>";
                echo "</tr>";
            }
            echo "<tr>";
                echo "<td colspan='3'  align='right'><b>ส่วนลด</b><font color='red'>*ถ้าไม่มีส่วนลดให้ใส่ 0 </font></td>";
                echo "<td align='right' >" . "<input type='decimal' style='text-align:right;' name='sale_discount' class='form-control' value='0' Required>" . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td colspan='4' align='right'>";
            echo "<input type='hidden' name='username' value=' $username'>";
            echo "</td>";
            echo "</tr>";

            ?>
            <tr>
                <td colspan="4" align="right">
                    <input type="button" value="บิลธรรมดา" class="btn btn-success btn-sm" onClick="this.form.action='reserve_sale_confirm.php?act=novat'; submit()">
                    <input type="button" value="ใบกำกับภาษี" class="btn btn-warning btn-sm" onClick="this.form.action='reserve_sale_confirm.php?act=vat'; submit()">

                </td>
            </tr>

        </table>
        <hr>

        <div class="form-group">
            <div class="col-sm-12">
                <font color="gray">บันทึกข้อมูลล่าสุด : <?php echo $row['reserve_dt']; ?> ผู้บันทึก : <?php echo $row['username']; ?> </font>
            </div>
        </div>
        <hr>


        <div class="form-group">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-3">
                <input type="hidden" name="reserve_id" value="<?php echo $ID; ?>" />


                <a href="reserve.php" class="btn btn-warning">ปิด</a>
            </div>
        </div>
</form>