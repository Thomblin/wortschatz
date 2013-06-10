<?php
namespace de\detert\sebastian\wortschatz\Tests;

use de\detert\sebastian\wortschatz\soap\Config;
use de\detert\sebastian\wortschatz\soap\RightNeighbours;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 13.01.13
 * @time 14:23
 * @license property of Sebastian Detert
 */
class RightNeighboursTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReturnFunctions()
    {
        $expected = array(
            'executeResponse execute(execute $parameters)',
            'pingResponse ping(ping $parameters)',
        );

        $client = $this->createRightNeighbours();
        $actual = $client->getFunctions();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return RightNeighbours
     */
    private function createRightNeighbours()
    {
        $config = new Config();

        return new RightNeighbours($config);
    }

    public function testShouldReturnPing()
    {
        $client = $this->createRightNeighbours();

        $expected = (object) array('pingReturn' => 'Webservice "RightNeighbours" is ready.');
        $actual = $client->ping();

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnEmptyResult()
    {
        $client = $this->createRightNeighbours();

        $expected = array();
        $actual = $client->getNeighbours('!!this is not a word!!', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnExecute()
    {
        $client = $this->createRightNeighbours();

        $expected = array(
            'erfaßt',
            'angefahren',
            'gezerrt', 
        );
        $actual = $client->getNeighbours('Auto', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }
}
