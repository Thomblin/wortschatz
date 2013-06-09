<?php
namespace de\detert\sebastian\wortschatz\soap;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 06.06.13
 * @time 22:41
 * @license property of Sebastian Detert
 */
class CooccurrencesAll extends Service
{
    /**
     * @param de\detert\sebastian\wortschatz\soap\Config $config
     *
     * @return de\detert\sebastian\wortschatz\soap\Config
     */
    protected function setEndpoint(Config $config)
    {
        $config->endpoint = 'CooccurrencesAll?wsdl';

        return $config;
    }

    /**
     * Returns statistically significant co-occurrences of the input word.
     * However, the accesses the unrestricted version of the co-occurrences table as in the Cooccurrences services,
     * which means significantly longer wait times.
     *
     * @param string $word
     * @param string $minimumSignificance
     * @param int    $limit
     *
     * @return array
     */
    public function getCooccurrences($word, $minimumSignificance, $limit)
    {
        $result = $this->execute(
            array('Wort', $word),
            array('Mindestsignifikanz', $minimumSignificance),
            array('Limit', $limit)
        );

        return isset($result->executeReturn->result->dataVectors)
            ? $this->getDataRows($result->executeReturn->result->dataVectors)
            : array();
    }
}