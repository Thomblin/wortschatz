<?php
namespace de\detert\sebastian\wortschatz\Tests;

use de\detert\sebastian\wortschatz\soap\Config;
use de\detert\sebastian\wortschatz\soap\Mars;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 13.01.13
 * @time 14:23
 * @license property of Sebastian Detert
 */
class MarsTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReturnFunctions()
    {
        $expected = array(
            'executeResponse execute(execute $parameters)',
            'pingResponse ping(ping $parameters)',
        );

        $client = $this->createMars();
        $actual = $client->getFunctions();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return Mars
     */
    private function createMars()
    {
        $config = new Config();

        return new Mars($config);
    }

    public function testShouldReturnPing()
    {
        $client = $this->createMars();

        $expected = (object) array('pingReturn' => 'Webservice "MARSService" is ready.');
        $actual = $client->ping();

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnEmptyResult()
    {
        $this->markTestSkipped("authorization needed");

        $client = $this->createMars();

        $expected = array();
        $actual = $client->getMars('!!this is not a word!!', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnExecute()
    {
        $this->markTestSkipped("authorization needed");

        $client = $this->createMars();

        $expected = array(
        );
        $actual = $client->getMars('Auto', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }
}
