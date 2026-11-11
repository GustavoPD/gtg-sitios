# ==========================================================================
# Grupo Tierra Gaucha — www.{{HOST}}
# ARCHIVO GENERADO por build.php (plantilla: core/.htaccess.tpl). No editar en dist/:
# los cambios se hacen en la plantilla o en sitios/{{SITIO}}/sitio.php y se vuelve a correr el build.
#
# Idioma del sitio sin prefijo; los otros con /xx/ ({{PFX}}). Ej.: /sumate/ -> sumate.php · /{{PFX1}}/sumate/ -> sumate.php?lang={{PFX1}}
# Funciona igual en una subcarpeta (staging) y en la raíz: las reglas son relativas a esta carpeta.
# ==========================================================================

Options -MultiViews -Indexes
DirectoryIndex index.php

RewriteEngine On

# Ruta base de esta carpeta ("/2026/" o "/"), para las redirecciones
RewriteCond %{REQUEST_URI}::$1 ^(.*?/)(.*)::\2$
RewriteRule ^(.*)$ - [E=GTG_BASE:%1]

# HTTPS + www (no aplica en local)
RewriteCond %{HTTP_HOST} !^(localhost|127\.0\.0\.1) [NC]
RewriteCond %{HTTPS} off
RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
RewriteCond %{HTTP_HOST} ^{{HOST_RE}}$ [NC]
RewriteRule ^ https://www.{{HOST}}%{REQUEST_URI} [L,R=301]

# --- Redirecciones 301 de URLs viejas -------------------------------------
{{REDIRECCIONES}}

# Acceso directo a /pagina.php (solo pedidos del navegador, no rewrites internos) -> URL amigable
{{DIRECTO}}

# Sin barra final -> con barra (una sola URL por página)
RewriteRule ^((?:(?:{{PFX}})/)?(?:{{SLUGS}}))$ %{ENV:GTG_BASE}$1/ [L,R=301]
RewriteRule ^({{PFX}})$ %{ENV:GTG_BASE}$1/ [L,R=301]

# --- Páginas ---------------------------------------------------------------
RewriteRule ^({{PFX}})/$ index.php?lang=$1 [L,QSA]
{{PAGINAS}}

# --- 404 (cualquier otra ruta que no sea un archivo o carpeta real) -------
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(?:({{PFX}})/)?.*$ 404.php?lang=$1 [L,QSA]

# --- Cache y compresión de estáticos --------------------------------------
<IfModule mod_expires.c>
  ExpiresActive On
  ExpiresByType image/webp "access plus 1 year"
  ExpiresByType image/png "access plus 1 year"
  ExpiresByType image/jpeg "access plus 1 year"
  ExpiresByType text/css "access plus 1 year"
  ExpiresByType application/javascript "access plus 1 year"
  ExpiresByType font/woff2 "access plus 1 year"
</IfModule>
<IfModule mod_deflate.c>
  AddOutputFilterByType DEFLATE text/html text/css application/javascript image/svg+xml
</IfModule>

# Archivos internos: no se sirven directo
<FilesMatch "^(config\.php|sitio\.php)$">
  Require all denied
</FilesMatch>
RewriteRule ^(data|lang|content|includes|sections)/ - [F,L]
