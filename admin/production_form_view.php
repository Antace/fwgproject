<?php 

$ID = mysqli_real_escape_string($con,$_GET['ID']);


$sql = "SELECT * FROM tb_production
WHERE production_id=$ID
ORDER BY production_id DESC" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
$row = mysqli_fetch_array($result);

$sql1 = "SELECT * FROM tb_productionlist
WHERE production_id=$ID
ORDER BY productionlist_id DESC" or die("Error:" . mysqli_error());
$result1 = mysqli_query($con, $sql1) or die ("Error in query: $sql1 " . mysqli_error());


?>

<form action="production_form_return.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
  <div class="form-group">
    <div class="col-sm-2 control-label">
      วันที่ทำรายการ :
    </div>
    <div class="col-sm-3">
      <input type="text" name="production_date" required class="form-control" value="<?php echo date('d/m/Y',strtotime( $row['production_date']))?>" readonly>
    </div>
  </div>
  <div class="col-6">
      <div class="form-group">
        ผู้รับเหมา :
        <input type="text" name="contractor_nickname" required class="form-control" value="<?php echo $row['contractor_nickname'];?>"readonly>
      </div>
    </div>

    <table width="600" border="0" align="center" class="table table-bordered table-striped">

<tr>
    <td>รายการ</td>
    
    <td align="center">จำนวน</td>
    
    <!-- <td align="center">ลบ</td> -->
</tr>

<?php
$total = 0;

while ($row1 = mysqli_fetch_array($result1)) {
         
        $product_id=$row1['product_id'];
        
        $sql2 = "SELECT * FROM tb_product WHERE product_id=$product_id";
         $query2 = mysqli_query($con, $sql2);
         $row2 = mysqli_fetch_array($query2);
         
        //  $sum = $row['product_price'] * $row1['production_uom'];
        //  $total += $sum;
        //  $total1 = $total-$discount;
        
        
        // echo $row1['production_uom'];
        //  $vat = ($total1 * 0.07);
        //  $stotal = $total1 + $vat;
        //  $p_qty = $row1['product_uom']; //จำนวนสินค้าในสต๊อก
        echo "<tr>";
        echo "<input type='hidden' style='text-align:right;'  class='form-control' name='productionlist_id[]' value='$row1[productionlist_id]' readonly>";
        echo "<input type='hidden' style='text-align:right;'  class='form-control' name='product_id[]' value='$row2[product_id]' readonly>";
        echo "<td width='334'>" . $row2["product_name"] . "</td>";
        
        
        
        echo "<td width='46' align='right'>" . "<input type='number' style='text-align:right;'  class='form-control' name='production_uom[]' value='$row1[production_uom]' readonly>" . "</td>";
        echo "</td>";
        
        
        //remove product
        // echo "<td width='46' align='center'><a href='production_form_add1.php?product_id=$product_id&act=remove'class='btn btn-danger'>ลบ</a></td>";
        echo "</tr>";
}
    
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
   <font color ="gray">บันทึกข้อมูลล่าสุด : <?php echo $row['production_dt']; ?> ผู้บันทึก : <?php echo $row ['username']; ?> </font> 
  </div>
</div>
<hr>
    
  
  <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
      <input type="hidden" name="production_id" value="<?php echo $ID; ?>" />
      
      <?php if ($_GET['act']=='production_cancel') {?>
        <input type="submit" name="button" id="button" class="btn btn-danger " value="ยกเลิกรายการผลิต" onclick="return confirm('ยืนยันการคืนสินค้า')"/>
      <!-- <a href="production_form_return.php" onclick="return confirm('ยืนยันการคืนสินค้า')" class="btn btn-danger">คืนสินค้า</a> -->
      <?php } ?>
      <a href="production.php" class="btn btn-warning">ปิด</a>
    </div>
  </div>
</form>


