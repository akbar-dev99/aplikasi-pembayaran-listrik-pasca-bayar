<main class="content">

	<div class="container-fluid p-0">
		<div class="row mb-2 mb-xl-3">
			<div class="col-auto d-none d-sm-block">
				<h3><strong>Dashboard</strong></h3>

			</div>

			<div class="col-auto ms-auto text-end mt-n1">
				<!-- <a href="#" class="btn btn-light bg-white me-2">Invite a Friend</a> -->
				<a href="#" class="btn btn-primary">Tagihan</a>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<?php if ($this->session->flashdata('message_welcome')) : ?>
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						<strong>Hai <span class="  text-capitalize"><?= $user_auth->nama_pelanggan ?></span>!</strong> Selamat datang di halaman dashboard administrasi <strong>Aplikasi Pembayaran Listrik Pascabayar</strong>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php endif; ?>
			</div>
			<div class="col-sm-6 col-xl-3">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">Income</h5>
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
						<h1 class="mt-1 mb-3">$47.482</h1>
						<div class="mb-0">
							<span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> 3.65% </span>
							<span class="text-muted">Since last week</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xl-3">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">Orders</h5>
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
						<h1 class="mt-1 mb-3">2.542</h1>
						<div class="mb-0">
							<span class="badge badge-danger-light"> <i class="mdi mdi-arrow-bottom-right"></i> -5.25% </span>
							<span class="text-muted">Since last week</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xl-3">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">Activity</h5>
							</div>

							<div class="col-auto">
								<div class="stat text-primary">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity align-middle">
										<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
									</svg>
								</div>
							</div>
						</div>
						<h1 class="mt-1 mb-3">16.300</h1>
						<div class="mb-0">
							<span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> 4.65% </span>
							<span class="text-muted">Since last week</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-xl-3">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col mt-0">
								<h5 class="card-title">Revenue</h5>
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
						<h1 class="mt-1 mb-3">$20.120</h1>
						<div class="mb-0">
							<span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> 2.35% </span>
							<span class="text-muted">Since last week</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>