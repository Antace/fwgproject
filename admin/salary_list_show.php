<script language="JavaScript">
	function ClickCheckAll(vol)
	{
	
		var a=1;
		for(a=1;a<=document.frmsalary.hdnCount.value;a++)
		{
			if(vol.checked == true)
			{
				eval("document.frmsalary.checkbox"+a+".checked=true");
			}
			else
			{
				eval("document.frmsalary.checkbox"+a+".checked=false");
			}
		}
	}
</script>
<?php 

  if(@$_GET['do']=='success'){
    echo '<script type="text/javascript">
          swal("", "ทำรายการสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=salary.php" />';

  }else if(@$_GET['do']=='finish'){
    echo '<script type="text/javascript">
          swal("", "แก้ไขสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=salary.php" />';

  }else if(@$_GET['do']=='wrong'){
    echo '<script type="text/javascript">
          swal("", "รหัสผ่านใหม่ไม่ตรงกัน !!", "warning");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=salary.php" />';

  }else if(@$_GET['do']=='error'){
    echo '<script type="text/javascript">
          swal("", "ผิดพลาด !!", "error");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=salary.php" />';
  }
// $date=date("M");
// echo "$date";
// exit;

$num = 1;
$d_s = $_POST['d_s'];//ตัวแปรวันที่เริ่มต้น
$d_e = $_POST['d_e'];//ตัวแปรวันที่สิ้นสุด

// $d_s = $d_s." ".'00.00.00';//กำหนดเวลาเริ่มต้น

// $d_e= $d_e." ".'23.59.59';//กำหนดเวลาสิ้นสุด

echo "วัน = $d_s";
echo "&nbsp;&nbsp; ถึง = $d_e  ";
echo "<br>";



$query = "SELECT * FROM tb_salary 
WHERE salary_date BETWEEN '$d_s' AND '$d_e' ORDER BY salary_id ASC "
or die("Error:" . mysqli_error()); 

//ประกาศตัวแปร sqli
$result = mysqli_query($con, $query);//ดูชื่อ ตัวแปรในไฟล์ connect ให้ดีว่า conหรือ condb หรืออย่างอื่น

$num2 = mysqli_num_rows($result);


echo "ผลลัพธ์ = $num2";
echo "<br>";
//สร้างตัวแปร $row มารับค่าจากการ fetch array


//วนลูป
?>

<form name="frmsalary" action="salaryprintall.php" method="post">
<table id="example1" class="table table-bordered table-striped">
<input type = 'submit' class='btn btn-primary' name='btnprint' value='พิมพ์รายการที่เลือก'>
  <thead>
    <tr class=''>
    <th width='5'> <div align='center'>
      <input name='CheckAll' type='checkbox' id='CheckAll'  value='Y' onClick='ClickCheckAll(this);'>
      </div></th>
      <th width='5%'>ID</th>
      <th width='20%'>ข้อมูลส่วนตัว</th>
      <th width='20%'>แผนก</th>
      <th width='30%'>ตำแหน่ง</th>
      <th width='15%'>วันที่ทำรายการ</th>
      <th width='10%'>-</th>
      
      
    </tr>
  </thead>
  <?php
  $i=1;
  $a=0;
  while($row = mysqli_fetch_assoc($result)) {
  $a++;
  ?>
  <tr>
 
  <td><input type='checkbox'  name='checkbox[]' id='checkbox<?php echo $a;?>' value='<?php echo $row['salary_id'];?>'></td>
    <td  class='hidden-xs'>  <?php echo $i++  ; ?> </td> 
    
    <td> รหัส <?php echo $row["emp_id"];?>
     <br> ชื่อ <?php echo $row["employee_name"];?>
    </td>
    <td> <?php echo $row["name_dept"];?>  </td>
      
  <td> <?php echo $row["name_position"];?>  </td>
  <td> <?php echo $row["salary_date"];?>  </td>

   
    <td><a href='salary.php?act=edit&ID=<?php echo $row["salary_id"];?>' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a>   
          <a href='salary_del_db.php?ID=<?php echo $row["salary_id"];?>' onclick=\'return confirm("ยันยันการลบ")\'' class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a>
          <a href='salary.php?act=print&ID=<?php echo $row["salary_id"];?>' class='btn btn-info btn-xs'><i class='fas fa-print'></i></a>
          
    </td>
    
<?php  } ?>
  
</table>
<?php
mysqli_close($con);
?>

<input type='hidden' name='hdnCount' value='<?php echo $a; ?>'>
</form>

