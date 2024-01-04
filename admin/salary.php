<?php include('h.php');?>
<body class="hold-transition skin-purple sidebar-mini">
  <div class="wrapper">
    <!-- Main Header -->
    <?php include('menutop.php');?>
    <!-- Left side column. contains the logo and sidebar -->
    
        <?php include('menu_l.php');?>
      
    <div class="content-wrapper">
      <section class="content-header">
      <h1>
        <i class="glyphicon glyphicon-user hidden-xs"></i> <span class="hidden-xs">ข้อมูลเงินเดือน</span>
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
                  include('salary_form_add.php');
                  }elseif ($act == 'edit') {
                  include('salary_form_edit.php');
                  }elseif ($act == 'salary') {
                    include('salary_form_add.php');
                    }elseif($act=='rwd'){
                  include('salary_form_rwd.php');
                  }elseif($act=='print'){
                  include('salary_form_print.php');
                  }elseif($act=='printall'){
                    include('print.php');
                  }else {
                  include("salary_search_date.php");
                  include('salary_list.php');
                  
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