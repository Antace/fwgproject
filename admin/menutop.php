<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
    
      <a href="index.php" class="nav-link"><i class="nav-icon fas fa-home"></i> <font color="gray" size="2">หน้าหลัก</font>
    </a>
    </li>
    <li class="nav-item dropdown ">
      <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="nav-icon fas fa-cog"></i> <font color="gray" size="2">จัดการข้อมูลระบบ</font>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
        <div class="dropdown-divider"></div>
        <a href="product.php" class="dropdown-item">
           รายการสินค้า    
        </a>

        <div class="dropdown-divider"></div>
        <a href="expenses.php" class="dropdown-item">
           รายการค่าใช้จ่าย   
        </a>

        <div class="dropdown-divider"></div>
        <a href="labeldetail.php" class="dropdown-item">
           รายการป้ายบ้านเลขที่ 
        </a>
      </div>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="nav-icon fas fa-user-circle"></i> <font color="gray" size="2">จัดการข้อมูลสมาชิก</font>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
        <div class="dropdown-divider"></div>
        <a href="department.php" class="dropdown-item">
           ข้อมูลหน่วยงาน    
        </a>

        <div class="dropdown-divider"></div>
        <a href="customer.php" class="dropdown-item">
           ข้อมูลลูกค้า 
        </a>

        <div class="dropdown-divider"></div>
        <a href="contractor.php" class="dropdown-item">
           ข้อมูลผู้รับเหมา  
        </a>

        <div class="dropdown-divider"></div>
        <a href="employee.php" class="dropdown-item">
           ข้อมูลพนักงาน 
        </a>
      </div>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="nav-icon fas fa-boxes"></i> <font color="gray" size="2">บันทึกรายการผลิต</font>  
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
        <div class="dropdown-divider"></div>
        <a href="production.php" class="dropdown-item">
           บันทึกรายการผลิต  
        </a>

        <div class="dropdown-divider"></div>
        <a href="rexpenses.php" class="dropdown-item">
           บันทึกค่าใช้จ่าย
        </a>

        <div class="dropdown-divider"></div>
        <a href="contractor.php" class="dropdown-item">
           ข้อมูลผู้รับเหมา  
        </a>
      </div>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="nav-icon fas fa-shopping-cart"></i> <font color="gray" size="2">บันทึกรายการขาย</font>  
      <span class="badge badge-warning navbar-badge"><?php echo $rec4; ?></span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
        <div class="dropdown-divider"></div>
        <a href="reserve.php" class="dropdown-item">
           การจองสินค้า
           <span class="badge badge-warning navbar-badge"><?php echo $rec4; ?></span>
        </a>

        <div class="dropdown-divider"></div>
        <a href="sale.php" class="dropdown-item">
           บันทึกรายการขาย
        </a>

        <div class="dropdown-divider"></div>
        <a href="contractor.php" class="dropdown-item">
           ข้อมูลผู้รับเหมา  
        </a>
      </div>
    </li>

    
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">

    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge"><?php echo $rec; ?></span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header"><?php echo $rec; ?> Notifications</span>
        <div class="dropdown-divider"></div>
        <a href="poe.php" class="dropdown-item">
          <i class="fas fa-envelope mr-2"></i> รายการงานที่หมดประกัน
          <span class="float-right text-muted text-sm"><?php echo $rec; ?></span>
        </a>
      </div>
    </li>
    <!-- <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li> -->
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
  </ul>
</nav>
<!-- /.navbar -->