<?php
/**
 * Footer: logo, texto institucional, contacto, redes, logos de marcas y links legales.
 */
$footer_marcas = require ROOT . '/data/marcas.php';

$social_icons = [
  'facebook'  => 'ph-facebook-logo',
  'instagram' => 'ph-instagram-logo',
  'linkedin'  => 'ph-linkedin-logo',
  'tiktok'    => 'ph-tiktok-logo',
];
?>
<footer class="site-footer" id="contacto">
  <div class="container">

    <div class="row g-5 footer-top">
      <div class="col-lg-5">
        <img class="footer-logo" src="<?= e(img('logo/logo-gtg-blanco.png')) ?>" <?= img_dims('logo/logo-gtg-blanco.png') ?> alt="<?= e(SITE_NAME) ?>" loading="lazy">
        <p class="footer-text"><?= e(t('foot_texto')) ?></p>
      </div>

      <div class="col-sm-7 col-lg-4">
        <h3 class="footer-title"><?= e(t('foot_contacto')) ?></h3>
        <ul class="footer-contact">
          <li>
            <i class="ph-light ph-whatsapp-logo" aria-hidden="true"></i>
            <a href="<?= e(wa_link(t('whatsapp_texto'))) ?>" target="_blank" rel="noopener"><?= e(TELEFONO_TXT) ?></a>
          </li>
          <li>
            <i class="ph-light ph-envelope-simple" aria-hidden="true"></i>
            <a href="mailto:<?= e(EMAIL) ?>"><?= e(EMAIL) ?></a>
          </li>
        </ul>
      </div>

      <div class="col-sm-5 col-lg-3">
        <h3 class="footer-title"><?= e(t('foot_seguinos')) ?></h3>
        <ul class="footer-social">
          <?php foreach (SOCIAL as $red => $url): ?>
            <li>
              <a href="<?= e($url) ?>" target="_blank" rel="noopener" aria-label="<?= e(ucfirst($red)) ?>">
                <i class="ph-light <?= e(isset($social_icons[$red]) ? $social_icons[$red] : 'ph-link') ?>" aria-hidden="true"></i>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>

    <div class="footer-brands">
      <h3 class="eyebrow eyebrow--center"><?= e(t('foot_marcas')) ?></h3>
      <ul class="footer-brands-list">
        <?php foreach ($footer_marcas as $m): ?>
          <li>
            <a href="<?= e($m['url']) ?>" target="_blank" rel="noopener" title="<?= e($m['nombre']) ?>">
              <?php if (img_exists($m['logo'])): ?>
                <img src="<?= e(img($m['logo'])) ?>" <?= img_dims($m['logo']) ?> alt="<?= e($m['nombre']) ?>" loading="lazy">
              <?php else: ?>
                <span class="brand-text"><?= e($m['nombre']) ?></span>
              <?php endif; ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <div class="footer-bottom">
      <p>&copy; <?= date('Y') ?> <?= e(SITE_NAME) ?>. <?= e(t('foot_derechos')) ?></p>
      <ul class="footer-legal">
        <li><a href="<?= e(url('politica-de-cookies')) ?>"><?= e(t('foot_cookies')) ?></a></li>
        <li><a href="<?= e(url('politica-de-privacidad-de-grupo-tierra-gaucha')) ?>"><?= e(t('foot_privacidad')) ?></a></li>
        <li><a href="<?= e(url('sumate')) ?>"><?= e(t('foot_trabaja')) ?></a></li>
      </ul>
    </div>

  </div>
</footer>
