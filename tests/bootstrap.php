<?php
declare(strict_types=1);

// Minimal test bootstrap for F-RevoCRM
// Avoid touching application code; prepare autoload and globals.

// Project root used by some includes/constants
global $root_directory;
$root_directory = realpath(__DIR__ . '/..') . DIRECTORY_SEPARATOR;

// Load project loader (which in turn loads Composer autoload)
require_once $root_directory . 'includes/Loader.php';
require_once $root_directory . 'includes/runtime/Configs.php';

// Lightweight stubs for legacy global functions invoked during autoload
if (!function_exists('checkFileAccessForInclusion')) {
    function checkFileAccessForInclusion($filepath) { return true; }
}

// Tame error reporting for legacy notices during unit tests
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
ini_set('display_errors', '1');
