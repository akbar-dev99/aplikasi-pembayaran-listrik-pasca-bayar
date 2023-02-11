<main class="content">
	<div class="container-fluid p-0">
		<div class="row mb-2 mb-xl-3">
			<div class="col-auto d-none d-sm-block">
				<h3><strong>Dashboard</strong> </h3>
			</div>
			<div class="col-auto ms-auto text-end mt-n1">
				<!-- <a href="#" class="btn btn-light bg-white me-2">Invite a Friend</a> -->
				<a href="#" class="btn btn-primary"> <i data-feather="file" class="my-auto mb-1"></i> Daftar Tagihan</a>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<?php if ($this->session->flashdata('message_welcome')) : ?>
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						<strong>Hai <span class="  text-capitalize"><?= $user_auth->nama_admin ?></span>!</strong> Selamat datang di halaman dashboard administrasi <strong>Aplikasi Pembayaran Listrik Pascabayar</strong>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php endif; ?>
			</div>
			<div class="col-sm-6 col-xl-3">
				<!-- <?php echo PrettyPrintArr()  ?> -->
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">Penghasilan</h5>
							</div>

							<div class="col-auto">
								<div class="stat text-primary">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign align-middle">
										<line x1="12" y1="1" x2="12" y2="23"></line>
										<path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
									</svg>
								</div>
							</div>
						</div>
						<h1 class="mt-1 mb-3 text-nowrap text-truncate " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?= Rupiah($payment_recap) ?>"><?= Rupiah($payment_recap) ?></h1>
						<div class="mb-0">
							<span class="text-muted">Bulan Ini</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xl-3">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">Pelanggan</h5>
							</div>

							<div class="col-auto">
								<div class="stat text-primary">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag align-middle">
										<path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
										<line x1="3" y1="6" x2="21" y2="6"></line>
										<path d="M16 10a4 4 0 0 1-8 0"></path>
									</svg>
								</div>
							</div>
						</div>
						<h1 class="mt-1 mb-3"><?= $count_cs ?></h1>
						<div class="mb-0">
							<span class="text-muted">Terdaftar</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xl-3">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">Tagihan</h5>
							</div>

							<div class="col-auto">
								<div class="stat text-primary">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity align-middle">
										<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
									</svg>
								</div>
							</div>
						</div>
						<h1 class="mt-1 mb-0">
							<?= $count_biils["count_unpaid_bills"] ?></h1>
						<small class="mb-3 text-muted text-capitalize fst-italic ">dari <?= $count_biils["count_bills"] ?> tagihan</small>
						<div class="mb-0">
							<span class="text-muted">Periode <?= MonthToString($count_biils["month"]) . " " . $count_biils["year"]  ?></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xl-3">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">Pendapatan</h5>
							</div>

							<div class="col-auto">
								<div class="stat text-primary">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart align-middle">
										<circle cx="9" cy="21" r="1"></circle>
										<circle cx="20" cy="21" r="1"></circle>
										<path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
									</svg>
								</div>
							</div>
						</div>
						<h1 class="mt-1 mb-3 text-nowrap text-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?= Rupiah($total_revenue) ?>"><?= Rupiah($total_revenue) ?></h1>
						<div class="mb-0">

							<span class="text-muted">Tahun <?= date("Y")  ?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
				<div class="card flex-fill">
					<div class="card-header">

						<h5 class="card-title mb-0">Calendar</h5>
					</div>
					<div class="card-body d-flex">
						<div class="align-self-center w-100">
							<div class="chart">
								<div id="datetimepicker-dashboard"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>