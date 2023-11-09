<?php
if(@$_GET['do']=='success'){
echo '<script type="text/javascript">
swal("", "ทำรายการสำเร็จ !!", "success");
</script>';
echo '<meta http-equiv="refresh" content="1;url=po.php" />';
}else if(@$_GET['do']=='finish'){
echo '<script type="text/javascript">
swal("", "ทำรายการสำเร็จ !!", "success");
</script>';
echo '<meta http-equiv="refresh" content="1;url=po.php" />';
}
$qpo = (isset($_GET['qpo']) ? $_GET['qpo'] : '');
$qcus = (isset($_GET['qcus']) ? $_GET['qcus'] : '');
$qdept = (isset($_GET['qdept']) ? $_GET['qdept'] : '');
$qcate = (isset($_GET['qcate']) ? $_GET['qcate'] : '');
//4เงื่อนไข ถ้า เลขpo และ ลูกค้า และ โครงการ และ ประเภทงาน ไม่เท่ากับค่าว่าง ให้แสดงไฟล์ po_list_show.php และไฟล์ footer.js.php
if($qpo AND $qcus AND $qdept AND $qcate !=''){
include ('po_list_show.php');
include ('footerjs.php');
exit;
}//3เงื่อนไข ถ้า เลขpo และ ลูกค้า และ โครงการ ไม่เท่ากับค่าว่าง ให้แสดงไฟล์ po_list_show2.php และไฟล์ footer.js.php
elseif($qpo AND $qcus AND $qdept !=''){
include ('po_list_show2.php');
include ('footerjs.php');
exit;
}//3เงื่อนไข ถ้า เลขpo และ ลูกค้า และ ประเภทงาน ไม่เท่ากับค่าว่าง ให้แสดงไฟล์ po_list_show21.php และไฟล์ footer.js.php
elseif($qpo AND $qcus AND $qcate !=''){
include ('po_list_show21.php');
include ('footerjs.php');
exit;
}//3เงื่อนไข ถ้า เลขpo และ โครงการ และ ประเภทงาน ไม่เท่ากับค่าว่าง ให้แสดงไฟล์ po_list_show22.php และไฟล์ footer.js.php
elseif($qpo AND $qdept AND $qcate !=''){
include ('po_list_show22.php');
include ('footerjs.php');
exit;
}//3เงื่อนไข ถ้า ลูกค้า และ โครงการ และ ประเภทงาน ไม่เท่ากับค่าว่าง ให้แสดงไฟล์ po_list_show23.php และไฟล์ footer.js.php
elseif($qcus AND $qdept AND $qcate !=''){
include ('po_list_show23.php');
include ('footerjs.php');
exit;
}//2เงื่อนไข ถ้า เลขpo และ ลูกค้า ไม่เท่ากับค่าว่าง ให้แสดงไฟล์ po_list_show3.php และไฟล์ footer.js.php
elseif($qpo AND $qcus  !=''){
include ('po_list_show3.php');
include ('footerjs.php');
exit;
}//2เงื่อนไข ถ้า เลขpo และ ลูกค้า ไม่เท่ากับค่าว่าง ให้แสดงไฟล์ po_list_show3.php และไฟล์ footer.js.php
elseif($qpo AND $qdept  !=''){
include ('po_list_show31.php');
include ('footerjs.php');
exit;
}//2เงื่อนไข ถ้า เลขpo และ ลูกค้า ไม่เท่ากับค่าว่าง ให้แสดงไฟล์ po_list_show3.php และไฟล์ footer.js.php
elseif($qpo AND $qcate  !=''){
include ('po_list_show32.php');
include ('footerjs.php');
exit;
}//2เงื่อนไข ถ้า เลขpo และ ลูกค้า ไม่เท่ากับค่าว่าง ให้แสดงไฟล์ po_list_show3.php และไฟล์ footer.js.php
elseif($qcus AND $qdept  !=''){
include ('po_list_show33.php');
include ('footerjs.php');
exit;
}//2เงื่อนไข ถ้า เลขpo และ ลูกค้า ไม่เท่ากับค่าว่าง ให้แสดงไฟล์ po_list_show3.php และไฟล์ footer.js.php
elseif($qcus AND $qcate  !=''){
include ('po_list_show34.php');
include ('footerjs.php');
exit;
}//2เงื่อนไข ถ้า เลขpo และ ลูกค้า ไม่เท่ากับค่าว่าง ให้แสดงไฟล์ po_list_show3.php และไฟล์ footer.js.php
elseif($qdept AND $qcate  !=''){
include ('po_list_show35.php');
include ('footerjs.php');
exit;
}elseif($qpo !=''){
include ('po_list_show4.php');
include ('footerjs.php');
exit;
}elseif($qcus !=''){
include ('po_list_show41.php');
include ('footerjs.php');
exit;
}elseif($qdept !=''){
include ('po_list_show42.php');
include ('footerjs.php');
exit;
}elseif($qcate !=''){
include ('po_list_show43.php');
include ('footerjs.php');
exit;
}
$query = "SELECT * FROM tb_po
WHERE po_dateexpire >= current_date OR po_dateexpire = 0000-00-00 ORDER BY po_id DESC" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);


