<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="../img/logo.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
      <span class="brand-text font-weight-light">FINEWORKGROUP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../img/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="member_profile.php" class="d-block"><?php echo $username; ?></a>
          <a href="resetpass_user.php?employee_id='<?php echo $employee_id; ?>'" class='btn btn-primary btn-xs'>(เปลี่ยนรหัสผ่าน)</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">SYSTEM</li>
          <li class="nav-item menu-">
            <a href="#" class="nav-link  ">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                จัดการข้อมูลระบบ
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="customer.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ข้อมูลลูกค้า</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="contractor.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ข้อมูลผู้รับเหมา</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="product.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ข้อมูลสินค้า</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="department.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ข้อมูลหน่วยงาน/โครงการ</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">PO MANAGEMENT</li>
          <li class="nav-item menu-">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-file"></i>
              <p>
                จัดการข้อมูลใบสั่งซื้อ
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="po.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ข้อมูลใบสั่งซื้อ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pod.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ข้อมูลใบสั่งซื้อรับเงินประกันแล้ว</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-header">PRODUCT MANAGEMENT</li>
          <li class="nav-item menu-">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                จัดการข้อมูลสินค้า
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="sale.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ข้อมูลการขาย</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="production.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ข้อมูลการนำเข้า</p>
                </a>
              </li>
            </ul>
          </li>
                    
          
          
          <li class="nav-header">Exit</li>
          <li class="nav-item">
            <a href="../logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                ออกจากระบบ
                
              </p>
            </a>
          </li>
          
      
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>