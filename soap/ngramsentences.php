<?php
namespace de\detert\sebastian\wortschatz\soap;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 06.06.13
 * @time 22:41
 * @license property of Sebastian Detert
 */
class NGramSentences extends Service
{
    /**
     * @param de\detert\sebastian\wortschatz\soap\Config $config
     *
     * @return de\detert\sebastian\wortschatz\soap\Config
     */
    protected function setEndpoint(Config $config)
    {
        $config->corpus = 'ngrams';
        $config->endpoint = 'NGramReferences?wsdl';

        return $config;
    }

    /**
     * returns reference sentences for a given pattern of word n-grams
     *
     * @param string $pattern
     * @param int    $limit
     *
     * @return array
     */
    public function getNgramSentences($pattern, $limit)
    {
        $result = $this->execute(
            array('Pattern', $pattern),
            array('Limit', $limit)
        );

        return isset($result->executeReturn->result->dataVectors)
            ? $this->getDataRows($result->executeReturn->result->dataVectors)
            : array();
    }
}