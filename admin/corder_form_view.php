<?php 

$ID = mysqli_real_escape_string($con,$_GET['ID']);


$sql = "SELECT * FROM tb_cancelorder
WHERE corder_id=$ID
ORDER BY corder_id DESC" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
$row = mysqli_fetch_array($result);

$sql1 = "SELECT * FROM tb_cancelorderlist
WHERE corder_id=$ID
ORDER BY corderlist_id DESC" or die("Error:" . mysqli_error());
$result1 = mysqli_query($con, $sql1) or die ("Error in query: $sql1 " . mysqli_error());


?>
<script>
        function readURL(input){
            if(input.files[0]){
                let reader = new FileReader();
                document.querySelector('#imgControl').classList.replace("d-none", "d-block");
                reader.onload = function (e) {
                    let element = document.querySelector('#imgUpload');
                    element.setAttribute("src", e.target.result);
                }  
                reader.readAsDataURL(input.files[0]);
            }         
        }
    </script>

    
<form action="corder_form_return.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
  <div class="form-group">
    <div class="col-sm-2 control-label">
      วันที่สั่ง :
    </div>
    <div class="col-sm-3">
      <input type="text" name="corder_date" required class="form-control" value="<?php echo date('d/m/Y',strtotime( $row['corder_date']))?>" readonly>
    </div>
  </div>
  <div class="col-6">
      <div class="form-group">
        ชื่อรายการ :
        <input type="text" name="label_name" required class="form-control" value="<?php echo $row['label_name'];?>"readonly>
      </div>
    </div>
    <div class="col-6">
      <div class="form-group">
        รายละเอียด :
        <textarea name="label_detail" cols="60" required class="form-control" readonly><?php echo $row['label_detail'];?></textarea>
      </div>
    </div>
    <div class="col-6">
      <div class="form-group">
        รูปที่ 1 :
        <input type="text" name="label_pic1" required class="form-control" value="<?php echo $row['label_pic1'];?>"readonly>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-2 control-label">
      <img id="imgUpload" class="img-fluid my-3">   
      <img src="../label_img/<?php echo $row['label_pic1'];?>" width="200px">
      <br>
      </div>
      
    </div>
    <div class="col-6">
      <div class="form-group">
        รูปที่ 2 :
        <input type="text" name="label_pic2" required class="form-control" value="<?php echo $row['label_pic2'];?>"readonly>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-2 control-label">
       
      <img src="../label_img/<?php echo $row['label_pic2'];?>" width="200px">
      
      <br>
      </div>
      
    </div>
    <div class="col-6">
      <div class="form-group">
        สาเหตุที่ยกเลิก :
        <input type="text" name="cancel_detail" required class="form-control" value="<?php echo $row['cancel_detail'];?>"readonly>
      </div>
    </div>

    <table width="600" border="0" align="center" class="table table-bordered table-striped">

<tr>
    <td>รายการ</td>
    <td>แปลง</td>
    <td>โครงการ</td>
    <td></td>
    <!-- <td align="center">ลบ</td> -->
</tr>

<?php
$total = 0;

while ($row1 = mysqli_fetch_array($result1)) {
         
        $label_ida=$row1['label_ida'];
        
        $sql2 = "SELECT * FROM tb_labeldetail WHERE label_ida=$label_ida";
         $query2 = mysqli_query($con, $sql2);
         $row2 = mysqli_fetch_array($query2);
         
        //  $sum = $row['product_price'] * $row1['corder_uom'];
        //  $total += $sum;
        //  $total1 = $total-$discount;
        
       
        //  echo $row1['corder_uom'];
        //  $vat = ($total1 * 0.07);
        //  $stotal = $total1 + $vat;
        //  $p_qty = $row1['product_uom']; //จำนวนสินค้าในสต๊อก
        echo "<tr>";
        echo "<input type='hidden' style='text-align:right;'  class='form-control' name='corderlist_id[]' value='$row1[corderlist_id]' readonly>";
        echo "<input type='hidden' style='text-align:right;'  class='form-control' name='label_ida[]' value='$row2[label_ida]' readonly>";
        echo "<td width='50'>" . $row2["label_numberid"] . "</td>";
        
        echo "<td width='46' >" . $row2["label_place"]. "</td>";
        echo "<td width='57' >" . $row2["department_name"] ."</td>";
        echo "<td width='46' >" . "<input type='text' style='text-align:center;'  class='form-control' name='label_orderstatus[]' value='$row2[label_orderstatus]' readonly>" . "</td>";
        echo "</td>";
        //remove product
        
        echo "</tr>";
}
    
    echo "<td colspan='7' align='right'>";
    echo "<input type='hidden' name='username' value=' $username'>";
    echo "</td>";
    echo "</tr>";

?>


</table>
<hr>

<div class="form-group">
  <div class="col-sm-12">
   <font color ="gray">บันทึกข้อมูลล่าสุด : <?php echo $row['corder_dt']; ?> ผู้บันทึก : <?php echo $row ['username']; ?> </font> 
  </div>
</div>
<hr>
    
  
  <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
      <input type="hidden" name="corder_id" value="<?php echo $ID; ?>" />
      
      <?php if ($_GET['act']=='corder_cancel') {?>
        <input type="submit" name="button" id="button" class="btn btn-danger " value="คืนสินค้า" onclick="return confirm('ยืนยันการคืนสินค้า')"/>
      <!-- <a href="corder_form_return.php" onclick="return confirm('ยืนยันการคืนสินค้า')" class="btn btn-danger">คืนสินค้า</a> -->
      <?php } ?>
      <a href="corder.php" class="btn btn-warning">ปิด</a>
    </div>
  </div>
</form>


