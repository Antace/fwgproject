<script language="JavaScript">
	function ClickCheckAll(vol)
	{
	
		var a=1;
		for(a=1;a<=document.frmpayment.hdnCount.value;a++)
		{
			if(vol.checked == true)
			{
				eval("document.frmpayment.checkbox"+a+".checked=true");
			}
			else
			{
				eval("document.frmpayment.checkbox"+a+".checked=false");
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
    echo '<meta http-equiv="refresh" content="1;url=payment.php" />';

  }else if(@$_GET['do']=='finish'){
    echo '<script type="text/javascript">
          swal("", "แก้ไขสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=payment.php" />';
  }

  $query = "SELECT tb_payment.*, tb_contractor.* FROM tb_payment
  LEFT JOIN tb_contractor ON tb_payment.contractor_nickname = tb_contractor.contractor_nickname
ORDER BY payment_id DESC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
?>
<form name="frmpayment" action="paymentprintall.php" method="post">
<table id="example1" class="table table-bordered table-hover table-sm">
<input type = 'submit' class='btn btn-primary btn-sm' name='btnprint' value='พิมพ์รายการที่เลือก'>
<thead>
    <tr class='' align ='center'>
    <th width='1%'> <div align='center'>
      <input name='CheckAll' type='checkbox' id='CheckAll'  value='Y' onClick='ClickCheckAll(this);'>
      </div></th>
      <th width='3%'>ลำดับ</th>
      <th width='6%'>เลขที่การผลิต</th>
      <th width='7%'>ชื่อเล่นผู้รับเหมา</th>
      <th width='15%'>ผู้รับเหมา</th>
      <th width='8%'>วันที่ทำรายการ</th>
      <th width='8%'>จำนวนเงินรวมทั้งสิ้น</th>
      <th width='5%'></th>
    </tr>
  </thead>

<?php 
  $i = 1;
  $a=0;
while ($row = mysqli_fetch_assoc($result)) {
  $a++;
  ?>
  <tr>
    <td align=center><input type='checkbox'  name='checkbox[]' id='checkbox<?php echo $a;?>' value='<?php echo $row['payment_id'];?>'></td>
    <td align=center><?php echo $i++; ?></td> 
    <td align=center><?php echo $row["payment_id"];?></td> 
    <td align=center><?php echo $row["contractor_nickname"];?></td> 
    <td align=center><?php echo $row["contractor_name"];?></td>
    <td align=center><?php echo $row["payment_date"];?></td>
    <td align=right><?php echo number_format($row["payment_price"],2)?></td> 
    <td align=center>
      <a href='payment.php?act=print&ID=<?php echo $row['payment_id'];?>' class='btn btn-primary btn-xs'>พิมพ์</a>
      <a href='payment.php?act=view&ID=<?php echo $row['payment_id'];?>' class='btn btn-warning btn-xs'>เปิด</a>
      <a href='payment.php?act=payment_cancel&ID=<?php echo $row['payment_id'];?>' class='btn btn-danger btn-xs'>ลบ</a>
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