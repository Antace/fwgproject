<?php
include '../vendor/autoload.php';
$ID = mysqli_real_escape_string($con,$_GET['ID']);
$sql = "SELECT tb_transport.*, tb_customer.* FROM tb_transport
LEFT JOIN tb_customer ON tb_transport.customer_name = tb_customer.customer_name
WHERE transport_id=$ID" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
$row = mysqli_fetch_array($result);



// ฟังก์ชั่น อ่านตัวเลขเป็นตัวอักษรไทย
function Convert($amount_number)
{
    $amount_number = number_format($amount_number, 2, ".", "");
    $pt = strpos($amount_number, ".");
    $number = $fraction = "";
    if ($pt === false)
        $number = $amount_number;
    else {
        $number = substr($amount_number, 0, $pt);
        $fraction = substr($amount_number, $pt + 1);
    }

    $ret = "";
    $baht = ReadNumber($number);
    if ($baht != "")
        $ret .= $baht . "บาท";

    $satang = ReadNumber($fraction);
    if ($satang != "")
        $ret .=  $satang . "สตางค์";
    else
        $ret .= "ถ้วน";
    return $ret;
}

function ReadNumber($number)
{
    $position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
    $number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
    $number = $number + 0;
    $ret = "";
    if ($number == 0) return $ret;
    if ($number > 1000000) {
        $ret .= ReadNumber(intval($number / 1000000)) . "ล้าน";
        $number = intval(fmod($number, 1000000));
    }

    $divider = 100000;
    $pos = 0;
    while ($number > 0) {
        $d = intval($number / $divider);
        $ret .= (($divider == 10) && ($d == 2)) ? "ยี่" : ((($divider == 10) && ($d == 1)) ? "" : ((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
        $ret .= ($d ? $position_call[$pos] : "");
        $number = $number % $divider;
        $divider = $divider / 10;
        $pos++;
    }
    return $ret;
}
// ฟังก์ชั่น อ่านตัวเลขเป็นตัวอักษรไทย

$mpdf = new \Mpdf\Mpdf([
    'margin_top' => 4,
    'margin_left' => 8,
    'margin_right' => 8,
    'mode' => 'utf-8', 'format' => 'Letter',
    'default_font_size' => 14,
    'default_font' => 'sarabun'
]);
echo'<a href="../transport/transport.pdf"  target="_blank" class="btn btn-primary">'.'พิมพ์'.'</a>'
        .'<a href="transport.php" class="btn btn-danger">'.'ยกเลิก'.'</a>';    
ob_start();
?>

<div class="container">
            <div class="row align-items-start">
            <div class="col-sm-12">
            <img src="../fwghead/head8delivery BILL.png"  height="110" >
            <hr>
            <table  class = "table table-borderless" width="100%">

            <tr>
            <td width = "5%">เลขที่</td>
            <td width = "40%"><?php echo $row['transport_id'];?> </td>
            </tr>
            <tr>
            <td width = "5%">ชื่อลูกค้า</td>
            <td width = "40%"><?php echo $row['customer_name'];?></td>
            <td width = "20%">วันที่ .................................................</td>
            
            </tr>
            <tr>
            <td width = "5%">ทีอยู่</td>
            <td width = "40%"><?php echo $row['customer_address'];?></td>
            <td width = "20%">โครงการ <?php echo $row['department_name'];?></td>
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
<style>

@page { sheet-size: Letter; }
    
    @page bigger { sheet-size: Letter; }
    
    @page toc { sheet-size: 228mm 139mm; }
    
    h1.bigsection {
            page-break-before: always;
            page: bigger;
    }

</style>
<style>
#customers {
     border-bottom: 1px solid #000;
     border-top: 1px solid #000;
     border-right: 1px solid #000;
     border-left: 1px solid #000;
     border-collapse: collapse;
     width: 100%;
   }
   
   #customers td, #customers th {
     border: 1px solid #000;
     padding: 4px;
     
   }
   
   tr.noBorder  {
  border: 0;
}
   
   
   
   #customers th {
     padding-top: 5;
     padding-bottom: 5px;
     text-align: left;
    
     color: black;
   }
</style>

<style type="text/css">
              

          
        </style>

