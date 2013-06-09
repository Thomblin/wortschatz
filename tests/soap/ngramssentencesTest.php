<?php
namespace de\detert\sebastian\wortschatz\Tests;

use de\detert\sebastian\wortschatz\soap\Config;
use de\detert\sebastian\wortschatz\soap\NGramSentences;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 13.01.13
 * @time 14:23
 * @license property of Sebastian Detert
 */
class NGramSentencesTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReturnFunctions()
    {
        $expected = array(
            'executeResponse execute(execute $parameters)',
            'pingResponse ping(ping $parameters)',
        );

        $client = $this->createNGramSentences();
        $actual = $client->getFunctions();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return NGramSentences
     */
    private function createNGramSentences()
    {
        $config = new Config();

        return new NGramSentences($config);
    }

    public function testShouldReturnPing()
    {
        $client = $this->createNGramSentences();

        $expected = (object) array('pingReturn' => 'Webservice "NGramReferences" is ready.');
        $actual = $client->ping();

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnEmptyResult()
    {
        $client = $this->createNGramSentences();

        $expected = array();
        $actual = $client->getNgramSentences('!!this is not a word!!', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnExecute()
    {
        $client = $this->createNGramSentences();

        $expected = array(
            'DUMMY REFERENCE SENTENCE',
            'DUMMY REFERENCE SENTENCE',
            'DUMMY REFERENCE SENTENCE',
        );
        $actual = $client->getNgramSentences('%aa%', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnShortExecute()
    {
        $client = $this->createNGramSentences();

        $expected = array(
            'DUMMY REFERENCE SENTENCE',
            'DUMMY REFERENCE SENTENCE',
            'DUMMY REFERENCE SENTENCE',
        );
        $actual = $client->getNgramSentences('%', 3);

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }
}
