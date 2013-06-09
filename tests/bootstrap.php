<?php
defined('DS') || define('DS', DIRECTORY_SEPARATOR);
defined('BASE_DIR') || define('BASE_DIR', realpath(__DIR__ . DS . '..') . DS );

require_once 'PHPUnit/Autoload.php';
require_once 'autoload.php';

new Autoload();