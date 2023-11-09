<?php include('h.php');?>
<body class="hold-transition skin-purple sidebar-mini">
  <div class="wrapper">
    <!-- Main Header -->
    <?php include('menutop.php');?>
    <?php include('menu_l.php');?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
        <i class="glyphicon glyphicon-check hidden-xs"></i> <span class="hidden-xs">ข้อมูลใบสั่งซื้อ</span>
        <a href="po.php?act=add" class="btn btn-primary btn-sm">เพิ่มใบสั่งซื้อ</a>
        </h1>
      </section>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col col-sm-12">
              <div class="sticky-top mb-12">
                <div class="card">
                  <div class="card-body">
                    <?php
                    $act = (isset($_GET['act']) ? $_GET['act'] : '');
                    if($act == 'add'){
                    include('po_form_add.php');
                    }elseif ($act == 'edit') {
                    include('po_form_edit.php');
                    }elseif ($act == 'db') {
                    include('db_form_edit.php');
                    }elseif ($act == 'iv') {
                    include('iv_form_edit.php');
                    }elseif ($act == 'pm') {
                    include('pm_form_edit.php');
                    }elseif ($act == 'cb') {
                    include('cb_form_edit.php');
                    }else {
                    include('formsearch.php');
                    include('pot_list.php');
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