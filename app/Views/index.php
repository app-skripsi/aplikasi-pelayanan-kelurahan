<?php echo view("_partials/head"); ?>
<body>
<div class="wrapper">
<?php echo view("_partials/navbar"); ?>
		<div class="main">
			<?php echo view("_partials/profile"); ?>
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

					<div class="row">
						<div class="col-lg-12">
							<div class="w-100">
								<div class="row">
									<div class="col-lg-12">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Data Administrasi</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="truck"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?php  echo $count_administrasi?></h1>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
			<?php echo view("_partials/footer"); ?>
		</div>
	</div>
<?php echo view("_partials/script"); ?>
</body>

</html>