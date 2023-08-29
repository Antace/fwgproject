<?php
session_start();

print_r($_POST);


include("../condb.php");
$sql2 = "SELECT * FROM tb_label WHERE label_id=$row[label_id]
ORDER BY label_id DESC" or die("Error:" . mysqli_error());
$result_t = mysqli_query($con, $sql2) or die("Error in query: $sql " . mysqli_error());
$row1 = mysqli_fetch_array($result_t);

?>
<?php include('h.php'); ?>


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
            <!DOCTYPE html>
            <html>

            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>Checkout</title>
            </head>

            <body>
            <script language="JavaScript">
                    //script select ข้อมูล
                    function resutName(strCusName) {
                        frmorder.label_id.value = strCusName.split("|")[0];
                        frmorder.label_name.value = strCusName.split("|")[1];
                        frmorder.label_detail.value = strCusName.split("|")[2];
                        frmorder.label_pic1.value = strCusName.split("|")[3];
                        frmorder.label_pic2.value = strCusName.split("|")[4];
                    }
                </script>
                
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="sticky-top mb-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <form id="frmorder" name="frmorder" method="post" action="order_db.php">
                                                <table border="0" cellspacing="0" align="center" class="table table-bordered table-striped">
                                                    <tr>
                                                        <td colspan="2">เลือกข้อมูลป้าย</td>
                                                    </tr>
                                                    <tr>
                                                        <td>ป้ายบ้านเลขที่</td>
                                                        <td><select class="select2bs4" data-placeholder="เลือกรายการ" name="label_id" style="width: 100%;" OnChange="resutName(this.value);">
                                                                <option value="">-</option>
                                                                <?php

                                                                while ($row = mysqli_fetch_array($result_t)) {
                                                                ?>
                                                                    <option value="<?php echo $row["label_id"]; ?>|<?php echo $row["label_name"]; ?>|<?php echo $row["label_detail"]; ?>|<?php echo $row["label_pic1"]; ?>|<?php echo $row["label_pic2"]; ?>"><?php echo $row["label_name"]; ?></option>
                                                                <?php
                                                                
                                                                }
                                                                ?>
                                                                
                                                            </select>
                                                            <input name="label_id" type="text" id="label_id" class="form-control" required />
                                                            <input name="label_name" type="hidden" id="label_name" class="form-control" required />
                                                    </tr>
                                                    <tr>
                                                        <td>รายละเอียด : <font color="red">*</font>
                                                        </td>
                                                        <td>
                                                            <textarea name="label_detail" cols="60" required class="form-control"></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>รูปที่ 1 : <font color="red">*</font> 
                                                        </td>
                                                        <td><input name="label_pic1" type="text" id="label_pic1" class="form-control"   />
                                                        <img id="imgUpload" class="img-fluid my-3">
                                                        <img src="../label_img/<?php echo $row1['label_pic1'];?>" id="label_pic1"  width="200px"></td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>รูปที่ 2 : <font color="red">*</font>
                                                        </td>
                                                        <td><input name="label_pic2" type="text" id="label_pic2" class="form-control"   />
                                                        <img id="imgUpload" class="img-fluid my-3">    
                                                        <img src="../label_img/<?php echo $row1['label_pic2'];?>" id="label_pic2" width="200px"></td>
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
        function readURL(input){
            if(input.files[0]){
                let reader = new FileReader();
                document.querySelector('#imgControl').classList.replace("d-none", "d-block");
                reader.onload = function (e) {
                    let element = document.querySelector('#imgUpload');
                    element.setAttribute("src", e.target.result);
                }  
                reader.readAsDataURL(input.files[0]);
            }         
        }
    </script>
<?php include('footerjs.php'); ?>
<?php include('scriptselectpicorder.php'); ?>
</html>