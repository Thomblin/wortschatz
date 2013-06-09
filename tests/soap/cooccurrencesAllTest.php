<?php
namespace de\detert\sebastian\wortschatz\Tests;

use de\detert\sebastian\wortschatz\soap\Config;
use de\detert\sebastian\wortschatz\soap\CooccurrencesAll;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 13.01.13
 * @time 14:23
 * @license property of Sebastian Detert
 */
class CooccurrencesAllTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReturnFunctions()
    {
        $expected = array(
            'executeResponse execute(execute $parameters)',
            'pingResponse ping(ping $parameters)',
        );

        $client = $this->createCooccurrencesAll();
        $actual = $client->getFunctions();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return CooccurrencesAll
     */
    private function createCooccurrencesAll()
    {
        $config = new Config();

        return new CooccurrencesAll($config);
    }

    public function testShouldReturnPing()
    {
        $client = $this->createCooccurrencesAll();

        $expected = (object) array('pingReturn' => 'Webservice "CooccurrencesAll" is ready.');
        $actual = $client->ping();

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnEmptyResult()
    {
        $this->markTestSkipped("authorization needed");

        $client = $this->createCooccurrencesAll();

        $expected = array();
        $actual = $client->getCooccurrences('!!this is not a word!!', 0, 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnExecuteWithLowSignificance()
    {
        $this->markTestSkipped("authorization needed");

        $client = $this->createCooccurrencesAll();

        $expected = array(
            array('Auto', 'ein', 4183),
            array('Auto', 'das', 3015),
            array('Auto', 'einem', 2466),
        );
        $actual = $client->getCooccurrences('Auto', 1, 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnExecuteWithMidSignificance()
    {
        $this->markTestSkipped("authorization needed");

        $client = $this->createCooccurrencesAll();

        $expected = array(
            array('Auto', 'ein', 4183),
            array('Auto', 'das', 3015),
        );
        $actual = $client->getCooccurrences('Auto', 2500, 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }
}
