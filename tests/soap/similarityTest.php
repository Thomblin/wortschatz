<?php
namespace de\detert\sebastian\wortschatz\Tests;

use de\detert\sebastian\wortschatz\soap\Config;
use de\detert\sebastian\wortschatz\soap\Similarity;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 13.01.13
 * @time 14:23
 * @license property of Sebastian Detert
 */
class SimilarityTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReturnFunctions()
    {
        $expected = array(
            'executeResponse execute(execute $parameters)',
            'pingResponse ping(ping $parameters)',
        );

        $client = $this->createSimilarity();
        $actual = $client->getFunctions();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return Similarity
     */
    private function createSimilarity()
    {
        $config = new Config();

        return new Similarity($config);
    }

    public function testShouldReturnPing()
    {
        $client = $this->createSimilarity();

        $expected = (object) array('pingReturn' => 'Webservice "Similarity" is ready.');
        $actual = $client->ping();

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnEmptyResult()
    {
        $client = $this->createSimilarity();

        $expected = array();
        $actual = $client->getSimilarities('!!this is not a word!!', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnExecute()
    {
        $client = $this->createSimilarity();

        $expected = array(
            'Wagen',
            'Fahrzeug',
            'Kleinbus',
        );
        $actual = $client->getSimilarities('Auto', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }
}
