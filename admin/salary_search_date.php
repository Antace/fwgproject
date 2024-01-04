<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<h4 class="text-center display-6"> ค้นหาตามช่วงวันที่</h4>
		<br>
		<form action="salary.php" method="post" class="form-horizontal">
			<div class="row">
				<div class="col-md-8 offset-md-3">
					<div class="row">

						<div class="col-1">วันที่</div>
						<div class="col-3">
							<div class="form-group">
								<input type="date" name="d_s" class="form-control" />
							</div>
						</div>
						<div class="col-1"></div>
						<div class="col-1">ถึง</div>
						<div class="col-3">
							<div class="form-group">
								<input type="date" name="d_e" class="form-control" />
							</div>
						</div>

						<div class="col-1"></div>
						<div class="col-sm-2">
							<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> </button>

							</button>
						</div>

					</div>
				</div>

			</div>
		</form>
	</div>
</section>