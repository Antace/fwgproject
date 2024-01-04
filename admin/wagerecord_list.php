  <?php
  //connect db
  if(@$_GET['do']=='success'){
    echo '<script type="text/javascript">
          swal("", "ทำรายการสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=wagerecord.php" />';

  }else if(@$_GET['do']=='finish'){
    echo '<script type="text/javascript">
          swal("", "แก้ไขสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=wagerecord.php" />';
  }
  // $query = "SELECT tb_orderlist.*,tb_labeldetail.*  FROM tb_orderlist
  // LEFT JOIN tb_labeldetail ON tb_orderlist.label_ida = tb_labeldetail.label_ida " or die("Error:" . mysqli_error());
  // $result = mysqli_query($con, $query);


  $query = "SELECT tb_wagerecordlist.*,tb_wagerecord.*,tb_wage.* FROM tb_wagerecordlist 
  LEFT JOIN tb_wagerecord ON tb_wagerecordlist.wagerecord_id = tb_wagerecord.wagerecord_id
  LEFT JOIN tb_wage ON tb_wagerecordlist.wage_id = tb_wage.wage_id 
  ORDER BY wagerecordlist_id DESC" or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
//   $query = "SELECT * FROM tb_wagerecord
// ORDER BY wagerecord_id DESC" or die("Error:" . mysqli_error($con));
// $result = mysqli_query($con, $query);
echo ' <table id="example1" class="table table-bordered table-hover table-sm">';
  echo "<thead>";
    echo "<tr class='' align ='center'>";
      echo "<th width='3%'>ลำดับ</th>";
      echo "<th width='8%'>เลขที่การผลิต</th>";
      echo "<th width='7%'>ผู้รับเหมา</th>";
      echo "<th width='7%'>ผู้บันทึก</th>";
      echo "<th width='8%'>วันที่ทำรายการ</th>";
       echo "<th width='25%'>รายการ</th>";
       echo "<th width='8%'>จำนวนที่ผลิต</th>";
       echo "<th width='7%'>หน่วย</th>";
       echo "<th width='10%'>สถานะการจ่าย</th>";
      echo "<th width='5%'></th>";
    echo "</tr>";
  echo "</thead>";
  $i = 1;
while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
    echo "<td align=center>" . $i++  . "</td> ";
    echo "<td align=center>" ."PR".$row["wagerecord_id"] .  "</td> ";
    echo "<td align=center>" .$row["contractor_nickname"] ."</td> ";
    echo "<td align=center>" .$row["username"] ."</td> ";
    echo "<td align=center> " .$row["wagerecord_date"] . "</td> ";
    echo "<td align=center>" .$row["wage_name"] ."</td> ";
    echo "<td align=right>" .number_format($row["wagerecord_uom"],2) ."</td> ";
    echo "<td align=center>" .$row["wage_unit"] ."</td> ";
    if($row["wagerecord_status"]==0){
    echo "<td align=center>" . "ยังไม่สั่งจ่าย" ."</td> ";
    }else if($row["wagerecord_status"]>0){
      echo "<td align=center>" . "สั่งจ่ายแล้ว" ."</td> ";
    }

    if($row["wagerecord_status"]==0){
    echo "<td align=center><a href='wagerecord.php?act=view&ID=$row[wagerecord_id]' class='btn btn-info btn-xs'><i class='fas fa-folder-open'></i></a>
    <a href='wagerecord.php?act=wagerecord_cancel&ID=$row[wagerecord_id]' class='btn btn-danger btn-xs'><i class='fas fa-trash'></i></a></td> ";
    }else if($row["wagerecord_status"]>0){
      echo "<td align=center><a href='wagerecord.php?act=view&ID=$row[wagerecord_id]' class='btn btn-info btn-xs'><i class='fas fa-folder-open'></i></a>
    <a href='wagerecord.php?act=wagerecord_cancel&ID=$row[wagerecord_id]' class='btn btn-danger btn-xs disabled' ><i class='fas fa-trash'></i></a></td> ";
    }
	echo "</tr>";
  }
  ?>
</table>