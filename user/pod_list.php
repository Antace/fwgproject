<?php
if(@$_GET['do']=='success'){
echo '<script type="text/javascript">
swal("", "ทำรายการสำเร็จ !!", "success");
</script>';
echo '<meta http-equiv="refresh" content="1;url=pod.php" />';
}else if(@$_GET['do']=='finish'){
echo '<script type="text/javascript">
swal("", "แก้ไขสำเร็จ !!", "success");
</script>';
echo '<meta http-equiv="refresh" content="1;url=pod.php" />';
}
$query = "SELECT * FROM tb_po 
WHERE po_dateexpire < current_date AND po_dateexpire != 0000-00-00 OR cb_name != ''ORDER BY po_id DESC" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);

include "po_list_thead.php";
$date = date("Y.m.d H:i");

 $i=1;
  while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
    echo "<td class='hidden-xs'>" .  $i++   .  "</td> ";
    echo "<td>" .  $row["po_name"]  .  "</td> ";
    echo "<td>" .  $row["customer_name"]  .  "</td> ";
    echo "<td>" .  $row["department_name"]  .  "</td> "; 
    echo "<td>" .  $row["work_by"]  .  "</td> ";   
    echo "<td>"."<center><a href='../po_file/".$row['po_file']."' target='_blank' class='btn btn-primary btn-xs'><i class='fas fa-search  '></i></a></center> "."</td> "; 
    echo "<td>" .  $row["po_price"]  .  "</td> ";   
    // if ($row["po_file"]!=null){ //ถ้าสินค้ามากกว่า 0 ให้แสดงปุ่ม แต่ถ้าน้อยกว่า 0 จะแสดงปุ่มสินค้าหมด ไม่สามารถคลิกได้
    // echo "<td class='hidden-xs'>"."<center><font color='green'>Sent</font></center>"."<center>".$row["po_date"]."</center>"."</td>";}else {
    // echo "<td class='hidden-xs'>"."<center><font color='red'>No File</font></center>"."</td> ";
    // }
    //echo "<td class='hidden-xs'>"."<embed src='../po_file/".$row['po_file']."' width='80%'>"."</td>";
    //echo "<td><a href='../po_file/".$row['po_file']."' target='_blank' class='btn btn-primary btn-xs'><i class='fas fa-eye'></i></a></td>";
    if ($row["db_file"]!=null){ //ถ้าสินค้ามากกว่า 0 ให้แสดงปุ่ม แต่ถ้าน้อยกว่า 0 จะแสดงปุ่มสินค้าหมด ไม่สามารถคลิกได้
        echo "<td><center><a href='../db_file/".$row['db_file']."' target='_blank' class='btn btn-primary btn-xs'><i class='fas fa-search  '></i></a>
        </center>"
        ."<center>".$row['db_name']."</center>".
        "</td>";
    }else{
        //echo "<td class='hidden-xs'>"."<embed src='../po_file/".$row['po_file']."' width='80%'>"."</td>";
        echo "<td><center><a href='po.php?act=db&ID=$row[po_id]' class='btn btn-secondary btn-xs'><i class='fas fa-truck'></i></a></center></td> ";
    }
    if ($row["iv_file"]!=null){ //ถ้าสินค้ามากกว่า 0 ให้แสดงปุ่ม แต่ถ้าน้อยกว่า 0 จะแสดงปุ่มสินค้าหมด ไม่สามารถคลิกได้
        echo "<td><center><a href='../iv_file/".$row['iv_file']."' target='_blank' class='btn btn-primary btn-xs'><i class='fas fa-search  '></i></a>
        </center>"
        ."<center>".$row['iv_name']."</center>".
        "</td>";
    }else{
        //echo "<td class='hidden-xs'>"."<embed src='../po_file/".$row['po_file']."' width='80%'>"."</td>";
        echo "<td><center><a href='po.php?act=iv&ID=$row[po_id]' class='btn btn-info btn-xs'><i class='fas fa-file-invoice'></i></a></center></td> ";
    }
    if ($row["pm_file"]!=null){ //ถ้าสินค้ามากกว่า 0 ให้แสดงปุ่ม แต่ถ้าน้อยกว่า 0 จะแสดงปุ่มสินค้าหมด ไม่สามารถคลิกได้
        echo "<td><center><a href='../pm_file/".$row['pm_file']."' target='_blank' class='btn btn-primary btn-xs'><i class='fas fa-search  '></i></a>
       </center>"
        ."<center>".$row['pm_name']."</center>".
        "</td>";
    }else{
        //echo "<td class='hidden-xs'>"."<embed src='../po_file/".$row['po_file']."' width='80%'>"."</td>";
        echo "<td><center><a href='po.php?act=pm&ID=$row[po_id]' class='btn btn-success btn-xs'><i class='far fa-credit-card'></i></a></center></td> ";
    }
    if ($row["cb_file"]!=null){ //ถ้าสินค้ามากกว่า 0 ให้แสดงปุ่ม แต่ถ้าน้อยกว่า 0 จะแสดงปุ่มสินค้าหมด ไม่สามารถคลิกได้
      echo "<td><center><a href='../cb_file/".$row['cb_file']."' target='_blank' class='btn btn-primary btn-xs'><i class='fas fa-search  '></i></a>
      </center>"
      ."<center>".$row['cb_name']."</center>"."<center>".$row['insurance_price']."</center>".
      "</td>";
    }elseif($row["po_dateexpire"]<$date ){
      //echo "<td class='hidden-xs'>"."<embed src='../po_file/".$row['po_file']."' width='80%'>"."</td>";
      echo "<td><center><a href='po.php?act=cb&ID=$row[po_id]' class='btn btn-dark btn-xs'><i class='fas fa-hand-holding-usd'></i></a></center></td> ";
      
    }
    
  
  }
  
echo "</table>";
mysqli_close($con);
?>