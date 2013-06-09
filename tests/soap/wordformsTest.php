<?php
namespace de\detert\sebastian\wortschatz\Tests;

use de\detert\sebastian\wortschatz\soap\Config;
use de\detert\sebastian\wortschatz\soap\Wordforms;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 13.01.13
 * @time 14:23
 * @license property of Sebastian Detert
 */
class WordformsTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReturnFunctions()
    {
        $expected = array(
            'executeResponse execute(execute $parameters)',
            'pingResponse ping(ping $parameters)',
        );

        $client = $this->createWordforms();
        $actual = $client->getFunctions();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return Wordforms
     */
    private function createWordforms()
    {
        $config = new Config();

        return new Wordforms($config);
    }

    public function testShouldReturnPing()
    {
        $client = $this->createWordforms();

        $expected = (object) array('pingReturn' => 'Webservice "Wordforms" is ready.');
        $actual = $client->ping();

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnEmptyResult()
    {
        $client = $this->createWordforms();

        $expected = array();
        $actual = $client->getWordforms('!!this is not a word!!', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnExecute()
    {
        $client = $this->createWordforms();

        $expected = array(
            'Auto',
            'Autos'
        );
        $actual = $client->getWordforms('Auto', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnVerbExecute()
    {
        $client = $this->createWordforms();

        $expected = array(
            'fallen',
            'fiel',
            'fielen',
        );
        $actual = $client->getWordforms('fallen', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnNameExecute()
    {
        $client = $this->createWordforms();

        $expected = array(
            'oft',
            'öfter',
            'often',
        );
        $actual = $client->getWordforms('oft', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnVerbAdjectiveExecute()
    {
        $client = $this->createWordforms();

        $expected = array(
            'geht',
            'gehen',
            'ging'
        );
        $actual = $client->getWordforms('ging', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }
}
