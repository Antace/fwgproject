<?php
if (@$_GET['do'] == 'success') {
  echo '<script type="text/javascript">
        swal("", "ทำรายการสำเร็จ !!", "success");
        </script>';
  echo '<meta http-equiv="refresh" content="1;url=labeldetail.php" />';
} else if (@$_GET['do'] == 'finish') {
  echo '<script type="text/javascript">
        swal("", "แก้ไขสำเร็จ !!", "success");
        </script>';
  echo '<meta http-equiv="refresh" content="1;url=labeldetail.php" />';
}



$qdept = (isset($_GET['qdept']) ? $_GET['qdept'] : '');
$qdeptpd = (isset($_GET['qdeptpd']) ? $_GET['qdeptpd'] : '');
$qdeptnpd = (isset($_GET['qdeptnpd']) ? $_GET['qdeptnpd'] : '');


if ($qdept != '') { //ถ้า $qdept ไม่เท่ากับค่าว่าง ให้ เรียกไฟล์ labeldetail_list_show.php และ footerjs.php
  include('labeldetail_list_show.php');
  include('footerjs.php');
  exit;
}
if ($qdeptpd != '') { //ถ้า $qdeptpd ไม่เท่ากับค่าว่าง ให้ เรียกไฟล์ labeldetail_list_showpd.php และ labeldetail_searchpd.php และ footerjs.php
  include('labeldetail_searchpd.php');
  include('labeldetail_list_showpd.php');
  include('footerjs.php');
  exit;
}
if ($qdeptpd != '') { //ถ้า $qdeptpd ไม่เท่ากับค่าว่าง ให้ เรียกไฟล์ labeldetail_list_showpd.php และ labeldetail_searchpd.php และ footerjs.php
  include('labeldetail_searchppd.php');
  include('labeldetail_list_showppd.php');
  include('footerjs.php');
  exit;
}
if ($qdeptnpd != '') { //ถ้า $qdeptnpd ไม่เท่ากับค่าว่าง ให้ เรียกไฟล์ labeldetail_list_shownpd.php และ labeldetail_searchnpd.php และ footerjs.php
  include('labeldetail_searchnpd.php');
  include('labeldetail_list_shownpd.php');
  include('footerjs.php');
  exit;
}
// "SELECT * FROM `tb_orderlist`  AS A INNER JOIN (SELECT * FROM `tb_labeldetail`) AS B WHERE A.label_ida = B.label_ida " 
// $sql=" SELECT * FROM `tb_orderlist`  AS A INNER JOIN (SELECT * FROM `tb_labeldetail`) AS B WHERE A.label_ida = B.label_ida "  or die("Error:" . mysqli_error());
//   $query2 = mysqli_query($con, $sql);
// $row2 = mysqli_fetch_array($query2);


// echo $a;
// echo 'row2='.$row2['order_id'][$a];
// echo 'row22='.$row2['label_ida'];






if ($act == 'pd') { //ถ้า act = pd ให้คิวรี่ข้อมูลจากตาราง tb_labeldetail โดยกำหนดว่า label_orderstatus > 0(คือป้ายที่สั่งผลิตแล้ว)
  $query = "SELECT * FROM tb_labeldetail WHERE label_orderstatus > 0
  ORDER BY department_name DESC" or die("Error:" . mysqli_error());
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
      
      <th width='7%'>-</th>
      
    </tr>";
echo "</thead>";
}  elseif ($act == 'npd') { //ถ้า act = pd ให้คิวรี่ข้อมูลจากตาราง tb_labeldetail โดยกำหนดว่า label_orderstatus = 0(คือป้ายที่ยังไม่ได้สั่งผลิต)
  $query = "SELECT * FROM tb_labeldetail WHERE label_orderstatus = 0
  ORDER BY department_name DESC" or die("Error:" . mysqli_error());
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
        
        <th width='7%'>-</th>
        
      </tr>";
  echo "</thead>";
} else { //ถ้า ไม่ตรงกับข้อใดเลยให้ คิวรี่ ข้อมูลตาราง tb_labeldetail ทั้งหมด เรียงตาม ชื่อโครงการ(department_name)

  $query = "SELECT tb_orderlist.*,tb_labeldetail.*  FROM tb_orderlist
  LEFT JOIN tb_labeldetail ON tb_orderlist.label_ida = tb_labeldetail.label_ida " or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query);

echo ' <table id="example1" class="table table-bordered table-striped">';
echo "<thead  align=center>";
echo "<tr class='table-light'>
      <th width='3%'>ลำดับ</th>
      
      <th width='7%'>แปลง</th>
      <th width='8%'>เลขที่บ้าน</th>
      <th width='25%'>โครงการ</th>
      <th width='10%'>สถานะ</th>
      <th width='10%'>สถานะจัดส่ง</th>
      <th width='10%'>เลขที่สั่งผลิต</th>
      <th width='15%'>วันที่สั่ง</th>
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
    echo "<td><center><i class='fas fa-check-circle' style='color:green'></i></center>" . "</td>";
  } else { // แต่ถ้าไม่ใช่ให้แสดงคำว่า ยังไม่ได้ส่ง
    echo "<td align=center><a href='labeldetail.php?act=deli&ID=$row[label_ida]' class='btn btn-danger btn-xs'><i class='fa fa-truck'></i></a></td>";
  }
  echo "<td align=center>" . $row["order_id"] . "</td> ";
  echo "<td align=center>" . $row["labeldetail_dt"] . "</td> ";
  echo "<td align=center><a href='labeldetail.php?act=edit&ID=$row[label_ida]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a></td>";
 
}
}
echo "</table>";
mysqli_close($con);
