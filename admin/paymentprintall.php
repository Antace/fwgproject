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
echo '<h1>' . '<i class="glyphicon glyphicon-user hidden-xs">' . '</i>' . ' <span class="hidden-xs">' . 'บันทึกการจ่ายเงิน' . '</span>' . '</h1>';
echo '</section>';

echo '<section class="content">';
echo '<div class="container-fluid">';
echo '<div class="row">';
echo '<div class="col-md-12">';
echo '<div class="sticky-top mb-12">';
echo '<div class="card">';
echo '<div class="card-body">';
echo '<a href="../payment/payment.pdf" target="_blank" class="btn btn-primary">'.'พิมพ์'.'</a>'
    .'<a href="payment.php" class="btn btn-danger">'.'ยกเลิก'.'</a>';

$mpdf = new \Mpdf\Mpdf([
    'margin_top' => 8,
    'margin_left' => 8,
    'margin_right' => 8,
    'mode' => 'utf-8', 'format' => 'Letter',
    'default_font_size' => 14,
    'default_font' => 'sarabun'
]);

ob_start();

for ($i = 0; $i < count($_POST["checkbox"]); $i++) {
    if ($_POST["checkbox"][$i] != "") {
        $sql = "SELECT tb_payment.*, tb_contractor.* FROM tb_payment
        LEFT JOIN tb_contractor ON tb_payment.contractor_nickname = tb_contractor.contractor_nickname
        WHERE payment_id = '" . $_POST["checkbox"][$i] . "'";
        $result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
        while ($row = mysqli_fetch_assoc($result)) {

            echo '<div class="container">';
            echo '<div class="row align-items-start">';
            echo '<div class="col-sm-12">';
            echo '<h3 align="center">' . 'ใบบันทึกส่งงาน ผรม. โรงงาน' . '</h3>';
            echo '<table  class = "table table-borderless" width="100%">';

            echo '<tr>';
            echo '<td width = "10%">' . 'เลขที่' . '</td>';
            echo '<td width = "20%">' . $row['payment_id'] . '</td>';
            echo '<td>' . '</td>';
            echo '<td>' . '</td>';
            echo '<td width = "10%">' . 'วันที่' . '</td>';
            echo '<td width = "20%">' . date('d/m/Y', strtotime($row['payment_date'])) . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>' . 'ชื่อผู้รับเหมา' . '</td>';
            echo '<td>' . $row['contractor_name'] . '</td>';
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
            echo "<th width='7%'>" . "<center>" . 'ลำดับ' . "</center>" . "</th>";
            echo "<th width='40%'>" . "<center>" . 'รายการ' . "</center>" . "</th>";
            echo "<th width='10%'>" . "<center>" . 'ราคา/หน่วย' . "</center>" . "</th>";
            echo "<th width='10%'>" . "<center>" . 'จำนวน' . "</center>" . "</th>";
            echo "<th width='10%'>" . "<center>" . 'หน่วย' . "</center>" . "</th>";
            echo "<th width='10%'>" . "<center>" . 'จำนวนเงิน' . "</center>" . "</th>";
            echo '</tr>';
            echo '</thead>';

            echo '<tbody>';
            $contractor_nickname = $row['contractor_nickname'];
            $d_s = $row['payment_ds'];
            $d_e = $row['payment_de'];
            $query = "SELECT tb_productionlist.*,tb_production.*,tb_product.*,SUM(production_uom) as total FROM tb_productionlist 
                      LEFT JOIN tb_production ON tb_productionlist.production_id = tb_production.production_id
                      LEFT JOIN tb_product ON tb_productionlist.product_id = tb_product.product_id
                      WHERE (contractor_nickname = '$contractor_nickname' AND production_date BETWEEN '$d_s' AND '$d_e' AND production_status = '1')
                      GROUP BY product_name " or die("$query -> Error :" . mysqli_error($con));
            $result1 = mysqli_query($con, $query);
            $a = 1;
            while ($row1 = mysqli_fetch_array($result1)) {
                $total = $row1['total'] * $row1['production_price'];
                $sum += $total;
                $vat = $sum * 0.03;
                $balance = $sum - $vat;
                echo '<tr>';
                echo '<td align="center">' . $a++ . '</td>';
                echo '<td>' . $row1['product_name'] . '</td>';
                echo '<td align="right">' . number_format($row1['product_price'], 2) . '</td>';
                echo '<td align="right">' . number_format($row1['total'], 2) . '</td>';
                echo '<td align="center">' . $row1['product_unit'] . '</td>';
                echo '<td align="right">' . number_format($total, 2) . '</td>';

                echo '</tr>';
            }
            echo "<tr>";
            echo "<td colspan='2' align='center'>";
            echo "<br>";
            echo "<br>";
            echo Convert($balance);
            echo "</td>";
            echo "<td colspan='3' align='left'>";
            echo "รวม";
            echo "<br>";
            echo "หัก 3%";
            echo "<br>";
            echo "รวมทั้งสิ้น";
            echo "</td>";
            echo "<td  align='right'>";
            echo number_format($sum, 2);
            echo "<br>";
            echo number_format($vat, 2);
            echo "<br>";
            echo number_format($balance, 2);
            echo "</td>";
            echo "</tr>";
            echo '</tbody>';
            echo '</table>';

            echo "<br>";
            echo "<br>";
            echo 'หมายเหตุ...................................................................................................................';
            echo "<br>";
            echo "<br>";
            echo 'ผู้รับเงิน.......................................................................................';
            echo '<div style="page-break-after: always"></div>';



            echo '<div class="container">';
            echo '<div class="row align-items-start">';
            echo '<div class="col-sm-12">';
            echo '<h3 align="center">' . 'ยอดหักค่าใช้จ่ายที่ต้องคืนบริษัท' . '</h3>';
            echo '<table  class = "table table-borderless" width="100%">';

            echo '<tr>';
            echo '<td width = "10%">' . 'เลขที่' . '</td>';
            echo '<td width = "20%">' . $row['payment_id'] . '</td>';
            echo '<td>' . '</td>';
            echo '<td>' . '</td>';
            echo '<td width = "10%">' . 'วันที่' . '</td>';
            echo '<td width = "20%">' . date('d/m/Y', strtotime($row['payment_date'])) . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>' . 'ชื่อผู้รับเหมา' . '</td>';
            echo '<td>' . $row['contractor_name'] . '</td>';
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



            echo "<table id='customers'  class = 'table table-bordered' border='1'>";
            echo "<thead>";
            echo "<tr class='' align ='center'>";
            echo "<th width='3%'>" . "<center>" . "ลำดับ" . "</center>" . "</th>";
            echo "<th width='39%'>" . "<center>" . "ใบเบิกเลขที่" . "</center>" . "</th>";
            echo "<th width='25%'>" . "<center>" . "ประเภท" . "</center>" . "</th>";
            echo "<th width='20%'>" . "<center>" . "วันที่ทำรายการ" . "</center>" . "</th>";
            echo "<th width='13%'>" . "<center>" . "จำนวนเงิน" . "</center>" . "</th>";
            echo "</tr>";
            echo '</thead>';
            echo '<tbody>';
            $query1 = "SELECT * FROM tb_rexpenses WHERE (contractor_nickname = '$contractor_nickname' AND rexpenses_date BETWEEN '$d_s' AND '$d_e' AND 	rexpenses_status ='1')";
            $result2 = mysqli_query($con, $query1);

            $a = 1;
            while ($row2 = mysqli_fetch_array($result2)) {
                $rexpensestotal += $row2['rexpenses_uom'];
                echo "<tr>";
                echo "<td align=center>" . $a++  . "</td> ";
                echo "<td >" . $row2["rexpenses_id"] . "</td> ";
                echo "<td >" . $row2["expenses_name"] . "</td> ";
                echo "<td align='center'>" . date('d/m/Y', strtotime($row2["rexpenses_date"])) . "</td> ";
                echo "<td align='right'>" . $row2["rexpenses_uom"] . "</td> ";
                echo "</tr>";
            }
            echo "<tr>";
            echo "<td colspan='3' align='center'>";
            echo Convert($rexpensestotal);
            echo "</td>";
            echo "<td  align='left'>";
            echo "รวมทั้งสิ้น";
            echo "</td>";
            echo "<td  align='right'>";
            echo number_format($rexpensestotal, 2);
            echo "</td>";
            echo "</tr>";
            echo '</tbody>';
            echo '</table>';
            echo "<br>";
            echo "<br>";
            echo 'ผู้จ่ายเงิน......................................................................................';
            echo "<br>";
            echo "<br>";
            echo 'ผู้รับเงิน.......................................................................................';
            echo '<div style="page-break-after: always"></div>';
        }
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
     
      border-collapse: collapse;
      width: 100%;
    }
    
    #customers td, #customers th {
      border: 1px solid #000;
      padding: 4px;
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
$mpdf->Output('../payment/payment.pdf');
$mpdf->cleanup();


echo '<a href="../payment/payment.pdf"  target="_blank" class="btn btn-primary">' . 'พิมพ์' . '</a>'
    . '<a href="payment.php" class="btn btn-danger">' . 'ยกเลิก' . '</a>';
echo '</div>';
echo '</div>';
echo '</div>';

echo '<div class="container">';
echo '<div class="row align-items-start">';
echo '<div class="col-sm-12">';
echo '<input type="hidden" name="payment_id" value=" $ID>" />';

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
