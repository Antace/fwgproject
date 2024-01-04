<?php 

$ID = mysqli_real_escape_string($con,$_GET['ID']);


$sql = "SELECT * FROM tb_transport
WHERE transport_id=$ID
ORDER BY transport_id DESC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
$row = mysqli_fetch_array($result);

$sql1 = "SELECT * FROM tb_transportlist
WHERE transport_id=$ID
ORDER BY transportlist_id DESC" or die("Error:" . mysqli_error($con));
$result1 = mysqli_query($con, $sql1) or die ("Error in query: $sql1 " . mysqli_error($con));


?>

<form action="transport_form_return.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
  <div class="form-group">
    <div class="col-sm-2 control-label">
      วันที่ทำรายการ :
    </div>
    <div class="col-sm-3">
      <input type="text" name="transport_date" required class="form-control" value="<?php echo date('d/m/Y',strtotime( $row['transport_date']))?>" readonly>
    </div>
  </div>
  <div class="col-6">
      <div class="form-group">
        ชื่อลูกค้า :
        <input type="text" name="customer_name" required class="form-control" value="<?php echo $row['customer_name'];?>"readonly>
      </div>
    </div>
    <div class="col-6">
      <div class="form-group">
        โครงการ :
        <input type="text" name="department_name" required class="form-control" value="<?php echo $row['department_name'];?>"readonly>
      </div>
    </div>

    <table width="600" border="0" align="center" class="table table-bordered table-striped">

<tr>
    <td>เลขที่</td>
    <td>รายการ</td>
    <td>สถานที่จัดเก็บ</td>
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
         
        //  $sum = $row['product_price'] * $row1['transport_uom'];
        //  $total += $sum;
        //  $total1 = $total-$discount;
        
        $ptransport_price = $row1['transport_price']*$row1['transport_uom'];
        // echo $row1['transport_uom'];
        //  $vat = ($total1 * 0.07);
        //  $stotal = $total1 + $vat;
        //  $p_qty = $row1['product_uom']; //จำนวนสินค้าในสต๊อก
        echo "<tr>";
        echo "<input type='hidden' style='text-align:right;'  class='form-control' name='transportlist_id[]' value='$row1[transportlist_id]' readonly>";
        echo "<input type='hidden' style='text-align:right;'  class='form-control' name='product_id[]' value='$row2[product_id]' readonly>";
        // เก็บ array
        echo "<td width='50'>" . $row1["transport_po"] . "</td>";
        echo "<td width='200'>" . $row2["product_name"] . "</td>";
        echo "<td width='100'>" . $row2["location_name"] . "</td>";
        echo "<td width='46' align='right'>" . number_format($row2["product_price"],2). "</td>";
        echo "<td width='57' align='right'>" . number_format($row1["transport_price"],2) ."</td>";
        echo "<td width='46' align='right'>" . "<input type='number' style='text-align:right;'  class='form-control' name='transport_uom[]' value='$row1[transport_uom]' readonly>" . "</td>";
        
        echo "<td width='93' align='right'>" . number_format($ptransport_price, 2) . "</td>";
        
        //remove product
        // echo "<td width='46' align='center'><a href='transport_form_add1.php?product_id=$product_id&act=remove'class='btn btn-danger'>ลบ</a></td>";
        echo "</tr>";
}
    
echo "<tr>";
echo "<td colspan='5'  align='right'><b>ราคาก่อน Vat</b></td>";
echo "<td align='right' >" . number_format($row["transport_total"],2) . "</td>";
echo "<td align='left' >บาท</td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan='5'  align='right'><b>ส่วนลด</b></td>";
echo "<td align='right' >" . number_format($row["transport_discount"],2). "</td>";
echo "<td align='left' >บาท</td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan='5'  align='right'><b>Vat 7%</b></td>";
echo "<td align='right' >" . number_format($row["transport_vat"],2). "</td>";
echo "<td align='left' >บาท</td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan='5'  align='right'><b>ราคารวม Vat</b></td>";
echo "<td align='right' >" . number_format($row["transport_stotal"],2) . "</td>";
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
   <font color ="gray">บันทึกข้อมูลล่าสุด : <?php echo $row['transport_dt']; ?> ผู้บันทึก : <?php echo $row ['username']; ?> </font> 
  </div>
</div>
<hr>
    
  
  <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
      <input type="hidden" name="transport_id" value="<?php echo $ID; ?>" />
      
      <?php if ($_GET['act']=='transport_cancel') {?>
        <input type="submit" name="button" id="button" class="btn btn-danger " value="คืนสินค้า" onclick="return confirm('ยืนยันการคืนสินค้า')"/>
      <!-- <a href="transport_form_return.php" onclick="return confirm('ยืนยันการคืนสินค้า')" class="btn btn-danger">คืนสินค้า</a> -->
      <?php } ?>
      <a href="transport.php" class="btn btn-warning">ปิด</a>
    </div>
  </div>
</form>


