<?php
namespace de\detert\sebastian\wortschatz\Tests;

use de\detert\sebastian\wortschatz\soap\Config;
use de\detert\sebastian\wortschatz\soap\Ngrams;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 13.01.13
 * @time 14:23
 * @license property of Sebastian Detert
 */
class NgramsTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReturnFunctions()
    {
        $expected = array(
            'executeResponse execute(execute $parameters)',
            'pingResponse ping(ping $parameters)',
        );

        $client = $this->createNgrams();
        $actual = $client->getFunctions();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return Ngrams
     */
    private function createNgrams()
    {
        $config = new Config();

        return new Ngrams($config);
    }

    public function testShouldReturnPing()
    {
        $client = $this->createNgrams();

        $expected = (object) array('pingReturn' => 'Webservice "NGrams" is ready.');
        $actual = $client->ping();

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnEmptyResult()
    {
        $client = $this->createNgrams();

        $expected = array();
        $actual = $client->getNgrams('!!this is not a word!!', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnExecute()
    {
        $client = $this->createNgrams();

        $expected = array(
            'aa O . ',
            'der Vereinigten Staaten von Amerika',
            'den Vereinigten Staaten von Amerika',
        );
        $actual = $client->getNgrams('%aa%', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }
}
