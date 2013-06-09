<?php
namespace de\detert\sebastian\wortschatz\Tests;

use de\detert\sebastian\wortschatz\soap\Config;
use de\detert\sebastian\wortschatz\soap\LeftCollocation;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 13.01.13
 * @time 14:23
 * @license property of Sebastian Detert
 */
class LeftCollocationTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReturnFunctions()
    {
        $expected = array(
            'executeResponse execute(execute $parameters)',
            'pingResponse ping(ping $parameters)',
        );

        $client = $this->createLeftCollocation();
        $actual = $client->getFunctions();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return LeftCollocation
     */
    private function createLeftCollocation()
    {
        $config = new Config();

        return new LeftCollocation($config);
    }

    public function testShouldReturnPing()
    {
        $client = $this->createLeftCollocation();

        $expected = (object) array('pingReturn' => 'Webservice "LeftCollocationFinder" is ready.');
        $actual = $client->ping();

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnEmptyResult()
    {
        $client = $this->createLeftCollocation();

        $expected = array();
        $actual = $client->getCollocations('!!this is not a word!!', '?', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnAExecute()
    {
        $client = $this->createLeftCollocation();

        $expected = array(
            array('abbiegend', 'A', 'Auto'),
            array('abfahrend', 'A', 'Auto'),
        );
        $actual = $client->getCollocations('Auto', 'A', 2);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnNExecute()
    {
        $client = $this->createLeftCollocation();

        $expected = array(
            array('Aharoni', 'N', 'Auto'),
            array('Anto', 'N', 'Auto'),
        );
        $actual = $client->getCollocations('Auto', 'N', 2);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnVExecute()
    {
        $client = $this->createLeftCollocation();

        $expected = array(
            array('abgasfreien', 'V', 'Auto'),
            array('alkoholisieren', 'V', 'Auto'),
        );
        $actual = $client->getCollocations('Auto', 'V', 2);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnSExecute()
    {
        $client = $this->createLeftCollocation();

        $expected = array(
            array('Mastermix', 'S', 'Auto'),
            array('kontra', 'S', 'Auto'),
        );
        $actual = $client->getCollocations('Auto', 'S', 2);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnXExecute()
    {
        $client = $this->createLeftCollocation();

        $expected = array(

        );
        $actual = $client->getCollocations('Auto', 'X', 2);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }
}
