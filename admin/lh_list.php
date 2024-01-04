<?php 
// Get status message

use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Days;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Days360;

if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Member data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Something went wrong, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid Excel file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}

?>
<!-- <script>
            function formToggle(ID){
                var element = document.getElementById(ID);
                if(element.style.display === "none"){
                    element.style.display ="block";
                }else{
                    element.style.display = "none";
                }
            }
        </script> -->
<div class="container-fluid p-3">
        

        <!-- Display status message -->
        <?php if(!empty($statusMsg)){?>
            <div class="col-xs-12 p-3">
                <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
            </div>
        <?php } ?>

        <div class="row p-3">
            <!-- Import link -->
            <!-- <div class="col-md-12 head">
                <div class="float-end">
                    <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Import Excel</a>
                </div>
            </div> -->
            <!-- Excel file upload form --> 
            <div class="col-md-12" id="importFrm" style="display: none;">
                <form class="row g-3" action="lh_add_db.php" method="post" enctype="multipart/form-data">
                    <div class="col-auto">
                        <label for="flieInput" class="visually-hidden">File</label>
                        <input type="file" class="form-control" name="file" id="fileInput" />
                    </div>
                    <div class="col-auto">
                        <input type="submit" class="btn btn-primary mb-3" name="importSubmit" value="Import">
                    </div>
                </form>
            </div>

            <!-- Data list table --> 
            <table id="example1" style="width: 100%" class="table table-bordered table-hover table-sm">
                <thead class="">
                    <tr>
                        <th width='3%'>#</th>
                        <th width='5%'>แปลง</th>
                        <th width='3%'>ด้าน</th>
                        <th width='5%'>ด้านรั้ว</th>
                        <th width='5%'>ยาว</th>
                        <th width='7%'>วันที่อนุมัติ</th>
                        <th width='12%'>ประเภทรั้ว</th>
                        <th width='12%'>หน่วยงาน</th>
                        <th width='5%'>ปริมาณ</th>
                        <th width='5%'>ระยะ</th>
                        <th width='5%'>หน่วยนับ</th>
                        <th width='5%'>ราคาต่อหน่วย</th>
                        <th width='7%'>จำนวนเงิน</th>
                        <th width='7%'>หักเงินประกัน</th>
                        <th width='7%'>สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Get member's records from the database
                    $result = $con->query("SELECT * FROM tb_lh ORDER BY lh_id ASC");
                    
                    if($result->num_rows > 0){$i=0;
                        while($row = $result->fetch_assoc()){$i++;
                            $date1=$row['lh_date']; //สร้างตัวแปร date1 ให้เท่ากับ วันที่ใน database ชื่อ lh_date
                            $date1 = strtotime($date1);
                            $newdate = strtotime('+1 year',$date1);
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['lh_place']; ?></td>
                            <td><?php echo $row['lh_side']; ?></td>
                            <td><?php echo $row['lh_fenceside']; ?></td>
                            <td><?php echo $row['lh_length']; ?></td>
                            <td><?php echo $row['lh_date']; ?></td>
                            <td><?php echo $row['lh_fencetype']; ?></td>
                            <td><?php echo $row['lh_department']; ?></td>
                            <td><?php echo $row['lh_amount']; ?></td>
                            <td><?php echo $row['lh_phase']; ?></td>
                            <td><?php echo $row['lh_unit']; ?></td>
                            <td><?php echo $row['lh_price']; ?></td>
                            <td><?php echo $row['lh_number']; ?></td>
                            <td><?php echo $row['lh_insurance']; ?></td>
                            <!-- <td><?php echo date('Y-m-d', $newdate);?></td> -->
                            <td><?php if(date('Y-m-d', $newdate) < date('Y-m-d')){echo '<i style="color:red;">หมดประกัน </i>' ;}else{echo '<i style="color:blue;"> ยังไม่หมดประกัน </i>';} ?></td>
                        </tr>
                        <?php 
                        }
                    }else{
                        ?>
                        <tr><td colspan="16">No member(s) found...</td></tr>
                        <?php
                    }
                    ?>
                    
                </tbody>
            </table>
            
        </div>
    </div>





