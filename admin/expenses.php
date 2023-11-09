<?php include('h.php');?>
<body class="hold-transition skin-purple sidebar-mini">
  <div class="wrapper">
    <!-- Main Header -->
    <?php include('menutop.php');?>
        <?php include('menu_l.php');?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
        <i class="glyphicon glyphicon-list-alt hidden-xs"></i> <span class="hidden-xs">ข้อมูลค่าใช้จ่าย</span>
        
        <a href="expenses.php?act=add" class="btn btn-primary btn-sm">เพิ่ม</a>
        
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
                        include('expenses_form_add.php');
                    }elseif ($act == 'edit') {
                        include('expenses_form_edit.php');
                    }elseif ($act == 'addp') {
                      include('place_form_add.php');
                    }else {
                        include('expenses_list.php');
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