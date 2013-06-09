<?php
namespace de\detert\sebastian\wortschatz\Tests;

use de\detert\sebastian\wortschatz\soap\Config;
use de\detert\sebastian\wortschatz\soap\CooccurrencesIntersect;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 13.01.13
 * @time 14:23
 * @license property of Sebastian Detert
 */
class CooccurrencesIntersectTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReturnFunctions()
    {
        $expected = array(
            'executeResponse execute(execute $parameters)',
            'pingResponse ping(ping $parameters)',
        );

        $client = $this->createCooccurrencesIntersect();
        $actual = $client->getFunctions();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return CooccurrencesIntersect
     */
    private function createCooccurrencesIntersect()
    {
        $config = new Config();

        return new CooccurrencesIntersect($config);
    }

    public function testShouldReturnPing()
    {
        $client = $this->createCooccurrencesIntersect();

        $expected = (object) array('pingReturn' => 'Webservice "Kookkurrenzschnitt" is ready.');
        $actual = $client->ping();

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnEmptyResult()
    {
        $this->markTestSkipped("authorization needed");

        $client = $this->createCooccurrencesIntersect();

        $expected = array();
        $actual = $client->getCooccurrences('!!this is not a word!!', '!!this is not a word!!', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnExecuteWithLowSignificance()
    {
        $this->markTestSkipped("authorization needed");

        $client = $this->createCooccurrencesIntersect();

        $expected = array(
        );
        $actual = $client->getCooccurrencesIntersect('Auto', 'Flugzeug', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnExecuteWithMidSignificance()
    {
        $this->markTestSkipped("authorization needed");

        $client = $this->createCooccurrencesIntersect();

        $expected = array(
        );
        $actual = $client->getCooccurrences('Auto', 'Flugzeug', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }
}
