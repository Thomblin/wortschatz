<?php
namespace de\detert\sebastian\wortschatz\Tests;

use de\detert\sebastian\wortschatz\soap\Config;
use de\detert\sebastian\wortschatz\soap\RightCollocation;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 13.01.13
 * @time 14:23
 * @license property of Sebastian Detert
 */
class RightCollocationTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReturnFunctions()
    {
        $expected = array(
            'executeResponse execute(execute $parameters)',
            'pingResponse ping(ping $parameters)',
        );

        $client = $this->createRightCollocation();
        $actual = $client->getFunctions();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return RightCollocation
     */
    private function createRightCollocation()
    {
        $config = new Config();

        return new RightCollocation($config);
    }

    public function testShouldReturnPing()
    {
        $client = $this->createRightCollocation();

        $expected = (object) array('pingReturn' => 'Webservice "RightCollocationFinder" is ready.');
        $actual = $client->ping();

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnEmptyResult()
    {
        $client = $this->createRightCollocation();

        $expected = array();
        $actual = $client->getCollocations('!!this is not a word!!', '?', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnAExecute()
    {
        $client = $this->createRightCollocation();

        $expected = array(
            'abgesetzt',
            'angebohrt',
        );
        $actual = $client->getCollocations('Auto', 'A', 2);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnNExecute()
    {
        $client = $this->createRightCollocation();

        $expected = array(
            'Armbanduhr',
            'Bild',
        );
        $actual = $client->getCollocations('Auto', 'N', 2);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnVExecute()
    {
        $client = $this->createRightCollocation();

        $expected = array(
            'abfackeln',
            'abholen',
        );
        $actual = $client->getCollocations('Auto', 'V', 2);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnSExecute()
    {
        $client = $this->createRightCollocation();

        $expected = array(
            'Daewoo Heavy Industries',
            'EISLINGEN',
        );
        $actual = $client->getCollocations('Auto', 'S', 2);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnXExecute()
    {
        $client = $this->createRightCollocation();

        $expected = array(

        );
        $actual = $client->getCollocations('Auto', 'X', 2);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }
}
