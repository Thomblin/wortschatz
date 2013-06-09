<?php
namespace de\detert\sebastian\wortschatz\Tests;

use de\detert\sebastian\wortschatz\soap\Config;
use de\detert\sebastian\wortschatz\soap\Thesaurus;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 13.01.13
 * @time 14:23
 * @license property of Sebastian Detert
 */
class ThesaurusTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReturnFunctions()
    {
        $expected = array(
            'executeResponse execute(execute $parameters)',
            'pingResponse ping(ping $parameters)',
        );

        $client = $this->createThesaurus();
        $actual = $client->getFunctions();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return Thesaurus
     */
    private function createThesaurus()
    {
        $config = new Config();

        return new Thesaurus($config);
    }

    public function testShouldReturnPing()
    {
        $client = $this->createThesaurus();

        $expected = (object) array('pingReturn' => 'Webservice "Thesaurus" is ready.');
        $actual = $client->ping();

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnEmptyResult()
    {
        $client = $this->createThesaurus();

        $expected = array();
        $actual = $client->getThesaurus('!!this is not a word!!', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnExecute()
    {
        $client = $this->createThesaurus();

        $expected = array(
            'Auto',
            'Bahn',
            'Wagen',
        );
        $actual = $client->getThesaurus('Auto', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnVerbExecute()
    {
        $client = $this->createThesaurus();

        $expected = array(
            'fallen',
            'sterben',
            'senken',
        );
        $actual = $client->getThesaurus('fallen', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnNameExecute()
    {
        $client = $this->createThesaurus();

        $expected = array(
            'nicht',
            'noch',
            'schon',
        );
        $actual = $client->getThesaurus('oft', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnVerbAdjectiveExecute()
    {
        $client = $this->createThesaurus();

        $expected = array(
            'gehen',
            'fahren',
            'laufen'
        );
        $actual = $client->getThesaurus('ging', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }
}
