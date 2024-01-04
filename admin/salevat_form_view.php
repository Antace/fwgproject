<?php 

$ID = mysqli_real_escape_string($con,$_GET['ID']);


$sql = "SELECT * FROM tb_salevat
WHERE sale_id=$ID
ORDER BY sale_id DESC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
$row = mysqli_fetch_array($result);

$sql1 = "SELECT * FROM tb_salevatlist
WHERE sale_id=$ID
ORDER BY salelist_id DESC" or die("Error:" . mysqli_error($con));
$result1 = mysqli_query($con, $sql1) or die ("Error in query: $sql1 " . mysqli_error($con));


?>

<form action="salevat_form_return.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
  <div class="form-group">
    <div class="col-sm-2 control-label">
      วันที่ขาย :
    </div>
    <div class="col-sm-3">
      <input type="text" name="sale_date" required class="form-control" value="<?php echo date('d-m-Y',strtotime( $row['sale_date']))?>" readonly>
    </div>
  </div>
  <div class="col-6">
      <div class="form-group">
        ชื่อลูกค้า :
        <input type="text" name="customer_name" required class="form-control" value="<?php echo $row['customer_name'];?>"readonly>
      </div>
    </div>

    <table width="600" border="0" align="center" class="table table-bordered table-striped">

<tr>
    <td>รายการ</td>
    <td align="center">ราคามาตราฐาน</td>
    <td align="center">ราคาขาย</td>
    <td align="center">จำนวน</td>
    <td align="center">รวม(บาท)</td>
    <!-- <td align="center">ลบ</td> -->
</tr>

<?php
$total = 0;

while ($row1 = mysqli_fetch_array($result1)) {
         
        $product_id=$row1['product_id'];
        
        $sql2 = "SELECT * FROM tb_product WHERE product_id=$product_id";
         $query2 = mysqli_query($con, $sql2);
         $row2 = mysqli_fetch_array($query2);
         
        //  $sum = $row['product_price'] * $row1['sale_uom'];
        //  $total += $sum;
        //  $total1 = $total-$discount;
        
        $psale_price = $row1['sale_price']/$row1['sale_uom'];
        // echo $row1['sale_uom'];
        //  $vat = ($total1 * 0.07);
        //  $stotal = $total1 + $vat;
        //  $p_qty = $row1['product_uom']; //จำนวนสินค้าในสต๊อก
        echo "<tr>";
        echo "<input type='hidden' style='text-align:right;'  class='form-control' name='salelist_id[]' value='$row1[salelist_id]' readonly>";
        echo "<input type='hidden' style='text-align:right;'  class='form-control' name='product_id[]' value='$row2[product_id]' readonly>";
        echo "<td width='334'>" . $row2["product_name"] . "</td>";
        
        echo "<td width='46' align='right'>" . number_format($row2["product_price"],2). "</td>";
        echo "<td width='57' align='right'>" . number_format($psale_price,2) ."</td>";
        echo "<td width='46' align='right'>" . "<input type='number' style='text-align:right;'  class='form-control' name='sale_uom[]' value='$row1[sale_uom]' readonly>" . "</td>";
        echo "</td>";
        
        echo "<td width='93' align='right'>" . number_format($row1["sale_price"], 2) . "</td>";
        //remove product
        // echo "<td width='46' align='center'><a href='sale_form_add1.php?product_id=$product_id&act=remove'class='btn btn-danger'>ลบ</a></td>";
        echo "</tr>";
}
    echo "<tr>";
    echo "<td colspan='3'  align='right'><b>ราคาก่อน Vat</b></td>";
    echo "<td align='right' >" . number_format($row["sale_total"],2) . "</td>";
    echo "<td align='left' >บาท</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td colspan='3'  align='right'><b>ส่วนลด</b></td>";
    echo "<td align='right' >" . number_format($row["sale_discount"],2). "</td>";
    echo "<td align='left' >บาท</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td colspan='3'  align='right'><b>Vat 7%</b></td>";
    echo "<td align='right' >" . number_format($row["sale_vat"],2). "</td>";
    echo "<td align='left' >บาท</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td colspan='3'  align='right'><b>ราคารวม Vat</b></td>";
    echo "<td align='right' >" . number_format($row["sale_stotal"],2) . "</td>";
    echo "<td align='left' >บาท</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td colspan='7' align='right'>";
    echo "<input type='hidden' name='username' value=' $username'>";
    echo "</td>";
    echo "</tr>";

?>


</table>
<hr>

<div class="form-group">
  <div class="col-sm-12">
   <font color ="gray">บันทึกข้อมูลล่าสุด : <?php echo $row['sale_dt']; ?> ผู้บันทึก : <?php echo $row ['username']; ?> </font> 
  </div>
</div>
<hr>
    
  
  <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
      <input type="hidden" name="sale_id" value="<?php echo $ID; ?>" />
      
      <?php if ($_GET['act']=='salevat_cancel') {?>
        <input type="submit" name="button" id="button" class="btn btn-danger " value="คืนสินค้า" onclick="return confirm('ยืนยันการคืนสินค้า')"/>
      <!-- <a href="sale_form_return.php" onclick="return confirm('ยืนยันการคืนสินค้า')" class="btn btn-danger">คืนสินค้า</a> -->
      <?php } ?>
      <a href="salevat.php" class="btn btn-warning">ปิด</a>
    </div>
  </div>
</form>


