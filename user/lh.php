<?php include('h.php');
// Get status message
if(!empty($_GET['status'])){
  switch($_GET['status']){
      case 'succ':
          $statusType = 'alert-success';
          $statusMsg = 'Member data has been imported successfully.';
          break;
      case 'err':
          $statusType = 'alert-danger';
          $statusMsg = 'Something went wrong, please try again.';
          break;
      case 'invalid_file':
          $statusType = 'alert-danger';
          $statusMsg = 'Please upload a valid Excel file.';
          break;
      default:
          $statusType = '';
          $statusMsg = '';
  }
}
?>
<script>
            function formToggle(ID){
                var element = document.getElementById(ID);
                if(element.style.display === "none"){
                    element.style.display ="block";
                }else{
                    element.style.display = "none";
                }
            }
        </script>
<body class="hold-transition skin-purple sidebar-mini">
  <div class="wrapper">
    <!-- Main Header -->
    <?php include('menutop.php');?>
    <?php include('menu_l.php');?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
        <i class="glyphicon glyphicon-check hidden-xs"></i> <span class="hidden-xs">ข้อมูลสั่งจ่ายผู้รับเหมางานรั้ว</span>
        <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Import Excel</a>
        </h1>
      </section>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="sticky-top mb-12">
                <div class="card">
                  <div class="card-body">
                    <?php
                    $act = (isset($_GET['act']) ? $_GET['act'] : '');
                    if($act == 'add'){
                    include('lh_form_add.php');
                    }elseif ($act == 'edit') {
                    include('lh_form_edit.php');
                    }elseif ($act == 'db') {
                    include('db_form_edit.php');
                    }elseif ($act == 'iv') {
                    include('iv_form_edit.php');
                    }elseif ($act == 'pm') {
                    include('pm_form_edit.php');
                    }elseif ($act == 'cb') {
                    include('cb_form_edit.php');
                    }elseif ($act == 'ex') {
                    include('ex_form_view.php');
                    }else {
                    include('lh_list.php');
                    }
                    
                    ?>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col -->
                
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          
        </div>
      </div>
      
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <?php include ('footer.php');?>
</html>
<?php include('footerjs.php');?>