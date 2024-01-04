<?php 
 if(@$_GET['do']=='f'){
            echo '<script type="text/javascript">
            swal("", "กรุณาใส่ข้อมูลให้ถูกต้อง !!", "warning");
            </script>';
            echo '<meta http-equiv="refresh" content="2;url=member.php?act=add" />';
 }elseif(@$_GET['do']=='d'){
            echo '<script type="text/javascript">
            swal("", "ข้อมูล username ซ้ำ กรุณาเปลี่ยน  !!", "error");
            </script>';
            echo '<meta http-equiv="refresh" content="1;url=member.php?act=add" />';

 }
 ?>
<div align="right">
  <font color="red">*</font>
  <font color="gray">Required Fields</font>
</div>
<hr>
<form action="member_form_add_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
    <div class="col-sm-2 control-label">
      Username : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="text" name="username" required class="form-control" autocomplete="off" pattern="^[a-zA-Z0-9]+$" title="ภาษาอังกฤษหรือตัวเลขเท่านั้น" minlength="2">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label" >
      Password : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="password" name="password" required class="form-control" pattern="^[a-zA-Z0-9]+$" title="ภาษาอังกฤษหรือตัวเลขเท่านั้น" minlength="2">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ชื่อ-นามสกุล : <font color="red">*</font>
    </div> 
    <div class="col-sm-3">
      <input type="text" name="employee_name" required class="form-control">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      เบอร์โทร : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="text" name="employee_tel" required class="form-control" size="10">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      อีเมล์ : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <input type="email" name="employee_mail" required class="form-control">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      สถานะ : <font color="red">*</font>
    </div>
    <div class="col-sm-3">
      <select name="employee_level" required class="form-control">
    <option value="">---เลือกสถานะ---</option>
    <option value="admin">admin</option>
    <option value="user">user</option>
    </select>
    </div>
  </div>
  <hr>
  <div class="form-group">
      <div class="col-sm-6">
        <input type="hidden" name="username1" required class="form-control" value="<?php echo $username; ?>" readonly >
      </div>
    </div>
  <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
      <button type="submit" class="btn btn-success">บันทึก</button>
      <a href="member.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>