<nav id="sidebar" class="sidebar js-sidebar">
	<div class="sidebar-content js-simplebar">
		<a class="sidebar-brand" href="index.html">
			<span class="align-middle">Listrikku
			</span>
			<br>
			<span class="text-white-50" style="font-size: 18px;">Pelanggan</span>
		</a>

		<ul class="sidebar-nav">
			<li class="sidebar-header">
				Dashboard
			</li>

			<li class="sidebar-item ">
				<a class="sidebar-link" href="<?= base_url("pelanggan") ?>">

					<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
				</a>
			</li>

			<li class="sidebar-item">
				<a class="sidebar-link" href="<?= base_url("pelanggan/profile") ?>">
					<i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
				</a>
			</li>



			<li class="sidebar-header">
				Listrik
			</li>

			<li class="sidebar-item">
				<a class="sidebar-link" href="<?= base_url("pelanggan/penggunaan") ?>">
					<i class="align-middle" data-feather="zap"></i> <span class="align-middle">Penggunaan</span>
				</a>
			</li>
			<li class="sidebar-item">
				<a class="sidebar-link" href="<?= base_url("pelanggan/tagihan") ?>">
					<i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Tagihan</span>
				</a>
			</li>

			<li class="sidebar-header">
				Pembayaran
			</li>

			<li class="sidebar-item">
				<a class="sidebar-link" href="<?= base_url("pelanggan/pembayaran") ?>">
					<i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Pembayaran</span>
				</a>
			</li>
	</div>
</nav>

<div class="main">