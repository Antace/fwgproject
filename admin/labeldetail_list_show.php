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

  echo ' โครงการ  = ';
  echo '<font color="blue">'; 
  echo $_GET['qdept'];
  echo '</font>';
 
  echo '<br/>'; 

  // "SELECT * FROM tb_labeldetail 
  // WHERE  department_name LIKE '%$qdept%' " 

  $query = "SELECT tb_orderlist.*,tb_labeldetail.*  FROM tb_orderlist
  LEFT JOIN tb_labeldetail ON tb_orderlist.label_ida = tb_labeldetail.label_ida  WHERE  department_name LIKE '%$qdept%'"  or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query);
  
  echo ' <table id="example1" class="table table-bordered table-striped">';
echo "<thead  align=center>";
echo "<tr class='table-light'>
      <th width='3%'>ลำดับ</th>
      <th width='8%'>แปลง</th>
      <th width='8%'>เลขที่บ้าน</th>
      <th width='30%'>โครงการ</th>
      
      <th width='10%'>สถานะ</th>
      <th width='10%'>สถานะจัดส่ง</th>
      <th width='10%'>เลขที่สั่งผลิต</th>
      <th width='7%'>-</th>
      
    </tr>";
echo "</thead>";

$i = 1;
while ($row = mysqli_fetch_array($result)) {

  echo "<tr>";
  echo "<td align=center>" . $i++  . "</td> ";


  echo "<td align=center>" . $row["label_place"] . "</td> ";
  echo "<td align=center>" . $row["label_numberid"] . "</td> ";
  echo "<td align=center>" . $row["department_name"] . "</td> ";

  if ($row["label_orderstatus"] > 0) { //ถ้า label_orderstatus > 0 ให้แสดงคำว่า สั่งแล้ว 
    echo "<td><center><font color = 'green'>สั่งแล้ว</font></center>" . "</td>";
  } else { // แต่ถ้าไม่ใช่ให้แสดงคำว่า ยังไม่ได้สั่ง
    echo "<td><center><font color = 'red'>ยังไม่ได้สั่ง</font></center>" . "</td>";
  }
  if ($row["status_send"] > 0) { //ถ้า label_orderstatus > 0 ให้แสดงคำว่า ส่งแล้ว 
    echo "<td><center><font color = 'green '>ส่งแล้ว</font></center>" . "</td>";
  } else { // แต่ถ้าไม่ใช่ให้แสดงคำว่า ยังไม่ได้ส่ง
    echo "<td><center><font color ='red'>ยังไม่ได้ส่ง</font></center>" . "</td>";
  }

  echo "<td align=center>" . $row["order_id"] . "</td> ";

  echo "<td align=center><a href='labeldetail.php?act=edit&ID=$row[label_ida]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a></td>";
 
}

echo "</table>";
  mysqli_close($con);