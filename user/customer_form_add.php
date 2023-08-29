<script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
<?php 
 if(@$_GET['do']=='f'){
            echo '<script type="text/javascript">
            swal("", "กรุณาใส่ข้อมูลให้ถูกต้อง !!", "warning");
            </script>';
            echo '<meta http-equiv="refresh" content="2;url=customer.php?act=add" />';
 }elseif(@$_GET['do']=='d'){
            echo '<script type="text/javascript">
            swal("", "ชื่อบริษัทซ้ำ กรุณาเปลี่ยน  !!", "error");
            </script>';
            echo '<meta http-equiv="refresh" content="1;url=customer.php?act=add" />';

 }
 ?>

<form action="customer_form_add_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ชื่อบริษัท :
    </div>
    <div class="col-sm-3">
      <input type="text" name="customer_name" required class="form-control" autocomplete="off"  minlength="2">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label" class="form-control" >
      ที่อยู่ :
    </div>
    <div class="col-sm-3">
      <textarea name="customer_address" cols="60"></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      สาขา :
    </div>
    <div class="col-sm-3">
      <input type="text" name="customer_branch" required class="form-control">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      เลขประจำตัวผู้เสียภาษี :
    </div>
    <div class="col-sm-3">
      <input type="text" name="customer_tax" required class="form-control">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      เบอร์โทร :
    </div>
    <div class="col-sm-3">
      <input type="text" name="customer_tel" required class="form-control">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
      <button type="submit" class="btn btn-success">เพิ่มข้อมูล</button>
      <a href="customer.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>