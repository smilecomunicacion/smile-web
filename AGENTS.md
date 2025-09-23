# SMiLE Web Theme – Copilot Instructions

## 1. Alcance y validación
- Lee y comprende todas las especificaciones antes de generar código.
- Sigue estrictamente los estándares y directrices oficiales de WordPress.
- Revisa el código antes de entregarlo; debe compilarse/ejecutarse sin errores.

## 2. Estándares de codificación
- Cumple los WordPress Coding Standards (WPCS) en PHP, CSS y JS.
- Documenta funciones y clases con bloques `/** … */` que incluyan `@since`, `@param`, `@return` y `@package smile-web`.
- Comentarios en línea: termina siempre en `.` `!` o `?`.
- Prefijo obligatorio para código propio: `smile_v6_`.
- Usa condiciones Yoda solo con `==`, `!=`, `===`, `!==`; evita Yoda con comparadores `<`, `>`, `<=`, `>=`.
- Nunca uses jQuery; emplea JavaScript nativo.

## 3. Seguridad y sanitización
- Escapa siempre la salida con funciones de `esc_*`.
- Sanitiza cualquier entrada (`$_POST`, `$_GET`, `$_REQUEST`, parámetros REST) con funciones de WordPress antes de usarla.

## 4. Base de datos y caché
- No accedas directamente a la base de datos; usa APIs de WordPress.
- Para consultas personalizadas emplea `$wpdb->prepare()` con marcadores.
- Gestiona caché mediante `wp_cache_get()`, `wp_cache_set()`, `wp_cache_delete()` si procede.

## 5. JavaScript
- Usa vanilla JS (sin jQuery). Ajusta patrones a `DOMContentLoaded`, accesibilidad, etc.
- Respeta el linting/eslint configurado.

## 6. Estilos y build
- `style.css` y `style-rtl.css` son archivos finales; mantenlos sincronizados mediante `npm run compile:rtl`.
- Comandos disponibles:
  - `npm run watch`
  - `npm run compile:css`
  - `npm run compile:rtl`
  - `npm run lint:scss`
  - `npm run lint:js`
  - `npm run bundle`
- Cuando haya cambios de estilos, actualiza también la versión RTL si aplica.

## 7. Personalizador
- Ajustes nuevos se definen en `inc/customizer-options.php`.
- Estilos dinámicos: exporta las variables en `inc/customizer-dynamic-styles.php`.
- Mantén la distinción entre paneles de contenido y paneles de apariencia (p. ej. “SMiLE Web Settings” vs “Theme Appearance”).

## 8. Arquitectura del tema
- `functions.php` solo incluye archivos de `/inc/`. Añade lógica nueva en los módulos existentes o crea uno nuevo bajo `inc/` y requiérelo.
- Reutiliza `template-parts/` para componentes compartidos.
- Prefiere `get_template_part()` y `wp_enqueue_*()` nativos.

## 9. Buenas prácticas adicionales
- No elimines código sin justificarlo en la descripción del cambio.
- Si necesitas contexto adicional, solicítalo antes de escribir código.
- Respeta la estructura de carpetas y nombres existentes.
- Al modificar imágenes, SVG o assets, conserva versiones optimizadas.

## 10. Proceso de entrega
- No generes archivos sin cambios.
- Explica brevemente cualquier eliminación o refactor significativo.
- Tras los cambios, ejecuta los linters/compilaciones aplicables antes de entregar.

