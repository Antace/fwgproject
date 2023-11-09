<?php
$ID = mysqli_real_escape_string($con, $_GET['ID']);
$sql = "SELECT * FROM tb_link WHERE link_id=$ID";
$result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
$row = mysqli_fetch_array($result);
?>

<div align="right">
  <font color="red">*</font>
  <font color="gray">Required Fields</font>
</div>
<hr>
<form action="link_form_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
    <div class="col-sm-9 control-label">
      อีเมล์/เว็บไซต์ : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="text" name="link_name" required class="form-control" autocomplete="off" minlength="2" value="<?php echo $row['link_name']; ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label" class="form-control">
      รหัสผ่าน : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
    <input type="text" name="link_pass" required class="form-control" autocomplete="off" minlength="2" value="<?php echo $row['link_pass']; ?>">
      
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3 control-label">
      หมายเหตุ : 
    </div>
    <div class="col-sm-6">
    <textarea name="link_detail" cols="60"  class="form-control"><?php echo $row['link_detail']; ?></textarea>
    </div>
  </div>

  
  <div class="form-group">
      <div class="col-sm-6">
        <input type="hidden" name="username" required class="form-control" value="<?php echo $username; ?>" readonly >
      </div>
    </div>




  <hr>

  <div class="form-group">
    <div class="col-sm-12">
     <font color ="gray">บันทึกข้อมูลล่าสุด : <?php echo $row['link_dt']; ?> ผู้บันทึก : <?php echo $row ['username']; ?> </font> 
    </div>
  </div>
  <hr>
  <div class="form-group">
    <div class="col-sm-3">
    </div>
    <div class="col-sm-3">
      <input type="hidden" name="link_id" value="<?php echo $ID; ?>" />
      <button type="submit" class="btn btn-success">แก้ไขข้อมูล</button>
      <a href="link.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>