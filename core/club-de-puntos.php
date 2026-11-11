<?php
/**
 * Club de Puntos — /club-de-puntos/ (fuera del menú: se mantiene para no romper links del sitio anterior)
 * Textos en content/club-de-puntos.php
 */
require __DIR__ . '/config.php';
$c = contenido('club-de-puntos');

$page_slug        = 'club-de-puntos';
$page_description = $c['meta'];
$hero = ['imagen' => 'paginas/club-hero.webp', 'etiqueta' => SITE_NAME, 'titulo' => $c['titulo'], 'bajada' => $c['bajada']];

$app_url      = 'https://appmovil.grupotierragaucha.com.ar/';
$registro_url = 'https://appmovil.grupotierragaucha.com.ar/register';
$iconos       = ['ph-gift', 'ph-envelope-open', 'ph-seal-check'];

include ROOT . '/includes/page-start.php';
?>
<section class="section">
  <div class="container">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6" data-aos="fade-up">
        <div class="feature-media feature-media--wide">
          <img src="<?= e(img('paginas/club-de-puntos.webp')) ?>" <?= img_dims('paginas/club-de-puntos.webp') ?> alt="<?= e($c['titulo']) ?>" loading="lazy">
        </div>
      </div>
      <div class="col-lg-5 offset-lg-1" data-aos="fade-up" data-aos-delay="120">
        <span class="eyebrow"><?= e($c['etiqueta']) ?></span>
        <h2 class="section-title"><?= e($c['intro_titulo']) ?></h2>
        <div class="prose">
          <?php foreach ($c['intro'] as $p): ?><p><?= e($p) ?></p><?php endforeach; ?>
        </div>
        <div class="feature-actions">
          <a href="<?= e($registro_url) ?>" target="_blank" rel="noopener" class="btn btn-gtg"><?= e($c['btn_registro']) ?></a>
          <a href="<?= e($app_url) ?>" target="_blank" rel="noopener" class="btn btn-gtg-outline"><?= e($c['btn_ingresar']) ?></a>
        </div>
        <p class="mt-3 mb-0"><a href="<?= e(url('terminos-y-condiciones-club-de-puntos')) ?>" class="link-gold"><?= e($c['tyc']) ?> <i class="ph-light ph-arrow-right" aria-hidden="true"></i></a></p>
      </div>
    </div>
  </div>
</section>

<section class="section section--cream">
  <div class="container">
    <div class="row g-4">
      <?php foreach ($c['cards'] as $i => $card): ?>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?= $i * 120 ?>">
          <div class="info-card">
            <i class="ph-light <?= e($iconos[$i]) ?> info-card-icon" aria-hidden="true"></i>
            <span class="eyebrow"><?= e($card['etiqueta']) ?></span>
            <h3 class="info-card-title"><?= e($card['titulo']) ?></h3>
            <p><?= e($card['texto']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include ROOT . '/includes/page-end.php'; ?>
