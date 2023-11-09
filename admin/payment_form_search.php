<!-- Main content -->
<?php
$query3 = "SELECT * FROM tb_contractor ORDER BY contractor_id asc" or die("Error:" . mysqli_error());
$result3 = mysqli_query($con, $query3);
?>
<section class="content">
	<div class="container-fluid">
		<form action="payment_form_add.php" method="post" class="form-horizontal">
			<div class="col-sm-6">
				<div class="form-group">
					ผู้รับเหมา : <font color="red">*</font>
					<select class="select2bs4"  name="contractor_nickname" style="width: 100%;" required>
						<option value="">-</option>
						<?php foreach ($result3 as $results) { ?>
							<option value="<?php echo $results["contractor_nickname"]; ?>">
								<?php echo $results["contractor_nickname"]; ?>
							</option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-9">
					<div class="row">

						<div class="col-1">จ่ายช่วงวันที่</div>
						<div class="col-2">
							<div class="form-group">
								<input type="date" name="d_s" class="form-control" />
							</div>
						</div>

						<div class="col-1">ถึง</div>
						<div class="col-2">
							<div class="form-group">
								<input type="date" name="d_e" class="form-control" />
							</div>
						</div>
						<div class="col-sm-1">
							<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> </button>


						</div>

					</div>
				</div>

			</div>
		</form>
	</div>
</section>