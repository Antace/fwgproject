<?php include('h.php'); ?>
<!DOCTYPE html>
<div class="wrapper">
  <!-- Preloader -->
  <div class="wrapper">
    <!-- Main Header -->
    <?php include('menutop.php'); ?>
    <!-- Left side column. contains the logo and sidebar -->

    <?php include('menu_l.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="sticky-top mb-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="container-fluid">
                        <!-- Small boxes (Stat box) -->
                        <div class="row">
                          <div class="col-lg-4 col-12">
                            <!-- small box -->
                            <div class="small-box bg-info">
                              <div class="inner">
                                <h3><?php echo $rec2; ?></h3>

                                <p>ใบสั่งซื้อทั้งหมด</p>
                              </div>
                              <div class="icon">
                                <i class="ion ion-android-cart"></i>
                              </div>
                              <a href="po.php" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
                            </div>

                            <div class="small-box bg-danger">
                              <div class="inner">
                                <h3><?php echo $rec5; ?></h3>

                                <p>บัตรประชาชนหมดอายุ</p>
                              </div>
                              <div class="icon">
                                <i class="ion ion-android-alert"></i>
                              </div>
                              <a href="contractor.php?act=exp" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                          </div>
                          <!-- ./col -->



                          <div class="col-lg-4 col-12">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                              <div class="inner">
                                <h3><?php echo $rec; ?></h3>

                                <p>ใบสั่งซื้อที่หมดประกันแล้ว</p>
                              </div>
                              <div class="icon">
                                <i class="ion ion-android-warning"></i>
                              </div>
                              <a href="poe.php" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
                            </div>

                            <div class="small-box bg-primary">
                              <div class="inner">
                                <h3><?php echo $rec4; ?></h3>

                                <p>รายการจองที่ยังไม่ได้รับของ</p>
                              </div>
                              <div class="icon">
                                <i class="ion ion-android-calendar"></i>
                              </div>
                              <a href="reserve.php" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                          </div>
                          <!-- ./col -->
                          <div class="col-lg-4 col-12">
                            <!-- small box -->
                            <div class="small-box bg-success">
                              <div class="inner">
                                <h3><?php echo $rec3; ?></h3>

                                <p>ใบสั่งซื้อที่รับเงินประกันแล้ว</p>
                              </div>
                              <div class="icon">
                                <i class="ion ion-android-checkmark-circle"></i>
                              </div>
                              <a href="pod.php" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                          </div>
                          <!-- ./col -->
                        </div>
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
        </section>
      </section>
      <!-- Main content -->

      <!-- /.content -->
    </div>
    <?php include('footer.php'); ?>

    </html>
    <?php include('footerjs.php'); ?>