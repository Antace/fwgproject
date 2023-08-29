<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            $query = "
            SELECT product_id,sale_price, SUM(sale_price) AS uom, (product_id) AS product_id
            FROM tb_salelist
            GROUP BY (product_id)
            ORDER BY (product_id) DESC
            ";
            $result = mysqli_query($con, $query);
            $resultchart = mysqli_query($con, $query);
            //for chart
            $datesave = array();
            $uom = array();
            while($rs = mysqli_fetch_array($resultchart)){
            $datesave[] = "\"".$rs['product_id']."\"";
            $uom[] = "\"".$rs['uom']."\"";
            }
            $datesave = implode(",", $datesave);
            $uom = implode(",", $uom);
            
            ?>
            <h3 align="center">รายงานการขายประจำวัน (รวมภาษี)</h3>
            
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
            <hr>
            <p align="center">
                <!--devbanban.com-->
                <canvas id="myChart" width="800px" height="300px"></canvas>
                <script>
                var ctx = document.getElementById("myChart").getContext('2d');
                var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                labels: [<?php echo $datesave;?>
                
                ],
                datasets: [{
                label: 'รายงานรายได้ แยกตามวัน (บาท)',
                data: [<?php echo $uom;?>
                ],
                backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
                }]
                },
                options: {
                scales: {
                yAxes: [{
                ticks: {
                beginAtZero:true
                }
                }]
                }
                }
                });
                </script>
            </p>
            <div class="col-sm-12">
                <h3>List</h3>
                <table   class="table table-bordered table-striped"  align="center">
                    <thead>
                        <tr class="table-primary">
                            <th width="20%">เลขที่ขาย</th>
                            <th width="50%">บริษัท</th>
                            <th width="10%"><center>จำนวนเงิน</center></th>
                        </tr>
                    </thead>
                    
                    
                    <?php 
					
		   $sql = "
            SELECT * FROM tb_salelist
            GROUP BY sale_price 
            ORDER BY sale_id DESC
            ";
            $result2 = mysqli_query($con, $sql);
					while($row2 = mysqli_fetch_array($result2)) { 
					
					?>
                    <tr>
                        <td><?php echo $row2['product_id'];?></td>
                        <td><?php echo $row2['product_name'];?></td>
                        <td align="right"><?php echo number_format($row2['sale_price'],2);?></td>
                    </tr>
                    <?php
                    @$amount_total += $row2['sale_price'];
                    }
                    ?>
                    <tr class="table-danger">
                        <td align="center"></td>
                        <td align="center">รวม</td>
                        <td align="right"><b>
                        <?php echo number_format($amount_total,2);?></b></td></td>
                    </tr>
                </table>
            </div>
            <?php mysqli_close($con);?>
        </div>
    </div>
</div>