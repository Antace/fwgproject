<?php
$query1 = "SELECT * FROM tb_label ORDER BY label_id " or die ("Erorr:" . mysqli_error());
$result1 = mysqli_query($con, $query1);


?>
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		เลือกรูปแบบป้าย :  <font color="red">*</font>
		<form action="order_confirm1.php?act=add" method="post" class="form-horizontal">
					<div class="row">
					
		
						<div class="col-10">
							<div class="form-group">
							<select class="select2bs4" name ="label_id" style="width: 100%;" >
							<option value="">-</option>	
									<?php foreach($result1 as $results){?>
									<option value="<?php echo $results["label_id"];?>">
										<?php echo $results["label_name"]; ?> 
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