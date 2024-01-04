<?php
include '../vendor/autoload.php';
include 'h.php';
include 'menutop.php';
include 'menu_l.php';

echo'<div class="content-wrapper">';
      echo'<section class="content-header">';
      echo'<h1>'
        .'<i class="glyphicon glyphicon-user hidden-xs">'.'</i>'.' <span class="hidden-xs">'.'ข้อมูลเงินเดือน'.'</span>'
        
        .'</h1>';
        
      echo'</section>';
      echo'<section class="content">';
        echo'<div class="container-fluid">';
          echo'<div class="row">';
            echo'<div class="col-md-12">';
              echo'<div class="sticky-top mb-12">';
                echo'<div class="card">';
                  echo'<div class="card-body">';
                  echo'<a href="../salary/salary"  target="_blank" class="btn btn-primary">'.'พิมพ์สลิป'.'</a>'
        .'<a href="salary.php" class="btn btn-danger">'.'ยกเลิก'.'</a>';//  echo '<pre>';
//  print_r($_POST);
//  echo '</pre>';
$mpdf = new \Mpdf\Mpdf([
  'margin_top' => 2,
  'margin_left' => 15,
  'mode' => 'utf-8', 'format' => [228, 139],
	'default_font_size' => 28,
	'default_font' => 'sarabun'
]);

ob_start();
for($i=0;$i<count($_POST["checkbox"]);$i++)

{
    if($_POST["checkbox"][$i]!="")
    {
        // $string = implode(",",$_POST["checkbox"]);
        $sql = "SELECT * FROM tb_salary
        WHERE salary_id = '".$_POST["checkbox"][$i]."'";
        $result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
        while($row = mysqli_fetch_assoc($result)) {
          
          echo '<div class="container">';
          echo '<div class="row align-items-start">';
          echo '<div class="col-sm-12">';
          echo '<h3 align="center">'.'บริษัท ฟายด์ เวอร์ค กรุ๊ป จำกัด '.'</h3>';
        echo '<table  class = "table table-borderless" width="100%">';
        
        echo '<tr>';
        echo'<td>'.'รหัส'.'</td>';
        echo'<td>'. str_pad($row['emp_id'],4,"0",STR_PAD_LEFT).'</td>';
        echo'<td>'.'ชื่อ'.'</td>';
        echo'<td>'. $row['employee_name'].'</td>';
        echo'<td>'.'แผนก'.'</td>';
        echo'<td>'.$row['name_dept'].'</td>';
        echo'</tr>';
          echo'<tr>';
            echo'<td>'.'เลขที่บัญชี'.'</td>';
            echo'<td>'.$row['Accountnumber'].'</td>';
            echo'<td>'.'ตำแหน่ง'.'</td>';
            echo'<td>'.$row['name_position'].'</td>';
            echo'<td>'.'วันที่'.'</td>';
            echo'<td>'.date('d/m/Y',strtotime( $row['salary_date'])).'</td>';
          echo'</tr>';
        echo'</table>';
    echo'</div>';
    echo'</div>';
    echo'</div>';
    
    echo'<div class="container">';
      echo'<div class="row align-items-start">';
      echo'<div class="col-sm-12">';
        
         
      echo'</div>';
      echo'</div>';
      echo'</div>';

    
    echo'<br>';
    
    echo'<div class="container">';
      echo'<div class="row align-items-start">';
      echo'<div class="col-sm-12">';
    echo"<table id='customers' class = 'table table-bordered' >";
    echo'<thead>';
        echo'<tr>';
            echo"<th width='35%'>"."<center>".'รายได้'."</center>"."</th>";
            echo"<th width='10%'>"."<center>".'จำนวน'."</center>"."</th>";
            echo"<th width='35%'>"."<center>".'รายการหัก'."</center>"."</th>";
            echo"<th width='10%'>"."<center>".'จำนวน'."</center>"."</th>";
           
        echo'</tr>';
    echo'</thead>';
    echo'<tbody>';
        echo'<tr>';
            echo'<td>'.'เงินเดือน/ค่าจ้างรวม'.'</td>';
            echo'<td align="right">'.number_format($row['Salary'],2).'</td>';
            echo'<td>'.'หักสมทบประกันสังคม'.'</td>';
            echo'<td align="right">'.number_format( $row['SocialSecurity'],2).'</td>';
            
        echo'</tr>';
        echo'<tr>';
            echo'<td>'.'เบี้ยเลี้ยง'.'</td>';
            echo'<td align="right">'.number_format( $row['Allowance'],2).'</td>';
            echo'<td>'.'หักภาษี'.'</td>';
            echo'<td align="right">'.number_format( $row['Tax'],2).'</td>';
        echo'</tr>';
        echo'<tr>';
            echo'<td>'.'ค่าตำแหน่ง'.'</td>';
            echo'<td align="right">'.number_format( $row['Position'],2).'</td>';
            echo'<td>'.'หักมาสาย'.'</td>';
            echo'<td align="right">'.number_format( $row['Late'],2).'</td>';
        echo'</tr>';
        echo'<tr>';
            echo'<td>'.'ค่าเช่าบ้าน'.'</td>';
            echo'<td align="right">'.number_format( $row['House'],2).'</td>';
            echo'<td>'.'หักขาดงานเกินกำหนด'.'</td>';
            echo'<td align="right">'.number_format( $row['Absentt'],2).'</td>';
        echo'</tr>';
        echo'<tr>';
            echo'<td>'.'ค่าโทรศัพท์'.'</td>';
            echo'<td align="right">'.number_format( $row['Phone'],2).'</td>';
            echo'<td>'.'หักเบี้ยเลี้ยงลากิจ/ป่วย/พักร้อน'.'</td>';
            echo'<td align="right">'.number_format( $row['SBH'],2).'</td>';
        echo'</tr>';
        echo'<tr>';
            echo'<td>'.'เบี้ยขยัน'.'</td>';
            echo'<td align="right">'.number_format( $row['Diligent'],2).'</td>';
            echo'<td>'.'เบิกล่วงหน้า'.'</td>';
            echo'<td align="right">'.number_format( $row['Reveal'],2).'</td>';
        echo'</tr>';
        echo'<tr>';
            echo'<td>'.'ค่าน้ำมัน'.'</td>';
            echo'<td align="right">'.number_format( $row['Oil'],2).'</td>';
            echo'<td>'.'หักกองทุนสำรองเลี้ยงชีพ'.'</td>';
            echo'<td align="right">'.number_format( $row['ReserveFund'],2).'</td>';
        echo'</tr>';
        echo'<tr>';
            echo'<td>'.'โบนัส'.'</td>';
            echo'<td align="right">'.number_format( $row['Bonus'],2).'</td>';
            echo'<td>'.'หักจ่ายอื่นๆ'.'</td>';
            echo'<td align="right">'.number_format( $row['Other'],2).'</td>';
        echo'</tr>';
        echo'<tr>';
            echo'<td>'.'เงินได้อื่นๆ'.'</td>';
            echo'<td align="right">'.number_format( $row['Income'],2).'</td>';
            echo'<td>'.'หักประกันอุบัติเหตุ/ชีวิต'.'</td>';
            echo'<td align="right">'.number_format( $row['insuranceAL'],2).'</td>';
        echo'</tr>';
        echo'<tr>';
            echo'<td>'.'ค่าทำงานล่วงเวลา'.'</td>';
            echo'<td align="right">'.number_format( $row['Overtime'],2).'</td>';

            echo'<td>'.'หักกยศ.'.'</td>';
            echo'<td align="right">'.number_format( $row['SLF'],2).'</td>';
            echo'<td align="center">'.'เงินรับสุทธิ'.'</td>';
        echo'</tr>';
        echo'<tr>';
            echo'<td>'.'<center>'.'รวมเงินได้'.'</center>'.'</td>'; 
            echo'<td align="right">'.number_format( $row['sum1'],2).'</td>';
            echo'<td>'.'<center>'.'รวมรายการหัก'.'</center>'.'</td>';
            echo'<td align="right">'.number_format( $row['sum2'],2).'</td>';
            echo'<td align="center">'.number_format( $row['total'],2).'</td>';
          echo'</tr>';
    echo'</tbody>';
    echo'</table>';
        }
        
    }
}
// echo '<pre>';
// print_r($string);
// print_r($sql);
// print_r($row);
// echo '</pre>';
// exit;
// $ID = mysqli_real_escape_string($con,$_GET['checkbox[]']);
// $sql = "SELECT * FROM tb_salary
// WHERE salary_id=$ID
// ORDER BY emp_id DESC" or die("Error:" . mysqli_error());
// $result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());

