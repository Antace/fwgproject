<?php

$query3 = "SELECT * FROM tb_labeldetail  GROUP BY department_name asc" or die("Error:" . mysqli_error());
$result3 = mysqli_query($con, $query3);

?>
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<h4 class="text-center display-6">ค้นหาข้อมูลเลขที่บ้าน</h4>
		<form action="labeldetail.php" method="get" class="form-horizontal">
			<div class="row">
			<div class="col-md-3 ">
			
			</div>
				<div class="col-md-5 ">

						<div class="col-12">
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
						
						
						
					
				</div>
				<div class="col-md-1 ">
				<button type="submit" class="btn btn-primary">
							<i class="fa fa-search"></i>
							</button>		
				</div>

				<div class="col-md-3 ">

				</div>
				
			</div>
		</form>
	</div>
</section>