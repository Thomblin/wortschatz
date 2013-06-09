<?php
namespace de\detert\sebastian\wortschatz\soap;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 06.06.13
 * @time 22:41
 * @license property of Sebastian Detert
 */
class ExperimentalSynonyms extends Service
{
    /**
     * @param de\detert\sebastian\wortschatz\soap\Config $config
     *
     * @return de\detert\sebastian\wortschatz\soap\Config
     */
    protected function setEndpoint(Config $config)
    {
        $config->endpoint = 'ExperimentalSynonyms?wsdl';

        return $config;
    }

    /**
     * returns experimental synonyms for internal tests
     * @param string $word
     * @param int    $limit
     *
     * @return array
     */
    public function getExperimentalSynonyms($word, $limit)
    {
        $result = $this->execute(
            array('Wort', $word),
            array('Limit', $limit)
        );

        return isset($result->executeReturn->result->dataVectors)
            ? $this->getDataRows($result->executeReturn->result->dataVectors)
            : array();
    }
}