<?php
//***********************************************************************
// Grammar App - Configuration File
// Description: Main configuration settings for the Grammar App.
// Contains base paths, URLs, and environment settings.
//***********************************************************************

date_default_timezone_set('America/Guayaquil');

define('ROOT_PATH', dirname(__DIR__));
define('SRC_PATH', ROOT_PATH . '/src');
define('VIEW_PATH', SRC_PATH . '/views');
define('DATA_PATH', ROOT_PATH . '/data');
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('ASSETS_PATH', PUBLIC_PATH . '/assets');

define('BASE_URL', 'http://localhost/grammar-app/public/');
define('ASSETS_URL', BASE_URL . 'assets');

define('ENV', 'development');