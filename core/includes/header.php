<?php
/**
 * Header / navbar.
 * Transparente sobre el hero (logo blanco); al hacer scroll -> fondo blanco + logo normal.
 * En páginas sin hero, setear $header_solid = true antes de incluirlo.
 * $page_slug (slug de la página actual, '' = home) se usa para el selector de idioma y el ítem activo.
 */
$header_solid = !empty($header_solid);
$page_slug    = isset($page_slug) ? $page_slug : '';

// Hoteles para el desplegable, ordenados alfabéticamente
$menu_hoteles = require ROOT . '/data/hoteles.php';
usort($menu_hoteles, function ($a, $b) { return strcasecmp($a['nombre'], $b['nombre']); });

// Ítems del navbar de este sitio (sitio.php > 'menu')
$menu = [];
foreach (sitio('menu') as $it) {
  $item = ['label' => t($it['texto'])];
  if (!empty($it['hoteles'])) {
    $item += ['url' => url('', null, '#hoteles'), 'hoteles' => true];
  } elseif (!empty($it['pagina'])) {
    $item += ['url' => url($it['pagina']), 'slug' => $it['pagina']];
  } elseif (!empty($it['ancla'])) {
    $item['url'] = !empty($it['pie']) ? $it['ancla'] : url('', null, $it['ancla']);   // 'pie': ancla presente en todas las páginas (footer)
  } else {
    $item['url'] = tr($it['url']);
  }
  $item['externa'] = es_externa($item['url']);   // otro dominio (ej. Hotel Management del .com.ar) -> otra pestaña
  $menu[] = $item;
}

// Botón "Reservar": buscador de la home (con motor) o WhatsApp (sin motor)
$reservar_attr = MOTOR ? ' data-reservar=""' : ' target="_blank" rel="noopener"';

// Selector de idioma: la misma página en cada idioma
$idiomas = [];
foreach (LANGS as $code) {
  $idiomas[] = ['code' => strtoupper($code), 'lang' => $code, 'url' => url($page_slug, $code), 'active' => $code === LANG];
}

$topbar_social = [
  'facebook'  => 'ph-facebook-logo',
  'instagram' => 'ph-instagram-logo',
  'linkedin'  => 'ph-linkedin-logo',
  'tiktok'    => 'ph-tiktok-logo',
];
?>
<!-- Banda superior: contacto + redes (desktop/tablet) -->
<div class="topbar d-none d-md-flex" id="topbar">
  <div class="container-fluid header-inner topbar-inner">
    <ul class="topbar-contact">
      <li>
        <a href="<?= e(wa_link(t('whatsapp_texto'))) ?>" target="_blank" rel="noopener"><i class="ph-light ph-whatsapp-logo" aria-hidden="true"></i><?= e(TELEFONO_TXT) ?></a>
      </li>
      <li class="d-none d-lg-block">
        <a href="mailto:<?= e(EMAIL) ?>"><i class="ph-light ph-envelope-simple" aria-hidden="true"></i><?= e(EMAIL) ?></a>
      </li>
    </ul>
    <ul class="topbar-social">
      <?php foreach (SOCIAL as $red => $url): ?>
        <li>
          <a href="<?= e($url) ?>" target="_blank" rel="noopener" aria-label="<?= e(ucfirst($red)) ?>">
            <i class="ph-light <?= e(isset($topbar_social[$red]) ? $topbar_social[$red] : 'ph-link') ?>" aria-hidden="true"></i>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<header class="site-header<?= $header_solid ? ' is-solid' : '' ?>" id="siteHeader">
  <nav class="navbar navbar-expand-xl" aria-label="<?= e(t('nav_principal')) ?>">
    <div class="container-fluid header-inner">

      <a class="navbar-brand" href="<?= e(url()) ?>" aria-label="<?= e(SITE_NAME) ?> — <?= e(t('nav_inicio')) ?>">
        <img class="logo logo--white" src="<?= e(img('logo/logo-gtg-blanco.png')) ?>" <?= img_dims('logo/logo-gtg-blanco.png') ?> alt="<?= e(SITE_NAME) ?>">
        <img class="logo logo--dark" src="<?= e(img('logo/logo-gtg.png')) ?>" <?= img_dims('logo/logo-gtg.png') ?> alt="" aria-hidden="true">
      </a>

      <!-- Desktop -->
      <ul class="navbar-nav main-nav d-none d-xl-flex">
        <?php foreach ($menu as $item):
          $activo = !empty($item['slug']) && $item['slug'] === $page_slug; ?>
          <?php if (!empty($item['hoteles'])): ?>
            <li class="nav-item dropdown nav-dropdown">
              <a class="nav-link dropdown-toggle" href="<?= e($item['url']) ?>" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false"><?= e($item['label']) ?><i class="ph-light ph-caret-down caret" aria-hidden="true"></i></a>
              <ul class="dropdown-menu nav-dropdown-menu">
                <?php foreach ($menu_hoteles as $h): ?>
                  <li><a class="dropdown-item" href="<?= e($h['url']) ?>" target="_blank" rel="noopener"><?= e($h['nombre']) ?><span><?= e(tr($h['ubicacion'])) ?></span></a></li>
                <?php endforeach; ?>
              </ul>
            </li>
          <?php else: ?>
            <li class="nav-item"><a class="nav-link<?= $activo ? ' active' : '' ?>" href="<?= e($item['url']) ?>"<?= $activo ? ' aria-current="page"' : '' ?><?= $item['externa'] ? ' target="_blank" rel="noopener"' : '' ?>><?= e($item['label']) ?></a></li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>

      <div class="header-actions">
        <ul class="lang-switch d-none d-md-flex" aria-label="<?= e(t('nav_idioma')) ?>">
          <?php foreach ($idiomas as $l): ?>
            <li><a href="<?= e($l['url']) ?>" hreflang="<?= e($l['lang']) ?>" lang="<?= e($l['lang']) ?>"<?= $l['active'] ? ' class="active" aria-current="true"' : '' ?>><?= e($l['code']) ?></a></li>
          <?php endforeach; ?>
        </ul>

        <a href="<?= e(reservar_url()) ?>" class="btn btn-gtg header-reservar d-none d-sm-inline-flex"<?= $reservar_attr ?>><?= e(t('nav_reservar')) ?></a>

        <button class="menu-toggle d-xl-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu" aria-label="<?= e(t('nav_menu')) ?>">
          <i class="ph-light ph-list" aria-hidden="true"></i>
        </button>
      </div>

    </div>
  </nav>
