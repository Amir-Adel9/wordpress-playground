<?php

/**
 * Playground main – Minimal Vite Integration
 */

/**
 * Enqueue scripts and styles based on environment.
 */
function playground_enqueue_assets()
{
    $is_dev = wp_get_environment_type() === 'development';

    if ($is_dev) {
        playground_register_dev_scripts();
        wp_enqueue_script('vite-client');
        wp_enqueue_script('main-js');
    } else {
        $assets = playground_get_assets_from_manifest('index.html');

        if ($assets) {
            $theme_uri = get_template_directory_uri() . '/dist/';

            if ($assets['css']) {
                foreach ($assets['css'] as $css_file) {
                    wp_enqueue_style('main-css-' . md5($css_file), $theme_uri . $css_file);
                }
            }

            if ($assets['js']) {
                wp_enqueue_script('main-js', $theme_uri . $assets['js'], [], null, true);
            }
        }
    }

    // ✅ Always enqueue external packages
    playground_enqueue_packages();
}
add_action('wp_enqueue_scripts', 'playground_enqueue_assets');

/**
 * Register Vite development scripts.
 */
function playground_register_dev_scripts()
{
    wp_register_script('vite-client', 'http://localhost:5173/@vite/client', [], null, true);
    wp_register_script('main-js', 'http://localhost:5173/js/main.js', [], null, true);
}

/**
 * Parse Vite manifest for production asset paths.
 */
function playground_get_assets_from_manifest($asset_name)
{
    static $manifest = null;

    if ($manifest === null) {
        $manifest_path = get_template_directory() . '/dist/.vite/manifest.json';
        if (! file_exists($manifest_path)) {
            return null;
        }
        $manifest = json_decode(file_get_contents($manifest_path), true);
    }

    if (! isset($manifest[$asset_name])) {
        return null;
    }

    $entry     = $manifest[$asset_name];
    $js_file   = $entry['file'] ?? null;
    $css_files = $entry['css'] ?? [];

    return [
        'js'  => $js_file,
        'css' => $css_files,
    ];
}

/**
 * Add `type="module"` to certain script tags.
 */
function playground_add_module_type($tag, $handle)
{
    $modules = ['vite-client', 'main-js'];

    if (in_array($handle, $modules, true)) {
        return str_replace('<script ', '<script type="module" ', $tag);
    }

    return $tag;
}
add_filter('script_loader_tag', 'playground_add_module_type', 10, 2);

/**
 * ✅ Enqueue external JS packages from CDNs
 */
function playground_enqueue_packages()
{
    // GSAP
    wp_enqueue_script(
        'gsap',
        'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js',
        [],
        null,
        true
    );
    // GSAP SplitText
    wp_enqueue_script(
        'gsap-splittext',
        'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/SplitText.min.js',
        [],
        null,
        true
    );
    wp_enqueue_script(
        'gsap-scroll-trigger',
        'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/ScrollTrigger.min.js',
        [],
        null,
        true
    );
}
