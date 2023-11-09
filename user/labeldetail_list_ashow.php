<?php 
echo ' <table id="example1" class="table table-bordered table-striped">';
echo "<thead  align=center>";
echo "<tr class='table-light'>
      <th width='3%'>ลำดับ</th>
      <th width='8%'>แปลง</th>
      <th width='8%'>เลขที่บ้าน</th>
      <th width='30%'>โครงการ</th>
      
      <th width='10%'>สถานะ</th>
      <th width='10%'>สถานะจัดส่ง</th>
      <th width='7%'>-</th>
    </tr>";
echo "</thead>";
$i=1;
while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td align=center>" . $i++  . "</td> ";
  
  
  echo "<td align=center>" . $row["label_place"] . "</td> ";
  echo "<td align=center>" . $row["label_numberid"] . "</td> ";
  echo "<td align=center>" . $row["department_name"] . "</td> ";
  
  
  if ($row["label_orderstatus"]>0){ //ถ้าสินค้ามากกว่า 0 ให้แสดงปุ่ม แต่ถ้าน้อยกว่า 0 จะแสดงปุ่มสินค้าหมด ไม่สามารถคลิกได้
    echo "<td><center><font color = 'green'>สั่งแล้ว</font></center>"."</td>";
    }else{
        echo "<td><center><font color = 'red'>ยังไม่ได้สั่ง</font></center>"."</td>";
    }
    if ($row["status_send"]>0){ //ถ้าสินค้ามากกว่า 0 ให้แสดงปุ่ม แต่ถ้าน้อยกว่า 0 จะแสดงปุ่มสินค้าหมด ไม่สามารถคลิกได้
        echo "<td><center><font color = 'green '>ส่งแล้ว</font></center>"."</td>";
        }else{
            echo "<td><center><font color ='red'>ยังไม่ได้ส่ง</font></center>"."</td>";
        }
  
  if($row["label_orderstatus"]>0){
    echo "<td align=center><a href='labeldetail.php?act=edit&ID=$row[label_ida]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a>
  </td> ";
  }else{
    echo "<td align=center><a href='labeldetail.php?act=edit&ID=$row[label_ida]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a>
  <a href='label_del_db.php?ID=$row[product_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a></td> ";
  }
}

echo "</table>";
?>