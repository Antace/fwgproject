<?php
$ID = mysqli_real_escape_string($con,$_GET['ID']);
$sql = "SELECT * FROM tb_salary
WHERE salary_id=$ID
ORDER BY emp_id DESC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
$row = mysqli_fetch_array($result);
$query2 = "SELECT * FROM tb_dept ORDER BY id asc" or die("Error:" . mysqli_error($con));
$result2 = mysqli_query($con, $query2);

?>
<form action="salary_form_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
<div class="container">
  <div class="row align-items-start">
    <div class="col-sm-12">
    <h3 align="center">บันทึกเงินเดือน</h3>
</div>
</div>
</div>
<div class="container">
  <div class="row align-items-start">
    <div class="col-sm-6">
    
</div>
<div class="col-sm-3">
    
</div>
<div class="col-sm-3">
<!-- <input type="date" name="salary_date"  required class="form-control"> -->
<input type="date" name = "salary_date" value="<?php echo $row['salary_date']; ?>" required class="form-control" >
</div>
</div>
</div>


<div class="container">
  <div class="row align-items-start">
  <div class="col-sm-2">
    รหัส :
</div>
<div class="col-sm-2">
<input type="text" name="emp_id" class="form-control" value="<?php echo $row['emp_id']; ?>" readonly />
  </div>
    <div class="col-sm-1">
    ชื่อ :
</div>
<div class="col-sm-3">
<input type="text" name="employee_name" required class="form-control" value="<?php echo $row['employee_name'];?>" readonly>
  </div>
  <div class="col-sm-1">
    แผนก :
</div>
<div class="col-sm-3">
<input type="text" name="name_dept" required class="form-control"  value="<?php echo $row['name_dept'];?>" readonly>
  </div>
  
</div>

</div>
<div class="container">
  <div class="row align-items-start">
    <div class="col-sm-2">
    เลขที่บัญชี :
</div>
<div class="col-sm-2">
<input type="text" name="Accountnumber" required class="form-control" maxlength="10" value="<?php echo $row['Accountnumber'];?>"readonly >
  </div>
  <div class="col-sm-1">
    ตำแหน่ง :
</div>
<div class="col-sm-3">
<input type="text" name="name_position" required class="form-control"  value="<?php echo $row['name_position'];?>"readonly >
  </div>
</div>
</div>
<br>
<div class="container">
  <div class="row align-items-start">
  <div class="col-sm-12">
<table id='display' class = "table table-bordered">
<thead>
    <tr>
        <th width='30%'>รายได้</th>
        <th width='20%'>จำนวน</th>
        <th width='30%'>รายการหัก</th>
        <th width='20%'>จำนวน</th>
    </tr>
</thead>
<tbody>
    <tr>
        <td>เงินเดือน :</td>
        <td><input type="number" name="Salary" required class="form-control"  value="<?php echo $row['Salary'];?>" ></td>
        <td>หักสมทบประกันสังคม :</td>
        <td><input type="number" name="SocialSecurity" required class="form-control" value="<?php echo $row['SocialSecurity']; ?>"   ></td>
    </tr>
    <tr>
        <td>เบี้ยเลี้ยง :</td>
        <td><input type="number" name="Allowance" required class="form-control"  value="<?php echo $row['Allowance'];?>" ></td>
        <td>หักภาษี :</td>
        <td><input type="number" name="Tax" required class="form-control" value="<?php echo $row['Tax']; ?>"  ></td>
    </tr>
    <tr>
        <td>ค่าตำแหน่ง :</td>
        <td><input type="number" name="Position" required class="form-control" value="<?php echo $row['Position'];?>"readonly ></td>
        <td>หักมาสาย :</td>
        <td><input type="number" name="Late" required class="form-control" value="<?php echo $row['Late']; ?>"  ></td>
    </tr>
    <tr>
        <td>ค่าเช่าบ้าน :</td>
        <td><input type="number" name="House" required class="form-control"  value="<?php echo $row['House'];?>" readonly></td>
        <td>หักขาดงานเกินกำหนด :</td>
        <td><input type="number" name="Absentt" required class="form-control" value="<?php echo $row['Absentt']; ?>"  ></td>
    </tr>
    <tr>
        <td>ค่าโทรศัพท์ :</td>
        <td><input type="number" name="Phone" required class="form-control"  value="<?php echo $row['Phone'];?>" readonly></td>
        <td>หักเบี้ยเลี้ยงลากิจ / ป่วย / พักร้อน :</td>
        <td><input type="number" name="SBH" required class="form-control" value="<?php echo $row['SBH']; ?>"  ></td>
    </tr>
    <tr>
        <td>เบี้ยขยัน :</td>
        <td><input type="number" name="Diligent" required class="form-control"  value="<?php echo $row['Diligent'];?>" ></td>
        <td>เบิกล่วงหน้า :</td>
        <td><input type="number" name="Reveal" required class="form-control" value="<?php echo $row['Reveal']; ?>" ></td>
    </tr>
    <tr>
        <td>ค่าน้ำมัน :</td>
        <td><input type="number" name="Oil" required class="form-control"  value="<?php echo $row['Oil'];?>" ></td>
        <td>หักกองทุนสำรองเลี้ยงชีพ :</td>
        <td><input type="number" name="ReserveFund" required class="form-control" value="<?php echo $row['ReserveFund']; ?>"  ></td>
    </tr>
    <tr>
        <td>โบนัส :</td>
        <td><input type="number" name="Bonus" required class="form-control"  value="<?php echo $row['Bonus'];?>" ></td>
        <td>หักจ่ายอื่นๆ :</td>
        <td><input type="number" name="Other" required class="form-control" value="<?php echo $row['Other']; ?>" ></td>
    </tr>
    <tr>
        <td>เงินได้อื่นๆ :</td>
        <td><input type="number" name="Income" required class="form-control"  value="<?php echo $row['Income'];?>" ></td>
        <td>หักประกันอุบัติเหตุ/ชีวิต :</td>
        <td><input type="number" name="insuranceAL" required class="form-control" value="<?php echo $row['insuranceAL']; ?>"  ></td>
    </tr>
    <tr>
        <td>ค่าทำงานล่วงเวลา :</td>
        <td><input type="decimal" name="Overtime" required class="form-control" value="<?php echo $row['Overtime']; ?>"  ></td>
        <td>หักกยศ.:</td>
        <td><input type="number" name="SLF" required class="form-control" value="<?php echo $row['SLF']; ?>"  ></td>
    </tr>
    
</tbody>
</table>

  </div>
</div>
</div>

<div class="container">
  <div class="row align-items-start">
  <div class="col-sm-12">
  <input type="hidden" name="salary_id" value="<?php echo $ID; ?>" />
        <button type="submit" class="btn btn-success">เพิ่มข้อมูล</button>
        <a href="salary.php" class="btn btn-danger">ยกเลิก</a>
      </div>
    </div>
</div>
</form>