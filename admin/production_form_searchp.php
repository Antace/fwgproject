<?php
$query1 = "SELECT * FROM tb_productproject ORDER BY productp_id" or die ("Erorr:" . mysqli_error());
$result1 = mysqli_query($con, $query1);


?>
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		รหัสสินค้า
		<form action="production_form_add.php?act=add" method="post" class="form-horizontal">
					<div class="row">
					
		
						<div class="col-10">
							<div class="form-group">
							<select class="select2bs4"    name ="productp_id" style="width: 100%;" >	
							<option value="">-</option>	
									<?php foreach($result1 as $results){?>
									<option value="<?php echo $results["productp_id"];?>">
										<?php echo $results["productp_name"]; ?> <?php echo $results["department_name"]; ?>| <?php echo $results["productp_thick"]; ?> x <?php echo $results["productp_height"]; ?> x <?php echo $results["productp_long"]; ?> ม.
									</option>
									<?php } ?>
								</select>
							<!-- <input type="text" class="form-control" name = "product_id"> -->
							</div>
						</div>
						<div class="col-sm-2">
							<button type="submit" class="btn btn-primary">
							เพิ่ม
							</button>
						</div>
						
					</div>

		</form>
	</div>
</section>