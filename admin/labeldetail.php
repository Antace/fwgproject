<?php include('h.php');?>
<body class="hold-transition skin-purple sidebar-mini">
  <div class="wrapper">
    <!-- Main Header -->
    <?php include('menutop.php');?>
        <?php include('menu_l.php');?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
        <i class="glyphicon glyphicon-list-alt hidden-xs"></i> <span class="hidden-xs">ข้อมูลเลขที่บ้าน</span>
        
        <a href="labeldetail.php?act=add" class="btn btn-primary btn-sm">เพิ่ม</a>
        <a href="labeldetail.php?act=pd" class="btn btn-primary btn-sm">เลขที่บ้านที่สั่งแล้ว</a>
        <a href="labeldetail.php?act=npd" class="btn btn-primary btn-sm">เลขที่บ้านที่ยังไม่ได้สั่ง</a>
        <a href="labeldetail.php" class="btn btn-danger btn-sm">ปิด</a>
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
                    
                    $qdeptpd = (isset($_GET['qdeptpd']) ? $_GET['qdeptpd'] : '');
                    $qdeptnpd = (isset($_GET['qdeptnpd']) ? $_GET['qdeptnpd'] : '');

                    $act = (isset($_GET['act']) ? $_GET['act'] : '');
                    if($act == 'add'){
                        include('labeldetail_form_add.php');
                    }elseif ($act == 'edit') {
                        include('labeldetail_form_edit.php');
                    }elseif ($act == 'deli') {
                      include('labeldetail_form_deli.php');
                    }elseif ($act == 'pd') {
                      include('labeldetail_searchpd.php');
                        include('labeldetail_list.php');
                    }elseif ($act == 'npd') {
                      include('labeldetail_searchnpd.php');
                      include('labeldetail_list.php');
                    }elseif ($qdeptpd != '') {
                      include('labeldetail_list.php');
                    }elseif ($qdeptnpd != '') {
                      
                      include('labeldetail_list.php');
                    }else {
                        include('labeldetail_search.php');
                        include('labeldetail_list.php');
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