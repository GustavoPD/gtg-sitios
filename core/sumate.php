<?php
/**
 * Trabajá con nosotros — /sumate/
 * Textos y búsquedas en content/sumate.php
 */
require __DIR__ . '/config.php';
$c = contenido('sumate');

$page_slug        = 'sumate';
$page_description = $c['meta'];
$hero = ['imagen' => 'paginas/sumate-hero.webp', 'etiqueta' => SITE_NAME, 'titulo' => $c['titulo'], 'bajada' => $c['bajada']];

$iconos_valores = ['ph-handshake', 'ph-shield-check', 'ph-trend-up', 'ph-arrows-clockwise', 'ph-users-three', 'ph-heart', 'ph-star'];

include ROOT . '/includes/page-start.php';
?>
<section class="section">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-9" data-aos="fade-up">
        <span class="eyebrow"><?= e($c['etiqueta']) ?></span>
        <h2 class="section-title"><?= e($c['intro_titulo']) ?></h2>
        <div class="prose">
          <?php foreach ($c['intro'] as $p): ?><p><?= e($p) ?></p><?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section section--cream">
  <div class="container">
    <div class="text-center section-head" data-aos="fade-up">
      <span class="eyebrow"><?= e($c['valores_etiqueta']) ?></span>
      <h2 class="section-title mb-0"><?= e($c['valores_titulo']) ?></h2>
    </div>
    <div class="row g-4 justify-content-center">
      <?php foreach ($c['valores'] as $i => $v): ?>
        <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="<?= ($i % 4) * 100 ?>">
          <div class="info-card">
            <i class="ph-light <?= e($iconos_valores[$i]) ?> info-card-icon" aria-hidden="true"></i>
            <h3 class="info-card-title"><?= e($v[0]) ?></h3>
            <p><?= e($v[1]) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section" id="busquedas">
  <div class="container">
    <div class="row justify-content-center text-center section-head">
      <div class="col-lg-8" data-aos="fade-up">
        <span class="eyebrow"><?= e($c['busq_etiqueta']) ?></span>
        <h2 class="section-title"><?= e($c['busq_titulo']) ?></h2>
        <p class="lead-text mb-0"><?= e($c['busq_texto']) ?></p>
      </div>
    </div>
    <div class="row g-4">
      <?php foreach ($c['busquedas'] as $i => $b):
        $es_mail = strpos($b['url'], 'mailto:') === 0; ?>
        <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
          <article class="job-card">
            <img src="<?= e(img($b['imagen'])) ?>" <?= img_dims($b['imagen']) ?> alt="" loading="lazy">
            <div class="job-card-body">
              <h3 class="job-card-title"><?= e($b['titulo']) ?></h3>
              <p><?= e($b['texto']) ?></p>
              <a href="<?= e($b['url']) ?>"<?= $es_mail ? '' : ' target="_blank" rel="noopener"' ?> class="btn btn-gtg btn-sm">
                <?= e(isset($b['boton']) ? $b['boton'] : $c['postular']) ?>
              </a>
              <?php if ($es_mail): ?>
                <small class="d-block mt-2 text-break"><?= e(EMAIL_RRHH) ?></small>
              <?php endif; ?>
            </div>
          </article>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include ROOT . '/includes/page-end.php'; ?>
