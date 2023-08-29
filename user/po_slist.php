 <?php
  $i=1;
  while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
    echo "<td  class='hidden-xs'>" .  $i++   .  "</td> ";
    echo "<td> เลขที่ใบสั่งซื้อ: " .$row["po_name"].
      "<br>บริษัท: <font color='blue'>".$row["customer_name"] ."</font>".
      "<br>โครงการ: <font color='blue'>".$row["department_name"] ."</font>".
      "<br>ประเภทงาน: <font color='blue'>".$row["category_name"] ."</font>".
      "<br>งานของ: <font color='blue'>".$row["work_by"] ."</font>"." แปลง: <font color='blue'>".$row["po_place"] ."</font>".
      "<br>ผู้บันทึก: <font color='blue'>".$row["username"] ."</font>".
    "</td class='hidden-xs'> ";
    if ($row["po_file"]!=null){ //ถ้าสินค้ามากกว่า 0 ให้แสดงปุ่ม แต่ถ้าน้อยกว่า 0 จะแสดงปุ่มสินค้าหมด ไม่สามารถคลิกได้
    echo "<td class='hidden-xs'>"."<center><font color='green'>Sent</font></center>"."<center>".$row["po_date"]."</center>"."</td>";}else {
    echo "<td class='hidden-xs'>"."<center><font color='red'>No File</font></center>"."</td> ";
    }
    //echo "<td class='hidden-xs'>"."<embed src='../po_file/".$row['po_file']."' width='80%'>"."</td>";
    echo "<td><a href='po.php?act=edit&ID=$row[po_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a>
    <a href='../po_file/".$row['po_file']."' target='_blank' class='btn btn-primary btn-xs'><i class='fas fa-eye'></i></a>
  </td> ";
  if ($row["db_file"]!=null){ //ถ้าสินค้ามากกว่า 0 ให้แสดงปุ่ม แต่ถ้าน้อยกว่า 0 จะแสดงปุ่มสินค้าหมด ไม่สามารถคลิกได้
  echo "<td class='hidden-xs'>"."<center><font color='green'>Sent</font></center>"."<center>".$row["db_name"]."</center>"."<center>".$row["db_date"]."</center>"."</td>";}else {
  echo "<td class='hidden-xs'>" ."<center><font color='red'>No File</font></center>"."</td> ";
  }
  //echo "<td class='hidden-xs'>"."<embed src='../po_file/".$row['db_file']."' width='80%'>"."</td>";
  echo "<td><a href='po.php?act=db&ID=$row[po_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a>
  <a href='../db_file/".$row['db_file']."' target='_blank' class='btn btn-primary btn-xs'><i class='fas fa-eye'></i></a>
</td> ";
if ($row["iv_file"]!=null){ //ถ้าสินค้ามากกว่า 0 ให้แสดงปุ่ม แต่ถ้าน้อยกว่า 0 จะแสดงปุ่มสินค้าหมด ไม่สามารถคลิกได้
echo "<td class='hidden-xs'>"."<center><font color='green'>Sent</font></center>"."<center>".$row["iv_name"]."</center>"."<center>".$row["iv_date"]."</center>"."</td>";}else {
echo "<td class='hidden-xs'>" ."<center><font color='red'>No File</font></center>"."</td> ";
}
//echo "<td class='hidden-xs'>"."<embed src='../iv_file/".$row['iv_file']."' width='80%'>"."</td>";
echo "<td><a href='po.php?act=iv&ID=$row[po_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a>
<a href='../iv_file/".$row['iv_file']."' target='_blank' class='btn btn-primary btn-xs'><i class='fas fa-eye'></i></a>
</td> ";
if ($row["pm_file"]!=null){ //ถ้า pm_file ไม่เท่ากับค่าว่าง ให้แสดงคำว่า Sent แต่ถ้าไม่ใช้ แสดงคำว่า No File
//โค้ดเก่า ใส่รูป<center><img src='../p_img/rec.png' width='20%'></center>
echo "<td class='hidden-xs'>"."<center><font color='green'>Sent</font></center>"."<center>".$row["pm_name"]."</center>"."<center>".$row["pm_date"]."</center>"."</td>";}else {
echo "<td class='hidden-xs'>" ."<center><font color='red'>No File</font></center>" ."</td> ";
}
//echo "<td class='hidden-xs'>"."<embed src='../p_img/".$row['pm_file']."' width='80%'>"."</td>";
echo "<td><a href='po.php?act=pm&ID=$row[po_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a>
<a href='../pm_file/".$row['pm_file']."' target='_blank' class='btn btn-primary btn-xs'><i class='fas fa-eye'></i></a>
</td> ";
if ($row["po_dateexpire"]==0000-00-00){
echo "<td> วันที่ส่งงาน: <font color='blue'></font>".
"<br>ระยะเวลาประกัน: <font color='blue'></font>".
"<br>วันที่สิ้นสุดงานประกัน: <font color='blue'></font>".
"<br>เอกสารงานประกัน: <font color='blue'></font>".
"</td class='hidden-xs'> ";}
else if ($row["po_dateexpire"]<date('Y-m-d')AND $row["cb_name"]!=null){
echo "<td> วันที่ส่งงาน: <font color='blue'>" .$row["po_datesend"] ."</font>".
"<br>ระยะเวลาประกัน: <font color='blue'>".$row["po_insurance"] . " ปี" . "</font>".
"<br>วันที่สิ้นสุดงานประกัน: <font color='green'>รับเงินประกันแล้ว</font>".
"<br>เอกสารงานประกัน: <font color='blue'>".$row["cb_name"] ."</font>".
"</td class='hidden-xs'> ";}
else if ($row["po_dateexpire"]<date('Y-m-d')){
echo "<td> วันที่ส่งงาน: <font color='blue'>" .$row["po_datesend"] ."</font>".
"<br>ระยะเวลาประกัน: <font color='blue'>".$row["po_insurance"] . " ปี" . "</font>".
"<br>วันที่สิ้นสุดงานประกัน: <font color='red'>หมดเวลาประกัน</font>".
"<br>เอกสารงานประกัน: <font color='blue'>".$row["cb_name"] ."</font>".
"</td class='hidden-xs'> ";}
else{
echo "<td> วันที่ส่งงาน: <font color='blue'>" .$row["po_datesend"] ."</font>".
"<br>ระยะเวลาประกัน: <font color='blue'>".$row["po_insurance"] . " ปี" . "</font>".
"<br>วันที่สิ้นสุดงานประกัน: <font color='blue'>".$row["po_dateexpire"] ."</font>".
"<br>เอกสารงานประกัน: <font color='blue'>".$row["cb_name"] ."</font>".
"</td class='hidden-xs'> ";
}
echo "<td><a href='po.php?act=cb&ID=$row[po_id]' class='btn btn-warning btn-xs disabled'><i class='fas fa-pencil-alt'></i></a>
<a href='../cb_file/".$row['cb_file']."' target='_blank' class='btn btn-primary btn-xs disabled'><i class='fas fa-eye'></i></a>
<a href='po_del_db.php?ID=$row[po_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a>
</td> ";
}
echo "</table>";