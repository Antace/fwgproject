<script language="JavaScript">
	function ClickCheckAll(vol)
	{
	
		var a=1;
		for(a=1;a<=document.frmorder.hdnCount.value;a++)
		{
			if(vol.checked == true)
			{
				eval("document.frmorder.checkbox"+a+".checked=true");
			}
			else
			{
				eval("document.frmorder.checkbox"+a+".checked=false");
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
  echo '<meta http-equiv="refresh" content="1;url=order.php" />';

}else if(@$_GET['do']=='finish'){
  echo '<script type="text/javascript">
        swal("", "แก้ไขสำเร็จ !!", "success");
        </script>';
  echo '<meta http-equiv="refresh" content="1;url=order.php" />';
}
$query = "SELECT * FROM tb_cancelorder
ORDER BY corder_id DESC" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);
?>


<form name="frmorder" action="orderprintall.php" method="post">
<table id="example1" class="table table-bordered table-striped">
<input type = 'submit' class='btn btn-primary  ' name='btnprint' value='พิมพ์รายการที่เลือก'>
<thead>
  <tr class=''>
  <th width='5'> <div align='center'>
      <input name='CheckAll' type='checkbox' id='CheckAll'  value='Y' onClick='ClickCheckAll(this);'>
      </div></th>
    <th width='3%'>ลำดับ</th>
     <th width='20%'>เลขที่ใบสั่งผลิต</th>
     <th width='30%' >วันที่ทำรายการ</th>
    <th>รายการ</th>
    
    
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
<td><input type='checkbox'  name='checkbox[]' id='checkbox<?php echo $a;?>' value='<?php echo $row['order_id'];?>'></td>
  <td  align=center><?php echo  $i++ ; ?></td> 
  <td> <?php echo $row["corder_id"]; ?> </td> 
  <td> <?php echo $row["corder_date"]; ?></td> 
  <td> <?php echo $row["label_name"]; ?></td>
  
  
<td align=center><a href='corder.php?act=view&ID=<?php echo $row["corder_id"];?>' class='btn btn-warning btn-xs'>เปิด</a>
  <a href='corder.php?act=order_cancel&ID=<?php echo $row["corder_id"];?>' class='btn btn-danger btn-xs'>ลบ</a>
  <a href='corder.php?act=print&ID=<?php echo $row["corder_id"];?>' class='btn btn-info btn-xs'><i class='fas fa-print'></i></a>
</td>
  </tr>
<?php } ?>

</table>
<?php
mysqli_close($con);
?>

<input type='hidden' name='hdnCount' value='<?php echo $a; ?>'>
</form>
