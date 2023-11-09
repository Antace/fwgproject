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
// $date=date("M");
// echo "$date";
// exit;

$num = 1;
$d_s = $_POST['d_s'];//ตัวแปรวันที่เริ่มต้น
$d_e = $_POST['d_e'];//ตัวแปรวันที่สิ้นสุด

// $d_s = $d_s." ".'00.00.00';//กำหนดเวลาเริ่มต้น

// $d_e= $d_e." ".'23.59.59';//กำหนดเวลาสิ้นสุด

echo "วัน = $d_s";
echo "&nbsp;&nbsp; ถึง = $d_e  ";
echo "<br>";



$query = "SELECT * FROM tb_salary 
WHERE salary_date BETWEEN '$d_s' AND '$d_e' ORDER BY salary_id ASC "
or die("Error:" . mysqli_error()); 

//ประกาศตัวแปร sqli
$result = mysqli_query($con, $query);//ดูชื่อ ตัวแปรในไฟล์ connect ให้ดีว่า conหรือ condb หรืออย่างอื่น

$num2 = mysqli_num_rows($result);


echo "ผลลัพธ์ = $num2";
//สร้างตัวแปร $row มารับค่าจากการ fetch array


//วนลูป
echo '<table id="example1" class="table table-bordered table-striped">';
  echo "<thead>";
    echo "<tr class=''>
    <th width='5%'></th>
      <th width='5%'>ID</th>
      <th width='20%'>ข้อมูลส่วนตัว</th>
      <th width='20%'>แผนก</th>
      <th width='30%'>ตำแหน่ง</th>
      <th width='10%'>วันที่ทำรายการ</th>
      <th width='7%'>-</th>
      
      
    </tr>";
  echo "</thead>";
  $i=1;
  while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  
  echo"<td><input type='checkbox' id='vehicle1' name='vehicle1' value='Bike'></td>";
    echo "<td  class='hidden-xs'>" .  $i++   .  "</td> ";
    // ."<br>"." password: ".sha1($row['a_password'])  
    // ."<br>"."<a href='resetpass_admin.php?salary_id=".$row['salary_id']."' class='btn btn-primary btn-xs'>(เปลี่ยนรหัสผ่าน)</a></td> ";
    echo "<td> ชื่อ ".$row["employee_name"]
    // ."<br> เลขบัญชี ".$row["AccountNumber"]
    ."</td> ";
    echo "<td> ".$row["name_dept"].  "</td> ";
      // echo "<td class='hidden-xs' align='center'>";
  echo "<td> ".$row["name_position"].  "</td> ";
  echo "<td> ".$row["salary_date"].  "</td> ";

        
    echo "<td><a href='salary.php?act=edit&ID=$row[salary_id]' class='btn btn-warning btn-xs'><i class='fas fa-pencil-alt'></i></a>   
          <a href='salary_del_db.php?ID=$row[salary_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a>
          <a href='salary.php?act=print&ID=$row[salary_id]' class='btn btn-info btn-xs'><i class='fas fa-print'></i></a>
    </td> ";
    
  } 
echo "</table>";
mysqli_close($con);//ดูชื่อ ตัวแปรในไฟล์ connect ให้ดีว่า conหรือ condb หรืออย่างอื่น
?>
<?php 

 ?>