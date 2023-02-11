<script src="<?= base_url('assets/') ?>js/app.js"></script>

<script>
	window.addEventListener("load", () => {
		const currentUrl = window.location.href;
		const links = [...document.querySelectorAll('.sidebar-item')];
		links.forEach(link => {
			const linkAnchor = link.querySelector(".sidebar-link");
			if (linkAnchor.href === currentUrl) {
				link.classList.add('active');
			}
		});
	})

	const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
	const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>



<?php if (isset($scripts)) : ?>
	<?php foreach ($scripts as $sc) : ?>
		<?php $this->load->view($sc); ?>
	<?php endforeach; ?>
<?php endif; ?>





</body>

</html>