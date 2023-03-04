<main class="content">

	<div class="container-fluid p-0">
		<div class="row mb-2 mb-xl-3">
			<div class="col-auto d-none d-sm-block">
				<h3><strong>Dashboard</strong></h3>

			</div>

			<div class="col-auto ms-auto text-end mt-n1">
				<!-- <a href="#" class="btn btn-light bg-white me-2">Invite a Friend</a> -->
				<a href="<?= base_url("pelanggan/tagihan") ?>" class="btn btn-primary"> <i data-feather="file" class="my-auto mb-1"></i> Daftar Tagihan</a>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<?php if ($this->session->flashdata('message_welcome')) : ?>
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						<strong>Hai <span class="  text-capitalize"><?= $user_auth->nama_pelanggan ?></span>!</strong> Selamat datang di <strong>Aplikasi Pembayaran Listrik Pascabayar</strong>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="row">
			<div class="col-xl-8 col-xxl-7 d-flex">
				<div class="w-100">
					<div class="row">
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Pembayaran</h5>
										</div>

										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="dollar-sign"></i>
											</div>
										</div>
									</div>
									<?php if ($total_pays) : ?>
										<h1 class="mt-1 mb-3 text-truncate " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?= Rupiah($total_pays) ?>"><?= Rupiah($total_pays) ?></h1>
									<?php else : ?>
										<h1 class="mt-1 mb-3 text-truncate " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Rp. 0">Rp. 0</h1>
									<?php endif; ?>
									<div class="mb-0">
										<span class="text-muted">Tahun ini</span>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Penggunaan Meter</h5>
										</div>

										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="zap"></i>
											</div>
										</div>
									</div>
									<?php
									$total_meter = 0;

									if ($usage) {
										$total_meter = $usage->meter_akhir - $usage->meter_awal;
									}
									?>
									<div class=" mb-3 ">
										<h1 class=" mb-0 "><?= $total_meter ?>kwh</h1>

									</div>
									<div class="mb-0">
										<span class="text-muted">Bulan ini</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Transaksi</h5>
										</div>

										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="clipboard"></i>
											</div>
										</div>
									</div>
									<h1 class="mt-1 mb-3"><?= $count_transactions ?></h1>
									<div class="mb-0">
										<span class="text-muted">Semua</span>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Tunggakan</h5>
										</div>

										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="file-text"></i>
											</div>
										</div>
									</div>
									<?php if ($sum_bill) : ?>
										<h1 class="mt-1 mb-3 text-truncate " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?= Rupiah($sum_bill) ?>"><?= Rupiah($sum_bill) ?></h1>
									<?php else : ?>
										<h1 class="mt-1 mb-3 text-truncate " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Rp. 0">Rp. 0</h1>
									<?php endif; ?>
									<div class="mb-0">
										<span class="text-muted">Dari <?= $arrears ?> tagihan</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-4 col-xxl-5 d-flex align-items-stretch">
				<div class="card flex-fill w-100">
					<div class="card-header">

						<h5 class="card-title mb-0">Informasi KWH</h5>
					</div>
					<div class="card-body py-3 text-center d-flex align-items-center flex-column justify-content-center ">
						<div class="  mb-4 rounded-circle p-3 text-primary" style="width: 70px; height: 70px; background: #d3e2f7;">
							<i style="width: 100%; height: 100%;" data-feather="zap"></i>
						</div>
						<h1 class=" text-muted fw-bold "><?= $user_auth->nomor_kwh  ?></h1>
					</div>
					<div class="card-footer d-flex flex-column flex-lg-row justify-content-lg-center justify-content-xl-between gap-2 gap-lg-4   ">
						<div>
							<small class=" text-primary ">Daya</small>
							<h4 class="text-muted fw-bold "><?= $user_auth->daya  ?></h4>
						</div>
						<div>
							<small class=" text-primary ">Tarif</small>
							<h4 class="text-muted fw-bold "><?= Rupiah($user_auth->tarif_perkwh)  ?>/kwh</h4>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-md-6 col-xxl-3 d-flex order-2 order-xxl-3">
				<div class="card flex-fill w-100">
					<div class="card-header d-flex justify-content-between align-items-center">
						<h5 class="card-title mb-0">Tagihan Terbaru</h5>
						<a href="<?= base_url("pelanggan/tagihan") ?>" class=" btn btn-link p-0 shadow-none  "><small>Lebih lanjut <i data-feather="arrow-right"></i>
							</small></a>
					</div>
					<div class="card-body d-flex">
						<div class="align-self-start w-100">
							<div class="py-2 table-responsive">
								<table class="table table-hover">
									<thead>
										<tr>
											<th>Periode</th>
											<th>Jumlah Bayar</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($latest_bills as $b) : ?>
											<tr>
												<td class=" text-nowrap "><?= MonthToString($b->bulan); ?> <?= $b->tahun; ?></td>
												<td class="text-nowrap"><?= Rupiah($b->tarif_perkwh * $b->jumlah_meter) ?></td>
												<td>
													<div>
														<?php if ($b->status === "PAID") { ?>
															<span class=" badge bg-success rounded-0   ">Lunas</span>
														<?php } else { ?>
															<span class=" badge rounded-0 bg-danger">Belum Lunas</span>
														<?php } ?>
													</div>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
				<div class="card flex-fill w-100">
					<div class="card-header">
						<h5 class="card-title mb-0">Grafik Penggunaan Listrik</h5>
					</div>
					<div class="card-body px-4">
						<canvas id="usage-chart"></canvas>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
				<div class="card flex-fill">
					<div class="card-header">

						<h5 class="card-title mb-0">Kalendar</h5>
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