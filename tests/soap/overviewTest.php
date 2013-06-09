<?php
namespace de\detert\sebastian\wortschatz\Tests;

use de\detert\sebastian\wortschatz\soap\Config;
use de\detert\sebastian\wortschatz\soap\Overview;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 13.01.13
 * @time 14:23
 * @license property of Sebastian Detert
 */
class OverviewTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReturnFunctions()
    {
        $expected = array(
            'executeResponse execute(execute $parameters)',
            'pingResponse ping(ping $parameters)',
        );

        $client = $this->createOverview();
        $actual = $client->getFunctions();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return Overview
     */
    private function createOverview()
    {
        $config = new Config();

        return new Overview($config);
    }

    public function testShouldReturnPing()
    {
        $client = $this->createOverview();

        $expected = (object) array('pingReturn' => 'Webservice "ServiceOverview" is ready.');
        $actual = $client->ping();

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnExecute()
    {
        $client = $this->createOverview();

        $expected = array(
            array (
                '0' => 'ServiceOverview',
                '1' => '1',
                '2' => 'ACTIVE',
                '3' => 'This service gives an automatically generated overview of all currently available other services, along with links to their download locations and a webstart link.',
                '4' => 'FREE',
                '5' => 'Name',
            ),
        );
        $actual = $client->getOverview('%');

        $this->assertEquals(21, count($actual), print_r($actual, true));
        $this->assertEquals($expected[0], $actual[0], print_r($actual, true));
    }
}
