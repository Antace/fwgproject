<?php
include '../vendor/autoload.php';
//require_once __DIR__ . '/vendor/autoload.php';
include 'h.php';
include 'menutop.php';
include 'menu_l.php';


$result1 = mysqli_query($con, $sql1) or die("Error in query: $sql1 " . mysqli_error());

echo '<div class="content-wrapper">';
echo '<section class="content-header">';
echo '<h1>'
  . '<i class="glyphicon glyphicon-user hidden-xs">' . '</i>' . ' <span class="hidden-xs">' . 'ข้อมูลเงินเดือน' . '</span>'

  . '</h1>';

echo '</section>';
echo '<section class="content">';
echo '<div class="container-fluid">';
echo '<div class="row">';
echo '<div class="col-md-12">';
echo '<div class="sticky-top mb-12">';
echo '<div class="card">';
echo '<div class="card-body">';
echo '<a href="../order/order.pdf"  target="_blank" class="btn btn-primary">' . 'พิมพ์' . '</a>'
  . '<a href="order.php" class="btn btn-danger">' . 'ยกเลิก' . '</a>'; //  echo '<pre>';
//  print_r($_POST);
//  echo '</pre>';
$mpdf = new \Mpdf\Mpdf([
  'mode' => 'utf-8', 'format' => 'A4',
  'margin_top' => 8,
  'default_font_size' => 16,
  'default_font' => 'sarabun'
]);


ob_start();

for ($i = 0; $i < count($_POST["checkbox"]); $i++) {
  if ($_POST["checkbox"][$i] != "") {

   
    // $string = implode(",",$_POST["checkbox"]);
    $sql = "SELECT * FROM tb_order
        WHERE order_id = '" . $_POST["checkbox"][$i] . "'";
    $result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error());
    while ($row = mysqli_fetch_assoc($result)) {
      
      echo '<div class="container" >';
      echo '<div class="row align-items-start">';
      echo '<div class="col-sm-12">';
      echo '<h2 align="center">ใบสั่งผลิต</h2>';
      echo '<table  class = "table table-borderless" width="100%">';
      echo '<tr>';
      echo '<td align="left">' . '<h3>'  . $row['label_name'] . '</h3>' . '</td>';
      echo '</tr>';
      echo '<tr>';

      echo '<td>' . 'เลขที่ : ' .  $row['order_id'] . '</td>';
      echo '<td width="20%">' . 'วันที่ : ' . date('d/m/Y', strtotime($row['order_date'])) . '</td>';
      echo '</tr>';

      echo '<tr>';
      echo '<td>' . 'ผู้สั่ง : ' .  $row['username'] . '</td>';
      echo '</tr>';
      echo '<tr>';

      echo '<td>' . 'รายละเอียด : ' . $row['label_detail'] . '</td>';

      echo '</tr>';

     
      echo '</table>';

      
      

      echo '<table class = "table table-borderless" align="center" width="100%" >';
      echo '<tr>';
      echo '<td>';
      echo '<img src="../label_img/' . $row["label_pic1"] . '" height="150px">';
      echo '</td>';
      echo '<td>';
      echo '<img src="../label_img/' . $row["label_pic2"] . '" height="150px">';
      echo '</td>';
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

      echo '<div class="container" >';
      echo '<div class="row align-items-start">';
      echo '<div class="col-sm-12">';
      echo '<table id="customers" class = "table table-bordered" >';
      echo '<thead>';
      echo '<tr>';
      echo '<td align="center" width="3%"><h3>ลำดับ</h3></td>';
      echo '<td align="center" width="20%"><h3>รายการ</h3></td>';
      echo '<td align="center" width="20%"><h3>แปลง</h3></td>';
      echo '<td align="center" width="50%"><h3>โครงการ</h3></td>';
      echo '<td align="center" width="7%"><h3>-</h3></td>';

      echo '</tr>';
      echo '</thead>';

      $total = 0;
      $a=1;
      $sql1 = "SELECT * FROM tb_orderlist WHERE order_id='" . $_POST["checkbox"][$i] . "' ORDER BY orderlist_id DESC" or die("Error:" . mysqli_error());
      $result1 = mysqli_query($con, $sql1);
      while ($row1 = mysqli_fetch_array($result1)) {

        $label_ida = $row1['label_ida'];

        $sql2 = "SELECT * FROM tb_labeldetail WHERE label_ida=$label_ida";
        $query2 = mysqli_query($con, $sql2);
        $row2 = mysqli_fetch_array($query2);

        echo "<tr>";
        echo "<td align='center'><h3>"  . $a++ . "</h3></td>";
        echo "<input type='hidden' style='text-align:right;'  class='form-control' name='orderlist_id[]' value='$row1[orderlist_id]' readonly>";
        echo "<input type='hidden' style='text-align:right;'  class='form-control' name='label_ida[]' value='$row2[label_ida]' readonly>";
        echo "<td align='center'><h3>"  . $row2["label_numberid"] . "</h3></td>";

        echo "<td align='center'><h3>" . "<font color ='red'>" . $row2["label_place"] . "</font>" . "</td>";
        echo "<td align='center'><h3>" . $row2["department_name"] . "</h3></td>";
        echo "<td align='center'><h3>" . $row2["label_orderstatus"] . "</h3></td>";



        echo "</tr>";
      }
      
      echo '</table>';
      echo '<div style="page-break-after: always"></div>';
      
    }
  }
}

echo '<style>
    
@page { sheet-size: A4; }

@page bigger { sheet-size: 420mm 370mm; }

@page toc { sheet-size: A4; }

h1.bigsection {
        
        page-break-after: always;
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
    </style>';

$html = ob_get_contents();
$mpdf->WriteHTML($html);

//$filename = 'Salary'.'_'.date('D-d-m-Y-H-i-s').'.pdf';
$mpdf->Output('../order/order');
$mpdf->cleanup();


echo '<a href="../order/order"  target="_blank" class="btn btn-primary">' . 'พิมพ์' . '</a>'
  . '<a href="order.php" class="btn btn-danger">' . 'ยกเลิก' . '</a>';
echo '</div>';
echo '</div>';
echo '</div>';

echo '<div class="container">';
echo '<div class="row align-items-start">';
echo '<div class="col-sm-12">';
echo '<input type="hidden" name="order_id" value=" $ID>" />';

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