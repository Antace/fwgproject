<?php include('h.php');?>
<body class="hold-transition skin-purple sidebar-mini">
  <div class="wrapper">
    <!-- Main Header -->
    <?php include('menutop.php');?>
        <?php include('menu_l.php');?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
        <i class="glyphicon glyphicon-check hidden-xs"></i> <span class="hidden-xs">ข้อมูลการขาย</span> 
        <a href="sale_form_add1.php" class="btn btn-primary btn-sm">เพิ่มการขาย</a>
        <a href="sale.php?act=daily" class="btn btn-info btn-sm">รายงานประจำวัน</a> 
			<a href="sale.php?act=monthy" class="btn btn-success btn-sm">รายงานประจำเดือน</a> 
			<a href="sale.php?act=yearly" class="btn btn-secondary btn-sm">รายงานประจำปี</a> 
      <a href="sale.php" class="btn btn-warning btn-sm">ปิด</a> 
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
                     include('sale_form_view.php');
                     }elseif($act == 'sale_cancel'){
                      include('sale_form_view.php');
                     }elseif($act=='daily'){
                      include('r_daily.php');
                    }elseif($act=='monthy'){
                      include('r_monthy.php');
                    }elseif($act=='yearly'){
                      include('r_yearly.php');
                    }else {
                     include('sale_product_list.php');  
                     
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



