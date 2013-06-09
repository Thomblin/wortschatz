<?php
/**
 * @author sebastian.detert <github@elygor.de>
 * @date 09.06.13
 * @time 16:47
 * @license property of Sebastian Detert
 */
class Autoload
{

    public function __construct()
    {
        spl_autoload_register(array($this, 'simpleAutoload'));
    }
    /**
     * @param string $className
     */
    private function simpleAutoload($className)
    {
        $className = strtolower($className);

        $namespace = 'de\detert\sebastian\wortschatz';
        $docroot   = realpath(__DIR__);

        $path = $className;
        if ($namespace === substr($path, 0, strlen($namespace))) {
            $path = substr($path, strlen($namespace) + 1);
        }
        $path = $docroot . DIRECTORY_SEPARATOR . str_replace(array('\\', '_'), DIRECTORY_SEPARATOR, $path) . '.php';

        if (file_exists($path)) {
            include_once $path;
        }
    }
}