<!-- cellpadding="0" cellspacing="0" style="border-bottom: solid 1px #000; border-top:solid 1px #000;" -->
<div class="container">
            <div class="row align-items-start">
            <div class="col-sm-12">
            <table id='customers' class = 'table table-bordered table-sm'  >

            <thead>
            <tr id='customer'>
            
            <th width='5%'><center>ลำดับ</center></th>
            <th width='10%'><center>เลขที่</center></th>
            <th width='45%'><center>รายการ</center></th>
            <th width='8%'><center>จำนวน</center></th>
            <th width='7%'><center>หน่วย</center></th>
            <th width='12%'><center>ราคา/หน่วย</center></th>
            
            <th width='13%'><center>จำนวนเงิน</center></th>
            
            </tr>
            </thead>

            <tbody>
                <?php
            $transport_id = $row['transport_id'];
            $query = "SELECT tb_transportlist.*,tb_product.*,SUM(transport_uom) as total FROM tb_transportlist 
                      LEFT JOIN tb_product ON tb_transportlist.product_id = tb_product.product_id
                      WHERE (transport_id = '$transport_id')
                      GROUP BY product_name ORDER BY transportlist_id ASC" or die("$query -> Error :" . mysqli_error($con));
            $result1 = mysqli_query($con, $query);
            $a = 1;
            while ($row1 = mysqli_fetch_array($result1)) {
                
                $total = $row1['total'] * $row1['transport_price'];

                
                                                        
                $discount=$row['transport_discount'];                                      
                $sum += $total;
                $total1 = $sum-$discount;
                                                        
                                                        
                $vat = ($total1 * 0.07);
                $stotal = $total1 + $vat;
              
                echo '<tr class="noBorder" >';
                echo '<td align="center">' . $a++ . '</td>';
                echo '<td align="center">' . $row1['transport_po'] . '</td>';
                echo '<td>' . $row1['product_name'] . '</td>';
                echo '<td align="right">' . number_format($row1['total'], 2) . '</td>';
                echo '<td align="center">' . $row1['product_unit'] . '</td>';
                echo '<td align="right">' . number_format($row1['transport_price'], 2) . '</td>';
                
                echo '<td align="right">' . number_format($total, 2) . '</td>';
               
                echo '</tr>';
                
               
            } 
            $count = mysqli_num_rows($result1);
            // echo $count;
            for ($i = 0; $count < 12; $count++) {
            echo '<tr class="noBorder">';
            echo '<td>'.'<br>'.'</td>';
            echo '<td>'.''.'</td>';
            echo '<td>'.''.'</td>';
            echo '<td>'.''.'</td>';
            echo '<td>'.''.'</td>';
            echo '<td>'.''.'</td>';
            echo '<td>'.''.'</td>'; 
            echo '</tr>';
            }
            


            
            echo '<tr >';
            echo '<td colspan="3" rowspan="5" align="center">';
            
            echo '</td>';
            echo '<td colspan="3" align="left">';
            echo 'รวม';
            echo '</td>';
            echo '<td  align="right">';
            echo number_format($sum,2);
            echo '</td>';
            echo '</tr>';


            echo '<tr >';
            
            echo '<td colspan="3" align="left">';
            echo 'หักค่ามัดจำ (%)';
            echo '</td>';
            echo '<td  align="right">';
            echo '0.00';
            echo '</td>';
            echo '</tr>';

            echo '<tr >';
            echo '<td colspan="3" align="left">';
            echo 'ส่วนลด';
            echo '</td>';
            echo '<td  align="right">';
            echo number_format($discount,2);
            echo '</td>';
            echo '</tr>';

            echo '<tr >';
            echo '<td colspan="3" align="left">';
            echo 'จำวนเงินหลังหักส่วนลด';
            echo '</td>';
            echo '<td  align="right">';
            echo number_format($total1,2);
            echo '</td>';
            echo '</tr>';

            echo '<tr >';
            echo '<td colspan="3" align="left">';
            echo 'ภาษีมูลค่าเพิ่ม';
            echo '</td>';
            echo '<td  align="right">';
            echo number_format($vat,2);
            echo '</td>';
            echo '</tr>';

            echo '<tr >';
            echo '<td colspan="3" align="center">';
            echo Convert($stotal);
            echo '</td>';
            echo '<td colspan="3" align="left">';
            echo 'รวมทั้งสิ้น';
            echo '</td>';
            echo '<td  align="right">';
            echo number_format($stotal,2);
            echo '</td>';
            echo '</tr>';
            
            echo '</tbody>';
            echo '</table>';

            echo '<br>';

            echo "<table id='customers' class = 'table table-bordered' border='1'>";
            
            echo "<tr>";
            echo "<td>";
            echo "ได้รับสินค้าและอุปกรณ์ครบถ้วน";
            echo "<br>";
            echo "<br>";
            echo "ลงชื่อผู้รับของ ........................................................";
            echo "<br>";
            echo "<br>";
            echo "วันที่ ........................................................................";
            echo "</td>";
            echo "<td align=center>";
            echo "";
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "...................................................................";
            echo "<br>";
            echo "ผู้ส่งของ";
            echo "</td>";
            echo "</tr>";
            
            echo "</table>";
            
            

            
            ?>
    
<?php

        $html=ob_get_contents();
        $mpdf->WriteHTML($html);
        //$filename = 'transport'.'_'.date('D-d-m-Y-H-i-s').'.pdf';
        $mpdf->Output('../transport/transport.pdf');
        $mpdf->cleanup();
    

        echo'<a href="../transport/transport.pdf"  target="_blank" class="btn btn-primary">'.'พิมพ์'.'</a>'
        .'<a href="transport.php" class="btn btn-danger">'.'ยกเลิก'.'</a>';    
?>


  </div>
</div>
</div>

<div class="container">
  <div class="row align-items-start">
  <div class="col-sm-12">
  <input type="hidden" name="transport_id" value="<?php echo $ID; ?>" />
        
        
      </div>
    </div>
</div>
