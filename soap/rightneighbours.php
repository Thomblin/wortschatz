<?php
namespace de\detert\sebastian\wortschatz\soap;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 06.06.13
 * @time 22:41
 * @license property of Sebastian Detert
 */
class RightNeighbours extends Service
{
    /**
     * @param de\detert\sebastian\wortschatz\soap\Config $config
     *
     * @return de\detert\sebastian\wortschatz\soap\Config
     */
    protected function setEndpoint(Config $config)
    {
        $config->endpoint = 'RightNeighbours?wsdl';

        return $config;
    }

    /**
     * returns statistically significant right neighbours
     * (words co-occurring immediately to the right of the input word)
     *
     * @param string $word
     * @param int    $limit
     *
     * @return array
     */
    public function getNeighbours($word, $limit)
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