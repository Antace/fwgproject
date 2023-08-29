 <?php
 $date = date("Y.m.d H:i");

 $i=1;
  while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
    echo "<td align='center'>" .  $i++   .  "</td> ";
    echo "<td>" .  $row["po_name"]  .  "</td> ";
    echo "<td>" .  $row["customer_name"]  .  "</td> ";
    echo "<td>" .  $row["department_name"]  .  "</td> "; 
    echo "<td>" .  $row["work_by"]  .  "</td> ";   
    echo "<td>"." <center><a href='po.php?act=edit&ID=$row[po_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a> "
    ."<a href='../po_file/".$row['po_file']."' target='_blank' class='btn btn-primary btn-xs'><i class='fas fa-search  '></i></a> "
    ."<a href='po_del_db.php?ID=$row[po_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a></center>"."</td> "; 
    echo "<td>" .  $row["po_price"]  .  "</td> ";   
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
    if ($row["cb_file"]!=null){ //ถ้าสินค้ามากกว่า 0 ให้แสดงปุ่ม แต่ถ้าน้อยกว่า 0 จะแสดงปุ่มสินค้าหมด ไม่สามารถคลิกได้
      echo "<td><center><a href='../cb_file/".$row['cb_file']."' target='_blank' class='btn btn-primary btn-xs'><i class='fas fa-search  '></i></a>
      <a href='po.php?act=cb&ID=$row[po_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a></center>"
      ."<center>".$row['cb_name']."</center>"."<center>".$row['insurance_price']."</center>".
      "</td>";
    }elseif($row["po_dateexpire"]<$date ){
      //echo "<td class='hidden-xs'>"."<embed src='../po_file/".$row['po_file']."' width='80%'>"."</td>";
      echo "<td><center><a href='po.php?act=cb&ID=$row[po_id]' class='btn btn-dark btn-xs'><i class='fas fa-hand-holding-usd'></i></a></center></td> ";
      
    }
    
  
  }
  
echo "</table>";

