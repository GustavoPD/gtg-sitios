<?php
/**
 * Agencias (tarifas y beneficios para agencias de viaje) — /agencias/
 * Textos en content/agencias.php
 */
require __DIR__ . '/config.php';
$c = contenido('agencias');

$page_slug        = 'agencias';
$page_description = $c['meta'];
$hero = ['imagen' => 'paginas/agencias-hero.webp', 'etiqueta' => SITE_NAME, 'titulo' => $c['titulo'], 'bajada' => $c['bajada']];

$wa_url    = wa_link($c['wa']);
$video_id  = 'N4aPuO83uqg';
$iconos    = ['ph-bed', 'ph-fork-knife', 'ph-van', 'ph-tag', 'ph-mountains', 'ph-package'];
$iconos_cards = ['ph-compass', 'ph-buildings', 'ph-rocket-launch'];

include ROOT . '/includes/page-start.php';
?>
<section class="section">
  <div class="container">
    <div class="row g-5 align-items-center">
      <div class="col-lg-5" data-aos="fade-up">
        <span class="eyebrow"><?= e($c['etiqueta']) ?></span>
        <h2 class="section-title"><?= e($c['intro_titulo']) ?></h2>
        <div class="prose">
          <?php foreach ($c['intro'] as $p): ?><p><?= e($p) ?></p><?php endforeach; ?>
        </div>
        <div class="feature-actions">
          <a href="<?= e($wa_url) ?>" target="_blank" rel="noopener" class="btn btn-gtg"><i class="ph-light ph-whatsapp-logo me-2" aria-hidden="true"></i><?= e($c['btn_wa']) ?></a>
          <a href="mailto:<?= e(EMAIL) ?>" class="btn btn-gtg-outline"><i class="ph-light ph-envelope-simple me-2" aria-hidden="true"></i><?= e($c['btn_mail']) ?></a>
        </div>
      </div>
      <div class="col-lg-7" data-aos="fade-up" data-aos-delay="120">
        <div class="embed-frame">
          <iframe src="https://www.youtube-nocookie.com/embed/<?= e($video_id) ?>?rel=0" title="<?= e($c['video']) ?>" loading="lazy" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section section--cream">
  <div class="container">
    <div class="text-center section-head" data-aos="fade-up">
      <span class="eyebrow"><?= e($c['beneficios_etiqueta']) ?></span>
      <h2 class="section-title mb-0"><?= e($c['beneficios_titulo']) ?></h2>
    </div>
    <ul class="icon-grid mb-5" data-aos="fade-up">
      <?php foreach ($c['beneficios'] as $i => $b): ?>
        <li><i class="ph-light <?= e($iconos[$i]) ?>" aria-hidden="true"></i><?= e($b) ?></li>
      <?php endforeach; ?>
    </ul>
    <div class="row g-4">
      <?php foreach ($c['cards'] as $i => $card): ?>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?= $i * 120 ?>">
          <div class="info-card">
            <i class="ph-light <?= e($iconos_cards[$i]) ?> info-card-icon" aria-hidden="true"></i>
            <span class="eyebrow"><?= e($card['etiqueta']) ?></span>
            <h3 class="info-card-title"><?= e($card['titulo']) ?></h3>
            <p><?= e($card['texto']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="cta-band">
  <div class="parallax" data-parallax="1" aria-hidden="true">
    <img class="parallax-img" src="<?= e(img('parallax/be.webp')) ?>" <?= img_dims('parallax/be.webp') ?> alt="" loading="lazy">
  </div>
  <div class="cta-band-overlay"></div>
  <div class="container" data-aos="fade-up">
    <h2 class="section-title"><?= e($c['cta_titulo']) ?></h2>
    <p><?= e($c['cta_texto']) ?></p>
    <div class="feature-actions">
      <a href="<?= e($wa_url) ?>" target="_blank" rel="noopener" class="btn btn-gtg"><i class="ph-light ph-whatsapp-logo me-2" aria-hidden="true"></i><?= e($c['btn_wa']) ?></a>
      <a href="mailto:<?= e(EMAIL) ?>" class="btn btn-gtg-light"><?= e(EMAIL) ?></a>
    </div>
  </div>
</section>

<?php include ROOT . '/includes/page-end.php'; ?>
