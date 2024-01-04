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
           S201 - รายการสินค้า    
        </a>

        <div class="dropdown-divider"></div>
        <a href="productdept.php" class="dropdown-item">
           S202 - ค่าเริ่มต้นรายการสินค้า    
        </a>

        <div class="dropdown-divider"></div>
        <a href="wage.php" class="dropdown-item">
           S203 - รายการค่าแรง   
        </a>

        <div class="dropdown-divider"></div>
        <a href="expenses.php" class="dropdown-item">
           S204 - รายการค่าใช้จ่าย   
        </a>

        <div class="dropdown-divider"></div>
        <a href="label.php" class="dropdown-item">
           S205 - รายการป้ายบ้านเลขที่ 
        </a>

        <div class="dropdown-divider"></div>
        <a href="link.php" class="dropdown-item">
           S206 - ข้อมูลเมล์/เว็บไซต์
        </a>

        <div class="dropdown-divider"></div>
        <a href="location.php" class="dropdown-item">
           S207 - สถานที่จัดเก็บ
        </a>
      </div>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="nav-icon fas fa-user-circle"></i> <font color="gray" size="2">จัดการข้อมูลสมาชิก</font>
      <span class="badge badge-warning navbar-badge"><?php echo $rec5; ?></span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
        <div class="dropdown-divider"></div>
        <a href="department.php" class="dropdown-item">
           M101 - ข้อมูลหน่วยงาน    
        </a>

        <div class="dropdown-divider"></div>
        <a href="customer.php" class="dropdown-item">
           M102 - ข้อมูลลูกค้า 
        </a>

        <div class="dropdown-divider"></div>
        <a href="contractor.php" class="dropdown-item">
           M103 - ข้อมูลผู้รับเหมา  
           <span class="badge badge-warning  "><?php echo $rec5; ?></span>
        </a>

        <div class="dropdown-divider"></div>
        <a href="employee.php" class="dropdown-item">
           M104 - ข้อมูลพนักงาน 
        </a>

        <div class="dropdown-divider"></div>
        <a href="member.php" class="dropdown-item">
           M105 - ข้อมูลผู้ใช้งาน 
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
           P101 - บันทึกรายการผลิต  
        </a>

        <div class="dropdown-divider"></div>
        <a href="wagerecord.php" class="dropdown-item">
           P102 - บันทึกค่าแรง 
        </a>
        
        <div class="dropdown-divider"></div>
        <a href="rexpenses.php" class="dropdown-item">
           P103 - บันทึกค่าใช้จ่าย
        </a>

        <div class="dropdown-divider"></div>
        <a href="payment.php" class="dropdown-item">
           P104 - บันทึกการจ่ายเงิน
        </a>
      </div>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="nav-icon fas fa-file-invoice"></i> <font color="gray" size="2">วางบิล</font>  
      
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
        <div class="dropdown-divider"></div>
        <!-- <a href="#" class="dropdown-item">
           B101 - ใบแจ้งหนี้   
        </a>

        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
           B102 - ใบวางบิล
        </a>

        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
           B103 - โอนเงินเข้าบริษัท
        </a> -->

        <div class="dropdown-divider"></div>
        <a href="transport.php" class="dropdown-item">
           B104 - ใบส่งของ
        </a>

        <!-- <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
           B105 - งานราวระเบียง
        </a>
        
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
           B106 - ป้ายบ้าน, จักรยาน, ฝาถังขยะ
        </a>

        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
           B107 - ใบส่งของ (LH1)
        </a>

        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
           B108 - ใบส่งของ (LH2)
        </a>

        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
           B109 - ใบแจ้งหนี้
        </a>

        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
           B110 - ใบแจ้งหนี้ (2)
        </a> -->

        <div class="dropdown-divider"></div>
        <a href="delivery.php" class="dropdown-item">
           B111 - ใบส่งของ (ผู้รับเหมา)
        </a>

        <!-- <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
           B112 - ใบส่งของ (ระบบขนส่ง)
        </a> -->
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
           B201 - การจองสินค้า
           <span class="badge badge-warning "><?php echo $rec4; ?></span>
        </a>

        <div class="dropdown-divider"></div>
        <a href="sale.php" class="dropdown-item">
           B202 - การขาย
        </a>

        <div class="dropdown-divider"></div>
        <a href="salevat.php" class="dropdown-item">
           B203 - ใบกำกับภาษี
        </a>

        
      </div>
    </li>

    

    <!-- <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="nav-icon fas fa-file-alt"></i> <font color="gray" size="2">รายงาน</font>  
      
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
        <div class="dropdown-divider"></div>
        <a href="reserve.php" class="dropdown-item">
           การจองสินค้า
           <span class="badge badge-warning "><?php echo $rec4; ?></span>
        </a>

        <div class="dropdown-divider"></div>
        <a href="sale.php" class="dropdown-item">
           การขาย
        </a>

        <div class="dropdown-divider"></div>
        <a href="salevat.php" class="dropdown-item">
           ใบกำกับภาษี
        </a>

        
      </div>
    </li> -->

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