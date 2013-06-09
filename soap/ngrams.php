<?php
namespace de\detert\sebastian\wortschatz\soap;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 06.06.13
 * @time 22:41
 * @license property of Sebastian Detert
 */
class Ngrams extends Service
{
    /**
     * @param de\detert\sebastian\wortschatz\soap\Config $config
     *
     * @return de\detert\sebastian\wortschatz\soap\Config
     */
    protected function setEndpoint(Config $config)
    {
        $config->corpus = 'ngrams';
        $config->endpoint = 'NGrams?wsdl';

        return $config;
    }

    /**
     * returns word n-grams for a specified pattern
     *
     * @param string $pattern
     * @param int    $limit
     *
     * @return array
     */
    public function getNgrams($pattern, $limit)
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