<?php
namespace de\detert\sebastian\wortschatz\Tests;

use de\detert\sebastian\wortschatz\soap\Config;
use de\detert\sebastian\wortschatz\soap\Baseform;
use de\detert\sebastian\wortschatz\word;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 13.01.13
 * @time 14:23
 * @license property of Sebastian Detert
 */
class BaseformTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReturnFunctions()
    {
        $expected = array(
            'executeResponse execute(execute $parameters)',
            'pingResponse ping(ping $parameters)',
        );

        $client = $this->createBaseform();
        $actual = $client->getFunctions();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return Baseform
     */
    private function createBaseform()
    {
        $config = new Config();

        return new Baseform($config);
    }

    public function testShouldReturnPing()
    {
        $client = $this->createBaseform();

        $expected = (object) array('pingReturn' => 'Webservice "Baseform" is ready.');
        $actual = $client->ping();

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnExecute()
    {
        $client = $this->createBaseform();

        $expected = new word\Baseform('laufen', 'V');
        $actual = $client->getBaseform('lief');

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }
}
