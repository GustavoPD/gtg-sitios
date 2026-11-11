<?php
/**
 * 8.1 Hero — Swiper fullscreen (fade + Ken Burns) + buscador superpuesto.
 * Requiere $slides (index.php).
 */
$hero_hoteles = require ROOT . '/data/hoteles.php';

// Por ahora el hero muestra solo el logo (como la web actual).
// Poner en true para mostrar etiqueta + título de cada slide (data/slides.php).
$hero_textos = false;

// Buscador: v1 = barra blanca · v2 = bloque negro con filete dorado arriba y título.
// Para comparar: ?buscador=v1 / ?buscador=v2
$buscador_version = "v2";
if (isset($_GET["buscador"]) && in_array($_GET["buscador"], ["v1", "v2"], true)) {
  $buscador_version = $_GET["buscador"];
}

// Contadores dentro del hero, arriba del buscador (y se quitan de "Somos GTG").
// Para comparar: ?contadores=hero / ?contadores=nosotros
$hero_contadores = true;
if (isset($_GET["contadores"])) {
  $hero_contadores = $_GET["contadores"] !== "nosotros";
}
$contadores = require ROOT . '/data/contadores.php';
?>
<section class="hero<?= $hero_textos ? '' : ' hero--logo' ?><?= $hero_contadores ? ' hero--contadores' : '' ?>" aria-label="<?= e(t('hero_label')) ?>">
  <div class="swiper hero-swiper">
    <div class="swiper-wrapper">
      <?php foreach ($slides as $i => $s): ?>
        <div class="swiper-slide">
          <picture class="hero-media">
            <source media="(max-width: 767.98px)" srcset="<?= e(img($s['imagen_mobile'])) ?>" <?= img_dims($s['imagen_mobile']) ?>>
            <img class="hero-img" src="<?= e(img($s['imagen'])) ?>" <?= img_dims($s['imagen']) ?> alt="<?= e(tr($s['alt'])) ?>"<?= $i === 0 ? ' fetchpriority="high"' : ' loading="lazy"' ?>>
          </picture>
          <div class="hero-overlay"></div>
          <?php if ($hero_textos): ?>
            <div class="hero-content container">
              <img class="hero-logo" src="<?= e(img('logo/logo-gtg-vertical-blanco-paises.png')) ?>" <?= img_dims('logo/logo-gtg-vertical-blanco-paises.png') ?> alt="" aria-hidden="true">
              <span class="eyebrow eyebrow--light"><?= e(tr($s['etiqueta'])) ?></span>
              <?php if ($i === 0): ?>
                <h1 class="hero-title"><?= e(tr($s['titulo'])) ?></h1>
              <?php else: ?>
                <h2 class="hero-title"><?= e(tr($s['titulo'])) ?></h2>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="hero-pagination"></div>
  </div>

  <?php if (!$hero_textos): ?>
    <!-- Logo central fijo (no se desvanece con cada slide) -->
    <div class="hero-brand">
      <h1 class="visually-hidden"><?= e(t('meta_title')) ?></h1>
      <img class="hero-brand-logo" src="<?= e(img('logo/logo-gtg-vertical-blanco-paises.png')) ?>" <?= img_dims('logo/logo-gtg-vertical-blanco-paises.png') ?> alt="<?= e(SITE_NAME) ?>" fetchpriority="high">
    </div>
  <?php endif; ?>

  <!-- Buscador (estilo DOT) -->
  <div class="hero-search-wrap hero-search-wrap--<?= $buscador_version ?>" id="reservar">
    <div class="container">
      <?php if ($hero_contadores): ?>
        <div class="hero-counters">
          <?php foreach ($contadores as $c): ?>
            <div class="hero-counter">
              <span class="hero-counter-value"><span class="js-counter" data-target="<?= (int) $c['valor'] ?>">0</span><?= e($c['sufijo']) ?></span>
              <span class="hero-counter-label"><?= e(tr($c['texto'])) ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
      <?php if ($buscador_version === "v2"): ?>
      <div class="hero-search-box">
        <p class="hero-search-title"><i class="ph-light ph-calendar-check" aria-hidden="true"></i><?= e(t("bus_titulo")) ?></p>
      <?php endif; ?>
