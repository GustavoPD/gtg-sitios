<!-- Vendor -->
<script src="<?= asset('vendor/bootstrap/js/bootstrap.bundle.min.js') ?>" defer></script>
<script src="<?= asset('vendor/swiper/swiper-bundle.min.js') ?>" defer></script>
<script src="<?= asset('vendor/aos/aos.js') ?>" defer></script>
<script src="<?= asset('vendor/glightbox/glightbox.min.js') ?>" defer></script>
<script src="<?= asset('vendor/flatpickr/flatpickr.min.js') ?>" defer></script>
<?php if (LANG !== 'en'): ?>
<script src="<?= asset('vendor/flatpickr/l10n/' . LANG . '.js') ?>" defer></script>
<?php endif; ?>
<script src="<?= asset('vendor/flatpickr/plugins/rangePlugin.js') ?>" defer></script>

<?php if (!empty($page_scripts)) foreach ($page_scripts as $ps): ?>
<script src="<?= e($ps) ?>" async defer></script>
<?php endforeach; ?>

<!-- Sitio -->
<script src="<?= asset('js/parallax.js') ?>" defer></script>
<script src="<?= asset('js/main.js') ?>" defer></script>
</body>
</html>
