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



$query = "SELECT tb_productionlist.*,tb_production.*,tb_product.* FROM tb_productionlist 
LEFT JOIN tb_production ON tb_productionlist.production_id = tb_production.production_id
LEFT JOIN tb_product ON tb_productionlist.product_id = tb_product.product_id
WHERE (production_date BETWEEN '$d_s' AND '$d_e') 
AND contractor_nickname = contractor_nickname ORDER BY productionlist_id DESC "
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

  <thead>
    <tr class=''>
    <!-- <th width='5'> <div align='center'>
      <input name='CheckAll' type='checkbox' id='CheckAll'  value='Y' onClick='ClickCheckAll(this);'>
      </div></th> -->
      <th width='3%'>ลำดับ</th>
       <th width='9%'>เลขที่การผลิต</th>
       <th width='8%'>ผู้รับเหมา</th>
       <th width='7%'>ผู้บันทึก</th>
       <th width='10%'>วันที่ผลิต</th>
       <th width='15%'>รายการ</th>
       <th width='8%'>จำนวนที่ผลิต</th>
       <th width='7%'>หน่วย</th>
       <th width='10%'>สถานะการจ่าย</th>
       <th width='10%'>-</th>
      
      
    </tr>
  </thead>
  <?php
  $i=1;
  $a=0;
  while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
      echo "<td align=center>" . $i++  . "</td> ";
      echo "<td align=center>" ."IN".$row["production_id"] .  "</td> ";
      echo "<td align=center>" .$row["contractor_nickname"] ."</td> ";
      echo "<td align=center>" .$row["username"] ."</td> ";
      echo "<td align=center> " .$row["production_date"] . "</td> ";
      echo "<td align=center>" .$row["product_name"] ."</td> ";
      echo "<td align=right>" .number_format($row["production_uom"],2) ."</td> ";
      echo "<td align=center>" .$row["product_unit"] ."</td> ";
      if($row["production_status"]==0){
      echo "<td align=center>" . "ยังไม่สั่งจ่าย" ."</td> ";
      }else if($row["production_status"]>0){
        echo "<td align=center>" . "สั่งจ่ายแล้ว" ."</td> ";
      }
  
      if($row["production_status"]==0){
      echo "<td align=center><a href='production.php?act=view&ID=$row[production_id]' class='btn btn-warning btn-xs'>เปิด</a>
      <a href='production.php?act=production_cancel&ID=$row[production_id]' class='btn btn-danger btn-xs'>ลบ</a></td> ";
      }else if($row["production_status"]>0){
        echo "<td align=center><a href='production.php?act=view&ID=$row[production_id]' class='btn btn-warning btn-xs'>เปิด</a>
      <a href='production.php?act=production_cancel&ID=$row[production_id]' class='btn btn-danger btn-xs' readonly>ลบ</a></td> ";
      }
      echo "</tr>";
    }
    ?>
  </table>
<?php
mysqli_close($con);
?>

<input type='hidden' name='hdnCount' value='<?php echo $a; ?>'>
</form>

