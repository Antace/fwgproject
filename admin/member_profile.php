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
        <i class="glyphicon glyphicon-user hidden-xs"></i> <span class="hidden-xs">แก้ไขข้อมูลส่วนตัว</span>
       
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
                  include('member_profile_edit.php');
                  ?>                   
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