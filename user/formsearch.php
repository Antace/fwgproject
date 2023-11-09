<?php
$query1 = "SELECT * FROM tb_po ORDER BY po_id" or die ("Erorr:" . mysqli_error());
$result1 = mysqli_query($con, $query1);
$query2 = "SELECT * FROM tb_customer ORDER BY customer_id asc" or die("Error:" . mysqli_error());
$result2 = mysqli_query($con, $query2);
$query3 = "SELECT * FROM tb_department ORDER BY department_id asc" or die("Error:" . mysqli_error());
$result3 = mysqli_query($con, $query3);

?>
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<h4 class="text-center display-6">ค้นหาข้อมูลใบสั่งซื้อ</h4>
		<form action="po.php" method="get" class="form-horizontal">
			<div class="row">
				<div class="col-md-8 offset-md-3">
					<div class="row">
						<div class="col-3">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="เลขที่ใบสั่งซื้อ" name = "qpo">
							</div>
						</div>
						<div class="col-1"></div>
						<div class="col-6">
							<div class="form-group">
								<select class="select2bs4" data-placeholder="บริษัท"  name ="qcus" style="width: 100%;" >
								<option value="">-</option>
									<?php foreach($result2 as $results){?>
									<option value="<?php echo $results["customer_name"];?>">
										<?php echo $results["customer_name"]; ?>
									</option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-4">
							<div class="form-group">
								<select class="select2bs4" data-placeholder="โครงการ" name ="qdept" style="width: 100%;" >
								<option value="">-</option>
									<?php foreach($result3 as $results){?>
									<option value="<?php echo $results["department_name"];?>">
										<?php echo $results["department_name"]; ?>
									</option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-4">
							<div class="form-group">
								<select class="select2bs4" data-placeholder="งานของ" name ="qcate" style="width: 100%;" >
          							<option value="">-</option>
          							<option value="ไม่ระบุ">ไม่ระบุ</option>
          							<option value="LH">LH</option>
          							<option value="SANSIRI">SANSIRI</option>
          							<option value="QHOUSE">QHOUSE</option>
        						</select>
							</div>
						</div>
						<div class="col-sm-2">
							<button type="submit" class="btn btn-primary">
							<i class="fa fa-search"></i>
							</button>
						</div>
						
					</div>
				</div>
				
			</div>
		</form>
	</div>
</section>