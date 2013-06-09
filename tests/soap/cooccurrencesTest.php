<?php
namespace de\detert\sebastian\wortschatz\Tests;

use de\detert\sebastian\wortschatz\soap\Config;
use de\detert\sebastian\wortschatz\soap\Cooccurrences;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 13.01.13
 * @time 14:23
 * @license property of Sebastian Detert
 */
class CooccurrencesTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReturnFunctions()
    {
        $expected = array(
            'executeResponse execute(execute $parameters)',
            'pingResponse ping(ping $parameters)',
        );

        $client = $this->createCooccurrences();
        $actual = $client->getFunctions();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return Cooccurrences
     */
    private function createCooccurrences()
    {
        $config = new Config();

        return new Cooccurrences($config);
    }

    public function testShouldReturnPing()
    {
        $client = $this->createCooccurrences();

        $expected = (object) array('pingReturn' => 'Webservice "Cooccurrences" is ready.');
        $actual = $client->ping();

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnEmptyResult()
    {
        $client = $this->createCooccurrences();

        $expected = array();
        $actual = $client->getCooccurrences('!!this is not a word!!', 0, 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnExecuteWithLowSignificance()
    {
        $client = $this->createCooccurrences();

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
        $client = $this->createCooccurrences();

        $expected = array(
            array('Auto', 'ein', 4183),
            array('Auto', 'das', 3015),
        );
        $actual = $client->getCooccurrences('Auto', 2500, 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }
}
