<?php
namespace de\detert\sebastian\wortschatz\Tests;

use de\detert\sebastian\wortschatz\soap\Config;
use de\detert\sebastian\wortschatz\soap\Categories;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 13.01.13
 * @time 14:23
 * @license property of Sebastian Detert
 */
class CategoriesTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldReturnFunctions()
    {
        $expected = array(
            'executeResponse execute(execute $parameters)',
            'pingResponse ping(ping $parameters)',
        );

        $client = $this->createCategories();
        $actual = $client->getFunctions();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return Categories
     */
    private function createCategories()
    {
        $config = new Config();

        return new Categories($config);
    }

    public function testShouldReturnPing()
    {
        $client = $this->createCategories();

        $expected = (object) array('pingReturn' => 'Webservice "Sachgebiet" is ready.');
        $actual = $client->ping();

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnEmptyResult()
    {
        $client = $this->createCategories();

        $expected = array();
        $actual = $client->getCategories('!!this is not a word!!');

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }

    public function testShouldReturnExecute()
    {
        $client = $this->createCategories();

        $expected = array(
            'Luftfahrt',
            'Autokunde',
            'Bauwesen',
            'Eisenbahnwesen',
            'Literaturgattung',
        );
        $actual = $client->getCategories('Auto');

        $this->assertEquals($expected, $actual, print_r($actual, true));
    }
}
