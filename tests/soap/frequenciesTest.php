<?php
namespace de\detert\sebastian\wortschatz\Tests;

use de\detert\sebastian\wortschatz\soap\Config;
use de\detert\sebastian\wortschatz\soap\Frequencies;
use de\detert\sebastian\wortschatz\word;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 13.01.13
 * @time 14:23
 * @license property of Sebastian Detert
 */
class FrequenciesTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReturnFunctions()
    {
        $expected = array(
            'executeResponse execute(execute $parameters)',
            'pingResponse ping(ping $parameters)',
        );

        $client = $this->createFrequencies();
        $actual = $client->getFunctions();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return Frequencies
     */
    private function createFrequencies()
    {
        $config = new Config();

        return new Frequencies($config);
    }

    public function testShouldReturnPing()
    {
        $client = $this->createFrequencies();

        $expected = (object) array('pingReturn' => 'Webservice "Frequencies" is ready.');
        $actual = $client->ping();

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnExecute()
    {
        $client = $this->createFrequencies();

        $expected = new word\Frequency(15151724, 0);
        $actual = $client->getFrequency('der');

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }
}
