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




$d_s = (isset($_POST['d_s']) ? $_POST['d_s'] : '');
$d_e = (isset($_POST['d_e']) ? $_POST['d_e'] : '');
//4เงื่อนไข ถ้า เลขpo และ ลูกค้า และ โครงการ และ ประเภทงาน ไม่เท่ากับค่าว่าง ให้แสดงไฟล์ po_list_show.php และไฟล์ footer.js.php
if($d_s AND $d_e !=''){
include ('salary_list_show.php');
include ('footerjs.php');
exit;
}


$query = "SELECT * FROM tb_salary 
ORDER BY salary_id DESC" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);
?>

<form name="frmsalary" action="print.php" method="post">
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




