<?php
namespace de\detert\sebastian\wortschatz\Tests;

use de\detert\sebastian\wortschatz\soap\Config;
use de\detert\sebastian\wortschatz\soap\Sentences;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 13.01.13
 * @time 14:23
 * @license property of Sebastian Detert
 */
class SentencesTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReturnFunctions()
    {
        $expected = array(
            'executeResponse execute(execute $parameters)',
            'pingResponse ping(ping $parameters)',
        );

        $client = $this->createSentences();
        $actual = $client->getFunctions();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return Sentences
     */
    private function createSentences()
    {
        $config = new Config();

        return new Sentences($config);
    }

    public function testShouldReturnPing()
    {
        $client = $this->createSentences();

        $expected = (object) array('pingReturn' => 'Webservice "Sentences" is ready.');
        $actual = $client->ping();

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnEmptyResult()
    {
        $client = $this->createSentences();

        $expected = array();
        $actual = $client->getSentences('!!this is not a word!!', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnExecute()
    {
        $client = $this->createSentences();

        $expected = array(
            array(40808144, 'Zweitens der freche, frische Klang der Hupe und drittens die hinreißend gestylten 16-Zoll-Felgen, die es leider nur für dieses Auto gibt.'),
            array(40808138, 'Dazu kommen weitere Aspekte: Im Crossblade gewöhnt man sich automatisch das Rauchen im Auto ab (wer will schon Asche im Antlitz haben).'),
        );
        $actual = $client->getSentences('Auto', 2);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }
}