</header>

<!-- Mobile: offcanvas -->
<div class="offcanvas offcanvas-end offcanvas-gtg" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
  <div class="offcanvas-header">
    <img src="<?= e(img('logo/logo-gtg.png')) ?>" <?= img_dims('logo/logo-gtg.png') ?> alt="<?= e(SITE_NAME) ?>" class="offcanvas-logo" id="offcanvasMenuLabel">
    <button type="button" class="menu-close" data-bs-dismiss="offcanvas" aria-label="<?= e(t('nav_cerrar')) ?>">
      <i class="ph-light ph-x" aria-hidden="true"></i>
    </button>
  </div>
  <div class="offcanvas-body">
    <ul class="offcanvas-nav">
      <?php foreach ($menu as $item): ?>
        <?php if (!empty($item['hoteles'])): ?>
          <li>
            <button type="button" class="offcanvas-sub-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#offcanvasHoteles" aria-expanded="false" aria-controls="offcanvasHoteles"><?= e($item['label']) ?><i class="ph-light ph-caret-down" aria-hidden="true"></i></button>
            <ul class="collapse offcanvas-sub" id="offcanvasHoteles">
              <?php foreach ($menu_hoteles as $h): ?>
                <li><a href="<?= e($h['url']) ?>" target="_blank" rel="noopener"><?= e($h['nombre']) ?></a></li>
              <?php endforeach; ?>
            </ul>
          </li>
        <?php else: ?>
          <li><a href="<?= e($item['url']) ?>"<?= $item['externa'] ? ' target="_blank" rel="noopener"' : ' data-close-offcanvas' ?>><?= e($item['label']) ?></a></li>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>

    <a href="<?= e(reservar_url()) ?>" class="btn btn-gtg w-100 mt-4"<?= $reservar_attr ?> data-close-offcanvas><?= e(t('nav_reservar')) ?></a>

    <ul class="lang-switch lang-switch--dark mt-4">
      <?php foreach ($idiomas as $l): ?>
        <li><a href="<?= e($l['url']) ?>" hreflang="<?= e($l['lang']) ?>" lang="<?= e($l['lang']) ?>"<?= $l['active'] ? ' class="active" aria-current="true"' : '' ?>><?= e($l['code']) ?></a></li>
      <?php endforeach; ?>
    </ul>

    <div class="offcanvas-contact">
      <a href="<?= e(wa_link(t('whatsapp_texto'))) ?>" target="_blank" rel="noopener"><i class="ph-light ph-whatsapp-logo" aria-hidden="true"></i> <?= e(TELEFONO_TXT) ?></a>
      <a href="mailto:<?= e(EMAIL) ?>"><i class="ph-light ph-envelope-simple" aria-hidden="true"></i> <?= e(EMAIL) ?></a>
    </div>
  </div>
</div>
