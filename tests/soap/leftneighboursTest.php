<?php
namespace de\detert\sebastian\wortschatz\Tests;

use de\detert\sebastian\wortschatz\soap\Config;
use de\detert\sebastian\wortschatz\soap\LeftNeighbours;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 13.01.13
 * @time 14:23
 * @license property of Sebastian Detert
 */
class LeftNeighboursTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReturnFunctions()
    {
        $expected = array(
            'executeResponse execute(execute $parameters)',
            'pingResponse ping(ping $parameters)',
        );

        $client = $this->createLeftNeighbours();
        $actual = $client->getFunctions();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return LeftNeighbours
     */
    private function createLeftNeighbours()
    {
        $config = new Config();

        return new LeftNeighbours($config);
    }

    public function testShouldReturnPing()
    {
        $client = $this->createLeftNeighbours();

        $expected = (object) array('pingReturn' => 'Webservice "LeftNeighbours" is ready.');
        $actual = $client->ping();

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnEmptyResult()
    {
        $client = $this->createLeftNeighbours();

        $expected = array();
        $actual = $client->getNeighbours('!!this is not a word!!', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnExecute()
    {
        $client = $this->createLeftNeighbours();

        $expected = array(
            array('geparktes', 'Auto', 561),
            array('seinem', 'Auto', 534),
            array('fahrenden', 'Auto', 380),
        );
        $actual = $client->getNeighbours('Auto', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }
}
