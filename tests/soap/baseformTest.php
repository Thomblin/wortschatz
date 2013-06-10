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

    public function testShouldReturnVerbExecute()
    {
        $client = $this->createBaseform();

        $expected = new word\Baseform('Auto', 'N');
        $actual = $client->getBaseform('Autos');

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnAdverbExecute()
    {
        $client = $this->createBaseform();

        $expected = new word\Baseform('oft', 'A');
        $actual = $client->getBaseform('oft');

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnStopwordExecute()
    {
        $client = $this->createBaseform();

        $expected = new word\Baseform('auch', '-');
        $actual = $client->getBaseform('auch');

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnEinExecute()
    {
        $client = $this->createBaseform();

        $expected = new word\Baseform('ein', '-');
        $actual = $client->getBaseform('ein');

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnMoreExecuteResults()
    {
        $client = $this->createBaseform();

        $expected = array(
            new word\Baseform('ein', '-'),
            new word\Baseform('einen', '-'),
            new word\Baseform('ein', '-'),
            new word\Baseform('ein', 'S'),
            new word\Baseform('ein', 'S'),
            new word\Baseform('ein', 'S'),
            new word\Baseform('ein', 'S'),
        );
        $actual = $client->getBaseforms('ein');

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnEmptyExecuteResults()
    {
        $client = $this->createBaseform();

        $expected = array(
        );
        $actual = $client->getBaseforms('!!! not a word !!!');

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnOneExecuteResults()
    {
        $client = $this->createBaseform();

        $expected = array(
            new word\Baseform('auch', '-'),
        );
        $actual = $client->getBaseforms('auch');

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }
}
