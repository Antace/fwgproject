<script language="JavaScript">
	function ClickCheckAll(vol)
	{
	
		var a=1;
		for(a=1;a<=document.frmdelivery.hdnCount.value;a++)
		{
			if(vol.checked == true)
			{
				eval("document.frmdelivery.checkbox"+a+".checked=true");
			}
			else
			{
				eval("document.frmdelivery.checkbox"+a+".checked=false");
			}
		}
	}
</script>
<?php
//connect db
if(@$_GET['do']=='success'){
  echo '<script type="text/javascript">
        swal("", "ทำรายการสำเร็จ !!", "success");
        </script>';
  echo '<meta http-equiv="refresh" content="1;url=delivery.php" />';

}else if(@$_GET['do']=='finish'){
  echo '<script type="text/javascript">
        swal("", "แก้ไขสำเร็จ !!", "success");
        </script>';
  echo '<meta http-equiv="refresh" content="1;url=delivery.php" />';
}
$query = "SELECT * FROM tb_delivery
ORDER BY delivery_id DESC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
?>
<form name="frmdelivery" action="deliveryprintall.php" method="post">
<table id="example1" class="table table-bordered table-hover table-sm">
<input type = 'submit' class='btn btn-primary btn-sm' name='btnprint' value='พิมพ์รายการที่เลือก'>
<thead>
  <tr class=''>
  <th width='1%'> <div align='center'>
      <input name='CheckAll' type='checkbox' id='CheckAll'  value='Y' onClick='ClickCheckAll(this);'>
      </div></th>
    <th width='3%'>ลำดับ</th>
     <th width='10%'>เลขที่ใบส่งของ</th>
     <th width='10%' >วันที่ทำรายการ</th>
     <th>ชื่อลูกค้า</th>
     <th>โครงการ</th>
     <th width='10%'></th>
  </tr>
</thead>
<?php
$i = 1;
$a=0;
while ($row = mysqli_fetch_array($result)) {
  $a++;
  ?>
<tr>
  <td align=center><input type='checkbox'  name='checkbox[]' id='checkbox<?php echo $a;?>' value='<?php echo $row['delivery_id'];?>'></td>
  <td  align=center> <?php echo $i++;?> </td>
  <td> <?php echo $row["delivery_id"];?> </td>
  <td> <?php echo $row["delivery_date"];?> </td>
  <td> <?php echo $row["customer_name"];?> </td>
  <td> <?php echo $row["department_name"];?> </td>
  
  <td align=center>
    <a href='delivery.php?act=print&ID=<?php echo $row['delivery_id'];?>' class='btn btn-primary btn-xs'>พิมพ์</a>
    <a href='delivery.php?act=view&ID=<?php echo $row['delivery_id'];?>' class='btn btn-warning btn-xs'>เปิด</a>
    <a href='delivery.php?act=delivery_cancel&ID=<?php echo $row['delivery_id'];?>' class='btn btn-danger btn-xs'>คืนสินค้า</a> 
  </td> 
</tr>
<?php
}
?>
</table>
<?php
mysqli_close($con);
?>

<input type='hidden' name='hdnCount' value='<?php echo $a; ?>'>
</form>