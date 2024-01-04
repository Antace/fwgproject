<?php
include ('../vendor/autoload.php');
//require_once __DIR__ . '/vendor/autoload.php';
$ID = mysqli_real_escape_string($con,$_GET['ID']);
$sql = "SELECT * FROM tb_order
WHERE order_id=$ID
ORDER BY order_id DESC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
$row = mysqli_fetch_array($result);

$sql1 = "SELECT * FROM tb_orderlist
WHERE order_id=$ID
ORDER BY orderlist_id DESC" or die("Error:" . mysqli_error($con));
$result1 = mysqli_query($con, $sql1) or die ("Error in query: $sql1 " . mysqli_error($con));




$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4',
  'margin_top' => 8,
	'default_font_size' => 16,
	'default_font' => 'sarabun'
]);
echo'<a href="../order/order.pdf"  target="_blank" class="btn btn-primary">'.'พิมพ์'.'</a>'
        .'<a href="order.php" class="btn btn-danger">'.'ยกเลิก'.'</a>';    
ob_start();
?>

<div class="container">
  <div class="row align-items-start">
    <div class="col-sm-12">
    <h2 align="center">ใบสั่งผลิต</h2>
    <table  class = "table table-borderless" width="100%">
    <tr>
        <td align="left"><h3><?php echo $row['label_name'];?></h3></td> 
      </tr>
      <tr>
        
        <td>เลขที่ : <?php echo  $row['order_id']; ?></td>
        <td width="20%">วันที่ : <?php echo date('d/m/Y',strtotime( $row['order_date'])); ?></td>
      </tr>
      
      <tr>
        <td>ผู้สั่ง : <?php echo  $row['username']; ?></td>
      </tr>
      <tr>
        
        <td>รายละเอียด : <?php echo $row['label_detail'];?></td>
        
      </tr>

      
    </table>
    <table class = "table table-borderless" align="center" width="100%" >
    <tr>
        <td>
        <img src="../label_img/<?php echo $row['label_pic1'];?>"  height="150px">
        </td>
        <td>
        <img src="../label_img/<?php echo $row['label_pic2'];?>"   height="150px">
        </td>
      </tr>
    </table>
</div>
</div>
</div>

<div class="container">
  <div class="row align-items-start">
  <div class="col-sm-12">
    
     
</div>  
</div>
</div>

<br>
<style>

@page { sheet-size: A4; }

@page bigger { sheet-size: 420mm 370mm; }

@page toc { sheet-size: A4; }

h1.bigsection {
        page-break-before: always;
        page: bigger;
}

</style>
<style>
#customers {
 
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 2px solid #000;
  padding: 8px;
}




#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
 
  color: black;
}
</style>
<div class="container">
  <div class="row align-items-start">
  <div class="col-sm-12">
  <table id='customers' class = "table table-bordered" >
<thead>
    <tr>
    <td align='center' width="3%"><h3>ลำดับ</h3></td>
    <td align='center' width="20%"><h3>รายการ</h3></td>
    <td align='center' width="20%"><h3>แปลง</h3></td>
    <td align='center' width="50%"><h3>โครงการ</h3></td>
    <td align='center' width="7%"><h3>-</h3></td>
        
    </tr>
</thead>
<?php
$total = 0;
$i=1;
while ($row1 = mysqli_fetch_array($result1)) {
         
        $label_ida=$row1['label_ida'];
        
        $sql2 = "SELECT * FROM tb_labeldetail WHERE label_ida=$label_ida";
         $query2 = mysqli_query($con, $sql2);
         $row2 = mysqli_fetch_array($query2);
         
        echo "<tr>";
        echo "<td align='center'><h3>"  .$i++ . "</h3></td>";
        echo "<input type='hidden' style='text-align:right;'  class='form-control' name='orderlist_id[]' value='$row1[orderlist_id]' readonly>";
        echo "<input type='hidden' style='text-align:right;'  class='form-control' name='label_ida[]' value='$row2[label_ida]' readonly>";
        echo "<td align='center'><h3>"  .$row2["label_numberid"] . "</h3></td>";
        
        echo "<td align='center'><h3>" ."<font color ='red'>". $row2["label_place"]."</font>" ."</td>";
        echo "<td align='center'><h3>" . $row2["department_name"] ."</h3></td>";
        echo "<td align='center'><h3>" . $row2["label_orderstatus"] . "</h3></td>";
        
       
        
        echo "</tr>";
}
    
    

?>
</table>
<?php

        $html=ob_get_contents();
        $mpdf->WriteHTML($html);

        
        $mpdf->Output('../order/order.pdf');
        $mpdf->cleanup();
    

        echo'<a href="../order/order.pdf"  target="_blank" class="btn btn-primary">'.'พิมพ์'.'</a>'
        .'<a href="order.php" class="btn btn-danger">'.'ยกเลิก'.'</a>';    
        
?>


  </div>
</div>
</div>

<div class="container">
  <div class="row align-items-start">
  <div class="col-sm-12">
  <input type="hidden" name="order_id" value="<?php echo $ID; ?>" />
        
        
      </div>
    </div>
</div>