<?php
      // URL del motor para cada opción: portal del Grupo ("Todos") o el motor del hotel (idHotel), en el idioma del sitio.
      // Hoteles sin motor ('motor' => null) usan el portal.
      $motor_portal = str_replace('{lang}', LANG, MOTOR_PORTAL);
      $motor_lang   = MOTOR_LANG_HOTEL[LANG];
      ?>
      <form class="hero-search" id="bookingForm" action="<?= e($motor_portal) ?>" method="get" target="_blank"
            data-sin-fecha="<?= e(t('bus_sin_fecha')) ?>"
            <?php if (!MOTOR): // sitio sin motor: la búsqueda se envía como mensaje de WhatsApp ?>
            data-wa="<?= e(wa_link()) ?>" data-wa-intro="<?= e(t('bus_wa_intro')) ?>"
            <?php endif; ?>
            novalidate>
        <div class="search-field search-field--hotel">
          <label for="bkHotel"><?= e(t('bus_hotel')) ?></label>
          <div class="search-control">
            <i class="ph-light ph-buildings" aria-hidden="true"></i>
            <select id="bkHotel" name="hotel">
              <option value="" data-motor="<?= e($motor_portal) ?>"><?= e(t('bus_todos')) ?></option>
              <?php foreach ($hero_hoteles as $h):
                $motor = !empty($h['motor'])
                  ? str_replace(['{host}', '{lang}', '{id}'], [$h['motor']['host'], $motor_lang, (int) $h['motor']['id']], MOTOR_HOTEL)
                  : $motor_portal; ?>
                <option value="<?= e($h['slug']) ?>" data-motor="<?= e($motor) ?>"><?= e($h['nombre']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="search-field">
          <label for="bkCheckin"><?= e(t('bus_checkin')) ?></label>
          <div class="search-control">
            <i class="ph-light ph-calendar-blank" aria-hidden="true"></i>
            <input type="text" id="bkCheckin" name="checkin" placeholder="<?= e(t('bus_fecha')) ?>" readonly autocomplete="off">
          </div>
        </div>

        <div class="search-field">
          <label for="bkCheckout"><?= e(t('bus_checkout')) ?></label>
          <div class="search-control">
            <i class="ph-light ph-calendar-blank" aria-hidden="true"></i>
            <input type="text" id="bkCheckout" name="checkout" placeholder="<?= e(t('bus_fecha')) ?>" readonly autocomplete="off">
          </div>
        </div>

        <div class="search-field search-field--sm">
          <label for="bkAdultos"><?= e(t('bus_adultos')) ?></label>
          <div class="search-control">
            <i class="ph-light ph-users" aria-hidden="true"></i>
            <select id="bkAdultos" name="adultos">
              <?php for ($n = 1; $n <= 6; $n++): ?>
                <option value="<?= $n ?>"<?= $n === 2 ? ' selected' : '' ?>><?= $n ?></option>
              <?php endfor; ?>
            </select>
          </div>
        </div>

        <div class="search-field search-field--sm">
          <label for="bkMenores"><?= e(t('bus_menores')) ?></label>
          <div class="search-control">
            <i class="ph-light ph-baby" aria-hidden="true"></i>
            <select id="bkMenores" name="menores">
              <?php for ($n = 0; $n <= 6; $n++): ?>
                <option value="<?= $n ?>"><?= $n ?></option>
              <?php endfor; ?>
            </select>
          </div>
        </div>

        <button type="submit" class="btn btn-gtg search-submit"><?= e(t('bus_reservar')) ?></button>
      </form>
      <?php if ($buscador_version === "v2"): ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>
