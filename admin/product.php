<?php include('h.php');?>
<body class="hold-transition skin-purple sidebar-mini">
  <div class="wrapper">
    <!-- Main Header -->
    <?php include('menutop.php');?>
        <?php include('menu_l.php');?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
        <i class="glyphicon glyphicon-check hidden-xs"></i> <span class="hidden-xs">ข้อมูลสินค้า</span> 
        <a href="product.php?act=add" class="btn btn-primary btn-sm">เพิ่มรายการคิดตามจำนวน</a>
        <a href="product.php?act=add1" class="btn btn-secondary btn-sm">เพิ่มรายการคิดตามความยาว</a>
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
                        include('product_form_add.php');
                    }elseif($act == 'add1'){
                      include('product_form_add1.php');
                    }elseif ($act == 'edit') {
                        include('product_form_edit.php');
                    }elseif ($act == 'edit1') {
                      include('product_form_edit1.php');
                  }else {
                        include('product_list.php');
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



