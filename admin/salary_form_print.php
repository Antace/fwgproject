<?php
include '../vendor/autoload.php';
$ID = mysqli_real_escape_string($con,$_GET['ID']);
$sql = "SELECT * FROM tb_salary
WHERE salary_id=$ID
ORDER BY emp_id DESC" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
$row = mysqli_fetch_array($result);
$query2 = "SELECT * FROM tb_dept ORDER BY id asc" or die("Error:" . mysqli_error());
$result2 = mysqli_query($con, $query2);


$mpdf = new \Mpdf\Mpdf([
  'margin_top' => 2,
  'margin_left' => 15,
  'mode' => 'utf-8', 'format' => [228, 139],
	'default_font_size' => 28,
	'default_font' => 'sarabun'
]);
echo'<a href="../salary/salary"  target="_blank" class="btn btn-primary">'.'พิมพ์สลิป'.'</a>'
        .'<a href="salary.php" class="btn btn-danger">'.'ยกเลิก'.'</a>';    
ob_start();
?>
<div class="container">
  <div class="row align-items-start">
    <div class="col-sm-12">
    <h3 align="center">บริษัท ฟายด์ เวอร์ค กรุ๊ป จำกัด</h3>
    <table  class = "table table-borderless" width="100%">
      <tr>
        <td>รหัส</td>
        <td><?php echo str_pad( $row['emp_id'],4,"0",STR_PAD_LEFT); ?></td>
        <td>ชื่อ</td>
        <td><?php echo $row['employee_name'];?></td>
        <td>แผนก</td>
        <td><?php echo $row['name_dept'];?></td>
      </tr>
      <tr>
        <td>เลขที่บัญชี</td>
        <td><?php echo $row['Accountnumber'];?></td>
        <td>ตำแหน่ง</td>
        <td><?php echo $row['name_position'];?></td>
         <td>วันที่</td>
        <td><?php echo date('d/m/Y',strtotime( $row['salary_date'])); ?></td>
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

@page { sheet-size: A3-L; }

@page bigger { sheet-size: 228mm 139mm; }

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
        <th width='35%'><center>รายได้</center></th>
        <th width='10%'><center>จำนวน</center></th>
        <th width='35%'><center>รายการหัก</center></th>
        <th width='10%'><center>จำนวน</center></th>
        
    </tr>
</thead>
<tbody>
    <tr>
        <td>เงินเดือน/ค่าจ้างรวม </td>
        <td align="right"><?php echo number_format($row['Salary'],2);?></td>
        <td>หักสมทบประกันสังคม </td>
        <td align="right"><?php echo number_format( $row['SocialSecurity'],2); ?></td>
        
    </tr>
    <tr>
        <td>เบี้ยเลี้ยง </td>
        <td align="right"><?php echo number_format( $row['Allowance'],2);?></td>
        <td>หักภาษี </td>
        <td align="right"><?php echo number_format( $row['Tax'],2); ?></td>
    </tr>
    <tr>
        <td>ค่าตำแหน่ง </td>
        <td align="right"><?php echo number_format( $row['Position'],2);?></td>
        <td>หักมาสาย </td>
        <td align="right"><?php echo number_format( $row['Late'],2); ?></td>
    </tr>
    <tr>
        <td>ค่าเช่าบ้าน </td>
        <td align="right"><?php echo number_format( $row['House'],2);?></td>
        <td>หักขาดงานเกินกำหนด </td>
        <td align="right"><?php echo number_format( $row['Absentt'],2); ?></td>
    </tr>
    <tr>
        <td>ค่าโทรศัพท์ </td>
        <td align="right"><?php echo number_format( $row['Phone'],2);?></td>
        <td>หักเบี้ยเลี้ยงลากิจ/ป่วย/พักร้อน </td>
        <td align="right"><?php echo number_format( $row['SBH'],2); ?></td>
    </tr>
    <tr>
        <td>เบี้ยขยัน </td>
        <td align="right"><?php echo number_format( $row['Diligent'],2);?></td>
        <td>เบิกล่วงหน้า </td>
        <td align="right"><?php echo number_format( $row['Reveal'],2); ?></td>
    </tr>
    <tr>
        <td>ค่าน้ำมัน </td>
        <td align="right"><?php echo number_format( $row['Oil'],2);?></td>
        <td>หักกองทุนสำรองเลี้ยงชีพ </td>
        <td align="right"><?php echo number_format( $row['ReserveFund'],2); ?></td>
    </tr>
    <tr>
        <td>โบนัส </td>
        <td align="right"><?php echo number_format( $row['Bonus'],2);?></td>
        <td>หักจ่ายอื่นๆ </td>
        <td align="right"><?php echo number_format( $row['Other'],2); ?></td>
    </tr>
    <tr>
        <td>เงินได้อื่นๆ </td>
        <td align="right"><?php echo number_format( $row['Income'],2);?></td>
        <td>หักประกันอุบัติเหตุ/ชีวิต </td>
        <td align="right"><?php echo number_format( $row['insuranceAL'],2); ?></td>
    </tr>
    <tr>
        <td>ค่าทำงานล่วงเวลา :</td>
        <td align="right"><?php echo number_format( $row['Overtime'],2); ?></td>
        <td>หักกยศ.</td>
        <td align="right"><?php echo number_format( $row['SLF'],2); ?></td>
        <td align="center">เงินรับสุทธิ</td>
    </tr>
    <tr>
        <td><center>รวมเงินได้</center> </td> 
        <td align="right"><?php echo number_format( $row['sum1'],2);?></td>
        <td><center>รวมรายการหัก</center> </td>
        <td align="right"><?php echo number_format( $row['sum2'],2);?></td>
        <td align="center"><?php echo number_format( $row['total'],2);?></td>
      </tr>
</tbody>
</table>
<?php

        $html=ob_get_contents();
        $mpdf->WriteHTML($html);
        //$filename = 'Salary'.'_'.date('D-d-m-Y-H-i-s').'.pdf';
        $mpdf->Output('../salary/salary');
        $mpdf->cleanup();
    

        echo'<a href="../salary/salary"  target="_blank" class="btn btn-primary">'.'พิมพ์สลิป'.'</a>'
        .'<a href="salary.php" class="btn btn-danger">'.'ยกเลิก'.'</a>';    
?>


  </div>
</div>
</div>

<div class="container">
  <div class="row align-items-start">
  <div class="col-sm-12">
  <input type="hidden" name="salary_id" value="<?php echo $ID; ?>" />
        
        
      </div>
    </div>
</div>