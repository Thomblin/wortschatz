<?php
namespace de\detert\sebastian\wortschatz\Tests;

use de\detert\sebastian\wortschatz\soap\Config;
use de\detert\sebastian\wortschatz\soap\ExperimentalSynonyms;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 13.01.13
 * @time 14:23
 * @license property of Sebastian Detert
 */
class ExperimentalSynonymsTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReturnFunctions()
    {
        $expected = array(
            'executeResponse execute(execute $parameters)',
            'pingResponse ping(ping $parameters)',
        );

        $client = $this->createExperimentalSynonyms();
        $actual = $client->getFunctions();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return ExperimentalSynonyms
     */
    private function createExperimentalSynonyms()
    {
        $config = new Config();

        return new ExperimentalSynonyms($config);
    }

    public function testShouldReturnPing()
    {
        $client = $this->createExperimentalSynonyms();

        $expected = (object) array('pingReturn' => 'Webservice "ExperimentalSynonyms" is ready.');
        $actual = $client->ping();

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnEmptyResult()
    {
        $client = $this->createExperimentalSynonyms();

        $expected = array();
        $actual = $client->getExperimentalSynonyms('!!this is not a word!!', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnExecute()
    {
        $client = $this->createExperimentalSynonyms();

        $expected = array(
            'Fahrzeug',
            'Bus',
            'Cab',
        );
        $actual = $client->getExperimentalSynonyms('Auto', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnVerbExecute()
    {
        $client = $this->createExperimentalSynonyms();

        $expected = array(
            'eilen',
            'jagen',
            'rasen',
        );
        $actual = $client->getExperimentalSynonyms('laufen', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }
}
