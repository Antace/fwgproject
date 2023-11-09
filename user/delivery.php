<?php include('h.php');?>
<body class="hold-transition skin-purple sidebar-mini">
  <div class="wrapper">
    <!-- Main Header -->
    <?php include('menutop.php');?>
        <?php include('menu_l.php');?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
        <i class="glyphicon glyphicon-check hidden-xs"></i> <span class="hidden-xs">ข้อมูลการนำออก</span> 
        <a href="delivery_form_add1.php" class="btn btn-primary btn-sm">เพิ่มรายการ</a>
        <!-- <a href="delivery.php?act=daily" class="btn btn-info btn-sm">รายงานประจำวัน</a> 
			<a href="delivery.php?act=monthy" class="btn btn-success btn-sm">รายงานประจำเดือน</a> 
			<a href="delivery.php?act=yearly" class="btn btn-secondary btn-sm">รายงานประจำปี</a>  -->
      <!-- <a href="delivery.php" class="btn btn-warning btn-sm">ปิด</a>  -->
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
                     if($act == 'view'){
                     include('delivery_form_view.php');
                     }elseif($act == 'delivery_cancel'){
                      include('delivery_form_view.php');
                     }else {
                     include('delivery_product_list.php');  
                     
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



