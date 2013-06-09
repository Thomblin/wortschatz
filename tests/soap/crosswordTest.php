<?php
namespace de\detert\sebastian\wortschatz\Tests;

use de\detert\sebastian\wortschatz\soap\Config;
use de\detert\sebastian\wortschatz\soap\Crossword;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 13.01.13
 * @time 14:23
 * @license property of Sebastian Detert
 */
class CrosswordTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReturnFunctions()
    {
        $expected = array(
            'executeResponse execute(execute $parameters)',
            'pingResponse ping(ping $parameters)',
        );

        $client = $this->createCrossword();
        $actual = $client->getFunctions();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return Crossword
     */
    private function createCrossword()
    {
        $config = new Config();

        return new Crossword($config);
    }

    public function testShouldReturnPing()
    {
        $client = $this->createCrossword();

        $expected = (object) array('pingReturn' => 'Webservice "Kreuzwortraetsel" is ready.');
        $actual = $client->ping();

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnEmptyResult()
    {
        $client = $this->createCrossword();

        $expected = array();
        $actual = $client->getCrosswords('!!this is not a word!!', 0, 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnExecuteWithLowSignificance()
    {
        $client = $this->createCrossword();

        $expected = array(
            'abio',
            'aboo',
            'abso',
        );
        $actual = $client->getCrosswords('a%o', 4, 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }
}
