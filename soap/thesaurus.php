<?php
namespace de\detert\sebastian\wortschatz\soap;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 06.06.13
 * @time 22:41
 * @license property of Sebastian Detert
 */
class Thesaurus extends Service
{
    /**
     * @param de\detert\sebastian\wortschatz\soap\Config $config
     *
     * @return de\detert\sebastian\wortschatz\soap\Config
     */
    protected function setEndpoint(Config $config)
    {
        $config->endpoint = 'Thesaurus?wsdl';

        return $config;
    }

    /**
     * returns synonyms of the given input word.
     * However, this first lemmatizes the input word and thus returns more synonyms.
     *
     * @param string $word
     * @param int    $limit
     *
     * @return array
     */
    public function getThesaurus($word, $limit)
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