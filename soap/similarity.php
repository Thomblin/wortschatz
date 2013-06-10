<?php
namespace de\detert\sebastian\wortschatz\soap;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 06.06.13
 * @time 22:41
 * @license property of Sebastian Detert
 */
class Similarity extends Service
{
    /**
     * @param de\detert\sebastian\wortschatz\soap\Config $config
     *
     * @return de\detert\sebastian\wortschatz\soap\Config
     */
    protected function setEndpoint(Config $config)
    {
        $config->endpoint = 'Similarity?wsdl';

        return $config;
    }

    /**
     * returns automatically computed contextually similar words of the input word.
     * Such similar words may be antonyms, hyperonyms, synonyms, cohyponyms or other.
     * Note that due to the huge amount of data any query to this services may take a long time.
     *
     * @param string $word
     * @param int    $limit
     *
     * @return array
     */
    public function getSimilarities($word, $limit)
    {
        $result = $this->execute(
            array('Wort', $word),
            array('Limit', $limit)
        );

        return isset($result->executeReturn->result->dataVectors)
            ? $this->getDataRows($result->executeReturn->result->dataVectors, array(1))
            : array();
    }
}