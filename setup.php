<?php
define('PLUGIN_EXTRAS_VERSION', '1.0.0');

function plugin_init_extras() {
    global $PLUGIN_HOOKS;
    
    $PLUGIN_HOOKS['csrf_compliant']['extras'] = true;
    
    // Hook para redefine_menus
    $PLUGIN_HOOKS['redefine_menus']['extras'] = 'plugin_extras_redefine_menus';
}

// Função que adiciona o menu principal
function plugin_extras_redefine_menus($menu) {
    // Array de IDs de perfis permitidos
    $allowed_profiles = [4, 24, 28, 30, 31, 33, 34, 35, 36, 37, 38, 39, 172, 176, 180];
    
    // Check if user has an allowed profile
    if (!isset($_SESSION['glpiactiveprofile']['id']) || 
        !in_array($_SESSION['glpiactiveprofile']['id'], $allowed_profiles)) {
        return $menu;
    }

    $menu['extras'] = [
        'title' => 'Extras',
        'icon'  => 'ti ti-brain',
        'types' => [],
        'content' => [
            'submenu1' => [
                'title' => 'Submenu1',
                'page'  => '/plugins/extras/front/menu1.php',
            ],
            'submenu2' => [
                'title' => 'Submenu2',
                'page'  => '/plugins/extras/front/menu2.php',
            ]
        ]
    ];
    return $menu;
}

function plugin_version_extras() {
    return [
        'name'           => 'Extras',
        'version'        => PLUGIN_EXTRAS_VERSION,
        'author'         => 'Adriano Marinho',
        'license'        => 'GPLv3+',
        'homepage'       => 'https://github.com/malakaygames',
        'requirements'   => [
            'glpi' => [
                'min' => '10.0.0',
                'max' => '12.0',
            ]
        ]
    ];
}


function plugin_extras_check_prerequisites() {
    // Detect GLPI version for GLPI 11+ (no GLPI_VERSION constant)
    $min_version = '10.0.0';
    $max_version = '12.0';
    $glpi_version = null;
    $glpi_root = '/var/www/glpi';
    $version_dir = $glpi_root . '/version';
    if (is_dir($version_dir)) {
        $files = scandir($version_dir, SCANDIR_SORT_DESCENDING);
        foreach ($files as $file) {
            if ($file[0] !== '.' && preg_match('/^\d+\.\d+\.\d+$/', $file)) {
                $glpi_version = $file;
                break;
            }
        }
    }
    // Fallback for older GLPI: try constant
    if ($glpi_version === null && defined('GLPI_VERSION')) {
        $glpi_version = GLPI_VERSION;
    }
    // Load Toolbox if not loaded
    if (!class_exists('Toolbox') && file_exists($glpi_root . '/src/Toolbox.php')) {
        require_once $glpi_root . '/src/Toolbox.php';
    }
    if ($glpi_version === null) {
        $msg = '[setup.php:plugin_extras_check_prerequisites] ERROR: GLPI version not detected.';
        if (class_exists('Toolbox') && method_exists('Toolbox', 'logInFile')) {
            Toolbox::logInFile('extras', $msg);
        } else {
            error_log('[extras] ' . $msg);
        }
        return false;
    }
    if (version_compare($glpi_version, $min_version, '<')) {
        $msg = sprintf(
            'ERROR [setup.php:plugin_extras_check_prerequisites] GLPI version %s is less than required minimum %s, user=%s',
            $glpi_version, $min_version, $_SESSION['glpiname'] ?? 'unknown'
        );
        if (class_exists('Toolbox') && method_exists('Toolbox', 'logInFile')) {
            Toolbox::logInFile('extras', $msg);
        } else {
            error_log('[extras] ' . $msg);
        }
        return false;
    }
    if (version_compare($glpi_version, $max_version, '>')) {
        $msg = sprintf(
            'ERROR [setup.php:plugin_extras_check_prerequisites] GLPI version %s is greater than supported maximum %s, user=%s',
            $glpi_version, $max_version, $_SESSION['glpiname'] ?? 'unknown'
        );
        if (class_exists('Toolbox') && method_exists('Toolbox', 'logInFile')) {
            Toolbox::logInFile('extras', $msg);
        } else {
            error_log('[extras] ' . $msg);
        }
        return false;
    }
    return true;
}

function plugin_extras_check_config() {
    return true;
}