<?php

include '../vendor/autoload.php';
include 'h.php';
include 'menutop.php';
include 'menu_l.php';

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

echo '<div class="content-wrapper">';
echo '<section class="content-header">';
echo '<h1>' . '<i class="glyphicon glyphicon-user hidden-xs">' . '</i>' . ' <span class="hidden-xs">' . 'ใบส่งของ (ผู้รับเหมา)' . '</span>' . '</h1>';
echo '</section>';

echo '<section class="content">';
echo '<div class="container-fluid">';
echo '<div class="row">';
echo '<div class="col-md-12">';
echo '<div class="sticky-top mb-12">';
echo '<div class="card">';
echo '<div class="card-body">';
echo '<a href="../transport/transport.pdf" target="_blank" class="btn btn-primary">'.'พิมพ์'.'</a>'
    .'<a href="transport.php" class="btn btn-danger">'.'ยกเลิก'.'</a>';

$mpdf = new \Mpdf\Mpdf([
    'margin_top' => 4,
    'margin_left' => 8,
    'margin_right' => 8,
    'mode' => 'utf-8', 'format' => 'Letter',
    'default_font_size' => 14,
    'default_font' => 'sarabun'
]);

ob_start();

for ($i = 0; $i < count($_POST["checkbox"]); $i++) {
    if ($_POST["checkbox"][$i] != "") {
        $sql = "SELECT tb_transport.*, tb_customer.* FROM tb_transport
        LEFT JOIN tb_customer ON tb_transport.customer_name = tb_customer.customer_name
        WHERE transport_id = '" . $_POST["checkbox"][$i] . "'";
        $result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
        while ($row = mysqli_fetch_assoc($result)) {

            echo '<div class="container">';
            echo '<div class="row align-items-start">';
            echo '<div class="col-sm-12">';
            echo '<img src="../fwghead/head8delivery BILL.png"  height="110" >';
            echo '<table  class = "table table-borderless" width="100%">';

            echo '<tr>';
            echo '<td width = "5%">'.'เลขที่'.'</td>';
            echo '<td width = "40%">' . $row['transport_id'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td width = "5%">ชื่อลูกค้า</td>';
            echo '<td width = "40%">'.$row['customer_name'].'</td>';
            echo '<td width = "20%">'.'วันที่ .................................................'.'</td>';
            
            echo '</tr>';
            echo '<tr>';
            echo '<td width = "5%">ทีอยู่</td>';
            echo '<td width = "40%">'. $row['customer_address'].'</td>';
            echo '<td width = "20%">'.'โครงการ'. $row['department_name'].'</td>';
            echo '</tr>';
            echo '</table>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="container">';
            echo '<div class="row align-items-start">';
            echo '<div class="col-sm-12">';
            echo '</div>';
            echo '</div>';
            echo '</div>';


            echo '<br>';

            echo '<div class="container">';
            echo '<div class="row align-items-start">';
            echo '<div class="col-sm-12">';
            echo "<table id='customers' class = 'table table-bordered' border='1' >";

            echo '<thead>';
            echo '<tr>';
            echo "<th width='5%'>" . "<center>" . "ลำดับ" . "</center>" . "</th>";
            echo "<th width='15%'>" . "<center>" . "เลขที่" . "</center>" . "</th>";
            echo "<th width='40%'>" . "<center>" . "รายการ" . "</center>" . "</th>";
            echo "<th width='10%'>" . "<center>" . "จำนวน" . "</center>" . "</th>";
            echo "<th width='10%'>" . "<center>" . "หน่วย" . "</center>" . "</th>";
            echo "<th width='10%'>" . "<center>" . "ราคา/หน่วย" . "</center>" . "</th>";
            echo "<th width='10%'>" . "<center>" . "จำนวนเงิน" . "</center>" . "</th>";
            echo '</tr>';
            echo '</thead>';

            echo '<tbody>';
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
            for ($a = 0; $count < 12; $count++) {
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
            



    
        }
    }else{
        
    }
}


echo '<style>
    
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
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
     
      color: black;
    }
    </style>';



$html = ob_get_contents();
$mpdf->WriteHTML($html);
//$filename = 'Salary'.'_'.date('D-d-m-Y-H-i-s').'.pdf';
$mpdf->Output('../transport/transport.pdf');
$mpdf->cleanup();


echo '<a href="../transport/transport.pdf"  target="_blank" class="btn btn-primary">' . 'พิมพ์' . '</a>'
    . '<a href="transport.php" class="btn btn-danger">' . 'ยกเลิก' . '</a>';
echo '</div>';
echo '</div>';
echo '</div>';

echo '<div class="container">';
echo '<div class="row align-items-start">';
echo '<div class="col-sm-12">';
echo '<input type="hidden" name="transport_id" value=" $ID>" />';

echo '';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';

echo '</div>';


echo '</div>';
echo '</div>';

echo '</div>';


echo '</div>';
echo '</div>';

echo '</div>';

echo '</div>';
echo '</section>';
?>
   
   
<?php
include 'footerjs.php';
?>
