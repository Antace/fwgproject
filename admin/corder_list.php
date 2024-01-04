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
ORDER BY corder_id DESC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
?>


<form name="frmorder" action="orderprintall.php" method="post">
<table id="example1" class="table table-bordered table-hover table-sm">

<thead>
  <tr class=''>
     <th width='3%'>ลำดับ</th>
     <th width='20%'>เลขที่ใบสั่งผลิต</th>
     <th width='30%' >วันที่ทำรายการ</th>
     <th>รายการ</th>
     <th width='10%'></th>
  </tr>
</thead>

<?php
  $i=1;
  $a=0;
  while($row = mysqli_fetch_assoc($result)) {
  $a++;
  ?>
<tr>
  <td  align=center><?php echo  $i++ ; ?></td> 
  <td> <?php echo $row["corder_id"]; ?> </td> 
  <td> <?php echo $row["corder_date"]; ?></td> 
  <td> <?php echo $row["label_name"]; ?></td>
  
  
<td align=center><a href='corder.php?act=view&ID=<?php echo $row["corder_id"];?>' class='btn btn-warning btn-xs'>เปิด</a>
  
  
</td>
  </tr>
<?php } ?>

</table>
<?php
mysqli_close($con);
?>

<input type='hidden' name='hdnCount' value='<?php echo $a; ?>'>
</form>
