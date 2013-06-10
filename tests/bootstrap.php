<?php
use de\detert\sebastian\wortschatz\Autoload;

defined('DS') || define('DS', DIRECTORY_SEPARATOR);
defined('BASE_DIR') || define('BASE_DIR', realpath(__DIR__ . DS . '..') . DS );

require_once 'PHPUnit/Autoload.php';
require_once BASE_DIR . 'autoload.php';

new Autoload();