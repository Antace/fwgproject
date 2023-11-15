<?php
include 'h.php';

print_r($_POST);


$reserve_id = mysqli_real_escape_string($con, $_POST['reserve_id']);
$reserve_date = mysqli_real_escape_string($con, $_POST['reserve_date']);
$sale_pricearray = $_POST['sale_price'];
$product_idarray = $_POST['product_id'];
$reserve_uom = $_POST['reserve_uom'];
$reserve_date = $_POST['reserve_date'];
$customer_name = $_POST['customer_name'];
$discount = $_POST['sale_discount'];



if($_GET['act']=='vat'){
    $sql1 = "SELECT * FROM tb_customer
    WHERE customer_name='$customer_name'" or die("Error:" . mysqli_error($con));
    $result = mysqli_query($con, $sql1) or die("Error in query: $sql1 " . mysqli_error($con));
    $row = mysqli_fetch_array($result);
    }else{
        
    }




?>

<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
        <!-- Main Header -->
        <?php include('menutop.php'); ?>
        <?php include('menu_l.php'); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <i class="glyphicon glyphicon-check hidden-xs"></i> <span class="hidden-xs">บันทึกการขาย</span>
                    
                </h1>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="sticky-top mb-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="reserve_sale_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <div class="col-sm-2 control-label">
                                                        วันที่ขาย : <font color="red">*</font>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="date" name="reserve_date" required value="<?php echo $reserve_date; ?>" readonly class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        ชื่อลูกค้า :
                                                        <input type="text" name="customer_name" required class="form-control" value="<?php echo $customer_name; ?>" readonly>
                                                    </div>
                                                </div>
                                                <?php if($_GET['act']=='vat'){?>
                                                    <div class="col-6">
                                                    <div class="form-group">
                                                        ที่อยู่ :
                                                        <textarea name="customer_address" cols="60" required class="form-control" readonly><?php echo $row['customer_address']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        เลขประจำตัวผู้เสียภาษี :
                                                        <input type="text" name="customer_tax" required class="form-control" value="<?php echo $row['customer_tax']; ?>" readonly>
                                                    </div>
                                                </div>

                                                    <?php } ?>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        สถานะรับของ :
                                                        <input type="text" name="receive_status" required class="form-control" value="รับของแล้ว" readonly>
                                                    </div>
                                                </div>
                                                <input type='text' style='text-align:right;'  class='form-control' name='reserve_id' value='<?php echo $reserve_id;?>' readonly>
                                                <table width="600" border="0" align="center" class="table table-bordered table-striped">

                                                    <tr>
                                                        <td>รายการ</td>
                                                        
                                                        <td align="center">ราคาขาย</td>
                                                        <td align="center">จำนวน</td>
                                                        <td align="center">รวม/รายการ</td>

                                                        <!-- <td align="center">ลบ</td> -->
                                                    </tr>

                                                    <?php
                                                    $total = 0;

                                                    foreach ($reserve_uom as $product_id => $qty) {

                                                        $sale_price = $sale_pricearray[$product_id];
                                                        $product_id = $product_idarray[$product_id];
                                                        if(empty($sale_price)){
                                                            echo '<script>';
                                                             echo "window.location='reserve.php?act=sale&ID=$_POST[reserve_id]&do=d';";
                                                             echo '</script>';
                                                        }else{
                                                        
                                                        }
                                                        $sql    = "SELECT * FROM tb_product WHERE product_id=$product_id";
                                                        $query  = mysqli_query($con, $sql);
                                                        $row    = mysqli_fetch_array($query);
                                                        $sum    = $sale_price * $qty;
                                                        $total    += $sum;
                                                        $total1 = $total - $discount;
                                                        $vat = $total1 * 0.07;
                                                        $stotal = $total1 + $vat;
                                                        echo "<tr>";
                                                        echo "<input type='text' name='sale_price[$product_id]' value=' $sale_price'>";
                                                        echo "<input type='text' name='reserve_uom[$product_id]' value=' $qty'>";
                                                        echo "<input type='hidden' style='text-align:right;'  class='form-control' name='product_id[]' value='$product_id' readonly>";
                                                        echo "<td width='334'>" . $row["product_name"] . "</td>";

                                                        
                                                        echo "<td width='46' align='right'>" . number_format($sale_price, 2) . "</td>";
                                                        echo "<td width='57' align='right'>$qty</td>";
                                                        echo "<td width='57' align='right'>" . number_format($sum, 2) . "</td>";
                                                        


                                                        //remove product
                                                        // echo "<td width='46' align='center'><a href='reserve_form_add1.php?product_id=$product_id&act=remove'class='btn btn-danger'>ลบ</a></td>";
                                                        echo "</tr>";
                                                    }
                                                    if($_GET['act']=='vat'){
                                                    echo "<tr>";
                                                    echo "<td  align='right' colspan='3' ><b>รวม</b></td>";
                                                    echo "<td align='right' >" . "<b>" . number_format($total, 2) . "</b>" . "</td>";
                                                    echo "</tr>";
                                                    echo "<tr>";
                                                    echo "<td  align='right' colspan='3' ><b>ส่วนลด</b></td>";
                                                    echo "<td align='right' >" . "<b>" . number_format($discount, 2) . "</b>" . "</td>";
                                                    echo "</tr>";
                                                    echo "<td  align='right' colspan='3' ><b>ภาษี</b></td>";
                                                    echo "<td align='right' >" . "<b>" . number_format($vat, 2) . "</b>" . "</td>";
                                                    echo "</tr>";
                                                    echo "<tr>";
                                                    echo "<td  align='right' colspan='3' ><b>รวมทั้งหมด</b></td>";
                                                    echo "<td align='right' >" . "<b>" . number_format($stotal, 2) . "</b>" . "</td>";
                                                    echo "</tr>";
                                                    echo "<tr>";
                                                    echo "<td colspan='4' align='center'>";
                                                    echo "<input type='text' name='sale_total' value='$total'>";
                                                    echo "<input type='text' name='sale_discount' value='$discount'>";
                                                    echo "<input type='text' name='sale_vat' value=' $vat'>";
                                                    echo "<input type='text'name='sale_stotal' value=' $stotal'>";
                                                    echo "<input type='text' name='username' value=' $username'>";
                                                            
                                                    

                                                    ?>
                                                    <tr>
                                                        <td colspan="4" align="right">
                                                        <input type="submit" name="button" id="button" class="btn btn-success btn-sm" value="บันทึก1" />
                                                        </td>
                                                    </tr>
                                                <?php }else{
                                                    echo "<tr>";
                                                    echo "<td  align='right' colspan='3' ><b>รวมทั้งหมด</b></td>";
                                                    echo "<td align='right' >" . "<b>" . number_format($total, 2) . "</b>" . "</td>";
                                                    echo "</tr>";

                                                    echo "<td colspan='4' align='right'>";
                                                   
                                                    echo "<input type='text' name='sale_stotal' value='$total'>";
                                                    echo "<input type='hidden' name='username' value=' $username'>";
                                                    echo "</td>";
                                                    echo "</tr>";
                                                    ?>

                                                    
                                                    <tr>
                                                        <td colspan="4" align="right">
                                                        <input type="submit" name="button" id="button" class="btn btn-success btn-sm" value="บันทึก" />
                                                        </td>
                                                    </tr>
                                                    <?php }?>
                                                </table>
                                        </form>
                                        <hr>
                                        <!-- /.card-body -->
                                        <a href="reserve.php?act=sale&ID=<?php echo $reserve_id; ?>" class="btn btn-warning">ย้อนกลับ</a>
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
    <?php include('footer.php'); ?>

    </html>
    <?php include('footerjs.php'); ?>