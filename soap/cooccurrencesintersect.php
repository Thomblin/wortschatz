<?php
namespace de\detert\sebastian\wortschatz\soap;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 06.06.13
 * @time 22:41
 * @license property of Sebastian Detert
 */
class CooccurrencesIntersect extends Service
{
    /**
     * @param de\detert\sebastian\wortschatz\soap\Config $config
     *
     * @return de\detert\sebastian\wortschatz\soap\Config
     */
    protected function setEndpoint(Config $config)
    {
        $config->endpoint = 'Kookkurrenzschnitt?wsdl';

        return $config;
    }

    /**
     * Returns the intersection of the co-occurrences of the two given words.
     * The result set is ordered according to the sum of the significances in descending order.
     * Note that due to the join involved, this make take some time.
     *
     * @param string $word
     * @param string $word2
     * @param int    $limit
     *
     * @return array
     */
    public function getCooccurrences($word, $word2, $limit)
    {
        $result = $this->execute(
            array('Wort 1', $word),
            array('Wort 2', $word2),
            array('Limit', $limit)
        );

        return isset($result->executeReturn->result->dataVectors)
            ? $this->getDataRows($result->executeReturn->result->dataVectors)
            : array();
    }
}