// $query2 = "SELECT * FROM tb_dept ORDER BY id asc" or die("Error:" . mysqli_error());
// $result2 = mysqli_query($con, $query2);





    echo'<style>
    
    @page { sheet-size: A3-L; }
    
    @page bigger { sheet-size: 228mm 139mm; }
    
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
    
    
    
        $html=ob_get_contents();
        $mpdf->WriteHTML($html);
        //$filename = 'Salary'.'_'.date('D-d-m-Y-H-i-s').'.pdf';
        $mpdf->Output('../salary/salary');
        $mpdf->cleanup();
    

        echo'<a href="../salary/salary"  target="_blank" class="btn btn-primary">'.'พิมพ์สลิป'.'</a>'
        .'<a href="salary.php" class="btn btn-danger">'.'ยกเลิก'.'</a>';    
        echo'</div>';
      echo'</div>';
      echo'</div>';
      
      echo'<div class="container">';
        echo'<div class="row align-items-start">';
        echo'<div class="col-sm-12">';
        echo'<input type="hidden" name="salary_id" value=" $ID>" />';
              
              echo'';
            echo'</div>';
          echo'</div>';
      echo'</div>';
        echo'</div>';
                  
                  echo'</div>';
                
                
                echo'</div>';
                echo'</div>';
           
            echo'</div>';
          
          
          echo'</div>';
          echo'</div>';
      
          echo'</div>';
    
    echo'</div>';
      echo'</section>';
    ?>
   

<?php
include 'footerjs.php';
?>