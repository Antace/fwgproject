  <?php
  //connect db
  if(@$_GET['do']=='success'){
    echo '<script type="text/javascript">
          swal("", "ทำรายการสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=production.php" />';

  }else if(@$_GET['do']=='finish'){
    echo '<script type="text/javascript">
          swal("", "แก้ไขสำเร็จ !!", "success");
          </script>';
    echo '<meta http-equiv="refresh" content="1;url=production.php" />';
  }
  // $query = "SELECT tb_orderlist.*,tb_labeldetail.*  FROM tb_orderlist
  // LEFT JOIN tb_labeldetail ON tb_orderlist.label_ida = tb_labeldetail.label_ida " or die("Error:" . mysqli_error());
  // $result = mysqli_query($con, $query);


  // $query = "SELECT tb_productionlist.*,tb_production.*,tb_product.* FROM tb_productionlist 
  // LEFT JOIN tb_production ON tb_productionlist.production_id = tb_production.production_id
  // LEFT JOIN tb_product ON tb_productionlist.product_id = tb_product.product_id 
  // ORDER BY productionlist_id DESC" or die("Error:" . mysqli_error());
  // $result = mysqli_query($con, $query);
  $query = "SELECT * FROM tb_production
ORDER BY production_id DESC" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);
echo ' <table id="example1" class="table table-bordered table-striped">';
  echo "<thead>";
    echo "<tr class='' align ='center'>";
      echo "<th width='3%'>ลำดับ</th>";
      echo "<th width='9%'>เลขที่การผลิต</th>";
      echo "<th width='8%'>ผู้รับเหมา</th>";
      echo "<th width='7%'>ผู้บันทึก</th>";
      echo "<th width='10%'>วันที่ทำรายการ</th>";
      //  echo "<th width='15%'>รายการ</th>";
      //  echo "<th width='8%'>จำนวนที่ผลิต</th>";
      //  echo "<th width='7%'>หน่วย</th>";
      //  echo "<th width='10%'>สถานะการจ่าย</th>";
      echo "<th width='10%'>-</th>";
    echo "</tr>";
  echo "</thead>";
  $i = 1;
while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
    echo "<td align=center>" . $i++  . "</td> ";
    echo "<td align=center>" ."PR".$row["production_id"] .  "</td> ";
    echo "<td align=center>" .$row["contractor_nickname"] ."</td> ";
    echo "<td align=center>" .$row["username"] ."</td> ";
    echo "<td align=center> " .$row["production_date"] . "</td> ";
    // echo "<td align=center>" .$row["product_name"] ."</td> ";
    // echo "<td align=right>" .number_format($row["production_uom"],2) ."</td> ";
    // echo "<td align=center>" .$row["product_unit"] ."</td> ";
    // if($row["production_status"]==0){
    // echo "<td align=center>" . "ยังไม่สั่งจ่าย" ."</td> ";
    // }else if($row["production_status"]>0){
    //   echo "<td align=center>" . "สั่งจ่ายแล้ว" ."</td> ";
    // }

    if($row["production_status"]==0){
    echo "<td align=center><a href='production.php?act=view&ID=$row[production_id]' class='btn btn-warning btn-xs'>เปิด</a>
    <a href='production.php?act=production_cancel&ID=$row[production_id]' class='btn btn-danger btn-xs'>ลบ</a></td> ";
    }else if($row["production_status"]>0){
      echo "<td align=center><a href='production.php?act=view&ID=$row[production_id]' class='btn btn-warning btn-xs'>เปิด</a>
    <a href='production.php?act=production_cancel&ID=$row[production_id]' class='btn btn-danger btn-xs' readonly>ลบ</a></td> ";
    }
	echo "</tr>";
  }
  ?>
</table>