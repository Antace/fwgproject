<?php
$query1 = "SELECT * FROM tb_product ORDER BY product_id" or die("Erorr:" . mysqli_error($con));
$result1 = mysqli_query($con, $query1);
?>


<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		รหัสสินค้า
		<form name="frmMain" action="?act=update" method="get" class="form-horizontal">
			<div class="row">
				<div class="col-10">
					<div class="form-group">
						<select class="select2bs4" name="product_id" style="width: 100%;">
							<option value="">-</option>
							<?php foreach ($result1 as $results) { ?>
								<option value="<?php echo $results["product_id"]; ?>">
									<?php echo $results["product_name"]; ?>
								</option>
							<?php } ?>
						</select>
						
						<!-- <input type="text" class="form-control" name = "product_id"> -->
					</div>
				</div>
				

			</div>
	
		</form>
	</div>
</section>
</body>
</html>