<?php

/**
 * CodeIgniter 4 Front Controller Forwarder
 *
 * Forwards requests to the public/ directory.
 */

$minPhpVersion = '8.2';
if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo sprintf('Your PHP version must be %s or higher to run CodeIgniter. Current version: %s', $minPhpVersion, PHP_VERSION);
    exit(1);
}

require __DIR__ . '/public/index.php';
