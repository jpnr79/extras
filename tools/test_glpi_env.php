<?php
// This script attempts to locate and print the GLPI root directory and version.

// Try to locate GLPI root by traversing up and looking for version.php or config_db.php
function find_glpi_root($start_dir) {
    $dir = $start_dir;
    while ($dir !== '/' && $dir !== '' && $dir !== '.') {
        if (file_exists($dir . '/inc/includes.php') && file_exists($dir . '/version.php')) {
            return $dir;
        }
        $parent = dirname($dir);
        if ($parent === $dir) break;
        $dir = $parent;
    }
    return false;
}
$glpi_root = find_glpi_root(__DIR__);
if ($glpi_root) {
    require_once $glpi_root . '/inc/includes.php';
    echo "GLPI_VERSION: ".(defined('GLPI_VERSION') ? GLPI_VERSION : 'not defined')."\n";
    echo "Toolbox class: ".(class_exists('Toolbox') ? 'loaded' : 'not loaded')."\n";
    echo "GLPI_ROOT: $glpi_root\n";
} else {
    echo "GLPI root not found.\n";
}
