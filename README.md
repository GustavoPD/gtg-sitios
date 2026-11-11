# Grupo Tierra Gaucha — sitios web

Un solo código para los 4 sitios del Grupo:

| Sitio | Carpeta | Idioma del sitio | Otros idiomas |
|---|---|---|---|
| www.grupotierragaucha.com.ar | `sitios/ar` | es | /en/ /pt/ |
| www.grupotierragaucha.com | `sitios/com` | es | /en/ /pt/ |
| www.grupotierragaucha.com.br | `sitios/br` | pt | /es/ /en/ |
| www.grupotierragaucha.cl | `sitios/cl` | es | /en/ /pt/ |

## Cómo está armado

```
core/            Lo común a todos: diseño, secciones, páginas, textos (lang/), hoteles, agencias...
sitios/xx/       Solo lo propio de cada sitio:
  sitio.php        dominio, idiomas, WhatsApp, menú, secciones de la home, páginas que tiene
  data/            slides del hero, promociones, destacados...
  assets/img/      imágenes propias
build.php        Junta core + sitios/xx en dist/xx
dist/xx/         RESULTADO: lo que se sube a cada hosting (no se edita, se regenera)
```

Si un archivo existe en `sitios/xx/` y también en `core/`, gana el del sitio.

## Trabajo diario

1. Editar en `core/` (afecta a los 4) o en `sitios/xx/` (solo a ese).
2. Correr el build: doble clic en `build.bat` (o `php build.php`, o `php build.php cl` para uno solo).
3. Probar en local: `http://localhost/gtgs/dist/ar/`, `.../dist/com/`, `.../dist/br/`, `.../dist/cl/`.
4. Subir: en VS Code, clic derecho sobre `dist/xx` → **SFTP: Sync Local → Remote**
   (o sobre un archivo puntual → **Upload**). `.vscode/sftp.json` tiene un perfil por carpeta
   con el usuario FTP de cada dominio. Ese archivo tiene contraseñas: **no se sube a git**.
5. Guardar los cambios en git (commit + push).

El build conserva las fechas de los archivos, así el Sync sube solo lo que cambió.

## Qué cambia entre sitios (sitio.php)

- **menu**: ítems del navbar (`hoteles` = desplegable, `pagina`, `ancla`, `url` externa).
- **paginas**: páginas internas que tiene el sitio. Las que no tiene (ej. Hotel Management en .cl/.br/.com)
  llevan a la del .com.ar en el mismo idioma, y sus URLs viejas redirigen ahí.
- **home**: secciones de la home en orden (archivos de `core/sections/home/`).
- **motor**: `true` = buscador conectado al motor de reservas; `false` = "Reservar" y el buscador van a WhatsApp.
- **agencias**, **destinos**: qué banners de agencias y qué destinos muestra.
- **textos**: textos que cambian solo en ese sitio (pisan a los de `core/lang/`).

## Notas

- `.htaccess` se genera en el build desde `core/.htaccess.tpl` (URLs amigables, idiomas,
  redirecciones 301 de las URLs viejas de cada sitio). No editarlo en `dist/`.
- El PDF del brochure de Hotel Management (68 MB) está solo en `sitios/ar/assets/docs/` local y en el server del .com.ar (no en git).
- PHP 7.4 (sin sintaxis de PHP 8). Ver `docs/PROYECTO.md` y `docs/PRODUCCION.md`.
