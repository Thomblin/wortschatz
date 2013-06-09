<?php
namespace de\detert\sebastian\wortschatz\soap;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 06.06.13
 * @time 22:41
 * @license property of Sebastian Detert
 */
class LeftCollocation extends Service
{
    /**
     * @param de\detert\sebastian\wortschatz\soap\Config $config
     *
     * @return de\detert\sebastian\wortschatz\soap\Config
     */
    protected function setEndpoint(Config $config)
    {
        $config->endpoint = 'LeftCollocationFinder?wsdl';

        return $config;
    }

    /**
     * Attempts to find linguistic collocations that occur to the left of the given input word.
     * The parameter wordclass accepts four values A,V,N,S which stand for
     * adjective, verb, noun and stopword, respectively. The parameter restricts the type of words found.
     *
     * @param string $word
     * @param string $wordClass
     * @param int    $limit
     *
     * @return array
     */
    public function getCollocations($word, $wordClass, $limit)
    {
        $result = $this->execute(
            array('Wort', $word),
            array('Wortart', $wordClass),
            array('Limit', $limit)
        );

        return isset($result->executeReturn->result->dataVectors)
            ? $this->getDataRows($result->executeReturn->result->dataVectors)
            : array();
    }
}