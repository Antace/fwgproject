<?php include('h.php'); ?>

<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
        <!-- Main Header -->
        <?php include('menutop.php'); ?>
        <?php include('menu_l.php'); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <i class="glyphicon glyphicon-check hidden-xs"></i> <span class="hidden-xs">ทำรายการเงินเดือน</span>
                    <a href="salary_form_add1.php" class="btn btn-primary btn-sm">เพิ่ม</a>
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


                                        $semployee_id = $_POST['employee_id']; //รับค่ารหัสสินค้าจาก salary_form_search.php
                                        //  print_r($_POST);

//  exit;
                                        @$employee_id = mysqli_real_escape_string($con, $_GET['employee_id']);
                                        $act = mysqli_real_escape_string($con, $_GET['act']);

                                        //print_r($employee_id);
                                        // exit;
                                        if ($act == 'add' && !empty($semployee_id)) {
                                            if (isset($_SESSION['salary'][$semployee_id])) {
                                                $_SESSION['salary'][$semployee_id]++;
                                            } else {
                                                $_SESSION['salary'][$semployee_id] = 1;
                                            }
                                        }
                                        if ($act == 'remove' && !empty($employee_id))  //ยกเลิกการสั่งซื้อ
                                        {
                                            unset($_SESSION['salary'][$employee_id]);
                                        }
                                        if ($act == 'update') {
                                            $salary_pricearray=$_POST['salary_price'];
                                            // foreach($salary_pricearray as $employee_id => $salary_price){
                                            //     $_SESSION['salary'][$employee_id] = $salary_price;
                                            // }
                                            // $vat=$_POST['salary_vat'];
                                            $discount=$_POST['salary_discount'];
                                            
                                            $amount_array = $_POST['amount'];
                                            foreach ($amount_array as $employee_id => $amount) {
                                                $_SESSION['salary'][$employee_id] = $amount;
                                            }
                                           
                                        }
                                        if ($act == 'cancel')  //ยกเลิกการสั่งซื้อ
                                        {
                                            unset($_SESSION['salary']);
                                        }
                                        $query2 = "SELECT * FROM tb_customer ORDER BY customer_id asc" or die("Error:" . mysqli_error($con));
                                        $result2 = mysqli_query($con, $query2);
                                        $row2 = mysqli_fetch_array($result2);
                                        ?>
                                        <?php
                                        if (@$_GET['do'] == 'f') {
                                            echo '<script type="text/javascript">
                                                swal("", "กรุณาใส่ข้อมูลให้ถูกต้อง !!", "warning");
                                        </script>';
                                            echo '<meta http-equiv="refresh" content="2;url=employee.php?act=add" />';
                                        } elseif (@$_GET['do'] == 'd') {
                                            echo '<script type="text/javascript">
                                                swal("", "เลขใบสั่งซื้อซ้ำ กรุณาเปลี่ยน  !!", "error");
                                        </script>';
                                            echo '<meta http-equiv="refresh" content="1;url=employee.php?act=add" />';
                                        }
                                        
                                        ?>
                                        <div align="right">
                                            <font color="red">*</font>
                                            <font color="gray">Required Fields</font>
                                        </div>
                                        <hr>
                                        <?php
                                        include "salary_form_search.php";
                                        ?>

                                        <form id="frmsalary" name="frmsalary" method="post" action="?act=update">
                                            <table width="600" border="0" align="center" class="table table-bordered table-striped table-sm">

                                                <tr>
                                                
                                                    <td>ชื่อ-สกุล</td>
                                                    <!-- <td align="center">เลขที่บัญชี</td>
                                                    <td align="center">เงินเดือน</td>
                                                    <td align="center">เบี้ยเลี้ยง</td>
                                                    <td align="center">ค่าตำแหน่ง</td>
                                                    <td align="center">ค่าเช่าบ้าน</td>
                                                    <td align="center">ค่าโทรศัพท์</td>
                                                    <td align="center">เบี้ยขยัน</td>
                                                    <td align="center">ค่าน้ำมัน</td>
                                                    <td align="center">โบนัส</td>
                                                    <td align="center">เงินได้อื่นๆ</td>
                                                    <td align="center">ค่าทำงานล่วงเวลา</td> -->
                                                    <td align="center">หักประกันสังคม</td>
                                                    <td align="center">หักภาษี</td>
                                                    <td align="center">หักมาสาย</td>
                                                    <td align="center">หักขาดงาน</td>
                                                    <td align="center">หักเบี้ยเลี้ยงกิจ/ป่วย/พักร้อน</td>
                                                    <td align="center">เบิกล่วงหน้า</td>
                                                    <td align="center">หักกองทุนสำรองเลี้ยงชีพ</td>
                                                    <td align="center">หักจ่ายอื่นๆ</td>
                                                    <td align="center">หักประกันอุบัติเหตุ</td>
                                                    <td align="center">หักกยศ.</td>

                                                    
                                                    <td align="center">ลบ</td>
                                                </tr>
                                                <?php
                                                echo "
                                                <style type='text/css'>
                                                .mytextbox{
                                                font:14px Tahoma;
                                                }
                                                </style>";
                                                $total = 0;
                                                if (!empty($_SESSION['salary'])) {
                                                    foreach ($_SESSION['salary'] as $employee_id => $qty  ) {
                                                        $salary_price = $salary_pricearray[$employee_id];
                                                        $sql = "SELECT * FROM tb_employees WHERE employee_id=$employee_id";
                                                        
                                                        $query = mysqli_query($con, $sql);
                                                        $row = mysqli_fetch_array($query);
                                                        $sum = $salary_price * $qty;
                                                        $total += $sum;
                                                        $total1 = $total-$discount;
                                                        
                                                        
                                                        $vat = ($total1 * 0.07);
                                                        $stotal = $total1 + $vat;
                                                        $p_qty = $row['employee_uom']; //จำนวนสินค้าในสต๊อก
                                                        echo "<tr>";
                                                        
                                                        echo "<input type='hidden' size='5' class='form-control' style='text-align:right;' name='Salary[$employee_id]' value='".$row['emp_id']."'  Required/>";
                                                        echo "<td width='100'>" . $row["employee_name"] . "</td>";
                                                        
                                                        echo "<input type='hidden' size='5' class='form-control' style='text-align:right;' name='Salary[$employee_id]' value='".$row['Accountnumber']."'  Required/>";
                                                        
                                                        echo "<input type='hidden' size='5' class='form-control' style='text-align:right;' name='Salary[$employee_id]' value='".$row['Salary']."'  Required/>";
                                                        
                                                        echo "<input type='hidden' class='form-control' style='text-align:right;' name='Allowance[$employee_id]' value='".$row['Allowance']."'  Required/>";
                                                        
                                                        echo "<input type='hidden' class='form-control' style='text-align:right;' name='Position[$employee_id]' value='".$row['Position']."'  Required/>";
                                                        
                                                        echo "<input type='hidden' class='form-control' style='text-align:right;' name='House[$employee_id]' value='".$row['House']."'  Required/>";
                                                        
                                                        echo "<input type='hidden' class='form-control' style='text-align:right;' name='Phone[$employee_id]' value='".$row['Phone']."'  Required/>";
                                                        
                                                        echo "<input type='hidden' class='form-control' style='text-align:right;' name='Diligent[$employee_id]' value='".$row['Diligent']."'  Required/>";
                                                        
                                                        echo "<input type='hidden' class='form-control' style='text-align:right;' name='Oil[$employee_id]' value='".$row['Oil']."'  Required/>";
                                                        
                                                        echo "<input type='hidden' class='form-control' style='text-align:right;' name='Bonus[$employee_id]' value='".$row['Bonus']."'  Required/>";
                                                        
                                                        echo "<input type='hidden' class='form-control' style='text-align:right;' name='Income[$employee_id]' value='".$row['Income']."'  Required/>";
                                                        
                                                        echo "<input type='hidden' class='form-control' style='text-align:right;' name='Overtime[$employee_id]' value='".$row['Overtime']."'  Required/>";

                                                        echo "<td width='57' align='right'>";
                                                        echo "<input type='number' class='form-control' style='text-align:right;' name='SocialSecurity[$employee_id]' value='0'  Required/></td>";
                                                        echo "<td width='57' align='right'>";
                                                        echo "<input type='number' class='form-control' style='text-align:right;' name='Tax[$employee_id]' value='0'  Required/></td>";
                                                        echo "<td width='57' align='right'>";
                                                        echo "<input type='number' class='form-control' style='text-align:right;' name='Late[$employee_id]' value='0'  Required/></td>";
                                                        echo "<td width='57' align='right'>";
                                                        echo "<input type='number' class='form-control' style='text-align:right;' name='Absentt[$employee_id]' value='0'  Required/></td>";
                                                        echo "<td width='57' align='right'>";
                                                        echo "<input type='number' class='form-control' style='text-align:right;' name='SBH[$employee_id]' value='0'  Required/></td>";
                                                        echo "<td width='57' align='right'>";
                                                        echo "<input type='number' class='form-control' style='text-align:right;' name='Reveal[$employee_id]' value='0'  Required/></td>";
                                                        echo "<td width='57' align='right'>";
                                                        echo "<input type='number' class='form-control' style='text-align:right;' name='ReserveFund[$employee_id]' value='0'  Required/></td>";
                                                        echo "<td width='57' align='right'>";
                                                        echo "<input type='number' class='form-control' style='text-align:right;' name='Other[$employee_id]' value='0'  Required/></td>";
                                                        echo "<td width='57' align='right'>";
                                                        echo "<input type='number' class='form-control' style='text-align:right;' name='InsuranceAL[$employee_id]' value='0'  Required/></td>";
                                                        echo "<td width='57' align='right'>";
                                                        echo "<input type='number' class='form-control' style='text-align:right;' name='SLF[$employee_id]' value='0'  Required/></td>";
                                                        

                                                        
                                                        //remove employee
                                                        echo "<td width='46' align='center'><a href='salary_form_add1.php?employee_id=$employee_id&act=remove'class='btn btn-danger'>ลบ</a></td>";
                                                        echo "</tr>";
                                                    }
                                                    
                                                    
                                                    echo "<tr>";
                                                    echo "<td colspan='15' align='right'>";
                                                    echo "<input type='hidden' name='username' value=' $username'>";
                                                    echo "</td>";
                                                    echo "</tr>";
                                                }
                                                ?>
                                                
                                                <tr>
                                                    <td colspan="15" align="right">
                                                        <input type="submit" name="button" id="button" class="btn btn-success btn-sm" value="ยืนยัน" />
                                                        <?php if ($act == 'update') { ?>
                                                            <input type="button" value="บันทึก" class="btn btn-info btn-sm" onClick="this.form.action='salaryemployee_confirm.php'; submit()">
                                                            
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                        <hr>
                                        <!-- /.card-body -->
                                        <a href="salary.php" class="btn btn-warning btn-sm">ปิด</a>
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