echo ' <table id="example1" class="table table-bordered table-striped">';
  echo "<thead>";
    //echo mysqli_num_rows($result1);
    //exit;
    echo "<tr align='center' class=''>
      <th width='3%'  class='hidden-xs'>No.</th>
      <th width='10%'>เลขที่ PO</th>
      <th width='25%'>บริษัท</th>
      <th width='20%'>โครงการ</th>
      <th width='10%'>งานของ</th>
      <th width='7%'>PO</th>
      <th width='7%'>DB</th>
      <th width='7%'>IV</th>
      <th width='7%'>PM</th>
      <th width='7%'>งานประกัน</th>
    
    </tr>";
  echo "</thead>";
  $i=1;
  while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
    echo "<td class='hidden-xs'>" .  $i++   .  "</td> ";
    echo "<td>" .  $row["po_name"]  .  "</td> ";
    echo "<td>" .  $row["customer_name"]  .  "</td> ";
    echo "<td>" .  $row["department_name"]  .  "</td> "; 
    echo "<td>" .  $row["work_by"]  .  "</td> ";   
    echo "<td>"." <center><a href='po.php?act=edit&ID=$row[po_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a> "."<a href='po_del_db.php?ID=$row[po_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a></center>"."</td> "; 
    
    // if ($row["po_file"]!=null){ //ถ้าสินค้ามากกว่า 0 ให้แสดงปุ่ม แต่ถ้าน้อยกว่า 0 จะแสดงปุ่มสินค้าหมด ไม่สามารถคลิกได้
    // echo "<td class='hidden-xs'>"."<center><font color='green'>Sent</font></center>"."<center>".$row["po_date"]."</center>"."</td>";}else {
    // echo "<td class='hidden-xs'>"."<center><font color='red'>No File</font></center>"."</td> ";
    // }
    //echo "<td class='hidden-xs'>"."<embed src='../po_file/".$row['po_file']."' width='80%'>"."</td>";
    //echo "<td><a href='../po_file/".$row['po_file']."' target='_blank' class='btn btn-primary btn-xs'><i class='fas fa-eye'></i></a></td>";
    if ($row["db_file"]!=null){ //ถ้าสินค้ามากกว่า 0 ให้แสดงปุ่ม แต่ถ้าน้อยกว่า 0 จะแสดงปุ่มสินค้าหมด ไม่สามารถคลิกได้
        echo "<td><center><a href='../db_file/".$row['db_file']."' target='_blank' class='btn btn-primary btn-xs'><i class='fas fa-search  '></i></a>
        <a href='po.php?act=db&ID=$row[po_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a></center>"
        ."<center>".$row['db_name']."</center>".
        "</td>";
    }else{
        //echo "<td class='hidden-xs'>"."<embed src='../po_file/".$row['po_file']."' width='80%'>"."</td>";
        echo "<td><center><a href='po.php?act=db&ID=$row[po_id]' class='btn btn-secondary btn-xs'><i class='fas fa-truck'></i></a></center></td> ";
    }
    if ($row["iv_file"]!=null){ //ถ้าสินค้ามากกว่า 0 ให้แสดงปุ่ม แต่ถ้าน้อยกว่า 0 จะแสดงปุ่มสินค้าหมด ไม่สามารถคลิกได้
        echo "<td><center><a href='../iv_file/".$row['iv_file']."' target='_blank' class='btn btn-primary btn-xs'><i class='fas fa-search  '></i></a>
        <a href='po.php?act=iv&ID=$row[po_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a></center>"
        ."<center>".$row['iv_name']."</center>".
        "</td>";
    }else{
        //echo "<td class='hidden-xs'>"."<embed src='../po_file/".$row['po_file']."' width='80%'>"."</td>";
        echo "<td><center><a href='po.php?act=iv&ID=$row[po_id]' class='btn btn-info btn-xs'><i class='fas fa-file-invoice'></i></a></center></td> ";
    }
    if ($row["pm_file"]!=null){ //ถ้าสินค้ามากกว่า 0 ให้แสดงปุ่ม แต่ถ้าน้อยกว่า 0 จะแสดงปุ่มสินค้าหมด ไม่สามารถคลิกได้
        echo "<td><center><a href='../pm_file/".$row['pm_file']."' target='_blank' class='btn btn-primary btn-xs'><i class='fas fa-search  '></i></a>
        <a href='po.php?act=pm&ID=$row[po_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a></center>"
        ."<center>".$row['pm_name']."</center>".
        "</td>";
    }else{
        //echo "<td class='hidden-xs'>"."<embed src='../po_file/".$row['po_file']."' width='80%'>"."</td>";
        echo "<td><center><a href='po.php?act=pm&ID=$row[po_id]' class='btn btn-success btn-xs'><i class='far fa-credit-card'></i></a></center></td> ";
    }
    if($row["po_dateexpire"]>=$date){
      echo "<td><center><a href='po.php?act=ex&ID=$row[po_id]' class='btn btn-primary btn-xs'><i class='fas fa-search'></i></a></center>"
      ."</td>";
    }elseif ($row["cb_file"]!=null){ //ถ้าสินค้ามากกว่า 0 ให้แสดงปุ่ม แต่ถ้าน้อยกว่า 0 จะแสดงปุ่มสินค้าหมด ไม่สามารถคลิกได้
      echo "<td><center><a href='../cb_file/".$row['cb_file']."' target='_blank' class='btn btn-primary btn-xs'><i class='fas fa-search  '></i></a>
      <a href='po.php?act=cb&ID=$row[po_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a></center>"
      ."<center>".$row['cb_name']."</center>".
      "</td>";
  }else{
      //echo "<td class='hidden-xs'>"."<embed src='../po_file/".$row['po_file']."' width='80%'>"."</td>";
      echo "<td><center><a href='po.php?act=cb&ID=$row[po_id]' class='btn btn-dark btn-xs'><i class='fas fa-hand-holding-usd'></i></a></center></td> ";
  }
    
  
  
  }
echo "</table>";

mysqli_close($con);
?>