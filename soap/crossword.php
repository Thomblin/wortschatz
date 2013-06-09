<?php
namespace de\detert\sebastian\wortschatz\soap;

/**
 * @author sebastian.detert <github@elygor.de>
 * @date 06.06.13
 * @time 22:41
 * @license property of Sebastian Detert
 */
class Crossword extends Service
{
    /**
     * @param de\detert\sebastian\wortschatz\soap\Config $config
     *
     * @return de\detert\sebastian\wortschatz\soap\Config
     */
    protected function setEndpoint(Config $config)
    {
        $config->endpoint = 'Kreuzwortraetsel?wsdl';

        return $config;
    }

    /**
     * tries to find words matching the given pattern and length
     *
     * @param string $pattern
     * @param string $minimumSignificance
     * @param int    $limit
     *
     * @return array
     */
    public function getCrosswords($pattern, $length, $limit)
    {
        $result = $this->execute(
            array('Wort', $pattern),
            array('Wortlaenge', $length),
            array('Limit', $limit)
        );

        return isset($result->executeReturn->result->dataVectors)
            ? $this->getDataRows($result->executeReturn->result->dataVectors)
            : array();
    }
}