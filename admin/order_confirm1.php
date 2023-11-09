<?php include('h.php'); 
$query2 = "SELECT * FROM tb_label ORDER BY label_id DESC" or die("Error:" . mysqli_error());
$result2 = mysqli_query($con, $query2);
?>
<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
        <!-- Main Header -->
        <?php include('menutop.php'); ?>
        <?php include('menu_l.php'); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <i class="glyphicon glyphicon-check hidden-xs"></i> <span class="hidden-xs">รายละเอียดข้อมูลสินค้า</span>
                    <!-- <a href="product.php?act=add" class="btn btn-primary btn-sm">เพิ่มสินค้า</a> -->
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
                                        session_start();


                                        $label_id = $_POST['label_id']; //รับค่ารหัสสินค้าจาก order_confirm_search.php
                                         print_r($_POST);

//  exit;
                                        

                                        //print_r($label_ida);
                                        // exit;
                                        
                                        
                                        ?>
                                        <div align="right">
                                            <font color="red">*</font>
                                            <font color="gray">Required Fields</font>
                                        </div>
                                        <hr>
                                        <?php
                                        include "order_confirm_search.php";
                                        
                                        ?>
                                        
                                            <form id="frmorder" name="frmorder" method="post" action="order_db.php">
                                                <table border="0" cellspacing="0" align="center" class="table table-bordered table-striped">
                                                <?php    
                                                if (!empty($label_id)) {
                                                    $sql1 = "SELECT * FROM tb_label WHERE label_id=$label_id";
                                                    $query1 = mysqli_query($con, $sql1);
                                                    $row1 = mysqli_fetch_array($query1);
                                                }
                                                    
                                                    
                                                    ?>
                                                    <tr>
                                                        <td colspan="2">เลือกข้อมูลป้าย</td>
                                                    </tr>
                                                    <tr>
                                                        <td>ป้ายบ้านเลขที่ : </td>
                                                        <td> <input name="label_name" type="text" id="label_name" value="<?php echo $row1['label_name']; ?>" class="form-control" required />
                                                    </tr>
                                                    <tr>
                                                        <td>รายละเอียด : 
                                                        </td>
                                                        <td>
                                                            <textarea name="label_detail" cols="60" required class="form-control"><?php echo $row1['label_detail'];?></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>รูปที่ 1 : 
                                                        </td>
                                                        <td><input name="label_pic1" type="hidden"  value="<?php echo $row1['label_pic1']; ?>" class="form-control" required />
                                                            <img id="imgUpload" class="img-fluid my-3">
                                                            <img src="../label_img/<?php echo $row1['label_pic1']; ?>" id="label_pic1"  height="200px">
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>รูปที่ 2 : 
                                                        </td>
                                                        <td><input name="label_pic2" type="hidden"  value="<?php echo $row1['label_pic2']; ?>" class="form-control" required />
                                                            <img id="imgUpload" class="img-fluid my-3">
                                                            <img src="../label_img/<?php echo $row1['label_pic2']; ?>" id="label_pic2"  height="200px">
                                                        </td>
                                                    </tr>


                                                    <tr>
                                                        <td colspan="2" align="center">

                                                            <input type="text" name="username" value="<?php echo $username; ?>">
                                                            <!--<input type="submit" name="Submit2" value="สั่งซื้อ" /> -->
                                                        </td>
                                                    </tr>
                                                    
                                                </table>



                                                <table width="600" border="0" align="center" class="table table-bordered table-striped">
                                                    <tr>
                                                        <td width="1558" colspan="4">
                                                            <strong>ยืนยันการผลิต</strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>รายการ</td>
                                                        <td>แปลง</td>
                                                        <td>โครงการ</td>

                                                        <td align="center">จำนวน</td>

                                                    </tr>
                                                    <?php
                                                    $total = 0;
                                                    $vat = 0;
                                                    $stotal = 0;
                                                    foreach ($_SESSION['order'] as $label_ida => $qty) {

                                                        $sql    = "SELECT * FROM tb_labeldetail WHERE label_ida=$label_ida";
                                                        $query    = mysqli_query($con, $sql);
                                                        $row    = mysqli_fetch_array($query);
                                                        // $sum    = $sale_price * $qty;
                                                        // $total    += $sum;
                                                        // $total1 = $total-$discount;
                                                        // $vat = $total1 * 0.07;
                                                        // $stotal = $total1 + $vat;


                                                        echo "<tr>";
                                                        echo "<td>" . $row["label_numberid"] . "</td>";
                                                        echo "<td>" . $row["label_place"] . "</td>";
                                                        echo "<td>" . $row["department_name"] . "</td>";

                                                        echo "<td align='right'>$qty</td>";
                                                        // echo "<td align='right'>" . number_format($sum, 2) . "</td>";
                                                        echo "</tr>";
                                                    }
                                                    // echo "<tr>";
                                                    // echo "<td  align='right' colspan='3' ><b>รวม</b></td>";
                                                    // echo "<td align='right' >" . "<b>" . number_format($total, 2) . "</b>" . "</td>";
                                                    // echo "</tr>";
                                                    // echo "<tr>";
                                                    // echo "<td  align='right' colspan='3' ><b>ส่วนลด</b></td>";
                                                    // echo "<td align='right' >" . "<b>" . number_format($discount, 2) . "</b>" . "</td>";
                                                    // echo "</tr>";
                                                    // echo "<td  align='right' colspan='3' ><b>ภาษี</b></td>";
                                                    // echo "<td align='right' >" . "<b>" . number_format($vat, 2) . "</b>" . "</td>";
                                                    // echo "</tr>";
                                                    // echo "<tr>";
                                                    // echo "<td  align='right' colspan='3' ><b>รวมทั้งหมด</b></td>";
                                                    // echo "<td align='right' >" . "<b>" . number_format($stotal, 2) . "</b>" . "</td>";
                                                    // echo "</tr>";
                                                    ?>

                                                </table>
                                                <p>

                                                    <input type="hidden" name="order_date" value="<?php echo (new DateTime())->format('Y-m-d'); ?>" required class="form-control">
                                                    <center><a href="order_form_add.php" class="btn btn-warning ">กลับหน้ายืนยันการสั่งผลิต</a> &nbsp;&nbsp;<input type="submit" name="Submit2" class="btn btn-success" value="บันทึกการผลิต" /></center>
                                            </form>
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

</body>

<script>
    function readURL(input) {
        if (input.files[0]) {
            let reader = new FileReader();
            document.querySelector('#imgControl').classList.replace("d-none", "d-block");
            reader.onload = function(e) {
                let element = document.querySelector('#imgUpload');
                element.setAttribute("src", e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?php include('footerjs.php'); ?>


</html>