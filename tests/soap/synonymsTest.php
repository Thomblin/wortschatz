<?php
namespace de\detert\sebastian\wortschatz\Tests;

use de\detert\sebastian\wortschatz\soap\Config;
use de\detert\sebastian\wortschatz\soap\Synonyms;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 13.01.13
 * @time 14:23
 * @license property of Sebastian Detert
 */
class SynonymsTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReturnFunctions()
    {
        $expected = array(
            'executeResponse execute(execute $parameters)',
            'pingResponse ping(ping $parameters)',
        );

        $client = $this->createSynonyms();
        $actual = $client->getFunctions();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return Synonyms
     */
    private function createSynonyms()
    {
        $config = new Config();

        return new Synonyms($config);
    }

    public function testShouldReturnPing()
    {
        $client = $this->createSynonyms();

        $expected = (object) array('pingReturn' => 'Webservice "Synonyms" is ready.');
        $actual = $client->ping();

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnEmptyResult()
    {
        $client = $this->createSynonyms();

        $expected = array();
        $actual = $client->getSynonyms('!!this is not a word!!', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnExecute()
    {
        $client = $this->createSynonyms();

        $expected = array(
            'Kraftwagen',
            'Automobil',
            'Benzinkutsche',
        );
        $actual = $client->getSynonyms('Auto', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnVerbExecute()
    {
        $client = $this->createSynonyms();

        $expected = array(
            'abnehmen',
            'hinfallen',
            'purzeln',
        );
        $actual = $client->getSynonyms('fallen', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnNameExecute()
    {
        $client = $this->createSynonyms();

        $expected = array(
            'dutzendfach',
            'dutzendmal',
            'etlichemal',
        );
        $actual = $client->getSynonyms('oft', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnColorExecute()
    {
        $client = $this->createSynonyms();

        $expected = array(
            'benebelt',
            'betrunken',
            'alkoholisiert',
        );
        $actual = $client->getSynonyms('blau', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnVerbAdjectiveExecute()
    {
        $client = $this->createSynonyms();

        $expected = array();
        $actual = $client->getSynonyms('ging', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }
}
