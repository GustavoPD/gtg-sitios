<?php
/**
 * <head> común. Variables opcionales antes de incluirlo:
 *   $page_title, $page_description, $page_preload (array de [href, media])
 */
$page_title       = isset($page_title) ? $page_title : t('meta_title');
$page_description = isset($page_description) ? $page_description : t('meta_description');
$page_preload     = isset($page_preload) ? $page_preload : [];
$page_slug        = isset($page_slug) ? $page_slug : '';
$page_og_image    = isset($page_og_image) ? $page_og_image : 'hero/hero-01.webp';
$page_url         = rtrim(SITE_URL, '/') . url($page_slug);
?>
<!doctype html>
<html lang="<?= e(LANG) ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($page_title) ?></title>
  <meta name="description" content="<?= e($page_description) ?>">
  <meta name="theme-color" content="#262828">
<?php if (BASE !== '/'): ?>
  <meta name="robots" content="noindex, nofollow"><!-- staging (/2026): no indexar -->
<?php endif; ?>
  <link rel="canonical" href="<?= e($page_url) ?>">
<?php foreach (LANGS as $l): ?>
  <link rel="alternate" hreflang="<?= e($l) ?>" href="<?= e(rtrim(SITE_URL, '/') . url($page_slug, $l)) ?>">
<?php endforeach; ?>
  <link rel="alternate" hreflang="x-default" href="<?= e(rtrim(SITE_URL, '/') . url($page_slug, LANG_DEFAULT)) ?>">

  <!-- Open Graph -->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="<?= e(SITE_NAME) ?>">
  <meta property="og:title" content="<?= e($page_title) ?>">
  <meta property="og:description" content="<?= e($page_description) ?>">
  <meta property="og:url" content="<?= e($page_url) ?>">
  <meta property="og:image" content="<?= e(rtrim(SITE_URL, '/') . img($page_og_image)) ?>">
  <meta property="og:locale" content="<?= e(locale_og()) ?>">

  <link rel="icon" type="image/png" href="<?= e(img('logo/favicon.png')) ?>">

<?php foreach ($page_preload as $p): ?>
  <link rel="preload" as="image" href="<?= e($p[0]) ?>"<?= !empty($p[1]) ? ' media="' . e($p[1]) . '"' : '' ?>>
<?php endforeach; ?>

  <!-- Google Fonts (única dependencia externa permitida) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">

  <!-- Vendor -->
  <link rel="stylesheet" href="<?= asset('vendor/bootstrap/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= asset('vendor/swiper/swiper-bundle.min.css') ?>">
  <link rel="stylesheet" href="<?= asset('vendor/aos/aos.css') ?>">
  <link rel="stylesheet" href="<?= asset('vendor/glightbox/glightbox.min.css') ?>">
  <link rel="stylesheet" href="<?= asset('vendor/flatpickr/flatpickr.min.css') ?>">
  <link rel="stylesheet" href="<?= asset('vendor/phosphor/light/style.css') ?>">

  <!-- Sitio -->
  <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
</head>
