<?php include('h.php');?>
<body class="hold-transition skin-purple sidebar-mini">
  <div class="wrapper">
    <!-- Main Header -->
    <?php include('menutop.php');?>
        <?php include('menu_l.php');?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
        <i class="glyphicon glyphicon-check hidden-xs"></i> <span class="hidden-xs">ใบกำกับภาษี</span> 
        <a href="salevat_form_add1.php" class="btn btn-primary btn-sm">เพิ่ม</a>
      
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
                     include('salevat_form_view.php');
                     }elseif($act == 'salevat_cancel'){
                      include('salevat_form_view.php');
                     }else {
                     include('salevat_product_list.php');  
                     
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



